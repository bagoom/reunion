<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가
 error_reporting(E_ALL);
    ini_set('display_errors', '1');
if(defined('G5_THEME_PATH')) {
    require_once(G5_THEME_PATH.'/tail.php');
    return;
}

if (G5_IS_MOBILE) {
    include_once(G5_MOBILE_PATH.'/tail.php');
    return;
}
?>

    </div>
</div>
</div>
<!-- } 콘텐츠 끝 -->


<!-- 하단 시작 { -->
<div id="ft">

    <div id="ft_wr">

        
        <div class="ft_logo"><img src="<?= G5_IMG_URL ?>/ft_logo.png?v=<?=G5_IMG_VER?>" alt=""></div>
        <div class="ft_content">
        <div id="ft_link" class="ft_cnt">
            <a href="<?php echo get_pretty_url('content', 'company'); ?>">동문회 안내</a>
            <a href="<?php echo get_pretty_url('content', 'privacy'); ?>">개인정보처리방침</a>
            <a href="<?php echo get_pretty_url('content', 'provision'); ?>">서비스이용약관</a>
        </div>


        <div id="ft_company" class="ft_cnt">
	        <p class="ft_info">
	        	성균관대학교 총동창회 서울특별시 종로구 율곡로 171, 204호 (원남동, 글로벌센터) Tel: 02.741-4171 Fax: 02.741.4170 HP:010-3152-4171 <br>
	        	E-mail:alumni1398@hanmail.net<br>
	        	COPYRIGHT ⓒ SUNGKYUNKWAN UNIVERSITY ALUMNI ALL RIGHTS RESERVED.
			</p>
	    </div>
        </div>
    </div>
    <!-- <div id="ft_catch"><img src="<?php echo G5_IMG_URL; ?>/ft_logo.png" alt="<?php echo G5_VERSION ?>"></div> -->

    <button type="button" id="top_btn">
    	<i class="fa fa-arrow-up" aria-hidden="true"></i><span class="sound_only">상단으로</span>
    </button>
    <script>
    $(function() {
        $("#top_btn").on("click", function() {
            $("html, body").animate({scrollTop:0}, '500');
            return false;
        });
    });
    </script>
</div>

<?php
if(G5_DEVICE_BUTTON_DISPLAY && !G5_IS_MOBILE) { ?>
<?php
}

if ($config['cf_analytics']) {
    echo $config['cf_analytics'];
}
?>

<!-- } 하단 끝 -->

<script>
$(function() {
    var dep2Text = $(".onSideMenu .leftmenu_b").text();
    $(".dep2-location").text(dep2Text);
    // 폰트 리사이즈 쿠키있으면 실행
    font_resize("container", get_cookie("ck_font_resize_rmv_class"), get_cookie("ck_font_resize_add_class"));
});
</script>

<?php
include_once(G5_PATH."/tail.sub.php");