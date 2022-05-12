<?php
if( $is_admin == 'supervisor' && $is_admin !== 'superadmin') {
$menu['menu500'] = array (
    array('500000', '설정관리', ''.G5_ADMIN_URL.'/affiliation.php', 'board'),
    array('500100', '계열 설정', ''.G5_ADMIN_URL.'/affiliation.php', 'board'),
    array('500200', '학과 설정', ''.G5_ADMIN_URL.'/department.php', 'board'),
    array('500300', '회비 설정', ''.G5_ADMIN_URL.'/fee_division.php', 'board'),
    array('500400', '지회 설정', ''.G5_ADMIN_URL.'/branch_type.php', 'board'),
    array('500500', '임원명 설정', ''.G5_ADMIN_URL.'/executive.php', 'board'),
    array('500600', '관리자 설정', ''.G5_ADMIN_URL.'/manager.php', 'board'),
);
}