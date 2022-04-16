<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가
include_once(G5_LIB_PATH.'/thumbnail.lib.php');
// add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
add_stylesheet('<link rel="stylesheet" href="'.$latest_skin_url.'/style.css">', 0);
$thumb_width = 297;
$thumb_height = 212;
$list_count = (is_array($list) && $list) ? count($list) : 0;
?>

<div class="event_latest">
    <ul>
    <?php
    for ($i=0; $i<$list_count; $i++) {
        $img_link_html = '';
        $wr_href = get_pretty_url($bo_table, $list[$i]['wr_id']);
        ?>
            <a href="<?=$list[$i]['href']?>">
                <li >
                    <div class="con">
                        <div class="cate"><?=$list[$i]['ca_name']?></div>
                        <div class="tit"><?=$list[$i]['subject']?></div>
                        <div class="desc"><?=iconv_substr(trim($list[$i]['wr_content']),0 , 85, "utf-8")?></div>
                    </div>
                </li>
            </a>
    <?php }  ?>
    <?php if ($list_count == 0) { //게시물이 없을 때  ?>
    <li class="empty_li">게시물이 없습니다.</li>
    <?php }  ?>
    </ul>

</div>
