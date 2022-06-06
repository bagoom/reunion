<?php
// error_reporting( E_ALL );
// ini_set( "display_errors", 1 );
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
    $branch_id = sql_insert_id();

    @mkdir(G5_DATA_PATH."/branch", G5_DIR_PERMISSION);
    @chmod(G5_DATA_PATH."/branch", G5_DIR_PERMISSION);
    if(isset($_FILES['branch_img']['name'])){
        $image_name = $_FILES['branch_img']['name'];
        // echo $image_name;
        $valid_extensions = array("jpg","jpeg","png", "gif");
        $extension = pathinfo($image_name, PATHINFO_EXTENSION);
        if(in_array($extension, $valid_extensions)){
            $upload_path = G5_DATA_PATH."/branch/".$branch_id;
            @mkdir($upload_path, G5_DIR_PERMISSION);
            @chmod($upload_path, G5_DIR_PERMISSION);
            $img_url = "/branch/".$branch_id."/cover.".$extension."?v=".time();
            
            if(upload_file($_FILES['branch_img']['tmp_name'], "cover.".$extension, $upload_path)){
                $image = $upload_path;
            }else{
                alert('이미지 업로드중 에러가 발생하였습니다.');
            }
        }
        else{
            alert('이미지 파일만 업로드 하여 주십시오.');
        }
    }
    sql_query("UPDATE {$g5['branch']} SET branch_img = '{$img_url}' WHERE branch_id = '{$branch_id}' ");
}
else if ($w == 'u')
{
    @mkdir(G5_DATA_PATH."/branch", G5_DIR_PERMISSION);
    @chmod(G5_DATA_PATH."/branch", G5_DIR_PERMISSION);
    var_dump(empty($_FILES['branch_img']['name']));
    if(!empty($_FILES['branch_img']['name'])){
        $image_name = $_FILES['branch_img']['name'];
        // echo $image_name;
        $valid_extensions = array("jpg","jpeg","png", "gif", "JPG");
        $extension = pathinfo($image_name, PATHINFO_EXTENSION);
        if(in_array($extension, $valid_extensions)){
            $upload_path = G5_DATA_PATH."/branch/".$branch_id;
            @mkdir($upload_path, G5_DIR_PERMISSION);
            @chmod($upload_path, G5_DIR_PERMISSION);
            $img_url = "/branch/".$branch_id."/cover.".$extension."?v=".time();
            
            if(upload_file($_FILES['branch_img']['tmp_name'], "cover.".$extension, $upload_path)){
                $image = $upload_path;
            }else{
                alert('이미지 업로드중 에러가 발생하였습니다.');
            }
        }
        else{
            alert('이미지 파일만 업로드 하여 주십시오.');
        }
        $sql = " update {$g5['branch']}
                    set branch_img = '{$img_url}' where branch_id = '{$branch_id}' AND reunion_id = '{$reunionID}' ";
                    sql_query($sql);
        }
                
        $sql = " update {$g5['branch']}
                    set {$sql_common} where branch_id = '{$branch_id}' AND reunion_id = '{$reunionID}'";
                    sql_query($sql);
}
else
    alert('제대로 된 값이 넘어오지 않았습니다.');


goto_url('./branch_form.php?branch_id='.$branch_id.'&w=u', false);