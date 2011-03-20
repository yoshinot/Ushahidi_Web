<h2><a href="<?php echo url::site()."keitai/reports/submit/" ?>">レポートの投稿</a></h2>
	<h2>最新レポート</h2>
		<ul>
			<?php
			foreach ($incidents as $incident)
			{
				$incident_date = $incident->incident_date;
				$incident_date = date('Y/m/d', strtotime($incident->incident_date));
				echo "<li><strong><a href=\"".url::site()."keitai/reports/view/".$incident->id."\">".$incident->incident_title."</a></strong>";
				echo "&nbsp;&nbsp;<i>$incident_date</i></li>";
			}
			?>
		</ul>
	<h2>ニュース</h2>
		<ul>
			<?php
			foreach ($feeds as $feed)
			{
				$feed_date = date('Y/m/d', strtotime($feed->item_date));
				echo "<li><strong><a href=\"http://www.google.co.jp/gwt/x?u=".urlencode ($feed->item_link)."\">".$feed->item_title."</a></strong>";
				//echo "&nbsp;&nbsp;<i>$incident_date</i></li>";
				echo "</li>";
			}
		?>
		</ul>
<h2>カテゴリ別レポート</h2>
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
			echo '<h2 ><a href="'.url::site().'keitai/reports/index/'.$category.'">'.$category_image.$category_title.'</a>('.$category_count.')</h2>';
		}
		else
		{
			echo '<h2>'.$category_image.$category_title.'</h2>';
		}
		
		// Get Children
		foreach ($category_info[4] as $child => $child_info)
		{
			$child_title = $child_info[0];
			$child_color = $child_info[1];
			$child_image = '';
			$child_count = $child_info[3];
			$color_css = 'class="swatch" style="background-color:#'.$child_color.'"';
			echo '<h2><a href="'.url::site().'keitai/reports/index/'.$child.'">'.$child_image.$child_title.'</a>('.$child_count.')</h2>';
		}
		echo '</div>';
	}
	?>				

