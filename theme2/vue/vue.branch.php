<?php 
include_once('./_common.php');


    $result = array('error'=>false);
    $action = '';


    if(isset($_GET['action'])){
        $action = $_GET['action'];
    }

    if($action == 'read'){
        $where = "1=1 ";
        if($mb_hp)
         $where .= "and mb_hp = '{$mb_hp}'";
        if($mb_name)
         $where .= "and mb_name = '{$mb_name}'";

         $where .= "and confirm = 'Y' and  reunion_id = '$reunionID'";

        $sql = sql_query("SELECT * FROM {$g5['member_table']} WHERE  $where ");
        $members = array();
        while($row = sql_fetch_array($sql)){
            $sql2 = sql_fetch("SELECT * FROM `branch_member` WHERE branch_id = '{$branch_id}' AND mb_id = '{$row['mb_id']}'");
            if(count($sql2) > 0){
                $merge_arr = array_merge($sql2, $row);
                array_push($members, $merge_arr);
            }else{
                $row['grade'] = "";
                array_push($members, $row);
            }
        }
        if(!$sql){
            $result['error'] = true;
            $result['message'] = "회원 목록을 불러오는데 실패하였습니다.";
        }
        $result['members'] = $members;
    }


    if($action == 'create'){
        $sql = sql_query("INSERT INTO `branch_member` SET 
            branch_id = '{$branch_id}',
            mb_id = '{$mb_id}',
            grade = '{$grade}', 
            etc = '{$etc}',
            reg_date = '".G5_TIME_YMD."' "
        );
        $al_id = sql_insert_id();
        $result['dddd'] = "INSERT INTO `branch_member` SET 
            branch_id = '{$branch_id}',
            grade = '{$grade}', 
            etc = '{$etc}'
            reg_date = '".G5_TIME_YMD."' ";
        if($sql){
            $result['message'] = "지회 회원을 추가하였습니다.";
        }
        else{
            $result['error'] = true;
            $result['message'] = "지회 회원 추가를 실패하였습니다.";
        }
    }


    if($action == 'update'){

        $result['post'] = $_POST;

        $sql = sql_query("UPDATE `branch_member` SET 
            grade = '{$grade}', 
            etc = '{$etc}'
            WHERE id = '{$id}'"
        );

        if($sql){
            $result['message'] = "회원 정보를 수정하였습니다.";
        }
        else{
            $result['error'] = true;
            $result['message'] = "'회원정보 수정을 실패하였습니다.";
        }
    }


    if($action == 'delete'){
        $sql = sql_query("DELETE FROM `album` WHERE al_id = '{$al_id}'");
        $sq2 = sql_query("DELETE FROM `songs` WHERE al_id = '{$al_id}'");
        $delete_folder = G5_DATA_PATH."/album/".$bo_table."/".$al_id;
        if(is_dir($delete_folder)){
            @rmdirAll($delete_folder);
        }

        if($sql){
            $result['message'] = "'{$al_title}' 앨범을 삭제 하였습니다.";
        }
        else{
            $result['error'] = true;
            $result['message'] = "'{$al_title}' 앨범삭제중 에러가 발생하였습니다.";
        }
    }


    $result['post'] = $_POST;
    echo json_encode($result);
    
?>