<?php
$sub_menu = "300100";
include_once("./_common.php");
include_once(G5_LIB_PATH."/register.lib.php");

if ($w == 'u')
    check_demo();

auth_check_menu($auth, $sub_menu, 'w');

check_admin_token();


$sql_common = "  type = '{$type}',
                 branch_name = '{$branch_name}',
                 status = '{$status}',
                 branch_content = '{$branch_content}' ";

if ($w == '')
{
    sql_query(" insert into {$g5['branch']} set create_date = '".G5_TIME_YMDHIS."' ,  {$sql_common} , reunion_id = '{$reunionID}' ");
}
else if ($w == 'u')
{
    $sql = " update {$g5['branch']}
                set {$sql_common}
                where branch_id = '{$branch_id}' ";
    sql_query($sql);
    // echo $sql;
}
else
    alert('제대로 된 값이 넘어오지 않았습니다.');


goto_url('./branch_list.php?', false);