<?php
$sub_menu = "200100";
include_once('./_common.php');


auth_check_menu($auth, $sub_menu, 'w');


$sound_only = '';
$required_mb_id_class = '';
$required_mb_password = '';

if ($w == '')
{
    $required_mb_id = 'required';
    $required_mb_id_class = 'required alnum_';
    $required_mb_password = 'required';
    $sound_only = '<strong class="sound_only">필수</strong>';

    $html_title = '등록';
}
else if ($w == 'u')
{
    $mb = get_member($mb_id);
    if (!$mb['mb_id'])
        alert('존재하지 않는 회원자료입니다.');
    $fee = sql_fetch("SELECT * FROM {$g5['fee']} WHERE mb_no = '$mb_no' AND id = '$id' ");

    $required_mb_id = 'readonly';
    $html_title = '수정';
}
else
    alert('제대로 된 값이 넘어오지 않았습니다.');

$g5['title'] .= '회비 '.$html_title;
include_once('./admin.head.php');
include_once(G5_PLUGIN_PATH.'/jquery-ui/datepicker.php');

$now = date('Y-m-d',time());
if (empty($fr_date) || ! preg_match("/^[0-9]{4}-(0[1-9]|1[0-2])-(0[1-9]|[1-2][0-9]|3[0-1])$/", $fr_date) ) $fr_date = date('Y-m-d',strtotime($now."-1 month"));
if (empty($to_date) || ! preg_match("/^[0-9]{4}-(0[1-9]|1[0-2])-(0[1-9]|[1-2][0-9]|3[0-1])$/", $to_date) ) $to_date = G5_TIME_YMD;

$today = date('Y-m-d', time());  

?>

<form name="fmember" id="fmember" action="./fee_form_update.php" onsubmit="return fmember_submit(this);" method="post" >
<input type="hidden" name="w" value="<?php echo $w ?>">
<input type="hidden" name="sfl" value="<?php echo $sfl ?>">
<input type="hidden" name="stx" value="<?php echo $stx ?>">
<input type="hidden" name="sst" value="<?php echo $sst ?>">
<input type="hidden" name="sod" value="<?php echo $sod ?>">
<input type="hidden" name="page" value="<?php echo $page ?>">
<input type="hidden" name="token" value="">
<input type="hidden" name="mb_select" value="<?=($w=='u') ? 1 : 0?>">
<input type="hidden" name="mb_id" value="<?=($w=='u') ? $mb_id : null ?>">
<input type="hidden" name="mb_no" value="<?=($w=='u') ? $mb_no : null ?>">
<input type="hidden" name="id" value="<?=($w=='u') ? $id : null ?>">

<div class="tbl_frm01 tbl_wrap">
    <div class="tit01">회원 검색</div>
    <div class="serach-id">
        <?php if($w=='') {?>
            <input type="text" placeholder="이름검색" class="frm_input" id="search" value="<?=$mb_no?>">
            <input type="hidden"  name="mb_no" value="<?=$mb_no?>" id="num">
            <button class="btn03 open-modal" type="button" style="height:35px; width:60px">검색</button>
            <div class="desc"></div>
        <?php }?>
        <?php if($w=='u') {?>
            <div class="target-member">적용 회원 :<b> <?=$mb['mb_name']?></b></div>
        <?php }?>
    </div>
</div>

<div id="modal" class="id-search-modal">
    <div class="close-modal"><i class="xi-close"></i></div>
    
    <div class="tit">회원검색</div>

    <div class="modal-body">
        <table class="member-list">
            <thead>
                <th>아이디</th>
                <th>이름</th>
                <th>기수</th>
                <th>계열</th>
                <th>학과</th>
                <th>입학</th>
                <th>졸업</th>
                <th>전화번호</th>
            </thead>
            <tbody>
                <tr>
                    <td colspan="6" class="empty_table">자료가 없습니다.</td>
                </tr>
            </tbody>
        </table>
    </div>
</div>
<div id="overlay"></div>

