<?php
/**
 * Custom template tags for Tiny Framework
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package Tiny_Framework
 * @since Tiny Framework 2.0
 */

/**
 * Table of Contents:
 *
 * - Extend the default WordPress CSS classes
 * -- JavaScript Detection - add a `js` class to the root `<html>` element when JavaScript is detected.
 * -- Additional body classes - add category (or any other taxonomy) class for single posts
 * -- Additional body classes - add Page slug class
 * -- Additional post classes - add a post class to denote Non-password protected page with a post thumbnail
 * - Hide some archive template descriptions. Descriptions are still available for accessibility purposes.
 * - Content meta information below the post title
 * -- Content meta information below the post content
 * - Determine whether blog/site has more than one category
 * - Flush out the transients used in {@see tinyframework_categorized_blog()}
 * - Template for comments and pingbacks
 * -- Add Schema.org author markup to comment author links
 * - Add "...continue reading" link for the automatically generated Excerpts
 * - Display edit post link
 * - Display post content with "more" link when applicable
 * - Display navigation to next/previous post pages when applicable
 * - Display navigation to next/previous archive pages when applicable
 * - Temporary and deprecated functions
 *
 * ----------------------------------------------------------------------------
 */

/**
 * JavaScript Detection.
 *
 * Adds a `js` class to the root `<html>` element when JavaScript is detected.
 *
 * @since Tiny Framework 2.0.3
 */
function tinyframework_javascript_detection() {
	echo "<script>(function(html){html.className = html.className.replace(/\bno-js\b/,'js')})(document.documentElement);</script>\n";
}
add_action( 'wp_head', 'tinyframework_javascript_detection', 0 );

if ( ! function_exists( 'tinyframework_body_class' ) ) :
/**
 * Extend the default WordPress `<body>` CSS classes to denote:
 *
 * @since Tiny Framework 1.0
 *
 * param array $classes Existing class values.
 *
 * @return array Filtered class values.
 */
function tinyframework_body_class( $classes ) {
	$background_color = get_background_color();
	$background_image = get_background_image();

	// Using a full-width layout, when no active widgets in the sidebar or full-width template.
	if ( ! is_active_sidebar( 'sidebar-1' ) 
		|| is_page_template( 'page-templates/full-width.php' )
		|| is_attachment() ) {
		$classes[] = 'full-width';
		}

	// Front Page template: thumbnail in use and number of sidebars for widget areas.
	if ( is_page_template( 'page-templates/front-page.php' ) ) {
		$classes[] = 'template-front-page';
		if ( has_post_thumbnail() ) {
			$classes[] = 'has-post-thumbnail';
		}
		if ( is_active_sidebar( 'sidebar-2' ) && is_active_sidebar( 'sidebar-3' ) ) {
			$classes[] = 'two-sidebars';
		}
	}

	// White or empty background color to change the layout and spacing.
	if ( empty( $background_image ) ) {
		if ( empty( $background_color ) ) {
			$classes[] = 'custom-background-empty';
		} elseif ( in_array( $background_color, array( 'fff', 'ffffff' ) ) ) {
			$classes[] = 'custom-background-white';
		}
	}

	// Enable custom font class only if the font CSS is queued to load.
	if ( wp_style_is( 'tinyframework-fonts', 'queue' ) ) {
		$classes[] = 'custom-font-enabled';
		}

	// Single or multiple authors.
	if ( ! is_multi_author() ) {
		$classes[] = 'single-author';
		}

	// Index, archive views.
	if ( is_archive() || is_search() || is_home() ) {
		$classes[] = 'list-view';
	}

	// Single views. is_singular applies when one of the following returns true: is_single(), is_page() or is_attachment()
	if ( is_singular() && ! is_front_page() ) {
		$classes[] = 'singular';
	}

	// Presence of header image.
	if ( get_header_image() ) {
		$classes[] = 'header-image-yes';
	} else {
		$classes[] = 'header-image-no';
	}

	// Presence of footer widget(s).
	if ( is_active_sidebar( 'sidebar-4' ) 
		|| is_active_sidebar( 'sidebar-5' ) 
		|| is_active_sidebar( 'sidebar-6' ) ) {
		$classes[] = 'footer-widgets';
	}

	return $classes;
}
endif;
add_filter( 'body_class', 'tinyframework_body_class' );

