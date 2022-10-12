<?php
$sub_menu = "200100";
include_once('./_common.php');

check_demo();

auth_check_menu($auth, $sub_menu, 'w');

check_admin_token();



if($mode == 'user'){
    $sql = "DELETE FROM `report_user` WHERE rp_id = '{$rp_id}' ";
    sql_query($sql);
    alert("신고가 해제 되었습니다.");
}

if($mode == 'article'){
    $sql = "DELETE FROM `report_write` WHERE rp_id = '{$rp_id}' ";
    sql_query($sql);
    alert("신고가 해제 되었습니다.");
}

if($mode == 'comment'){
    $sql = "DELETE FROM `report_comment` WHERE rp_id = '{$rp_id}' ";
    sql_query($sql);
    alert("신고가 해제 되었습니다.");
}




// goto_url('./report_list'.$sub_num.'.php?'.$qstr);