<?php
$sub_menu = "200100";
include_once('./_common.php');
include_once(G5_LIB_PATH . '/mailer.lib.php');

check_demo();

auth_check_menu($auth, $sub_menu, 'w');

check_admin_token();

$mb_datas = array();
$msg = '';
// 실제 번호를 넘김
$mb = get_member($_GET['mb_id']);

if ($w == 'd') {
        
        if (!$mb['mb_id']) {
            $msg .= $mb['mb_name'].' : 회원자료가 존재하지 않습니다.\\n';
        } else if ($member['mb_no'] == $mb['mb_no']) {
            $msg .= $mb['mb_name'].' : 로그인 중인 관리자는 삭제 할 수 없습니다.\\n';
        } else if (is_admin($mb['mb_no']) == 'super') {
            $msg .= $mb['mb_name'].' : 최고 관리자는 삭제할 수 없습니다.\\n';
        } else if ($is_admin != 'super' && $mb['mb_level'] >= $member['mb_level']) {
            $msg .= $mb['mb_name'].' : 자신보다 권한이 높거나 같은 회원은 삭제할 수 없습니다.\\n';
        } else {
            // 회원자료 삭제
            member_delete($mb['mb_id']);
            $msg = $mb['mb_name'].'회원의 동문인증을 취소 하였습니다.';
        }
}



$subject = "[".$reunion['reunion_title']."] 동문 인증이 확인되지 않았습니다.";

$content  = "
<div style='margin:30px auto;width:600px;border:10px solid #f7f7f7'>
    <div style=''>
        <h1 style='margin:0; padding:30px 30px 0;background:#f7f7f7;color:#555;font-size:1.4em'>동문 인증 안내</h1>

        <span style='display:block;padding:10px 30px 30px;background:#f7f7f7;text-align:right'>
        <a href=".G5_URL." target='_blank'>".$reunion['reunion_title']."</a>
        </span>
        
        <p style='padding:30px 30px 30px;border-bottom:1px solid #eee;line-height:1.7em'>
            죄송합니다.<br>
            동문님 정보가 확인되지 않습니다.<br>
            정확한 정보로 다시 회원 가입해 주시기 바랍니다.<br><br>

            계속 인증이 안 될 경우 동문회 사무국으로 문의 바랍니다.
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

mailer($config['cf_admin_email_name'], $config['cf_admin_email'], $mb['mb_email'], $subject, $content, 1);

if ($msg)
    //echo '<script> alert("'.$msg.'"); </script>';
    alert($msg);

run_event('admin_member_list_update', $_POST['act_button'], $mb_datas);

goto_url('./new_member.php?'.$qstr);