<?php
$sub_menu = "100100";
include_once('./_common.php');

auth_check_menu($auth, $sub_menu, 'w');

$mb = array(
'mb_certify' => null,
'mb_adult' => null,
'mb_sms' => null,
'mb_intercept_date' => null,
'mb_id' => null,
'mb_name' => null,
'mb_nick' => null,
'mb_point' => null,
'mb_email' => null,
'mb_homepage' => null,
'mb_hp' => null,
'mb_tel' => null,
'mb_zip1' => null,
'mb_zip2' => null,
'mb_addr1' => null,
'mb_addr2' => null,
'mb_addr3' => null,
'mb_addr_jibeon' => null,
'mb_signature' => null,
'mb_profile' => null,
'mb_memo' => null,
'mb_leave_date' => null,
'mb_1' => null,
'mb_2' => null,
'mb_3' => null,
'mb_4' => null,
'mb_5' => null,
'mb_6' => null,
'mb_7' => null,
'mb_8' => null,
'mb_9' => null,
'mb_10' => null,
);

$sound_only = '';
$required_mb_id_class = '';
$required_mb_password = '';

if ($w == '')
{
    $required_mb_id = 'required';
    $required_mb_id_class = 'required alnum_';
    $required_mb_password = 'required';
    $sound_only = '<strong class="sound_only">필수</strong>';

    $mb['mb_mailling'] = null;
    $mb['mb_open'] = 1;
    $mb['mb_level'] = 2;
    $html_title = '추가';
}
else if ($w == 'u')
{
    $mb = get_member($mb_id);
    if (!$mb['mb_id'])
        alert('존재하지 않는 회원자료입니다.');
    if ( ($is_admin != 'super' && $is_admin != 'manager' && $is_admin != 'supervisor'  && $is_admin != 'superadmin') && $mb['mb_level'] >= $member['mb_level'])
        alert('자신보다 권한이 높거나 같은 회원은 수정할 수 없습니다.');

    $required_mb_id = 'readonly';
    $html_title = '수정';

    $mb['mb_name'] = get_text($mb['mb_name']);
    $mb['mb_nick'] = get_text($mb['mb_nick']);
    $mb['mb_email'] = get_text($mb['mb_email']);
    $mb['mb_homepage'] = get_text($mb['mb_homepage']);
    $mb['mb_birth'] = get_text($mb['mb_birth']);
    $mb['mb_tel'] = get_text($mb['mb_tel']);
    $mb['mb_hp'] = get_text($mb['mb_hp']);
    $mb['mb_addr1'] = get_text($mb['mb_addr1']);
    $mb['mb_addr2'] = get_text($mb['mb_addr2']);
    $mb['mb_addr3'] = get_text($mb['mb_addr3']);
    $mb['mb_signature'] = get_text($mb['mb_signature']);
    $mb['mb_recommend'] = get_text($mb['mb_recommend']);
    $mb['mb_profile'] = get_text($mb['mb_profile']);
    $mb['mb_mailling'] = get_text($mb['mb_mailling']);
    $mb['mb_1'] = get_text($mb['mb_1']);
    $mb['mb_2'] = get_text($mb['mb_2']);
    $mb['mb_3'] = get_text($mb['mb_3']);
    $mb['mb_4'] = get_text($mb['mb_4']);
    $mb['mb_5'] = get_text($mb['mb_5']);
    $mb['mb_6'] = get_text($mb['mb_6']);
    $mb['mb_7'] = get_text($mb['mb_7']);
    $mb['mb_8'] = get_text($mb['mb_8']);
    $mb['mb_9'] = get_text($mb['mb_9']);
    $mb['mb_10'] = get_text($mb['mb_10']);
}
else
    alert('제대로 된 값이 넘어오지 않았습니다.');

// 본인확인방법
switch($mb['mb_certify']) {
    case 'hp':
        $mb_certify_case = '휴대폰';
        $mb_certify_val = 'hp';
        break;
    case 'ipin':
        $mb_certify_case = '아이핀';
        $mb_certify_val = 'ipin';
        break;
    case 'admin':
        $mb_certify_case = '관리자 수정';
        $mb_certify_val = 'admin';
        break;
    default:
        $mb_certify_case = '';
        $mb_certify_val = 'admin';
        break;
}

