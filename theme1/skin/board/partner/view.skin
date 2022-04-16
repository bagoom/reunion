<?php
if (!defined("_GNUBOARD_")) exit; // 개별 페이지 접근 불가
include_once(G5_LIB_PATH.'/thumbnail.lib.php');

// add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
add_stylesheet('<link rel="stylesheet" href="'.$board_skin_url.'/style.css">', 0);
?>

<script src="<?php echo G5_JS_URL; ?>/viewimageresize.js"></script>

<!-- 게시물 읽기 시작 { -->

<article id="bo_v" style="width:<?php echo $width; ?>">
    <header>

        <div class="info_left">
            <h2 id="bo_v_title">
                <span class="bo_v_tit">
                    <?php if($view['ca_name']) { ?>[<?php echo $view['ca_name'] ?>] <?php } ?>
                    <?php echo cut_str(get_text($view['wr_subject']), 70); ?>
                </span>
            </h2>
            <dl class="map_info">

                <?php if($view['wr_3']) { ?>
                <i class="fa fa-map-marker" aria-hidden="true"></i> <?php echo $view['wr_3'] ?> <?php echo $view['wr_4'] ?><br>
                <?php } ?>

                <?php if($view['wr_2']) { ?>
                <i class="fa fa-phone" aria-hidden="true"></i> <a href="tel:<?php echo $view['wr_2'] ?>"><b><?php echo $view['wr_2'] ?></b></a>
                <?php } ?>

                <?php if(isset($view['link'][1]) && $view['link'][1]) { ?>
                <dd>

                    <?php
                // 링크
                $cnt = 0;
                for ($i=1; $i<=count($view['link']); $i++) {
                    if ($view['link'][$i]) {
                        $cnt++;
                        $link = cut_str($view['link'][$i], 70);
                    ?>
                    <i class="fa fa-link" aria-hidden="true"></i>
                    <a href="<?php echo $view['link_href'][$i] ?>" target="_blank" class="mini_txt"><?php echo $link ?></a><br>

                    <?php
                    }
                }
                ?>


                </dd>
                <?php } ?>

            </dl>
        </div>
        <div class="info_right" id="map"></div>

        <div style="clear:both"></div>


    </header>



    <section id="bo_v_info" style="border-bottom:0px;">
        
        <!-- 로드뷰 레이어 { -->
        <div id="roadview"></div>
        <!-- } -->


        <?php
        // 파일 출력
        $v_img_count = count($view['file']);
        if($v_img_count) {
            echo "<div id=\"bo_v_img\">\n";

            for ($i=0; $i<=count($view['file']); $i++) {
                echo get_file_thumbnail($view['file'][$i]);
            }

            echo "</div>\n";
        }
         ?>

        <!-- 본문 내용 시작 { -->
        <div id="bo_v_con"><?php echo get_view_thumbnail($view['content']); ?></div>
        <?php //echo $view['rich_content']; // {이미지:0} 과 같은 코드를 사용할 경우 ?>
        <!-- } 본문 내용 끝 -->

        <section id="bo_v_info">
            <h2>페이지 정보</h2>
            <div class="profile_info">

                <div class="profile_info_ct">
                    <span class="sound_only">등록자</span> <strong><?php echo $view['name'] ?></strong><br>
                    <span class="sound_only">댓글</span><strong><a href="#bo_vc"> <i class="fa fa-commenting-o" aria-hidden="true"></i> <?php echo number_format($view['wr_comment']) ?>건</a></strong>
                    <span class="sound_only">조회</span><strong><i class="fa fa-eye" aria-hidden="true"></i> <?php echo number_format($view['wr_hit']) ?>회</strong>
                    <strong class="if_date"><span class="sound_only">등록일</span><i class="fa fa-clock-o" aria-hidden="true"></i> <?php echo date("y-m-d H:i", strtotime($view['wr_datetime'])) ?></strong>
                </div>
            </div>




            <!-- 게시물 상단 버튼 시작 { -->
            <div id="bo_v_top">
                <?php ob_start(); ?>

                <ul class="btn_bo_user bo_v_com">

                    <?php if($update_href || $delete_href || $copy_href || $move_href || $search_href) { ?>
                    <li>
                        <button type="button" class="btn_more_opt is_view_btn btn_b01 btn top_op_btn"><i class="fa fa-ellipsis-v" aria-hidden="true" style="font-size:18px;"></i><span class="sound_only">게시판 리스트 옵션</span></button>
                        <ul class="more_opt is_view_btn">
                            <?php if ($update_href) { ?><li><a href="<?php echo $update_href ?>">수정<i class="fa fa-pencil-square-o" aria-hidden="true"></i></a></li><?php } ?>
                            <?php if ($delete_href) { ?><li><a href="<?php echo $delete_href ?>" onclick="del(this.href); return false;">삭제<i class="fa fa-trash-o" aria-hidden="true"></i></a></li><?php } ?>
                            <?php if ($copy_href) { ?><li><a href="<?php echo $copy_href ?>" onclick="board_move(this.href); return false;">복사<i class="fa fa-files-o" aria-hidden="true"></i></a></li><?php } ?>
                            <?php if ($move_href) { ?><li><a href="<?php echo $move_href ?>" onclick="board_move(this.href); return false;">이동<i class="fa fa-arrows" aria-hidden="true"></i></a></li><?php } ?>
                            <?php if ($search_href) { ?><li><a href="<?php echo $search_href ?>">검색<i class="fa fa-search" aria-hidden="true"></i></a></li><?php } ?>
                        </ul>
                    </li>
                    <?php } ?>
                </ul>
                <script>
                    jQuery(function($) {
                        // 게시판 보기 버튼 옵션
                        $(".btn_more_opt.is_view_btn").on("click", function(e) {
                            e.stopPropagation();
                            $(".more_opt.is_view_btn").toggle();
                        });
                        $(document).on("click", function(e) {
                            if (!$(e.target).closest('.is_view_btn').length) {
                                $(".more_opt.is_view_btn").hide();
                            }
                        });
                    });
                </script>
                <?php
	        $link_buttons = ob_get_contents();
	        ob_end_flush();
			?>
            </div>
            <!-- } 게시물 상단 버튼 끝 -->
        </section>




        <div id="bo_v_share">
            <?php include_once(G5_SNS_PATH."/view.sns.skin.php"); ?>
            <?php if ($scrap_href) { ?><a href="<?php echo $scrap_href;  ?>" target="_blank" class="btn btn_b03" onclick="win_scrap(this.href); return false;"><i class="fa fa-bookmark" aria-hidden="true"></i><span class="pc_view"> 스크랩</span></a><?php } ?>

            <div class="btn_v_01">
                <a href="<?php echo $list_href ?>" class="btn_b01 sub_btns btn" title="목록">
                    <i class="fa fa-bars mo_view" aria-hidden="true" style="line-height:35px;"></i>
                    <span class="pc_view">목록</span>
                </a>

                <?php if ($write_href) { ?>
                <a href="<?php echo $write_href ?>" class="btn_b01 btn" title="등록하기">
                    <i class="fa fa-pencil mo_view" aria-hidden="true" style="line-height:35px;"></i>
                    <span class="pc_view">등록하기</span>
                </a>
                <?php } ?>
            </div>
        </div>


    </section>


    <br>

    <?php
    $cnt = 0;
    if ($view['file']['count']) {
        for ($i=0; $i<count($view['file']); $i++) {
            if (isset($view['file'][$i]['source']) && $view['file'][$i]['source'] && !$view['file'][$i]['view'])
                $cnt++;
        }
    }
	?>

    <?php if($cnt) { ?>
    <!-- 첨부파일 시작 { -->
    <section id="bo_v_file">
        <h2>첨부파일</h2>
        <ul>
            <?php
        // 가변 파일
        for ($i=0; $i<count($view['file']); $i++) {
            if (isset($view['file'][$i]['source']) && $view['file'][$i]['source'] && !$view['file'][$i]['view']) {
         ?>
            <li>
                <i class="fa fa-folder-open" aria-hidden="true"></i>
                <a href="<?php echo $view['file'][$i]['href'];  ?>" class="view_file_download" download>
                    <strong><?php echo $view['file'][$i]['source'] ?></strong> <?php echo $view['file'][$i]['content'] ?> (<?php echo $view['file'][$i]['size'] ?>)
                </a>
                <br>
                <span class="bo_v_file_cnt"><?php echo $view['file'][$i]['download'] ?>회 다운로드 | DATE : <?php echo $view['file'][$i]['datetime'] ?></span>
            </li>
            <?php
            }
        }
         ?>
        </ul>
    </section>
    <!-- } 첨부파일 끝 -->
    <?php } ?>






    <?php if ($prev_href || $next_href) { ?>
    <ul class="bo_v_nb">
        <?php if ($prev_href) { ?>
        <li class="btn_prv">
            <dd class="elc_01"><span class="nb_tit"><i class="fa fa-chevron-up" aria-hidden="true"></i> 이전글</span></dd>
            <dd class="elc_02"><a href="<?php echo $prev_href ?>"><?php echo $prev_wr_subject;?></a></dd>
            <dd class="elc_03"><span class="nb_date"><?php echo str_replace('-', '.', substr($prev_wr_date, '2', '8')); ?></span></dd>
            <div style="clear:both"></div>
        </li>
        <?php } ?>

        <?php if ($next_href) { ?>
        <li class="btn_next">
            <dd class="elc_01"><span class="nb_tit"><i class="fa fa-chevron-down" aria-hidden="true"></i> 다음글</span></dd>
            <dd class="elc_02"><a href="<?php echo $next_href ?>"><?php echo $next_wr_subject;?></a></dd>
            <dd class="elc_03"><span class="nb_date"><?php echo str_replace('-', '.', substr($next_wr_date, '2', '8')); ?></span></dd>
            <div style="clear:both"></div>
        </li>
        <?php } ?>
    </ul>
    <?php } ?>

    <?php
    // 코멘트 입출력
    include_once(G5_BBS_PATH.'/view_comment.php');
	?>
</article>
<!-- } 게시판 읽기 끝 -->

