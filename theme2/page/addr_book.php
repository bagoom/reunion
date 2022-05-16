<?php
include_once('./_common.php');
$g5['title'] = '동문 주소록';
include_once(G5_PATH.'/head.php');


$count = sql_fetch( "SELECT count(*) AS num FROM {$g5['member_table']} WHERE mb_id != 'admin' AND reunion_id = $reunionID " );
$count2 = $count['num'];
function EmailMasking($str){ // 수정 보완 필요
    $pattern = '/(\w+)(\w{3})(@.{1})(?=.*?\.)(.+)/i';
    $replace = '\1***\3*\5';
    $str = preg_replace('/(\w+)(\w{3})(@.{1})([\w*?]+)(.+)/i','\1***\3*\5',$str);
    return $str;
}

function setMasking($obj) {
    $result = "";
    $strLen = mb_strlen($obj);

    switch($strLen) {
        case 12 : $result = preg_replace('/([0-9]+)-([0-9]+)-([0-9]{4})/', '${1}-***-$3', $obj); break;
        case 13 : $result = preg_replace('/([0-9]+)-([0-9]+)-([0-9]{4})/', '${1}-****-$3', $obj); break;
        default : $result = preg_replace('/([0-9]+)-([0-9]+)-([0-9]{4})/', '${1}-****-$3', $obj); break;
    }

    return $result;
}
if (!$sst) {
    $sst = "mb_no";
    $sod = "desc";
}

$sql_order = " order by {$sst} {$sod} ";

$total_count = $count2;

// $rows = $config['cf_page_rows'];
$rows = 30;
$total_page  = ceil($total_count / $rows);  // 전체 페이지 계산
if ($page < 1) $page = 1; // 페이지가 없으면 첫 페이지 (1 페이지)
$from_record = ($page - 1) * $rows; // 시작 열을 구함

$sql = "SELECT * FROM {$g5['member_table']} WHERE mb_id != 'admin' AND reunion_id = $reunionID $sql_order limit {$from_record}, {$rows} ";
$result = sql_query($sql);

?>

<link rel="stylesheet" href="<?=G5_CSS_URL?>/addr_book.css">

<div class="cont addr_book">

    <div class="box">
        <div class="rel_table">
            <div class="tables">
                <ul class="tables_th font-b">
                    <li class="pa_year">기수</li>
                    <li class="pa_name">이름</li>
                    <li class="pa_tel">대표전화</li>
                    <li class="pa_address">주소</li>
                    <li class="pa_time">이메일</li>
                    <li class="pa_name">소속지회명</li>
                    <li class="pa_link">메일 보내기</li>
                </ul>
                <?php for($i=0; $row=sql_fetch_array($result); $i++) { ?>
                <ul class="tables_td">
                    <li class="pa_year"><?= ($row['graduation_year']) ?  $row['graduation_year']  : "-" ?></li>
                    <li class="pa_name"><?=($row['mb_name']) ? $row['mb_name'] : "-" ?></li>
                    <li class="pa_tel"><?=($row['mb_hp']) ? setMasking($row['mb_hp']) : "-" ?></li>
                    <li class="pa_address"><?=($row['mb_addr1']) ? "Y" : "-" ?></li>
                    <li class="pa_time"><?=($row['mb_email']) ? EmailMasking($row['mb_email']) : "-" ?></li>
                    <li class="pa_name"><?=($row['ddd']) ? EmailMasking($row['ddd']) : "-" ?></li>
                    <li class="pa_link">
                        <?php if($row['mb_email']) { ?>
                        <a href="mailto:<?php echo $row['mb_email'] ?>" target="_blank" class="link_ico">
                            <i class="xi-mail"></i>
                        </a>
                        <?php }?>
                    </li>
                </ul>

                <?php } ?>
                <?php if (count($count2) == 0) { echo '<ul class="tables_td" style="text-align:center">등록된 회원이 없습니다.</ul>'; } ?>

            </div>
        </div>
        <?php echo get_paging(G5_IS_MOBILE ? $config['cf_mobile_pages'] : $config['cf_write_pages'], $page, $total_page, '?'.$qstr.'&amp;page='); ?>
    </div>


<?php
include_once(G5_PATH.'/tail.php');
?>