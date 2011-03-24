<?php defined('SYSPATH') or die('No direct script access.');
/**
 * Trusted Web Repoters Hook - Load All Events
 *
 * PHP version 5
 * LICENSE: This source file is subject to LGPL license 
 * that is available through the world-wide-web at the following URI:
 * http://www.gnu.org/copyleft/lesser.html
 * @author	   Ushahidi Team <team@ushahidi.com> 
 * @package	   Ushahidi - http://source.ushahididev.com
 * @copyright  Ushahidi - http://www.ushahidi.com
 * @license	   http://www.gnu.org/copyleft/lesser.html GNU Lesser General Public License (LGPL) 
 */

class trustedwebreporters {
	/**
	 * Registers the main event add method
	 */
	public function __construct()
	{	
		// Hook into routing
		Event::add('system.pre_controller', array($this, 'add'));
	}
	
	/**
	 * Adds all the events to the main Ushahidi application
	 */
	public function add()
	{
		// Add a Sub-Nav Link
		Event::add('ushahidi_action.nav_admin_manage', array($this, '_trustedwr_link'));
		
		// Capture New Report
		Event::add('ushahidi_action.report_add', array($this, '_trustedwr_report'));
		
		// Tag Reports with Trusted Web Reporters in List
		Event::add('ushahidi_action.report_extra_admin', array($this, '_trustedwr_report_tag'));
	}
	
	public function _trustedwr_link()
	{
		$this_sub_page = Event::$data;
		echo ($this_sub_page == "trustedwebreporters") ? "Web Reporters" : "<a href=\"".url::site()."admin/trustedwebreporters\">Web Reporters</a>";
	}
	
	public function _trustedwr_report()
	{
		$incident = Event::$data;
		
		//Retrieve Repoter Info
		$orig_reporter = $incident->incident_person;
		$trusted_email = $orig_reporter->person_email;
		
		if ($trusted_email)
		{
			$reporter = ORM::factory('trustedwebreporter')
				->where('trusted_email', $trusted_email)
				->where('trusted_active', 1)
				->find();
			if ($reporter->loaded)
			{
				$reporter_log = ORM::factory('trustedwebreporter_log');
				$reporter_log->incident_id = $incident->id;
				$reporter_log->trustedwebreporter_id = $reporter->id;
				$reporter_log->ip_address = $_SERVER['REMOTE_ADDR'];
				$reporter_log->trusted_log_date = date("Y-m-d H:i:s",time());
				$reporter_log->save();
				
				// Update Incident
				$incident->incident_active = 1;
				$incident->save();
			}
		}
	}
	
	public function _trustedwr_report_tag()
	{
		echo '<div style="clear:both;"></div><div style="float:left;margin-top:4px;padding:2px;border:1px solid #ccc;background-color:#ffffcc;color:#999;">';
		echo Kohana::lang('trustedwebreporter.trusted_web_reporter');
		echo '</div><div style="clear:both;"></div>';
	}
}
new trustedwebreporters;