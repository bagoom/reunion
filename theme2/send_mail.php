<?php
include './_common.php';
include_once(G5_LIB_PATH . '/mailer.lib.php');
// $array_phone = array($_POST['i_tel1'], $_POST['i_tel2'], $_POST['i_tel3']);
// $i_phone = ($_POST['i_tel1']) ? implode("-", $array_phone) : "";



// DB 데이터 입력
// $query = "INSERT INTO `contact`
// 				 SET ct_name = '$co_name',
// 				 	 ct_phone = '$co_phone', 
// 				 	 ct_email = '$co_email', 
// 				 	 ct_content = '$co_message',
// 					 ct_date = '" . G5_TIME_YMDHIS . "'
// 					 ";
// sql_query($query);

// https://drive.google.com/uc?export=download&id=파일명
$content  = "
<div style='background:#f8f8f9; padding: 30px;'>
    <div style='width: 400px; margin: 0 auto; background: #fff; box-shadow: 0 3px 3px rgba(0,0,0,0.1);'>
    <h3 style='margin-top:15px; padding:0 30px 15px; color:#144f87; border-bottom: 1px solid #eee; font-size: 30px; font-family: NanumGothic,Malgun Gothic; font-weight: 400; letter-spacing: -0.05em; text-align: center'>메일발송테스트</h3>
    </div>
</div>
";

$system_email = "contact@wooribannet.com"; // 
mailer($config['cf_title'], $system_email, 'graum-dev2@daum.net',   'test 님이 메일을 발송하였습니다.', $content, 1);
// echo json_encode($data);
