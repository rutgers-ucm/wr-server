<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Users extends MY_Controller {

	/**
	* Initialize the database classes and class attributes.
	*
	* @post 	: prevents caching
	*
	**/
	public function __construct() {
		parent::__construct();

		// load db model
		$this->load->model('users_model');
	}

	/**
	* Retrieve a page of users (approved/unapproved).
	*
	* @post : returns a JSON object with links to next queries/pages and pages themselves
	*
	* @param	: bool		: approval	: the approval status to filter for
	* @param	: int		: page		: the specific page of users to load
	* @param	: int		: n			: the number of items to return per page
	* @return	: array 	: array with user objects
	**/
	public function index() {
		// access vars
		$has_approv = ($this->input->get('approval') != NULL);
		$approv_str = ($has_approv === true) ? $this->input->get('approval') : false;
		$approval = ($approv_str === 'true');

		$page = ((int)$this->input->get('page') >= 0) ? (int)($this->input->get('page')) : 0;
		$n = ((int)$this->input->get('n') > 0) ? (int)($this->input->get('n')) : 25;

		// figure out skips
		$num_convos = $this->users_model->count($approval);
		$total_num_pages = ceil($num_convos / $n);

		// fetch users
		if ($has_approv === true) {
			$users = $this->users_model->get_page_with_approval($approval, $page, $n);
		} else {
			$users = $this->users_model->get_page($page, $n);
		}
		$users = array_map(array($this, '_strip_pw'), $users);

		// create next page link
		$next_str = null;
		if (($page + 1) <= $total_num_pages) {
			$next_str = "/users?page=".($page + 1)."&n=".$n."&approval=".$approv_str;
		}

		//  create prev page link
		$prev_str = null;
		if ($page > 0) {
			$prev_str = "/users?page=".($page - 1)."&n=".$n."&approval=".$approv_str;
		}

		$data = array(
			"per_page"		=> $n,
			"current_page"	=> $page,
			"next_page_url" => $next_str,
			"prev_page_url" => $prev_str,
			"data" 			=> $users
		);

		$this->_send_json($data);
	}

	/**
	* Strips the password from the given user object.
	*
	* @post 	: the user object will be copied, and the 'password' key removed.
	*
	* @param	: array 	: user	: the user object to strip the pw from
	* @return	: array 	: the copied user object sans pw
	**/
	private function _strip_pw($user) {
		return array_diff_key($user, array("password" => ''));
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */
