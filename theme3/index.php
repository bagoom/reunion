<?php
include_once('./_common.php');

define('_INDEX_', true);
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

if(defined('G5_THEME_PATH')) {
    require_once(G5_THEME_PATH.'/index.php');
    return;
}

if (G5_IS_MOBILE) {
    include_once(G5_MOBILE_PATH.'/index.php');
    return;
}

include_once(G5_PATH.'/head.php');
?>
<link  href="<?=G5_CSS_URL?>/viewer.min.css" rel="stylesheet">
<script src="<?=G5_JS_URL?>/viewer.min.js"></script>

<script src="<?=G5_JS_URL?>/inewsticker.js"></script>
<script src="https://unpkg.com/swiper@5.4.5/js/swiper.min.js"></script>


<div id="visual">
    <div class="swiper-container visual-slide">
        <div class="swiper-wrapper">
            <div class="swiper-slide"></div>
            <div class="swiper-slide"></div>
            <div class="swiper-slide"></div>
            <div class="swiper-slide"></div>
            <div class="swiper-slide"></div>
        </div>
        <div class="inner-wrapper">
            <div class="swiper-pagination"></div>
        </div>
    </div>

    <div class="notice-bar">
        <div class="inner-wrapper">
            <div class="tit">공지사항</div>
            <div class="swiper notice-slide">
                <div class="swiper-wrapper">
                    <?= latest('slide_notice', 'notice', 5, 38);?>
                </div>
            </div>
        </div>
    </div>
</div>

<div id="main_container">

    <div class="main_con sec01">

        <?=latest('pic_list', 'notice', 4, 33);?>

        <div class="main_gallery pc-show">
            <div class="inner-wrapper">
                <div class="latest_wr">
                    <?=latest('pic_block', 'gallery', 3, 23)?>
                </div>
            </div>
        </div>
        <div class="main_gallery m-show">
            <div class="inner-wrapper">
                <div class="latest_wr">
                    <?=latest('pic_block', 'gallery', 4, 23)?>
                </div>
            </div>
        </div>
        <!-- <div class="event">
            <div class="tit">
                동문의 경조사를<br> 빠르게 확인해보세요.
                <div class="desc"><a href="#">더보기</a></div>
        </div>

        </div> -->
    </div>

    <div class="main_con sec02">
        <div class="quick_wrap">
            <ul>
                <li>
                    <a href="<?=G5_URL?>/page/rule.php">
                        <div class="con">
                            <h3 class="tit">동문회 회칙 안내</h3>
                        </div>
                    </a>
                    <div class="link">
                        <div class="btn">
                            <a href="<?=G5_URL?>/page/rule.php">
                                <i class="xi-arrow-right"></i>
                            </a>
                        </div>
                    </div>
                </li>
                <li>
                    <a href="<?=G5_URL?>/page/fees.php">
                        <div class="con">
                            <h3 class="tit">동문회비 안내</h3>
                        </div>
                    </a>
                    <div class="link">
                        <div class="btn">
                            <a href="<?=G5_URL?>/page/fees.php">
                                <i class="xi-arrow-right"></i>
                            </a>
                        </div>
                    </div>
                </li>
            </ul>
        </div>


        <div class="main_banner">
            <div class="swiper-container">
                <div class="swiper-wrapper">
                    <div class="swiper-slide"><a href="javascript:gotoMobileUrl('http://wooribannet.com/');" ><img src="<?= G5_IMG_URL ?>/main_banner.png?v=<?=G5_IMG_VER?>" alt=""></a></div>
                    <div class="swiper-slide"><a href="javascript:gotoMobileUrl('http://wooribannet.com/');" ><img src="<?= G5_IMG_URL ?>/main_banner.png?v=<?=G5_IMG_VER?>" alt=""></a></div>
                </div>
            </div>
        </div>
    </div>

    <h2 class="sound_only">최신글</h2>
    <div class="latest_top_wr">
        <?php
            echo latest('pic_list', 'event', 4, 40);			
            echo latest('pic_list', 'report', 4, 40);			
            echo latest('promotion', 'promotion', 3, 40);		
        ?>
    </div>

    <div class="banner-wrap banner02">
        <div class="swiper-container">
            <div class="swiper-wrapper">
                <?php for ($i=0; $i < 7; $i++) { ?>
                    <div class="swiper-slide"><img src="<?= G5_IMG_URL ?>/banner/banner0<?=$i+1?>.jpg?v=<?=G5_IMG_VER?>" data-original="<?= G5_IMG_URL ?>/banner/banner_b0<?=$i+1?>.jpg?v=<?=G5_IMG_VER?>" alt=""></div>
                <?php }?>
            </div>
        </div>
    </div>
</div>



<script>
    var slide_bn = new Swiper('#visual .swiper-container', {
        slidesPerView: 1, // 영역내 보여질 배너 갯수
        loop: true, // 반복옵션 true, false
        speed: 1000,
        autoplay: {
            delay: 2500,
            disableOnInteraction: false,
        },
        spaceBetween: 0, // 배너간격
        pagination: {
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
    var noticeSlide = new Swiper('#visual .notice-slide', {
        direction: "vertical",
        slidesPerView: 1, // 영역내 보여질 배너 갯수
        loop: true, // 반복옵션 true, false
        speed: 1000,
        height: 30,
        autoplay: {
            delay: 2500,
            disableOnInteraction: false,
        },
        spaceBetween: 0, // 배너간격
    });

    var slide_bn = new Swiper('#main_container .sec02 .swiper-container', {
        autoplay: {
            delay: 2500,
            disableOnInteraction: false,
        },
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
<?php
include_once(G5_PATH.'/tail.php');