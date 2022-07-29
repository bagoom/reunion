<?php
include_once('./_common.php');

$sql = "SELECT * FROM {$g5['branch']} WHERE branch_id = $branch_id AND  reunion_id = '{$reunionID}'";
$branch = sql_fetch($sql);

echo json_encode($branch);
