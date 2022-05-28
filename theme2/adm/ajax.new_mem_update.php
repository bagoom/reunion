<?php
include_once('./_common.php');

$site_mem = get_member($site_mb_id);
$site_mem['confirm'] = 'Y';
$site_mem['mb_new'] = '';

$site_mem_no = $site_mem['mb_no'];

array_splice($site_mem, 0, 1);
$site_mem = array_filter($site_mem);
array_walk($site_mem, function(&$value, $key) {
    $value = "{$key}='{$value}'";
});

$site_mem_values = implode(', ', $site_mem);

print_r($site_mem_values);

// 회원가입한 회원의 정보는 미리 DELETE
$sql = "DELETE FROM {$g5['member_table']} WHERE mb_no = '{$site_mem_no}'";
sql_query($sql);

// 동문회원정보에 회원가입한 회원의 정보를 UPDATE
$sql = "UPDATE {$g5['member_table']} SET {$site_mem_values} WHERE mb_no = '{$reunion_mb_id}'";
// echo $sql;
sql_query($sql);
