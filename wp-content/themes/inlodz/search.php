<?php get_header(); ?>
<div id="main">
	<div class="wrap">
        <h3 class="archive-title">包含关键字 <?php the_search_query();?> 的文章</h3>
        <?php include ('posts.php'); ?>
	</div>
</div>
<?php get_sidebar(); ?>
<?php get_footer(); ?>