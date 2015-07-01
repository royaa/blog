<?php

/* create theme options page */
function ct_engross_register_theme_page(){
    add_theme_page( 'Engross Dashboard', 'Engross Dashboard', 'edit_theme_options', 'engross-options', 'ct_engross_options_content');
}
add_action( 'admin_menu', 'ct_engross_register_theme_page' );

/* callback used to add content to options page */
function ct_engross_options_content(){ ?>

    <div id="engross-dashboard-wrap" class="wrap">
        <h2><?php _e('Engross Dashboard', 'engross'); ?></h2>

        <?php $active_tab = isset( $_GET[ 'tab' ] ) ? $_GET[ 'tab' ] : 'dashboard'; ?>

        <h2 class="nav-tab-wrapper">
            <?php _e('Welcome To WPDean Themes', 'engross'); ?>
         </h2>
        
            <div class="content-customization content">
                <h3><?php _e('Theme Options', 'engross'); ?></h3>
                <p><?php _e('Click the "Customize" link in your menu, or use the button below to get started customizing engross', 'engross'); ?>.</p>
                <p>
                    <a class="button-primary" href="<?php echo admin_url('customize.php'); ?>"><?php _e('Use Customizer', 'engross') ?></a>
                </p>
            </div>
	        <div class="content-support content">
		        <h3><?php _e('Free Support', 'engross'); ?></h3>
				<p><?php _e("Our Free Support is available to all our users at Twitter. Just Tweet your question to us.", "engross"); ?>.</p>
		        <p>
			        @TheWPDean
		        </p>
	        </div>
	       
	        <div class="content content-resources">
		        <h3><?php _e('WordPress Resources', 'engross'); ?></h3>
		        <p><?php _e("Save time and money searching for WordPress products by following our recommendations", "engross"); ?>.</p>
		        <p>
			        <a target="_blank" class="button-primary" href="http://wpdean.com/wordpress-resources/"><?php _e('View Resources', 'engross'); ?></a>
		        </p>
	        </div>
			<div class="content-design content">
		        <h3><?php _e('Custom Design', 'engross'); ?></h3>
		        <p><?php _e("Want a custom design for your Theme? Get in touch with us for a custom Quote", "engross"); ?>.</p>
		        <p>
			        <a target="_blank" class="button-primary" href="http://wpdean.com/contact/"><?php _e('Contact Us', 'engross'); ?></a>
		        </p>
	        </div>
			 <div class="content-premium-upgrades content">
		        <h3><?php _e('Rate this theme', 'engross'); ?></h3>
		        <p><?php _e('If you like this theme, I will appreciate any of the following:', 'engross');?></p>
				<p>
				<a target="_blank" class="button-primary" href="https://wordpress.org/support/view/theme-reviews/engross?filter=5"><?php _e('Rate this theme', 'engross'); ?></a>
						        </p>
	        </div>
       
    </div>
<?php } 