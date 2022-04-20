<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

include_once(G5_THEME_MOBILE_PATH.'/head.php');
?>

<!-- 배너 최신글 -->
<?php
echo latest('theme/banner', 'banner', 4, 33);
?>
<div id="index">
	<!-- 강의후기 -->
	<div class="banner_wrap width_940">
		<div class="tit_wrap">
			<h2>코드몽키 강의후기</h2>
			<a href="https://monkeycheat1.com/category/%ed%95%b4%ed%82%b9%ea%b3%bc%ec%99%b8-%ec%88%98%ea%b0%95%ec%83%9d%eb%93%a4-%ec%9e%91%ed%92%88/" target="_blank"><div class="btn_more">+more</div></a>
		</div>
		<?php
		echo latest('theme/swiper_card', 'service', 6, 25);
		?>
	</div>

	<!-- 비용안내 -->
	<div class="banner_wrap index_cost">
		<div class="tit_wrap">
			<h2>코드몽키 비용안내</h2>
		</div>
		<div class="index_wrap_1200">
			<!-- 비용 위 -->
			<div class="cost_box_con">
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
			</div>
			<!-- 비용 아래 -->
			<div class="cost_box_con">
				<div class="col-md-3">
					<li>
						<h2>01</h2>
						<p class="cost_txt_tit">프로그램을 몰라도 됩니다</p>
						<p>· 게임엔진, 모딩의 기본<br>· 기초부터 탄탄하게!<br>· 초보분들도 쉽게 이해할수 있도록 자세히 풀어 설명해드립니다.<br>· 누구든 수업이 끝난 후에도 혼자 응용하실 수 있는 수준까지 되실 수 있습니다.
						</p>
					</li>
				</div>
				<div class="col-md-3">
					<li>
						<h2>02</h2>
						<p class="cost_txt_tit">모딩 문서 무제한 열람</p>
						<p>· 여러가지 샘플과 예시, 모딩에 필요한 다양한 각도에서 응용할 수 있는 자료를 문서로 제공해줌으로써 언제든 필요할때마다 다시 방문해 찾아 볼 수 있습니다.
						</p>
					</li>
				</div>
				<div class="col-md-3">
					<li>
						<h2>03</h2>
						<p class="cost_txt_tit">지속적인 기술 업데이트</p>
						<p>· 저나, 모더들끼리 공유하는 새로운 정보와 기술이 모딩문서에 지속적으로 업데이트됩니다.
						</p>
					</li>
				</div>
				<div class="col-md-3">
					<li>
						<h2>04</h2>
						<p class="cost_txt_tit">정보교환 커뮤니티</p>
						<p>· 강의가 끝난 후 모더들과 정보, 기술공유를 통한 커뮤니티를 형성하고 있습니다.<br>· 여러분도 여기에 참여하실 수 있어요.
						</p>
					</li>
				</div>
			</div>
		</div>
	</div>

	<!-- 대표칼럼 -->
	<div class="banner_wrap width_940">
		<div class="tit_wrap">
			<h2>코드몽키 대표칼럼</h2>
			<a href="https://monkeycheat1.com/category/%ec%bd%94%eb%aa%bd%ec%8a%a4%ed%86%a0%eb%a6%ac/" target="_blank"><div class="btn_more">+more</div></a>
		</div>
		<?php
		echo latest('theme/swiper_card02', 'column', 2, 25);
		?>
	</div>

	<!-- 비용안내 -->
	<div class="banner_wrap index_cost">
		<div class="tit_wrap">
			<h2>코드몽키 모딩작업물</h2>
		</div>
		<div class="index_wrap_1200">
			<!-- 비용 위 -->
			<div class="box_con">
				<div class="col-md-6">
					<li>
						<!-- 유튜브링크 -->
						<iframe width="100%" height="315" src="https://www.youtube.com/embed/O1LiWw9jGtQ" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
					</li>
				</div>
				<div class="col-md-6">
					<li>
						<!-- 유튜브링크 크리100-->
						<iframe width="100%" height="315" src="https://www.youtube.com/embed/pqg2nZcI-KU" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
					</li>
				</div>
				<div class="col-md-6">
					<li>
						<!-- 유튜브링크 쿨딜-->
						<iframe width="100%" height="315" src="https://www.youtube.com/embed/VJlOAhyBpOk" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
					</li>
				</div>
				<div class="col-md-6">
					<li>
						<!-- 유튜브링크 스피드-->
						<iframe width="100%" height="315" src="https://www.youtube.com/embed/BtCHFXKFwN8" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
					</li>
				</div>
			</div>
			
		</div>
	</div>

</div>
<?php
include_once(G5_THEME_MOBILE_PATH.'/tail.php');
?>