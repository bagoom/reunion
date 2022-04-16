<?php
include_once("./_common.php");
include_once(G5_LIB_PATH."/register.lib.php");

if ($w == 'u')
    check_demo();

auth_check_menu($auth, $sub_menu, 'w');

check_admin_token();


$sql_common = " 
                 af_name = '{$af_name}',
                 reunion_id = '{$reunionID}'
                 ";

if ($w == '')
{
    sql_query(" INSERT INTO `affiliation` SET   {$sql_common} ");

}
else if ($_POST['act_button'] == "선택수정" && $w == 'u') 
{
    var_dump($_POST);
    for ($i=0; $i<count($_POST['chk']); $i++){
        // 실제 번호를 넘김
        $k = isset($_POST['chk'][$i]) ? (int) $_POST['chk'][$i] : 0;

        $post_af_name =  (isset($_POST['af_name'][$k]) && $_POST['af_name'][$k]) ? clean_xss_tags($_POST['af_name'][$k], 1, 1, 50) : '';

        $sql = " update `affiliation`
                    set af_name = '".sql_real_escape_string($post_af_name)."'
                    where af_id = '{$_POST['af_id'][$k]}' and reunion_id = '{$reunionID}' ";
        sql_query($sql);
        echo $sql;

    }
}else if ($_POST['act_button'] == "선택삭제") {
    for ($i=0; $i<count($_POST['chk']); $i++)
        {
            // 실제 번호를 넘김
            $k = isset($_POST['chk'][$i]) ? (int) $_POST['chk'][$i] : 0;

            sql_query("DELETE FROM `affiliation` WHERE af_id = '{$_POST['af_id'][$k]}' AND reunion_id = '{$reunionID}'");
        }

}
else
    alert('제대로 된 값이 넘어오지 않았습니다.');


goto_url('./affiliation.php?', false);