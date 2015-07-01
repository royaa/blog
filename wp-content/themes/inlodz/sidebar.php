<div id="sidebar">
	<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('全站侧栏') ) :?><?php endif;?>	
    <?php if( is_active_sidebar('inlo_widget_follow') ) { ?>
    <div id="scroll_box">
        <div class="widget-box-scroll">
            <?php dynamic_sidebar('inlo_widget_follow'); ?>
        </div>
    </div>
    <?php }?>
</div>
<div class="clear"></div>