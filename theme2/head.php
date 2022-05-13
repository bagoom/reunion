<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

run_event('pre_head');

if(defined('G5_THEME_PATH')) {
    require_once(G5_THEME_PATH.'/head.php');
    return;
}

if (G5_IS_MOBILE) {
    include_once(G5_MOBILE_PATH.'/head.php');
    return;
}

include_once(G5_PATH.'/head.sub.php');
include_once(G5_LIB_PATH.'/latest.lib.php');
include_once(G5_LIB_PATH.'/outlogin.lib.php');
include_once(G5_LIB_PATH.'/poll.lib.php');
include_once(G5_LIB_PATH.'/visit.lib.php');
include_once(G5_LIB_PATH.'/connect.lib.php');
include_once(G5_LIB_PATH.'/popular.lib.php');

$reunion_config_file = G5_DATA_PATH.'/'.REUNIONCONFIG_FILE;
if (!file_exists($reunion_config_file)) {
    die(goto_url('./install/install_reunion.php', false));
}
?>

<!-- 상단 시작 { -->
<div id="hd">
    <h1 id="hd_h1"><?php echo $g5['title'] ?></h1>
    <div id="skip_to_container"><a href="#container">본문 바로가기</a></div>

    <?php
    if(defined('_INDEX_')) { // index에서만 실행
        include G5_BBS_PATH.'/newwin.inc.php'; // 팝업레이어
    }
    ?>
    <div id="tnb" class="pc-show">
        <div class="inner">
			<ul id="hd_qnb">
                <?php if ($is_member) {  ?>
                    <?php if (!$is_admin) {  ?>
                    <li><a href="<?php echo G5_BBS_URL ?>/member_confirm.php?url=<?php echo G5_BBS_URL ?>/register_form.php">정보수정</a></li>
                    <?php } ?>
                    <li><a href="<?php echo G5_BBS_URL ?>/logout.php">로그아웃</a></li>
                    <?php if ($is_admin) {  ?>
                    <li class="tnb_admin"><a href="<?php echo correct_goto_url(G5_ADMIN_URL); ?>">관리자</a></li>
                    <?php }  ?>
                    <?php } else {  ?>
                    <li><a href="<?php echo G5_BBS_URL ?>/register.php">회원가입</a></li>
                    <li><a href="<?php echo G5_BBS_URL ?>/login.php">로그인</a></li>
                    <li><a href="<?php echo G5_ADMIN_URL ?>">관리자</a></li>
                <?php }  ?>
	        </ul>
		</div>
    </div>
    <div id="hd_wrapper">
        <div id="logo">
            <a href="<?php echo G5_URL ?>"><img src="<?php echo G5_IMG_URL ?>/logo.gif" alt="<?php echo $config['cf_title']; ?>"></a>
        </div>

        <div class="nav-open-btn m-show">
            <i class="xi-bars"></i>
        </div>
        <nav id="gnb" class="pc-show">
            <h2>메인메뉴</h2>
            <div class="gnb_wrap">
                <ul id="gnb_1dul">
                    <?php
                    $menu_datas = get_menu_db(0, true);
                    $gnb_zindex = 999; // gnb_1dli z-index 값 설정용
                    $i = 0;
                    foreach( $menu_datas as $row ){
                        if( empty($row) ) continue;
                        $add_class = (isset($row['sub']) && $row['sub']) ? 'gnb_al_li_plus' : '';
                    ?>
                    <li class="gnb_1dli <?php echo $add_class; ?>" style="z-index:<?php echo $gnb_zindex--; ?>">
                        <a href="<?=G5_URL?><?php echo $row['me_link']; ?>" target="_<?php echo $row['me_target']; ?>" class="gnb_1da"><?php echo $row['me_name'] ?></a>
                    </li>
                    <?php
                    $i++;
                    }   //end foreach $row
    
                    if ($i == 0) {  ?>
                        <li class="gnb_empty">메뉴 준비 중입니다.<?php if ($is_admin) { ?> <a href="<?php echo G5_ADMIN_URL; ?>/menu_list.php">관리자모드 &gt; 환경설정 &gt; 메뉴설정</a>에서 설정하실 수 있습니다.<?php } ?></li>
                    <?php } ?>
                </ul>
                <div id="gnb_all">
                    <div class="inner-wrapper">
                    <ul class="gnb_al_ul">
                        <?php
                        
                        $i = 0;
                        foreach( $menu_datas as $row ){
                        ?>
                        <li class="gnb_al_li">
                            <!-- <a href="<?php echo $row['me_link']; ?>" target="_<?php echo $row['me_target']; ?>" class="gnb_al_a"><?php echo $row['me_name'] ?></a> -->
                            <?php
                            $k = 0;
                            foreach( (array) $row['sub'] as $row2 ){
                                if($k == 0)
                                    echo '<ul>'.PHP_EOL;
                            ?>
                                <li><a href="<?=G5_URL?><?php echo $row2['me_link']; ?>" target="_<?php echo $row2['me_target']; ?>"><?php echo $row2['me_name'] ?></a></li>
                            <?php
                            $k++;
                            }   //end foreach $row2
    
                            if($k > 0)
                                echo '</ul>'.PHP_EOL;
                            ?>
                        </li>
                        <?php
                        $i++;
                        }   //end foreach $row
    
                        if ($i == 0) {  ?>
                            <li class="gnb_empty">메뉴 준비 중입니다.<?php if ($is_admin) { ?> <br><a href="<?php echo G5_ADMIN_URL; ?>/menu_list.php">관리자모드 &gt; 환경설정 &gt; 메뉴설정</a>에서 설정하실 수 있습니다.<?php } ?></li>
                        <?php } ?>
                    </ul>
                    </div>
                </div>
            </div>
        </nav>
        <nav id="gnb" class="m-show">
            <div id="tnb" >
                <div class="inner">
                    <ul id="hd_qnb">
                        <?php if ($is_member) {  ?>
                            <li><a href="<?php echo G5_BBS_URL ?>/member_confirm.php?url=<?php echo G5_BBS_URL ?>/register_form.php">정보수정</a></li>
                            <li><a href="<?php echo G5_BBS_URL ?>/logout.php">로그아웃</a></li>
                            <?php } else {  ?>
                            <li><a href="<?php echo G5_BBS_URL ?>/register.php">회원가입</a></li>
                            <li><a href="<?php echo G5_BBS_URL ?>/login.php">로그인</a></li>
                        <?php }  ?>
                    </ul>
                </div>
            </div>
            <div class="nav-close-btn"><i class="xi-close"></i></div>
            <h2>메인메뉴</h2>
            <div class="gnb_wrap">
                <ul id="gnb_1dul">
                    <?php
                    $menu_datas = get_menu_db(0, true);
                    $gnb_zindex = 999; // gnb_1dli z-index 값 설정용
                    $i = 0;
                    foreach( $menu_datas as $row ){
                        if( empty($row) ) continue;
                        $add_class = (isset($row['sub']) && $row['sub']) ? 'gnb_al_li_plus' : '';
                    ?>
                    <li class="gnb_1dli <?php echo $add_class; ?>" style="z-index:<?php echo $gnb_zindex--; ?>">
                        <a href="<?=G5_URL?><?php echo $row['me_link']; ?>" target="_<?php echo $row['me_target']; ?>" class="gnb_1da"><?php echo $row['me_name'] ?></a>
                    </li>
                    <?php
                    $i++;
                    }   //end foreach $row
    
                    if ($i == 0) {  ?>
                        <li class="gnb_empty">메뉴 준비 중입니다.<?php if ($is_admin) { ?> <a href="<?php echo G5_ADMIN_URL; ?>/menu_list.php">관리자모드 &gt; 환경설정 &gt; 메뉴설정</a>에서 설정하실 수 있습니다.<?php } ?></li>
                    <?php } ?>
                </ul>
                <div id="gnb_all">
                    <div class="inner-wrapper">
                    <ul class="gnb_al_ul">
                        <?php
                        
                        $i = 0;
                        foreach( $menu_datas as $row ){
                        ?>
                        <li class="gnb_al_li">
                            <!-- <a href="<?php echo $row['me_link']; ?>" target="_<?php echo $row['me_target']; ?>" class="gnb_al_a"><?php echo $row['me_name'] ?></a> -->
                            <?php
                            $k = 0;
                            foreach( (array) $row['sub'] as $row2 ){
                                if($k == 0)
                                    echo '<ul>'.PHP_EOL;
                            ?>
                                <li><a href="<?=G5_URL?><?php echo $row2['me_link']; ?>" target="_<?php echo $row2['me_target']; ?>"><?php echo $row2['me_name'] ?></a></li>
                            <?php
                            $k++;
                            }   //end foreach $row2
    
                            if($k > 0)
                                echo '</ul>'.PHP_EOL;
                            ?>
                        </li>
                        <?php
                        $i++;
                        }   //end foreach $row
    
                        if ($i == 0) {  ?>
                            <li class="gnb_empty">메뉴 준비 중입니다.<?php if ($is_admin) { ?> <br><a href="<?php echo G5_ADMIN_URL; ?>/menu_list.php">관리자모드 &gt; 환경설정 &gt; 메뉴설정</a>에서 설정하실 수 있습니다.<?php } ?></li>
                        <?php } ?>
                    </ul>
                    </div>
                </div>
            </div>
        </nav>
    </div>
    
    <script>
    
    $(function(){
        var menu = $(".gnb_wrap .gnb_1dli"),
              bg = $("#gnb_all");

        menu.on('mouseenter focusin', function () {
            console.log(menu);
            menu.find("a").removeClass('on');
            bg.show();
            // $('.gnb-2dep').removeClass('on');
            $(this).children('a').addClass('on').next('.gnb-2dep').addClass('on');
            // $('#gnb').addClass('hover');
            // $('.gnb-bg').addClass('on');
            // var depth2_h = $(this).children('.gnb-2dep').innerHeight();

            // $('.gnb-bg').stop().animate({
            //     height: depth2_h + 'px'
            // }, 300, "easeOutExpo");
        });
        $("#gnb").on('mouseleave', function () {
            $('#gnb .gnb-1dep a').removeClass('on');
            $('.gnb-2dep').removeClass('on');
            $('#gnb').removeClass('hover');
            $('.gnb-bg').removeClass('on');
            bg.hide();
            $('.gnb-bg').stop().animate({
                height: "0"
            }, {
                duration: 600,
                easing: "easeOutBack"
            });
        });

        $(".nav-open-btn").click(function(){
            $("#gnb.m-show").addClass("on");
        });
        $(".nav-close-btn").click(function(){
            $("#gnb.m-show").removeClass("on");
        });

    });

    </script>
</div>
<!-- } 상단 끝 -->


<hr>

<!-- 콘텐츠 시작 { -->
<div id="wrapper" class="<?=(!defined("_INDEX_")) ? "sub" : "main"?>">
    <?php if (!defined("_INDEX_")) { ?>
        <div id="sub-title">
            <h2 class="sub-title-h2"><?=$reunion['reunion_title']?> 총동문회에 오신것을<br> 환영합니다</h2>
        </div>
    <?php } ?>
    <div id="container_wr">
        <?php if (!defined("_INDEX_")) {  
            include_once(G5_PATH.'/include/location.php'); 
            include_once(G5_PATH.'/include/mysubmenu.php'); 
        } ?>
        <div id="container">