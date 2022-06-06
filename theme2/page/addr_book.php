<?php
include_once('./_common.php');
$g5['title'] = '동문 주소록';
include_once(G5_PATH.'/head.php');


$count = sql_fetch( "SELECT count(*) AS num FROM {$g5['member_table']} WHERE mb_id != 'admin' AND reunion_id = $reunionID " );
$count2 = $count['num'];
function EmailMasking($str){ // 수정 보완 필요
    $pattern = '/(\w+)(\w{3})(@.{1})(?=.*?\.)(.+)/i';
    $replace = '\1***\3*\5';
    $str = preg_replace('/(\w+)(\w{3})(@.{1})([\w*?]+)(.+)/i','\1***\3*\5',$str);
    return $str;
}

function setMasking($obj) {
    $result = "";
    $strLen = mb_strlen($obj);

    switch($strLen) {
        case 12 : $result = preg_replace('/([0-9]+)-([0-9]+)-([0-9]{4})/', '${1}-***-$3', $obj); break;
        case 13 : $result = preg_replace('/([0-9]+)-([0-9]+)-([0-9]{4})/', '${1}-****-$3', $obj); break;
        default : $result = preg_replace('/([0-9]+)-([0-9]+)-([0-9]{4})/', '${1}-****-$3', $obj); break;
    }

    return $result;
}

$where = "(1=1)";

if($generation)
    $where .= " AND generation= '$generation'";

if($graduation_year)
    $where .= " AND graduation_year= '$graduation_year'";

if($mb_name)
    $where .= " AND mb_name like '%{$mb_name}%'";

if($branch_name)
    $where .= " AND c.branch_name like '%{$branch_name}%'";

if (!$sst) {
    if($branch_name){
        $sst = "a.mb_no";
    }else{
        $sst = "mb_no";
    }
    $sod = "desc";
}

$sql_order = " order by {$sst} {$sod} ";

$total_count = $count2;

// $rows = $config['cf_page_rows'];
$rows = 30;
$total_page  = ceil($total_count / $rows);  // 전체 페이지 계산
if ($page < 1) $page = 1; // 페이지가 없으면 첫 페이지 (1 페이지)
$from_record = ($page - 1) * $rows; // 시작 열을 구함

if($branch_name){
    $sql = "SELECT * FROM {$g5['member_table']} a, `branch_member`b, {$g5['branch']} c WHERE $where AND b.branch_id = c.branch_id AND a.mb_no = b.mb_no AND  a.mb_id != 'admin' AND a.reunion_id = $reunionID  $sql_order limit {$from_record}, {$rows} ";
}else{
    $sql = "SELECT * FROM {$g5['member_table']} WHERE $where AND mb_id != 'admin' AND reunion_id = $reunionID  $sql_order limit {$from_record}, {$rows} ";
}

$result = sql_query($sql);

?>

<link rel="stylesheet" href="<?=G5_CSS_URL?>/addr_book.css?ver=<?=G5_CSS_VER?>">

<form id="fsearch" name="fsearch"class="local_sch03 local_sch" method="get">
    <div class="flex-box">
        <div class="left">
            <div class="input-row">
                <div class="input-col">
                    <input type="text" name="generation" value="<?= $generation?>" id="generation" class="frm_input" placeholder="기수">
                </div>
                <div class="input-col">
                    <input type="text" name="graduation_year" value="<?= $graduation_year?>" id="graduation_year" class="frm_input" placeholder="졸업">
                </div>
                <div class="input-col">
                    <input type="text" name="branch_name" value="<?php echo $branch_name ?>" id="branch_name"  class=" frm_input" placeholder="소속지회">
                </div>
                <div class="input-col">
                    <input type="text" name="mb_name" value="<?=$mb_name ?>" id="mb_name" class=" frm_input" placeholder="이름">
                </div>
            </div>

        </div>

        <div class="rigth">
            <input type="submit" value="검색" class="btn_submit" >
        </div>
    </div>
</form>

<div class="cont addr_book">

    <div class="box">
        <div class="rel_table">
            <div class="tables">
                <ul class="tables_th font-b">
                    <li class="pa_year">기수</li>
                    <li class="pa_graduation_year">졸업년도</li>
                    <li class="pa_name">이름</li>
                    <li class="pa_tel">휴대폰번호</li>
                    <li class="pa_address">주소</li>
                    <li class="pa_email">이메일</li>
                    <li class="pa_branch">소속지회명</li>
                </ul>
                <?php for($i=0; $row=sql_fetch_array($result); $i++) { 
                    // $branch_id = sql_fetch("SELECT branch_id FROM `branch_member` WHERE mb_no = '{$row[mb_no]}' ");
                    $branch = get_branch($row['mb_no'], null);
                ?>
                <ul class="tables_td">
                    <li class="pa_year"><?= ($row['generation']) ?  $row['generation']  : "-" ?></li>
                    <li class="pa_graduation_year"><?= ($row['graduation_year']) ?  $row['graduation_year']  : "-" ?></li>
                    <li class="pa_name"><a href="<?=G5_BBS_URL ?>/member_confirm.php?url=/bbs/register_form.php&mb_no=<?=$row['mb_no']?>"><?=($row['mb_name']) ? $row['mb_name'] : "-" ?></a></li>
                    <li class="pa_tel"><i class="xi-call <?=($row['mb_hp']) ? 'on' : null ?>"></i></li>
                    <li class="pa_address"><i class="xi-home <?=($row['mb_addr1']) ? 'on' : null ?>"></i></li>
                    <li class="pa_email"><i class="xi-mail <?=($row['mb_email']) ? 'on' : null ?>"></i></li>
                    <li class="pa_branch"><?=($branch) ? $branch : "-" ?></li>
                </ul>

                <?php } ?>
                <?php if (count($count2) == 0) { echo '<ul class="tables_td" style="text-align:center">등록된 회원이 없습니다.</ul>'; } ?>

            </div>
        </div>
        <?php echo get_paging(G5_IS_MOBILE ? $config['cf_mobile_pages'] : $config['cf_write_pages'], $page, $total_page, '?'.$qstr.'&amp;page='); ?>
    </div>

    <div class="help">
        총동문회 주소록은 개인 정보 보호를 위해 개인 정보는 본인 이외에는 열람되지 않습니다.<br>
        동문정보 열람 등에 관한 사항은 총동문회 사무국으로 문의바랍니다.
    </div>


<?php
include_once(G5_PATH.'/tail.php');
?>