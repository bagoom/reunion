<?php
include_once('./_common.php');
include_once(G5_LIB_PATH . '/mailer.lib.php');

$site_mem = get_member($site_mb_id);
$site_mem['confirm'] = 'Y';
$site_mem['mb_new'] = '';

$site_mem_no = $site_mem['mb_no'];
$site_mem_email = $site_mem['mb_email'];

array_splice($site_mem, 0, 1);
$site_mem = array_filter($site_mem);
array_walk($site_mem, function(&$value, $key) {
    $value = "{$key}='{$value}'";
});

$site_mem_values = implode(', ', $site_mem);

// print_r($site_mem_values);

// 회원가입한 회원의 정보는 미리 DELETE
$sql = "DELETE FROM {$g5['member_table']} WHERE mb_no = '{$site_mem_no}'";
sql_query($sql);

// 동문회원정보에 회원가입한 회원의 정보를 UPDATE
$sql = "UPDATE {$g5['member_table']} SET {$site_mem_values} WHERE mb_no = '{$reunion_mb_id}'";
// echo $sql;
sql_query($sql);

$subject = "[".$reunion['reunion_title']."] 회원 가입이 완료 되었습니다.";

$content  = "
<div style='margin:30px auto;width:600px;border:10px solid #f7f7f7'>
    <div style=''>
        <h1 style='margin:0; padding:30px 30px 0;background:#f7f7f7;color:#555;font-size:1.4em'>동문 인증 안내</h1>

        <span style='display:block;padding:10px 30px 30px;background:#f7f7f7;text-align:right'>
        <a href=".G5_URL." target='_blank'>".$reunion['reunion_title']."</a>
        </span>
        
        <p style='padding:30px 30px 30px;border-bottom:1px solid #eee;line-height:1.7em'>
        안녕하세요.<br>
        북일고등학교 총동문회 회원 가입이 완료 되었습니다.<br>
        가입하신 ID / PW 로 로그인 후 이용 가능합니다.<br><br>

        항상 우리 총동문회에 관심가져주셔서 감사합니다.
        </p>
        </div>

        <ul style='margin: 30px 0; padding-left: 40px;'> 
            <li>해당 메일은 <b>우리반넷</b> 시스템에서 자동발송되는 메일입니다.</li> 
            <li>본 메일은 발신 전용이므로, 회신 내용을 확인할 수 없습니다.</li> 
            <li>문의 사항은 우리학교 동문회 사무국으로 문의하시기 바랍니다.</li> 
        </ul>
</div>
";

$config['cf_admin_email_name'] = $reunion['reunion_title'];

mailer($config['cf_admin_email_name'], $config['cf_admin_email'], $site_mem_email, $subject, $content, 1);
