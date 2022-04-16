<?php
@set_time_limit(0);
$gmnow = gmdate('D, d M Y H:i:s') . ' GMT';
header('Expires: 0'); // rfc2616 - Section 14.21
header('Last-Modified: ' . $gmnow);
header('Cache-Control: no-store, no-cache, must-revalidate'); // HTTP/1.1
header('Cache-Control: pre-check=0, post-check=0, max-age=0'); // HTTP/1.1
header('Pragma: no-cache'); // HTTP/1.0
@header('Content-Type: text/html; charset=utf-8');
@header('X-Robots-Tag: noindex');

$g5_path['path'] = '..';
include_once ('../config.php');
include_once ('../lib/common.lib.php');
include_once('./install.function.php');    // 인스톨 과정 함수 모음

include_once('../lib/hook.lib.php');    // hook 함수 파일
include_once('../lib/get_data.lib.php');    
include_once('../lib/uri.lib.php');    // URL 함수 파일
include_once('../lib/cache.lib.php');
    error_reporting(E_ALL);
    ini_set('display_errors', '1');

$reunion_title  = isset($_POST['reunion_title']) ? safe_install_string_check($_POST['reunion_title']) : '';
$mg_id  = isset($_POST['mg_id']) ? safe_install_string_check($_POST['mg_id']) : '';
$mg_pass  = isset($_POST['mg_pass']) ? safe_install_string_check($_POST['mg_pass']) : '';
$mg_name    = isset($_POST['mg_name']) ? safe_install_string_check($_POST['mg_name']) : '';
$position    = isset($_POST['position']) ? $_POST['position'] : '';
$mg_hp  = isset($_POST['mg_hp']) ? $_POST['mg_hp'] : '';
$mg_email  = isset($_POST['mg_email']) ? $_POST['mg_email'] : '';


if (preg_match("/[^0-9a-z_]+/i", $mg_id)) {
    die('<div class="ins_inner"><p>아이디는 영문자, 숫자, _ 만 입력하세요.</p><div class="inner_btn"><a href="./install_config.php">뒤로가기</a></div></div>');
}

$mysql_host = 'localhost';
$mysql_user = 'nayoo_share';
$mysql_pass = 'hong5044';
$mysql_db = 'nayoo_share';
// $mysql_host = '127.0.0.1';
// $mysql_user = 'root';
// $mysql_pass = 'dnwls1127';
// $mysql_db = 'reunion';

$dblink = sql_connect($mysql_host, $mysql_user, $mysql_pass, $mysql_db);
if (!$dblink) {
?>

<div class="ins_inner">
    <p>MySQL Host, User, Password 를 확인해 주십시오.</p>
    <div class="inner_btn"><a href="./install_config.php">뒤로가기</a></div>
</div>

<?php
    include_once ('./install.inc2.php');
    exit;
}
?>

<?php
    $sql = " INSERT INTO `reunion` SET reunion_title = '$reunion_title', manager= '$mg_id', affiliation ='{$affiliation}' ";
    sql_query($sql , true, $dblink);
    $reunion_id = sql_insert_id($dblink);


    $sql2 = " INSERT INTO `manager` SET 
                reunion_id = '{$reunion_id}',
                mg_id = '{$mg_id}',
                 mg_pass = '".get_encrypt_string($mg_pass)."',
                 mg_name = '{$mg_name}',
                 position = '{$position}',
                 mg_hp = '{$mg_hp}',
                 mg_email = '{$mg_email}',
                 rights = 'supervisor'
    ";
    
    sql_query($sql2,  true, $dblink);

?>
<?php
$file = '../'.G5_DATA_DIR.'/'.REUNIONCONFIG_FILE;
$f = @fopen($file, 'a');
fwrite($f, "<?php\n");
fwrite($f, "if (!defined('_GNUBOARD_')) exit;\n");
fwrite($f, "?>");
fclose($f);
@chmod($file, G5_FILE_PERMISSION);

$file = '../config.php';
$f = @fopen($file, 'a');
fwrite($f, "\n<?php\n");
fwrite($f, "\$reunionID = {$reunion_id}\n");
fwrite($f, "?>");

fclose($f);
@chmod($file, G5_FILE_PERMISSION);
?>


<link rel="stylesheet" href="install.css">
    

<div class="ins_inner" style="margin-top: 50px;">
    <p> 동창회 생성이 완료되었습니다.</p>
    <div class="inner_btn">
        <a href="../index.php">메인페이지로 이동</a>
    </div>
</div>
