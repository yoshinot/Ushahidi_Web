<div class="bg">
	<h2>
		<?php admin::manage_subtabs("trustedwebreporters"); ?>
	</h2>
	
	<?php
	if ($form_error) {
	?>
		<!-- red-box -->
		<div class="red-box">
			<h3><?php echo Kohana::lang('ui_main.error');?></h3>
			<ul>
			<?php
			foreach ($errors as $error_item => $error_description)
			{
				// print "<li>" . $error_description . "</li>";
				print (!$error_description) ? '' : "<li>" . $error_description . "</li>";
			}
			?>
			</ul>
		</div>
	<?php
	}

	if ($form_saved) {
	?>
		<!-- green-box -->
		<div class="green-box">
			<h3><?php echo Kohana::lang('ui_main.reporter_has_been');?> <?php echo $form_action; ?>!</h3>
		</div>
	<?php
	}
	?>
	
	
	<!-- tabs -->
	<div class="tabs">
		<!-- tabset -->
		<a name="add"></a>
		<ul class="tabset">
			<li><a href="#" class="active" onclick="show_addedit(true)"><?php echo Kohana::lang('ui_main.add_edit');?></a></li>
		</ul>
		<!-- tab -->
		<div class="tab" id="addedit" style="display:none">
			<?php print form::open(NULL,array('id' => 'twrMain',
			 	'name' => 'twrMain')); ?>
			<input type="hidden" id="trustedwebreporter_id" 
				name="trustedwebreporter_id" value="<?php echo $form['trustedwebreporter_id']; ?>" />
			<input type="hidden" name="action" 
				id="action" value="a"/>
			<div class="tab_form_item">
				<strong><?php echo Kohana::lang('ui_main.reporter_first_name');?>:</strong><br />
				<?php print form::input('trusted_first_name', $form['trusted_first_name'], 
				' class="text"'); ?>
			</div>
			<div class="tab_form_item">
				<strong><?php echo Kohana::lang('ui_main.reporter_last_name');?>:</strong><br />
				<?php print form::input('trusted_last_name', $form['trusted_last_name'], 
				' class="text"'); ?>
			</div>
			<div class="tab_form_item">
				<strong><?php echo Kohana::lang('ui_main.reporter_email');?>:</strong><br />
				<?php print form::input('trusted_email', $form['trusted_email'], 
				' class="text"'); ?>
			</div>				
			<div class="tab_form_item">
				&nbsp;<br />
				<input type="image" src="<?php echo url::base() ?>media/img/admin/btn-save.gif" class="save-rep-btn" />
			</div>
			<?php print form::close(); ?>			
		</div>
	</div>
	
	<!-- report-table -->
	<div class="report-form">
		<!-- report-table -->
		<?php print form::open(); ?>
			<input type="hidden" name="action" id="action" value="">
			<div class="table-holder">
				<table class="table">
					<thead>
						<tr>
							<th class="col-1">
								&nbsp;
							</th>
							<th class="col-2">
								Reporter
							</th>
							<th class="col-3">
								Reports
							</th>
							<th class="col-4">
								<?php echo Kohana::lang('ui_main.actions');?>
							</th>
						</tr>
					</thead>
					<tfoot>
						<tr class="foot">
							<td colspan="4">
								<?php // echo $pagination; ?>
							</td>
						</tr>
					</tfoot>
					<tbody>
						<?php
						if ($total_items == 0)
						{
						?>
							<tr>
								<td colspan="4" class="col">
									<h3>
										<?php echo Kohana::lang('ui_admin.no_result_display_msg');?>
									</h3>
								</td>
							</tr>
						<?php	
						}
						foreach ($reporters as $reporter)
						{
							$id = $reporter->id;
							$first_name = $reporter->trusted_first_name;
							$last_name = $reporter->trusted_last_name;
							$name = $first_name." ".$last_name;
							$email = $reporter->trusted_email;
							$active = $reporter->trusted_active;
							
							$report_count = $reporter->trustedwebreporter_log->count();
							?>
							<tr>
								<td class="col-1">
									&nbsp;
								</td>
								<td class="col-2">
									<?php echo $name; ?>
								</td>
								<td class="col-3">
									<?php echo $report_count; ?>
								</td>
								<td class="col-4" nowrap="nowrap">
									<ul>
										<li class="none-separator"><a href="#add" onClick="fillFields('<?php echo(rawurlencode($id)); ?>','<?php echo(rawurlencode($first_name)); ?>','<?php echo(rawurlencode($last_name)); ?>','<?php echo(rawurlencode($email)); ?>')"><?php echo Kohana::lang('ui_main.edit');?></a></li>
										<li><a href="javascript:twrAction('v','ACTIVATE/DEACTIVATE','<?php echo(rawurlencode($id)); ?>')"<?php if ($active) echo " class=\"status_yes\"" ?>><?php echo Kohana::lang('ui_main.active');?></a></li>
										<li><a href="javascript:twrAction('d','DELETE','<?php echo(rawurlencode($id)); ?>')" class="del"><?php echo Kohana::lang('ui_main.delete');?></a></li>
									</ul>
								</td>
							</tr>
							<?php
						}
						?>
					</tbody>
				</table>
			</div>
		<?php print form::close(); ?>
	</div>
</div>