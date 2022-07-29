<?php
$sub_menu = "200100";
include_once('./_common.php');

check_demo();

if (! (isset($_POST['chk']) && is_array($_POST['chk']))) {
    alert($_POST['act_button']." 하실 항목을 하나 이상 체크하세요.");
}

auth_check_menu($auth, $sub_menu, 'w');

check_admin_token();

$mb_datas = array();
$msg = '';

if ($_POST['act_button'] == "선택수정") {

    for ($i=0; $i<count($_POST['chk']); $i++)
    {
        // 실제 번호를 넘김
        $k = isset($_POST['chk'][$i]) ? (int) $_POST['chk'][$i] : 0;
        
        $post_mb_certify = (isset($_POST['mb_certify'][$k]) && $_POST['mb_certify'][$k]) ? clean_xss_tags($_POST['mb_certify'][$k], 1, 1, 20) : '';
        $post_mb_level = isset($_POST['mb_level'][$k]) ? (int) $_POST['mb_level'][$k] : 0;
        $post_mb_intercept_date = (isset($_POST['mb_intercept_date'][$k]) && $_POST['mb_intercept_date'][$k]) ? clean_xss_tags($_POST['mb_intercept_date'][$k], 1, 1, 8) : '';
        $post_mb_mailling = isset($_POST['mb_mailling'][$k]) ? (int) $_POST['mb_mailling'][$k] : 0;
        $post_mb_sms = isset($_POST['mb_sms'][$k]) ? (int) $_POST['mb_sms'][$k] : 0;
        $post_mb_open = isset($_POST['mb_open'][$k]) ? (int) $_POST['mb_open'][$k] : 0;

        $mb_datas[] = $mb = get_member($_POST['mb_id'][$k]);

        if (! (isset($mb['mb_id']) && $mb['mb_id'])) {
            $msg .= $mb['mb_id'].' : 회원자료가 존재하지 않습니다.\\n';
        } else if ($is_admin != 'super' && $mb['mb_level'] >= $member['mb_level']) {
            $msg .= $mb['mb_id'].' : 자신보다 권한이 높거나 같은 회원은 수정할 수 없습니다.\\n';
        } else if ($member['mb_id'] == $mb['mb_id']) {
            $msg .= $mb['mb_id'].' : 로그인 중인 관리자는 수정 할 수 없습니다.\\n';
        } else {
            if($post_mb_certify)
                $mb_adult = isset($_POST['mb_adult'][$k]) ? (int) $_POST['mb_adult'][$k] : 0;
            else
                $mb_adult = 0;

            $sql = " update {$g5['member_table']}
                        set mb_level = '".$post_mb_level."',
                            mb_intercept_date = '".sql_real_escape_string($post_mb_intercept_date)."',
                            mb_mailling = '".$post_mb_mailling."',
                            mb_sms = '".$post_mb_sms."',
                            mb_open = '".$post_mb_open."',
                            mb_certify = '".sql_real_escape_string($post_mb_certify)."',
                            mb_adult = '{$mb_adult}'
                        where mb_id = '".sql_real_escape_string($mb['mb_id'])."' ";
            sql_query($sql);
        }
    }

} else if ($_POST['act_button'] == "선택삭제") {

    for ($i=0; $i<count($_POST['chk']); $i++)
    {
        // 실제 번호를 넘김
        $k = isset($_POST['chk'][$i]) ? (int) $_POST['chk'][$i] : 0;

        $fee_id = $_POST['fee_id'][$k];

        if (!$fee_id) {
            $msg .= '회비 자료가 존재하지 않습니다.\\n';
        } else {
            // 회비회원자료 삭제
            sql_query("DELETE FROM `fee` WHERE id = '{$fee_id}'  AND reunion_id = '{$reunionID}' ");
        }
    }
}

if ($msg)
    //echo '<script> alert("'.$msg.'"); </script>';
    alert($msg);


goto_url('./fee_list.php?'.$qstr);