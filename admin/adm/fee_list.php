<?php
$sub_menu = "200000";
include_once('./_common.php');

auth_check_menu($auth, $sub_menu, 'r');
$g5['title'] = '회비관리';
include_once('./admin.head.php');
include_once('./fee.sub.php');

$where = "";

if($type)
    $where .= " AND a.type= '$type'";

if($affiliation)
    $where .= " AND a.affiliation = '$affiliation'";

if($department)
    $where .= " AND a.department = '$department'";

if($graduation_year)
    $where .= " AND a.graduation_year = '$graduation_year'";

if($mb_hp)
    $where .= " AND a.mb_hp = '$mb_hp'";

if($mb_name)
    $where .= " AND a.mb_name = '$mb_name'";

if($fr_date)
    $where .= " AND b.deposit_date >= '$fr_date' AND b.deposit_date <= '$to_date'";
    
if($fee_type)
    $where .= " AND b.fee_type = '$fee_type'";

if($is_admin !== 'superadmin'){    
    $sql = "SELECT * FROM {$g5['member_table']} a, {$g5['fee']} b WHERE a.mb_id = b.mb_id $where AND b.reunion_id = '{$reunionID}' ORDER BY id DESC" ;
}else{
    $sql = "SELECT * FROM {$g5['member_table']} a, {$g5['fee']} b WHERE a.mb_id = b.mb_id $where ORDER BY id DESC" ;
}
$result = sql_query($sql);

$total_count_sql = sql_fetch("SELECT count(*) AS count FROM {$g5['member_table']} a, {$g5['fee']} b WHERE a.mb_id = b.mb_id  $where");
$total_count = $total_count_sql['count'];
$colspan = 9;
?>




<form name="fmemberlist" id="fmemberlist" action="./member_list_update.php" onsubmit="return fmemberlist_submit(this);" method="post">
<input type="hidden" name="page" value="<?php echo $page ?>">
<input type="hidden" name="token" value="">


<div class="btn_fixed_top sp" >
    <div class="left">
        <span class="btn_ov01"><span class="ov_txt">검색 회원수 </span><span class="ov_num"> <?php echo number_format($total_count) ?>명 </span></span>
    </div>
    
    <div class="right">
        <?php if($is_admin !== 'superadmin') { ?>
            <a href="./fee_form.php" id="member_add" class="btn btn_01">회비등록</a>
        <?php } ?>
            <a href="./excel.fee_export.php" id="member_add" class="btn btn_02">엑셀저장</a>
    </div>
</div>
<!-- <div class="local_desc01 local_desc">
    <p>
        회원자료 삭제 시 다른 회원이 기존 회원아이디를 사용하지 못하도록 회원아이디, 이름, 닉네임은 삭제하지 않고 영구 보관합니다.
    </p>
</div> -->

<div class="tbl_head01 tbl_wrap">
    <table>
    <caption><?php echo $g5['title']; ?> 목록</caption>
    <thead>
    <tr>
        <th scope="col" id="mb_list_chk"  >
            <label for="chkall" class="sound_only">회원 전체</label>
            <input type="checkbox" name="chkall" value="1" id="chkall" onclick="check_all(this.form)">
        </th>
        <th scope="col">구분</th>
        <th scope="col">입금날짜</th>
        <th scope="col">금액</th>
        <th scope="col">성명</th>
        <th scope="col">학과</th>
        <th scope="col">졸업</th>
        <th scope="col">전화번호</th>
        <th scope="col">비고</th>
    </tr>
    </thead>
    <tbody>
    <?php
    for ($i=0; $row=sql_fetch_array($result); $i++) {
        $bg = 'bg'.($i%2);
    ?>

    <tr class="<?php echo $bg; ?>" onClick="location.href='./fee_form.php?mb_id=<?=$row['mb_id']?>&w=u&id=<?=$row['id']?>'">
        <td headers="mb_list_chk" class="td_chk">
            <input type="hidden" name="mb_id[<?php echo $i ?>]" value="<?php echo $row['mb_id'] ?>" id="mb_id_<?php echo $i ?>">
            <label for="chk_<?php echo $i; ?>" class="sound_only"><?php echo get_text($row['mb_name']); ?> <?php echo get_text($row['mb_nick']); ?>님</label>
            <input type="checkbox" name="chk[]" value="<?php echo $i ?>" id="chk_<?php echo $i ?>">
        </td>
        <td><?=$row['fee_type']?></td>
        <td><?=$row['deposit_date']?></td>
        <td><?=number_format($row['fee'])?></td>
        <td><?=$row['mb_name']?></td>
        <td><?=$row['department']?></td>
        <td><?=$row['graduation_year']?></td>
        <td><?=$row['mb_hp']?></td>
        <td><?=$row['etc']?></td>
    </tr>
    <?php
    }
    if ($i == 0)
        echo "<tr><td colspan=\"".$colspan."\" class=\"empty_table\">자료가 없습니다.</td></tr>";
    ?>
    </tbody>
    </table>
</div>



</form>

<?php echo get_paging(G5_IS_MOBILE ? $config['cf_mobile_pages'] : $config['cf_write_pages'], $page, $total_page, '?'.$qstr.'&amp;page='); ?>

<script>
function fmemberlist_submit(f)
{
    if (!is_checked("chk[]")) {
        alert(document.pressed+" 하실 항목을 하나 이상 선택하세요.");
        return false;
    }

    if(document.pressed == "선택삭제") {
        if(!confirm("선택한 자료를 정말 삭제하시겠습니까?")) {
            return false;
        }
    }

    return true;
}
</script>

<?php
include_once ('./admin.tail.php');