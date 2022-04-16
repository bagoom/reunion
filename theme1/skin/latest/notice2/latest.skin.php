<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가
include_once(G5_LIB_PATH.'/thumbnail.lib.php');
// add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
add_stylesheet('<link rel="stylesheet" href="'.$latest_skin_url.'/style.css">', 0);
$thumb_width = 297;
$thumb_height = 212;
$list_count = (is_array($list) && $list) ? count($list) : 0;
?>

<div class="notice_latest">
    <h2 class="lat_title"><a href="<?php echo get_pretty_url($bo_table); ?>"><?php echo $bo_subject ?></a></h2>
    <ul>
    <?php
    for ($i=0; $i<$list_count; $i++) {
        
        $img_link_html = '';
        
        $wr_href = get_pretty_url($bo_table, $list[$i]['wr_id']);

        if( $i === 0 ) {
            $month = date("m",strtotime($list[$i][datetime]));
            $day = date("d",strtotime($list[$i][datetime]))    
        ?>
            <a href="<?=$list[$i]['href']?>">
                <li class="first-list">
                    <div class="date">
                        <div class="month"><?=$month?></div>
                        <div class="day"><?=$day?></div>
                    </div>

                    <div class="con">
                        <div class="tit"><?=$list[$i]['subject']?></div>
                        <div class="desc"><?=iconv_substr(trim($list[$i]['wr_content']),0 , 85, "utf-8")?></div>
                    </div>
                </li>
            </a>
        <?php } else{ ?>
        <li class="notice-list">
            <?php
            if ($list[$i]['icon_secret']) echo "<i class=\"fa fa-lock\" aria-hidden=\"true\"></i><span class=\"sound_only\">비밀글</span> ";
 
            echo "<a href=\"".$wr_href."\" class=\"pic_li_tit\"> ";
            if ($list[$i]['is_notice'])
                echo "<strong>".$list[$i]['subject']."</strong>";
            else
                echo $list[$i]['subject'];

            echo "</a>";
			

            if ($list[$i]['comment_cnt'])  echo "
            <span class=\"lt_cmt\">".$list[$i]['wr_comment']."</span>";

            ?>

            <div class="lt_info">
            	<span class="lt_date"><?php echo $list[$i]['datetime'] ?></span>              
            </div>
        </li>
    <?php }  }?>
    <?php if ($list_count == 0) { //게시물이 없을 때  ?>
    <li class="empty_li">게시물이 없습니다.</li>
    <?php }  ?>
    </ul>

</div>