<div class="tbl_frm01 tbl_wrap">
    <div class="tit01">회비 정보</div>
    <table>
        <caption><?php echo $g5['title']; ?></caption>
        <tbody>
            <tr>
                <th scope="row">회비 구분</th>
                <td>
                    <?= get_reunion_select('fee_type', $fee['fee_type'], 'required', 'fd_name', 'fee_division'); ?>
                </td>
                <th scope="row">입금날짜</th>
                <td>
                    <input type="text" name="deposit_date" value="<?= ($fee['deposit_date']) ? $fee['deposit_date'] : $today ?>" id="deposit_date"  class=" frm_input" size="15" maxlength="20" placeholder="ex) 0000-00-00" required>
                </td>
                <th scope="row">금액</th>
                <td>
                   <input type="text" name="fee" value="<?= $fee['fee'] ?>" id="fee"  class=" frm_input" size="15" maxlength="20" placeholder="콤마없이 숫자만" required>
                </td>
            </tr>
            <tr>
                <th scope="row">비고</th>
                <td colspan="5">
                   <input type="text" name="etc" value="<?php echo $fee['etc'] ?>" id="etc"  class=" frm_input" size="60" maxlength="20">
                </td>

            </tr>
        </tbody>
    </table>
</div>


<div class="btn_fixed_top">
    <a href="./fee_list.php?<?php echo $qstr ?>" class="btn btn_02">목록</a>
    <input type="submit" value="확인" class="btn_submit btn" accesskey='s'>
</div>
</form>

<script>
    <?php if($w == ''){?>
        $(document).ready(function(){
            $('#fee_type').val($("#fee_type option:first").val()).trigger('change');
        });
    <?php }?>

    function fmember_submit(f) {
        mb_check = $("input[name=mb_select]").val();
        if (mb_check == 0) {
            alert("회비를 등록할 회원 아이디를 검색해주세요.");
            $(".serach-id input").focus();
            return false;
        }
        return true;
    }

    $("#search").keydown(function (key) {
        if(key.keyCode == 13){//키가 13이면 실행 (엔터는 13)
            searchMember();
            return false;
        }
    });
    

    $(".serach-id button").click(function(){
        searchMember();
    })

    function searchMember(){
        mb_name = $(".serach-id input").val();
        $("input[name=mb_select]").val("0");
        $(".serach-id .desc").text("");
        $(".serach-id input").css("border", "1px solid #d5d5d5")
        if(!mb_name){
            alert("검색할 회원의 이름을 입력하세요.")
        }else{
            $("#modal, #overlay").show();
            $.ajax({
                url: "./ajax.search_mem.php",
                type: 'POST',
                data: {
                    'mb_name': mb_name
                },
                dataType: 'html',
                async: false,
                success: function (data, textStatus) {
                    if (data.error) {
                        alert(data.error);
                        return false;
                    } else {
                        $("#modal .member-list tbody").html(data);
                    }
                }
            });
        }
    };

    $(document).on("change","#fee_type",function(){
        var value = $(this).val();
        $.ajax({
                url: "./ajax.get_fee_price.php",
                type: 'POST',
                data: {
                    'fd_name': value
                },
                dataType: 'html',
                async: false,
                success: function (data, textStatus) {
                    $("#fee").val(data)
                }
            });
    });

    $(document).on("click","#modal .member-list tr",function(){
        value = $(this).data("id");
        name = $(this).data("name");
        if(value){
            $(".serach-id #search").val(name);
            $(".serach-id #num").val(value);
            $("#modal, #overlay").hide();
            $(".serach-id input").css("border", "2px solid #3e51b5")
            $(".serach-id .desc").text(name+"님의 회비를 등록 합니다.");
            $("input[name=mb_select]").val("1");
        }else{
            $("input[name=mb_select]").val("0");
        }
    });
    $(function(){
        $("#deposit_date").datepicker({ changeMonth: true, changeYear: true, dateFormat: "yy-mm-dd", showButtonPanel: true, yearRange: "c-99:c+99", maxDate: "+0d" });
    });

</script>
<?php
run_event('admin_member_form_after', $mb, $w);

include_once('./admin.tail.php');