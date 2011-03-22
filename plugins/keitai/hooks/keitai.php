<?php defined('SYSPATH') or die('No direct script access.');
/**
 * Mobile Hook
 * Determines if this is a mobile browser and if so performs the necessary
 * redirects
 *
 * PHP version 5
 * LICENSE: This source file is subject to LGPL license 
 * that is available through the world-wide-web at the following URI:
 * http://www.gnu.org/copyleft/lesser.html
 * @author	   Ushahidi Team <team@ushahidi.com> 
 * @package    Ushahidi - http://source.ushahididev.com
 * @module	   Mobile Hoook
 * @copyright  Ushahidi - http://www.ushahidi.com
 * @license    http://www.gnu.org/copyleft/lesser.html GNU Lesser General Public License (LGPL) 
 */
require_once('Net/UserAgent/Mobile.php');
class keitai {
	
	/**
	 * Registers the main event add method
	 */
	public function __construct()
	{
		// Hook into routing
		Event::add('system.pre_controller', array($this, 'add'));
		Event::add('system.display', array($this, 'display'));

		header('Content-Type: text/html; charset=Shift_JIS');
	}
	
	/**
	 * Adds all the events to the main Ushahidi application
	 */
	public function add()
	{
		$session = Session::instance();
		// Has user switched to Full Website?
		if (isset($_GET['full']) AND $_GET['full'] == 1)
		{
			// Create the Full website session
			$session->set('full', 1);
		}

		if ( ! $session->get('full') )
		{
			// If Mobile Configure Mobile Settings
			if(isset($_SERVER['HTTP_USER_AGENT']) AND $this->_is_keitai()
				AND strrpos(url::current(), "k") === FALSE
				AND Router::$controller != 'api') 
			{
				// Only add the events if we are on that controller
				url::redirect(url::base()."k");
			}
		}
	}

	/**
	 * Browser detection
	 */
	private function _is_keitai()
	{
        $agent = Net_UserAgent_Mobile::singleton(); 
        switch( true )
        {
          case ($agent->isDoCoMo()):   // DoCoMoかどうか
            return true;
            if( $agent->isFOMA() )
              return true;
            break;
          case ($agent->isVodafone()): // softbankかどうか
            return true;
            if( $agent->isType3GC() )
              return true;
            break;
          case ($agent->isEZweb()):    // ezwebかどうか
            return true;
            if( $agent->isWIN() )
              return true;
            break;
          default:
            return false;
            break;
        }
	}

	public function display()
	{
	    Event::$data = mb_convert_encoding(Event::$data, 'SJIS', 'UTF-8');
	}
}

new keitai;
