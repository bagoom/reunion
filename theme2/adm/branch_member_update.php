<?php
$sub_menu = "200100";
include_once('./_common.php');
include_once(G5_LIB_PATH . '/mailer.lib.php');

check_demo();

auth_check_menu($auth, $sub_menu, 'w');

check_admin_token();

$mb_datas = array();
$msg = '';
// 실제 번호를 넘김
$mb = get_member($_GET['mb_id']);

if ($w == 'd') {
        
        if (!$mb['mb_id']) {
            $msg .= $mb['mb_name'].' : 회원자료가 존재하지 않습니다.\\n';
        } else if ($member['mb_no'] == $mb['mb_no']) {
            $msg .= $mb['mb_name'].' : 로그인 중인 관리자는 삭제 할 수 없습니다.\\n';
        } else if (is_admin($mb['mb_no']) == 'super') {
            $msg .= $mb['mb_name'].' : 최고 관리자는 삭제할 수 없습니다.\\n';
        } else if ($is_admin != 'super' && $mb['mb_level'] >= $member['mb_level']) {
            $msg .= $mb['mb_name'].' : 자신보다 권한이 높거나 같은 회원은 삭제할 수 없습니다.\\n';
        } else {
            // 회원자료 삭제
            sql_query("DELETE FROM {$g5['branch_member']} WHERE mb_no = '{$mb['mb_no']}' ");
            $msg = $mb['mb_name'].'회원이 해당 지회에서 탈퇴 처리 되었습니다.';
        }
}




if ($msg)
    //echo '<script> alert("'.$msg.'"); </script>';
    alert($msg);


goto_url('./branch_form.php?'.$qstr);