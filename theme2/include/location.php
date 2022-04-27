<div id="location">
 <!-- 현재 위치 표시 -->
        <a href="<?php echo G5_URL ?>"><i class="xi-home"></i> Home</a>
        <?php
            if($bo_table) 
            {  //게시판에 들어 갔을 경우
            if($group[gr_subject]!='') { 
                echo " > <a href='$g5[path]/group/$group[gr_id]'>$group[gr_subject]</a>"; } // 그룹 이름 출력
            if($board[bo_subject]!='') { // 게시판 이름 출력
            echo " > <a href='$g5[path]/$board[bo_table]'>$board[bo_subject]</a>";}
            if ($sca) {
            echo " > $sca";     } // 카테고리 이름 출력
                } else { 
            echo " > $g5[title]"; } //일반페이지에 접속했을 경우
            //echo " > ";
            //echo cut_str($write[wr_subject], 25);  // 게시물 제목 출력, 현재는 미표시, #제거하면 표시
        ?> 

</div>