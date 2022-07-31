<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

// add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
add_stylesheet('<link rel="stylesheet" href="'.$member_skin_url.'/style.css">', 0);
?>

<!-- 로그인 시작 { -->
<div id="mb_login" class="mbskin">
    <div class="login-wrap">
        <div class="txt">
            <h3><?=$reunion['reunion_title']?> </h3>
            <p>동문 관리자 시스템 </p>
        </div>




        <div class="login-form">
            <form name="flogin" action="<?php echo $login_action_url ?>" onsubmit="return flogin_submit(this);" method="post">
                <div class="input-row">
                    <input type="text" name="mg_id" placeholder="관리자 아이디">
                </div>
                <div class="input-row">
                    <input type="password" name="mg_pass" placeholder="관리자 비밀번호">
                </div>

                <div class="btn-wrap">
                    <button type="submit">로그인</button>
                </div>
            </form>
        </div>

        <div class="login-footer">
            <h3>Made by <a href="//wooribannet.com" target="_blank">wooribannet.com</a></h3>
            <p>온라인 문의 : <a href="mailto:help_blue@naver.com">help_blue@naver.com</a></p>
        </div>
    </div>






    <!-- <div class="mbskin_box">
        <h1><?php echo $g5['title'] ?></h1>
        <div class="mb_log_cate">
            <h2><span class="sound_only">회원</span>로그인</h2>
            <a href="<?php echo G5_BBS_URL ?>/register.php" class="join">동문인증</a>
        </div>
        <form name="flogin" action="<?php echo $login_action_url ?>" onsubmit="return flogin_submit(this);" method="post">
        <input type="hidden" name="url" value="<?php echo $login_url ?>">
        
        <fieldset id="login_fs">
            <legend>회원로그인</legend>
            <label for="login_id" class="sound_only">회원아이디<strong class="sound_only"> 필수</strong></label>
            <input type="text" name="mb_id" id="login_id" required class="frm_input required" size="20" maxLength="20" placeholder="아이디">
            <label for="login_pw" class="sound_only">비밀번호<strong class="sound_only"> 필수</strong></label>
            <input type="password" name="mb_password" id="login_pw" required class="frm_input required" size="20" maxLength="20" placeholder="비밀번호">
            <button type="submit" class="btn_submit">로그인</button>
            
            <div id="login_info">
                <div class="login_if_auto chk_box">
                    <input type="checkbox" name="auto_login" id="login_auto_login" class="selec_chk">
                    <label for="login_auto_login"><span></span> 자동로그인</label>  
                </div>
                <div class="login_if_lpl">
                    <a href="<?php echo G5_BBS_URL ?>/password_lost.php" target="_blank" id="login_password_lost">정보찾기</a>  
                </div>
            </div>
        </fieldset> 
        </form>
        <?php @include_once(get_social_skin_path().'/social_login.skin.php'); // 소셜로그인 사용시 소셜로그인 버튼 ?>
    </div> -->


</div>

<script>
    function flogin_submit(f) {
        if ($(document.body).triggerHandler('login_sumit', [f, 'flogin']) !== false) {
            return true;
        }
        return false;
    }
</script>
<!-- } 로그인 끝 -->
