<?php
$sub_menu = "9910000";
include_once('./_common.php');

auth_check_menu($auth, $sub_menu, 'r');
$g5['title'] = '신규회원확인';
include_once('./admin.head.php');
$sql_common = " from {$g5['member_table']} ";

$where = "WHERE confirm = 'N' AND  mb_new ='Y' AND reunion_id = '{$reunionID}'";
if (!$sst) {
    $sst = "mb_no";
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

$colspan = 6;

$q = $_SERVER['QUERY_STRING']; 
?>


<form name="fmemberlist" id="fmemberlist" action="./new_member_update.php" onsubmit="return fmemberlist_submit(this);" method="post">
<input type="hidden" name="sst" value="<?php echo $sst ?>">
<input type="hidden" name="sod" value="<?php echo $sod ?>">
<input type="hidden" name="sfl" value="<?php echo $sfl ?>">
<input type="hidden" name="stx" value="<?php echo $stx ?>">
<input type="hidden" name="page" value="<?php echo $page ?>">
<input type="hidden" name="token" value="">
<div class="btn_fixed_top sp">
    <div class="local_ov01 local_ov">
        <span class="btn_ov01"><span class="ov_txt">총회원수 </span><span class="ov_num"> <?php echo number_format($total_count) ?>명 </span></span>
    </div>

</div>

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
        <th scope="col">아이디</th>
        <th scope="col">이름</th>
        <th scope="col">e-mail</th>
        <th scope="col">기수</th>
        <th scope="col">계열</th> 
        <th scope="col">학과</th>
        <th scope="col">학번</th>
        <th scope="col">입학</th>
        <th scope="col">졸업</th>
        <th scope="col">전화번호</th>
        <th scope="col"></th>
    </tr>
    </thead>
    <tbody>
    <?php
    for ($i=0; $row=sql_fetch_array($result); $i++) { ?>

    <tr class="<?php echo $bg; ?>" >
        <!-- <td headers="mb_list_chk" class="td_chk">
            <input type="hidden" name="mb_no[<?php echo $i ?>]" value="<?php echo $row['mb_no'] ?>" id="mb_no_<?php echo $i ?>">
            <label for="chk_<?php echo $i; ?>" class="sound_only"><?php echo get_text($row['mb_name']); ?> <?php echo get_text($row['mb_nick']); ?>님</label>
            <input type="checkbox" name="chk[]" value="<?php echo $i ?>" id="chk_<?php echo $i ?>">
        </td> -->
        <td >
            <?= $row['mb_id'] ?>
        </td>
        <td >
            <?= $row['mb_name'] ?>
        </td>
        <td >
            <?= $row['mb_email'] ?>
        </td>
        <td >
            <?= $row['generation'] ?>
        </td>
        <td >
            <?= $row['affiliation'] ?>
        </td>
        <td >
            <?= $row['department'] ?>
        </td>
        <td >
            <?= $row['admission_year'] ?>
        </td>
        <td >
            <?= ($row['entrance_year'])? $row['entrance_year'] : "-" ?>
        </td>
        <td >
            <?= ($row['graduation_year'])? $row['graduation_year'] : "-" ?>
        </td>
        <td >
            <?= ($row['mb_hp'])? $row['mb_hp'] : "-" ?>
        </td>
        <td >
            <button type="button" class="btn btn_02 modal-open" data-name="<?=$row['mb_name']?>" data-id="<?=$row['mb_id']?>">인증확인</button>
            <a href="new_member_update.php?w=d&mb_id=<?=$row['mb_id']?>&mb_no=<?=$row['mb_no']?>" onclick="return delete_confirm(this, 'new_mem');" class="btn btn_01">인증취소</a>
        </td>
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

<div id="modal" class="id-search-modal new-mem">
    <div class="close-modal"><i class="xi-close"></i></div>
    
    <div class="tit">동문회원 정보 등록</div>

    <div class="modal-body">
        <table class="member-list">
            <thead>
                <th>아이디</th>
                <th>이름</th>
                <th>이메일</th>
                <th>기수</th>
                <th>계열</th>
                <th>학과</th>
                <th>학번</th>
                <th>입학</th>
                <th>졸업</th>
                <th>전화번호</th>
                <th></th>
            </thead>
            <tbody>
                <tr>
                    <td colspan="7" class="empty_table">자료가 없습니다.</td>
                </tr>
            </tbody>
        </table>
    </div>
</div>
<div id="overlay"></div>

<?php echo get_paging(G5_IS_MOBILE ? $config['cf_mobile_pages'] : $config['cf_write_pages'], $page, $total_page, '?'.$qstr.'&amp;page='); ?>

<script>
    
    $(".modal-open").click(function () {
        $("#modal, #overlay").show();
        var mb_name = $(this).data("name");
        var mb_id = $(this).data("id");
        getMember(mb_id,mb_name);
    });
    $(document).on("click", ".modal-close", function () {
        $("#modal, #overlay").hide();
        location.reload();
    });

    function getMember(mb_id,mb_name){
            $.ajax({
                url: "./ajax.new_mem.php",
                type: 'POST',
                data: {
                    'mb_id': mb_id,
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
    };
</script>

<?php
include_once ('./admin.tail.php');