<script type="text/javascript" src="//dapi.kakao.com/v2/maps/sdk.js?appkey=<?php echo $board['bo_1'] ?>&libraries=services"></script>

<script>
    var mapContainer = document.getElementById('map'), // 지도를 표시할 div 
        mapOption = {
            center: new daum.maps.LatLng(<?php echo $view['wr_5']?>, <?php echo $view['wr_6']?>), // 지도의 중심좌표
            level: 7 // 지도의 확대 레벨
        };

    // 지도를 생성합니다    
    var map = new daum.maps.Map(mapContainer, mapOption);

    // 주소-좌표 변환 객체를 생성합니다
    //var geocoder = new daum.maps.services.Geocoder();

    // 마커
    var marker = new daum.maps.Marker({
        map: map,
        // 지도 중심좌표에 마커를 생성
        position: map.getCenter()
    });
    

    //마커를 기준으로 가운데 정렬이 될 수 있도록 추가
    var markerPosition = marker.getPosition();
    map.relayout();
    map.setCenter(markerPosition);


    //브라우저가 리사이즈될때 지도 리로드

    $(window).on('resize', function() {
        var markerPosition = marker.getPosition();
        map.relayout();
        map.setCenter(markerPosition);
    });
    
    
    // 로드뷰 추가
    var roadviewContainer = document.getElementById('roadview'); //로드뷰를 표시할 div
    var roadview = new kakao.maps.Roadview(roadviewContainer); //로드뷰 객체
    var roadviewClient = new kakao.maps.RoadviewClient(); //좌표로부터 로드뷰 파노ID를 가져올 로드뷰 helper객체

    var position = new kakao.maps.LatLng(<?php echo $view['wr_5']?>, <?php echo $view['wr_6']?>);

    // 특정 위치의 좌표와 가까운 로드뷰의 panoId를 추출하여 로드뷰를 띄운다.
    roadviewClient.getNearestPanoId(position, 50, function(panoId) {
        roadview.setPanoId(panoId, position); //panoId와 중심좌표를 통해 로드뷰 실행
    });
    
