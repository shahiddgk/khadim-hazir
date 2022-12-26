<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

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
	 * @see https://codeigniter.com/userguide3/general/urls.html
	 */
	function __construct() {
		parent:: __construct();
		$this->load->library('session');
		if($this->session->userdata('language')){
			$this->language = $this->session->userdata('language');
			$this->lang->load($this->language.'_lang', 'english');
		}
		else if($this->language = 'urd')
		{
			$this->lang->load('urd_lang', 'english');
			$this->session->set_userdata('language', 'urd');
		}
		else{
			$this->language = 'arb';
			$this->lang->load('arb_lang', 'english');
			$this->session->set_userdata('language', 'arb');
		}
		
	}
	
	// Loading home page on front end.
	public function index($subcate='') {
	    
	   // $this->load->view('front/under-construction');
	    
		// $data['categories'] = $this->common_model->select_where("*", "categories", array('language'=>$this->language));

		$data['category'] = $this->common_model->select_all("*", "categories");

		foreach($data['category']->result() as $row) {
			$data['categories'][$row->category_id][$row->language]['name'] = $row->name; 
			$data['categories'][$row->category_id][$row->language]['category_id'] = $row->category_id; 
			$data['categories'][$row->category_id][$row->language]['image'] = $row->image; 
		}

		$data['subcategories']  = $this->common_model->select_where_ASC_DESC("table_id, name, image_name, region_id", "brands", array('language'=>$this->language), "priority", "ASC");
		$data['subname'] = "";
		if($subcate!=""){
			$data['subname'] = $this->common_model->select_single_field("name" ,"brands", array('region_id'=>$subcate, 'language'=>$this->language));
		}
		
		$data['subcateid'] = $subcate;
		//if user not logged in then registraiton popup will show else payment popup will show up.
		$data['popup'] = '';
		if($this->session->userdata('user_logged_in') && $subcate!=''){
			if($this->session->userdata('paymentstatus')=='unpaid'){
				$data['popup'] = 'subcription';
			}
		}
		else if($subcate!=''){
			$data['popup'] = 'registration';
		}
		$this->load->view('front/header');
		$this->load->view('front/home', $data);
		$this->load->view('front/footer');
	}

	public function set_session($lang=null){
		if($lang!=""){
			$this->session->set_userdata('language', $lang);
		}
	}

	public function subCategory($id) {
		
		$response = $this->common_model->select_where("*", "sub_categories", array('category_id'=>$id)); 
		if($response->num_rows()>0) {
			foreach($response->result() as $row) {
				$data['sub_categories'][$row->sub_id][$row->language]['name'] = $row->name; 
				$data['sub_categories'][$row->sub_id][$row->language]['sub_id'] = $row->sub_id; 
				$data['sub_categories'][$row->sub_id][$row->language]['image'] = $row->image; 
			}
		}
		else{
			$data = array();
		}
			
		$this->load->view('front/header');
		$this->load->view('front/sub_category', $data);
		$this->load->view('front/footer');
		
	}

	public function create_user() {
		$data['name']= $this->input->post('full_name');
		$data['email']= $this->input->post('email');
		$data['phone_no']= $this->input->post('phone_no');
		$data['password']= sha1($this->input->post('password'));
		$data['user_type']= $this->input->post('user_type');
		$result = $this->common_model->insert_array('users', $data);
		if($result){
			$this->session->set_flashdata('flash_message', 'User Registered successfully.');
			redirect('/', 'refresh');
		}
	}

	public function login_user() {
	
		$username	=	$this->input->post('email');
		$password	=	$this->input->post('password');
			
		$data['login'] = $this->common_model->select_where("*","users", array('email'=>$username,'password'=>sha1($password)));
		
		if($data['login']->num_rows()>0){
			
		// if($this->input->post('rememberme')=='on')   
		// {
		// 	$cookieUsername = array(
		// 		'name'   => 'user',
		// 		'value'  => $username,
		// 		'expire' => time()+1000,
		// 		'path'   => '/',
		// 		'secure' => false
		// 	);
		// 	$cookiePassword = array(
		// 		'name'   => 'pass',
		// 		'value'  => $password,
		// 		'expire' => time()+1000,
		// 		'path'   => '/',
		// 		'secure' => false
		// 	);
		// 	$check_rem = array(
		// 		'name'   => 'check_rem',
		// 		'value'  => 1,
		// 		'expire' => time()+1000,
		// 		'path'   => '/',
		// 		'secure' => false
		// 	);
	
		// 	$this->input->set_cookie($cookieUsername);
		// 	$this->input->set_cookie($check_rem);
		// 	$this->input->set_cookie($cookiePassword);
		// }
		// else
		// {
		// 	delete_cookie('user');
		// 	delete_cookie('pass');
		// 	delete_cookie('check_rem');	
			
		// }
	
		$row = $data['login']->row(); 
		$data = array(
			'user_logged_in'  =>  TRUE,
			'user_id' => $row->id,
			'usertype' => $row->user_type,
			'username' => $row->name,
			'email' => $row->email,
		);
		
		$this->session->set_userdata($data);
			redirect(site_url().'/welcome/user_settings');
		}else{
			$this->session->set_userdata('msg','Your user name or password is wrong');
			redirect(site_url().'/welcome');    
		} 
	}

	function user_logout ()
	{
        $this->session->unset_userdata('user_logged_in');
        $this->session->unset_userdata('user_id');
        $this->session->unset_userdata('usertype');
        $this->session->unset_userdata('username');
        $this->session->unset_userdata('email');
        redirect(site_url().'/welcome'); 
	}

	public function user_settings() {
		$data['setting'] = $this->common_model->select_where("*", "users", array('id'=> $this->session->userdata('user_id')));

		if($data['setting']->num_rows()>0){
			
			// echo "<pre>"; print_r($data['setting']->result()); exit;
			foreach($data['setting']->result() as $row) {
				$data['id'] = $row->id;
				$data['name'] = $row->name;
				$data['email'] = $row->email;
				$data['phone_no'] = $row->phone_no;
				$data['password'] = $row->password;
				$data['status'] = $row->status;
				$data['created_at'] = $row->created_at;
			}
		}
		else{
			$data['setting'] = '';
		}

		
		$this->load->view('user/user_header');
		$this->load->view('user/settings',$data);
		$this->load->view('user/user_footer');
	}

	
	public function user_dashboard() {
		
		$this->load->view('user/user_header');
		$this->load->view('user/dashboard');
		$this->load->view('user/user_footer');
		
	}
	
}
