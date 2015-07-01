<?php
//聚合面板小工具
add_action ( 'widgets_init', create_function ( '', 'return register_widget("Inlo_Widget_Tabs");') );
class Inlo_Widget_Tabs extends WP_Widget {
	function Inlo_Widget_Tabs() {
		$widget_ops = array (
				'classname' => 'Inlo_Widget_Tabs',
				'description' => '聚合多种小工具'
		);
		$this->WP_Widget ( 'Inlo_Widget_Tabs', 'INLO-聚合Tab-1', $widget_ops );
	}
	function form($instance) {
		$instance = wp_parse_args ( ( array ) $instance, array (
				'type1' => 'comment_count',
				'type2' => 'rand',
				'type3' => 'N',
				'count' => '5'
		) );
		$type = $instance ['type'];
		$type1 = $instance ['type1'];
		$type2 = $instance ['type2'];
		$type3 = $instance ['type3'];
		$count = $instance ['count'];
?>
<p>
	<label for="<?php echo $this->get_field_id('type'); ?>">
		第一项: 
		<select id="<?php echo $this->get_field_id('type'); ?>" name="<?php echo $this->get_field_name('type'); ?>">
			<option value="" <?php echo empty( $type ) ? 'selected="selected"' : null; ?>>最新文章</option>
			<option value="comment_count" <?php echo $type == 'comment_count' ? 'selected="selected"' : null; ?>>热评文章</option>
			<option value="rand" <?php echo $type == 'rand' ? 'selected="selected"' : null; ?>>随机文章</option>
			<option value="modified" <?php echo $type == 'modified' ? 'selected="selected"' : null; ?>>最近更新</option>
			<option value="comments" <?php echo $type == 'comments' ? 'selected="selected"' : null; ?>>最新评论</option>
			<option value="tags" <?php echo $type == 'tags' ? 'selected="selected"' : null; ?>>标签云</option>
		</select>
	</label>
</p>
<p>
	<label for="<?php echo $this->get_field_id('type1'); ?>">
		第二项: 
		<select id="<?php echo $this->get_field_id('type1'); ?>" name="<?php echo $this->get_field_name('type1'); ?>">
			<option value="N" <?php echo $type1 == 'N' ? 'selected="selected"' : null; ?>>不显示</option>
			<option value="" <?php echo empty( $type1 ) ? 'selected="selected"' : null; ?>>最新文章</option>
			<option value="comment_count" <?php echo $type1 == 'comment_count' ? 'selected="selected"' : null; ?>>热评文章</option>
			<option value="rand" <?php echo $type1 == 'rand' ? 'selected="selected"' : null; ?>>随机文章</option>
			<option value="modified" <?php echo $type1 == 'modified' ? 'selected="selected"' : null; ?>>最近更新</option>
			<option value="comments" <?php echo $type1 == 'comments' ? 'selected="selected"' : null; ?>>最新评论</option>
			<option value="tags" <?php echo $type1 == 'tags' ? 'selected="selected"' : null; ?>>标签云</option>
		</select>
	</label>
</p>
<p>
	<label for="<?php echo $this->get_field_id('type2'); ?>">
		第三项: 
		<select id="<?php echo $this->get_field_id('type2'); ?>" name="<?php echo $this->get_field_name('type2'); ?>">
			<option value="N" <?php echo $type2 == 'N' ? 'selected="selected"' : null; ?>>不显示</option>
			<option value="" <?php echo empty( $type2 ) ? 'selected="selected"' : null; ?>>最新文章</option>
			<option value="comment_count" <?php echo $type2 == 'comment_count' ? 'selected="selected"' : null; ?>>热评文章</option>
			<option value="rand" <?php echo $type2 == 'rand' ? 'selected="selected"' : null; ?>>随机文章</option>
			<option value="modified" <?php echo $type2 == 'modified' ? 'selected="selected"' : null; ?>>最近更新</option>
			<option value="comments" <?php echo $type2 == 'comments' ? 'selected="selected"' : null; ?>>最新评论</option>
			<option value="tags" <?php echo $type2 == 'tags' ? 'selected="selected"' : null; ?>>标签云</option>
		</select>
	</label>
</p>
<p>
	<label for="<?php echo $this->get_field_id('type3'); ?>">
		第四项: 
		<select id="<?php echo $this->get_field_id('type3'); ?>" name="<?php echo $this->get_field_name('type3'); ?>">
			<option value="N" <?php echo $type3 == 'N' ? 'selected="selected"' : null; ?>>不显示</option>
			<option value="" <?php echo empty( $type3 ) ? 'selected="selected"' : null; ?>>最新文章</option>
			<option value="comment_count" <?php echo $type3 == 'comment_count' ? 'selected="selected"' : null; ?>>热评文章</option>
			<option value="rand" <?php echo $type3 == 'rand' ? 'selected="selected"' : null; ?>>随机文章</option>
			<option value="modified" <?php echo $type3 == 'modified' ? 'selected="selected"' : null; ?>>最近更新</option>
			<option value="comments" <?php echo $type3 == 'comments' ? 'selected="selected"' : null; ?>>最新评论</option>
			<option value="tags" <?php echo $type3 == 'tags' ? 'selected="selected"' : null; ?>>标签云</option>
		</select>
	</label>
</p>
<p>
	<label for="<?php echo $this->get_field_id('count'); ?>">
		每项显示数量: <input type="text" size="3" maxlength="2" id="<?php echo $this->get_field_id('count'); ?>" name="<?php echo $this->get_field_name('count'); ?>" value="<?php echo absint($count); ?>" />
	</label>
</p>
<?php
	}
	function update($new_instance, $old_instance) {
		return $new_instance;
	}
	function widget($args, $instance) {
		$title = array (
				'' => '最新文章',
				'tags' => '标签云',
				'rand' => '随机文章',
				'modified' => '最近更新',
				'comments' => '最新评论',
				'comment_count' => '热评文章'
		);
		$count = $instance ['count'];
		unset ($instance ['count']);
		$tabs = array();
		$tab_titles = array();
		foreach ( $instance as $type ) {
			if ( $type == 'N' ) {
				continue;
			}
			$tab_titles [] =  $title [ $type ];
			if ( $type == '' || $type == 'comment_count' || $type == 'rand' || $type == 'modified' ) {
				$posts = get_posts( array('numberposts' => $count , 'orderby' => $type ));
				if ($posts) {
					$first = empty($tabs) ? ' current' : null;
					$str = '<div class="panel '.$first.' post-items">';
					foreach( $posts as $p ){
						$str .= '<a href="'. get_permalink( $p->ID ) .'" class="tra">'
									. inlo_get_thumb( $p->ID, $p->post_title, $p->post_content ) .'
									<span class="publish">'.get_the_time( "Y-n-j", $p->ID ).'</span>
									<span>'.$p->post_title.'</span>
								</a>';
					}
					$str .= '</div>';
				}
				$tabs [] = $str;
			} elseif ( $type == 'comments' ) {
				$first = empty($tabs) ? ' current' : null;
				$tabs [] = '
				<div class="new-comment '.$first.' panel jv-border">'.
					inlo_get_new_comments( $count ) .'
				</div>';
			} elseif ( $type == 'tags' ) {
				$first = empty($tabs) ? ' current' : null;
				$tabs [] = '
				<div class="jv-tags-wrap '.$first.' panel jv-border">'.
					wp_tag_cloud('smallest=12&largest=16&unit=px&orderby=count&order=DESC&echo=0') .'
				</div>';
			}
		}
		$str = '<div class="widget jv-tab">
					<ul class="tab-title">';
		foreach ( $tab_titles as $k=> $t ) {
			$on = $k == 0 ? ' class="on"' : null;
			$str .= "<li{$on}>{$t}</li>";
		}
		$str .= '</ul><div class="clear"></div>';
		foreach ( $tabs as $content) {
			$str .= $content;
		}
		$str .= '</div>';
		echo $str;
	}
}
?>