/**
 * Additional body classes - add category (or any other taxonomy) class for single posts
 *
 * @since Tiny Framework 1.5.4
 *
 * Add category (or any other taxonomy - controlled with conditionals) nicenames in BODY class for single posts. By Brian Krogsgard.
 * Handy if you want to make CSS changes on a per-post or archive basis depending on the term it relates to.
 * http://www.organizedthemes.com/body-class-tricks-for-wordpress-sites/#comment-315
 */
function tinyframework_tax_body_class( $classes ) {
	if ( is_singular('post') || is_category() ) {
	global $post;
	$terms = get_the_terms( $post->ID, 'category' );
		if ( $terms && ! is_wp_error( $terms ) ) {
			foreach ( $terms as $term ) {
				// assign body class for the blog categories
		    			$classes[] =$term->slug;
			}
		}
	} 
	return $classes;	
}
add_filter( 'body_class', 'tinyframework_tax_body_class' );

/**
 * Additional body classes - add Page slug class
 *
 * @since Tiny Framework 1.5.4
 *
 * http://www.wpbeginner.com/wp-themes/how-to-add-page-slug-in-body-class-of-your-wordpress-themes/
 */
function tinyframework_page_slug_body_class( $classes ) {
global $post;
if ( isset( $post ) ) {
$classes[] = $post->post_type . '-' . $post->post_name;
}
return $classes;
}
add_filter( 'body_class', 'tinyframework_page_slug_body_class' );

/**
 * Additional post classes - add a post class to denote Non-password protected page with a post thumbnail
 *
 * @since Tiny Framework 1.5.4
 *
 * @param array $classes A list of existing post class values.
 * @return array The filtered post class list.
 */
function tinyframework_post_classes( $classes ) {
	if ( ! post_password_required() && has_post_thumbnail() ) {
		$classes[] = 'has-thumbnail';
	}
	return $classes;
}
add_filter( 'post_class', 'tinyframework_post_classes' );


/**
 * Hide some archive template descriptions. Descriptions are still available for accessibility purposes.
 * 
 * They will be replaced with web icons (inserted in category.php, etc.).
 */
function tinyframework_modify_archive_title( $title ) {

	if ( is_category() ) {
		$title = sprintf( '<span class="screen-reader-text">%1$s </span>%2$s',
		__( 'Category:', 'tinyframework' ),
		single_cat_title( '', false )
		);
	} elseif ( is_tag() ) {
		$title = sprintf( '<span class="screen-reader-text">%1$s </span>%2$s',
		__( 'Tag:', 'tinyframework' ),
		single_tag_title( '', false )
		);
	} elseif ( is_author() ) {
		$title = sprintf( '<span class="screen-reader-text">%1$s </span>%2$s',
		__( 'Author:', 'tinyframework' ),
		'<span class="vcard">' . get_the_author() . '</span>'
		);
	}
	return $title;
}
add_filter( 'get_the_archive_title', 'tinyframework_modify_archive_title' );


if ( ! function_exists( 'tinyframework_entry_meta_top' ) ) :
/**
 * Content meta information below the post title
 *
 * Tip26 - Set up post entry meta. Print HTML bellow post title with meta information for the current post date/time and author.
 *
 * Create your own tinyframework_entry_meta_top() to override in a child theme.
 *
 * @since Tiny Framework 1.0
 */
function tinyframework_entry_meta_top() {

	if ( 'post' == get_post_type() ) {
		printf( '<span class="byline"><span class="author vcard" itemprop="author name" itemscope itemtype="http://schema.org/Person"><span class="screen-reader-text">%1$s </span><a class="url fn n" href="%2$s" rel="author" itemprop="url">%3$s</a></span></span>',
			esc_html_x( 'Author', 'Used before post author name.', 'tinyframework' ),
			esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ),
			get_the_author()
		);
	}

	if ( in_array( get_post_type(), array( 'post', 'attachment' ) ) ) {
		$time_string = '<time class="entry-date published updated" datetime="%1$s" itemprop="datePublished">%2$s</time>';

		if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
			$time_string = '<time class="entry-date published" datetime="%1$s" itemprop="datePublished">%2$s</time><time class="updated" datetime="%3$s">%4$s</time>';
		}

		$time_string = sprintf( $time_string,
			esc_attr( get_the_date( 'c' ) ),
			get_the_date(),
			esc_attr( get_the_modified_date( 'c' ) ),
			get_the_modified_date()
		);

		printf( '<span class="posted-on"><span class="screen-reader-text">%1$s </span><a href="%2$s" rel="bookmark">%3$s</a></span>',
			esc_html_x( 'Published on', 'Used before publish date.', 'tinyframework' ),
			esc_url( get_permalink() ),
			$time_string
		);
	}

	if ( ! post_password_required() && ( comments_open() || get_comments_number() ) ) {
		echo '<span class="comments-link">';
		comments_popup_link( esc_html__( 'Leave a comment', 'tinyframework' ), esc_html__( '1 Comment', 'tinyframework' ), esc_html__( '% Comments', 'tinyframework' ) );
		echo '</span>';
	}
}
endif;

