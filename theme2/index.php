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

        <div class="event">
            <div class="tit">
                동문의 경조사를<br> 빠르게 확인해보세요.
                <div class="desc"><a href="#">더보기</a></div>
        </div>

            <?=latest('event', 'event', 4, 40);?>
        </div>
    </div>

    <div class="main_con sec02">
        <div class="quick_wrap">
            <ul>
                <li>
                    <a href="">
                        <div class="con">
                            <h3 class="tit">동문회 회칙 안내</h3>
                        </div>
                    </a>
                    <div class="link">
                        <div class="btn">
                            <a href="">
                                <i class="xi-arrow-right"></i>
                            </a>
                        </div>
                    </div>
                </li>
                <li>
                    <a href="">
                        <div class="con">
                            <h3 class="tit">동문회비 안내</h3>
                        </div>
                    </a>
                    <div class="link">
                        <div class="btn">
                            <a href="">
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
                    <div class="swiper-slide"><img src="<?= G5_IMG_URL ?>/main_banner.jpg?v=<?=G5_IMG_VER?>" alt=""></div>
                    <div class="swiper-slide"><img src="<?= G5_IMG_URL ?>/main_banner.jpg?v=<?=G5_IMG_VER?>" alt=""></div>
                </div>
            </div>
        </div>
    </div>

    <h2 class="sound_only">최신글</h2>
    <div class="latest_top_wr">
        <?php
            echo latest('pic_list', 'event', 4, 40);			
            echo latest('pic_list', 'news', 4, 40);			
            echo latest('pic_list', 'promotion', 4, 40);		
        ?>
    </div>
</div>

<div class="main_gallery">
    <div class="inner-wrapper">
        <div class="latest_wr">
            <?=latest('pic_block', 'gallery', 4, 23)?>
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
</script>
<?php
include_once(G5_PATH.'/tail.php');