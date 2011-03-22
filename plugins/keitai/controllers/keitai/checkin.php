<?php defined('SYSPATH') or die('No direct script access.');
/**
 * keitai Controller
 * Generates KML with PlaceMarkers and Category Styles
 *
 * PHP version 5
 * LICENSE: This source file is subject to LGPL license 
 * that is available through the world-wide-web at the following URI:
 * http://www.gnu.org/copyleft/lesser.html
 * @author	   Ushahidi Team <team@ushahidi.com> 
 * @package    Ushahidi - http://source.ushahididev.com
 * @module	   keitai Controller	
 * @copyright  Ushahidi - http://www.ushahidi.com
 * @license    http://www.gnu.org/copyleft/lesser.html GNU Lesser General Public License (LGPL) 
* 
*/

class Checkin_Controller extends Keitai_Controller {

    public function __construct()
    {
        parent::__construct();
    }
	
    /*
     * GPS Checkin
     */
    public function index()
    {
        list($lat,$lon) = $this->_getlatlong();
	url::redirect("keitai?latlong=".$lat.",".$lon);
    }
	
    public function reports()
    {
        list($lat,$lon) = $this->_getlatlong();
	url::redirect("keitai/reports/submit?latitude=".$lat."&longitude=".$lon);
    }
	
    private function _getlatlong()
    {
        $lat = "";
	$lon = "";
        if (isset($_GET['lat']) AND isset($_GET['lon'])) {
	    $lat = $this->_dms2deg(mb_ereg_replace("%2B", '', $_GET['lat']));
	    $lon = $this->_dms2deg(mb_ereg_replace("%2B", '', $_GET['lon']));
	}
        if (isset($_GET['pos'])) {
	    if(preg_match("/^[NS][+-]?([0-9]{1,2}\.[0-9]{1,2}\.[0-9]{1,2}\.[0-9]{1,3})[EW][+-]?([0-9]{1,3}\.[0-9]{1,2}\.[0-9]{1,2}\.[0-9]{1,3})/", $_GET["pos"], $matches)){
	        $lat = $this->_dms2deg($matches[1]);
		$lon = $this->_dms2deg($matches[2]);
	    }
	}
        if (isset($_POST['ACTN']) AND isset($_POST['LAT']) AND isset($_POST['LON'])) {
	    $lat = $this->_dms2deg(mb_ereg_replace("[+-]", '', $_POST['LAT']));
	    $lon = $this->_dms2deg(mb_ereg_replace("[+-]", '', $_POST['LON']));
	}

	return array($lat, $lon);
    }

    private function _dms2deg($dms)
    {
        $d = explode('.', $dms);
        return sprintf("%0.6f", $deg = $d[0] + ($d[1] / 60.0) + ($d[2] / 3600.0) + ($d[3] / 360000.0));
        #return $dms;
    }
}
