<?php
$sub_menu = "300100";
include_once('./_common.php');

auth_check_menu($auth, $sub_menu, 'w');



if ($w == '')
{
    $html_title = '등록';
}
else if ($w == 'u')
{
    $branch = sql_fetch("SELECT * FROM {$g5['branch']} WHERE branch_id = '$branch_id'  ");

    $required_mb_id = 'readonly';
    $html_title = '수정';
}
else
    alert('제대로 된 값이 넘어오지 않았습니다.');

$g5['title'] .= '지회 '.$html_title;
include_once('./admin.head.php');

?>
<script src="https://unpkg.com/core-js-bundle@3.1.4/index.js"></script>
<script src="https://unpkg.com/regenerator-runtime@0.13.3/runtime.js"></script>
<script src="https://cdn.jsdelivr.net/npm/vue/dist/vue.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/babel-core/5.8.34/browser.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.20.0/axios.min.js "></script>
<script src="https://cdn.jsdelivr.net/npm/es6-promise@4/dist/es6-promise.js"></script>
<script src="https://cdn.jsdelivr.net/npm/es6-promise@4/dist/es6-promise.auto.js"></script>

<form name="fmember" id="fmember" action="./branch_form_update.php" onsubmit="return fmember_submit(this);" method="post">
    <input type="hidden" name="w" value="<?php echo $w ?>">
    <input type="hidden" name="branch_id" value="<?php echo $branch_id?>">
    <input type="hidden" name="sfl" value="<?php echo $sfl ?>">
    <input type="hidden" name="stx" value="<?php echo $stx ?>">
    <input type="hidden" name="sst" value="<?php echo $sst ?>">
    <input type="hidden" name="sod" value="<?php echo $sod ?>">
    <input type="hidden" name="page" value="<?php echo $page ?>">
    <input type="hidden" name="token" value="">

    <div class="tbl_frm01 tbl_wrap">
        <div class="tit01">지회 정보</div>
        <table>
            <caption><?php echo $g5['title']; ?></caption>
            <colgroup>
                <col class="grid_4">
                <col>
                <col class="grid_4">
                <col>
                <col class="grid_4">
                <col>
            </colgroup>
            <tbody>
                <tr>
                    <th scope="row">지회 구분</th>
                    <td>
                        <?= get_reunion_select('type', $branch['type'], '', 'bt_name', 'branch_type'); ?>
                    </td>
                    <th scope="row">지회명</th>
                    <td>
                        <input type="text" name="branch_name" value="<?php echo $branch['branch_name'] ?>" id="branch_name" class=" frm_input" size="15" maxlength="20">
                    </td>
                    <th scope="row">상태</th>
                    <td>
                        <select name="status" id="status">
                            <option value="일시중지" <?=get_selected($branch['status'], "일시중지")?>>일시중지</option>
                            <option value="활동" <?=get_selected($branch['status'], "활동")?>>활동</option>
                            <option value="영구중지" <?=get_selected($branch['status'], "영구중지")?>>영구중지</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <th scope="row">지회소개글</th>
                    <td colspan="5">
                        <textarea name="branch_content" id="" cols="30" rows="10"><?=$branch['branch_content']?></textarea>
                    </td>
                </tr>
                <tr>
                    <th scope="row">사진등록 (미구현)</th>
                    <td colspan="5">
                        <input type="file">
                    </td>
                </tr>
            </tbody>
        </table>
    </div>

    <?php if ($w == 'u') {
    
    $branch_mem_sql = "SELECT * FROM {$g5['member_table']} a, {$g5['branch_member']} b WHERE a.mb_id = b.mb_id AND b.branch_id ='$branch_id' " ;   
    $branch_mem_result = sql_query($branch_mem_sql);
?>
    <div class="tbl_frm01 tbl_wrap table02">
        <div class="tit01">지회 회원 관리 <button type="button" class="btn btn_02 modal-open">지회 회원 등록</button></div>
        <table>
            <caption><?php echo $g5['title']; ?></caption>
            <colgroup>
                <col width="25%">
                <col width="25%">
                <col width="25%">
                <col width="25%">
                <col width="25%">
                <col width="25%">
                <col width="25%">
            </colgroup>
            <thead>
                <th>등급</th>
                <th>성명</th>
                <th>학과</th>
                <th>입학</th>
                <th>전화번호</th>
                <th>이메일</th>
                <th>비고</th>
            </thead>
            <tbody>
                <?php for ($i=0; $row=sql_fetch_array($branch_mem_result); $i++) { ?>
                <tr>
                    <td><?=$row['grade']?></td>
                    <td><?=$row['mb_name']?></td>
                    <td><?=$row['department']?></td>
                    <td><?=$row['entrance_year']?></td>
                    <td><?=$row['mb_hp']?></td>
                    <td><?=$row['mb_email']?></td>
                    <td><?=$row['etc']?></td>
                </tr>
                <?php }?>
                <?php 
            if ($i == 0)
                echo "<tr><td colspan='7' class=\"empty_table\">등록된 회원이 없습니다.</td></tr>";
            ?>
            </tbody>
        </table>
    </div>

    <?php }?>


    <div class="btn_fixed_top">
        <a href="./branch_list.php?<?php echo $qstr ?>" class="btn btn_02">목록</a>
        <input type="submit" value="확인" class="btn_submit btn" accesskey='s'>
    </div>
