<?php
if (!defined('_GNUBOARD_')) exit;

include_once('./admin.head.php');
?>

<form id="fsearch" name="fsearch"class="local_sch03 local_sch" method="get">
    <div class="flex-box">
        <div class="left">
            <div class="input-row">
                <div class="input-col">
                    <select name="type" id="type">
                       <option value="대학원" <?=get_selected($type, "대학원")?>>대학원</option>
                       <option value="기수별" <?=get_selected($type, "기수별")?>>기수별</option>
                       <option value="단체별" <?=get_selected($type, "단체별")?>>단체별</option>
                       <option value="지역별" <?=get_selected($type, "지역별")?>>지역별</option>
                       <option value="직능별" <?=get_selected($type, "직능별")?>>직능별</option>
                       <option value="직장별" <?=get_selected($type, "직장별")?>>직장별</option>
                       <option value="동우회별" <?=get_selected($type, "동우회별")?>>동우회별</option>
                    </select>
                </div>

                <div class="input-col">
                    <select name="status" id="status">
                        <option value="">상태전체</option>
                        <option value="활동"  <?php echo get_selected($status, "활동"); ?>>활동</option>
                        <option value="일시중지"  <?php echo get_selected($status, "일시중지"); ?>>일시중지</option>
                        <option value="영구중지"  <?php echo get_selected($status, "영구중지"); ?>>영구중지</option>
                    </select>
                </div>

                <div class="input-col"><input type="text" name="branch_name" value="<?php echo $branch_name ?>" id="branch_name"  class=" frm_input" placeholder="지회명"></div>
            </div>

        </div>

        <div class="rigth">
            <input type="submit" value="검색" class="btn_submit" style="height: 30px !important">
        </div>
    </div>
</form>


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