<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

require_once 'editable.php';

class Admin extends Editable {
	function __construct()
	{
		parent::__construct();
		$this->load->database();
		$this->load->helper(array('form', 'url'));
		$this->load->library('session');
	}

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -  
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in 
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see http://codeigniter.com/user_guide/general/urls.html
	 */
	public function index()
	{		
		$this->login();
	}
	public function login()
	{		
		$this->prepareView('admin/login');
	}
	
	public function logout(){
		$this->session->set_userdata(
				array('isadmin'=>FALSE,
                                      'login'=>FALSE
				));
		redirect('welcome');
	}
	
	public function logining(){
		$this->db->select('login');
		$login = $_POST['user'];
		$user = $this->db->get_where('user',
			array('login' => $login,
				'password' => $_POST['pass']))->result();
		if(sizeof($user) > 0){
			$this->load->library('session');
			$this->session->set_userdata(
				array('isadmin'=>strcmp($login,'admin')==0,
						  'login'=>$login
				));
			redirect('subdomain/all');
		}
		else
			redirect('admin/login');
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */
