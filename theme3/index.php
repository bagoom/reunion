<?php
include_once "./_common.php";

define("_INDEX_", true);
if (!defined("_GNUBOARD_")) {
  exit();
} // 개별 페이지 접근 불가

if (defined("G5_THEME_PATH")) {
  require_once G5_THEME_PATH . "/index.php";
  return;
}

if (G5_IS_MOBILE) {
  include_once G5_MOBILE_PATH . "/index.php";
  return;
}

include_once G5_PATH . "/head.php";
?>
<link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css" />
<script src="https://unpkg.com/aos@next/dist/aos.js"></script>

<link href="<?= G5_CSS_URL ?>/viewer.min.css" rel="stylesheet">
<script src="<?= G5_JS_URL ?>/viewer.min.js"></script>

<script src="<?= G5_JS_URL ?>/inewsticker.js"></script>

<script src="https://cdn.jsdelivr.net/npm/swiper@8/swiper-bundle.min.js"></script>


<div id="visual">
    <div class="swiper-container visual-slide">
        <div class="swiper-wrapper">
            <div class="swiper-slide">
                <div class="txt">
                    <div class="mask">
                        <h3 data-aos="fade-down" data-aos-duration="1300">"멀리 함게 가는"</h3>
                    </div>
                    <div class="mask">
                        <p data-aos="fade-down" data-aos-duration="1300" data-aos-delay="150">인천기계공고 동문장학회</p>
                    </div>
                </div>
            </div>
            <div class="swiper-slide">
                <div class="txt">
                    <div class="mask">
                        <h3 data-aos="fade-down" data-aos-duration="1300">"멀리 함게 가는"</h3>
                    </div>
                    <div class="mask">
                        <p data-aos="fade-down" data-aos-duration="1300" data-aos-delay="150">인천기계공고 동문장학회</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="inner-wrapper">
            <div class="swiper-pagination"></div>

            <div class="quick-menu">
                <ul>
                    <li><a href="<?=PAGE_URL?>/rule.php">회칙안내 <i class="xi-paper-o"></i></a></li>
                    <li><a href="<?=PAGE_URL?>/fees.php">회비안내 <i class="xi-paper-o"></i></a></li>
                </ul>
            </div>
        </div>
    </div>
</div>

