<?php

define("GOOGLE_API_KEY", "AAAAHAx_ZSY:APA91bHwSXxcYKVHar5rBIjkKSlpNGH8JeBXWTLUmYUosuOOfXpGsRKGVCifF-GJ7LQB8URhvtqsxYFuAV-bhLP7Kfu-G_OHV8PgRnJKu4YeVXvDfELp7_Ffbr7wz3buRDHkS_fz11Lx");
define("GOOGLE_GCM_URL", "https://fcm.googleapis.com/fcm/send");

function send_gcm_notify($reg_id, $title, $message ,$url , $deviceType) {

	$fields;
	if($deviceType == 'android'){
		//android
		$fields = array(
			'registration_ids'  => array( $reg_id ),
			'data'              => array( "msg" => $message ,"title" => $title , "url" => $url ),
		);
	}else{
		//ios
		$fields = array(
			 'registration_ids'  => array( $reg_id ),
			 'mutable_content'=> true,
			 'url'=> $url,
			 'notification' => array( "subtitle" => $message ,
									  "title" => "알림"  ,
									  "url" => $url  ,
									  'push_message'=> $message,

									  'sound'=>'Default',
									  "body" => $message )
		);
	}

    $headers = array(
        'Authorization: key=AAAAHAx_ZSY:APA91bHwSXxcYKVHar5rBIjkKSlpNGH8JeBXWTLUmYUosuOOfXpGsRKGVCifF-GJ7LQB8URhvtqsxYFuAV-bhLP7Kfu-G_OHV8PgRnJKu4YeVXvDfELp7_Ffbr7wz3buRDHkS_fz11Lx',
        'Content-Type: application/json'
    );

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, GOOGLE_GCM_URL);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fields));

    $result = curl_exec($ch);
    if ($result === FALSE) {
        die('Problem occurred: ' . curl_error($ch));
    }

    curl_close($ch);
    echo $result;
 }

$reg_id = "dJe3PWPtPV0:APA91bG0ItssiOXzxwEN3Rl-gL-i9xRZKrK7PDCPDt3xSnwOgx-kCl5MKjyk93a87FlqPueien9vCSdAvbHgi0mPIUK9ogMrwpGfuleA7ANFmUYQ8tSCVkjJ85U2olteG2oGt3Sf9ZRN";				//푸시 보낼 디바이스 토큰
$title = "상단타이틀제목";				//푸시 title 문구
$msg = "테스트입니다..";				//푸시 body 문구
$url = "";	//푸시클릭시 이동할 url 주소
$deviceType = "android";			//디바이스 타입 : android or ios

//http://snap40.cafe24.com/fanc/push_sample.php

send_gcm_notify($reg_id, $title,  $msg , $url , $deviceType);
?>
