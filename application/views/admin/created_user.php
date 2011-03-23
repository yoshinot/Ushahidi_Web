<?php 
/**
 * Edit User
 *
 * PHP version 5
 * LICENSE: This source file is subject to LGPL license 
 * that is available through the world-wide-web at the following URI:
 * http://www.gnu.org/copyleft/lesser.html
 * @author     Ushahidi Team <team@ushahidi.com> 
 * @package    Ushahidi - http://source.ushahididev.com
 * @module     Edit User View
 * @copyright  Ushahidi - http://www.ushahidi.com
 * @license    http://www.gnu.org/copyleft/lesser.html GNU Lesser General Public License (LGPL) 
 */
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title><?php echo Kohana::lang('ui_main.ushahidi_admin');?></title>
<link href="<?php echo url::base() ?>media/css/admin/login.css" rel="stylesheet" type="text/css" />
</head>

<body>
<div id="ushahidi_login_container">
    <div id="ushahidi_login_logo"><img src="<?php echo url::base() ?>media/img/admin/logo_login.gif" width="400" height="80" /></div>
    <div id="ushahidi_login">
      <table width="100%" border="0" cellspacing="3" cellpadding="4" background="" id="ushahidi_loginbox">
        <form method="POST" name="frm_login" style="line-height: 100%; margin-top: 0; margin-bottom: 0">     
			<div class="bg">
				<h2>
				    ユーザ作成
				</h2>
				<div class="report-form">			
					<!-- column -->		
					<div class="sms_holder">
					<div class="row">
					<h4><?php echo Kohana::lang('ui_main.create_user');?></h4>
					</div>
					<div class="row">
					<h4><?php echo Kohana::lang('ui_main.confirm_password');?></h4>
					</div>
					<div class="row">
              				<a href="<?php echo url::site().'login'?>">Login</a>
					</div>
					<div class="simple_border"></div>
				</div>
				<?php print form::close(); ?>
			</div>
	</table>
  </div>
</div>
</body>
</html>
