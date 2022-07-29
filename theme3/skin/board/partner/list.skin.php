<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가
include_once(G5_LIB_PATH.'/thumbnail.lib.php');


function get_board_sfl_select_options2($sfl){
    global $is_admin;
    $str = '';

    $str .= '<option value="wr_1||wr_3||wr_4" '.get_selected($sfl, 'wr_1||wr_3||wr_4').'>지점명+주소</option>';
    $str .= '<option value="wr_1" '.get_selected($sfl, 'wr_1', true).'>지점명</option>';
    $str .= '<option value="wr_3||wr_4" '.get_selected($sfl, 'wr_3||wr_4').'>주소</option>';
    $str .= '<option value="wr_2" '.get_selected($sfl, 'wr_2', true).'>대표전화</option>';
    
    return run_replace('get_board_sfl_select_options2', $str, $sfl);
}

// 선택옵션으로 인해 셀합치기가 가변적으로 변함
$colspan = 5;

if ($is_checkbox) $colspan++;
if ($is_good) $colspan++;
if ($is_nogood) $colspan++;

// add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
add_stylesheet('<link rel="stylesheet" href="'.$board_skin_url.'/style.css">', 0);


?>



<div class="">
    <div class="bbs_top">
        <ul class="bbs_top_ul1">
            <?php
            //지역 셀렉트
            $sql_loca = " select * from g5_write_{$bo_table} group by wr_7 order by wr_7 asc"; 
            $result_loca = sql_query($sql_loca); 

            echo $sql_loca;
            ?>

            <select name="loca" id="loca" class="bo_cate_sel select b_sel">
                <option value=''>전체</option>
                <?php for ($i=0; $row=sql_fetch_array($result_loca); $i++) { ?>
                    <option value="<?php echo $row['wr_7'] ?>"><?php echo $row['wr_7'] ?></option>
                <?php } ?>
            </select>

        </ul>
        <form name="fsearch" method="get">
        <input type="hidden" name="bo_table" value="<?php echo $bo_table ?>">
        <input type="hidden" name="sca" value="<?php echo $sca ?>">
        <input type="hidden" name="sop" value="and">
            
            <ul class="bbs_top_ul3">
                <li class="po_rel">              
                        <input type="text" name="stx" class="b_inp" value="<?php echo stripslashes($stx) ?>" id="stx" placeholder="지점검색" required autocomplete="off">
                        <button class="b_inp_ico" type="submit">
                            <svg width="34" height="34" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M19.25 19.25L15.5 15.5M4.75 11C4.75 7.54822 7.54822 4.75 11 4.75C14.4518 4.75 17.25 7.54822 17.25 11C17.25 14.4518 14.4518 17.25 11 17.25C7.54822 17.25 4.75 14.4518 4.75 11Z" stroke="#141414" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                            </svg>
                        </button>
                </li>
            </ul>
            <ul class="bbs_top_ul2">
                <select name="sfl" id="sfl" class="bo_cate_sel select b_sel">
                    <?php echo get_board_sfl_select_options2($sfl); ?>
                </select>
            </ul>
            <div class="cb"></div>
        </form>

        
    </div>
    
    
    
    <div>
        <script>
        $("#loca").change(function() {
            location.href = "?bo_table=<?php echo $bo_table ?>&sca=" + encodeURIComponent($(this).val());
        })

        $("#loca").val("<?php echo $sca ?>").prop("selected", true);
        </script>

        <form name="fboardlist" id="fboardlist" action="<?php echo G5_BBS_URL; ?>/board_list_update.php" onsubmit="return fboardlist_submit(this);" method="post">

        <input type="hidden" name="bo_table" value="<?php echo $bo_table ?>">
        <input type="hidden" name="sfl" value="<?php echo $sfl ?>">
        <input type="hidden" name="stx" value="<?php echo $stx ?>">
        <input type="hidden" name="spt" value="<?php echo $spt ?>">
        <input type="hidden" name="sca" value="<?php echo $sca ?>">
        <input type="hidden" name="sst" value="<?php echo $sst ?>">
        <input type="hidden" name="sod" value="<?php echo $sod ?>">
        <input type="hidden" name="page" value="<?php echo $page ?>">
        <input type="hidden" name="sw" value="">
            
        <div class="rel_table">
        <div class="tables">
            <ul class="tables_th font-b">
                <li class="pa_name">지점명</li>
                <li class="pa_name">상호명</li>
                <li class="pa_tel">대표전화</li>
                <li class="pa_address">주소</li>
                <li class="pa_time">영업시간</li>
                <li class="pa_link">링크</li>
                <div class="cb"></div>
            </ul>
            <?php
                for ($i=0; $i<count($list); $i++) {
                    if ($i%2==0) $lt_class = "even";
                else $lt_class = "";
            ?>
            <ul class="tables_td">
                <li class="pa_name"><?php if($list[$i]['wr_1']) { echo $list[$i]['wr_1']; } else { echo "-"; } ?></li>
                <li class="pa_name"><?php if($list[$i]['subject']) { echo $list[$i]['subject']; } else { echo "-"; } ?></li>
                <li class="pa_tel"><?php if($list[$i]['wr_2']) { echo $list[$i]['wr_2']; } else { echo "-"; } ?></li>
                <li class="pa_address"><?php if($list[$i]['wr_3']) { echo $list[$i]['wr_3']." ".$list[$i]['wr_4']; } else { echo "-"; } ?></li>
                <li class="pa_time"><?php if($list[$i]['wr_5']) { echo $list[$i]['wr_5']; } else { echo "-"; } ?></li>
                <li class="pa_link">
                    <?php if($list[$i]['wr_6']) { ?>
                    <a href="<?php echo $list[$i]['wr_6'] ?>" target="_blank" class="link_ico">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M9.25 4.75H6.75C5.64543 4.75 4.75 5.64543 4.75 6.75V17.25C4.75 18.3546 5.64543 19.25 6.75 19.25H17.25C18.3546 19.25 19.25 18.3546 19.25 17.25V14.75" stroke="#999999" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                        <path d="M19.25 9.25V4.75H14.75" stroke="#999999" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                        <path d="M19 5L11.75 12.25" stroke="#999999" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                        </svg>
                    </a>
                    <?php } else { ?>
                    　
                    <?php } ?>
                </li>
                <div class="cb"></div>
            </ul>  
            
            <?php } ?>
            <?php if (count($list) == 0) { echo '<ul class="tables_td" style="text-align:center">등록된 지점이 없습니다.</ul>'; } ?>
            
        </div>
        </div>   

        <div class="bo_fx" style="margin-top:30px;">

            <ul class="btn_bo_user_btm">
                
                <button type="button" class="br_more_btn2 font-b" onclick="location.href='<?php echo $list_href ?>'">목록</button>

            </ul>

        </div>

            
            
        </form>
        
    </div>
    
    <div>
        <!-- 페이지 -->
        <?php echo $write_pages; ?>
        <!-- 페이지 -->
    </div>
    
