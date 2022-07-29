<?php
include_once('./_common.php');
$g5['title'] = "로그인 검사";

$mg_id       = isset($_POST['mg_id']) ? trim($_POST['mg_id']) : '';
$mg_pass = isset($_POST['mg_pass']) ? trim($_POST['mg_pass']) : '';

run_event('member_login_check_before', $mg_id);

if (!$mg_id || !$mg_pass)
    alert('회원아이디나 비밀번호가 공백이면 안됩니다.');

$mb = get_manager($mg_id);

//소셜 로그인추가 체크

$is_social_login = false;
$is_social_password_check = false;
// print_r($mb);
if($mb['rights'] == 'superadmin'){
        if (!$is_social_password_check && (! (isset($mb['mg_id']) && $mb['mg_id']) || !admin_login_password_check($mb, $mg_pass, $mb['mg_pass']))  ) {
        run_event('password_is_wrong', 'login', $mb);
        alert('아이디 또는 패스워드를 확인해주세요. \n계속 로그인이 실패할 경우 관리자에게 문의해 주세요.');
        }
}else{
    if (!$is_social_password_check && (! (isset($mb['mg_id']) && $mb['mg_id']) || !admin_login_password_check($mb, $mg_pass, $mb['mg_pass'])) && $mb['reunion_id'] !== $reunionID ) {
        run_event('password_is_wrong', 'login', $mb);
        alert('아이디 또는 패스워드를 확인해주세요. \n계속 로그인이 실패할 경우 관리자에게 문의해 주세요.');
        }
}


run_event('login_session_before', $mb, $is_social_login);

@include_once($member_skin_path.'/login_check.skin.php');

// 회원아이디 세션 생성
set_session('ss_mb_id', $mb['mg_id']);
// FLASH XSS 공격에 대응하기 위하여 회원의 고유키를 생성해 놓는다. 관리자에서 검사함 - 110106
set_session('ss_mb_key', md5($mb['mg_name'] . get_real_client_ip() . $_SERVER['HTTP_USER_AGENT']));


// 3.26
// 아이디 쿠키에 한달간 저장
if (isset($auto_login) && $auto_login) {
    // 3.27
    // 자동로그인 ---------------------------
    // 쿠키 한달간 저장
    $key = md5($_SERVER['SERVER_ADDR'] . $_SERVER['SERVER_SOFTWARE'] . $_SERVER['HTTP_USER_AGENT'] . $mb['mg_pass']);
    set_cookie('ck_mb_id', $mb['mg_id'], 86400 * 31);
    set_cookie('ck_auto', $key, 86400 * 31);
    // 자동로그인 end ---------------------------
} else {
    set_cookie('ck_mb_id', '', 0);
    set_cookie('ck_auto', '', 0);
}

if ($url) {
    // url 체크
    check_url_host($url, '', G5_URL, true);

    $link = urldecode($url);
    // 2003-06-14 추가 (다른 변수들을 넘겨주기 위함)
    if (preg_match("/\?/", $link))
        $split= "&amp;";
    else
        $split= "?";

    // $_POST 배열변수에서 아래의 이름을 가지지 않은 것만 넘김
    $post_check_keys = array('mg_id', 'mg_pass', 'x', 'y', 'url');
    
    //소셜 로그인 추가
    if($is_social_login){
        $post_check_keys[] = 'provider';
    }

    $post_check_keys = run_replace('login_check_post_check_keys', $post_check_keys, $link, $is_social_login);

    foreach($_POST as $key=>$value) {
        if ($key && !in_array($key, $post_check_keys)) {
            $link .= "$split$key=$value";
            $split = "&amp;";
        }
    }

} else  {
    $link = G5_URL;
}
//소셜 로그인 추가
if(function_exists('social_login_success_after')){
    // 로그인 성공시 소셜 데이터를 기존의 데이터와 비교하여 바뀐 부분이 있으면 업데이트 합니다.
    $link = social_login_success_after($mb, $link);
    social_login_session_clear(1);
}

//영카트 회원 장바구니 처리
if(function_exists('set_cart_id')){
    $member = $mb;

    // 보관기간이 지난 상품 삭제
    cart_item_clean();
    set_cart_id('');
    $s_cart_id = get_session('ss_cart_id');
    // 선택필드 초기화
    $sql = " update {$g5['g5_shop_cart_table']} set ct_select = '0' where od_id = '$s_cart_id' ";
    sql_query($sql);
}

run_event('member_login_check', $mb, $link, $is_social_login);

// 관리자로 로그인시 DATA 폴더의 쓰기 권한이 있는지 체크합니다. 쓰기 권한이 없으면 로그인을 못합니다.
if( is_admin($mb['mg_id']) && is_dir(G5_DATA_PATH.'/tmp/') ){
    $tmp_data_file = G5_DATA_PATH.'/tmp/tmp-write-test-'.time();
    $tmp_data_check = @fopen($tmp_data_file, 'w');
    if($tmp_data_check){
        if(! @fwrite($tmp_data_check, G5_URL)){
            $tmp_data_check = false;
        }
    }
    @fclose($tmp_data_check);
    @unlink($tmp_data_file);

    if(! $tmp_data_check){
        alert("data 폴더에 쓰기권한이 없거나 또는 웹하드 용량이 없는 경우\\n로그인을 못할수도 있으니, 용량 체크 및 쓰기 권한을 확인해 주세요.", $link);
    }
}
goto_url(G5_ADMIN_URL);