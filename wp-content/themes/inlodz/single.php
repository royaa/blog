<?php get_header(); ?>
<div id="main">
	<div class="wrap">		
		<?php if (have_posts()) : while (have_posts()) : the_post(); inlo_set_view ( get_the_ID() );?>
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
				<div class="p_tags">
                	<div class="tagcloud">
                    	标签：<?php the_tags('',' ','');?>
                    </div>
                </div>
				<div class="p-authorinfo">
					<div class="p-copyright">					
						<p><strong>转载请注明出处 : </strong><a href="<?php bloginfo('url'); ?>" rel="bookmark" title="作者 <?php bloginfo('name'); ?>"><?php bloginfo('name'); ?></a>  	&raquo; <a href="<?php the_permalink() ?>" rel="bookmark" title="本文固定链接 <?php the_permalink() ?>"><?php the_title() ?></a></p>
					</div>
					<div class="clear"></div>
				</div>
				</div>
			</div>
			<div class="related_acticles">
				<h2 class="related-title"><span>相关文章</span></h2>
				<div class="acticles">
					<?php echo inlo_related_acticles( get_the_ID() ); ?>
					<div class="clear"></div>
				</div>
				<div class="r-pn-post">
					<?php echo inlo_pn_post( get_the_ID() ); ?>
					<?php echo inlo_pn_post( get_the_ID(), false ); ?>
					<div class="clear"></div>
				</div>
			</div>			
		<?php endwhile; endif;?>	
		<?php comments_template(); ?>
	</div>
</div>
<?php get_sidebar(); ?>
<?php get_footer(); ?>