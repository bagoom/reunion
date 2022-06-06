<?php
include_once('./_common.php');
$g5['title'] = '총동문회 안내';
include_once(G5_PATH.'/head.php');
?>

<div class="cont location">
    <div class="box">
        <div class="txt01">북일고등학교 충천남도 천안시 동나묵 단대로 69 (신부동) </div>
        <div class="txt01"> Tel: 041.520-8600 Fax: 041.551.7116</div>

        <div id="map" style="width: 100; height: 500px; margin-top: 50px; background: #eee"></div>
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