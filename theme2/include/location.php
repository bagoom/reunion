<?php $base_filename = basename($_SERVER['PHP_SELF']); ?>
<div id="location">
 <!-- 현재 위치 표시 -->
        <a href="<?php echo G5_URL ?>"><i class="xi-home"></i> Home ></a>

        <?php if(strpos($base_filename,'login') !== false) { ?>
                <span> <?=$g5['title']?></span>
                <?php }else { ?>
                <span class="dep2-location"><a href=""></a></span>
                <span> > <?=$g5['title']?></span>
        <?php }?>
</div>