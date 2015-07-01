<?php
/* The template part for displaying a message that posts cannot be found. @package engross */
?>
<div class="singlebox">
  <div class="not-found-block center">
      <h3><?php _e('Oops..! No Results Found.', 'engross'); ?></h3>
        <p><?php _e('Perhaps, Try searching with different keywords.', 'engross'); ?></p>                              
                <form role="search" method="get" id="" action="<?php echo home_url(); ?>/">
                    <input type="text" value="" name="s" id="s">
                    <input class="button" type="submit" id="searchsubmit" value="Search">
				</form>
		    <p><p><?php _e('Or', 'engross'); ?></p></p>
		   <a class="button" href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php _e('Go to Homepage', 'engross'); ?></a>
  </div>
</div>