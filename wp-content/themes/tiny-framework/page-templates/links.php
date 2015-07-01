<?php
/**
 * Template Name: Links
 *
 * Plugin required @link https://wordpress.org/plugins/link-manager/
 *
 * @package Tiny_Framework
 * @since Tiny Framework 1.0
 */

get_header(); ?>

<div id="primary" class="content-area">

	<?php tha_content_before(); // custom action hook ?>

	<main id="main" class="site-main" role="main" itemprop="mainContentOfPage">

		<?php tha_content_top(); // custom action hook ?>

		<?php tha_entry_before(); // custom action hook ?>

		<article id="post-<?php the_ID(); ?>" <?php post_class(); ?> itemscope itemtype="http://schema.org/Article">

			<?php tha_entry_top(); // custom action hook ?>

			<header class="entry-header">

				<?php the_title( '<h1 class="entry-title" itemprop="headline">', '</h1>' ); ?>

			</header>

			<div class="entry-content" itemprop="articleBody">

				<ul id="links-main">

					<?php wp_list_bookmarks('orderby=name&order=ASC&title_before=<h3>&title_after=</h3>'); ?>

				</ul>

			</div><!-- .entry-content -->

			<footer class="entry-meta">

				<?php edit_post_link( esc_html__( 'Edit', 'tinyframework' ), '<span class="edit-link">', '</span>' ); ?>

			</footer><!-- .entry-meta -->

			<?php tha_entry_bottom(); // custom action hook ?>

		</article><!-- #post -->

		<?php tha_entry_after(); // custom action hook ?>

		<?php tha_content_bottom(); // custom action hook ?>

	</main><!-- #main -->

	<?php tha_content_after(); // custom action hook ?>

</div><!-- #primary -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>
