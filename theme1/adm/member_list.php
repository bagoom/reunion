<?php
$sub_menu = "100000";
include_once('./_common.php');

auth_check_menu($auth, $sub_menu, 'r');
$g5['title'] = '동문회원관리';
include_once('./member.sub.php');
$sql_common = " from {$g5['member_table']} ";


if($type)
    $where .= " AND type= '$type'";

if($affiliation)
    $where .= " AND affiliation = '$affiliation'";

if($department)
    $where .= " AND department = '$department'";

if($mb_hp)
    $where .= " AND mb_hp = '$mb_hp'";
    
if($mb_name)
    $where .= " AND mb_name = '$mb_name'";
    
if($entrance_num)
    $where .= " AND entrance_num = '$entrance_num'";

if($graduation_year)
    $where .= " AND graduation_year = '$graduation_year'";

if($entrance_year)
    $where .= " AND entrance_year = '$entrance_year'";

if($executive_list)
    $where .= " AND executive != ''";

 if($is_admin !== 'superadmin'){
    $where .= " AND reunion_id = '$reunionID'";
 }


$sql_search = " where (1) ";
if ($stx) {
    $sql_search .= " and ( ";
    switch ($sfl) {
        case 'mb_point' :
            $sql_search .= " ({$sfl} >= '{$stx}') ";
            break;
        case 'mb_level' :
            $sql_search .= " ({$sfl} = '{$stx}') ";
            break;
        case 'mb_tel' :
        case 'mb_hp' :
            $sql_search .= " ({$sfl} like '%{$stx}') ";
            break;
        default :
            $sql_search .= " ({$sfl} like '{$stx}%') ";
            break;
    }
    $sql_search .= " ) ";
}

// if ($is_admin != 'super')
//     $sql_search .= " and mb_level <= '{$member['mb_level']}' ";

if (!$sst) {
    $sst = "mb_no";
    $sod = "desc";
}

$sql_order = " order by {$sst} {$sod} ";

$sql = " select count(*) as cnt {$sql_common} {$sql_search} {$where} {$sql_order} ";
$row = sql_fetch($sql);
$total_count = $row['cnt'];

// $rows = $config['cf_page_rows'];
$rows = 30;
$total_page  = ceil($total_count / $rows);  // 전체 페이지 계산
if ($page < 1) $page = 1; // 페이지가 없으면 첫 페이지 (1 페이지)
$from_record = ($page - 1) * $rows; // 시작 열을 구함

$listall = '<a href="'.$_SERVER['SCRIPT_NAME'].'" class="ov_listall">전체목록</a>';



$sql = " select * {$sql_common} {$sql_search} {$where} {$sql_order} limit {$from_record}, {$rows} ";
$result = sql_query($sql);

$colspan = 20;
?>



