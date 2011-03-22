	<?php
	if ($incident->incident_verified == 1)
	{
		echo "[確認済み情報]<br>";
	}
	else
	{
		echo "[未確認情報]<br>";
	}
	?>
	<?php echo $incident->incident_title; ?><br>
<br>
場所:<?php echo $incident->location->location_name; ?> <br>
日時:<?php echo date('Y/m/d', strtotime($incident->incident_date)); ?> <br>
時間:<?php echo date('H:i', strtotime($incident->incident_date)); ?> <br>
<br>
<?php echo $incident->incident_description; ?><br>
<br>
<div style="clear:both;text-align:center;" align="center"><center><a href="http://www.google.co.jp/m/local?q=<?php echo $incident->location->latitude.",".$incident->location-> longitude;?>&z=14"><img src="http://maps.google.com/maps/api/staticmap?center=<?php echo $incident->location->latitude.",".$incident->location-> longitude;?>&zoom=14&size=230x100&format=gif&maptype=roadmap&sensor=false&markers=<?php echo $incident->location->latitude.",".$incident->location-> longitude;?>" border="0"></a></center></div>
