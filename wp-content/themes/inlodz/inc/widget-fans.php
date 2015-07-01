<?php
//读者排行
add_action('widgets_init', 'Inlo_Widget_fans_init');
function Inlo_Widget_fans_init() {
    register_widget('Inlo_Widget_fans');
}
class Inlo_Widget_fans extends WP_Widget {
    function Inlo_Widget_fans() {
        $widget_ops = array('description' => '读者评论数目排行');
        $this->WP_Widget('Inlo_Widget_fans', 'INLO-读者排行榜', $widget_ops);
    }
    function widget($args, $instance) {
        extract($args);
		global $wpdb;
		$tctime =strip_tags($instance['tctime']);
        $tcnum = strip_tags($instance['tcnum']);
		$tctitle = strip_tags($instance['tctitle']);
        echo '<div class="widget jv-fans">';
?>
<h3 class="widget-title"><span><?php echo $tctitle; ?></span></h3>
<div class="jv-custom jv-fans-box">
<ul>
<?php 
$my_email = "'" . get_bloginfo ('admin_email') . "'"; //根据邮箱，排除管理员
$counts = $wpdb->get_results("SELECT COUNT(comment_author) AS cnt, comment_author, comment_author_url, comment_author_email FROM (SELECT * FROM $wpdb->comments LEFT OUTER JOIN $wpdb->posts ON ($wpdb->posts.ID=$wpdb->comments.comment_post_ID) WHERE comment_date > date_sub( NOW(), INTERVAL $tctime DAY ) AND user_id='0' AND comment_author_email != $my_email AND comment_author != 'admin' AND post_password='' AND comment_approved='1' AND comment_type='') AS tempcmt GROUP BY comment_author_email
ORDER BY cnt DESC LIMIT $tcnum"); 
$mostactive = '';
foreach ($counts as $count) { 
$tavatar = get_avatar ( $count->comment_author_email, 40 );
$c_url = $count->comment_author_url; 
$mostactive .= '<li>' . '<a href="'. $c_url . '" title="' . $count->comment_author . ' ('. $count->cnt . '条评论)" rel="external nofollow">' . $tavatar . '</a></li>'; 
}
echo $mostactive; 
?>
<div class="clear"></div>
</ul>
<div class="clear"></div>
</div>
<?php	
        echo "</div>\n";
    }
	
    function update($new_instance, $old_instance) {
        if (!isset($new_instance['submit'])) {
            return false;
        }
        $instance = $old_instance;
		$instance['tctime'] = strip_tags($new_instance['tctime']);
        $instance['tcnum'] = strip_tags($new_instance['tcnum']);
		$instance['tctitle'] = strip_tags($new_instance['tctitle']);
        return $instance;
    }
    function form($instance) {
        global $wpdb;
        $instance = wp_parse_args((array) $instance, array('tctime' => '60','tcnum' => '15','tctitle' => '读者排行'));
		$tctime = strip_tags($instance['tctime']);
        $tcnum = strip_tags($instance['tcnum']);
		$tctitle = strip_tags($instance['tctitle']);
?>
	<p><label for="<?php echo $this->get_field_id('tctime'); ?>">控制天数：<input id="<?php echo $this->get_field_id('tctime'); ?>" name="<?php echo $this->get_field_name('tctime'); ?>" type="text" value="<?php echo $tctime; ?>" /></label></p>
	<p><label for="<?php echo $this->get_field_id('tcnum'); ?>">显示数量：<input id="<?php echo $this->get_field_id('tcnum'); ?>" name="<?php echo $this->get_field_name('tcnum'); ?>" type="text" value="<?php echo $tcnum; ?>" /></label></p>
	<p><label for="<?php echo $this->get_field_id('tctitle'); ?>">自定义标题：<input id="<?php echo $this->get_field_id('tctitle'); ?>" name="<?php echo $this->get_field_name('tctitle'); ?>" type="text" value="<?php echo $tctitle; ?>" /></label></p>
	<input type="hidden" id="<?php echo $this->get_field_id('submit'); ?>" name="<?php echo $this->get_field_name('submit'); ?>" value="1" />
<?php
    }
}
?>