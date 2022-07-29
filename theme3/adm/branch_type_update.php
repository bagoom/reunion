<?php
include_once("./_common.php");
include_once(G5_LIB_PATH."/register.lib.php");

if ($w == 'u')
    check_demo();

auth_check_menu($auth, $sub_menu, 'w');

check_admin_token();


$sql_common = " 
                 bt_name = '{$bt_name}',
                 reunion_id = '{$reunionID}'
                 ";

if ($w == '')
{
    sql_query(" INSERT INTO `branch_type` SET   {$sql_common} ");

}
else if ($_POST['act_button'] == "선택수정" && $w == 'u') 
{
    var_dump($_POST);
    for ($i=0; $i<count($_POST['chk']); $i++){
        // 실제 번호를 넘김
        $k = isset($_POST['chk'][$i]) ? (int) $_POST['chk'][$i] : 0;

        $post_fd_name =  (isset($_POST['bt_name'][$k]) && $_POST['bt_name'][$k]) ? clean_xss_tags($_POST['bt_name'][$k], 1, 1, 50) : '';

        $sql = " update `branch_type`
                    set bt_name = '".sql_real_escape_string($post_fd_name)."'
                    where bt_id = '{$_POST['bt_id'][$k]}' and reunion_id = '{$reunionID}' ";
        sql_query($sql);
        echo $sql;

    }
}else if ($_POST['act_button'] == "선택삭제") {
    for ($i=0; $i<count($_POST['chk']); $i++)
        {
            // 실제 번호를 넘김
            $k = isset($_POST['chk'][$i]) ? (int) $_POST['chk'][$i] : 0;

            // 회원데이터에 계열값이 들어있는지 확인
            $overlab = sql_fetch("SELECT count(*) as cnt from {$g5['branch']} where type = '{$bt_name[$k]}' AND reunion_id = $reunionID");
            if($overlab['cnt'] > 0){
                alert("회원 데이터가 있어 삭제 할 수 없습니다.");
                return false;
            }

            sql_query("DELETE FROM `branch_type` WHERE bt_id = '{$_POST['bt_id'][$k]}' AND reunion_id = '{$reunionID}' ");
        }

}
else
    alert('제대로 된 값이 넘어오지 않았습니다.');


goto_url('./branch_type.php?', false);