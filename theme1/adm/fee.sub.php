<?php
if (!defined('_GNUBOARD_')) exit;

include_once(G5_LIB_PATH.'/visit.lib.php');
include_once('./admin.head.php');
include_once(G5_PLUGIN_PATH.'/jquery-ui/datepicker.php');

$now = date('Y-m-d',time());
if (empty($fr_date) || ! preg_match("/^[0-9]{4}-(0[1-9]|1[0-2])-(0[1-9]|[1-2][0-9]|3[0-1])$/", $fr_date) ) $fr_date = date('Y-m-d',strtotime($now."-1 month"));
if (empty($to_date) || ! preg_match("/^[0-9]{4}-(0[1-9]|1[0-2])-(0[1-9]|[1-2][0-9]|3[0-1])$/", $to_date) ) $to_date = G5_TIME_YMD;


?>

<form name="fvisit" id="fvisit" class="local_sch03 local_sch" method="get">
    <div class="flex-box">
        <div class="left">
            <div class="input-row">
                <div class="input-col">
                    <select name="type" id="type">
                        <option value="">구분</option>
                        <option value="대학" <?php echo get_selected($type, "대학"); ?>>대학</option>
                        <option value="대학원" <?php echo get_selected($type, "대학원"); ?>>대학원</option>
                    </select>
                </div>

                <div class="input-col">
                    <select name="affiliation" id="affiliation">
                        <option value="">계열</option>
                        <option value="전자정보 대학"  <?php echo get_selected($affiliation, "전자정보 대학"); ?>>전자정보 대학</option>
                    </select>
                </div>

                <div class="input-col">
                    <select name="department" id="department">
                        <option value="">학과</option>
                        <option value="전자 재료 공학" <?php echo get_selected($department, "전자 재료 공학"); ?>>전자 재료 공학</option>
                    </select>
                </div>

                <div class="input-col">
                    <input type="text" name="graduation_year" value="<?= $graduation_year?>" id="graduation_year"  class="frm_input" placeholder="졸업">
                </div>

                <div class="input-col">
                    <input type="text" name="mb_hp" value="<?= $mb_hp?>" id="mb_hp"  class=" frm_input" placeholder="전화번호">
                </div>

                <div class="input-col">
                    <input type="text" name="mb_name" value="<?=$mb_name ?>" id="mb_name"  class=" frm_input" placeholder="이름">
                </div>
            </div>

            <div class="sch_last">
                <strong>기간별검색</strong>
                <input type="text" name="fr_date" value="<?php echo $fr_date ?>" id="fr_date" class="frm_input" size="11" maxlength="10">
                <label for="fr_date" class="sound_only">시작일</label>
                ~
                <input type="text" name="to_date" value="<?php echo $to_date ?>" id="to_date" class="frm_input" size="11" maxlength="10">
                <label for="to_date" class="sound_only">종료일</label>
                <button type="button" class="btn02" id="7d_ago">7일</button>
                <button type="button" class="btn02" id="1m_ago">1개월</button>
                <button type="button" class="btn02" id="3m_ago">3개월</button>
                <button type="button" class="btn02" id="6m_ago">6개월</button>
                <button type="button" class="btn02" id="12m_ago">12개월</button>


            </div>


            <div class="sch_last">
                <strong>회비 구분</strong>
                <input type="radio" name="fee_type" value="" id="fee_type_all" class="frm_input" checked>
                <label for="fee_type_all">전체</label>
                <?php 
                    $fee_type_sql = "SELECT * FROM fee_division WHERE reunion_id = $reunionID";
                    $fee_type_result = sql_query($fee_type_sql);
                    for ($i=0; $row=sql_fetch_array($fee_type_result); $i++) { ?>
                        <input type="radio" name="fee_type" value="<?=$row['fd_name']?>" <?=($fee_type === $row['fd_name']) ? "checked" : null?> id="fee_type_<?=$row['fd_id']?>" class="frm_input" >
                        <label for="fee_type_<?=$row['fd_id']?>"><?=$row['fd_name']?></label>
                <?php } ?>
            </div>
        </div>

        <div class="rigth">
            <input type="submit" value="검색" class="btn_submit">
        </div>
    </div>
</form>


<script>
$(function(){
    $("#fr_date, #to_date").datepicker({ changeMonth: true, changeYear: true, dateFormat: "yy-mm-dd", showButtonPanel: true, yearRange: "c-99:c+99", maxDate: "+0d" });
});



var dateInput = $("#fr_date");
$("#7d_ago").click(function(){
    var now = new Date();	// 현재 날짜 및 시간
    cal_day =  dateFormat(new Date(now.setDate(now.getDate() - 7)));
    dateInput.val(cal_day);
});
$("#1m_ago").click(function(){
    var now = new Date();	// 현재 날짜 및 시간
    cal_day =  dateFormat(new Date(now.setMonth(now.getMonth() - 1)));
    dateInput.val(cal_day);
});
$("#3m_ago").click(function(){
    var now = new Date();	// 현재 날짜 및 시간
    cal_day =  dateFormat(new Date(now.setMonth(now.getMonth() - 3)));
    dateInput.val(cal_day);
});
$("#6m_ago").click(function(){
    var now = new Date();	// 현재 날짜 및 시간
    cal_day =  dateFormat(new Date(now.setMonth(now.getMonth() - 6)));
    dateInput.val(cal_day);
});
$("#12m_ago").click(function(){
    var now = new Date();	// 현재 날짜 및 시간
    cal_day =  dateFormat(new Date(now.setMonth(now.getMonth() - 12)));
    dateInput.val(cal_day);
});

function fvisit_submit(act)
{
    var f = document.fvisit;
    f.action = act;
    f.submit();
}

function dateFormat(date) {
        let month = date.getMonth() + 1;
        let day = date.getDate();
        let hour = date.getHours();
        let minute = date.getMinutes();
        let second = date.getSeconds();

        month = month >= 10 ? month : '0' + month;
        day = day >= 10 ? day : '0' + day;
        hour = hour >= 10 ? hour : '0' + hour;
        minute = minute >= 10 ? minute : '0' + minute;
        second = second >= 10 ? second : '0' + second;

        return date.getFullYear() + '-' + month + '-' + day ;
}
</script>
