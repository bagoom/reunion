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
            <!-- <div id="ft_link" class="ft_cnt">
            <a href="<?php echo get_pretty_url('content', 'company'); ?>">동문회 안내</a>
            <a href="<?php echo get_pretty_url('content', 'privacy'); ?>">개인정보처리방침</a>
            <a href="<?php echo get_pretty_url('content', 'provision'); ?>">서비스이용약관</a>
        </div> -->


            <div id="ft_company" class="ft_cnt">
                <p class="ft_info">
                인천 미추홀구 한나루로 545, 5동 3층<br class="m-show"> Tel: 032-865-5222 <br>
                    <!-- E-mail:alumni1398@hanmail.net<br> -->
                    COPYRIGHTⓒ2022 인천기계공업고등학교 총동문회<br class="m-show"> ALL RIGHTS RESERVED.
                </p>
            </div>
        </div>
    </div>
    <!-- <div id="ft_catch"><img src="<?php echo G5_IMG_URL; ?>/ft_logo.png" alt="<?php echo G5_VERSION ?>"></div> -->

    <button type="button" id="top_btn">
        <i class="fa fa-arrow-up" aria-hidden="true"></i><span class="sound_only">상단으로</span>
    </button>
    <script>
        $(function () {
            $("#top_btn").on("click", function () {
                $("html, body").animate({
                    scrollTop: 0
                }, '500');
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
    // VConsole will be exported to `window.VConsole` by default.
    //   var vConsole = new window.VConsole();
</script>
<script>
    var is_app = bugilgoaos ? bugilgoaos : null;
    function gotoMobileUrl(url) {
        if (is_app) {
            if (deviceType() == 'android') {
                bugilgoaos.goWebSafari(url);
            } else if (deviceType() == 'ios' && is_mobile) {
                var obj = {};
                obj.name = "goWebSafari";
                obj.url = url;
                webkit.messageHandlers.bugilgoaos.postMessage(JSON.stringify(obj));
                console.log(webkit)
            }
        } else {
            console.log(url)
            window.open(url, "_blank", )
        }
    }
    $(function () {

        $(window).scroll(function () {
            if ($(window).scrollTop() >= 250) {
                $('#hd').addClass('fixed');
            } else {
                $('#hd').removeClass('fixed');
            }
        });

        var dep2Text = $(".onSideMenu .leftmenu_b").text();
        var dep2Link = $(".onSideMenu >a").attr("href");
        $(".dep2-location a").text(dep2Text);
        $(".dep2-location a").attr("href", dep2Link);
        // 폰트 리사이즈 쿠키있으면 실행
        font_resize("container", get_cookie("ck_font_resize_rmv_class"), get_cookie(
        "ck_font_resize_add_class"));
    });
</script>

<?php
include_once(G5_PATH."/tail.sub.php");