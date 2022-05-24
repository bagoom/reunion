<script type="text/javascript">
    function display_submenu(num) { 
         $("#mysub" + num).addClass("onSideMenu");
    }
</script>
<?php
    $branch_type = array();
    $branch_type_sql = "SELECT * FROM `branch_type` WHERE reunion_id = $reunionID";
    $branch_type_result = sql_query($branch_type_sql);
    for ($i=0; $branch_type_row=sql_fetch_array($branch_type_result); $i++) {
        array_push($branch_type, $branch_type_row);
    }
    ?>

<div id="mysubmenu">
    <?php
    $sql = " select *
                from {$g5['menu_table']}
                where me_use = '1'
                  and length(me_code) = '2'
                order by me_order, me_id ";
    $result = sql_query($sql, false);
    $gnb_zindex = 999; // gnb_1dli z-index 값 설정용

    for ($i=0; $row=sql_fetch_array($result); $i++) {
    ?>
    <ul id="mysub<?php echo $i ?>" style="display:none;">
        <a href="<?=G5_URL?><?php echo $row['me_link']; ?>" target="_<?php echo $row['me_target']; ?>" ><li class="leftmenu_b"><?php echo $row['me_name'] ?></li></a>
            <?php
            $sql2 = " select *
                        from {$g5['menu_table']}
                        where me_use = '1'
                          and length(me_code) = '4'
                          and substring(me_code, 1, 2) = '{$row['me_code']}'
                        order by me_order, me_id ";
            $result2 = sql_query($sql2);
            
            $base_filename = basename($_SERVER['PHP_SELF']);

            //좌측 서브메뉴 전체 리스트에서 현재 페이지에 해당하는 대메뉴 리스트만 보여줌
            if ( ($row['me_name']==$board['bo_subject'])||($row['me_name']==$g5['title'])) {
                echo ("<script language='javascript'> display_submenu(" .$i. " ); </script> ");
            }
            if (  strpos($base_filename,'memo_form') !== false || strpos($base_filename,'memo_view')   !== false || strpos($base_filename,'member_confirm')   !== false || (strpos($base_filename,'register_form')   !== false && $w == 'u') ) {
                echo ("<script language='javascript'> display_submenu(5); </script> ");
            }
    
            for ($k=0; $row2=sql_fetch_array($result2); $k++) {
                if($k == 0)
                    echo '<ul>'.PHP_EOL;
            ?>
                    <a href="<?=G5_URL?><?php echo $row2['me_link']; ?>" target="_<?php echo $row2['me_target']; ?>" >
                    <li class="leftmenu_s <?=($g5['title'] == $row2['me_name']) ? "on" : null?>  <?=(strpos($base_filename,'memo_form') !== false && $row2['me_code'] == 6020) ? "on": null ?>  <?=(strpos($base_filename,'memo_view') !== false && $row2['me_code'] == 6020) ? "on": null ?>  <?=(strpos($base_filename,'member_confirm') !== false && $row2['me_code'] == 6030) ? "on": null ?>  <?=(strpos($base_filename,'register_form') !== false && $row2['me_code'] == 6030 && $w == 'u') ? "on": null ?>  <?=($board['bo_subject'] == $row2['me_name']) ? "on" : null?>"><?php echo $row2['me_name'] ?></li>
            </a>
            <?php  

                //좌측 서브메뉴 전체 리스트에서 현재 페이지에 해당하는 대메뉴 리스트만 보여줌
                if ( ($row2['me_name']==$board['bo_subject'])||($row2['me_name']==$g5['title']) ) {
                    echo ("<script language='javascript'> display_submenu(" .$i. " ); </script> ");
                }

                if($row2['me_code'] == 1040) {
                    $repeat = 0;
                    if($repeat == 0) {
                    $branch_type_sql = "SELECT * FROM `branch_type` WHERE reunion_id = $reunionID";
                    $branch_type_result = sql_query($branch_type_sql);
                    for ($j=0; $branch_type_row=sql_fetch_array($branch_type_result); $j++) { ?>
                        <ul class="mysub-300">
                            <li class="<?=($type==$branch_type_row['bt_name'] ) ? "on" : null?>"><a href="<?=G5_URL?>/page/branch/?type=<?=$branch_type_row['bt_name']?>"><?=$branch_type_row['bt_name']?></a></li>
                        </ul>
                    <?php } $repeat = 1; ?>
                <?php } } 
            }
            if($k > 0)
                echo '</ul>'.PHP_EOL;
            ?>
    </ul>
    <?php } ?>

    <?php if (defined("_REGISTER_") && !$w) { ?>
            <ul id="mysub<?php echo $i+1 ?>" style="display:none;">
                <a href="<?php echo G5_BBS_URL ?>/register.php" target="_self"><li class="leftmenu_b"><?=$reunion['reunion_title']?></li></a>
                <ul>
                    <a href="<?php echo G5_BBS_URL ?>/register.php" target="_self"><li class="leftmenu_s on">회원가입</li></a>
                </ul>
                <?php echo ("<script language='javascript'> display_submenu(" .($i+1). " ); </script> ");?>
            </ul>
        <?php } ?>
</div>
