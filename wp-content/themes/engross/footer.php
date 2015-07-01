<?php /* Footer Template */ ?>
</div> <!-- end inner-content -->
    </div> <!-- end content -->
        <div class="clr"></div>
			<footer id="main-footer">
				
				<div id="bottom-footer">
				    <div class="layout-wrap container">
                       <div id="footer-logo" class="five-col">
                         <p><?php echo esc_textarea(get_theme_mod( 'engross_footer_top' )); ?></p> 
                       </div>
					 <!-- Footer Menu -->  
     	            <?php if ( has_nav_menu( 'footer-menu' ) ) :
         			wp_nav_menu( array( 'theme_location' => 'footer-menu', 'container' => '', 'menu_id' =>'footer-nav-links', 'menu_class'=>'footer-menu seven-col last', 'depth' => 0, ) );
			        endif; ?>
					<div id="footer-social-icons" class="seven-col last">
					
                        <?php if ( get_theme_mod( 'facebooklink' ) ) : ?>
						    <a href="<?php echo esc_url( get_theme_mod('facebooklink') ); ?>" target="_blank" class="facebook"></a><?php endif; ?>
                        <?php if ( get_theme_mod( 'twitterlink' ) ) : ?>
						    <a href="<?php echo esc_url( get_theme_mod('twitterlink') ); ?>" target="_blank" class="twitter"></a><?php endif; ?>
                        <?php if ( get_theme_mod( 'googlelink' ) ) : ?>
						    <a href="<?php echo esc_url( get_theme_mod('googlelink') ); ?>" target="_blank" class="googleplus"></a><?php endif; ?>
                        <?php if ( get_theme_mod( 'youtubelink' ) ) : ?>
						    <a href="<?php echo esc_url( get_theme_mod('youtubelink') ); ?>" target="_blank" class="youtube"></a><?php endif; ?>
                        <?php if ( get_theme_mod( 'pinterestlink' ) ) : ?>
						    <a href="<?php echo esc_url( get_theme_mod('pinterestlink') ); ?>" target="_blank" class="pinterest"></a><?php endif; ?>
                        <?php if ( get_theme_mod( 'stumblelink' ) ) : ?>
						    <a href="<?php echo esc_url( get_theme_mod('stumblelink') ); ?>" target="_blank" class="stumbleupon"></a><?php endif; ?>
                        <?php if ( get_theme_mod( 'rsslink' ) ) : ?>
						    <a href="<?php echo esc_url( get_theme_mod('rsslink') ); ?>" target="_blank" class="rss"></a><?php endif; ?>
  				    </div>
					<div id="footer-copyright">
                       <p class="vsmall"><span class="alignleft">&copy; <?php echo date("Y") ?> <?php bloginfo('name'); ?>. <?php _e('All Rights Reserved.', 'engross'); ?></span>
					   </div>
                    </div>
                </div><!-- end #inner-footer -->
			</footer> <!-- end footer -->
        <div id="gototop"><?php _e('Scroll To Top' , 'engross'); ?></div>

        <?php wp_footer(); ?>
    </body>
</html>