// 본인확인
$mb_certify_yes  =  $mb['mb_certify'] ? 'checked="checked"' : '';
$mb_certify_no   = !$mb['mb_certify'] ? 'checked="checked"' : '';

// 성인인증
$mb_adult_yes       =  $mb['mb_adult']      ? 'checked="checked"' : '';
$mb_adult_no        = !$mb['mb_adult']      ? 'checked="checked"' : '';

//메일수신
$mb_mailling_yes    =  $mb['mb_mailling']   ? 'checked="checked"' : '';
$mb_mailling_no     = !$mb['mb_mailling']   ? 'checked="checked"' : '';

// SMS 수신
$mb_sms_yes         =  $mb['mb_sms']        ? 'checked="checked"' : '';
$mb_sms_no          = !$mb['mb_sms']        ? 'checked="checked"' : '';

// 정보 공개
$mb_open_yes        =  $mb['mb_open']       ? 'checked="checked"' : '';
$mb_open_no         = !$mb['mb_open']       ? 'checked="checked"' : '';


// 발송지 공개
$mb_newsletter_ship_yes        =  $mb['mb_newsletter_ship'] == '자택'      ? 'checked="checked"' : '';
$mb_newsletter_ship_no         =  $mb['mb_newsletter_ship'] == '직장'      ? 'checked="checked"' : '';

if (isset($mb['mb_certify'])) {
    // 날짜시간형이라면 drop 시킴
    if (preg_match("/-/", $mb['mb_certify'])) {
        sql_query(" ALTER TABLE `{$g5['member_table']}` DROP `mb_certify` ", false);
    }
} else {
    sql_query(" ALTER TABLE `{$g5['member_table']}` ADD `mb_certify` TINYINT(4) NOT NULL DEFAULT '0' AFTER `mb_hp` ", false);
}

if(isset($mb['mb_adult'])) {
    sql_query(" ALTER TABLE `{$g5['member_table']}` CHANGE `mb_adult` `mb_adult` TINYINT(4) NOT NULL DEFAULT '0' ", false);
} else {
    sql_query(" ALTER TABLE `{$g5['member_table']}` ADD `mb_adult` TINYINT NOT NULL DEFAULT '0' AFTER `mb_certify` ", false);
}

// 지번주소 필드추가
if(!isset($mb['mb_addr_jibeon'])) {
    sql_query(" ALTER TABLE {$g5['member_table']} ADD `mb_addr_jibeon` varchar(255) NOT NULL DEFAULT '' AFTER `mb_addr2` ", false);
}

// 건물명필드추가
if(!isset($mb['mb_addr3'])) {
    sql_query(" ALTER TABLE {$g5['member_table']} ADD `mb_addr3` varchar(255) NOT NULL DEFAULT '' AFTER `mb_addr2` ", false);
}

// 중복가입 확인필드 추가
if(!isset($mb['mb_dupinfo'])) {
    sql_query(" ALTER TABLE {$g5['member_table']} ADD `mb_dupinfo` varchar(255) NOT NULL DEFAULT '' AFTER `mb_adult` ", false);
}

// 이메일인증 체크 필드추가
if(!isset($mb['mb_email_certify2'])) {
    sql_query(" ALTER TABLE {$g5['member_table']} ADD `mb_email_certify2` varchar(255) NOT NULL DEFAULT '' AFTER `mb_email_certify` ", false);
}

if ($mb['mb_intercept_date']) $g5['title'] = "차단된 ";
else $g5['title'] .= "";
$g5['title'] .= '동문 회원 '.$html_title;
include_once('./admin.head.php');

// add_javascript('js 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
add_javascript(G5_POSTCODE_JS, 0);    //다음 주소 js
?>


