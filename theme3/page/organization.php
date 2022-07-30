<?php
include_once('./_common.php');
$g5['title'] = '조직도';
include_once(G5_PATH.'/head.php');
?>

<div class="cont organization">

    <div class="box">
        <table class="basic-type02" cellspacing="0" cellpadding="0">
            <thead>
                <tr>
                    <th colspan="4">회장단</th>
                </tr>
                <tr>
                    <th>직위</th>
                    <th>성명</th>
                    <th colspan="2" class="text-center">과,기수</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>총동문회장</td>
                    <td>이찬용</td>
                    <td>전기</td>
                    <td>38</td>
                </tr>
                <tr>
                    <td>수석부회장</td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
                <tr>
                    <td>선임감사</td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
                <tr>
                    <td>감사</td>
                    <td>김평희</td>
                    <td>전기</td>
                    <td>38</td>
                </tr>
            </tbody>
        </table>
    </div>

    <!-- 과별 -->
    <div class="box">
        <table class="basic-type02" cellspacing="0" cellpadding="0">
            <thead>
                <tr>
                    <th colspan="4">과별</th>
                </tr>
                <tr>
                    <th>직위</th>
                    <th>성명</th>
                    <th colspan="2" class="text-center">과,기수</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>기계과회장</td>
                    <td>배상우</td>
                    <td>기계</td>
                    <td>38</td>
                </tr>
            </tbody>
        </table>
    </div>

    <!-- 각 지회 -->
    <div class="box">
        <table class="basic-type02" cellspacing="0" cellpadding="0">
            <thead>
                <tr>
                    <th colspan="4">각 지회</th>
                </tr>
                <tr>
                    <th>직위</th>
                    <th>성명</th>
                    <th colspan="2" class="text-center">과,기수</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>엘리펀츠야구단</td>
                    <td>이병구</td>
                    <td>전기</td>
                    <td>45</td>
                </tr>
            </tbody>
        </table>
    </div>

    <?php
include_once(G5_PATH.'/tail.php');
?>