<?php
if (!defined('_GNUBOARD_')) exit;

include_once('./admin.head.php');
?>


<div class="cate-list">
    <ul>
        <li class="<?=($sub_num == '1') ? 'on' : null ?>"><a href="./report_list1.php">불량 사용자 신고 내역</a></li>
        <li class="<?=($sub_num == '2') ? 'on' : null ?>"><a href="./report_list2.php">게시글 신고 내역</a></li>
        <li class="<?=($sub_num == '3') ? 'on' : null ?>"><a href="./report_list3.php">댓글 신고 내역</a></li>
    </ul>
</div>