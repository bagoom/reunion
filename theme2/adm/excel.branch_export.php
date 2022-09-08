<?php 
include_once("./_common.php"); 
include_once(G5_LIB_PATH.'/PHPExcel.php');

if (!$is_admin =="super")
  alert_close("최고 관리자 영역 입니다.");

function column_char($i) { return chr( 65 + $i ); }

$headers = array('번호', '등록일', '구분', '상태', '지회명', '회장',  '전화번호', '총무', '전화번호','지회인원');
$widths  = array(5, 15, 15, 15, 30, 15, 15, 15, 15, 15,);
$header_bgcolor = 'FFABCDEF';
$last_char = column_char(count($headers) - 1);


if($type)
    $where .= " AND type= '$type'";

if($status)
    $where .= " AND status= '$status'";

if($branch_name)
    $where .= " AND branch_name like '%{$branch_name}%'";

    
if($fee_type)
    $where .= " AND b.fee_type = '$fee_type'";


$sql = "SELECT * FROM {$g5['branch']} WHERE reunion_id = '{$reunionID}' {$where}  ORDER BY branch_id DESC" ;
$result = sql_query($sql);
for($i=1; $row=sql_fetch_array($result); $i++) {

    $chairman_data = sql_fetch("SELECT * FROM {$g5['branch_member']} WHERE branch_id = '{$row['branch_id']}' AND grade = '회장'");
    $manager_data = sql_fetch("SELECT * FROM {$g5['branch_member']} WHERE branch_id = '{$row['branch_id']}' AND grade = '총무'");
    $chairman = get_member2($chairman_data['mb_no']);
    $manager = get_member2($manager_data['mb_no']);

    $branch_mem_count_sql = sql_fetch("SELECT count(*) AS count FROM {$g5['branch']} a, {$g5['branch_member']} b  WHERE a.branch_id = b.branch_id AND b.branch_id = '{$row['branch_id']}' ");
    $branch_mem_count = $branch_mem_count_sql['count'];
    $rows[] = 
             array(
               $i,
               $row[create_date],
               $row[type],
               $row[status],
               $row[branch_name],
               $chairman[mb_name],
               $chairman[mb_hp],
               $manager[mb_name],
               $manager[mb_hp],
               $branch_mem_count
             );
}

$data = array_merge(array($headers), $rows);

$excel = new PHPExcel();
$excel->setActiveSheetIndex(0)->getStyle( "A1:${last_char}1" )->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setARGB($header_bgcolor);
$excel->setActiveSheetIndex(0)->getStyle( "A:$last_char" )->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER)->setWrapText(true);
foreach($widths as $i => $w) $excel->setActiveSheetIndex(0)->getColumnDimension( column_char($i) )->setWidth($w);
$excel->getActiveSheet()->fromArray($data,NULL,'A1');

header("Content-Type: application/octet-stream");
header("Content-Disposition: attachment; filename=\"branchs-".date("ymd", time()).".xls\"");
header("Cache-Control: max-age=0");

$writer = PHPExcel_IOFactory::createWriter($excel, 'Excel5');
ob_end_clean();
$writer->save('php://output');
?>