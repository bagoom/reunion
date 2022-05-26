<?php
include_once('./_common.php');

$sql = "SELECT * FROM {$g5['member_table']} WHERE mb_id != '{$mb_id}'  AND mb_name = '{$mb_name}' AND confirm = 'N' AND reunion_id = '{$reunionID}'";
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
        <td style="text-align: center;"><button type="button" class="confirm" data-id="<?=$row['mb_no']?>">승인</button></td>
    </tr>

<?php }?>

<?php if ($i == 0)
    echo "<tr><td colspan='7' class=\"empty_table\">자료가 없습니다.</td></tr>";
?>

<script>
    var site_mb_id = '<?=$mb_id?>';
    $(".confirm").click(function () {
        var reunion_mb_id = $(this).data("id");
        var result = confirm('해당 회원을 승인하시겠습니까?');
        if(result){
            $.ajax({
                url: "./ajax.new_mem_update.php",
                type: 'POST',
                data: {
                    'site_mb_id': site_mb_id,
                    'reunion_mb_id': reunion_mb_id
                },
                dataType: 'html',
                async: false,
                success: function (data, textStatus) {
                    console.log(data)
                    alert("승인하였습니다.");
                    location.reload();
                }
            });
        }
    })
</script>