<?php
$sub_menu = "400000";
include_once('./_common.php');

auth_check_menu($auth, $sub_menu, 'r');
$g5['title'] = '홍보관리 - 이메일';
include_once('./admin.head.php');

$where = "(1=1)";

if($type)
    $where .= " AND type= '$type'";

if($status)
    $where .= " AND status= '$status'";

if($branch_name)
    $where .= " AND branch_name like '%{$branch_name}%'";

    
if($fee_type)
    $where .= " AND b.fee_type = '$fee_type'";

if($is_admin !== 'superadmin'){    
    $sql = "SELECT * FROM {$g5['branch']}  WHERE  $where  AND reunion_id = '{$reunionID}' ORDER BY branch_id DESC" ;
}else{
    $sql = "SELECT * FROM {$g5['branch']}  WHERE  $where  ORDER BY branch_id DESC" ;
}
$result = sql_query($sql);
if($is_admin !== 'superadmin'){    
    $total_count_sql = sql_fetch("SELECT count(*) AS count FROM {$g5['branch']} WHERE  $where AND reunion_id = '{$reunionID}' ");
}else{
    $total_count_sql = sql_fetch("SELECT count(*) AS count FROM {$g5['branch']} WHERE  $where");
}
$total_count = $total_count_sql['count'];
$colspan = 8;
?>





<?php
include_once ('./admin.tail.php');