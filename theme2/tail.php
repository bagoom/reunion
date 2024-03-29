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
            <!-- <a href="<?php echo get_pretty_url('content', 'company'); ?>">동문회 안내</a> -->
            <a href="<?=PAGE_URL?>/privacy.php">개인정보처리방침</a>
            <a href="<?=PAGE_URL?>/termofuse.php">서비스이용약관</a>
        </div>

        
        <div id="ft_company" class="ft_cnt">
	        <p class="ft_info">
	        	북일고등학교 충천남도 천안시 동남구 단대로 69 (신부동)<br class="m-show"> 총동문회 어플운영팀 전희근(7회) Tel : 010-5422-8248 Fax : 0504-060-8248 <br>
	        	<!-- E-mail:alumni1398@hanmail.net<br> -->
                COPYRIGHTⓒ2022 북일고등학교 총동문회<br class="m-show"> ALL RIGHTS RESERVED.
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
<script src="https://unpkg.com/vconsole@latest/dist/vconsole.min.js"></script>
<script>
    // var vConsole = new window.VConsole();
</script>
<script>
    var bugilgoaos = bugilgoaos ? bugilgoaos : null;
    // var webkit;
    
    
    
    function gotoMobileUrl(url) {
        var is_mobile = <?=is_mobile()?>;
            console.log(url)
        if (deviceType() == 'android' && bugilgoaos) {
            console.log(url)
            console.log(bugilgoaos)
            bugilgoaos.goWebSafari(url);
        } else if (deviceType() == 'ios') {
            var obj = {};
            obj.name = "goWebSafari";
            obj.url = url;
            // console.log('ftp://'+g5_url+'/bridge.html')
            // webkit.messageHandlers.bugilgoaos.postMessage(JSON.stringify(obj));
            // location.href='ftp://'+g5_url+'/bridge.html'
            window.open(url, "_blank", )
        } else {
        console.log(url)
        window.open(url, "_blank", )
        }
        
    }
$(function() {

    var dep2Text = $(".onSideMenu .leftmenu_b").text();
    var dep2Link = $(".onSideMenu >a").attr("href");
    $(".dep2-location a").text(dep2Text);
    $(".dep2-location a").attr("href",dep2Link);
    // 폰트 리사이즈 쿠키있으면 실행
    font_resize("container", get_cookie("ck_font_resize_rmv_class"), get_cookie("ck_font_resize_add_class"));
});
</script>

<?php
include_once(G5_PATH."/tail.sub.php");