<?php
if ($category AND $category->loaded)
{
	$category_id = $category->id;
	$color_css = 'class="swatch" style="background-color:#'.$category->category_color.'"';
	echo '<a href="#" accesskey="1">[1]'.$category->category_title.'</a><br>';
}
else
{
	$category_id = "";
}
if ($incidents->count())
{
	$page_no = (isset($_GET['page'])) ? $_GET['page'] : "";
	foreach ($incidents as $incident)
	{
		$incident_date = $incident->incident_date;
		$incident_date = date('Y/m/d', strtotime($incident->incident_date));
		$location_name = $incident->location_name;
		echo $incident->incident_title;
		echo "&nbsp;";
		echo "(<span class=\"location_name\">".$location_name."</span>) <br> $incident_date ";
        echo "<a href=\"".url::site()."keitai/reports/view/".$incident->id."?c=".$category_id."&p=".$page_no."\">[詳細]</a>";
		echo "<hr size='1' noshade>";
	}
}
else
{
	echo "ﾚﾎﾟｰﾄはありません";
}
?>
<?php echo $pagination; ?>
