<?php get_header(); ?>
<div id="main">
	<div class="wrap">
		<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
			<div class="post">
				<h1 class="post-title"><span><?php the_title() ?></span></h1>
				<div class="main_post">
				<div class="p_info">
					<span class="info_author info_ico"><?php the_author();?></span> 
					<span class="info_category info_ico"><?php the_category(', ')?></span> 
					<span class="info_date info_ico"><?php the_time('m-d')?></span>
					<span class="info_views info_ico"><?php echo inlo_get_view( $post->ID );?></span>
					<span class="info_comment info_ico"><?php echo inlo_comts_count( $post->ID ); ?></span>
                </div>
				<div class="main-content">
					<?php the_content(); ?>
				</div>
				</div>
			</div>
		<?php endwhile; endif;?>		
		<?php comments_template(); ?>
	</div>
</div>
<?php get_sidebar(); ?>
<?php get_footer(); ?>