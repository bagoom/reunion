<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

include_once(G5_THEME_PATH.'/head.sub.php');
include_once(G5_LIB_PATH.'/latest.lib.php');
include_once(G5_LIB_PATH.'/outlogin.lib.php');
include_once(G5_LIB_PATH.'/poll.lib.php');
include_once(G5_LIB_PATH.'/visit.lib.php');
include_once(G5_LIB_PATH.'/connect.lib.php');
include_once(G5_LIB_PATH.'/popular.lib.php');

?>
<header id="hd">
    <h1 id="hd_h1"><?php echo $g5['title'] ?></h1>

    <div class="to_content"><a href="#container">본문 바로가기</a></div>

    <?php
    if(defined('_INDEX_')) { // index에서만 실행
        include G5_MOBILE_PATH.'/newwin.inc.php'; // 팝업레이어
    } ?>


    


    <div id="hd_wrapper">

        <div id="logo">
            <a href="<?php echo G5_URL ?>"><img src="<?=G5_THEME_IMG_URL?>/logo.png" alt="<?php echo $config['cf_title']; ?>"></a>
        </div>

        <button type="button" id="gnb_open"><i class="fa fa-bars" ></i><span class="sound_only"> 메뉴열기</span></button>
        <!-- <button type="button" class="hd_sch_btn"><i class="fa fa-search"></i><span class="sound_only">검색열기</span></button> -->

        <div id="hd_sch">
            <div class="sch_wr">
                <h2 class="sound_only">사이트 내 전체검색</h2>
                <form name="fsearchbox" action="<?php echo G5_BBS_URL ?>/search.php" onsubmit="return fsearchbox_submit(this);" method="get">
                <input type="hidden" name="sfl" value="wr_subject||wr_content">
                <input type="hidden" name="sop" value="and">
                <input type="text" name="stx" id="sch_stx" placeholder="검색어(필수)" required maxlength="20">
                <button type="submit" value="검색" id="sch_submit"><i class="fa fa-search" aria-hidden="true"></i><span class="sound_only">검색</span></button>
                </form>

                <script>
                function fsearchbox_submit(f)
                {
                    if (f.stx.value.length < 2) {
                        alert("검색어는 두글자 이상 입력하십시오.");
                        f.stx.select();
                        f.stx.focus();
                        return false;
                    }

                    // 검색에 많은 부하가 걸리는 경우 이 주석을 제거하세요.
                    var cnt = 0;
                    for (var i=0; i<f.stx.value.length; i++) {
                        if (f.stx.value.charAt(i) == ' ')
                            cnt++;
                    }

                    if (cnt > 1) {
                        alert("빠른 검색을 위하여 검색어에 공백은 한개만 입력할 수 있습니다.");
                        f.stx.select();
                        f.stx.focus();
                        return false;
                    }

                    return true;
                }
                </script>
                <button type="button" class="btn_close"><i class="fa fa-times-circle"></i><span class="sound_only">검색</span></button>
            </div>
        </div>

        <div id="gnb" class="pc_view">
            <ul id="gnb_1dul">
                <li class="gnb_1dli">
                    <a href="<?=G5_URL?>/sub/sub01_01.php" class="gnb_1da">우리반넷 소개</a>
                </li>
                <li class="gnb_1dli">
                    <a href="<?=G5_URL?>/sub/sub02_01.php" class="gnb_1da">회원명부사업</a>
                    <ul class="gnb_2dul">
                        <li class="gnb_2dli"><a href="<?=G5_URL?>/sub/sub02_01.php"  class="gnb_2da"><span></span>회원명부제작</a></li>
                        <li class="gnb_2dli"><a href="<?=G5_URL?>/sub/sub02_02.php"  class="gnb_2da"><span></span>기타홍보물 제작사업 </a></li>
                        <li class="gnb_2dli"><a href="<?=G5_URL?>/sub/sub02_03.php"  class="gnb_2da"><span></span>주요 포트폴리오 </a></li>
                    </ul>
                </li>
                <li class="gnb_1dli">
                    <a href="<?=G5_URL?>/sub/sub03_01.php" class="gnb_1da">통합솔루션 안내</a>
                    <ul class="gnb_2dul">
                        <li class="gnb_2dli"><a href="<?=G5_URL?>/sub/sub03_01.php"  class="gnb_2da"><span></span>동문회원 관리시스템</a></li>
                        <li class="gnb_2dli"><a href="<?=G5_URL?>/sub/sub03_02.php"  class="gnb_2da"><span></span>홈페이지 </a></li>
                        <li class="gnb_2dli"><a href="<?=G5_URL?>/sub/sub03_03.php"  class="gnb_2da"><span></span>모바일앱 </a></li>
                    </ul>
                </li>
                <li class="gnb_1dli">
                    <a href="<?=G5_BBS_URL?>/board.php?bo_table=qa" class="gnb_1da">고객센터</a>
                    <ul class="gnb_2dul">
                        <li class="gnb_2dli"><a href="<?=G5_BBS_URL?>/board.php?bo_table=qa"  class="gnb_2da"><span></span>문의 게시판</a></li>
                        <li class="gnb_2dli"><a href="<?=G5_BBS_URL?>/board.php?bo_table=faq"  class="gnb_2da"><span></span>FAQ </a></li>
                    </ul>
                </li>
            </ul>
        </div>     

        <div id="gnb2">
            <button type="button" class="btn_close"><i class="fa fa-times"></i></button>
            <ul class="gnb_tnb">
                <?php if ($is_member) {  ?>

                <li><a href="<?php echo G5_BBS_URL ?>/member_confirm.php?url=<?php echo G5_BBS_URL ?>/register_form.php">정보수정</a></li>
                <li><a href="<?php echo G5_BBS_URL ?>/logout.php">로그아웃</a></li>
                <?php } else {  ?>
                <li><a href="<?php echo G5_BBS_URL ?>/register.php">회원가입</a></li>
                <li><a href="<?php echo G5_BBS_URL ?>/login.php">로그인</a></li>
                <?php }  ?>

            </ul>
            <ul id="gnb2_1dul">
                <li class="gnb2_2dli">
                    <a href="<?=G5_URL?>/sub/sub01_01.php" class="gnb2_1da">우리반넷 소개</a>
                </li>
                <li class="gnb2_1dli">
                    <a href="<?=G5_URL?>/sub/sub02_01.php" class="gnb2_1da">회원명부사업</a>
                    <button type="button" class="btn_gnb_op">하위분류</button>
                    <ul class="gnb2_2dul">
                        <li class="gnb2_2dli"><a href="<?=G5_URL?>/sub/sub02_01.php"  class="gnb2_2da"><span></span>회원명부제작</a></li>
                        <li class="gnb2_2dli"><a href="<?=G5_URL?>/sub/sub02_02.php"  class="gnb2_2da"><span></span>기타홍보물 제작사업 </a></li>
                        <li class="gnb2_2dli"><a href="<?=G5_URL?>/sub/sub02_03.php"  class="gnb2_2da"><span></span>주요 포트폴리오 </a></li>
                    </ul>
                </li>
                <li class="gnb2_1dli">
                    <a href="<?=G5_URL?>/sub/sub03_01.php" class="gnb2_1da">통합솔루션 안내</a>
                    <button type="button" class="btn_gnb_op">하위분류</button>
                    <ul class="gnb2_2dul">
                        <li class="gnb2_2dli"><a href="<?=G5_URL?>/sub/sub03_01.php"  class="gnb2_2da"><span></span>동문회원 관리시스템</a></li>
                        <li class="gnb2_2dli"><a href="<?=G5_URL?>/sub/sub03_02.php"  class="gnb2_2da"><span></span>홈페이지 </a></li>
                        <li class="gnb2_2dli"><a href="<?=G5_URL?>/sub/sub03_03.php"  class="gnb2_2da"><span></span>모바일앱 </a></li>
                    </ul>
                </li>
                <li class="gnb2_1dli">
                    <a href="<?=G5_BBS_URL?>/board.php?bo_table=qa" class="gnb2_1da">고객센터</a>
                    <button type="button" class="btn_gnb_op">하위분류</button>
                    <ul class="gnb2_2dul">
                        <li class="gnb2_2dli"><a href="<?=G5_BBS_URL?>/board.php?bo_table=qa"  class="gnb2_2da"><span></span>문의 게시판</a></li>
                        <li class="gnb2_2dli"><a href="<?=G5_BBS_URL?>/board.php?bo_table=faq"  class="gnb2_2da"><span></span>FAQ </a></li>
                    </ul>
                </li>
            </ul>

        </div>     
        <script>
        $(function () {
            //폰트 크기 조정 위치 지정
            var font_resize_class = get_cookie("ck_font_resize_add_class");
            if( font_resize_class == 'ts_up' ){
                $("#text_size button").removeClass("select");
                $("#size_def").addClass("select");
            } else if (font_resize_class == 'ts_up2') {
                $("#text_size button").removeClass("select");
                $("#size_up").addClass("select");
            }

            $(".hd_opener").on("click", function() {
                var $this = $(this);
                var $hd_layer = $this.next(".hd_div");

                if($hd_layer.is(":visible")) {
                    $hd_layer.hide();
                    $this.find("span").text("열기");
                } else {
                    var $hd_layer2 = $(".hd_div:visible");
                    $hd_layer2.prev(".hd_opener").find("span").text("열기");
                    $hd_layer2.hide();

                    $hd_layer.show();
                    $this.find("span").text("닫기");
                }
            });


            $(".btn_gnb_op").click(function(){
                $(this).toggleClass("btn_gnb_cl").next(".gnb2_2dul").slideToggle(300);
                
            });

            $(".hd_closer").on("click", function() {
                var idx = $(".hd_closer").index($(this));
                $(".hd_div:visible").hide();
                $(".hd_opener:eq("+idx+")").find("span").text("열기");
            });

            $(".hd_sch_btn").on("click", function() {
                $("#hd_sch").show();
            });

            $("#hd_sch .btn_close").on("click", function() {
                $("#hd_sch").hide();
            });

            
            $("#gnb_open").on("click", function() {
                $("#gnb2").show();
            });

            $("#gnb2 .btn_close").on("click", function() {
                $("#gnb2").hide();
            });

 
        }); 

        //상단고정
        if( $("#hd").length ){
            var jbOffset = $("#hd").offset();
            $( window ).scroll( function() {
                if ( $( document ).scrollTop() > jbOffset.top ) {
                    $( 'body' ).addClass( 'fixed' );
                }
                else {
                    $( 'body' ).removeClass( 'fixed' );
                }
            });
        }
        </script>
        
    </div>
   
</header>



<div id="wrapper">

    <div id="container">
    <?php if (!defined("_INDEX_")) { ?><h2 id="container_title" class="top" title="<?php echo get_text($g5['title']); ?>"><?php echo get_head_title($g5['title']); ?></h2><?php } ?>