<form name="fmember" id="fmember" action="./member_form_update.php" onsubmit="return fmember_submit(this);" method="post" enctype="multipart/form-data">
<input type="hidden" name="w" value="<?php echo $w ?>">
<input type="hidden" name="sfl" value="<?php echo $sfl ?>">
<input type="hidden" name="stx" value="<?php echo $stx ?>">
<input type="hidden" name="sst" value="<?php echo $sst ?>">
<input type="hidden" name="sod" value="<?php echo $sod ?>">
<input type="hidden" name="page" value="<?php echo $page ?>">
<input type="hidden" name="token" value="">
<input type="hidden" name="mb_open" value="1">
<input type="hidden" name="mb_level" value="2">

<div class="tbl_frm01 tbl_wrap">
    <div class="tit01">기본 정보</div>
    <table>
        <caption><?php echo $g5['title']; ?></caption>
        <colgroup>
            <col class="grid_4">
            <col>
            <col class="grid_4">
            <col>
        </colgroup>
        <tbody>
            <tr>
                <th scope="row"><label for="mb_id">아이디<?php echo $sound_only ?></label></th>
                <td>
                    <input type="text" name="mb_id" value="<?php echo $mb['mb_id'] ?>" id="mb_id" <?php echo $required_mb_id ?> class="frm_input <?php echo $required_mb_id_class ?>" size="15" maxlength="20">
                </td>
                <th scope="row"><label for="mb_password">비밀번호<?php echo $sound_only ?></label></th>
                <td><input type="password" name="mb_password" id="mb_password"  class="frm_input " size="15" maxlength="20"></td>
            </tr>
            <tr>
                <th scope="row"><label for="mb_name">성명1<strong class="sound_only">필수</strong></label></th>
                <td><input type="text" name="mb_name" value="<?php echo $mb['mb_name'] ?>" id="mb_name" required class="required frm_input" size="15" maxlength="20"></td>
                <th scope="row"><label for="mb_nick">성명2<strong class="sound_only">필수</strong></label></th>
                <td><input type="text" name="mb_nick" value="<?php echo $mb['mb_nick'] ?>" id="mb_nick"  class=" frm_input" size="15" maxlength="20"></td>
            </tr>
            <tr>
                <th scope="row">성별</th>
                <td>
                    <input type="radio" name="mb_sex" value="m" id="male" <?=($mb['mb_sex'] == 'm') ?  'checked' : null ?> checked>
                    <label for="male">남</label>
                    <input type="radio" name="mb_sex" value="f" id="female" <?=($mb['mb_sex'] == 'f') ?  'checked' : null ?>>
                    <label for="female">여</label>
                    <input type="radio" name="mb_sex" value="" id="impertinence" <?=($mb['mb_sex'] == '') ?  'checked' : null ?>>
                    <label for="impertinence">모름</label> 
                </td>

                <th scope="row"><label for="mb_email">E-mail<strong class="sound_only">필수</strong></label></th>
                <td><input type="text" name="mb_email" value="<?php echo $mb['mb_email'] ?>" id="mb_email" maxlength="100"  class=" frm_input email" size="30"></td>
            </tr>

            <tr>
                <th scope="row"><label for="mb_hp">휴대폰번호</label></th>
                <td>
                    <span class="frm_info">'-'를 포함하여 입력해 주세요. ex) 010-1234-5678</span>
                    <input type="text" name="mb_hp" value="<?php echo $mb['mb_hp'] ?>" id="mb_hp" class="frm_input" size="15" maxlength="20">
                    <p></p>
                </td>
                <th scope="row"><label for="mb_tel">자택전화</label></th>
                <td><input type="text" name="mb_tel" value="<?php echo $mb['mb_tel'] ?>" id="mb_tel" class="frm_input" size="15" maxlength="20"></td>
            </tr>
            <tr>
                <th scope="row">주소</th>
                <td class="td_addr_line">
                    <label for="mb_zip" class="sound_only">우편번호</label>
                    <input type="text" name="mb_zip" value="<?php echo $mb['mb_zip1'].$mb['mb_zip2']; ?>" id="mb_zip" class="frm_input readonly" size="5" maxlength="6">
                    <button type="button" class="btn_frmline" onclick="win_zip('fmember', 'mb_zip', 'mb_addr1', 'mb_addr2', 'mb_addr3', 'mb_addr_jibeon');">주소 검색</button><br>
                    <input type="text" name="mb_addr1" value="<?php echo $mb['mb_addr1'] ?>" id="mb_addr1" class="frm_input readonly" size="60">
                    <label for="mb_addr1">기본주소</label><br>
                    <input type="text" name="mb_addr2" value="<?php echo $mb['mb_addr2'] ?>" id="mb_addr2" class="frm_input" size="60">
                    <label for="mb_addr2">상세주소</label>
                    <input type="hidden" name="mb_addr_jibeon" value="<?php echo $mb['mb_addr_jibeon']; ?>"><br>
                </td>
            </tr>

            <tr>
                <th scope="row">임원명</th>
                <td colspan="3">
                    <?= get_reunion_select('executive', $mb['executive'], '', 'ec_name', 'executive'); ?>
                </td>
            </tr>

        </tbody>
    </table>
