<?php 
include_once("./_common.php"); 
include_once(G5_LIB_PATH.'/PHPExcel.php');

if (!$is_admin =="super")
  alert_close("최고 관리자 영역 입니다.");

function column_char($i) { return chr( 65 + $i ); }

$headers = array('번호', '구분', '입금날짜', '금액', '성명',  '학과', '졸업', '휴대폰', '비고');
$widths  = array(5, 15, 15, 15, 15, 15, 15, 30, 30,);
$header_bgcolor = 'FFABCDEF';
$last_char = column_char(count($headers) - 1);


$sql = "SELECT * FROM {$g5['member_table']} a, {$g5['fee']} b WHERE a.mb_id = b.mb_id ORDER BY id DESC" ;
$result = sql_query($sql);
for($i=1; $row=sql_fetch_array($result); $i++) {

    $rows[] = 
             array(
               $i,
               $row[fee_type],
               $row[deposit_date],
               $row[fee],
               $row[mb_name],
               $row[department],
               $row[graduation_year],
               $row[mb_hp],
               $row[etc]
              //  print_address($row['mb_addr1'], $row['mb_addr2'], $row['mb_addr3'], $row['mb_zip1'])
             );
}

$data = array_merge(array($headers), $rows);

$excel = new PHPExcel();
$excel->setActiveSheetIndex(0)->getStyle( "A1:${last_char}1" )->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setARGB($header_bgcolor);
$excel->setActiveSheetIndex(0)->getStyle( "A:$last_char" )->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER)->setWrapText(true);
foreach($widths as $i => $w) $excel->setActiveSheetIndex(0)->getColumnDimension( column_char($i) )->setWidth($w);
$excel->getActiveSheet()->fromArray($data,NULL,'A1');

header("Content-Type: application/octet-stream");
header("Content-Disposition: attachment; filename=\"fees-".date("ymd", time()).".xls\"");
header("Cache-Control: max-age=0");

$writer = PHPExcel_IOFactory::createWriter($excel, 'Excel5');
$writer->save('php://output');
?>