<?php
$sub_menu = "500100";
include_once('./_common.php');

auth_check_menu($auth, $sub_menu, 'r');
$g5['title'] = '계열설정';
include_once('./admin.head.php');

$sql = "SELECT * FROM `affiliation` WHERE reunion_id = '{$reunionID}'" ;
$result = sql_query($sql);

$colspan = 2;
?>

<style>
    .tbl_wrap{
        margin: 20px 0; 
    }
</style>

<form action="./affiliation_update.php" method="post">
    <input type="hidden" name="w">
    <div class="input-wrap">
        <div class="input-row">
            <div class="input-col">
                <label for="">계열추가</label>
                <input type="text" name="af_name" placeholder="계열명">
                <button type="submit">추가</button>
            </div>
        </div>
    </div>
</form>


<form name="fmemberlist" id="fmemberlist" action="./affiliation_update.php" onsubmit="return fmemberlist_submit(this);" method="post">
<input type="hidden" name="page" value="<?php echo $page ?>">
<input type="hidden" name="token" value="<?php echo isset($token) ? $token : ''; ?>">
<input type="hidden" name="w" value="u">



<div class="tbl_head01 tbl_wrap" style="width: 350px">
    <table>
    <caption><?php echo $g5['title']; ?> 목록</caption>
    <thead>
    <tr>
        <th scope="col">
            <label for="chkall" class="sound_only">게시판 전체</label>
            <input type="checkbox" name="chkall" value="1" id="chkall" onclick="check_all(this.form)">
        </th>
        <th scope="col">목록</th>
    </tr>
    </thead>
    <tbody>
    <?php
    for ($i=0; $row=sql_fetch_array($result); $i++) { ?>

    <tr class="<?php echo $bg; ?>">
        <input type="hidden" name="af_id[<?= $i ?>]" value="<?=$row['af_id']?>">
        <td class="td_chk">
            <label for="chk_<?php echo $i; ?>" class="sound_only"></label>
            <input type="checkbox" name="chk[]" value="<?php echo $i ?>" id="chk_<?php echo $i ?>">
        </td>
        <td><input type="text" name="af_name[<?= $i ?>]" value="<?=$row['af_name']?>"></td>
        <!-- <td>
            <a href="./affiliation_update.php?w=u&af_id=<?=$row['af_id']?>&af_name=<?=$row['af_name']?>" onclick="return update_confirm(this);">수정</a>
            <a href="./affiliation_update.php?w=d&af_id=<?=$row['af_id']?>" onclick="return delete_confirm(this);">삭제</a>
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

<div class="btn_fixed_top fs">
    <input type="submit" name="act_button" value="선택수정" onclick="document.pressed=this.value" class="btn_02 btn">
    <input type="submit" name="act_button" value="선택삭제" onclick="document.pressed=this.value" class="btn_02 btn">
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