</div>


<div class="tbl_frm01 tbl_wrap">
    <div class="tit01">학교 정보</div>
    <table>
        <caption><?php echo $g5['title']; ?></caption>
         <colgroup>
            <col class="grid_4">
            <col >
            <col class="grid_4">
            <col >
            <col class="grid_4">
            <col >
        </colgroup>
        <tbody>
            <tr>
                <th scope="row">계열</th>
                <td>
                    <?= get_reunion_select('affiliation', $mb['affiliation'], '', 'af_name', 'affiliation'); ?>
                </td>
                <th scope="row">학과</th>
                <td class="department">
                    <?= get_department_select('department', $mb['department'], '', 'dp_name', 'department', $mb['affiliation']); ?>
                </td>
                <th scope="row">기수</th>
                <td>
                   <input type="text" name="generation" value="<?php echo $mb['generation'] ?>" id="generation"  class=" frm_input" size="15" maxlength="20">
                </td>
            </tr>
            <tr>
                <th scope="row">입학년도</th>
                <td>
                   <input type="text" name="entrance_year" value="<?php echo $mb['entrance_year'] ?>" id="entrance_year"  class=" frm_input" size="15" maxlength="20">
                </td>

                <th scope="row">졸업년도</th>
                <td >
                   <input type="text" name="graduation_year" value="<?php echo $mb['graduation_year'] ?>" id="graduation_year"  class=" frm_input" size="15" maxlength="20">
                </td>

                <th scope="row">학번</th>
                <td >
                   <input type="text" name="admission_year" value="<?php echo $mb['admission_year'] ?>" id="admission_year"  class=" frm_input" size="15" maxlength="20">
                </td>
            </tr>
        </tbody>
    </table>
</div>


<div class="tbl_frm01 tbl_wrap">
    <div class="tit01">직장 정보</div>
    <table>
        <caption><?php echo $g5['title']; ?></caption>
        <colgroup>
            <col class="grid_4">
            <col >
            <col class="grid_4">
            <col >
            <col class="grid_4">
            <col >
        </colgroup>
        <tbody>
            <tr>
                <th scope="row">직장명</th>
                <td>
                   <input type="text" name="job" value="<?php echo $mb['job'] ?>" id="job"  class=" frm_input" size="15" maxlength="20">
                </td>
                <th scope="row">부서</th>
                <td>
                   <input type="text" name="job_department" value="<?php echo $mb['job_department'] ?>" id="job_department"  class=" frm_input" size="15" maxlength="20">
                </td>
                <th scope="row">직위</th>
                <td>
                   <input type="text" name="job_position" value="<?php echo $mb['job_position'] ?>" id="job_position"  class=" frm_input" size="15" maxlength="20">
                </td>
            </tr>
            <tr>
                <th scope="row">직장전화</th>
                <td>
                   <input type="text" name="workplace_tel" value="<?php echo $mb['workplace_tel'] ?>" id="workplace_tel"  class=" frm_input" size="15" maxlength="20">
                </td>

                <th scope="row">직장주소</th>
                <td colspan="3">
                   <input type="text" name="workplace_addr" value="<?php echo $mb['workplace_addr'] ?>" id="workplace_addr"  class=" frm_input" maxlength="120" size="60">
                </td>
            </tr>
        </tbody>
    </table>