</script>

<script>
    <?php if ($board['bo_download_point'] < 0) { ?>
    $(function() {
        $("a.view_file_download").click(function() {
            if (!g5_is_member) {
                alert("다운로드 권한이 없습니다.\n회원이시라면 로그인 후 이용해 보십시오.");
                return false;
            }

            var msg = "파일을 다운로드 하시면 포인트가 차감(<?php echo number_format($board['bo_download_point']) ?>점)됩니다.\n\n포인트는 게시물당 한번만 차감되며 다음에 다시 다운로드 하셔도 중복하여 차감하지 않습니다.\n\n그래도 다운로드 하시겠습니까?";

            if (confirm(msg)) {
                var href = $(this).attr("href") + "&js=on";
                $(this).attr("href", href);

                return true;
            } else {
                return false;
            }
        });
    });
    <?php } ?>

    function board_move(href) {
        window.open(href, "boardmove", "left=50, top=50, width=500, height=550, scrollbars=1");
    }
</script>

<script>
    $(function() {
        $("a.view_image").click(function() {
            window.open(this.href, "large_image", "location=yes,links=no,toolbar=no,top=10,left=10,width=10,height=10,resizable=yes,scrollbars=no,status=no");
            return false;
        });

        // 추천, 비추천
        $("#good_button, #nogood_button").click(function() {
            var $tx;
            if (this.id == "good_button")
                $tx = $("#bo_v_act_good");
            else
                $tx = $("#bo_v_act_nogood");

            excute_good(this.href, $(this), $tx);
            return false;
        });

        // 이미지 리사이즈
        $("#bo_v_atc").viewimageresize();
    });

    function excute_good(href, $el, $tx) {
        $.post(
            href, {
                js: "on"
            },
            function(data) {
                if (data.error) {
                    alert(data.error);
                    return false;
                }

                if (data.count) {
                    $el.find("strong").text(number_format(String(data.count)));
                    if ($tx.attr("id").search("nogood") > -1) {
                        $tx.text("이 글을 비추천하셨습니다.");
                        $tx.fadeIn(200).delay(2500).fadeOut(200);
                    } else {
                        $tx.text("이 글을 추천하셨습니다.");
                        $tx.fadeIn(200).delay(2500).fadeOut(200);
                    }
                }
            }, "json"
        );
    }
</script>
<!-- } 게시글 읽기 끝 -->