</div>  

<div class="cb"></div>
    



<?php if ($is_checkbox) { ?>
<script>
    function all_checked(sw) {
        var f = document.fboardlist;

        for (var i = 0; i < f.length; i++) {
            if (f.elements[i].name == "chk_wr_id[]")
                f.elements[i].checked = sw;
        }
    }

    function fboardlist_submit(f) {
        var chk_count = 0;

        for (var i = 0; i < f.length; i++) {
            if (f.elements[i].name == "chk_wr_id[]" && f.elements[i].checked)
                chk_count++;
        }

        if (!chk_count) {
            alert(document.pressed + "할 게시물을 하나 이상 선택하세요.");
            return false;
        }

        if (document.pressed == "선택복사") {
            select_copy("copy");
            return;
        }

        if (document.pressed == "선택이동") {
            select_copy("move");
            return;
        }

        if (document.pressed == "선택삭제") {
            if (!confirm("선택한 게시물을 정말 삭제하시겠습니까?\n\n한번 삭제한 자료는 복구할 수 없습니다."))
                return false;

            f.removeAttribute("target");
            f.action = g5_bbs_url + "/board_list_update.php";
        }

        return true;
    }

    // 선택한 게시물 복사 및 이동
    function select_copy(sw) {
        var f = document.fboardlist;

        if (sw == "copy")
            str = "복사";
        else
            str = "이동";

        var sub_win = window.open("", "move", "left=50, top=50, width=500, height=550, scrollbars=1");

        f.sw.value = sw;
        f.target = "move";
        f.action = g5_bbs_url + "/move.php";
        f.submit();
    }

    // 게시판 리스트 관리자 옵션
    jQuery(function($) {
        $(".btn_more_opt.is_list_btn").on("click", function(e) {
            e.stopPropagation();
            $(".more_opt.is_list_btn").toggle();
        });
        $(document).on("click", function(e) {
            if (!$(e.target).closest('.is_list_btn').length) {
                $(".more_opt.is_list_btn").hide();
            }
        });
    });
</script>
<?php } ?>
<!-- } 게시판 목록 끝 -->