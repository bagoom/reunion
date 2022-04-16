<?php if (!defined("_INDEX_")) { ?>
    <?php 
        $current_link =  $_SERVER[REQUEST_URI];
        $current_link = basename($current_link);
    ?>
            <!-- 여기부터 시작 -->
            <script type="text/javascript"> 
            function display_submenu(num) { 
                document.getElementById("mysub"+num).style.display="block"; 
            } 
            </script> 
            
            <script> 
            $(document).ready(function() { 
                $("#myasidemenu a").on("click", function(e){ //링크 클릭시 
                    var $data_midtxt = $(this).attr("data-midtxt"); 
                    if( $data_midtxt ){ 
                        $.cookie('sub_midtxt', $data_midtxt, { path: '/' }); 
                    } else { 
                        $.cookie('sub_midtxt', null, { path: '/' }); 
                    } 
                }); 
            }); 
            </script> 
            
            <div id="myasidemenu">
            <?php 
                $sql_asidemenu = " select *  from ".$g5['menu_table']." ";
                $sql_asidemenu .= " where me_use = '1'  ";
                $sql_asidemenu .= " and length(me_code) = '2' ";
                $sql_asidemenu .= " order by me_order, me_id "; 
                $qry_asidemenu = sql_query($sql_asidemenu, false); 
                $gnb_zindex = 999; // gnb_1dli z-index 값 설정용 
                //echo $sql_asidemenu;
                for ($i=0; $row_asidemenu=sql_fetch_array($qry_asidemenu); $i++) { 
                    
                        $sql_asidemenu2 = " select * from ".$g5['menu_table']." ";
                        $sql_asidemenu2 .= " where  ";
                        $sql_asidemenu2 .= " length(me_code) = '4' ";
                        $sql_asidemenu2 .= " and substring(me_code, 1, 2) = '".$row_asidemenu['me_code']."' ";
                        $sql_asidemenu2 .= " order by me_order, me_id "; 
                        $qry_asidemenu2 = sql_query($sql_asidemenu2); 
                        //echo $sql_asidemenu;
                        
                    ?>
                    <ul id="mysub<?php echo $i ?>" style="display:none;">
                        <li class="leftmenu_b"> <a href="<?php echo $row_asidemenu['me_link']; ?>" target="_<?php echo $row_asidemenu['me_target']; ?>"><?php echo $row_asidemenu['me_name']; ?></a></li> 
                        
                        <?php 
                        
                        for ($k=0; $row_asidemenu2=sql_fetch_array($qry_asidemenu2); $k++) { 
                        
                            //좌측 서브메뉴 전체 리스트에서 현재 페이지에 해당하는 대메뉴 리스트만 보여줌 
                            if ( ($row_asidemenu['me_name']==$board['bo_subject'])||($row_asidemenu['me_name']==$g5['title'])||($row_asidemenu['me_name']==$hp_title_group) ) { 
                            //if(strpos($row_asidemenu['me_link'], $_GET['bo_table']) !== false) { 
                                echo ("<script language='javascript'> display_submenu(" .$i. " ); </script> "); 
                            } 
                            //echo "me_name=".$row_asidemenu['me_name']."<br>";
                            //echo "hp_title_group=".$hp_title_group."<br>";
                            //echo "title=".$g5['title']."<br><br>";
                            
                            if($k == 0) { 
                                echo "서브메뉴가 없습니다.";
                                echo '<ul>'.PHP_EOL; 
                            } 
                            ?> 
                            <li class="leftmenu_s<?php if (($row_asidemenu2['me_name']==$board['bo_subject'])||($row_asidemenu2['me_name']==$g5['title'])) { echo "_on"; } ?>"<?php 
                                if ($row_asidemenu2['me_link']) { 
                                    $me_link0 = explode("=",$row_asidemenu2['me_link']); 
                                    //if ( ($me_link0[1]==$board['bo_table'])||($me_link0[1]==$co_id) ) { 
                                    if(strpos($row_asidemenu2['me_link'], $_GET['bo_table']) !== false) { 
                                        echo " style='background-color:;'"; 
                                    } 
                                } else {    
                                    //if ( ($row_asidemenu2['me_name']==$board['bo_subject'])||($row_asidemenu2['me_name']==$g5['title']) ) { 
                                    if ( strpos($row_asidemenu2['me_link'], $_GET['bo_table']) !== false ) { 
                                        echo " style='background-color:;'"; 
                                    } 
                                }
                                ?>>
                                <a href="<?php echo $row_asidemenu2['me_link']; ?>" target="_<?php echo $row_asidemenu2['me_target']; ?>"><?php echo $row_asidemenu2['me_name']; ?>
                                <?php  
                                $newcount_num = new_count(basename($row_asidemenu2['me_link']));
                                ?>

                                <?php if($newcount_num > 0) {?>
                                     <span class="new_count"> <?=new_count(basename($row_asidemenu2['me_link']))?> </span>
                                <?php }?>
                                </a>

                            </li> 
                            <?php
                    
                            //좌측 서브메뉴 전체 리스트에서 현재 페이지에 해당하는 대메뉴 리스트만 보여줌 
                            if ($row_asidemenu2['me_link']) { 
                                $me_link0 = explode("=",$row_asidemenu2['me_link']); 
                                //if ( ($me_link0[1]==$board['bo_table'])||($me_link0[1]==$co_id) ) { 
                                if(strpos($row_asidemenu2['me_link'], $_GET['bo_table']) !== false) { 
                                    echo ("<script language='javascript'> display_submenu(" .$i. " ); </script> "); 
                                } 
                            } else {    
                                //if ( ($row_asidemenu2['me_name']==$board['bo_subject'])||($row_asidemenu2['me_name']==$g5['title']) ) { 
                                if(strpos($row_asidemenu2['me_link'], $_GET['bo_table']) !== false) { 
                                    echo ("<script language='javascript'> display_submenu(" .$i. " ); </script> "); 
                                } 
                            } 
                        } 
                        
                        if($k > 0) { 
                            echo '</ul>'.PHP_EOL; 
                        }
                        ?> 
                    </ul> 
                    <?php 
                }
                
                
                if ($g5['title'] == '전체검색 결과') { ?>
                
                    <ul id="mysub<?php echo $i ?>">
                        <li class="leftmenu_b"> <a href="<?php echo $row_asidemenu['me_link']; ?>" target="_<?php echo $row_asidemenu['me_target']; ?>">전체검색</a></li> 
                        
                        <ul>
                            <li class="leftmenu_s<?php if ($g5['title']=="전체검색 결과") { echo "_on"; } ?>" style='background-color:;'><a href="<?php echo G5_BBS_URL; ?>/search.php">전체검색</a> </li> 
                        </ul>
                    </ul> 
                <?php 
                }
                
                
                if ($g5['title'] == '회원가입약관' || $g5['title'] == '회원 가입' || $g5['title'] == '회원가입 완료' || $g5['title'] == '회원 정보 수정') { ?>
                
                    <ul id="mysub<?php echo $i ?>">
                        <li class="leftmenu_b"> <a href="<?php echo $row_asidemenu['me_link']; ?>" target="_<?php echo $row_asidemenu['me_target']; ?>">회원가입</a></li> 
                        
                        <ul>
                            <?php if($member['mb_id']) { ?>
                            <li class="leftmenu_s<?php if ($g5['title']=='회원 정보 수정' || $g5['title'] == '회원가입 완료') { echo "_on"; } ?>" style='background-color:;'><a href="<?php echo G5_BBS_URL; ?>/register.php">정보수정</a> </li> 
                            <li class="leftmenu_s" style='background-color:;'><a href="<?php echo G5_BBS_URL; ?>/logout.php">로그아웃</a> </li>
                            <li class="leftmenu_s" style='background-color:;'><a href="<?php echo G5_BBS_URL; ?>/member_confirm.php?url=<?php echo G5_BBS_URL; ?>/member_leave.php" onclick="return confirm('정말 회원에서 탈퇴 하시겠습니까?')">회원탈퇴</a> </li>
                            <?php } else { ?>
                            <li class="leftmenu_s<?php if ($g5['title']=='회원가입' || $g5['title'] == '회원 가입' || $g5['title'] == '회원가입 완료') { echo "_on"; } ?>" style='background-color:;'><a href="<?php echo G5_BBS_URL; ?>/register.php">회원가입</a> </li> 
                            <?php } ?>
                        </ul>
                    </ul> 
                <?php 
                }
                
                
                // 인트라넷
                if ($is_admin && ($bo_table=="보드1" || $bo_table=="보드2" || $bo_table=="보드3" || $bo_table=="보드4")) {
                ?>
                <ul id="mysub99">  
                    <li class="leftmenu_b"> <a href="<?php echo G5_BBS_URL; ?>/board.php?bo_table=보드1" target="_self">인트라넷</a></li>
                    <ul>
                        <li class="leftmenu_s<?php if ($bo_table=="보드1") echo "_on"; ?>"><a href="<?php echo G5_BBS_URL; ?>/board.php?bo_table=보드1" target="_self">보드1</a> </li> 
                        <li class="leftmenu_s<?php if ($bo_table=="보드2") echo "_on"; ?>"><a href="<?php echo G5_BBS_URL; ?>/board.php?bo_table=보드2" target="_self">보드2</a> </li> 
                        <li class="leftmenu_s<?php if ($bo_table=="보드3") echo "_on"; ?>"><a href="<?php echo G5_BBS_URL; ?>/board.php?bo_table=보드3" target="_self">보드3</a> </li> 
                        <li class="leftmenu_s<?php if ($bo_table=="보드4") echo "_on"; ?>"><a href="<?php echo G5_BBS_URL; ?>/board.php?bo_table=보드4" target="_self">보드3</a> </li> 
                    </ul>
                </ul>
                <?php
                }
                ?>
            </div>
            <!-- 여기까지 끝 -->
        <?php } ?>

        