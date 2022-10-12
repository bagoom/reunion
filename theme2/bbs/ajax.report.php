<?php
include_once('./_common.php');

$result = array('error'=>false);
$mode = '';

if($_POST['mode'] == 'article'){
    $mb_id = $member['mb_id'];
    $reason = $etc_reason ? "기타 : " .$etc_reason : $report_reason;

    $sql = "INSERT INTO `report_write` SET 
        reunion_id = '{$reunionID}',
        mb_id = '{$mb_id}',
        bo_table = '{$bo_table}', 
        wr_id = '{$wr_id}', 
        reason = '{$reason}',
        datetime = '".G5_TIME_YMDHIS."' "
    ;

    $query = sql_query($sql);

    $result['sql'] = $sql;

    if($query){
        $result['status'] = "ok";
        $result['message'] = "게시글이 신고 되었습니다.";
    }
    else{
        $result['status'] = "fail";
        $result['error'] = true;
        $result['message'] = "처리중 에러가 발생하였습니다.\n관리자에게 문의 해주세요.";
    }
}


if($_POST['mode'] == 'user'){
    $mb_id = $member['mb_id'];
    $reason = $etc_reason ? "기타 : " .$etc_reason : $report_reason;

    $sql = "INSERT INTO `report_user` SET 
        reunion_id = '{$reunionID}',
        mb_id = '{$mb_id}',
        mb_to_id = '{$mb_to_id}',
        reason = '{$reason}',
        datetime = '".G5_TIME_YMDHIS."',
        undeny_datetime = '0000-00-00 00:00:00' "
    ;

    $query = sql_query($sql);

    $result['sql'] = $sql;

    if($query){
        $result['status'] = "ok";
        $result['message'] = "불량사용자로 신고 되었습니다.";
    }
    else{
        $result['status'] = "fail";
        $result['error'] = true;
        $result['message'] = "처리중 에러가 발생하였습니다.\n관리자에게 문의 해주세요.";
    }
}


if($_POST['mode'] == 'comment'){
    $mb_id = $member['mb_id'];
    $reason = $etc_reason ? "기타 : " .$etc_reason : $report_reason;

    $sql = "INSERT INTO `report_comment` SET 
        reunion_id = '{$reunionID}',
        mb_id = '{$mb_id}',
        mb_to_id = '{$mb_to_id}',
        bo_table = '{$bo_table}', 
        wr_parent = '{$wr_parent}', 
        wr_id = '{$wr_id}', 
        reason = '{$reason}',
        datetime = '".G5_TIME_YMDHIS."' "
    ;

    $query = sql_query($sql);

    $result['sql'] = $sql;

    if($query){
        $result['status'] = "ok";
        $result['message'] = "댓글이 신고 되었습니다.";
    }
    else{
        $result['status'] = "fail";
        $result['error'] = true;
        $result['message'] = "처리중 에러가 발생하였습니다.\n관리자에게 문의 해주세요.";
    }
}



$result['post'] = $_POST;

echo json_encode($result);
