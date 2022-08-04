<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

// add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
add_stylesheet('<link rel="stylesheet" href="'.$member_skin_url.'/style.css">', 0);
?>

<!-- 회원가입약관 동의 시작 { -->
<div class="register">

    <form  name="fregister" id="fregister" action="<?php echo $register_action_url ?>" onsubmit="return fregister_submit(this);" method="POST" autocomplete="off">

    <p><i class="fa fa-check-circle" aria-hidden="true"></i> 회원가입약관 및 개인정보처리방침안내의 내용에 동의하셔야<br class="m-show"> 회원가입 하실 수 있습니다.</p>
    
    <?php
    // 소셜로그인 사용시 소셜로그인 버튼
    @include_once(get_social_skin_path().'/social_register.skin.php');
    ?>
    <section id="fregister_term">
        <h2>회원가입약관</h2>
        <div class="txt">
            <h3>제 1 장 총칙</h3>
            제1조 (목적)
            이 약관은 우리 총동문회(이하 “총동문회”) 홈페이지에서 제공하는 모든 서비스(이하 "서비스")를 이용함에 있어 이용자의 권리, 의무 및 책임사항을 규정하고 이용조건 및 절차, 기타 필요한
            사항을 규정함을 목적으로 합니다.

            제2조 (약관의 효력 및 변경)
            이 약관은 서비스를 이용하고자 하는 모든 이용자가 서비스에 가입함으로써 효력이 발생합니다. 또한, 총동문회는 이 약관을 변경할 수 있으며, 변경된 약관은 이용자에게 공시하여야 효력이 발생됩니다.

            제3조 (약관 외 준칙)
            이 약관에 명시되지 않은 사항은 관계법령(전기통신법, 전기통신사업법)의 규정에 의합니다.

            
            <h3>제 2 장 서비스 이용 계약</h3>
            제4조 (이용계약의 성립 및 이용신청 승낙)
            1. 이용약관에 "동의" 버튼을 누르면 동의하는 것으로 간주됩니다.
            2. 이용계약은 이용자의 이용신청에 대하여 총동문회가 승낙하여야 성립합니다.
            3. 총동문회는 회원이 상기 각 항목을 성실히 기재하고 본 약관에 동의할 때 본 서비스의 이용을 승낙합니다.
            4. 총동문회는 기술에 의한 서비스를 처리하지 못하여 에러가 발생하거나 이용에 장애가 되는 경우, 기타 총동문회가 필요하다고 인정한 경우에 승낙을 유보할 수 있습니다.
            5. 총동문회는 개인정보를 허위로 기재하거나 타인의 명의를 도용, 회원으로서 부적절한 행위를 할 우려가 있다고 인정되는 경우에는 승낙을 철회하거나 거절할 수 있습니다

            제5조 (이용신청 시 기재사항)
            1. 서비스를 이용하고자 할 경우 총동문회의 가입신청 양식에 다음의 개인 신상정보를 필수적으로 작성하여 신청하셔야 합니다.
            ① 아이디
            ② 비밀번호
            ③ 이름
            ④ 모교정보(학과, 학번, 입학년도/졸업년도 등)
            ⑤ 휴대전화
            ⑥ 이메일
            ⑦ 자택주소
            ⑧ 직장주소
            ⑨ 직장명 / 직위
            ⑩ 동문 마케팅 수신 여부(회보, SMS, 이메일, 기타 총동문회 홍보물 등)
            2. 가입신청 시 기재하는 모든 정보는 사실로 간주됩니다. 혹시 정보가 허위로 판명되면 본 서비스의 사용을 중지할 수 있으며, 이로 인해 발생하는 모든 불이익에 대해 책임지지 않습니다.

            제6조 (개인정보의 변경)
            회원은 신청 시 기재한 개인정보가 변경되었을 때에는 수정을 하여야 하며, 수정을 하지 아니하여 발생하는 문제의 책임은 회원 본인에게 있습니다.


            <h3>제 3 장 서비스 이용</h3>
            제7조 (총동문회 의무)
            1. 총동문회 개인정보 관리 : 총동문회는 서비스를 제공하면서 알게 된 회원의 신상정보를 본인의 승낙 없이 외부로 유출하거나 제3자에게 배포, 제공하지 않습니다. 단, 적법한 절차를 거친
            국가기관의 요구나 수사상 또는 기타 공익을 위하여 필요하다고 인정되는 경우는 예외로 합니다.
            2. 총동문회 회원의 본 서비스 이용을 위하여 노력할 의무가 있으며 회원의 정보 역시 회원에 대한 서비스 향상을 위해 이용합니다.

            제8조 (회원의 비밀번호 등 관리의무)
            1. 회원의 관리 잘못으로 인한 ID와 비밀번호 노출로 인한 피해는 회원의 책임입니다.
            2. 회원의 이용권한은 회원 개인에 한정된 것이며 제 3자에 양도하거나 대여 시에는 총동문회에서 임의로 회원의 ID를 삭제하며, 그에 대한 책임은 전적으로 회원이 집니다.

            제9조 (게시물의 저작권)
            게시된, 또는 보관된 자료에 대한 각 회원의 권리와 책임은 각 회원 개인에게 있으며 총동문회는 그 정보관리에 성실히 노력합니다.

            제10조 (공개게시물의 삭제)
            이용자의 공개게시물의 내용이 다음 각 호에 해당하는 경우에 총동문회는 이용자에게 사전 통지 없이 해당 공개게시물을 삭제할 수 있고, 해당 이용자의 회원 자격을 제한, 정지 또는 상실시킬 수
            있습니다.
            1. 다른 이용자 또는 제3자를 비방하거나 명예를 손상시키는 내용
            2. 미풍양속을 저해하는 내용의 정보, 문장, 도형 등을 유포하는 내용
            3. 범죄행위와 관련이 있다고 판단되는 내용
            4. 다른 이용자 또는 제3자의 저작권 등 기타 권리를 침해하는 내용
            5. 기타 관계 법령에 위배된다고 판단되는 내용


            <h3>제 4 장 계약 해지 등</h3>
            제11조 (계약해지 및 이용제한)
            총동문회는 회원이 다음 각호의 사항에 해당되는 행위를 하였을 경우 사전 통지 없이 이용계약을 해지할 수 있습니다.
            1. 미풍양속이나 건전한 사회질서에 어긋나는 활동을 하는 경우
            2. 불법적인 게시물을 올리는 경우
            3. 자신의 정보 등에 대하여 허위정보를 입력한 경우
            4. 타인의 정보를 이용하여 회원이 된 자 (단 도용 당한 자의 경우 총동문회의 판단에 의하여 회원가입이 가능합니다.)
            5. 여러 불법적인 수단으로 본 사이트의 운영을 방해하는 경우
            6. 사이트 활동 중 얻게 된 정보를 상업적으로 이용하거나 무단으로 외부에 공표, 제 3자에 본인의 허락 없이 알리는 경우
            7. 기타 타 회원이나 총동문회에 피해가 되는 경우


            <h3>제 5 장 손해배상 및 면책</h3>
            제12조 (손해배상)
            총동문회는 약관의 규정을 위반하여 제3자에게 손해가 발생하는 경우 고의가 없는 한 총동문에서 책임 지지 않습니다.

            제13조 (면책)
            (1) 총동문회는 시스템의 작동불능 기타 총동문회의 귀책사유 없이 서비스를 제공할 수 없는 경우 그로 인한 책임을 면합니다.
            (2) 총동문회는 회원이 서비스에 게시한 정보, 자료, 사실의 정확성, 신뢰성 등 그 내용에 관하여는 책임을 부담하지 않습니다.
            (3) 회원은 본인의 책임 아래 서비스를 이용하며, 서비스에 제공된 자료에 대한 취사선택 또는 이용으로 손해가 발생하거나 어떠한 불이익이 발생하더라도 총동문회는 책임을 지지 않습니다.
            (4) 총동문회는 회원상호간 또는 회원과 제3자 상호간의 서비스를 매개로 하여 물품거래 등과 관련하여 어떠한 책임도 부담하지 아니하며, 그들 사이에 발생한 분쟁에 관여할 의무가 없으며, 이로
            인한 어떠한 손해도 배상할 책임하지 않습니다.

            제14조 분쟁의 해결
            (1) 총동문회와 회원은 서비스와 관련하여 발생한 분쟁을 원만하게 해결하기 위하여 필요한 모든 노력을 하여야 합니다.
            (2) 제1항의 규정에도 불구하고 총동문회와 회원 간 소송이 제기될 경우, 소송은 총동문회의 사무국 소재지를 관할하는 법원을 관할 법원으로 합니다

            (부칙) 이 규정은 2022년 7월 1일부터 시행합니다.
        </div>
        <fieldset class="fregister_agree">
            <input type="checkbox" name="agree" value="1" id="agree11" class="selec_chk">
            <label for="agree11"><span></span><b class="sound_only">회원가입약관의 내용에 동의합니다.</b></label>
        </fieldset>
    </section>

    <section id="fregister_private">
        <h2>개인정보처리방침안내</h2>
        <div class="txt">
            우리 총동문회(이하 ‘총동문회’)는 개인정보보호법 등 관련 법령에 근거하거나 정보주체의 동의에 의하여 모든 개인정보를 수집·보유·처리하고 있습니다. 총동문회는 개인정보보호법에 따라 정보주체의
            개인정보 및 권익을 보호하고, 개인정보와 관련된 고충을 처리할 수 있도록 아래와 같은 처리방침을 두고 있으며 개정하는 경우 홈페이지를 통해 공지할 예정입니다. 이 방침은 별도의 설명이 없는 한
            총동문회의 모든 홈페이지에 적용됨을 알려드립니다.

            
            <h3>제 1 조 (개인정보의 처리 목적) </h3>
            총동문회는 개인정보를 다음의 목적을 위해 처리합니다. 처리한 개인정보는 다음의 목적 이외의 용도로는 사용되지 않으며 이용 목적이 변경될 시에는 사전 동의를 구할 예정입니다.

            1. 서비스 제공
            총동문회의 소개 및 공지사항, 본인인증 정보 등의 서비스 제공에 관련한 목적으로 개인정보 처리
            2. 홈페이지 회원가입 및 관리
            총동문회에서 제공하는 회원제 서비스 이용에 따른 본인 확인, 개인 식별, 불량회원의 부정이용 방지와 비인가 사용방지, 연령확인, 만14세 미만 아동 개인정보 수집 시 법정대리인 동의 여부 확인,
            분쟁조정을 위한 기록보존, 불만처리 등 민원처리, 공지사항 전달 등의 목적으로 개인정보를 처리합니다.


            <h3>제 2 조 (개인정보 수집항목, 수집방법, 보유기간) </h3>
            1. 최초 회원 가입 또는 서비스 이용 시 이용자로부터 아래와 같은 개인정보를 수집하고 있으며, 회원의 사생활을 현저히 침해할 우려가 민감정보(사상·신념, 정치적 견해, 건강 등에 관한 정보
            등)는 수집하지 않습니다.
            ① 필수 정보 : 이름, 휴대전화, 이메일, 모교정보 (입학/졸업년도 등)
            ② 선택 정보 : 자택주소, 직장정보, 생년월일 등
            2. 총동문회는 수집한 개인정보를 회원관리 및 로그인/동문회원 인증을 한 분들에게 제공되는 각종 콘텐츠 및 부가기능, 회보 발송 등의 서비스를 제공하기 위하여 이용하며, 회원 탈퇴시까지
            개인정보를 처리/보유합니다.
            ① 보유목적 : 웹사이트 및 스마트폰 어플리케이션 서비스 이용, 회보 발송 등
            ② 보유기간 : 회원탈퇴시까지


            <h3>제 3 조 (개인정보의 제3자 제공) </h3>
            총동문회는 원칙적으로 정보주체의 개인정보를 수집·이용 목적으로 명시한 범위 내에서 처리하며, 다음의 경우를 제외하고는 정보주체의 사전 동의 없이는 본래의 목적 범위를 초과하여 처리하거나
            제3자에게 제공하지 않습니다.
            1. 동문회원들이 사전에 동의한 경우
            2. 법령의 규정에 의거하거나, 수사 목적으로 법령에 정해진 절차와 방법에 따라 수사기관의 요구가 있는 경우
            3. 통계작성, 학술연구나 시장조사를 위해 특정 개인을 식별할 수 없는 형태로 가공하여 제공하는 경우


            <h3>제 4 조 (개인정보처리 위탁) </h3>
            총동문회는 위탁계약 체결 시 「개인정보 보호법」 제26조에 따라 위탁업무 수행목적 외 개인정보 처리금지, 기술적·관리적 보호조치, 재위탁 제한, 수탁자에 대한 관리·감독, 손해배상 등 책임에
            관한 사항을 계약서 등 문서에 명시하고, 수탁자가 개인정보를 안전하게 처리하는지 관리 현황을 정기적으로 점검하며 감독하고 있습니다.


            <h3>제 5 조 (정보주체와 법정대리인의 권리, 의무 및 그 행사방법) </h3>
            1. 정보 주체와 법정대리인은 총동문회에 대해 언제든지 다음 각호의 개인정보 보호 관련 권리를 행사할 수 있습니다.
            ① 본인 개인정보 열람, 정정 및 삭제의 요구
            ② 개인정보의 오류에 대한 정정 및 삭제의 요구
            ③ 개인정보의 처리정지 요구
            2. 개인정보의 열람, 정정, 삭제 등의 요청은 회원가입의 (개인정보변경)에서 직접 처리하실 수 있습니다. 직접 처리가 어려운 사항은 총동문회 사무국으로 연락주시기 바랍니다.
            3. 정보주체가 개인정보의 오류 등에 대한 정정 또는 삭제를 요구한 경우에는 총동문회는 정정 또는 삭제를 완료할 때까지 당해 개인정보를 이용하거나 제공하지 않습니다. 이 경우, 잘못된 개인정보를
            이용 또는 제공하는 경우 지체없이 수정하겠습니다.


            <h3>제 6 조 (개인정보의 파기) </h3>
            총동문회는 개인정보 처리목적이 달성된 경우에는 지체 없이 해당 개인정보를 파기합니다. 다만, 다른 법령에 따라 보존하여야 하는 경우에는 그러하지 않을 수 있으며, 개인정보를 보존하여야 하는 경우
            그 보존근거와 보존하는 개인정보(또는 개인정보파일) 항목을 별도의 데이터베이스(DB)로 옮기거나 보관 장소를 달리하여 보존합니다. 파기의 절차, 기한 및 방법은 다음과 같습니다.
            1. 파기절차
            개인정보는 목적 달성 후 즉시 또는 별도의 공간에 옮겨져 내부 방침 및 기타 관련법령에 따라 일정기간 저장된 후 파기됩니다. 별도의 공간으로 옮겨진 개인정보는 법률에 의한 경우가 아니고서는 다른
            목적으로 이용되지 않습니다.
            2. 파기기한 및 파기방법
            보유기간이 만료되었거나 개인정보의 처리목적이 달성되었을 때에는 지체 없이 파기합니다. 파일형태의 정보는 기록을 재생할 수 없는 기술적 방법을 사용하며 출력문서는 분쇄기로 분쇄하여 파기합니다.


            <h3>제 7 조 (개인정보의 안전성 확보 조치) </h3>
            총동문회는 회원의 사전허가 없이는 개인정보를 공개하지 않습니다.
            단, 기술적인 보완조치를 했음에도 불구하고, 해킹 등 기본적인 네트워크 상의 위험성에 의해 발생하는 예기치 못한 사고로 인한 정보의 훼손에 의한 각종 분쟁에 관해서는 책임이 없습니다.
            또한 회원의 부주의로 인하여 발생한 개인정보 유출에 관해서는 총동문회에서 책임지지 않습니다.

            1. 개인정보의 안전한 처리를 위하여 내부관리계획을 수립하고 시행하고 있습니다.
            2. 개인정보 취급 담당자의 최소화하여 개인정보를 관리하는 대책을 시행하고 있으며, 개인정보취급자를 대상으로 안전한 관리를 위한 교육을 실시하고 있습니다.
            3. 개인정보를 처리하는 데이터베이스시스템에 대한 접근권한의 부여, 변경, 말소를 통하여 개인정보에 대한 접근통제를 위하여 필요한 조치를 하고 있으며 침입차단시스템을 이용하여 외부로부터의 무단
            접근을 통제하고 있습니다.
            4. 개인정보에 대한 통신망, 개인정보처리시스템을 통한 불법적인 접근 및 침해사고 방지를 위하여 필요한 조치를 취하고 있습니다.
            5. 개인정보처리시스템에 접속한 기록을 최소 1년 이상 보관, 관리하고 있으며, 접속 기록이 위변조 및 도난, 분실되지 않도록 보안기능을 사용하고 있습니다.
            6. 정보주체의 고유식별정보와 비밀번호는 암호화 되어 저장 및 관리되고 있습니다. 또한 중요 한 데이터는 저장 및 전송 시 암호화하여 사용하는 등의 별도 보안기능을 사용합니다.
            7. 해킹이나 컴퓨터 바이러스 등에 의한 개인정보 유출 및 훼손을 막기 위하여 보안프로그램을 설치하고 주기적인 갱신/점검을 하며 외부로부터 접근이 통제된 구역에 시스템을 설치하고
            기술적/물리적으로 감시 및 차단하고 있습니다.
            8. 개인정보를 보관하고 있는 물리적 보관 장소를 별도로 두고 출입을 통제하고 있습니다.
            9. 개인정보 유출 등 개인정보 침해사고 방지를 위하여 관리용 단말기에 안전조치를 취하고 있습니다.
            10. 화재, 홍수, 단전 등의 재해・재난 발생 시를 대비하여 백업 및 복구를 위한 조치를 취하고 있습니다.
            11. 개인정보보호를 위한 수단과 유출 시 정보주체의 권리를 침해할 위협의 정도를 위험도 분석 절차를 통해 분석하고 있습니다.


            <h3>제 8 조 (개인정보보호 책임) </h3>
            총동문회는 개인정보를 보호하고 개인정보와 관련된 민원을 처리하고 있습니다.

            구분
            개인정보보호 책임자 : 정종헌 총동문회장
            개인정보보호 담당자 : 전희근 어플운영팀장


            - 근무시간 : 평일 9:00~17:30 (토,일요일, 공휴일은 휴무 / 점심시간 12:00~13:00)
            - 전화문의 : 010-5422-8248 (전희근 어플운영팀장)
            - 팩스번호 : 0504-060-8248
            - 등기우편 : 총동문회 개인정보 관리 담당자 앞


            <h3>제 9 조 (개인정보 자동 수집 장치의 설치·운영 및 거부에 관한 사항) </h3>
            1. 총동문회의 홈페이지는 회원에게 개인형 서비스를 제공하기 위해 이용정보를 저장하고 수시로 불러오는 '쿠키(cookie)'를 사용하며 해당 정보를 목적 외로 이용하거나 제3자에게 제공하지
            않습니다.
            2. 쿠키는 웹사이트를 운영하는데 이용되는 서버가 이용자의 컴퓨터 브라우저에게 보내는 소량의 정보이며 이용자들의 컴퓨터 하드디스크에 저장되기도 합니다.
            ① 쿠키의 사용 목적 : 팝업 활성화 여부 확인
            ② 쿠키의 설치·운영 및 거부 : 브라우저 상단의 인터넷 옵션(또는 설정) > 개인정보 메뉴의 쿠키 차단 설정을 통해 쿠키 저장을 거부할 수 있습니다.
            ③ 그 외 인터넷 서비스 이용과정에서 아래 개인정보 항목이 자동으로 생성되어 수집될 수 있습니다.
            - 서비스 이용기록, 방문기록, 불량 이용기록
            3. 쿠키 저장을 거부할 경우 팝업 차단에 어려움이 발생할 수 있습니다.


            <h3>제 10 조 (개인정보파일의 열람 및 정정 청구)</h3>
            총동문회가 보유하고 있는 개인정보파일은 「공공기관의 개인정보보호에 관한 법률」(다른 법률에 규정이 있는 경우는 해당 법률)의 규정이 정하는 바에 따라 열람을 청구할 수 있습니다.

            열람청구 절차(「공공기관의 개인정보보호에 관한 법률」의 경우)
            다음사항은 법 제13조 규정에 의하여 열람을 제한할 수 있습니다.

            1. 다음 사항에 해당하는 업무로서 당해 업무의 수행에 중대한 지장을 초래하는 경우 · 조세의 부과·징수 또는 환급에 관한 사항
            2. 학력·기능 및 채용에 관한 시험, 자격의 검사, 보상금·급부금의 산정 등 평가 또는 판단에 관한 업무
            3. 다른 법률에 의한 감사 및 조사에 관한 업무
            4. 토지 및 주택 등에 관한 부동산 투기를 방지하기 위한 업무 등
            5. 개인의 생명·신체를 해할 우려가 있거나 개인의 재산과 기타 이익을 부당하게 침해할 우려가 있는 경우

            본인의 개인정보를 열람한 정보주체는 다음의 경우 정정을 청구할 수 있습니다.
            1. 정정 청구의 범위 · 사실과 다르게 기록된 정보의 정정
            2. 특정항목에 해당사실이 없는 내용에 대한 삭제
            3. 정정 청구의 절차(「공공기관의 개인정보보호에 관한 법률」의 경우)


            <h3>제 11 조 (권익침해 구제방법)</h3>
            개인정보주체는 개인정보침해로 인한 구제를 받기 위하여 개인정보분쟁조정위원회, 한국인터넷진흥원 개인정보침해신고센터 등에 분쟁해결이나 상담 등을 신청할 수 있습니다. 이 밖에 기타 개인정보침해의
            신고 및 상담에 대하여는 아래의 기관에 문의하시기를 바랍니다.
            1. 개인정보분쟁조정위원회 : (국번없이) 1833-6972
            2. 개인정보침해신고센터 : (국번없이) 118
            3. 대검찰청 사이버수사과 : (국번없이) 1301
            4. 경찰청 사이버안전지킴이 : (국번없이) 182


            <h3>제 12 조 (개인정보 처리방침 변경)</h3>
            이 개인정보처리방침은 시행일로부터 적용되며, 법령 및 방침에 따른 변경내용의 추가, 삭제 및 정정이 있는 경우에는 변경사항의 시행 7일 전부터 공지사항을 통하여 고지할 것 입니다.

        </div>

        <fieldset class="fregister_agree">
            <input type="checkbox" name="agree2" value="1" id="agree21" class="selec_chk">
            <label for="agree21"><span></span><b class="sound_only">개인정보처리방침안내의 내용에 동의합니다.</b></label>
       </fieldset>
    </section>
	
	<div id="fregister_chkall" class="chk_all fregister_agree">
        <input type="checkbox" name="chk_all" id="chk_all" class="selec_chk">
        <label for="chk_all"><span></span>회원가입 약관에 모두 동의합니다</label>
    </div>
	    
    <div class="btn_confirm">
    	<a href="<?php echo G5_URL ?>" class="btn_close">취소</a>
        <button type="submit" class="btn_submit">회원가입</button>
    </div>

    </form>

    <script>
    function fregister_submit(f)
    {
        if (!f.agree.checked) {
            alert("회원가입약관의 내용에 동의하셔야 회원가입 하실 수 있습니다.");
            f.agree.focus();
            return false;
        }

        if (!f.agree2.checked) {
            alert("개인정보처리방침안내의 내용에 동의하셔야 회원가입 하실 수 있습니다.");
            f.agree2.focus();
            return false;
        }

        return true;
    }
    
    jQuery(function($){
        // 모두선택
        $("input[name=chk_all]").click(function() {
            if ($(this).prop('checked')) {
                $("input[name^=agree]").prop('checked', true);
            } else {
                $("input[name^=agree]").prop("checked", false);
            }
        });
    });

    </script>
</div>
<!-- } 회원가입 약관 동의 끝 -->