<div id="main_container">

    <div class="main_con sec01">
        <div class="inner-wrapper">
            <?= latest("pic_notice", "notice", 2, 33) ?>

            <div class="main_gallery pc-show">
                <div class="lat_title">BANNER ZONE</div>
                <div class="maing-gallery-control">
                    <div class="box">
                        <div class="swiper-pagination"></div>
                        <div class="swiper-button-next"></div>
                        <div class="swiper-button-prev"></div>
                    </div>

                </div>
                <div class="swiper-container">
                    <div class="swiper-wrapper">
                        <div class="swiper-slide">
                            <!-- <a href="javascript:gotoMobileUrl('http://wooribannet.com/');">
                                <img src="<?= G5_IMG_URL ?>/main_banner.png?v=<?= G5_IMG_VER ?>" alt="">
                            </a> -->
                        </div>
                        <div class="swiper-slide">
                            <!-- <a href="javascript:gotoMobileUrl('http://wooribannet.com/');">
                                <img src="<?= G5_IMG_URL ?>/main_banner.png?v=<?= G5_IMG_VER ?>" alt="">
                            </a> -->
                        </div>
                    </div>
                </div>
            </div>
            <div class="main_gallery m-show">
                <div class="inner-wrapper">
                    <div class="latest_wr">
                        <?= latest("pic_block", "gallery", 4, 23) ?>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="main_con sec02">
        <div class="inner-wrapper">
            <?= latest("slide_gallery", "gallery", 4, 45) ?>
        </div>
    </div>

    <h2 class="sound_only">최신글</h2>
    <div class="latest_top_wr">
        <div class="inner-wrapper">
            <?php
        echo latest("pic_list", "event", 4, 40);
        echo latest("pic_list", "report", 4, 40);
        echo latest("promotion", "promotion", 3, 40);
        ?>
        </div>
    </div>

    <div class="banner-wrap banner02">
        <div class="inner-wrapper">
            <div class="swiper-container">
                <div class="swiper-wrapper">
                    <?php for ($i = 0; $i < 7; $i++) { ?>
                    <div class="swiper-slide">
                        <img src="<?= G5_IMG_URL ?>/banner/banner0<?= $i +  1 ?>.jpg?v=<?= G5_IMG_VER ?>"
                            data-original="<?= G5_IMG_URL ?>/banner/banner_b0<?= $i +1 ?>.jpg?v=<?= G5_IMG_VER ?>"
                            alt="">
                    </div>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>
</div>



<script>
    AOS.init();
    var mainVisual = new Swiper('#visual .swiper-container', {
        slidesPerView: 1, // 영역내 보여질 배너 갯수
        loop: true, // 반복옵션 true, false
        speed: 1300,
        autoplay: {
            delay: 3000,
            disableOnInteraction: true,
        },
        spaceBetween: 0, // 배너간격
        pagination: {
            clickable: true,
            el: "#visual  .swiper-pagination",
        },

        // 반응형 세팅
        // 필요시 설정하시면 됩니다.
        breakpoints: {
            1024: { // 가로 1024px 이상
                slidesPerView: 1, // 보여질 배너 갯수
                spaceBetween: 0 // 배너간격
            },
            768: { // 가로 768px 이하
                slidesPerView: 1, // 보여질 배너 갯수
                spaceBetween: 0 // 배너간격
            },
            640: { // 가로 640px 이하
                slidesPerView: 1, // 보여질 배너 갯수
                spaceBetween: 0 // 배너간격
            },
            450: { // 가로 450px 이하
                slidesPerView: 1, // 보여질 배너 갯수
                spaceBetween: 0 // 배너간격
            }
        }
    });

    mainVisual.on('slideChangeTransitionEnd', function () {
        $("#visual .visual-slide .swiper-slide .txt h3").addClass("aos-animate")
        $("#visual .visual-slide .swiper-slide .txt p").addClass("aos-animate")
    });
    mainVisual.on('slideChangeTransitionStart', function () {
        $("#visual .visual-slide .swiper-slide-active .txt h3").removeClass("aos-animate")
        $("#visual .visual-slide .swiper-slide-active .txt p").removeClass("aos-animate")
    });

    var slide_bn = new Swiper('.main_gallery.pc-show .swiper-container', {
        speed: 1300,
        loop: true, // 반복옵션 true, false
        autoplay: {
            delay: 2500,
            disableOnInteraction: false,
        },
        pagination: {
            el: ".main_gallery .swiper-pagination",
            type: "fraction",
        },
        navigation: {
            nextEl: ".swiper-button-next",
            prevEl: ".swiper-button-prev",
        },
    });

    var slide_bn = new Swiper('.sec02 .swiper-container', {
        speed: 1300,
        slidesPerView: 4,
        spaceBetween: 20,
        touchRatio: 0,
        loop: true, // 반복옵션 true, false
    });

    var slide_bn = new Swiper('#main_container .banner02 .swiper-container', {
        slidesPerView: 2, // 영역내 보여질 배너 갯수
        spaceBetween: 20, // 배너간격
        speed: 1200,
        autoplay: {
            delay: 3500,
            disableOnInteraction: false,
        },
        breakpoints: {
            1024: { // 가로 1024px 이상
                slidesPerView: 3, // 보여질 배너 갯수
                spaceBetween: 30 // 배너간격
            },
        }
    });

    var $image = $('.banner02 .swiper-slide img');
    var viewer = $image.data('viewer');
    $image.viewer({
        navbar: false,
        toolbar: false,
        url: 'data-original',
        title: function (image, imageData) {
            return image.title;
        },
        view(event) {
            event.detail.image.title = event.detail.originalImage.title;
        },
    });
</script>
<?php include_once G5_PATH . "/tail.php";
