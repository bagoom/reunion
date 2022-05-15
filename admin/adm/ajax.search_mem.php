<?php
include_once('./_common.php');

$sql = "SELECT * FROM {$g5['member_table']} WHERE mb_name = '$mb_name'";
$result = sql_query($sql);
echo $sql;

for ($i=0; $row=sql_fetch_array($result); $i++) { ?>
    <tr data-id="<?=$row['mb_id']?>" data-name="<?=$row['mb_name']?>">
        <td><?=$row['mb_id']?></td>
        <td><?=$row['mb_name']?></td>
        <td><?=$row['department']?></td>
        <td><?=$row['entrance_year']?></td>
        <td><?=$row['graduation_year']?></td>
        <td><?=$row['mb_hp']?></td>
    </tr>

<?php }?>

<?php if ($i == 0)
    echo "<tr><td colspan='5' class=\"empty_table\">자료가 없습니다.</td></tr>";
?>