<?php
if(  $is_admin != 'superadmin') {
$menu["menu990"] = array (
    array('990000', '통계현황', G5_ADMIN_URL.'/status/m3stats.php', 'ETC'),
	//array('990050', '사이드 메뉴', G5_ADMIN_URL.'/menu/menu_list.php', 'menu_side'),
    array('990100', '활성도 통계', G5_ADMIN_URL.'/status/m3stats.php', 'm3stats'),
    //array('990200', '팝업새창', G5_ADMIN_URL.'/popup/popup_list.php', 'popup_blank'),
    //array('990250', '팝업레이어', G5_ADMIN_URL.'/popup/newwinlist.php', 'popup_layer'),
	//array('990300', '메인배너', G5_ADMIN_URL.'/banner/main_banner_list.php', 'main_banner'),
	//array('990305', '메인배너2', G5_ADMIN_URL.'/banner/main_banner2_list.php', 'main_banner2'),
	//array('990310', '사이드배너', G5_ADMIN_URL.'/banner/aside_banner_list.php', 'side_banner'),
	//array('990320', '사이드배너2', G5_ADMIN_URL.'/banner/aside_banner2_list.php', 'side_banner2'),
    //array('990400', '출석부 환경설정', G5_ADMIN_URL.'/attendance/attendance_setup.php', 'attendance_setup'),
    //array("990500", "날짜조회수관리", ''.G5_ADMIN_URL.'/board_admin/board_manage_etc_list.php', 'board_manage'),
	//array('990520', '이미지 주소 변경', G5_ADMIN_URL.'/img_rename/img_rename.php', 'img_rename'),
	//array('990530', '아이피 변경', G5_ADMIN_URL.'/ip_rename/ip_rename.php', 'ip_rename'),
	//array('990600', '게시글관리', G5_ADMIN_URL.'/bbs/', 'adm_board'),
	//array('990650', '쪽지관리', G5_ADMIN_URL.'/memo/memo_list.php', 'memo_list'),
);
}
?>