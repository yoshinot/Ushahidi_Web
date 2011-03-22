
	<h2 >レポートの投稿</h2>

<?php if ($form['latitude'] && $form['longitude']) { ?>
▼現在地のﾚﾎﾟｰﾄ投稿<br>
<div style="clear:both;text-align:center;" align="center"><center><a href="http://www.google.co.jp/m/local?q=<?php echo $form['latitude'].",".$form['longitude'];?>&z=14"><img src="http://maps.google.com/maps/api/staticmap?center=<?php echo $form['latitude'].",".$form['longitude'];?>&zoom=14&size=230x100&format=gif&maptype=roadmap&sensor=false&markers=<?php echo $form['latitude'].",".$form['longitude'];?>" border="0"></a></center></div>
<hr size="1" noshade>
<?php } else { ?>
<?php if ($device == 'd') { ?>現在地のレポート投稿(<a href="http://w1m.docomo.ne.jp/cp/iarea?ecode=OPENAREACODE&msn=OPENAREAKEY&nl=<?php echo url::site()."keitai/checkin/reports" ?>&posinfo=2">簡易</a>/<a href="<?php echo url::site()."keitai/checkin/reports" ?>?guid=ON" lcs>GPS</a>)<br><?php } ?>
<?php if ($device == 'a') { ?><a href="device:gpsone?url=<?php echo url::site()."keitai/checkin/reports" ?>&amp;ver=1&amp;datum=0&amp;unit=0">現在地のレポート投稿</a><br><?php } ?>
<?php if ($device == 's') { ?><a href="location:auto?url=<?php echo url::site()."keitai/checkin/reports" ?>">現在地のレポート投稿</a><br><?php } ?>
<br>
<?php } ?>
	<?php print form::open(NULL, array('enctype' => 'multipart/form-data', 'id' => 'reportForm', 'name' => 'reportForm')); ?>
	<input type="hidden" name="latitude" id="latitude" value="<?php echo $form['latitude']; ?>">
	<input type="hidden" name="longitude" id="longitude" value="<?php echo $form['longitude']; ?>">
	
		
		<?php
			if ($form_error) {
		?>
		<!-- red-box -->
		
			<h3>エラーです</h3>
			<ul>
				<?php
					foreach ($errors as $error_item => $error_description)
					{
						// print "<li>" . $error_description . "</li>";
						print ( ! $error_description) ? '' : "<li>" . $error_description . "</li>";
					}
				?>
			</ul>
		
		<?php
			}
		?>	
	
		
			<h4><?php echo Kohana::lang('ui_main.reports_title'); ?></h4>
			<?php print form::input('incident_title', $form['incident_title'], ' '); ?>
		
		
		
			<h4><?php echo Kohana::lang('ui_main.reports_description'); ?></h4>
			<?php print form::textarea('incident_description', $form['incident_description'], ' rows="10"  ') ?>
		
		
		
			<h4><?php echo Kohana::lang('ui_main.reports_date'); ?></h4>
			<?php
			// Month Array
			for ($i=1; $i <= 12 ; $i++) { 
				$month_array[sprintf("%02d", $i)] = date("m", mktime(0, 0, 0, $i, 10));	 // Add Leading Zero
			}
			// Day Array
			for ($i=1; $i <= 31 ; $i++) { 
				$day_array[sprintf("%02d", $i)] = sprintf("%02d", $i);	 // Add Leading Zero
			}
			// Year Array
			$year_now = date('Y');
			for ($i=-2; $i <= 0 ; $i++) {
				$this_year = $year_now + $i;
				$year_array[$this_year] = $this_year;
			}
			print form::dropdown('incident_year',$year_array,$form['incident_year']);
			print '/';
			print form::dropdown('incident_month',$month_array,$form['incident_month']);
			print '/';
			print form::dropdown('incident_day',$day_array,$form['incident_day']);
			

			?>
		
		
		
			<h4><?php echo Kohana::lang('ui_main.reports_time'); ?></h4>
			<?php
				for ($i=1; $i <= 12 ; $i++) { 
					$hour_array[sprintf("%02d", $i)] = sprintf("%02d", $i);	 // Add Leading Zero
				}
				for ($j=0; $j <= 59 ; $j++) { 
					$minute_array[sprintf("%02d", $j)] = sprintf("%02d", $j);	// Add Leading Zero
				}
				$ampm_array = array('pm'=>'pm','am'=>'am');
				print form::dropdown('incident_hour',$hour_array,$form['incident_hour']);
				print '<span >:</span>';
				print form::dropdown('incident_minute',$minute_array,$form['incident_minute']);
				print '<span >:</span>';
				print form::dropdown('incident_ampm',$ampm_array,$form['incident_ampm']);
			?>
		
		
		
			<h4><?php echo Kohana::lang('ui_main.reports_categories'); ?> (Select All That Apply)</h4>
			
				<?php
				$selected_categories = array();
     if (!empty($form['incident_category']) && is_array($form['incident_category'])) {
					$selected_categories = $form['incident_category'];
				}
				$columns = 1;
				echo category::tree($categories, $selected_categories, 'incident_category', $columns);
				?>
			
		
			<h4>場所</h4>
			地名を選択してください<br>
			<?php print form::dropdown('select_city',$cities,'', '  '); ?><br>
			もしくは場所を記入してください<br>
			<?php print form::input('location_name', $form['location_name'], ' '); ?><br>

		<br>
			<input name="submit" type="submit" value="<?php echo Kohana::lang('ui_main.reports_btn_submit'); ?>"  /> 
			<br>
		
		
	
	</form>

