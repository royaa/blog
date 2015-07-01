<?php
// 定义字符串长度
function inlo_substr($string, $length, $replace = '…') {
	if (strlen ( $string ) < $length) {
		return $string;
	} else {
		$char = ord ( $string [$length - 1] );
		if ($char >= 224 && $char <= 239) {
			$string = substr ( $string, 0, $length - 1 );
		} else {
			$char = ord ( $string [$length - 2] );
			if ($char >= 224 && $char <= 239) {
				$string = substr ( $string, 0, $length - 2 );
			} else {
				$string = substr ( $string, 0, $length );
			}
		}
	}	
	$starts = $start_str = $ends = array ();
	preg_match_all ( '/<\w+[^>]*>?/', $string, $starts, PREG_OFFSET_CAPTURE );
	preg_match_all ( '/<\/\w+>/', $string, $ends, PREG_OFFSET_CAPTURE );
	$cut_pos = 0;
	$last_str = '';
	if (! empty ( $starts [0] )) {
		$starts = array_reverse ( $starts [0] );
		if (! empty ( $ends [0] )) {
			$ends = $ends [0];
		}
		foreach ( $starts as $sk => $s ) {
			$auto = false;
			if ($auto != false && $auto = strripos ( $s [0], '/>' )) {
				if ($cut_pos < $auto) {
					$cut_pos = $s [1];
					$last_str = $s [0];
					unset ( $starts [$sk] );
				}
			} else {
				preg_match ( '/<(\w+).*>?/', $s [0], $start_str );
				if (! empty ( $ends )) {
					foreach ( $ends as $ek => $e ) {
						$end_str = trim ( $e [0], '</>' );
						if ($end_str == $start_str [1] && $e [1] > $s [1]) {
							if ($cut_pos < $e [1]) {
								$cut_pos = $e [1];
								$last_str = $e [0];
							}
							unset ( $ends [$ek] );
							break;
						}
					}
				} else {
					$last_str = '';
					$cut_pos = $s [1];
				}
			}
		}
	}
	$res_str = substr ( $string, 0, $cut_pos ) . $last_str;
	$less_str = substr ( $string, strlen ( $res_str ) );
	$less_pos = strpos ( $less_str, '<' );
	if ($less_pos !== false) {
		$less_str = substr ( $less_str, 0, $less_pos );
	}
	$res_str .= $less_str . $replace;
	return $res_str;
}

