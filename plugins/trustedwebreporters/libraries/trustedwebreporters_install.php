<?php
/**
 * Performs install/uninstall methods for the trusted web reporters plugin
 *
 * PHP version 5
 * LICENSE: This source file is subject to LGPL license 
 * that is available through the world-wide-web at the following URI:
 * http://www.gnu.org/copyleft/lesser.html
 * @author	   Ushahidi Team <team@ushahidi.com> 
 * @package    Ushahidi - http://source.ushahididev.com
 * @module	   trusted web reporters Installer
 * @copyright  Ushahidi - http://www.ushahidi.com
 * @license    http://www.gnu.org/copyleft/lesser.html GNU Lesser General Public License (LGPL) 
 */

class Trustedwebreporters_Install {

	/**
	 * Constructor to load the shared database library
	 */
	public function __construct()
	{
		$this->db = Database::instance();
	}

	/**
	 * Creates the required database tables for the trusted web reporters plugin
	 */
	public function run_install()
	{
		// Create the database tables.
		// Also include table_prefix in name
		$this->db->query('
			CREATE TABLE IF NOT EXISTS `'.Kohana::config('database.default.table_prefix').'trustedwebreporter` (
					`id` int(11) unsigned NOT NULL AUTO_INCREMENT,
					`trusted_first_name` varchar(100) DEFAULT NULL,
					`trusted_last_name` varchar(100) DEFAULT NULL,
					`trusted_email` varchar(150) NOT NULL,
					`trusted_active` tinyint(4) NOT NULL DEFAULT \'1\',
					`trusted_date` datetime NOT NULL,
					PRIMARY KEY (`id`),
					UNIQUE KEY `trusted_email` (`trusted_email`)
				) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1');
				
		$this->db->query('
			CREATE TABLE IF NOT EXISTS `'.Kohana::config('database.default.table_prefix').'trustedwebreporter_log` (
				`id` int(11) unsigned NOT NULL AUTO_INCREMENT,
				`incident_id` int(11) NOT NULL,
				`trustedwebreporter_id` int(11) NOT NULL,
				`ip_address` varchar(30) DEFAULT NULL,
				`trusted_log_date` datetime NOT NULL,
				PRIMARY KEY (`id`)
			) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1');		
		
	}

	/**
	 * Deletes the database tables for the trusted web reporters module
	 */
	public function uninstall()
	{
		$this->db->query('DROP TABLE `'.Kohana::config('database.default.table_prefix').'trusted_web_reporter`');
		$this->db->query('DROP TABLE `'.Kohana::config('database.default.table_prefix').'trusted_web_reporter_log`');
	}
}