<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="keywords" content="404,您要找的页面已经不存在" />
<meta name="description" content="您要找的页面已经不存在" />
<title>INLOJV - 404 Page Not Found</title>
<style type="text/css">
body{background:url('<?php bloginfo('template_directory'); ?>/img/404/404bg.jpg') no-repeat center center #1d1d1d;color:#eee;font-family:Corbel,Arial,Helvetica,sans-serif;font-size:13px}
#rocket{width:275px;height:375px;background:url('<?php bloginfo('template_directory'); ?>/img/404/404r.png') no-repeat;margin:60px auto 10px;position:relative}
.steam1,.steam2{position:absolute;bottom:78px;left:50px;width:80px;height:80px;background:url('<?php bloginfo('template_directory'); ?>/img/404/404f.png') no-repeat;opacity:.8}
.steam2{background-position:left bottom}
#404text{display:block;margin:0 auto;width:850px;font-family:'Century Gothic',Calibri,'Myriad Pro',Arial,Helvetica,sans-serif;text-align:center}
h1{color:#76d7fb;font-size:40px;text-shadow:3px 3px 0 #3d606d;white-space:nowrap}
h2{color:#9fe3fc;font-size:18px;font-weight:normal;padding-bottom:15px}
p.createdBy{font-size:15px;font-weight:normal;margin:50px;text-align:center;text-shadow:none}
a,a:visited{text-decoration:none;outline:0;border-bottom:1px dotted #97cae6;color:#97cae6}
a:hover{border:0}
</style>
</head>
<body style="text-align:center">
<div id="rocket"></div>
<div id="404text">
    <h1>404 - Page Not Found</h1>
    <h1>您要找的页面已经不存在，<a href="<?php bloginfo('url') ?>">点击返回首页</a></h1>
</div>
<script type="text/javascript" src="http://libs.baidu.com/jquery/1.4.3/jquery.min.js"></script>
<script type="text/javascript">
$(window).load(function(){function animSteam(){$('<span>',{className:'steam'+Math.floor(Math.random()*2+1),css:{marginLeft:-10+Math.floor(Math.random()*20)}}).appendTo('#rocket').animate({left:'-=58',bottom:'-=100'},120,function(){$(this).remove();setTimeout(animSteam,10)})}function moveRocket(){$('#rocket').animate({'left':'+=100'},5000).delay(1000).animate({'left':'-=100'},5000,function(){setTimeout(moveRocket,1000)})}moveRocket();animSteam()});
</script>
</body>
</html>