?>
<?php
add_action ( 'admin_menu', 'inlo_theme_options' );
function inlo_theme_options() {
	add_theme_page ( 'INLODZ主题设置', 'INLODZ主题设置', 'edit_themes', basename ( __FILE__ ), 'inlo_theme_options_page' );
}
function inlo_theme_options_page() {
	if (! empty ( $_POST ['submit'] ) ) {
		$options_field = array( 'banner','notice','description', 'keyword','footer_text','footer_code','on_lazyload','on_flinks','sns_weibo','sns_email','sns_qq','sns_weixin','sns_facebook','sns_twitter','sns_feed' );
		$options = array();
		foreach ( $_POST as $field => $value ) {
			if ( isset($value) && in_array( $field, $options_field ) ) {
				$options [$field] = $value;
			}
		}
		$res = update_option( 'inlo_options', $options );
		if ($res) {
			echo '<div class="updated"><p><strong>恭喜！保存设置成功.</strong></p></div>';
		} else {
			echo '<div class="updated"><p><strong>噢！没有修改任何设置.</strong></p></div>';
		}
	}
	$options = get_option( 'inlo_options' );
?>
<div class="set-content">
	<h2>INLODZ主题设置　<span>设计：<a href="http://www.inlojv.com" target="_blank">INLOJV</a></span></h2>
	<div class="set-tabs">
		<ul>
			<li class="tab-first"><a href="javascript:;" class="set-base">基本设置</a></li>
			<li><a href="javascript:;" class="set-switch">开关设置</a></li>
		</ul>
	</div>
	<div class="clear">
	<div class="inlo-main">
		
		<form method="post">
		<?php settings_fields( 'inlo-settings' ); ?>
			<div id="set-base" class="set-tab">
			<div id="set-main">
				<div class="set-box">
					<h4 class="set-title">&raquo; 填写顶部横幅图片地址:</h4>
						<textarea name="banner" id="banner" class="large-text code" rows="1" cols="120"><?php echo $options ['banner']; ?></textarea>
				</div>
				<div class="set-box">
					<h4 class="set-title">&raquo; 填写网站公告:</h4>
						<textarea name="notice" id="notice" class="large-text code" rows="2" cols="120"><?php echo $options ['notice']; ?></textarea>
				</div>
				<div class="set-box">
					<h4 class="set-title">&raquo; 输入网站描述:（不超过200个字符）</h4>
						<textarea name="description" id="description" class="large-text code" rows="3" cols="120"><?php echo $options ['description']; ?></textarea>
				</div>
				<div class="set-box">
					<h4 class="set-title">&raquo; 输入网站关键词:（用英文逗号隔开，不超过100个字符）</h4>
						<textarea name="keyword" id="keyword" class="large-text code" rows="3" cols="80"><?php echo $options ['keyword']; ?></textarea>
				</div>
				<div class="set-box">
					<h4 class="set-title">&raquo; 加入footer.php的文字（如：外部链接、免责声明、文章归档等）:</h4>
						<textarea name="footer_text" id="footer_text" class="large-text code" rows="5" cols="320" placeholder="支持html标签"><?php echo stripcslashes ($options ['footer_text']); ?></textarea>
				</div>
				<div class="set-box">
					<h4 class="set-title">&raquo; 加入footer.php的代码（如：网站统计代码、自定义JS等）:</h4>
						<textarea name="footer_code" id="footer_code" class="large-text code" rows="5" cols="320" placeholder="所加入的代码会隐藏于前端footer.php"><?php echo stripcslashes ($options ['footer_code']); ?></textarea>
				</div>
				<div class="set-box">
					<h4 class="set-title">&raquo; 社交媒体:</h4>
						<textarea name="sns_weibo" id="sns_weibo" class="large-text code" rows="1" cols="320" placeholder="微博地址"><?php echo stripcslashes ($options ['sns_weibo']); ?></textarea>
						<textarea name="sns_email" id="sns_email" class="large-text code" rows="1" cols="320" placeholder="EMAIL地址"><?php echo stripcslashes ($options ['sns_email']); ?></textarea>
						<textarea name="sns_qq" id="sns_qq" class="large-text code" rows="1" cols="320" placeholder="QQ在线联系代码"><?php echo stripcslashes ($options ['sns_qq']); ?></textarea>
						<textarea name="sns_weixin" id="sns_weixin" class="large-text code" rows="1" cols="320" placeholder="微信地址"><?php echo stripcslashes ($options ['sns_weixin']); ?></textarea>
						<textarea name="sns_facebook" id="sns_facebook" class="large-text code" rows="1" cols="320" placeholder="Fackbook地址"><?php echo stripcslashes ($options ['sns_facebook']); ?></textarea>
						<textarea name="sns_twitter" id="sns_twitter" class="large-text code" rows="1" cols="320" placeholder="Twitter地址"><?php echo stripcslashes ($options ['sns_twitter']); ?></textarea>
						<textarea name="sns_feed" id="sns_feed" class="large-text code" rows="1" cols="320" placeholder="RSS地址"><?php echo stripcslashes ($options ['sns_feed']); ?></textarea>
				</div>
			</div>
			</div>
				
			<div id="set-switch" class="set-tab">
			<div id="set-main">
				<div class="set-box">
					<h4 class="set-title">&raquo; 是否开启首页缩略图延迟加载 ：
						<label><input type="radio" name="on_lazyload" value="N" <?php echo $options ['on_lazyload'] == 'N' ? 'checked="checked"' : null; ?> /> 否</label>
						<label><input type="radio" name="on_lazyload" value="Y" <?php echo empty( $options ['on_lazyload'] ) || $options ['on_lazyload'] == 'Y' ? 'checked="checked"' : null; ?> /> 是 </label> &nbsp; </h4>
				</div>
				<div class="set-box">
					<h4 class="set-title">&raquo; 是否在网站底部显示友情链接 ：
						<label><input type="radio" name="on_flinks" value="N" <?php echo $options ['on_flinks'] == 'N' ? 'checked="checked"' : null; ?> /> 否</label>
						<label><input type="radio" name="on_flinks" value="Y" <?php echo empty( $options ['on_flinks'] ) || $options ['on_flinks'] == 'Y' ? 'checked="checked"' : null; ?> /> 是 </label> &nbsp; </h4>
				</div>
			</div>			
			</div>
			
			<div class="set-save"><input type="submit" class="button-primary" name="submit" value="保存设置" /></div>
		</form>
	</div>
</div>
<script type="text/javascript">
jQuery(function($){
	$('.set-tabs li a').click(function(){
		var id = $(this).attr('class');
		$('.set-tab').hide();
		$('#'+id).show();
	});
});
</script>
<style type="text/css">
	.set-content h2 span{font-size:12px}
	.clear{clear:both}
	.inlo-main { margin-top: 10px; padding: 20px; background-color: #fafafa; border: 1px solid #e3e3e3; }	
	.set-title { color:#737F99}
	.set-box { padding:0 10px 10px; margin-bottom:30px;border:1px solid #e3e3e3;border-left: 5px solid #737F99;background-color:#f3f3f3}
	.set-save { margin: 20px auto 0; }
	.set-save .button-primary{ left:40%;position:relative;width:200px;height:30px;font-weight:bold;background:#737F99;border-color:#737F99;box-shadow:none;border-radius:0; }	
	.set-tabs {float:left;background-color:#fff;border:1px solid #ddd;margin-bottom:-1px}
	.set-tabs li {width:100px;float:left;text-align:center;font-size:15px}
	.set-tabs .tab-first {border-right:1px solid #aaa}
	.set-tabs li a {text-decoration:none;color:#111;font-weight:bold;outline:none}
	.set-tabs li a:hover {color:#4773b1}
	#set-switch {display:none}
</style>
<?php } ?>