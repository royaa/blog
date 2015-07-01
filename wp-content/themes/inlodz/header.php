<!DOCTYPE HTML>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<?php inlo_head(); ?>
<!--[if IE]>
<link rel="stylesheet" type="text/css" media="all" href="<?php bloginfo('template_directory'); ?>/style_ie.css" />
<![endif]-->
</head>
<body>
<div id="container">
<div id="header">
<img src="<?php echo inlo_options('banner') ?>" class="hd_bg" alt="bg" title="banner"></img>
<div class="inlo-header">
    <div class="header-nav">
		<?php wp_nav_menu( array( 'theme_location' => 'primary', 'container'=> false ,'menu_class' => 'nav-menu'));?>
		<ul class="mobile-nav nav-menu">
			<li><a href="<?php echo home_url(); ?>">主页</a></li>
			<li><span href="javascript:;" id="mobile_nav">聚合分类</span>
				<ul class="sub-menu" id="mobile_nav_list">
				<?php 
					$category = get_categories('hierarchical=false');
					if( !empty ( $category ) ){
						foreach($category as $cate){
							echo '<li><a href="'.get_category_link($cate).'">'.$cate->name.'</a></li>';
						}
					}
				?>
				</ul>
			</li>
			<li><span id="mobile_nav">聚合页面</span>
				<ul class="sub-menu" id="mobile_nav_list">
				<?php
					$mypages = get_pages();
					if( !empty ( $mypages ) ){
						foreach($mypages as $pages){
							echo '<li><a href="'.get_page_link($pages).'">'.$pages->post_title.'</a></li>';
					}
					}
				?>
				</ul>
			</li>
		</ul>
    </div>
</div>
<div class="site-name"><a href="<?php bloginfo('url') ?>" tilte="<?php bloginfo('name')?>"><?php bloginfo('name')?></a></div>
<?php if (is_home() || is_front_page()) { ?>
<h1 class="site-dec"><?php bloginfo('description'); ?></h1>
<?php } else if (is_single() || is_archives || is_page()) { ?>
<h1 class="breadcrumb site-dec"><?php echo get_breadcrumbs();?></h1>
<?php } ?>
</div>
<div id="notice"><i class="fa fa-bullhorn"></i><span class="notice_inner"><?php echo inlo_options('notice') ?></span></div>
<script type="text/javascript">
	var on_ajax = <?php $on_lazyload = inlo_options('on_lazyload'); echo empty( $on_lazyload ) || $on_lazyload == 'Y' ? "'Y'" : "'N'"; ?>;
</script>
<div id="content-wraper">