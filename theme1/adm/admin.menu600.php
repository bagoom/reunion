<?php
if( $is_admin == 'supervisor' && $is_admin !== 'superadmin') {
$menu['menu500'] = array (
    array('500000', '사이트관리', ''.G5_ADMIN_URL.'/affiliation.php', 'board'),
    array('500100', '계열', ''.G5_ADMIN_URL.'/affiliation.php', 'board'),
    array('500200', '학과', ''.G5_ADMIN_URL.'/department.php', 'board'),
    array('500300', '회비구분', ''.G5_ADMIN_URL.'/fee_division.php', 'board'),
    array('500400', '임원명', ''.G5_ADMIN_URL.'/executive.php', 'board'),
    array('500500', '관리자설정', ''.G5_ADMIN_URL.'/manager.php', 'board'),
);
}