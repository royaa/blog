<?php /* Theme Customizer For Engross Theme */
   
 	function engross_customize_register($wp_customize){
    
	// Theme Colors
 
	$colors = array();
    $colors[] = array( 'slug'=>'bg_color', 'default' => '#222',
    'label' => __( 'Background Color', 'engross' ) );
	
    $colors[] = array( 'slug'=>'primary_color', 'default' => '#ee5554',
    'label' => __( 'Primary Color ', 'engross' ) );
     
	
	foreach($colors as $color)
  {	
    $wp_customize->add_setting( $color['slug'], array( 'default' => $color['default'],
    'type' => 'theme_mod', 'capability' => 'edit_theme_options', 'sanitize_callback' => 'sanitize_hex_color', ));

    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize,
     $color['slug'], array( 'label' => $color['label'], 'section' => 'colors',
     'settings' => $color['slug'] )));
  }
	// Theme Colors Ends
	// Logo Uploader
	
	$wp_customize->add_section( 'engross_logo_fav_section' , array(
    'title'       => __( 'Site Logo', 'engross' ),
    'priority'    => 30,
    'description' => __('Upload a logo to replace the default site name and description in the header','engross'),) );

    $wp_customize->add_setting( 'engross_logo', array(
		'sanitize_callback' => 'esc_url_raw') );

    $wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'engross_logo', array(
    'label'    => __( 'Site Logo ( Recommended height - 60px)', 'engross' ),
    'section'  => 'engross_logo_fav_section',
    'settings' => 'engross_logo',
    ) ) );
	
	function engross_check_header_video($file){
  return validate_file($file, array('', 'mp4'));
}

	// Sidebar Position
	
		$wp_customize->add_section( 'sidebar_position', array(
        'title' => __('Sidebbar Position','engross'), // The title of section
        'description' => __('Select Sidebar Position.','engross'), // The description of section
        'priority' => '900',
	) );
	
$wp_customize->add_setting( 'sidebar_position_option', array(
    'default' => 'sidebar_display_right',
    'type' => 'theme_mod',
	'sanitize_callback' => 'engross_sanitize_sidebar_placement',
) );

	$wp_customize->add_control( 'sidebar_position_option', array(
    'label' => __('Display Sidebar on Left or Right','engross'),
    'section' => 'sidebar_position',
    'type' => 'radio',
    'choices' => array(
        'sidebar_display_right' => __('Right (Default)', 'engross'),
    	'sidebar_display_left' => __('Left', 'engross'),
        ),
) );

