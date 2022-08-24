<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가
include_once(G5_LIB_PATH.'/thumbnail.lib.php');

// add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
add_stylesheet('<link rel="stylesheet" href="'.$latest_skin_url.'/style.css">', 0);
$thumb_width = 100;
$thumb_height = 73.73;
$list_count = (is_array($list) && $list) ? count($list) : 0;
?>

<div class="pic_li_lt">
    <h2 class="lat_title"><a href="<?php echo get_pretty_url($bo_table); ?>"><?php echo $bo_subject ?></a></h2>
    <ul>
    <?php
    for ($i=0; $i<$list_count; $i++) {
        
        $thumb = get_list_thumbnail($bo_table, $list[$i]['wr_id'], $thumb_width, $thumb_height, false, true);

        if($thumb['src']) {
            $img = $thumb['src'];
        } else {
            $img = G5_IMG_URL.'/no_img.png';
            $thumb['alt'] = '이미지가 없습니다.';
        }
        $img_content = '<img src="'.$img.'" alt="'.$thumb['alt'].'" >';
        $wr_href = get_pretty_url($bo_table, $list[$i]['wr_id']);
        
        ?>
        <li class="promotion_list">
            <a href="<?php echo $wr_href; ?>" class="lt_img"><?php echo run_replace('thumb_image_tag', $img_content, $thumb); ?></a>
            <div class="content">
                <a href="<?=$wr_href?>">
                    <p><?=$list[$i]['subject']?></p>
                    <div class="lt_info">
                        <span class="lt_date">대표 : <?php echo $list[$i]['wr_1'] ?></span>
                    </div>
                </a>
            </div>
        </li>
    <?php }  ?>
    <?php if ($list_count == 0) { //게시물이 없을 때  ?>
    <li class="empty_li">게시물이 없습니다.</li>
    <?php }  ?>
    </ul>
    <a href="<?php echo get_pretty_url($bo_table); ?>" class="lt_more"><span class="sound_only"><?php echo $bo_subject ?></span>더보기</a>

</div>