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
<?php
  function googleAnalyticsGetImageUrl() {
    $GA_ACCOUNT = "MO-22075443-2";
    $GA_PIXEL = "/ga.php";
    $url = "";
    $url .= $GA_PIXEL . "?";
    $url .= "utmac=" . $GA_ACCOUNT;
    $url .= "&utmn=" . rand(0, 0x7fffffff);
    $query = $_SERVER["QUERY_STRING"];
    $path = $_SERVER["REQUEST_URI"];
    if (empty($_SERVER["HTTP_REFERER"])) {
      $referer = "-";
    }else{
      $referer = $_SERVER["HTTP_REFERER"];
    }
    $url .= "&utmr=" . urlencode($referer);
    if (!empty($path)) {
      $url .= "&utmp=" . urlencode($path);
    }
    $url .= "&guid=ON";
    return str_replace("&", "&amp;", $url);
  }
?>
<a name="top" id="top"></a>
<div><img src="<?php echo url::base(); ?>/media/img/logo_m.gif" alt="<?php echo $site_name . ': ' . $site_tagline; ?>" /></div>
<div style="clear:both;text-align:right;" align="right"><right><form method="get" id="search" action="/ushahidi/index.php/keitai/search/"><input type="hidden"  name="l" value="ja_JP" /><input type="text" name="k" value="" class="text" size="14" /><input type="submit" name="b" class="searchbtn" value="検索" /></form></right></div>
[0]<a href="<?php echo url::site(); ?>keitai<?php if ($latlong) { echo "?latlong=".$latlong; } ?>" accesskey="0">TOP</a><?php echo $breadcrumbs; ?><br>
<hr size="1" noshade>