if ( ! function_exists( 'tinyframework_entry_meta' ) ) :
/**
 * Content meta information below the post content
 *
 * Set up post entry meta. Print HTML with meta information for current post: categories, tags, permalink, author, and date.
 *
 * Create your own tinyframework_entry_meta() to override in a child theme.
 *
 * @since Tiny Framework 1.0
 */
function tinyframework_entry_meta() {

	$format = get_post_format();
	if ( current_theme_supports( 'post-formats', $format ) ) {
		printf( '<span class="entry-format">%1$s<a href="%2$s">%3$s</a></span>',
			sprintf( '<span class="screen-reader-text">%s </span>', esc_html_x( 'Format', 'Used before post format.', 'tinyframework' ) ),
			esc_url( get_post_format_link( $format ) ),
			get_post_format_string( $format )
		);
	}

	if ( in_array( get_post_type(), array( 'post', 'attachment' ) ) ) {
		$time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';

		if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
			$time_string = '<time class="entry-date published" datetime="%1$s" itemprop="datePublished">%2$s</time><time class="updated" datetime="%3$s">%4$s</time>';
		}

		$time_string = sprintf( $time_string,
			esc_attr( get_the_date( 'c' ) ),
			get_the_date(),
			esc_attr( get_the_modified_date( 'c' ) ),
			get_the_modified_date()
		);

		printf( '<span class="posted-on"><span class="screen-reader-text">%1$s </span><a href="%2$s" rel="bookmark">%3$s</a></span>',
			esc_html_x( 'Published on', 'Used before publish date.', 'tinyframework' ),
			esc_url( get_permalink() ),
			$time_string
		);
	}

	if ( 'post' == get_post_type() ) {
		if ( is_singular() || is_multi_author() ) {
			printf( '<span class="byline"><span class="author vcard" itemprop="author name" itemscope itemtype="http://schema.org/Person"><span class="screen-reader-text">%1$s </span><a class="url fn n" href="%2$s" rel="author" itemprop="url">%3$s</a></span></span>',
				esc_html_x( 'Author', 'Used before post author name.', 'tinyframework' ),
				esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ),
				get_the_author()
			);
		}

		$categories_list = get_the_category_list( _x( ', ', 'Used between list items, there is a space after the comma.', 'tinyframework' ) );
		if ( $categories_list && tinyframework_categorized_blog() ) {
			printf( '<span class="cat-links" itemprop="articleSection"><span class="screen-reader-text">%1$s </span>%2$s</span>',
				esc_html_x( 'Categories', 'Used before category names.', 'tinyframework' ),
				$categories_list
			);
		}

		$tags_list = get_the_tag_list( '', _x( ', ', 'Used between list items, there is a space after the comma.', 'tinyframework' ) );
		if ( $tags_list ) {
			printf( '<span class="tags-links" itemprop="keywords"><span class="screen-reader-text">%1$s </span>%2$s</span>',
				esc_html_x( 'Tags', 'Used before tag names.', 'tinyframework' ),
				$tags_list
			);
		}
	}

	if ( is_attachment() && wp_attachment_is_image() ) {
		// Retrieve attachment metadata.
		$metadata = wp_get_attachment_metadata();

		printf( '<span class="full-size-link"><span class="screen-reader-text">%1$s </span><a href="%2$s">%3$s &times; %4$s</a></span>',
			esc_html_x( 'Full size', 'Used before full size attachment link.', 'tinyframework' ),
			esc_url( wp_get_attachment_url() ),
			$metadata['width'],
			$metadata['height']
		);
	}

	if ( ! is_single() && ! post_password_required() && ( comments_open() || get_comments_number() ) ) {
		echo '<span class="comments-link">';
		comments_popup_link( esc_html__( 'Leave a comment', 'tinyframework' ), esc_html__( '1 Comment', 'tinyframework' ), esc_html__( '% Comments', 'tinyframework' ) );
		echo '</span>';
	}
}
endif;


