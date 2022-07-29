<?php 
include_once("./_common.php"); 
include_once(G5_LIB_PATH.'/PHPExcel.php');

if (!$is_admin =="super")
  alert_close("최고 관리자 영역 입니다.");
function column_char($i) { return chr( 65 + $i ); }

$headers = array('번호', 'ID', '구분', '계열', '학과', '성명1', '성명2', '기수', '학번', '입학', '졸업', '휴대폰', '이메일', '직장', '부서', '직위', '직장전화', '직장주소', '자택주소', '자택전화', '임원명', '성별', '생년월일', '비고');
$widths  = array(5, 15, 15, 15, 15, 15, 15, 10, 10, 10, 10, 20, 20, 50, 20, 15, 20, 50, 50,20,20,15,20,50);
$header_bgcolor = 'FFABCDEF';
$last_char = column_char(count($headers) - 1);

if($type)
    $where .= " AND type= '$type'";

if($affiliation)
    $where .= " AND affiliation = '$affiliation'";

if($department)
    $where .= " AND department = '$department'";

if($mb_hp)
    $where .= " AND replace(mb_hp,'-','') like '%$mb_hp%'";
    
if($mb_name)
    $where .= " AND mb_name = '$mb_name'";
    
if($entrance_num)
    $where .= " AND entrance_num = '$entrance_num'";

if($graduation_year)
    $where .= " AND graduation_year = '$graduation_year'";

if($entrance_year)
    $where .= " AND entrance_year = '$entrance_year'";

if($executive_list)
    $where .= " AND executive != ''";

    $where .= " AND mb_new = ''";

 if($is_admin !== 'superadmin'){
    $where .= " AND reunion_id = '$reunionID'";
 }

if (!$sst) {
    $sst = "mb_no";
    $sod = "desc";
}


$sql_search = " where (1) ";
if ($stx) {
    $sql_search .= " and ( ";
    switch ($sfl) {
        case 'job' :
            $sql_search .= " ({$sfl} like '%{$stx}%') ";
            break;
        case 'job_position' :
            $sql_search .= " ({$sfl} like '%{$stx}%') ";
            break;
        case 'mb_email' :
            $sql_search .= " ({$sfl} like '%{$stx}%') ";
            break;
        case 'addr' :
            $sql_search .= " (mb_addr1 like '%{$stx}%') OR (mb_addr2 like '%{$stx}%') OR (mb_addr3 like '%{$stx}%')   ";
            break;
        default :
            $sql_search .= " ({$sfl} like '{$stx}%') ";
            break;
    }
    $sql_search .= " ) ";
}

if (!$sst) {
    $sst = "mb_no";
    $sod = "desc";
}
$sql_order = " order by {$sst} {$sod} ";

$sql    = " select * from g5_member {$sql_search} {$where}  {$sql_order} ";
$result = sql_query($sql);
for($i=1; $row=sql_fetch_array($result); $i++) {

   if ($row['mb_sex'] =="male") { $mb_sex ="남"; } else if ($row['mb_sex'] =="female"){ $mb_sex ="여"; } 
   if ($row['mb_mailling'] =="1") { $mb_mailling ="받음"; } else if ($row['mb_mailling'] =="0"){ $mb_mailling ="안받음"; } 
   if ($row['mb_open'] =="1") { $mb_open  ="공개"; } else if ($row['mb_open'] =="0"){ $mb_open ="비공개"; } 
   $addr = $row['mb_addr1']." ".$row['mb_addr2'];
    $rows[] = 
             array(
               $i,
               $row[mb_id],
               $row[type],
               $row[affiliation],
               $row[department],
               $row[mb_name],
               $row[mb_nick],
               $row[generation],
               $row[admission_year],
               $row[entrance_year],
               $row[graduation_year],
               $row[mb_hp],
               $row[mb_email],
               $row[job],
               $row[job_department],
               $row[job_position],
               $row[workplace_tel],
               $row[workplace_addr],
               $addr,
               $row[mb_tel],
               $row[executive],
               $mb_sex,
               $row[mb_birth],
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
header("Content-Disposition: attachment; filename=\"members-".date("ymd", time()).".xls\"");
header("Cache-Control: max-age=0");

$writer = PHPExcel_IOFactory::createWriter($excel, 'Excel5');
ob_end_clean();
$writer->save('php://output');
exit;
?>