<?php
$sub_menu = '200100';
include_once('./_common.php');

// 상품이 많을 경우 대비 설정변경
set_time_limit ( 0 );
ini_set('memory_limit', '50M');

auth_check($auth[$sub_menu], "w");

function only_number($n)
{
    return preg_replace('/[^0-9]/', '', $n);
}

if($_FILES['excelfile']['tmp_name']) {
    $file = $_FILES['excelfile']['tmp_name'];

    include_once(G5_LIB_PATH.'/Excel/reader.php');

    $data = new Spreadsheet_Excel_Reader();

    // Set output Encoding.
    $data->setOutputEncoding('UTF-8');

    /***
    * if you want you can change 'iconv' to mb_convert_encoding:
    * $data->setUTFEncoder('mb');
    *
    **/

    /***
    * By default rows & cols indeces start with 1
    * For change initial index use:
    * $data->setRowColOffset(0);
    *
    **/



    /***
    *  Some function for formatting output.
    * $data->setDefaultFormat('%.2f');
    * setDefaultFormat - set format for columns with unknown formatting
    *
    * $data->setColumnFormat(4, '%.3f');
    * setColumnFormat - set format for column (apply only to number fields)
    *
    **/

    $data->read($file);

    /*


     $data->sheets[0]['numRows'] - count rows
     $data->sheets[0]['numCols'] - count columns
     $data->sheets[0]['cells'][$i][$j] - data from $i-row $j-column

     $data->sheets[0]['cellsInfo'][$i][$j] - extended info about cell

        $data->sheets[0]['cellsInfo'][$i][$j]['type'] = "date" | "number" | "unknown"
            if 'type' == "unknown" - use 'raw' value, because  cell contain value with format '0.00';
        $data->sheets[0]['cellsInfo'][$i][$j]['raw'] = value if cell without format
        $data->sheets[0]['cellsInfo'][$i][$j]['colspan']
        $data->sheets[0]['cellsInfo'][$i][$j]['rowspan']
    */

    error_reporting(E_ALL ^ E_NOTICE);

    $dup_it_id = array();
    $fail_it_id = array();
    $dup_count = 0;
    $total_count = 0;
    $fail_count = 0;
    $succ_count = 0;
        
    for ($i = 3; $i <= $data->sheets[0]['numRows']; $i++) {
        $total_count++;
        
        $j = 1;

		$mb_id				= addslashes($data->sheets[0]['cells'][$i][$j++]);
		// $mb_password		= addslashes($data->sheets[0]['cells'][$i][$j++]);
		$mb_name			= addslashes($data->sheets[0]['cells'][$i][$j++]);
        // 구분
		$type		= addslashes($data->sheets[0]['cells'][$i][$j++]);
        // 계열
		$affiliation			= addslashes($data->sheets[0]['cells'][$i][$j++]);
        // 학과
		$department		= addslashes($data->sheets[0]['cells'][$i][$j++]);
        // 기수
		$generation			= addslashes($data->sheets[0]['cells'][$i][$j++]);
        // 학번
		$admission_year			= addslashes($data->sheets[0]['cells'][$i][$j++]);
        // 입학년도
		$entrance_year			= addslashes($data->sheets[0]['cells'][$i][$j++]);
        // 졸업년도
		$graduation_year				= addslashes($data->sheets[0]['cells'][$i][$j++]);
        // 휴대폰번호
		$mb_hp				= addslashes($data->sheets[0]['cells'][$i][$j++]);
        // 이메일
		$mb_email			= addslashes($data->sheets[0]['cells'][$i][$j++]);
        // 성별
		$mb_sex			= addslashes($data->sheets[0]['cells'][$i][$j++]);
        // 직장
		$job			= addslashes($data->sheets[0]['cells'][$i][$j++]);
        // 부서
		$job_department			= addslashes($data->sheets[0]['cells'][$i][$j++]);
        // 직위
		$job_position			= addslashes($data->sheets[0]['cells'][$i][$j++]);
        // 직장전화
		$workplace_tel			= addslashes($data->sheets[0]['cells'][$i][$j++]);
        // 직장주소
		$workplace_addr			= addslashes($data->sheets[0]['cells'][$i][$j++]);
        // 기본주소
		$mb_addr1			= addslashes($data->sheets[0]['cells'][$i][$j++]);
        // 상세주소
		$mb_addr2			= addslashes($data->sheets[0]['cells'][$i][$j++]);
        // 참고주소
		$mb_addr3			= addslashes($data->sheets[0]['cells'][$i][$j++]);
        // 자택전화
		$mb_tel		= addslashes($data->sheets[0]['cells'][$i][$j++]);
        // 임원명
		$executive		= addslashes($data->sheets[0]['cells'][$i][$j++]);
        // 생년월일
		$mb_birth			= addslashes($data->sheets[0]['cells'][$i][$j++]);
        // 비고
		$etc			= addslashes($data->sheets[0]['cells'][$i][$j++]);

        if(!$mb_id || !$mb_name) {
            $fail_count++;
            continue;
        }

        // if( !preg_match( "/^[0-9]/i", $mb_id )) {
        //      alert( $mb_name."님의 아이디는 '-'를 제외한 숫자만 입력해주세요." );
        //     continue;
        // } 
            
            



        // mb_id 중복체크
        $sql2 = " select count(*) as cnt from {$g5['member_table']} where mb_id = '$mb_id' ";
        $row2 = sql_fetch($sql2);
        
        if($row2['cnt']) {
            $fail_mb_id[] = $mb_id;
            $dup_mb_id[] = $mb_id;
            $dup_count++;
            $fail_count++;
            continue;
        }

		/*
		mb_datetime = '".G5_TIME_YMDHIS."',
		*/

        $sql = " INSERT INTO {$g5['member_table']}
                     SET mb_id = '$mb_id',
                        --  mb_password = '".sql_password($mb_password)."',
                         mb_name = '$mb_name',
                         type= '$type',
                         mb_level= '2',
                         affiliation= '$affiliation',
                         department= '$department',
                         generation= '$generation',
                         admission_year= '$admission_year',
                         entrance_year= '$entrance_year',
                         graduation_year= '$graduation_year',
                         mb_hp= '$mb_hp',
                         mb_email= '$mb_email',
                         mb_sex= '$mb_sex',
                         job= '$job',
                         job_department= '$job_department',
                         job_position= '$job_position',
                         workplace_tel= '$workplace_tel',
                         workplace_addr= '$workplace_addr',
                         mb_addr1= '$mb_addr1',
                         mb_addr2= '$mb_addr2',
                         mb_addr3= '$mb_addr3',
                         executive= '$executive',
                         mb_tel= '$mb_tel',
                         mb_birth= '$mb_birth',
                         etc= '$etc',
                         confirm= 'N',
                         reunion_id = '{$reunionID}' ";
                         
        sql_query($sql);

        // echo $sql;

        $succ_count++;
    }
}


