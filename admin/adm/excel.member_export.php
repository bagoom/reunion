<?php 
include_once("./_common.php"); 
include_once(G5_LIB_PATH.'/PHPExcel.php');

if (!$is_admin =="super")
  alert_close("최고 관리자 영역 입니다.");

function column_char($i) { return chr( 65 + $i ); }

$headers = array('번호', 'ID', '구분', '계열', '학과', '이름',  '입학', '졸업', '휴대폰', 'Email', '직장', '부서', '직위', '직장주소', '자택주소', '임원명', '성별', '자택전화', '생년월일');
$widths  = array(5, 15, 15, 15, 15, 15, 15, 15, 20, 20, 20, 20, 20, 50, 50, 15, 5, 15, 15);
$header_bgcolor = 'FFABCDEF';
$last_char = column_char(count($headers) - 1);


$sql    = " select * from g5_member where mb_leave_date = '' and reunion_id = '{$reunionID}' order by mb_datetime desc ";
$result = sql_query($sql);
for($i=1; $row=sql_fetch_array($result); $i++) {

   if ($row['mb_sex'] =="M") { $mb_sex ="남자"; } else if ($row['mb_sex'] =="F"){ $mb_sex ="여자"; } 
   if ($row['mb_mailling'] =="1") { $mb_mailling ="받음"; } else if ($row['mb_mailling'] =="0"){ $mb_mailling ="안받음"; } 
   if ($row['mb_open'] =="1") { $mb_open  ="공개"; } else if ($row['mb_open'] =="0"){ $mb_open ="비공개"; } 
    $rows[] = 
             array(
               $i,
               $row[mb_id],
               $row[type],
               $row[affiliation],
               $row[department],
               $row[mb_name],
               $row[entrance_year],
               $row[graduation_year],
               $row[mb_hp],
               $row[mb_email],
               $row[job],
               $row[job_department],
               $row[job_position],
               $row[workplace_addr],
               $row[addr],
               $row[executive],
               $mb_sex,
               $row[workplace_tel],
               $row[mb_birth]
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
header("Content-Disposition: attachment; filename=\"members-".date("ymd", time()).".xls\"");
header("Cache-Control: max-age=0");

$writer = PHPExcel_IOFactory::createWriter($excel, 'Excel5');
$writer->save('php://output');
?>