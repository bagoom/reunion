<?php
$sub_menu = "200100";
include_once('./_common.php');

check_demo();

auth_check_menu($auth, $sub_menu, 'w');

check_admin_token();

$mb_datas = array();
$msg = '';

if ($w == 'd') {
        // 실제 번호를 넘김
         $mb = get_member($_GET['mb_id']);
        
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
            member_delete($mb['mb_id']);
            $msg = $mb['mb_name'].'회원의 동문인증을 취소 하였습니다.';
        }
}

if ($msg)
    //echo '<script> alert("'.$msg.'"); </script>';
    alert($msg);

run_event('admin_member_list_update', $_POST['act_button'], $mb_datas);

goto_url('./new_member.php?'.$qstr);