<?php
include_once("./_common.php");
include_once(G5_LIB_PATH."/register.lib.php");

if ($w == 'u')
    check_demo();

auth_check_menu($auth, $sub_menu, 'w');

check_admin_token();


$sql_common = " 
                 fd_name = '{$fd_name}',
                 reunion_id = '{$reunionID}'
                 ";

if ($w == '')
{
    sql_query(" INSERT INTO `fee_division` SET   {$sql_common} ");

}
else if ($_POST['act_button'] == "선택수정" && $w == 'u') 
{
    var_dump($_POST);
    for ($i=0; $i<count($_POST['chk']); $i++){
        // 실제 번호를 넘김
        $k = isset($_POST['chk'][$i]) ? (int) $_POST['chk'][$i] : 0;

        $post_fd_name =  (isset($_POST['fd_name'][$k]) && $_POST['fd_name'][$k]) ? clean_xss_tags($_POST['fd_name'][$k], 1, 1, 50) : '';
        $post_fd_price =  (isset($_POST['fd_price'][$k]) && $_POST['fd_price'][$k]) ? clean_xss_tags($_POST['fd_price'][$k], 1, 1, 50) : '';

        $sql = " update `fee_division`
                    set 
                    fd_name = '".sql_real_escape_string($post_fd_name)."',
                    fd_price = '".sql_real_escape_string($post_fd_price)."'
                    where fd_id = '{$_POST['fd_id'][$k]}' and reunion_id = '{$reunionID}' ";
        sql_query($sql);
        echo $sql;

    }
}else if ($_POST['act_button'] == "선택삭제") {
    for ($i=0; $i<count($_POST['chk']); $i++)
        {
            // 실제 번호를 넘김
            $k = isset($_POST['chk'][$i]) ? (int) $_POST['chk'][$i] : 0;

            // 회원데이터에 계열값이 들어있는지 확인
            $overlab = sql_fetch("SELECT count(*) as cnt from `fee` where fee_type = '{$fd_name[$k]}' AND reunion_id = $reunionID");
            if($overlab['cnt'] > 0){
                alert("회원 데이터가 있어 삭제 할 수 없습니다.");
                return false;
            }

            sql_query("DELETE FROM `fee_division` WHERE fd_id = '{$_POST['fd_id'][$k]}' AND reunion_id = '{$reunionID}' ");
        }

}
else
    alert('제대로 된 값이 넘어오지 않았습니다.');


goto_url('./fee_division.php?', false);