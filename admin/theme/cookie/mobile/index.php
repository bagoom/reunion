<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

include_once(G5_THEME_MOBILE_PATH.'/head.php');
?>

<!-- 배너 최신글 -->
<?php
echo latest('theme/banner', 'banner', 4, 33);
?>
<div id="index">
	<?php /*
	<!-- 강의후기 -->
	<!--<div class="banner_wrap width_940">
		<div class="tit_wrap">
			<h2>코드몽키 강의후기</h2>
			<a href="https://monkeycheat1.com/category/%ed%95%b4%ed%82%b9%ea%b3%bc%ec%99%b8-%ec%88%98%ea%b0%95%ec%83%9d%eb%93%a4-%ec%9e%91%ed%92%88/" target="_blank"><div class="btn_more">+more</div></a>
		</div>
		<?php
		echo latest('theme/swiper_card', 'service', 6, 25);
		?>
	</div>-->
	*/?>

	<!-- 비용안내 -->
	<div class="banner_wrap index_cost">
		<div class="tit_wrap">
			<h2>회원명부사업</h2>
		</div>
		<div class="index_wrap_1200">
			<!-- 비용 위 -->
			<!--<div class="cost_box_con">
				<div class="col-md-6">
					<li>
						<h2>커리큘럼A-모딩문서형</h2>
						<p class="cost_txt">150,000<span>/원</span></p>
						<p>· 수강생의 수준에 맞는 맞춤강의<br>
							· 자료실 무제한 열람<br>
							· 지속적인 기술 업데이트<br>
							· 모더들끼리의 커뮤니티
						</p>
						<a href="https://open.kakao.com/o/scADhrrc" target="_blank"><p class="btn_more">신청하기</p></a>
					</li>
				</div>
				<div class="col-md-6">
					<li>
						<h2>커리큘럼B- 2주 기초탄탄형</h2>
						<p class="cost_txt">200,000<span>/원</span></p>
						<p>· 프로그램을 전혀 모르는 생초보도 해킹가능!<br>
							· 덧셈 뺄셈 ABC 만 알아도 가능!<br>
							· 지속적인 기술 업데이트<br>
							· 모더들끼리의 커뮤니티
						</p>
						<a href="https://open.kakao.com/o/scADhrrc" target="_blank"><p class="btn_more">신청하기</p></a>
					</li>
				</div>
			</div>-->
			<!-- 비용 아래 -->
			<div class="cost_box_con">
				<div class="col-md-3">
					<li>
						<h2>01</h2>
						<a href="/sub/sub02_01.php"><p class="cost_txt_tit">회원명부제작</p></a>
						<p>우리반넷은 30여명의 전문 리서치(TM) 조사요원, 빅데이터 관리시스템, 전문 광고 및 편집디자이너를 보유하여 귀 동문회(단체)가 원하시는 최적의 동문명부를 만들어 드립니다.
						</p>
					</li>
				</div>
				<div class="col-md-3">
					<li>
						<h2>02</h2>
						<a href="/sub/sub02_02.php"><p class="cost_txt_tit">기타홍보물 제작사업</p></a>
						<p>
						· 동문회보<br />
						· 동문회 년사 (예:50년사,80년사, 100년사 등등)
						</p>
					</li>
				</div>
				<div class="col-md-3">
					<li>
						<h2>03</h2>
						<a href="/sub/sub02_03.php"><p class="cost_txt_tit">주요 포트폴리오</p></a>
						<p>각 대학교/고등학교/중학교/초등학교 이외 기타 동문회
						</p>
					</li>
				</div>
				<!--<div class="col-md-3">
					<li>
						<h2>04</h2>
						<p class="cost_txt_tit">정보교환 커뮤니티</p>
						<p>· 강의가 끝난 후 모더들과 정보, 기술공유를 통한 커뮤니티를 형성하고 있습니다.<br>· 여러분도 여기에 참여하실 수 있어요.
						</p>
					</li>
				</div>-->
			</div>
		</div>
	</div>

	<!-- 대표칼럼 -->
	<div class="banner_wrap width_940">
		<div class="tit_wrap">
			<h2>통합솔루션 안내</h2>
			<!--<a href="https://monkeycheat1.com/category/%ec%bd%94%eb%aa%bd%ec%8a%a4%ed%86%a0%eb%a6%ac/" target="_blank"><div class="btn_more">+more</div></a>-->
		</div>
		<div class="cost_box_con">
				<div class="col-md-6">
					<li>
						
						<h2>홈페이지</h2>
						<div class="icon"><img src="<?=G5_THEME_IMG_URL?>/icon_pc.png"></div>
						<!--<p class="cost_txt">150,000<span>/원</span></p>-->
						<p>주소록 관리 시스템으로 회비관리, 그룹별 관리를 쉽고 편하게 할 수 있고 차별화된 커뮤니케이션을 제공합니다.
						</p>
						<a href="/sub/sub03_02.php"><p class="btn_more">바로가기</p></a>
					</li>
				</div>
				<div class="col-md-6">
					<li>
						<h2>모바일앱</h2>
						<div class="icon"><img src="<?=G5_THEME_IMG_URL?>/icon_mobile.png"></div>
						<p>PC 홈페이지와 연동되는 모바일 앱으로 언제 어디서나 편하게 사용할 수 있습니다.
						</p>
						<a href="/sub/sub03_03.php"><p class="btn_more">바로가기</p></a>
					</li>
				</div>
			</div>
	</div>

	<!-- 비용안내 -->
	<div class="banner_wrap index_cost">
		<!--<div class="tit_wrap">
			<h2>우리반넷 관리시스템/소개</h2>
		</div>-->
		<div class="index_wrap_1200">
			<!-- 비용 위 -->
			<div class="box_con">
				<div class="col-md-6">
					<li>
						<h2>동문회원 관리시스템</h2>
						<a href="/sub/sub03_01.php"><div><img src="<?=G5_THEME_IMG_URL?>/total.jpg"></div></a>
						<!-- 유튜브링크 -->
						<!--<iframe width="100%" height="315" src="https://www.youtube.com/embed/O1LiWw9jGtQ" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>-->
					</li>
				</div>
				<div class="col-md-6">
					<li>
						<h2>우리반넷 소개</h2>
						<a href="/sub/sub01_01.php"><div><img src="<?=G5_THEME_IMG_URL?>/greeting.jpg"></div></a>
						<!-- 유튜브링크 크리100-->
						<!--<iframe width="100%" height="315" src="https://www.youtube.com/embed/pqg2nZcI-KU" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>-->
					</li>
				</div>
			</div>
			
		</div>
	</div>

</div>
<?php
include_once(G5_THEME_MOBILE_PATH.'/tail.php');
?>