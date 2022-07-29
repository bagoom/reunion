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


$total_count_sql = sql_fetch("SELECT count(*) AS count FROM {$g5['branch']} WHERE  $where AND reunion_id = '{$reunionID}'");
$total_count = $total_count_sql['count'];
$rows = 12;
$total_page  = ceil($total_count / $rows);  // 전체 페이지 계산
if ($page < 1) $page = 1; // 페이지가 없으면 첫 페이지 (1 페이지)
$from_record = ($page - 1) * $rows; // 시작 열을 구함

$sql = "SELECT * FROM {$g5['branch']}  WHERE  $where  AND reunion_id = '{$reunionID}' ORDER BY branch_id DESC  limit {$from_record}, {$rows}" ;
$result = sql_query($sql);

?>

<div class="cont branch">
    <div class="box">
        <ul class="branch-list">
            <?php for($i=0; $row=sql_fetch_array($result); $i++) { 
                $chairman_data = sql_fetch("SELECT * FROM {$g5['branch_member']} WHERE branch_id = '{$row['branch_id']}' AND grade = '회장'");
                $manager_data = sql_fetch("SELECT * FROM {$g5['branch_member']} WHERE branch_id = '{$row['branch_id']}' AND grade = '총무'");

                $chairman = get_member2($chairman_data['mb_no']);
                $manager = get_member2($manager_data['mb_no']);

                $branch_mem_count_sql = sql_fetch("SELECT count(*) AS count FROM {$g5['branch']} a, {$g5['branch_member']} b  WHERE a.branch_id = b.branch_id AND b.branch_id = '{$row['branch_id']}' ");
                $branch_mem_count = $branch_mem_count_sql['count'];
            ?>
            <li data-id="<?=$row['branch_id']?>" >
                <div class="cover"  style="background-image: url(<?=($row['branch_img']) ? G5_DATA_URL.$row['branch_img'] : null?>)"></div>
                <div class="contents">
                    <div class="icon"></div>
                    <div class="tit"><?=$row['branch_name']?></div>
                    <?php /*<div class="tel"><?=$chairman['mb_hp']?></div>*/?>
                    <div class="info">
                        <div class="member">회원수 : <b><?=$branch_mem_count?></b>명</div>
                        <div class="admin">회장 : <b><?=$chairman['mb_name']?> <?= ($chairman['generation']) ?  '('.$chairman['generation'].'기)' : null?></b></div>
                        <div class="manager">총무 : <b><?=$manager['mb_name']?> <?= ($manager['generation']) ?  '('.$manager['generation'].'기)' : null?></b></div>
                    </div>
                </div>
            </li>
            <?php }  if($i == 0) { ?>  <div class="empty">해당 지회가 없습니다.</div> <?php }?>
        </ul>
    </div>
    <?php echo get_paging(G5_IS_MOBILE ? $config['cf_mobile_pages'] : $rows, $page, $total_page, '?'.$qstr.'&amp;page='); ?>
</div>

<div id="modal">
    <div class="modal-head">
        <h3>지회명이 없습니다.</h3>
        <div class="modal-close"><i class="xi-close"></i></div>
    </div>
    <div class="modal-body">
        <div class="modal-con">
            <div class="txt">지회 소개 글이 없습니다.</div>
        </div>
    </div>
</div>
<div id="overlay"></div>


<script>
    var listItem = $(".branch-list li");

    listItem.click(function () {
        var branch_id = $(this).data("id");
        $("#modal, #overlay").addClass("open");
        
        $.ajax({
            url: g5_bbs_url+"/ajax.get_branch.php",
            type: 'POST',
            data: {
                'branch_id': branch_id,
            },
            dataType: 'JSON',
            async: false,
            success: function (data, textStatus) {
                console.log(data)
                $("#modal .modal-head h3").text(data.branch_name);
                if(data.branch_content){
                    $("#modal .modal-con .txt").text(data.branch_content);
                }else{
                    $("#modal .modal-con .txt").text('지회 소개 글이 없습니다.');
                }
                if (data.error) {
                    alert(data.error);
                    return false;
                } 
            }
        });
    });

    $("#overlay, .modal-close").click(function () {
        $("#modal, #overlay").removeClass("open");
    })
</script>
<?php
include_once(G5_PATH.'/tail.php');
?>