</form>

<div id="modal" class="branch-modal">
    <vue-snotify></vue-snotify>
    <input type="hidden" name="branch_id" id="branch_id" value="<?=$branch_id?>">
    <div class="modal-content">
        <div class="modal-head">
            <h3>지회 회원 등록</h3>
            <div class="modal-close"><i class="xi-close"></i></div>
        </div>
        <div class="search-wrap">
            <div class="input-row col-03">
                <div class="input-col">
                    <label for="mb_hp">휴대폰번호</label>
                    <input type="text" name="mb_hp" id="mb_hp" placeholder="ex) 010-1234-5678" v-model="searchData.mb_hp">
                </div>
                <div class="input-col">
                    <label for="mb_hp">이름</label>
                    <input type="text" name="mb_name" id="mb_name" placeholder="이름을 입력해 주세요." v-model="searchData.mb_name">
                </div>
                <div class="btn-wrap">
                    <button tpye="button" class="submit" @click="searchMembers()">검색</button>
                </div>
            </div>
        </div>
        <div class="modal-body">
            <h3 class="tit01"></h3>
            <div class="branch-list">
                <div class="thead">
                    <div class="name">성명</div>
                    <div class="department">학과</div>
                    <div class="entrance_year">입학</div>
                    <div class="mb_hp">전화번호</div>
                    <div class="grade">등급</div>
                    <div class="etc">비고</div>
                    <div class="status"></div>
                </div>

                <div class="tbody">
                    <ul>
                        <div v-if="!members.length" class="empty-row">
                            회원 검색을 해주세요.
                        </div>
                        <li v-for="member in members">
                            <div class="con" :class="{ 'on' : memberToModify == member.mb_no}">
                                <div class="name">{{member.mb_name}}</div>
                                <div class="department">{{member.department}}</div>
                                <div class="entrance_year">{{member.entrance_year}}</div>
                                <div class="mb_hp">{{member.mb_hp}}</div>
                                <div class="grade">{{member.grade? member.grade : '일반'}}</div>
                                <div class="etc">{{member.etc}}</div>
                                <div class="status">
                                    <button v-if="member.id" type="button" class="confirm" @click="selectMember(member)">수정</button>
                                    <button v-if="!member.id" type="button" class="confirm" @click="selectMember(member)">등록</button>
                                </div>
                            </div>

                            <div class="input-wrap" v-if=" memberToModify == member.mb_no" >
                                <p>{{member.mb_name}}님의 지회 정보 {{ member.id ? '수정' : '등록'}}  </p>
                                <div class="input-row">
                                    <div class="input-col">
                                        <label for="">등급</label>
                                        <select v-model="member.grade" @change="gradeChange">
                                            <option value="" >일반</option>
                                            <option value="회장">회장</option>
                                            <option value="총무">총무</option>
                                        </select>
                                    </div>
                                    <div class="input-col">
                                        <label for="">비고</label>
                                        <input type="text" name="etc" :value="member.etc" @keyup="onChangeEtc">
                                    </div>
                                    <div class="input-col">
                                        <button type="button" class="submit" @click="member.id ? updateBranchMember(member.id) : addBranchMembe()">확인</button>
                                    </div>
                                </div>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>

<div id="overlay">
</div>

<script>
    $(".modal-open").click(function () {
        $("#modal, #overlay").show();
    });
    $(document).on("click", ".modal-close", function () {
        $("#modal, #overlay").hide();
        location.reload();
    });
</script>
<link rel="stylesheet" href="https://unpkg.com/vue-snotify@latest/styles/material.css">
<script src="https://unpkg.com/vue-snotify@3.2.1/vue-snotify.min.js"></script>
<script type="text/babel" src="<?=G5_JS_URL?>/branch.js"></script>
<script>
    function fmember_submit(f) {
        return true;
    }
</script>
<?php
run_event('admin_member_form_after', $mb, $w);

include_once('./admin.tail.php');