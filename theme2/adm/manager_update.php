<?php
include_once("./_common.php");
include_once(G5_LIB_PATH."/register.lib.php");

if ($w == 'u')
    check_demo();

auth_check_menu($auth, $sub_menu, 'w');

check_admin_token();


$sql_common = " 
                 reunion_id = '{$reunionID}',
                 mg_id = '{$mg_id}',
                 mg_pass = '".get_encrypt_string($mg_pass)."',
                 mg_name = '{$mg_name}',
                 position = '{$position}',
                 mg_hp = '{$mg_hp}',
                 mg_email = '{$mg_email}',
                 rights = 'manager'
                 ";

if ($w == '')
{
    if($mg_pass != $mg_pass_check)
        alert('비밀번호가 일치하지 않습니다.');

    sql_query(" INSERT INTO `manager` SET   {$sql_common} ");
}
else if ($_POST['act_button'] == "선택수정" && $w == 'u') 
{
    if($mg_pass != $mg_pass_check)
        alert('비밀번호가 일치하지 않습니다.');

    var_dump($_POST);
    for ($i=0; $i<count($_POST['chk']); $i++){
        // 실제 번호를 넘김
        $k = isset($_POST['chk'][$i]) ? (int) $_POST['chk'][$i] : 0;

        $post_mg_name =  (isset($_POST['mg_name'][$k]) && $_POST['mg_name'][$k]) ? clean_xss_tags($_POST['mg_name'][$k], 1, 1, 50) : '';
        $post_position =  (isset($_POST['position'][$k]) && $_POST['position'][$k]) ? clean_xss_tags($_POST['position'][$k], 1, 1, 50) : '';
        $post_mg_hp =  (isset($_POST['mg_hp'][$k]) && $_POST['mg_hp'][$k]) ? clean_xss_tags($_POST['mg_hp'][$k], 1, 1, 50) : '';
        $post_mg_email =  (isset($_POST['mg_email'][$k]) && $_POST['mg_email'][$k]) ? clean_xss_tags($_POST['mg_email'][$k], 1, 1, 50) : '';

        $sql = " update `manager`
                    set mg_pass = '".get_encrypt_string($mg_pass)."',
                    mg_name = '".sql_real_escape_string($mg_name)."',
                    position = '".sql_real_escape_string($post_position)."',
                    mg_hp = '".sql_real_escape_string($post_mg_hp)."',
                    mg_email = '".sql_real_escape_string($post_mg_email)."'
                 where mg_no = '{$_POST['mg_no'][$k]}' ";
        sql_query($sql);
        echo $sql;

    }
}else if ($_POST['act_button'] == "선택삭제") {
    for ($i=0; $i<count($_POST['chk']); $i++)
        {
            // 실제 번호를 넘김
            $k = isset($_POST['chk'][$i]) ? (int) $_POST['chk'][$i] : 0;

            sql_query("DELETE FROM `manager` WHERE mg_no = '{$_POST['mg_no'][$k]}' ");
        }

}
else
    alert('제대로 된 값이 넘어오지 않았습니다.');


goto_url('./manager.php?', false);