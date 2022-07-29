<?php
if (!defined("_GNUBOARD_")) {
  exit();
} // 개별 페이지 접근 불가
include_once G5_LIB_PATH . "/thumbnail.lib.php";

// add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
add_stylesheet(
  '<link rel="stylesheet" href="' . $latest_skin_url . '/style.css">',
  0
);
$thumb_width = 297;
$thumb_height = 212;
$list_count = is_array($list) && $list ? count($list) : 0;
?>

<div class="pic_li_lt">
    <h2 class="lat_title"><a href="<?php echo get_pretty_url($bo_table); ?>">NOTICE</a></h2>
    <ul>
        <?php for ($i = 0; $i < $list_count; $i++) {

      $img_link_html = "";

      $wr_href = get_pretty_url($bo_table, $list[$i]["wr_id"]);
      ?>
        <li>
            <?php
            if ($list[$i]["icon_secret"]) {
              echo "<i class=\"fa fa-lock\" aria-hidden=\"true\"></i><span class=\"sound_only\">비밀글</span> ";
            }

            echo "<a href=\"" . $wr_href . "\" class=\"pic_li_tit\"> ";
            if ($list[$i]["is_notice"]) {
              echo "<strong>" . $list[$i]["subject"] . "</strong>";
            } else {
              if ($list[$i]["ca_name"]) {
                echo "[" . $list[$i]["ca_name"] . "] ";
              }
              echo $list[$i]["subject"];
            }

            echo "</a>";

            // if ($list[$i]['link']['count']) { echo "[{$list[$i]['link']['count']}]"; }
            // if ($list[$i]['file']['count']) { echo "<{$list[$i]['file']['count']}>"; }

            //echo $list[$i]['icon_reply']." ";
            // if ($list[$i]['icon_file']) echo " <i class=\"fa fa-download\" aria-hidden=\"true\"></i>" ;
            //if ($list[$i]['icon_link']) echo " <i class=\"fa fa-link\" aria-hidden=\"true\"></i>" ;

            if ($list[$i]["comment_cnt"]) {
              echo "
            <span class=\"lt_cmt\">" .
                $list[$i]["wr_comment"] .
                "</span>";
            }
            ?>

            <div class="lt_info">
                <span class="lt_date"><?php echo $list[$i][
               "datetime"
             ]; ?></span>
            </div>
        </li>
        <?php
    } ?>
        <?php if ($list_count == 0) { ?>
        <li class="empty_li">게시물이 없습니다.</li>
        <?php } ?>
    </ul>
    <a href="<?php echo get_pretty_url($bo_table); ?>" class="lt_more"><span
            class="sound_only"><?php echo $bo_subject; ?></span>더보기</a>

</div>