</div>


<div class="tbl_frm01 tbl_wrap">
    <div class="tit01">기타 정보</div>
    <table>
        <caption><?php echo $g5['title']; ?></caption>
        <colgroup>
            <col class="grid_4">
            <col >
            <col class="grid_4">
            <col >
            <col class="grid_4">
            <col >
        </colgroup>
        <tbody>
            <tr>
                <th scope="row">생년월일</th>
                <td > 
                   <input type="text" name="mb_birth" value="<?php echo $mb['mb_birth'] ?>" id="mb_birth"  class=" frm_input" size="15" maxlength="20">
                </td>
                <th scope="row">비고</th>
                <td > 
                   <input type="text" name="etc" value="<?php echo $mb['etc'] ?>" id="etc"  class=" frm_input" size="60" maxlength="20">
                </td>
                <!-- <th scope="row">기념일</th>
                <td colspan="3">
                   <input type="text" name="anniversary" value="<?php echo $mb['anniversary'] ?>" id="anniversary"  class="frm_input" size="15" maxlength="20">
                </td> -->
            </tr>
            <!-- <tr>
                <th scope="row">관련단체</th>
                <td>
                   <input type="text" name="organizations" value="<?php echo $mb['organizations'] ?>" id="organizations"  class=" frm_input" size="15" maxlength="20">
                </td>
                <th scope="row">유력인사</th>
                <td colspan="3">
                   <input type="text" name="candidate" value="<?php echo $mb['candidate'] ?>" id="candidate"  class=" frm_input" size="15" maxlength="20">
                </td>
            </tr> -->
        </tbody>
    </table>
</div>


<div class="tbl_frm01 tbl_wrap">
    <div class="tit01">홍보 채널</div>
    <table>
        <caption><?php echo $g5['title']; ?></caption>
        <colgroup>
            <col class="grid_4">
            <col >
            <col class="grid_4">
            <col >
            <col class="grid_4">
            <col >
        </colgroup>
        <tbody>
            <tr>
                <th scope="row">메일 수신</th>
                <td colspan="5">
                    <input type="radio" name="mb_mailling" value="1" id="mb_mailling_yes" <?php echo $mb_mailling_yes; ?>>
                    <label for="mb_mailling_yes">수신</label>
                    <input type="radio" name="mb_mailling" value="0" id="mb_mailling_no" <?php echo $mb_mailling_no; ?> chekced>
                    <label for="mb_mailling_no">거부</label>
                    <input type="radio" name="mb_mailling" value="2" id="mb_mailling_unknow" <?=($mb['mb_mailling'] == '2') ? "chekced" : null?>>
                    <label for="mb_mailling_unknow">불명</label>
                </td>
            </tr>
            <tr>
                <th scope="row">문자/SMS 수신</th>
                <td colspan="5">
                    <input type="radio" name="mb_sms" value="1" id="mb_sms_yes" <?php echo $mb_sms_yes; ?>>
                    <label for="mb_sms_yes">수신</label>
                    <input type="radio" name="mb_sms" value="0" id="mb_sms_no" <?php echo $mb_sms_no; ?>>
                    <label for="mb_sms_no">거부</label>
                    <input type="radio" name="mb_sms" value="2" id="mb_sms_unknow" <?=($mb['mb_sms'] == '2') ? "chekced" : null?> >
                    <label for="mb_sms_unknow">불명</label>
                </td>
            </tr>
            <tr>
                <th scope="row">카톡/SNS 수신</th>
                <td colspan="5">
                    <input type="radio" name="mb_sms" value="1" id="mb_sms_yes" <?php echo $mb_sms_yes; ?>>
                    <label for="mb_sms_yes">수신</label>
                    <input type="radio" name="mb_sms" value="0" id="mb_sms_no" <?php echo $mb_sms_no; ?>>
                    <label for="mb_sms_no">거부</label>
                    <input type="radio" name="mb_sms" value="2" id="mb_sms_unknow" <?=($mb['mb_sms'] == '2') ? "chekced" : null?> >
                    <label for="mb_sms_unknow">불명</label>
                </td>
            </tr>
            <tr>
                <th scope="row">회보 발송</th>
                <td >
                    <select name="mb_newsletter" id="mb_newsletter">
                        <option value="0" <?=($mb['mb_newsletter'] == '0' ) ? 'selected' : null?>  >미신청</option>
                        <option value="1" <?=($mb['mb_newsletter'] == '1' ) ? 'selected' : null?>>신청</option>
                    </select>
                    <input type="radio" name="mb_newsletter_ship" value="자택" id="mb_newsletter_ship_yes" <?php echo $mb_newsletter_ship_yes; ?>>
                    <label for="mb_newsletter_ship_yes">자택</label>
                    <input type="radio" name="mb_newsletter_ship" value="직장" id="mb_newsletter_ship_no" <?php echo $mb_newsletter_ship_no; ?>>
                    <label for="mb_newsletter_ship_no">직장</label>
                </td>
            </tr>
        </tbody>
    </table>
