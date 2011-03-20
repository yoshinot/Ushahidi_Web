▼<a href="<?php echo url::site()."keitai/reports/submit/" ?>">ﾚﾎﾟｰﾄの投稿</a><br>
▼最新ﾚﾎﾟｰﾄ<br>
			<?php
			foreach ($incidents as $incident)
			{
				$incident_date = $incident->incident_date;
				$incident_date = date('Y/m/d', strtotime($incident->incident_date));
				echo "<a href=\"".url::site()."keitai/reports/view/".$incident->id."\">".$incident->incident_title."</a>";
				echo "&nbsp;&nbsp;$incident_date<br>";
			}
			?>
▼ﾆｭｰｽ<br>
			<?php
			foreach ($feeds as $feed)
			{
				$feed_date = date('Y/m/d', strtotime($feed->item_date));
				echo "<a href=\"http://www.google.co.jp/gwt/x?u=".urlencode ($feed->item_link)."\">".$feed->item_title."</a><br>";
			}
		?>
▼カテゴリ別レポート<br>
	<?php
	foreach ($categories as $category => $category_info)
	{
		$category_title = $category_info[0];
		$category_color = $category_info[1];
		$category_image = '';
		$category_count = $category_info[3];
		$color_css = 'class="swatch" style="background-color:#'.$category_color.'"';
		if (count($category_info[4]) == 0)
		{
			echo '<a href="'.url::site().'keitai/reports/index/'.$category.'">'.$category_image.$category_title.'</a>('.$category_count.')<br>';
		}
		else
		{
			echo ''.$category_image.$category_title.'<br>';
		}
		
		// Get Children
		foreach ($category_info[4] as $child => $child_info)
		{
			$child_title = $child_info[0];
			$child_color = $child_info[1];
			$child_image = '';
			$child_count = $child_info[3];
			$color_css = 'class="swatch" style="background-color:#'.$child_color.'"';
			echo '<a href="'.url::site().'keitai/reports/index/'.$child.'">'.$child_image.$child_title.'</a>('.$child_count.')';
		}
	}
	?>				