<form name="fmemberlist" id="fmemberlist" action="./member_list_update.php" onsubmit="return fmemberlist_submit(this);" method="post">
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

    <div class="rigth">
        <div>
            <?php if($is_admin !== 'superadmin') { ?>
                <a href="./member_form.php" id="member_add" class="btn btn_01">회원추가</a>
                <a href="./memberexcel.php" id="member_add" class="btn btn_02" onclick="return excelform(this.href);" target="_blank">엑셀등록</a>
            <?php }?>
                <a href="./excel.member_export.php" id="member_add" class="btn btn_02">엑셀저장</a>
        </div>
        <?php if($is_admin !== 'superadmin') { ?>
        <div>
            <a href="<?php echo G5_URL; ?>/<?php echo G5_LIB_DIR; ?>/Excel/memberexcel3.xls" class="excel_down">회원일괄등록용 엑셀파일 다운로드</a>
        </div>
        <?php }?>
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
        <th scope="col">계열</th>
        <th scope="col">학과</th>
        <th scope="col">성명1</th>
        <th scope="col">성명2</th>
        <th scope="col">기수</th>
        <th scope="col">학번</th>
        <th scope="col">입학</th>
        <th scope="col">졸업</th>
        <th scope="col">휴대폰번호</th>
        <th scope="col">이메일</th>
        <th scope="col">직장</th>
        <th scope="col">부서</th>
        <th scope="col">직위</th>
        <th scope="col">직장전화</th>
        <th scope="col">직장주소</th>
        <th scope="col">자택주소</th>
        <th scope="col">자택전화</th>
        <th scope="col">임원명</th>
        <th scope="col">성별</th>
        <th scope="col">생년월일</th>
        <th scope="col">비고</th>
    </tr>
    </thead>
    <tbody>
    <?php
    for ($i=0; $row=sql_fetch_array($result); $i++) {
        // 접근가능한 그룹수
        $sql2 = " select count(*) as cnt from {$g5['group_member_table']} where mb_id = '{$row['mb_id']}' ";
        $row2 = sql_fetch($sql2);
        $group = '';
        if ($row2['cnt'])
            $group = '<a href="./boardgroupmember_form.php?mb_id='.$row['mb_id'].'">'.$row2['cnt'].'</a>';

        if ($is_admin == 'group') {
            $s_mod = '';
        } else {
            $s_mod = './member_form.php?'.$qstr.'&amp;w=u&amp;mb_id='.$row['mb_id'];
        }
        $s_grp = '<a href="./boardgroupmember_form.php?mb_id='.$row['mb_id'].'" class="btn btn_02">그룹</a>';

        $leave_date = $row['mb_leave_date'] ? $row['mb_leave_date'] : date('Ymd', G5_SERVER_TIME);
        $intercept_date = $row['mb_intercept_date'] ? $row['mb_intercept_date'] : date('Ymd', G5_SERVER_TIME);

        $mb_nick = get_sideview($row['mb_id'], get_text($row['mb_nick']), $row['mb_email'], $row['mb_homepage']);

        $mb_id = $row['mb_id'];
        $leave_msg = '';
        $intercept_msg = '';
        $intercept_title = '';
        if ($row['mb_leave_date']) {
            $mb_id = $mb_id;
            $leave_msg = '<span class="mb_leave_msg">탈퇴함</span>';
        }
        else if ($row['mb_intercept_date']) {
            $mb_id = $mb_id;
            $intercept_msg = '<span class="mb_intercept_msg">차단됨</span>';
            $intercept_title = '차단해제';
        }
        if ($intercept_title == '')
            $intercept_title = '차단하기';

        $address = $row['mb_zip1'] ? print_address($row['mb_addr1'], $row['mb_addr2'], $row['mb_addr3'], $row['mb_addr_jibeon']) : '';

        $bg = 'bg'.($i%2);

        switch($row['mb_certify']) {
            case 'hp':
                $mb_certify_case = '휴대폰';
                $mb_certify_val = 'hp';
                break;
            case 'ipin':
                $mb_certify_case = '아이핀';
                $mb_certify_val = '';
                break;
            case 'admin':
                $mb_certify_case = '관리자';
                $mb_certify_val = 'admin';
                break;
            default:
                $mb_certify_case = '&nbsp;';
                $mb_certify_val = 'admin';
                break;
        }
    ?>

    <tr class="<?php echo $bg; ?>" >
        <td headers="mb_list_chk" class="td_chk">
            <input type="hidden" name="mb_id[<?php echo $i ?>]" value="<?php echo $row['mb_id'] ?>" id="mb_id_<?php echo $i ?>">
            <label for="chk_<?php echo $i; ?>" class="sound_only"><?php echo get_text($row['mb_name']); ?> <?php echo get_text($row['mb_nick']); ?>님</label>
            <input type="checkbox" name="chk[]" value="<?php echo $i ?>" id="chk_<?php echo $i ?>">
        </td>
        <td onClick="location.href='<?=$s_mod?>'">
            <?= $row['type'] ?>
        </td>
        <td onClick="location.href='<?=$s_mod?>'">
            <?= $row['affiliation'] ?>
        </td>
        <td onClick="location.href='<?=$s_mod?>'">
            <?= $row['department'] ?>
        </td>
        <td onClick="location.href='<?=$s_mod?>'">
            <?= $row['mb_name'] ?>
        </td>
        <td onClick="location.href='<?=$s_mod?>'">
            <?= ($row['name2'])? $row['name2'] : "-" ?>
        </td>
        <!-- 기수 -->
        <td onClick="location.href='<?=$s_mod?>'">
            <?= ($row['generation'])? $row['generation'] : "-" ?>
        </td>
        <!-- 학번 -->
        <td onClick="location.href='<?=$s_mod?>'">
            <?= ($row['admission_year'])? $row['admission_year'] : "-" ?>
        </td>
        <td onClick="location.href='<?=$s_mod?>'">
            <?= ($row['entrance_year'])? $row['entrance_year'] : "-" ?>
        </td>
        <td onClick="location.href='<?=$s_mod?>'">
            <?= ($row['graduation_year'])? $row['graduation_year'] : "-" ?>
        </td>
        <td onClick="location.href='<?=$s_mod?>'">
            <?= ($row['mb_hp'])? $row['mb_hp'] : "-" ?>
        </td>
        <td onClick="location.href='<?=$s_mod?>'">
            <?= ($row['mb_email'])? $row['mb_email'] : "-" ?>
        </td>
        <td onClick="location.href='<?=$s_mod?>'">
            <?= ($row['job'])? $row['job'] : "-" ?>
        </td>
        <td onClick="location.href='<?=$s_mod?>'">
            <?= ($row['job_department'])? $row['job_department'] : "-" ?>
        </td>
        <td onClick="location.href='<?=$s_mod?>'">
            <?= ($row['job_position'])? $row['job_position'] : "-" ?>
        </td>
        <!-- 직장전화 -->
        <td onClick="location.href='<?=$s_mod?>'">
            <?= ($row['workplace_tel'])? "Y" : "N" ?>
        </td>
        <td onClick="location.href='<?=$s_mod?>'">
            <?= ($row['workplace_addr'])? "Y" : "N" ?>
        </td>
        <td onClick="location.href='<?=$s_mod?>'">
            <?= ($row['mb_addr1'])? "Y" : "N" ?>
        </td>
        <td onClick="location.href='<?=$s_mod?>'">
            <?= ($row['mb_tel'])? "Y" : "N" ?>
        </td>
        <td onClick="location.href='<?=$s_mod?>'">
            <?= ($row['executive'])? $row['executive'] : "-" ?>
        </td>
        <td onClick="location.href='<?=$s_mod?>'">
            <?= ($row['mb_sex'] == 'male')? "남": "여" ?>
        </td>
        <td onClick="location.href='<?=$s_mod?>'">
            <?= ($row['mb_birth'])? $row['mb_birth'] : "-" ?>
        </td>
        <td onClick="location.href='<?=$s_mod?>'">
            <?= ($row['etc'])? "Y" : "N" ?>
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

    <div class="del-btn-wrap">
        <input type="submit" name="act_button" value="선택삭제" onclick="document.pressed=this.value" class="btn btn_02">
    </div> 

</form>

<?php echo get_paging(G5_IS_MOBILE ? $config['cf_mobile_pages'] : $config['cf_write_pages'], $page, $total_page, '?'.$qstr.'&amp;page='); ?>

<script>
function excelform(url) {
    var opt = "width=600,height=450,left=10,top=10";
    window.open(url, "win_excel", opt);
    return false;
}
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