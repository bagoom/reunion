<?php
include_once('./_common.php');
$g5['title'] = '총동문회 안내';
include_once(G5_PATH.'/head.php');
?>

<div class="cont location">
    <div class="box">
        <h3>북일고등학교 오시는 길</h3>
        <div class="txt01">북일고등학교 충천남도 천안시 동나묵 단대로 69 (신부동) </div>
        <div class="txt01"> Tel: 041.520-8600 Fax: 041.551.7116</div>

        <div id="map" style="width: 100; height: 500px; margin-top: 50px; background: #eee"></div>

        <div class="location-info">
            <div class="col col01">
                <div class="icon">
                    <i class="xi-car"></i>
                    <span>경부고속도로 이용시</span>
                </div>
                <div class="txt">
                    천안IC → 우회전(약50m이동) → 단국대방향 좌회전<br>
                    (약 300m이동) → 삼거리에서 좌회전 → 약 300m 직진<br>
                     우측에 위치함
                </div>
            </div>
            <div class="col col02">
                <div class="icon">
                    <i class="xi-subway"></i>
                    <span>전철 이용시</span>
            </div>
                <div class="txt">
                    두정역하차 → 출구 도로에서 좌측 육교  <br> → 북일고 야구장 후문(도보 5분)
                </div>
            </div>
        </div>
    </div>
</div>


<script type="text/javascript" src="//dapi.kakao.com/v2/maps/sdk.js?appkey=8dd5b1e2c2b45e51af84c8762e7560b1"></script>

<script>
    var mapContainer = document.getElementById('map'), // 지도를 표시할 div 
        mapOption = {
            center: new kakao.maps.LatLng(36.8318652, 127.1581744), // 지도의 중심좌표
            level: 3 // 지도의 확대 레벨
        };

    var map = new kakao.maps.Map(mapContainer, mapOption); // 지도를 생성합니다

    // 마커가 표시될 위치입니다 
    var markerPosition = new kakao.maps.LatLng(36.8318652, 127.1581744);

    // 마커를 생성합니다
    var marker = new kakao.maps.Marker({
        position: markerPosition
    });

    // 마커가 지도 위에 표시되도록 설정합니다
    marker.setMap(map);

    // 아래 코드는 지도 위의 마커를 제거하는 코드입니다
    // marker.setMap(null);  
</script>
<?php
include_once(G5_PATH.'/tail.php');
?>