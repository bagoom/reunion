<?php
include_once('./_common.php');
$g5['title'] = '동문 주소록';
include_once(G5_PATH.'/head.php');

$sql = "SELECT * FROM {$g5['member_table']} WHERE mb_id != 'admin' ";
$result = sql_query($sql);
$count = sql_fetch( "SELECT count(*) AS num FROM {$g5['member_table']} WHERE mb_id != 'admin' " );
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

?>

<link rel="stylesheet" href="<?=G5_CSS_URL?>/addr_book.css">

<div class="cont addr_book">

    <div class="box">
        <div class="rel_table">
            <div class="tables">
                <ul class="tables_th font-b">
                    <li class="pa_name">지회명</li>
                    <li class="pa_name">이름</li>
                    <li class="pa_tel">대표전화</li>
                    <li class="pa_address">주소</li>
                    <li class="pa_time">이메일</li>
                    <li class="pa_link">메일 보내기</li>
                    <div class="cb"></div>
                </ul>
                <?php for($i=0; $row=sql_fetch_array($result); $i++) { ?>
                <ul class="tables_td">
                    <li class="pa_name"><?php if($list[$i]['wr_1']) { echo $list[$i]['wr_1']; } else { echo "-"; } ?></li>
                    <li class="pa_name"><?=($row['mb_name']) ? $row['mb_name'] : "-" ?></li>
                    <li class="pa_tel"><?=($row['mb_hp']) ? setMasking($row['mb_hp']) : "-" ?></li>
                    <li class="pa_address"><?php if($list[$i]['wr_3']) { echo $list[$i]['wr_3']." ".$list[$i]['wr_4']; } else { echo "-"; } ?></li>
                    <li class="pa_time"><?=($row['mb_email']) ? EmailMasking($row['mb_email']) : "-" ?></li>
                    <li class="pa_link">
                        <?php if($list[$i]['wr_6']) { ?>
                        <a href="<?php echo $list[$i]['wr_6'] ?>" target="_blank" class="link_ico">
                            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M9.25 4.75H6.75C5.64543 4.75 4.75 5.64543 4.75 6.75V17.25C4.75 18.3546 5.64543 19.25 6.75 19.25H17.25C18.3546 19.25 19.25 18.3546 19.25 17.25V14.75" stroke="#999999" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                <path d="M19.25 9.25V4.75H14.75" stroke="#999999" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                <path d="M19 5L11.75 12.25" stroke="#999999" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                            </svg>
                        </a>
                        <?php }?>
                    </li>
                    <div class="cb"></div>
                </ul>

                <?php } ?>
                <?php if (count($count2) == 0) { echo '<ul class="tables_td" style="text-align:center">등록된 회원이 없습니다.</ul>'; } ?>

            </div>
        </div>
        <?php for($i=0; $row=sql_fetch_array($result); $i++) { ?>

        <?php }?>
    </div>


<?php
include_once(G5_PATH.'/tail.php');
?>