/**
 * Determine whether blog/site has more than one category.
 *
 * @since Tiny Framework 2.0.1
 *
 * @return bool True of there is more than one category, false otherwise.
 */
function tinyframework_categorized_blog() {
	if ( false === ( $all_the_cool_cats = get_transient( 'tinyframework_categories' ) ) ) {
		// Create an array of all the categories that are attached to posts.
		$all_the_cool_cats = get_categories( array(
			'fields'     => 'ids',
			'hide_empty' => 1,

			// We only need to know if there is more than one category.
			'number'     => 2,
		) );

		// Count the number of categories that are attached to the posts.
		$all_the_cool_cats = count( $all_the_cool_cats );

		set_transient( 'tinyframework_categories', $all_the_cool_cats );
	}

	if ( $all_the_cool_cats > 1 ) {
		// This blog has more than 1 category so tinyframework_categorized_blog should return true.
		return true;
	} else {
		// This blog has only 1 category so tinyframework_categorized_blog should return false.
		return false;
	}
}

/**
 * Flush out the transients used in {@see tinyframework_categorized_blog()}.
 *
 * @since Tiny Framework 2.0.1
 */
function tinyframework_category_transient_flusher() {
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
		return;
	}
	// Like, beat it. Dig?
	delete_transient( 'tinyframework_categories' );
}
add_action( 'edit_category', 'tinyframework_category_transient_flusher' );
add_action( 'save_post',     'tinyframework_category_transient_flusher' );


if ( ! function_exists( 'tinyframework_comment' ) ) :
/**
 * Template for comments and pingbacks
 *
 * To override this walker in a child theme without modifying the comments template
 * simply create your own tinyframework_comment(), and that function will be used instead.
 *
 * Used as a callback by wp_list_comments() for displaying the comments.
 *
 * @since Tiny Framework 1.0
 */
function tinyframework_comment( $comment, $args, $depth ) {
	$GLOBALS['comment'] = $comment;
	switch ( $comment->comment_type ) :
		case 'pingback' :
		case 'trackback' :
		// Display trackbacks differently than normal comments
	?>
	<li id="comment-<?php comment_ID(); ?>" <?php comment_class(); ?>>
		<p><?php esc_html_e( 'Pingback:', 'tinyframework' ); ?> <?php comment_author_link(); ?> <?php edit_comment_link( esc_html__( '(Edit)', 'tinyframework' ), '<span class="edit-link">', '</span>' ); ?></p>
	<?php
			break;
		default :
		// Proceed with normal comments
		global $post;
	?>
	<li id="li-comment-<?php comment_ID(); ?>" <?php comment_class(); ?>>
		<article id="comment-<?php comment_ID(); ?>" class="comment-body" itemprop="comment">
			<header class="comment-meta comment-author vcard" itemprop="creator" itemscope itemtype="http://schema.org/Person">
				<?php
					echo get_avatar( $comment, 56 );
					printf( '<cite><b class="fn">%1$s</b> %2$s</cite>',
						get_comment_author_link(),
						// If current post author is also comment author, make it known visually
						( $comment->user_id === $post->post_author ) ? '<span class="post-author-label">' . esc_html__( 'Post author', 'tinyframework' ) . '</span>' : ''
					);
					printf( '<a href="%1$s"><time datetime="%2$s" itemprop="commentTime">%3$s</time></a>',
						esc_url( get_comment_link( $comment->comment_ID ) ),
						get_comment_time( 'c' ),
						// translators: 1: date, 2: time
						sprintf( __( '%1$s at %2$s', 'tinyframework' ), get_comment_date(), get_comment_time() )
					);
				?>
			</header><!-- .comment-meta -->

			<?php if ( '0' == $comment->comment_approved ) : ?>
				<p class="comment-awaiting-moderation"><?php esc_html_e( 'Your comment is awaiting moderation.', 'tinyframework' ); ?></p>
			<?php endif; ?>

			<section class="comment-content comment" itemprop="commentText">
				<?php comment_text(); ?>
				<?php edit_comment_link( esc_html__( 'Edit', 'tinyframework' ), '<p class="edit-link">', '</p>' ); ?>
			</section><!-- .comment-content -->

			<div class="reply">
				<?php comment_reply_link( array_merge( $args, array(
					'reply_text' => __( 'Reply', 'tinyframework' ),
					'after'      => ' <span>&darr;</span>',
					'depth'      => $depth,
					'max_depth'  => $args['max_depth'],
					) ) );
				?>
			</div><!-- .reply -->
		</article><!-- #comment-## -->
	<?php
		break;
	endswitch; // end comment_type check
}
endif;

