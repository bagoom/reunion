<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가
include_once(G5_LIB_PATH.'/thumbnail.lib.php');

// add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
add_stylesheet('<link rel="stylesheet" href="'.$latest_skin_url.'/style.css">', 0);
$thumb_width = 285;
$thumb_height = 204;
$list_count = (is_array($list) && $list) ? count($list) : 0;
?>

<h2 class="lat_title">
    <a href="<?php echo get_pretty_url($bo_table); ?>"><?=$bo_subject?></a>
    <p><?=$reunion['reunion_title']?>의 행사 갤러리 입니다.</p>
</h2>
<div class="swiper-container">
    <div class="swiper-wrapper">
        <?php
    for ($i=0; $i<$list_count; $i++) {
    $thumb = get_list_thumbnail($bo_table, $list[$i]['wr_id'], $thumb_width, $thumb_height, false, true, 'top');

    if($thumb['src']) {
        $img = $thumb['src'];
    } else {
        $img = G5_IMG_URL.'/no_img.png';
        $thumb['alt'] = '이미지가 없습니다.';
    }
    $img_content = '<img src="'.$img.'" alt="'.$thumb['alt'].'" >';
    $wr_href = get_pretty_url($bo_table, $list[$i]['wr_id']);
    $date = $list[$i]['datetime'];
    $date_arr = explode('-',$date);
    $year = $date_arr[0].".".$date_arr[1];
    $day = $date_arr[2];
    ?>
        <div class="swiper-slide">
            <div class="lt_info">
                <a href="<?=$wr_href?>"><?=$list[$i]['subject']?></a>
                <span class="lt_date">
                    <div class="day"><?=$day?></div>
                    <div class="year"><?=$year?></div>
                </span>
            </div>
            <a href="<?php echo $wr_href; ?>" class="lt_img">
                <?php echo run_replace('thumb_image_tag', $img_content, $thumb); ?>
            </a>
        </div>
        <?php }  ?>
        <?php if ($list_count == 0) { //게시물이 없을 때  ?>
        <li class="empty_li">게시물이 없습니다.</li>
        <?php }  ?>
        <!-- <a href="<?php echo get_pretty_url($bo_table); ?>" class="lt_more"><span class="sound_only"><?php echo $bo_subject ?></span>더보기</a> -->

    </div>
</div>
