<div class="clear"></div>
</div>
<div class="clear"></div>
<div id="totop_box">
  <?php if( is_single() || is_page()){?>
  <a id="home" href="<?php bloginfo('siteurl');?>" title="返回首页"></a>
  <?php } ?>
  <?php if( is_single() || is_page() && comments_open() ){ ?>
  <a id="comm" href="#comments" title="发表评论"></a>
  <?php } ?>
  <a id="totop" href="javascript:void(0)" title="返回顶部"></a>  
</div>
<div id="footer">
	<div class="container">
		<?php $bookmarks = get_bookmarks('hide_invisible=0');if($bookmarks && inlo_options('on_flinks') == 'Y'){ ?>
		<div class="footer_links">
			<span class="links_title">友情链接</span>
			<div class="jv_bookmarks">			
			<?php foreach( $bookmarks as $bs ){ if ( $bs->link_rel ==  'contact' || ( !is_home() && $bs->link_rel == 'acquaintance' )  ) { continue; } ?>
				<a class="tra<?php echo $bs->link_visible == 'N' ? ' bs-hide' : null; ?>" href="<?php echo $bs->link_url;?>" title="<?php echo $bs->link_description; ?>" target="<?php echo $bs->link_target == '' ? '_target' : $bs->link_target; ?>"> 	<i class="fa fa-paw"></i> <?php echo $bs->link_name; ?></a>
			<?php }?>
			<div class="clear"></div>
			</div>
		</div>
		<?php } ?>
		<div class="copyright">
			版权所有 &copy; <?php echo date('Y'); ?> <a href="<?php bloginfo('url'); ?>"><?php bloginfo('name'); ?></a> <?php echo inlo_options('footer_text'); ?>	
		</div>
		<div class="clear"></div>
	</div>
</div>
<?php wp_footer();?>
<script type="text/javascript" src="<?php bloginfo('template_directory'); ?>/js/inlodz.js"></script>
<div style="display:none"><?php echo inlo_options('footer_code'); ?></div>
</div>
</body>
</html>