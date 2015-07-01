<?php get_header(); ?>
<div id="main">
	<div class="wrap">
        <div class="archive-title"><?php the_post(); ?>
            <?php if ( is_month() ) : ?>
                <?php printf('%s 发布的文章', get_the_time('Y年F月')); ?>
            <?php elseif ( is_year() ) : ?>
                <?php printf('%s 发布的文章', get_the_time('Y年')); ?>
            <?php elseif ( is_category() ) : ?>
                <?php printf('分类 %s 下的文章',single_cat_title('',false)); ?>
            <?php elseif ( is_tag() ) : ?>
                <?php printf('标签 %s 下的文章',single_tag_title('',false)); ?>
            <?php endif; ?>
        <?php rewind_posts(); ?>
		</div>
		<?php include ('posts.php'); ?>
	</div>
</div>
<?php get_sidebar(); ?>
<?php get_footer(); ?>