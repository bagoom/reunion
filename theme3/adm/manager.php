<?php
$sub_menu = "500600";
include_once('./_common.php');

auth_check_menu($auth, $sub_menu, 'r');
$g5['title'] = '관리자 설정';
include_once('./admin.head.php');

$sql = "SELECT * FROM `manager` WHERE reunion_id = '{$reunionID}' AND rights != 'supervisor' AND rights != 'superadmin'" ;
$result = sql_query($sql);

$colspan = 7;
?>

<style>
    .tbl_wrap{
        margin: 20px 0; 
    }
    .tbl_wrap input[type="text"] {
        width: 100%;
        height: 25px;
        padding-left: 10px;
        border-radius: 0;
        border: 1px solid #ddd;
    }
    .tbl_wrap input[type="password"] {
        width: 100%;
        height: 25px;
        padding-left: 10px;
        border-radius: 0;
        border: 1px solid #ddd;
    }
</style>

<form action="./manager_update.php" method="post">
    <input type="hidden" name="w">
    <div class="input-wrap">
        <div class="input-row">
            <div class="input-col">
                <label for="">아이디</label>
                <input type="text" name="mg_id" placeholder="아이디" required>
            </div>
            <div class="input-col">
                <label for="">비밀번호</label>
                <input type="password" name="mg_pass" placeholder="비밀번호" required>
            </div>
            <div class="input-col">
                <label for="">비밀번호 확인</label>
                <input type="password" name="mg_pass_check" placeholder="비밀번호 확인" required>
            </div>
            <div class="input-col">
                <label for="">이름</label>
                <input type="text" name="mg_name" placeholder="이름" required>
            </div>
            <div class="input-col">
                <label for="">직급</label>
                <input type="text" name="position" placeholder="직급">
            </div>
            <div class="input-col">
                <label for="">전화번호</label>
                <input type="text" name="mg_hp" placeholder="전화번호">
            </div>
            <div class="input-col">
                <label for="">이메일</label>
                <input type="text" name="mg_email" placeholder="이메일">
                <button type="submit">추가</button>
            </div>
            <div class="input-col">
        </div>
    </div>
</form>
<!-- <?=var_dump(get_reunion($reunionID))?> -->


<form name="fmemberlist" id="fmemberlist" action="./manager_update.php" onsubmit="return fmemberlist_submit(this);" method="post">
<input type="hidden" name="page" value="<?php echo $page ?>">
<input type="hidden" name="token" value="<?php echo isset($token) ? $token : ''; ?>">
<input type="hidden" name="w" value="u">



<div class="tbl_head01 tbl_wrap" style="width: 900px">
    <table>
    <caption><?php echo $g5['title']; ?> 목록</caption>
    <thead>
    <tr>
        <th scope="col">
            <label for="chkall" class="sound_only">게시판 전체</label>
            <input type="checkbox" name="chkall" value="1" id="chkall" onclick="check_all(this.form)">
        </th>
        <th scope="col">아이디</th>
        <th scope="col">비밀번호</th>
        <th scope="col">비밀번호 확인</th>
        <th scope="col">이름</th>
        <th scope="col">직급</th>
        <th scope="col">전화번호</th>
        <th scope="col">이메일</th>
    </tr>
    </thead>
    <tbody>
    <?php
    for ($i=0; $row=sql_fetch_array($result); $i++) { ?>

    <tr class="<?php echo $bg; ?>">
        <input type="hidden" name="mg_no[<?= $i ?>]" value="<?=$row['mg_no']?>">
        <td class="td_chk">
            <label for="chk_<?php echo $i; ?>" class="sound_only"></label>
            <input type="checkbox" name="chk[]" value="<?php echo $i ?>" id="chk_<?php echo $i ?>">
        </td>
        <td><?=$row['mg_id']?></td>
        <td><input type="password" name="mg_pass[<?= $i ?>]" value=""></td>
        <td><input type="password" name="mg_pass_check[<?= $i ?>]" value=""></td>
        <td><input type="text" name="mg_name[<?= $i ?>]" value="<?=$row['mg_name']?>"></td>
        <td><input type="text" name="position[<?= $i ?>]" value="<?=$row['position']?>"></td>
        <td><input type="text" name="mg_hp[<?= $i ?>]" value="<?=$row['mg_hp']?>"></td>
        <td><input type="text" name="mg_email[<?= $i ?>]" value="<?=$row['mg_email']?>"></td>
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