// Add Schema.org author markup to comment author links.
if ( ! function_exists( 'tinyframework_comment_author_hook' ) ) :

function tinyframework_comment_author_hook( $author_code ) {
	if (substr($author_code, 0, 2) == '<a') {
		$author_code = '<a itemprop="url"' . substr($author_code, 2);
	}
	return '<span class="comment-author-name" itemprop="name">' . $author_code . '</span>';
}
add_filter( 'get_comment_author_link', 'tinyframework_comment_author_hook' );
endif;


if ( ! function_exists( 'tinyframework_edit_link' ) ) :
/**
 * Display edit post link
 *
 * @since Tiny Framework 1.0
 */
function tinyframework_edit_link() {
	edit_post_link( esc_html__( 'Edit', 'tinyframework' ), '<span class="edit-link">', '</span>' );
}
endif;


if ( ! function_exists( 'tinyframework_post_content' ) ) :
/**
 * Display post content with "more" link when applicable
 *
 * @since Tiny Framework 2.0.1
 */
function tinyframework_post_content() {
	/* translators: %s: Name of current post */
	the_content( sprintf(
		esc_html__( '...continue reading %s', 'tinyframework' ),
		the_title( '<span class="screen-reader-text">', '</span>', false )
	) );
}
endif;


if ( ! function_exists( 'tinyframework_new_excerpt_more' ) && ! is_admin() ) :
/**
 * Add "continue reading" link for the automatically generated Excerpts. Replaces "[...]" (appended to automatically generated excerpts).
 *
 * This does not apply to explicit excerpts for the posts that you would enter manually into Excerpt text box.
 * Please also note, that Excerpt is not a Teaser (the part of a post that appears on the front page when you use the More tag).
 * 
 * Note that if you have also placed the More tag and it was placed before the minimum count of words needed for Excerpt,
 * "continue reading" link for the Excerpt will not be displayed.
 * 
 * If that happens, you can use the function below to adjust the Excerpt length. By default automatic Excerpt shows
 * the first 55 words of the post's content.
 *
 * @link https://codex.wordpress.org/Template_Tags/the_excerpt
 * @return string 'Continue reading' link
 */
function tinyframework_new_excerpt_more( $more ) {
	$link = sprintf( ' <a href="%1$s" class="more-link">%2$s</a>',
		esc_url( get_permalink( get_the_ID() ) ),
		// translators: %s: Name of current post
		sprintf( esc_html__( '...continue reading %s', 'tinyframework' ), '<span class="screen-reader-text">' . get_the_title( get_the_ID() ) . '</span>' )
		);
	return $link;
}
add_filter( 'excerpt_more', 'tinyframework_new_excerpt_more' );
endif;


if ( ! function_exists( 'tinyframework_post_pages_nav' ) ) :
/**
 * Display navigation to next/previous post pages when applicable (when post is devided into multiple pages with <!--nextpage--> ).
 *
 * @since Tiny Framework 2.0.1
 */
function tinyframework_post_pages_nav() {
	wp_link_pages( array(
		'before'      => '<div class="page-links"><span class="page-links-title">' . esc_html__( 'Pages:', 'tinyframework' ) . '</span>',
		'after'       => '</div>',
		'link_before' => '<span>',
		'link_after'  => '</span>',
		'pagelink'    => '<span class="screen-reader-text">' . esc_html__( 'Page', 'tinyframework' ) . ' </span>%',
		'separator'   => '<span class="screen-reader-text">, </span>',
	) ); 
}
endif;


if ( ! function_exists( 'tinyframework_archive_page_nav' ) ) :
/**
 * Display navigation to next/previous archive pages when applicable
 *
 * @since Tiny Framework 1.0
 */
function tinyframework_archive_page_nav() {
	the_posts_pagination( array(
		'prev_text'          => __( 'Previous page', 'tinyframework' ),
		'next_text'          => __( 'Next page', 'tinyframework' ),
		'before_page_number' => '<span class="meta-nav screen-reader-text">' . __( 'Page', 'tinyframework' ) . ' </span>',
	) );
}
endif;


// Temporary and deprecated functions