</div>

<?php if ($w == 'u') {
    $mb_data =get_member($mb_id);
    $mb_no = $mb_data['mb_no'];
    $fee_sql = "SELECT * FROM {$g5['fee']}  WHERE mb_no ='$mb_no' order by deposit_date desc " ;   
    $fee_result = sql_query($fee_sql);
?>

<div class="tbl_frm01 tbl_wrap table02">
    <div class="tit01">회비 정보</div>
    <table>
        <caption><?php echo $g5['title']; ?></caption>
        <colgroup>
            <col width="25%">
            <col width="25%">
            <col width="25%">
            <col width="25%">
        </colgroup>
        <thead>
            <th>구분</th>
            <th>입금날짜</th>
            <th>금액</th>
            <th>비고</th>
        </thead>
        <tbody>
            <?php for ($i=0; $row=sql_fetch_array($fee_result); $i++) { ?>
                <tr>
                <td><?=$row['fee_type']?></td>
                <td><?=$row['deposit_date']?></td>
                <td><?=number_format($row['fee'])?></td>
                <td><?=$row['etc']?></td>
            </tr>
            <?php }?>
            <?php 
            if ($i == 0)
                echo "<tr><td colspan='4' class=\"empty_table\">자료가 없습니다.</td></tr>";
            ?>
        </tbody>
    </table>
</div>


<!-- <div class="tbl_frm01 tbl_wrap table02">
    <div class="tit01">지회 정보</div>
    <table>
        <caption><?php echo $g5['title']; ?></caption>
        <colgroup>
            <col width="25%">
            <col width="25%">
            <col width="25%">
            <col width="25%">
        </colgroup>
        <thead>
            <th>등록일</th>
            <th>상태</th>
            <th>지회명</th>
            <th>지회인원</th>
        </thead>
        <tbody>
            <tr>
                <td>2016.05.25</td>
                <td>활동</td>
                <td>산악회</td>
                <td>20명</td>
            </tr>
            <tr>
                <td></td>
                <td>일시중지</td>
                <td>교직원</td>
                <td></td>
            </tr>
            <tr>
                <td></td>
                <td>영구중지</td>
                <td></td>
                <td></td>
            </tr>
        </tbody>
    </table>
</div> -->

<?php }?>


    <?php if ($config['cf_use_recommend']) { // 추천인 사용 ?>
    <tr>
        <th scope="row">추천인</th>
        <td colspan="3"><?php echo ($mb['mb_recommend'] ? get_text($mb['mb_recommend']) : '없음'); // 081022 : CSRF 보안 결함으로 인한 코드 수정 ?></td>
    </tr>
    <?php } ?>


    <?php
    //소셜계정이 있다면
    if(function_exists('social_login_link_account') && $mb['mb_id'] ){
        if( $my_social_accounts = social_login_link_account($mb['mb_id'], false, 'get_data') ){ ?>

    <tr>
    <th>소셜계정목록</th>
    <td colspan="3">
        <ul class="social_link_box">
            <li class="social_login_container">
                <h4>연결된 소셜 계정 목록</h4>
                <?php foreach($my_social_accounts as $account){     //반복문
                    if( empty($account) ) continue;

                    $provider = strtolower($account['provider']);
                    $provider_name = social_get_provider_service_name($provider);
                ?>
                <div class="account_provider" data-mpno="social_<?php echo $account['mp_no'];?>" >
                    <div class="sns-wrap-32 sns-wrap-over">
                        <span class="sns-icon sns-<?php echo $provider; ?>" title="<?php echo $provider_name; ?>">
                            <span class="ico"></span>
                            <span class="txt"><?php echo $provider_name; ?></span>
                        </span>

                        <span class="provider_name"><?php echo $provider_name;   //서비스이름?> ( <?php echo $account['displayname']; ?> )</span>
                        <span class="account_hidden" style="display:none"><?php echo $account['mb_id']; ?></span>
                    </div>
                    <div class="btn_info"><a href="<?php echo G5_SOCIAL_LOGIN_URL.'/unlink.php?mp_no='.$account['mp_no'] ?>" class="social_unlink" data-provider="<?php echo $account['mp_no'];?>" >연동해제</a> <span class="sound_only"><?php echo substr($account['mp_register_day'], 2, 14); ?></span></div>
                </div>
                <?php } //end foreach ?>
            </li>
        </ul>
        <script>
        jQuery(function($){
            $(".account_provider").on("click", ".social_unlink", function(e){
                e.preventDefault();

                if (!confirm('정말 이 계정 연결을 삭제하시겠습니까?')) {
                    return false;
                }

                var ajax_url = "<?php echo G5_SOCIAL_LOGIN_URL.'/unlink.php' ?>";
                var mb_id = '',
                    mp_no = $(this).attr("data-provider"),
                    $mp_el = $(this).parents(".account_provider");

                    mb_id = $mp_el.find(".account_hidden").text();

                if( ! mp_no ){
                    alert('잘못된 요청! mp_no 값이 없습니다.');
                    return;
                }

                $.ajax({
                    url: ajax_url,
                    type: 'POST',
                    data: {
                        'mp_no': mp_no,
                        'mb_id': mb_id
                    },
                    dataType: 'json',
                    async: false,
                    success: function(data, textStatus) {
                        if (data.error) {
                            alert(data.error);
                            return false;
                        } else {
                            alert("연결이 해제 되었습니다.");
                            $mp_el.fadeOut("normal", function() {
                                $(this).remove();
                            });
                        }
                    }
                });

                return;
            });
        });
        </script>

    </td>
    </tr>

    <?php
        }   //end if
    }   //end if

    run_event('admin_member_form_add', $mb, $w, 'table');
    ?>




