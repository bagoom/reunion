<?php
$sub_menu = "9920000";
include_once('./_common.php');

auth_check_menu($auth, $sub_menu, 'r');
$g5['title'] = '신고내역';
$sub_num = '2';
include_once('./report.sub.php');
$sql_common = " from report_write ";

$where = "WHERE reunion_id = '{$reunionID}'";
if (!$sst) {
    $sst = "rp_id";
    $sod = "desc";
}

$sql_order = " order by {$sst} {$sod} ";
$sql = " select count(*) as cnt {$sql_common}  {$where} {$sql_order} ";
$row = sql_fetch($sql);
$total_count = $row['cnt'];

// $rows = $config['cf_page_rows'];
$rows = 30;
$total_page  = ceil($total_count / $rows);  // 전체 페이지 계산
if ($page < 1) $page = 1; // 페이지가 없으면 첫 페이지 (1 페이지)
$from_record = ($page - 1) * $rows; // 시작 열을 구함 

$listall = '<a href="'.$_SERVER['SCRIPT_NAME'].'" class="ov_listall">전체목록</a>';



$sql = " select * {$sql_common}  {$where} {$sql_order} limit {$from_record}, {$rows} ";
$result = sql_query($sql);
$colspan = 8;

$q = $_SERVER['QUERY_STRING']; 
?>

<style>
    .tbl_head01 tbody td{
        cursor: unset !important;
    }
</style>
<form name="fmemberlist" id="fmemberlist" action="./new_member_update.php" onsubmit="return fmemberlist_submit(this);" method="post">
<input type="hidden" name="sst" value="<?php echo $sst ?>">
<input type="hidden" name="sod" value="<?php echo $sod ?>">
<input type="hidden" name="sfl" value="<?php echo $sfl ?>">
<input type="hidden" name="stx" value="<?php echo $stx ?>">
<input type="hidden" name="page" value="<?php echo $page ?>">
<input type="hidden" name="token" value="">


<div class="tbl_head01 tbl_wrap new_mem">
    <table>
    <caption><?php echo $g5['title']; ?> 목록</caption>
    <thead>
    <tr>
        <th scope="col">번호</th>
        <th scope="col">신고날짜</th>
        <th scope="col">신고자</th>
        <th scope="col">작성자</th>
        <th scope="col">신고 내용</th> 
        <th scope="col">신고글</th>
        <th scope="col">비고</th>
    </tr>
    </thead>
    <tbody>
    <?php
    for ($i=0; $row=sql_fetch_array($result); $i++) { 
        $mb = get_member($row['mb_id']);
        $bo_table = "g5_write_".$row['bo_table'];
        $reported_mb = sql_fetch("SELECT wr_name FROM $bo_table WHERE wr_id = $row[wr_id]");
        ?>

    <tr class="<?php echo $bg; ?>" >
        <td >
            <?php
            $buyNum = $total_count - ($rows * ($page-1));
            $Num = $buyNum - $i;
            echo $Num;
            ?>
        </td>
        <td >
            <?= substr($row['datetime'],0,16) ?>
        </td>
        <td >
            <?= $mb['mb_name'] ?>
        </td>
        <td >
            <?= $reported_mb['wr_name'] ?>
        </td>
        <td >
            <?=$row['reason']?>
        </td>
        <td >
            <a href="<?=G5_BBS_URL?>/board.php?bo_table=<?=$row['bo_table']?>&wr_id=<?=$row['wr_id']?>" target="_blank">게시물 바로가기</a>
        </td>
        <td >
            <a href="report_update.php?rp_id=<?=$row['rp_id']?>&mode=article&sub_num=<?=$sub_num?>" onclick="return delete_confirm(this, 'report');" class="btn btn_01">신고해제</a>
        </td>
    </tr>
    <?php
    }
    if ($i == 0)
        echo "<tr><td colspan=\"".$colspan."\" class=\"empty_table\">자료가 없습니다.</td></tr>";
    ?>
    </tbody>
    </table>
</div>

    <!-- <div class="del-btn-wrap">
        <input type="submit" name="act_button" value="선택삭제" onclick="document.pressed=this.value" class="btn btn_02">
    </div>  -->

</form>


<?php echo get_paging(G5_IS_MOBILE ? $config['cf_mobile_pages'] : $config['cf_write_pages'], $page, $total_page, '?'.$qstr.'&amp;page='); ?>


<?php
include_once ('./admin.tail.php');