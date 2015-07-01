<?php get_header(); ?>
	<section id="content" class="first clearfix">
		<div class="cat-container">
							
				<?php if (is_category()) { ?>
					<div class="cat-head">
						<h1 class="archive-title">
							<span><?php _e("Posts Categorized:", "engross"); ?></span> <?php single_cat_title(); ?>
						</h1>
                    </div>
				<?php } elseif (is_tag()) { ?>
					<div class="cat-head">
						<h1 class="archive-title">
							<?php _e("Posts Tagged:", "engross"); ?> <?php single_tag_title(); ?>
						</h1>
                    </div>
				<?php } elseif (is_author()) {
					global $post;
					$author_id = $post->post_author; ?>
					<div class="cat-head">
						<h1 class="archive-title">
							<?php _e("Posts By:", "engross"); ?> <?php the_author_meta('display_name', $author_id); ?>
						</h1>
					</div>
				<?php } elseif (is_day()) { ?>
					<div class="cat-head">
						<h1 class="archive-title">
							<?php _e("Daily Archives:", "engross"); ?> <?php the_time('l, F j, Y'); ?>
						</h1>
                    </div>
				<?php } elseif (is_month()) { ?>
                    <div class="cat-head">
		                <h1 class="archive-title">
							<?php _e("Monthly Archives:", "engross"); ?> <?php the_time('F Y'); ?>
						</h1>
                    </div>
				<?php } elseif (is_year()) { ?>
                    <div class="cat-head">
		                <h1 class="archive-title">
							<?php _e("Yearly Archives:", "engross"); ?> <?php the_time('Y'); ?>
						</h1>
                    </div>
				<?php } ?>
				<?php get_template_part( 'loop', 'archive' ); ?>
			</div>
	</section>
<?php get_sidebar(); ?>
<?php get_footer(); ?>