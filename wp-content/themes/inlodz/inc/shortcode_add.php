<?php
//添加自定义编辑器按钮，注意单个QTags.addButton写入规则时不要回车换行
function inlo_short_code_buttons() {
    ?>
<script type="text/javascript">
    QTags.addButton( 'hr', 'hr', '\n<hr />\n', '' );
    QTags.addButton( 'nextpage', '分页', '<!--nextpage-->', '' );
    QTags.addButton( 'jv_normalbox', '普通高亮', '<span class="jv_normalbox">', '</span>' );
    QTags.addButton( 'jv_bluebox', '蓝底高亮', '<span class="jv_bluebox">', '</span>' );
    QTags.addButton( 'jv_partbox', '段落高亮', '<div class="jv_partbox">', '</div>' );
    QTags.addButton( 'jv_titlebox', '标题高亮', '<div class="jv_titlebox">', '</div>' );
	QTags.addButton( 'jv_pre', '普通pre', '<pre>','</pre>');
	QTags.addButton( 'jv_h_pre', '高亮pre', '<pre class="brush:bash">','</pre>');
	QTags.addButton( 'jv_h22', '22号小标题', '<p class="jv_h22">','</p>');
</script>
<?php
}
?>