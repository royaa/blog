<?php
//搜索小工具
add_action ( 'widgets_init', create_function ( '', 'return register_widget("Inlo_Widget_Search");') );
class Inlo_Widget_Search extends WP_Widget {
	function Inlo_Widget_Search() {
		$widget_ops = array (
				'classname' => 'Inlo_Widget_Search',
				'description' => '站内搜索功能'
		);
		$this->WP_Widget ( 'Inlo_Widget_Search', 'INLO-搜索工具', $widget_ops );
	}
	function form($instance) {
		$instance = wp_parse_args ( ( array ) $instance, array (
				'title' =>	'搜&nbsp;索',
		) );
		$title = $instance ['title'];
?>
<p>
	<label for="<?php echo $this->get_field_id('title'); ?>">
		标题：<input type="text" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" value="<?php echo $title; ?>" />
	</label>
</p>
<?php
	}
	function widget($args, $instance) {
	$form = '
		<form class="s-form" action="/?s=">
			<input type="text" name="s" class="s-key" required />
			<input type="submit" value="搜 索" class="s-sub tra" title="搜　索" />
		</form>';
	echo '
		<div class="widget jv-search">
			<!--h3 class="widget-title"><span>搜　索</span></h3-->
			<div class="jv-custom inlo-search jv-border">
				'.$form.'
			</div>
		</div>';
	}
}

?>