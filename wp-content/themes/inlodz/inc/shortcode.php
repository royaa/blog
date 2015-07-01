<?php

////////////////////////////////////////// 本页可以添加短代码 ///////////////////////////////////////////////////

//普通高亮框
function normalbox($atts, $content=null, $code="") {
	$return = '<span class="normalbox" style="-moz-box-shadow:1px 1px 2px  #999 inset;-webkit-box-shadow:1px 1px 2px #999 inset;box-shadow:1px 1px 2px #999 inset;margin:0 2px 0 2px;border:1px solid #bbb;border-radius:3px;background-color:#fff;padding:0px 5px 1px 5px;text-shadow:0 1px 3px #999;text-align:center;font-size:14px;height-line:14px;">';
	$return .= $content;
	$return .= '</span>';
	return $return;
}
add_shortcode('normalbox' , 'normalbox' );

//蓝底高亮框
function bluebox($atts, $content=null, $code="") {
	$return = '<span class="bluebox" style="margin:0 2px 0 2px;border:1px solid #169FE6;border-radius:3px;background-color:#169FE6;color:#fff;padding:0px 5px 1px 5px;text-shadow:0 1px 3px #aaa;text-align:center;font-size:14px;height-line:14px;">';
	$return .= $content;
	$return .= '</span>';
	return $return;
}
add_shortcode('bluebox' , 'bluebox' );

//标题高亮框
function titlebox($atts, $content=null, $code="") {
	$return = '<div class="titlebox" style="background:#789;color:#FFF;text-align:center;font-size:16px;font-weight:bold;padding:5px 0;box-shadow:1px 1px 2px #565656;border-radius:4px;">';
	$return .= $content;
	$return .= '</div>';
	return $return;
}
add_shortcode('titlebox' , 'titlebox' );

//段落高亮框
function partbox($atts, $content=null, $code="") {
	$return = '<div class="partbox" style="margin:0;border-top:1px solid #ddd;border-bottom:1px solid #ddd;border-left:4px solid #169FE6;border-right:4px solid #169FE6;border-radius:5px;background-color:#fff;padding:5px 5px 5px 8px;height-line:14px;color:#333;text-shadow:0 1px 3px #999;">';
	$return .= $content;
	$return .= '</div>';
	return $return;
}
add_shortcode('partbox' , 'partbox' );

?>