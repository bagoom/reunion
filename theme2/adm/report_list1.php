<?php
$sub_menu = "9920000";
include_once('./_common.php');

auth_check_menu($auth, $sub_menu, 'r');
$g5['title'] = '신고내역';
$sub_num = '1';
include_once('./report.sub.php');
$sql_common = " from report_user ";

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

<!-- <div class="local_desc01 local_desc">
    <p>
        회원자료 삭제 시 다른 회원이 기존 회원아이디를 사용하지 못하도록 회원아이디, 이름, 닉네임은 삭제하지 않고 영구 보관합니다.
    </p>
</div> -->

<div class="tbl_head01 tbl_wrap new_mem">
    <table>
    <caption><?php echo $g5['title']; ?> 목록</caption>
    <thead>
    <tr>
        <!-- <th scope="col" id="mb_list_chk"  >
            <label for="chkall" class="sound_only">회원 전체</label>
            <input type="checkbox" name="chkall" value="1" id="chkall" onclick="check_all(this.form)">
        </th> -->
        						
        <th scope="col">번호</th>
        <th scope="col">신고날짜</th>
        <th scope="col">신고자</th>
        <th scope="col">불량사용자</th>
        <th scope="col">신고 내용</th> 
        <th scope="col">비고</th>
        <!-- <th scope="col">차단 설정</th> -->
        <!-- <th scope="col">차단된 일자</th> -->
    </tr>
    </thead>
    <tbody>
    <?php
    for ($i=0; $row=sql_fetch_array($result); $i++) { 
        $mb = get_member($row['mb_id']);
        $reported_mb = get_member($row['mb_to_id']);
        ?>

    <tr class="<?php echo $bg; ?>" >
        <!-- <td headers="mb_list_chk" class="td_chk">
            <input type="hidden" name="mb_no[<?php echo $i ?>]" value="<?php echo $row['mb_no'] ?>" id="mb_no_<?php echo $i ?>">
            <label for="chk_<?php echo $i; ?>" class="sound_only"><?php echo get_text($row['mb_name']); ?> <?php echo get_text($row['mb_nick']); ?>님</label>
            <input type="checkbox" name="chk[]" value="<?php echo $i ?>" id="chk_<?php echo $i ?>">
        </td> -->
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
            <?= $reported_mb['mb_name'] ?>
        </td>
        <td >
            <?= $row['reason'] ?>
        </td>
        <td >
            <a href="report_update.php?rp_id=<?=$row['rp_id']?>&mode=user&sub_num=<?=$sub_num?>" onclick="return delete_confirm(this, 'report');" class="btn btn_01">신고해제</a>
        </td>
        <!-- <td >
            <button type="button" class="btn btn_02 modal-open" data-name="<?=$row['mb_name']?>" data-id="<?=$row['mb_id']?>">인증확인</button>
            <a href="new_member_update.php?w=d&mb_id=<?=$row['mb_id']?>&mb_no=<?=$row['mb_no']?>" onclick="return delete_confirm(this, 'new_mem');" class="btn btn_01">인증취소</a>
        </td> -->
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