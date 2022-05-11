<?php
$sub_menu = "800000";
include_once('./_common.php');

auth_check_menu($auth, $sub_menu, 'r');
$g5['title'] = '지회관리';
include_once('./admin.head.php');

$where = "(1=1)";

$where .= "AND reunion_id != 23";

$sql = "SELECT * FROM `reunion` WHERE $where" ;
$result = sql_query($sql);

$total_count_sql = sql_fetch("SELECT count(*) AS count FROM `reunion` WHERE  $where");
$total_count = $total_count_sql['count'];
$colspan = 8;
?>




<form name="fmemberlist" id="fmemberlist" action="./member_list_update.php" onsubmit="return fmemberlist_submit(this);" method="post">
<input type="hidden" name="page" value="<?php echo $page ?>">
<input type="hidden" name="token" value="">


<div class="btn_fixed_top sp" >
    <div class="left">
        <span class="btn_ov01"><span class="ov_txt">동창회 </span><span class="ov_num"> <?php echo number_format($total_count) ?>개 </span></span>
    </div>
    
    <div class="right">
            <!-- <a href="./excel.branch_export.php" id="member_add" class="btn btn_02">엑셀저장</a> -->
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
        <!-- <th scope="col" id="mb_list_chk"  >
            <label for="chkall" class="sound_only">회원 전체</label>
            <input type="checkbox" name="chkall" value="1" id="chkall" onclick="check_all(this.form)">
        </th> -->
        <th scope="col">학교명칭</th>
        <th scope="col">구분</th>
        <th scope="col">계열</th>
        <th scope="col">학과</th>
        <th scope="col">기준</th>
        <th scope="col">비고</th>
    </tr>
    </thead>
    <tbody>
    <?php
    for ($i=0; $row=sql_fetch_array($result); $i++) {
        $bg = 'bg'.($i%2);
        
        // 계열정보 구하기
        $affiliation_sql = "SELECT af_name FROM `affiliation` WHERE reunion_id = '{$row['reunion_id']}'";
        $result2 = sql_query($affiliation_sql);

        $affiliationName = "";
        for ($k=0; $affiliationRow=sql_fetch_array($result2); $k++) {
            $affiliationName .= $affiliationRow['af_name']. ",";
        }
        $affiliationName = rtrim($affiliationName, ',');

        // 학과정보 구하기
        $department_sql = "SELECT dp_name FROM `department` WHERE reunion_id = '{$row['reunion_id']}'";
        $result3 = sql_query($department_sql);

        $departmentName = "";
        for ($k=0; $departmentRow=sql_fetch_array($result3); $k++) {
            $departmentName .= $departmentRow['dp_name']. ",";
        }
        $departmentName = rtrim($departmentName , ',');

    ?>

    <tr class="<?php echo $bg; ?>" >
        <!-- <td headers="mb_list_chk" class="td_chk">
            <input type="hidden" name="mb_id[<?php echo $i ?>]" value="<?php echo $row['mb_id'] ?>" id="mb_id_<?php echo $i ?>">
            <label for="chk_<?php echo $i; ?>" class="sound_only"><?php echo get_text($row['mb_name']); ?> <?php echo get_text($row['mb_nick']); ?>님</label>
            <input type="checkbox" name="chk[]" value="<?php echo $i ?>" id="chk_<?php echo $i ?>">
        </td> -->
        <td><?=$row['reunion_title']?></td>
        <td><?=$row['affiliation']?></td>
        <td><?=$affiliationName?></td>
        <td><?=$departmentName?></td>
        <td></td>
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