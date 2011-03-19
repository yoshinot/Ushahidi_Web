
     <?php
	if ($incident->incident_verified == 1)
	{

	}
	?>
	<br>
	<?php
	if ($incident->incident_verified == 1)
	{
		echo "[確認済み情報]";
	}
	else
	{
		echo "[未確認情報]";
	}
	?>
	<h2><?php echo $incident->incident_title; ?></h2>
	<ul >
		<li>
			<small>場所</small>: 
			<?php echo $incident->location->location_name; ?>
		</li>
		<li>
			<small>日時</small>: 
			<?php echo date('Y/M/j', strtotime($incident->incident_date)); ?>
		</li>
		<li>
			<small>時間</small>: 
			<?php echo date('H:i', strtotime($incident->incident_date)); ?>
		</li>		
		<li>
			<small>詳細</small>: <br />
			<?php echo $incident->incident_description; ?>
		</li>
	</ul>



