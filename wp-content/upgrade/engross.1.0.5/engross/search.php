<?php get_header(); ?>
	<section id="content" class="first clearfix">
		<div class="cat-container">	
	    	<div class="cat-head mbottom">
					<h1 class="archive-title">
						<?php _e("Search Results For:", "engross"); ?> <?php echo get_search_query(); ?>
					</h1>
                    <?php echo category_description(); ?>
				</div>
			<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
                				
				<article class="item-list mbottom">
			        
			       <div class="postmeta">
       		    <p class="vsmall pnone"><?php _e('By', 'engross'); ?> <a href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ) )?>" title="<?php sprintf( esc_attr__( 'View all posts by %s', 'engross' ), get_the_author() ) ?>"><?php echo get_the_author() ?> </a>
     		       on <span class="mdate"><?php echo the_time(get_option( 'date_format' )) ?></span></p>
			</div>
		 <div class="cdetail">
        <h2><a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></h2>
        

        </div>
        <div class="catpost"><?php the_excerpt(); ?></div>
		            
		<div class="clr"></div>

			    </article>				
				<?php endwhile; ?>
				    <div class="pagenavi alignright">
					    <?php if ($wp_query->max_num_pages > 1) engross_wp_pagination(); ?>
					</div>
				<?php else : get_template_part( 'no-results', 'archive' ); endif; ?>
		</div>
	</section>
<?php get_sidebar(); ?>
<?php get_footer(); ?>