<?php
// 聚合Tab-2
add_action('widgets_init', 'Inlo_Widget_Tabs2_init');
function Inlo_Widget_Tabs2_init() {
    register_widget('Inlo_Widget_Tabs2');
}
class Inlo_Widget_Tabs2 extends WP_Widget {
function Inlo_Widget_Tabs2() {
    $widget_ops = array('description' => '聚合多种小工具');
    $this->WP_Widget('Inlo_Widget_Tabs2', 'INLO-聚合Tab-2', $widget_ops);
}
function widget($args, $instance) {
    extract($args);
	global $wpdb;
	$randtitle = strip_tags($instance['randtitle']);
	$hottitle = strip_tags($instance['hottitle']);
	$newtitle = strip_tags($instance['newtitle']);
	$num = strip_tags($instance['num']);
	$days = strip_tags($instance['days']);
	$sticky = get_option( 'sticky_posts' );
	echo '<div class="widget jv_tabb">';
?>
<h3 class="widget-title tab-title"><span class="selected"><?php echo $randtitle; ?></span><span><?php echo $hottitle; ?></span><span><?php echo $newtitle; ?></span></h3>
<div class="tab-content">
		<ul><?php $posts = query_posts(array('orderby' =>'rand','showposts'=>$num,'post__not_in' =>$sticky)); while(have_posts()) : the_post(); ?> 
            <li><a href="<?php the_permalink(); ?>" rel="bookmark" title="<?php the_title_attribute(); ?>"><?php echo wp_trim_words(get_the_title()); ?></a></li><?php endwhile; wp_reset_query(); ?>
        </ul>
        <ul class="hide">
			<?php
				$hotsql = "SELECT ID , post_title , comment_count FROM $wpdb->posts WHERE post_type = 'post' AND TO_DAYS(now()) - TO_DAYS(post_date) < $days AND ($wpdb->posts.`post_status` = 'publish' OR $wpdb->posts.`post_status` = 'inherit') ORDER BY comment_count DESC LIMIT 0 , $num ";
				$hotposts = $wpdb->get_results($hotsql);
				$hotoutput = "";
				foreach ($hotposts as $post){
				$hotoutput .= "\n<li><a href= \"".get_permalink($post->ID)."\" rel=\"bookmark\" title=\"".$post->post_title." (".$post->comment_count."条评论)\" >". wp_trim_words($post->post_title)."</a></li>";
				}
				echo $hotoutput;
			?>
		</ul>
        <ul class="hide"><?php $posts = query_posts(array('orderby' =>'date','showposts'=>$num,'post__not_in' =>$sticky)); while(have_posts()) : the_post(); ?> 
            <li><a href="<?php the_permalink(); ?>" rel="bookmark" title="<?php the_title_attribute(); ?>"><?php echo wp_trim_words(get_the_title()); ?></a></li><?php endwhile; wp_reset_query(); ?>
        </ul>
    </div>
<?php	
		echo "</div>\n";
    }
     function update($new_instance, $old_instance) {
         if (!isset($new_instance['submit'])) {
             return false;
         }
         $instance = $old_instance;
		 $instance['randtitle'] = strip_tags($new_instance['randtitle']);	
		 $instance['hottitle'] = strip_tags($new_instance['hottitle']);
		 $instance['newtitle'] = strip_tags($new_instance['newtitle']);		 
		 $instance['num'] = strip_tags($new_instance['num']);
		 $instance['days'] = strip_tags($new_instance['days']);
         return $instance;
     }
    function form($instance) {
        global $wpdb;
		$instance = wp_parse_args((array) $instance, array('randtitle' => '随机文章','hottitle' => '热评文章','newtitle' => '最新文章','num' => '6','days' => '30'));
		$randtitle = strip_tags($instance['randtitle']);        
		$hottitle = strip_tags($instance['hottitle']);
		$newtitle = strip_tags($instance['newtitle']);
		$num = strip_tags($instance['num']);
		$days = strip_tags($instance['days']);
?>
<p><label for="<?php echo $this->get_field_id('randtitle'); ?>">随机文章标题：<input class="widefat" id="<?php echo $this->get_field_id('randtitle'); ?>" name="<?php echo $this->get_field_name('randtitle'); ?>" type="text" value="<?php echo $randtitle; ?>" /></label></p>
<p><label for="<?php echo $this->get_field_id('hottitle'); ?>">热门文章标题：<input class="widefat" id="<?php echo $this->get_field_id('hottitle'); ?>" name="<?php echo $this->get_field_name('hottitle'); ?>" type="text" value="<?php echo $hottitle; ?>" /></label></p>
<p><label for="<?php echo $this->get_field_id('newtitle'); ?>">最新文章标题：<input class="widefat" id="<?php echo $this->get_field_id('newtitle'); ?>" name="<?php echo $this->get_field_name('newtitle'); ?>" type="text" value="<?php echo $newtitle; ?>" /></label></p>
<p><label for="<?php echo $this->get_field_id('num'); ?>">各类文章显示数量：<input class="widefat" id="<?php echo $this->get_field_id('num'); ?>" name="<?php echo $this->get_field_name('num'); ?>" type="text" value="<?php echo $num; ?>" /></label></p>
<p><label for="<?php echo $this->get_field_id('days'); ?>">热评文章控制天数：<input class="widefat" id="<?php echo $this->get_field_id('days'); ?>" name="<?php echo $this->get_field_name('days'); ?>" type="text" value="<?php echo $days; ?>" /></label></p>
<input type="hidden" id="<?php echo $this->get_field_id('submit'); ?>" name="<?php echo $this->get_field_name('submit'); ?>" value="1" />
<?php
    }
}
?>