<div class="btn_fixed_top">
    <a href="./member_list.php?<?php echo $qstr ?>" class="btn btn_02">목록</a>
    <input type="submit" value="확인" class="btn_submit btn" accesskey='s'>
</div>
</form>
<script>


// $("#affiliation").change(function(){
//     var val = $(this).val();
//     var department = '<?=$mb[department]?>'
//     $.ajax({
//         url: "./ajax.get_department_select.php",
//         type: 'POST',
//         data: {
//             'affiliation': val,
//             'department' : department
//         },
//         dataType: 'html',
//         async: false,
//         success: function (data, textStatus) {
//             if (data.error) {
//                 alert(data.error);
//                 return false;
//             } else {
//                 $(".department").html(data);
//             }
//         }
//     });
// })


function fmember_submit(f)
{
    if (!f.mb_icon.value.match(/\.(gif|jpe?g|png)$/i) && f.mb_icon.value) {
        alert('아이콘은 이미지 파일만 가능합니다.');
        return false;
    }

    if (!f.mb_img.value.match(/\.(gif|jpe?g|png)$/i) && f.mb_img.value) {
        alert('회원이미지는 이미지 파일만 가능합니다.');
        return false;
    }

    return true;
}
</script>
<?php
run_event('admin_member_form_after', $mb, $w);

include_once('./admin.tail.php');