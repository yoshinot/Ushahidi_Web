<html> 
<head> 
<title><?php echo $site_name; ?></title> 
<style type="text/css"> 
<![CDATA[
  a:link{color:#808080;}
  a:focus{color:#a0a0a0;}
  a:visited{color:#808080;}
]]>
</style> 
</head> 
<body bgcolor="#ffffff" text="#000000">
<img src="<?php echo url::base(); ?>/media/img/logo_m.gif" alt="<?php echo $site_name . ': ' . $site_tagline; ?>" />
<hr size="1" noshade>
<a href="<?php echo url::site()."keitai"; ?>" accesskey="0">[0]TOP</a><?php echo $breadcrumbs; ?><br>
<form method="get" id="search" action="/ushahidi/index.php/keitai/search/"><input type="hidden"  name="l" value="ja_JP" /><input type="text" name="k" value="" class="text" /><input type="submit" name="b" class="searchbtn" value="検索" /></form>


