<?php
//社交媒体小工具
add_action ( 'widgets_init', create_function ( '', 'return register_widget("Inlo_Widget_Sns");') );
class Inlo_Widget_Sns extends WP_Widget {
	function Inlo_Widget_Sns() {
		$widget_ops = array (
				'classname' => 'Inlo_Widget_Sns',
				'description' => '社交媒体'
		);
		$this->WP_Widget ( 'Inlo_Widget_Sns', 'INLO-社交媒体', $widget_ops );
	}
	function form($instance) {
		$instance = wp_parse_args ( ( array ) $instance, array (
				'title' =>	'',
				'content' => ''
		) );
		$content = $instance ['content'];
		$title = $instance ['title'];
?>
<p>
	<label for="<?php echo $this->get_field_id('title'); ?>">
		标题：<input type="text" id="<?php echo $this->get_field_id('title'); ?>" placeholder="Follow Me" name="<?php echo $this->get_field_name('title'); ?>" value="<?php echo $title; ?>" />
	</label>
</p>	
<p>
	<label for="<?php echo $this->get_field_id('content'); ?>">
		（请到<strong>主题设置</strong>填写相关信息）
	</label>
</p>
<?php
	}
	function update($new_instance, $old_instance) {
		return $new_instance;
	}
	function widget($args, $instance) {
		echo '<div class="widget">
					<h3 class="widget-title"><span>'. $instance['title'] .'</span></h3>
					<div class="jv-sns tra">
						<a href="'. inlo_options('sns_weibo') .'" rel="nofollow" target="_blank"><i class="fa fa-weibo fa-2x tra"></i></a>
						<a href="mailto:'. inlo_options('sns_email') .'" rel="nofollow"><i class="fa fa-envelope fa-2x tra"></i></a>
						<a href="'. inlo_options('sns_qq') .'" rel="nofollow" target="_blank"><i class="fa fa-qq fa-2x tra"></i></a>
						<a href="'. inlo_options('sns_weixin') .'" rel="nofollow" target="_blank"><i class="fa fa-weixin fa-2x tra"></i></a>
						<a href="'. inlo_options('sns_facebook') .'" rel="nofollow" target="_blank"><i class="fa fa-facebook fa-2x tra"></i></a>
						<a href="'. inlo_options('sns_twitter') .'" rel="nofollow" target="_blank"><i class="fa fa-twitter fa-2x tra"></i></a>
						<a href="'. inlo_options('sns_feed') .'" rel="nofollow" target="_blank"><i class="fa fa-rss fa-2x tra"></i></a>
					</div>
			 </div>';
	}
}
?>