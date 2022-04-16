<?php
$gmnow = gmdate('D, d M Y H:i:s').' GMT';
header('Expires: 0'); // rfc2616 - Section 14.21
header('Last-Modified: ' . $gmnow);
header('Cache-Control: no-store, no-cache, must-revalidate'); // HTTP/1.1
header('Cache-Control: pre-check=0, post-check=0, max-age=0'); // HTTP/1.1
header('Pragma: no-cache'); // HTTP/1.0
@header('Content-Type: text/html; charset=utf-8');
@header('X-Robots-Tag: noindex');

$g5_path['path'] = '..';
include_once ('../config.php');
$title = G5_VERSION." 초기환경설정 2/3";


$tmp_str = isset($_SERVER['SERVER_SOFTWARE']) ? $_SERVER['SERVER_SOFTWARE'] : '';
$ajax_token = md5($tmp_str.$_SERVER['REMOTE_ADDR'].dirname(dirname(__FILE__).'/'));
?>
<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/gh/orioncactus/pretendard/dist/web/static/pretendard.css">
<link rel="stylesheet" href="install.css">
<style>
    input[type="text"]{
        height: 30px;
        padding-left: 10px;
    }
</style>
<form id="frm_install" method="post" action="./install_reunion_update.php" autocomplete="off" onsubmit="return frm_install_submit(this)" style="margin-top: 50px">

    <div class="ins_inner">
    <h1>동창회 생성</h1>
        <table class="ins_frm">
            <caption>동창회 생성을 위한 정보입력</caption>
            <input type="hidden" name="ajax_token" value="<?php echo $ajax_token; ?>">
            <colgroup>
                <col style="width:150px">
                <col>
            </colgroup>
            <tbody>
                <tr>
                    <th scope="row"><label for="reunion_title">동창회 제목</label></th>
                    <td>
                        <input name="reunion_title" type="text" value="" id="reunion_title">
                    </td>
                </tr>
                <tr>
                    <th scope="row"><label for="affiliation">동창회 구분</label></th>
                    <td>
                        <select name="affiliation" id="affiliation">
                            <option value="대학교">대학교</option>
                            <option value="고등학교">고등학교</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <th scope="row"><label for="mg_id">관리자 ID</label></th>
                    <td>
                        <input name="mg_id" type="text" value="" id="mg_id">
                    </td>
                </tr>
                <tr>
                    <th scope="row"><label for="mg_pass">관리자 비밀번호</label></th>
                    <td>
                        <input name="mg_pass" type="text" id="mg_pass">
                    </td>
                </tr>
                <tr>
                    <th scope="row"><label for="mg_name">이름</label></th>
                    <td>
                        <input name="mg_name" type="text" value="" id="mg_name">
                    </td>
                </tr>
                <tr>
                    <th scope="row"><label for="position">직급</label></th>
                    <td>
                        <input name="position" type="text" value="" id="position">
                    </td>
                </tr>
                <tr>
                    <th scope="row"><label for="mg_hp">전화번호</label></th>
                    <td>
                        <input name="mg_hp" type="text" value="" id="mg_hp">
                    </td>
                </tr>
                <tr>
                    <th scope="row"><label for="mg_email">E-mail</label></th>
                    <td>
                        <input name="mg_email" type="text" value="" id="mg_email">
                    </td>
                </tr>
            </tbody>
        </table>

        <!-- <p>
            <strong class="st_strong">주의! 이미 <?php echo G5_VERSION ?>가 존재한다면 DB 자료가 망실되므로 주의하십시오.</strong><br>
            주의사항을 이해했으며, 그누보드 설치를 계속 진행하시려면 다음을 누르십시오.
        </p> -->

        <div class="inner_btn">
            <input type="submit" value="다음">
        </div>
    </div>

    <script src="../js/jquery-1.8.3.min.js"></script>
    <script>
        function frm_install_submit(f) {
            if (f.reunion_title.value == '') {
                alert('동창회 제목을 입력하십시오.');
                f.mysql_host.focus();
                return false;
            } else if (f.mg_id.value == '') {
                alert('관리자 ID 를 입력하십시오.');
                f.mg_id.focus();
                return false;
            } else if (f.mg_pass.value == '') {
                alert('관리자 비밀번호를 입력하십시오.');
                f.mg_pass.focus();
                return false;
            } else if (f.mg_name.value == '') {
                alert('관리자 이름을 입력하십시오.');
                f.mg_name.focus();
                return false;
            } else if (f.position.value == '') {
                alert('직급을 입력하십시오.');
                f.position.focus();
                return false;
            } else if (f.mg_hp.value == '') {
                alert('전화번호를 입력하십시오.');
                f.mg_hp.focus();
                return false;
            } else if (f.mg_email.value == '') {
                alert('관리자 E-mail 을 입력하십시오.');
                f.mg_email.focus();
                return false;
            }

            var reg = /\);(passthru|eval|pcntl_exec|exec|system|popen|fopen|fsockopen|file|file_get_contents|readfile|unlink|include|include_once|require|require_once)\s?\(\$_(get|post|request)\s?\[.*?\]\s?\)/gi;
            var reg_msg = " 에 유효하지 않는 문자가 있습니다. 다른 문자로 대체해 주세요.";

            if (reg.test(f.reunion_title.value)) {
                alert('동창회 제목' + reg_msg);
                f.reunion_title.focus();
                return false;
            }

            if (reg.test(f.mg_id.value)) {
                alert('관리자 ID' + reg_msg);
                f.mg_id.focus();
                return false;
            }

            if (f.mg_pass.value && reg.test(f.mg_pass.value)) {
                alert('관리자 비밀번호' + reg_msg);
                f.mg_pass.focus();
                return false;
            }

            if (reg.test(f.mg_name.value)) {
                alert('관리자이름' + reg_msg);
                f.mg_name.focus();
                return false;
            }
            if (reg.test(f.position.value)) {
                alert('직급' + reg_msg);
                f.position.focus();
                return false;
            }
            if (reg.test(f.mg_hp.value)) {
                alert('전화번호' + reg_msg);
                f.mg_hp.focus();
                return false;
            }
            if (reg.test(f.mg_email.value)) {
                alert('이메일' + reg_msg);
                f.mg_email.focus();
                return false;
            }

            if (/^[a-z]+[a-z0-9]{2,19}$/i.test(f.mg_id.value) == false) {
                alert('관리자 회원 ID는 첫자는 반드시 영문자 그리고 영문자와 숫자로만 만드셔야 합니다.');
                f.mg_id.focus();
                return false;
            }


            // return true;
        }
    </script>
