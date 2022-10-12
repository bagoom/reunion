<?php 
include_once('../_common.php');
?>
<div class="report-modal article" id="modal">
    <div class="modal-head">
        <h3>게시물 신고하기</h3>
        <div class="modal-close"><i class="xi-close"></i></div>
    </div>

    <div class="modal-body">
        <div class="con">
            <!-- <div class="icon"><i class="xi-info"></i></div> -->
            <p>신고 사유를 선택하세요.</p>
            <form action="" id="report-form1">
                <input type="hidden" name="bo_table" value="<?=$bo_table?>">
                <input type="hidden" name="wr_id" value="<?=$view['wr_id']?>">
                <ul class="report-reason">
                    <li>
                        <input type="radio" name="report_reason" id="report-reason1"  value="욕설/명예,권리 훼손" checked>
                        <label for="report-reason1">욕설/명예,권리 훼손</label>
                    </li>
                    <li>
                        <input type="radio" name="report_reason" id="report-reason2" value="스팸홍보/도배글">
                        <label for="report-reason2">스팸홍보/도배글</label>
                    </li>
                    <li>
                        <input type="radio" name="report_reason" id="report-reason3"  value="음란물/선정성">
                        <label for="report-reason3">음란물/선정성</label>
                    </li>
                    <li>
                        <input type="radio" name="report_reason" id="report-reason4"  value="같은 내용 반복">
                        <label for="report-reason4">같은 내용 반복</label>
                    </li>
                    <li>
                        <div class="flex-box">
                            <input type="radio" name="report_reason" id="report-reason5"  value="">
                            <label for="report-reason5">기타 사유 입력 </label>
                        </div>

                        <textarea name="etc_reason" id="etc-reason" cols="30" rows="10"></textarea>
                    </li>
                </ul>
            </div>

            <div class="btn-wrap article">
                <div class="btn cancel">취소</div>
                <div class="btn report">신고</div>
            </div>
        </form>
    </div>
</div>


<div class="report-modal user" id="modal">
    <div class="modal-head">
        <h3>불량 사용자 신고하기</h3>
        <div class="modal-close"><i class="xi-close"></i></div>
    </div>
    <div class="modal-body">
        <div class="con">
            <!-- <div class="icon"><i class="xi-info"></i></div> -->
            <p>신고 사유를 선택하세요.</p>
            <form action="" id="report-form2">
                <input type="hidden" name="bo_table" value="<?=$bo_table?>">
                <input type="hidden" name="wr_id" value="<?=$view['wr_id']?>">
                <input type="hidden" name="mb_to_id" value="<?=$view['mb_id']?>">
                <ul class="report-reason">
                    <li>
                        <input type="radio" name="report_reason" id="report-reason6"  value="명의도용" checked>
                        <label for="report-reason6">명의도용</label>
                    </li>
                    <li>
                        <input type="radio" name="report_reason" id="report-reason7" value="개인정보 침해">
                        <label for="report-reason7">개인정보 침해</label>
                    </li>
                    <li>
                        <input type="radio" name="report_reason" id="report-reason8"  value="사이버폭력">
                        <label for="report-reason8">사이버폭력</label>
                    </li>
                    <li>
                        <input type="radio" name="report_reason" id="report-reason9"  value="스팸 및 사기">
                        <label for="report-reason9">스팸 및 사기</label>
                    </li>
                    <li>
                        <div class="flex-box">
                            <input type="radio" name="report_reason" id="report-reason10"  value="">
                            <label for="report-reason10">기타 사유 입력 </label>
                        </div>

                        <textarea name="etc_reason" id="etc-reason" cols="30" rows="10"></textarea>
                    </li>
                </ul>
            </div>

            <div class="btn-wrap user">
                <div class="btn cancel">취소</div>
                <div class="btn report">신고</div>
            </div>
        </form>
    </div>
</div>


