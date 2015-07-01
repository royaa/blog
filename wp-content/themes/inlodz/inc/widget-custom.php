<?php
//自定义内容小工具
add_action ( 'widgets_init', create_function ( '', 'return register_widget("Inlo_Widget_Custom");') );
class Inlo_Widget_Custom extends WP_Widget {
	function Inlo_Widget_Custom() {
		$widget_ops = array (
				'classname' => 'Inlo_Widget_Custom',
				'description' => '自定义内容，广告类'
		);
		$this->WP_Widget ( 'Inlo_Widget_Custom', 'INLO-自定义内容', $widget_ops );
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
		标题：<input type="text" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" value="<?php echo $title; ?>" />
	</label>
</p>	
<p>
	<label for="<?php echo $this->get_field_id('content'); ?>">
		内容: <textarea class="widefat" rows="15" id="<?php echo $this->get_field_id('content'); ?>" name="<?php echo $this->get_field_name('content'); ?>"><?php echo $content; ?></textarea>
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
					<div class="jv-custom">'. $instance ['content'] .'</div>
			 </div>';
	}
}
?>