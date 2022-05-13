<?php
if (!defined('_GNUBOARD_')) exit;

include_once('./admin.head.php');
?>

<form id="fsearch" name="fsearch"class="local_sch03 local_sch" method="get">
    <div class="reunion_tit"><?=$reunion['reunion_title']?></div>
    <div class="flex-box">
        <div class="left">
            <div class="input-row">
                <div class="input-col">
                    <?= get_reunion_select('affiliation', $affiliation, '', 'af_name', 'affiliation'); ?>
                </div>

                <div class="input-col">
                    <?= get_reunion_select('department', $department, '', 'dp_name', 'department'); ?>
                </div>

                

                <div class="input-col">
                    <input type="text" name="mb_hp" value="<?= $mb_hp?>" id="mb_hp"  class=" frm_input" placeholder="전화번호">
                </div>

                <div class="input-col">
                    <input type="text" name="mb_name" value="<?=$mb_name ?>" id="mb_name"  class=" frm_input" placeholder="이름">
                </div>
            </div>

            <div class="sch_last">
                <div class="input-row">
                    <div class="input-col">
                        <input type="text" name="entrance_num" value="<?= $entrance_num?>" id="entrance_num" class="frm_input" placeholder="학번">
                    </div>
                    <div class="input-col">
                        <input type="text" name="entrance_year" value="<?= $entrance_year?>" id="entrance_year" class="frm_input" placeholder="입학">
                    </div>
                    <div class="input-col">
                        <input type="text" name="graduation_year" value="<?= $graduation_year?>" id="graduation_year" class="frm_input" placeholder="졸업">
                    </div>
                    <div class="input-col">
                        <select name="sfl" id="sfl">
                            <option value="">검색어구분</option>
                            <option value="job" <?php echo get_selected($sfl, "job"); ?>>직장명</option>
                            <option value="job_position" <?php echo get_selected($sfl, "job_position"); ?>>직위</option>
                            <option value="addr" <?php echo get_selected($sfl, "addr"); ?>>자택주소</option>
                            <option value="mb_email" <?php echo get_selected($sfl, "mb_email"); ?>>이메일</option>
                            <option value="executive" <?php echo get_selected($sfl, "executive"); ?>>총동문회 임원</option>
                        </select>
                    </div>
                    <div class="input-col"><input type="text" name="stx" value="<?php echo $stx ?>" id="stx"  class=" frm_input" placeholder="검색어 입력"></div>
                </div>
            </div>

            <div class="input-row executive-list">
                <input type="checkbox" id="executive-check" name="executive_list" <?=($executive_list == "on") ? "checked": null?>>
                <label for="executive-check">임원명단</label>
            </div>
        </div>

        <div class="rigth">
            <input type="submit" value="검색" class="btn_submit">
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