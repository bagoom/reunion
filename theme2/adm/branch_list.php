<?php
$sub_menu = "300000";
include_once('./_common.php');

auth_check_menu($auth, $sub_menu, 'r');
$g5['title'] = '지회관리';
include_once('./admin.head.php');
include_once('./branch.sub.php');

$where = "(1=1)";

if($type)
    $where .= " AND type= '$type'";

if($status)
    $where .= " AND status= '$status'";

if($branch_name)
    $where .= " AND branch_name like '%{$branch_name}%'";

    
if($fee_type)
    $where .= " AND b.fee_type = '$fee_type'";

if($is_admin !== 'superadmin'){    
    $sql = "SELECT * FROM {$g5['branch']}  WHERE  $where  AND reunion_id = '{$reunionID}' ORDER BY branch_id DESC" ;
}else{
    $sql = "SELECT * FROM {$g5['branch']}  WHERE  $where  ORDER BY branch_id DESC" ;
}
$result = sql_query($sql);
if($is_admin !== 'superadmin'){    
    $total_count_sql = sql_fetch("SELECT count(*) AS count FROM {$g5['branch']} WHERE  $where AND reunion_id = '{$reunionID}' ");
}else{
    $total_count_sql = sql_fetch("SELECT count(*) AS count FROM {$g5['branch']} WHERE  $where");
}
$total_count = $total_count_sql['count'];
$colspan = 8;
?>




<form name="fmemberlist" id="fmemberlist" action="./branch_list_update.php" onsubmit="return fmemberlist_submit(this);" method="post">
<input type="hidden" name="page" value="<?php echo $page ?>">
<input type="hidden" name="token" value="">


<div class="btn_fixed_top sp" >
    <div class="left">
        <span class="btn_ov01"><span class="ov_txt">검색 지회수 </span><span class="ov_num"> <?php echo number_format($total_count) ?>개 </span></span>
    </div>
    
    <div class="right">
        <?php if($is_admin !== 'superadmin') { ?>
            <a href="./branch_form.php" id="member_add" class="btn btn_01">지회등록</a>
        <?php }?>
            <a href="./excel.branch_export.php" id="member_add" class="btn btn_02">엑셀저장</a>
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
        <th scope="col">등록일</th>
        <th scope="col">구분</th>
        <th scope="col">상태</th>
        <th scope="col">지회명</th>
        <th scope="col">회장</th>
        <th scope="col">전화번호</th>
        <th scope="col">총무</th>
        <th scope="col">지회인원</th>
    </tr>
    </thead>
    <tbody>
    <?php
    for ($i=0; $row=sql_fetch_array($result); $i++) {
        $bg = 'bg'.($i%2);
        $chairman_data = sql_fetch("SELECT * FROM {$g5['branch_member']} WHERE branch_id = '{$row['branch_id']}' AND grade = '회장'");
        $manager_data = sql_fetch("SELECT * FROM {$g5['branch_member']} WHERE branch_id = '{$row['branch_id']}' AND grade = '총무'");

        $chairman = get_member($chairman_data['mb_id']);
        $manager = get_member($manager_data['mb_id']);

        $branch_mem_count_sql = sql_fetch("SELECT count(*) AS count FROM {$g5['branch']} a, {$g5['branch_member']} b  WHERE a.branch_id = b.branch_id AND b.branch_id = '{$row['branch_id']}' ");
        $branch_mem_count = $branch_mem_count_sql['count'];
    ?>

    <tr class="<?php echo $bg; ?>" >
        <td headers="mb_list_chk" class="td_chk">
            <input type="hidden" name="branch_id[<?php echo $i ?>]" value="<?php echo $row['branch_id'] ?>" id="branch_id_<?php echo $i ?>">
            <label for="chk_<?php echo $i; ?>" class="sound_only"><?php echo get_text($row['mb_name']); ?> <?php echo get_text($row['mb_nick']); ?>님</label>
            <input type="checkbox" name="chk[]" value="<?php echo $i ?>" id="chk_<?php echo $i ?>">
        </td>
        <td onClick="location.href='./branch_form.php?branch_id=<?=$row['branch_id']?>&w=u'"><?=$row['create_date']?></td>
        <td onClick="location.href='./branch_form.php?branch_id=<?=$row['branch_id']?>&w=u'"><?=$row['type']?></td>
        <td onClick="location.href='./branch_form.php?branch_id=<?=$row['branch_id']?>&w=u'"><?=$row['status']?></td>
        <td onClick="location.href='./branch_form.php?branch_id=<?=$row['branch_id']?>&w=u'"><?=$row['branch_name']?></td>
        <td onClick="location.href='./branch_form.php?branch_id=<?=$row['branch_id']?>&w=u'"><?=$chairman['mb_name']?></td>
        <td onClick="location.href='./branch_form.php?branch_id=<?=$row['branch_id']?>&w=u'"><?=$chairman['mb_hp']?></td>
        <td onClick="location.href='./branch_form.php?branch_id=<?=$row['branch_id']?>&w=u'"><?=$manager['mb_name']?></td>
        <td onClick="location.href='./branch_form.php?branch_id=<?=$row['branch_id']?>&w=u'"><?=$branch_mem_count?></td>
    </tr>
    <?php
    }
    if ($i == 0)
        echo "<tr><td colspan=\"".$colspan."\" class=\"empty_table\">자료가 없습니다.</td></tr>";
    ?>
    </tbody>
    </table>
</div>

    <div class="del-btn-wrap">
        <input type="submit" name="act_button" value="선택삭제" onclick="document.pressed=this.value" class="btn btn_02">
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