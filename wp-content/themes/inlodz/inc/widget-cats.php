<?php

//分类目录小工具
add_action ( 'widgets_init', create_function ( '', 'return register_widget("Inlo_Widget_Category");') );
class Inlo_Widget_Category extends WP_Widget {
	function Inlo_Widget_Category() {
		$widget_ops = array (
				'classname' => 'Inlo_Widget_Category',
				'description' => '显示分类目录'
		);
		$this->WP_Widget ( 'Inlo_Widget_Category', 'INLO-分类目录', $widget_ops );
	}
	function form($instance) {
		$instance = wp_parse_args ( ( array ) $instance, array (
				'title' => '分类目录',				
		) );
		$title = $instance ['title'];
		$column = absint($instance ['column']);
?>
<p>
	<label for="<?php echo $this->get_field_id('title'); ?>">
		标题：<input type="text" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" value="<?php echo $title; ?>" />
	</label>
</p>
<?php
	}
	function update($new_instance, $old_instance) {
		$new_instance ['column'] = absint($new_instance ['column']);
		return $new_instance;
	}
	function widget($args, $instance) {
		$category = get_categories('hierarchical=false');
		if( !empty ( $category ) ){
			$column =' jv-cats';
			echo '<div class="widget'.$column.'">
					<h3 class="widget-title"><span>'. $instance['title'] .'</span></h3><div class="post-cats jv-border">';
			foreach($category as $cate){
				$title = empty($cate->category_description) ? $cate->name : $cate->category_description;
				echo '<a title="'.$title.'" href="'.get_category_link($cate).'" class="tra">'.$cate->name.'</a>';
			}
			echo '</div><div class="clear"></div></div>';
		}
	}
}
?>