<div class="report-modal comment" id="modal">
    <div class="modal-head">
        <h3>댓글 신고하기</h3>
        <div class="modal-close"><i class="xi-close"></i></div>
    </div>
    <div class="modal-body">
        <div class="con">
            <!-- <div class="icon"><i class="xi-info"></i></div> -->
            <p>신고 사유를 선택하세요.</p>
            <form action="" id="report-form3">
                <input type="hidden" name="bo_table" value="<?=$bo_table?>">
                <input type="hidden" name="mb_to_id" value="<?=$view['mb_id']?>">
                <input type="hidden" name="wr_parent" value="<?=$view['wr_id']?>">
                <ul class="report-reason">
                    <li>
                        <input type="radio" name="report_reason" id="report-reason11"  value="스팸 및 광고성 콘텐츠" checked>
                        <label for="report-reason11">스팸 및 광고성 콘텐츠</label>
                    </li>
                    <li>
                        <input type="radio" name="report_reason" id="report-reason12" value="희롱 및 괴롭힘">
                        <label for="report-reason12">희롱 및 괴롭힘</label>
                    </li>
                    <li>
                        <input type="radio" name="report_reason" id="report-reason13"  value="사이버폭력">
                        <label for="report-reason13">사이버폭력</label>
                    </li>
                    <li>
                        <input type="radio" name="report_reason" id="report-reason14"  value="욕설.명예훼손">
                        <label for="report-reason14">욕설.명예훼손</label>
                    </li>
                    <li>
                        <div class="flex-box">
                            <input type="radio" name="report_reason" id="report-reason15"  value="">
                            <label for="report-reason15">기타 사유 입력 </label>
                        </div>

                        <textarea name="etc_reason" id="etc-reason" cols="30" rows="10"></textarea>
                    </li>
                </ul>
            </div>

            <div class="btn-wrap comment">
                <div class="btn cancel">취소</div>
                <div class="btn report">신고</div>
            </div>
        </form>
    </div>
</div>

<div id="overlay"></div>

<script>
    $(".btn-wrap.article .report").click(function(){
        var data = $("#report-form1").serializeArray();
        data.push({name:'mode', value: 'article'});

        $.ajax({
            type: "POST",
            url: g5_bbs_url+"/ajax.report.php",
            data: data,
            cache: false,
            async: false,
            dataType: "json",
            success: function(data) {
                if(data.message){
                    alert(data.message);
                    console.log(data)
                }

                if(data.status === 'ok'){
                    location.href= g5_bbs_url + '/board.php?bo_table=' + data.post.bo_table
                }
            }
        });
    });


    $(".btn-wrap.user .report").click(function(){
        var data = $("#report-form2").serializeArray();
        data.push({name:'mode', value: 'user'});

        $.ajax({
            type: "POST",
            url: g5_bbs_url+"/ajax.report.php",
            data: data,
            cache: false,
            async: false,
            dataType: "json",
            success: function(data) {
                if(data.message){
                    alert(data.message);
                    console.log(data)
                }

                if(data.status === 'ok'){
                    location.href= g5_bbs_url + '/board.php?bo_table=' + data.post.bo_table
                }
            }
        });
    });


    $(".btn-wrap.comment .report").click(function(){
        var data = $("#report-form3").serializeArray();
        data.push({name:'mode', value: 'comment'});
        data.push({name:'wr_id', value: $(".report-modal.comment").data("id")});

        $.ajax({
            type: "POST",
            url: g5_bbs_url+"/ajax.report.php",
            data: data,
            cache: false,
            async: false,
            dataType: "json",
            success: function(data) {
                if(data.message){
                    alert(data.message);
                    console.log(data)
                }

                if(data.status === 'ok'){
                    location.reload();
                }
            }
        });
    });

    $("input[name=report_reason]").change(function(){
        if($("#report-reason5").is(':checked') || $("#report-reason10").is(':checked') || $("#report-reason15").is(':checked')){
            $("textarea[name=etc_reason]").show();
            $("textarea[name=etc_reason]").focus();
        }else{
            $("textarea[name=etc_reason]").hide();
        }
    })
</script>