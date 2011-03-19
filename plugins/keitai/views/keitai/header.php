<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title><?php echo $site_name; ?></title>
</head>

<body>
<h1><?php echo $site_name; ?></h1>

<a href="<?php echo url::site()."keitai"; ?>"> Home</a><?php echo $breadcrumbs; ?>
<form method="get" id="search" action="/ushahidi/index.php/keitai/search/"><input type="hidden"  name="l" value="ja_JP" /><input type="text" name="k" value="" class="text" /><input type="submit" name="b" class="searchbtn" value="検索" /></form>
<hr>

