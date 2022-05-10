<?php
include_once('../../common.php');
$g5['title'] = '동문회 지회소개';
include_once(G5_PATH.'/head.php');

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

$total_count_sql = sql_fetch("SELECT count(*) AS count FROM {$g5['branch']} WHERE  $where");
$total_count = $total_count_sql['count'];

?>

<div class="cont branch">
    <div class="box">
        <ul class="branch-list">
            <?php for($i=0; $row=sql_fetch_array($result); $i++) { 
                $chairman_data = sql_fetch("SELECT * FROM {$g5['branch_member']} WHERE branch_id = '{$row['branch_id']}' AND grade = '회장'");
                $manager_data = sql_fetch("SELECT * FROM {$g5['branch_member']} WHERE branch_id = '{$row['branch_id']}' AND grade = '총무'");

                $chairman = get_member($chairman_data['mb_id']);
                $manager = get_member($manager_data['mb_id']);

                $branch_mem_count_sql = sql_fetch("SELECT count(*) AS count FROM {$g5['branch']} a, {$g5['branch_member']} b  WHERE a.branch_id = b.branch_id AND b.branch_id = '{$row['branch_id']}' ");
                $branch_mem_count = $branch_mem_count_sql['count'];
            ?>
            <li>
                <div class="contents">
                    <div class="icon"></div>
                    <div class="tit"><?=$row['branch_name']?></div>
                    <div class="tel"><?=$chairman['mb_hp']?></div>
                    <div class="info">
                        <div class="member">회원 : <b><?=$branch_mem_count?></b>명</div>
                        <div class="admin">운영자 : <b><?=$chairman['mb_name']?></b></div>
                    </div>
            </li>
            <?php }  if($i == 0) { ?>  <div class="empty">해당 지회가 없습니다.</div> <?php }?>
        </ul>
    </div>
</div>


<?php
include_once(G5_PATH.'/tail.php');
?>