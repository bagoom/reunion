<?php
include_once('./_common.php');

$price = sql_fetch("SELECT fd_price FROM `fee_division` WHERE fd_name = '{$fd_name}' AND reunion_id = '{$reunionID}'");
print_r($price['fd_price']);
?>