function engross_sanitize_sidebar_placement( $input ) {
    $valid = array(
       'sidebar_display_right' => 'Right (Default)',
    	'sidebar_display_left' => 'Left',
    );
 
    if ( array_key_exists( $input, $valid ) ) {
        return $input;
    } else {
        return '';
    }
}
	  
	// Sidebar Position Ends
	// Social Links
	
	$wp_customize->add_section( 'sociallinks', array(
        'title' => __('Social Links','engross'), // The title of section
        'description' => __('Add Your Social Links Here.','engross'), // The description of section
        'priority' => '900',
	) );
	
	$wp_customize->add_setting( 'facebooklink', array('default' => '#','sanitize_callback' => 'esc_url_raw') );
    $wp_customize->add_control( 'facebooklink', array('label' => 'Facebook URL', 'section' => 'sociallinks', ) );
	$wp_customize->add_setting( 'twitterlink', array('default' => '#','sanitize_callback' => 'esc_url_raw') );
    $wp_customize->add_control( 'twitterlink', array('label' => 'Twitter Handle', 'section' => 'sociallinks', ) );
    $wp_customize->add_setting( 'googlelink', array('default' => '#', 'sanitize_callback' => 'esc_url_raw') );
    $wp_customize->add_control( 'googlelink', array('label' => 'Google Plus URL','section' => 'sociallinks',) );
	$wp_customize->add_setting( 'pinterestlink', array('default' => '#', 'sanitize_callback' => 'esc_url_raw') );
    $wp_customize->add_control( 'pinterestlink', array('label' => 'Pinterest URL','section' => 'sociallinks',) );
	$wp_customize->add_setting( 'youtubelink', array('default' => '#', 'sanitize_callback' => 'esc_url_raw') );
    $wp_customize->add_control( 'youtubelink', array('label' => 'YouTube URL','section' => 'sociallinks',) );
	$wp_customize->add_setting( 'stumblelink', array('default' => '#', 'sanitize_callback' => 'esc_url_raw') );
    $wp_customize->add_control( 'stumblelink', array('label' => 'Stumbleupon Link','section' => 'sociallinks', ) );
	$wp_customize->add_setting( 'rsslink', array('default' => '#', 'sanitize_callback' => 'esc_url_raw') );
    $wp_customize->add_control( 'rsslink', array('label' => 'RSS Feeds URL','section' => 'sociallinks',) );

	// Social Links Ends
	
 	// Footer Copyright Section
	
	$wp_customize->add_section( 'fcopyright', array(
        'title' => __('Footer Copyright','engross'), // The title of section
        'description' => __('Add Your Copyright Notes Here.','engross'), // The description of section
        'priority' => '900',
	) );
 
	$wp_customize->add_setting( 'engross_footer_top', array('default' => '','sanitize_callback' => 'sanitize_footer_text',) );
    $wp_customize->add_control( 'engross_footer_top', array('label' => 'Footer Text','section' => 'fcopyright',) );
	
    	
	function sanitize_footer_text( $input ) {
    return wp_kses_post( force_balance_tags( $input ) );
}
	
	
	  } // function ends here

	   // This will output the custom WordPress settings to the live theme's WP head. */
   
   function engross_header_output() {
     $sidebar_pos = get_theme_mod('sidebar_position_option');
     $bgcolor = get_theme_mod('bg_color');
	
	 $primarycolor = get_theme_mod('primary_color');
	 
	 ?><?php echo get_theme_mod('textarea_setting'); 
      if ( ($sidebar_pos == 'sidebar_display_left') || ( ! empty( $bgcolor )) || (!empty($primarycolor))){
?>	  <!--Customizer CSS--> 
      
	  <style type="text/css">
	        <?php if ($sidebar_pos == 'sidebar_display_left') { ?>
     	    #content{float:right;}
			.post-container, .page-container, .cat-container, .home-container { margin-left: 380px; margin-right:0px;}
			 #sidebar{margin-right: -380px; margin-left:0px; float: left;}
			 @media only screen and (max-width: 479px){ 
			 .post-container, .page-container, .cat-container, .home-container { margin-left: 0px;} #sidebar{margin-right:0px; }}
			 @media only screen and (max-width: 767px) and (min-width: 480px){
			 .post-container, .page-container, .cat-container, .home-container { margin-left: 0px;} }
			 
			 }
			
	    	<?php } ?>

		    <?php if($bgcolor) { ?>
		      body{background-color: <?php echo esc_attr($bgcolor); ?>}
		   	<?php } ?>
		   
            <?php if($primarycolor) { ?>

  .search-block #s, .post-meta, .top-nav li a, #main-footer a,
			  .catbox a, .hcat a:visited, a, .cdetail h3 a:hover, .cdetail h2 a:hover,   
			  .related-article h5 a, #sidebar a:hover{color:<?php echo esc_attr($primarycolor); ?>;}
			  		 #main-footer {border-bottom: 6px solid <?php echo esc_attr($primarycolor); ?>;}  
					 #gototop, .cat-head	{background-color:<?php echo esc_attr($primarycolor); ?>;}

			  
				
		   	<?php } ?>

		
	  </style>
      <!--/Customizer CSS-->
	<?php } ?>
	<?php } 
		  
add_action( 'customize_register', 'engross_customize_register', 11 );
add_action( 'wp_head', 'engross_header_output', 11 );

//add_action( 'customize_register' , array( 'engross_Customize' , 'register' ) );
//add_action( 'wp_head' , array( 'engross_Customize' , 'header_output' ) );