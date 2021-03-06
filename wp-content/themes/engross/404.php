<?php get_header(); ?>
	<section id="content" class="first clearfix" role="main">
		<div class="post-container">
		    <div class="singlebox">
			  <div class="not-found-block center">
	               <h1><?php _e('The Page You Are Looking For Doesn&rsquo;t Exist.', 'engross'); ?></h1>
	         <h3><?php _e('We are very sorry for the inconvenience.', 'engross'); ?></h3>
	         <p><?php _e('Perhaps, Try using the search box below.', 'engross'); ?></p>
	                    <form role="search" method="get" id="" action="<?php echo home_url(); ?>/">
	                        <input type="text" value="" name="s" id="s">
                            <input class="button" type="submit" id="searchsubmit" value="<?php _e('Search', 'engross'); ?>">
						</form>
					   <p><?php _e('or', 'engross'); ?></p>
					   <a class="button" href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php _e('Go to Homepage', 'engross'); ?></a>
			  </div>
			</div>
		</div>
	</section> <!-- end #main -->
<?php get_sidebar(); ?>
<?php get_footer(); ?>