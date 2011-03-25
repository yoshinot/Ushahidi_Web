<?php defined('SYSPATH') or die('No direct script access.');
/**
 * TrustedWebReporters Controller
 *
 * PHP version 5
 * LICENSE: This source file is subject to LGPL license 
 * that is available through the world-wide-web at the following URI:
 * http://www.gnu.org/copyleft/lesser.html
 * @author	   Ushahidi Team <team@ushahidi.com> 
 * @package	   Ushahidi - http://source.ushahididev.com
 * @module	   TrustedWebReporters Controller	
 * @copyright  Ushahidi - http://www.ushahidi.com
 * @license	   http://www.gnu.org/copyleft/lesser.html GNU Lesser General Public License (LGPL) 
* 
*/

class TrustedWebReporters_Controller extends Admin_Controller {
	
	public function __construct()
	{
		parent::__construct();
		$this->template->this_page = 'manage';
	}
	
	public function index()
	{
		$this->template->content = new View('admin/trustedwebreporters');
		$this->template->js = new View('admin/trustedwebreporters_js');
		
		// setup and initialize form field names
		$form = array
		(
			'action' => '',
			'trustedwebreporter_id' => '',
			'trusted_first_name' => '',
			'trusted_last_name' => '',
			'trusted_email' => '',
			'trusted_active' => ''
		);
		
		// copy the form as errors, so the errors will be stored with keys corresponding to the form field names
		$errors = $form;
		$form_error = FALSE;
		$form_saved = FALSE;
		$form_action = "";
		
		if( $_POST )
		{
			//print_r($_POST);
			$post = Validation::factory( $_POST );

			 //	 Add some filters
			$post->pre_filter('trim', TRUE);

			if ($post->action == 'a')		// Add Action
			{
				// Add some rules, the input field, followed by a list of checks, carried out in order
				$post->add_rules('trusted_first_name', 'length[1,100]');
				$post->add_rules('trusted_last_name', 'length[1,100]');
				$post->add_rules('trusted_email','required','email','length[4,150]');
				
				$post->add_callbacks('trusted_email', array($this,'email_exists_chk'));
			}

			if( $post->validate() )
			{
				$id = $post->trustedwebreporter_id;

				$reporter = new Trustedwebreporter_Model($id);
				if ( $post->action == 'd' )
				{					// Delete Action
					$reporter->delete( $id );
					$form_saved = TRUE;
					$form_action = strtoupper(Kohana::lang('ui_admin.deleted'));
				}
				elseif($post->action == 'v') // Active/Inactive Action
				{
					if ($reporter->loaded==true)
					{
						if ($reporter->trusted_active == 1)
						{
							$reporter->trusted_active = 0;
						}
						else
						{
							$reporter->trusted_active = 1;
						}
						$reporter->save();
						$form_saved = TRUE;
						$form_action = strtoupper(Kohana::lang('ui_admin.modified'));
					}
				}
				else // Save Action
				{
					// SAVE Reporter
					$reporter->trusted_first_name = $post->trusted_first_name;
					$reporter->trusted_last_name = $post->trusted_last_name;
					$reporter->trusted_email = $post->trusted_email;
					if ( ! $reporter->loaded)
					{
						$reporter->trusted_date = date("Y-m-d H:i:s",time());
					}
					$reporter->save();
					$form_saved = TRUE;
					$form_action = strtoupper(Kohana::lang('ui_admin.added_edited'));
				}

			}
			else
			{
				// repopulate the form fields
				$form = arr::overwrite($form, $post->as_array());

			   // populate the error fields, if any
				$errors = arr::overwrite($errors,
					$post->errors('trustedwebreporter'));
				$form_error = TRUE;
			}
		}
		
		// Pagination
		$pagination = new Pagination(array(
				'query_string' => 'page',
				'items_per_page' => (int) Kohana::config('settings.items_per_page_admin'),
				'total_items'  => ORM::factory('trustedwebreporter')->count_all()
			));

		$reporters = ORM::factory('trustedwebreporter')
			->orderby('trusted_email', 'asc')
			->find_all((int) Kohana::config('settings.items_per_page_admin'), $pagination->sql_offset);
		
		$this->template->content->form = $form;
		$this->template->content->form_error = $form_error;
		$this->template->content->form_saved = $form_saved;
		$this->template->content->form_action = $form_action;
		$this->template->content->errors = $errors;
		$this->template->content->pagination = $pagination;
		$this->template->content->total_items = $pagination->total_items;
		$this->template->content->reporters = $reporters;
	}
	
	public function email_exists_chk( Validation $post )
	{
		if (array_key_exists('trusted_email',$post->errors()))
			return;
		
		$reporter = ORM::factory('trustedwebreporter')
			->where('id != \''.$post->trustedwebreporter_id.'\'')
			->where('trusted_email', $post->trusted_email)
			->find();
		if ($reporter->loaded)
		{
			$post->add_error('trusted_email','exists');
		}	
	}
}