<?php
$sub_menu = "200100";
include_once("./_common.php");
include_once(G5_LIB_PATH."/register.lib.php");
include_once(G5_LIB_PATH.'/thumbnail.lib.php');

if ($w == 'u')
    check_demo();

auth_check_menu($auth, $sub_menu, 'w');

check_admin_token();

$mb_no = isset($_POST['mb_no']) ? trim($_POST['mb_no']) : '';
echo $mb_no."<br>";

$sql_common = "  fee_type = '{$fee_type}',
                 deposit_date = '{$deposit_date}',
                 fee = '{$fee}',
                 etc = '{$etc}' ";

if ($w == '')
{
    sql_query(" insert into {$g5['fee']} set mb_no = '{$mb_no}' , {$sql_common}, reunion_id = '{$reunionID}' ");
}
else if ($w == 'u')
{
    $sql = " update {$g5['fee']}
                set {$sql_common}
                where mb_no = '{$mb_no}' and id = '{$id}' ";
    sql_query($sql);
}
else
    alert('제대로 된 값이 넘어오지 않았습니다.');



goto_url('./fee_list.php?'.$qstr, false);