$g5['title'] = '회원 엑셀일괄등록 결과';
include_once(G5_PATH.'/head.sub.php');
?>

<div class="new_win">
    <h1><?php echo $g5['title']; ?></h1>

    <div class="local_desc01 local_desc">
        <p>회원등록을 완료했습니다.</p>
    </div>

    <dl id="excelfile_result">
        <dt>총회원수</dt>
        <dd><?php echo number_format($total_count); ?></dd>
        <dt>등록건수</dt>
        <dd><?php echo number_format($succ_count); ?></dd>
        <dt>실패건수</dt>
        <dd><?php echo number_format($fail_count); ?></dd>
        <?php if($fail_count > 0) { ?>
        <dt>실패 회원ID</dt>
        <dd><?php echo implode(', ', $fail_mb_id); ?></dd>
        <?php } ?>
        <?php if($dup_count > 0) { ?>
        <dt>회원ID 중복건수</dt>
        <dd><?php echo number_format($dup_count); ?></dd>
        <dt>중복 회원ID</dt>
        <dd><?php echo implode(', ', $dup_mb_id); ?></dd>
        <?php } ?>
    </dl>

    <div class="btn_win01 btn_win">
        <button type="button" onclick="window.close();">창닫기</button>
    </div>

</div>

<?php
include_once(G5_PATH.'/tail.sub.php');
?>