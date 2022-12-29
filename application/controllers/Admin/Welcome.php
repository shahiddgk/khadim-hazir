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
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	
	function __construct()
	{
		parent:: __construct();
		$this->load->library('form_validation');
		$this->load->helper('cookie');
		
	}
	
	public function index() {
		$this->load->view('admin/login/login_header');
		$this->load->view('admin/login/login_content');
		$this->load->view('admin/login/login_footer');
	}

	public function setting() {
		$data['setting'] = $this->common_model->select_all("*", "admin");
		foreach($data['setting']->result() as $row) {
			$data['name'] = $row->name;
			$data['email'] = $row->email;
			$data['password'] = $row->password;
			$data['image'] = $row->image;
			$data['id'] = $row->id;
		}
		$this->load->view('admin/admin_header');
		$this->load->view('admin/admin_setting/setting',$data);
		$this->load->view('admin/admin_footer');
	}
	
	public function update() {
		$id= $this->input->post('id');
		$data['name']= $this->input->post('username');
		$data['email']= $this->input->post('email');
		$data['password']= sha1($this->input->post('password'));

		if (isset($_FILES['image'])) {
			$file = $_FILES['image'];
	  
			if ($file['error'] == UPLOAD_ERR_OK) {
			  $ext = pathinfo($file['name'], PATHINFO_EXTENSION);
	  
			  $filename = uniqid() . '.' . $ext;
	  
			  $destination = "images/$filename";
	  
			  move_uploaded_file($file['tmp_name'], $destination);
	  
			  $data['image'] = $filename;
			}
		  }
	  
		$this->common_model->update_array(array('id'=>$id), 'admin', $data);
		redirect(site_url().'admin/welcome/setting');
	}
	
	public function login_action() {
	
		$username	=	$this->input->post('username');
		$password	=	$this->input->post('password');
			
		$data['login'] = $this->common_model->select_where("*","admin", array('email'=>$username,'password'=>sha1($password)));
		
		if($data['login']->num_rows()>0){
			
		  	if($this->input->post('rememberme')=='on')   
			{
				$cookieUsername = array(
					'name'   => 'user',
					'value'  => $username,
					'expire' => time()+1000,
					'path'   => '/',
					'secure' => false
				);
				$cookiePassword = array(
					'name'   => 'pass',
					'value'  => $password,
					'expire' => time()+1000,
					'path'   => '/',
					'secure' => false
				);
				$check_rem = array(
					'name'   => 'check_rem',
					'value'  => 1,
					'expire' => time()+1000,
					'path'   => '/',
					'secure' => false
				);
		
				$this->input->set_cookie($cookieUsername);
				$this->input->set_cookie($check_rem);
				$this->input->set_cookie($cookiePassword);
			}
			else
			{
				delete_cookie('user');
				delete_cookie('pass');
				delete_cookie('check_rem');	
				
			}
	
			$row = $data['login']->row(); 
			$data = array(
				'user_logged_in'  =>  TRUE,
				'usertype' => $row->type,
				'username' => $row->name,
				'image' => $row->image

			);
		
			$this->session->set_userdata($data);
			redirect(site_url().'admin/welcome/dashboard');
		}else{
			$this->session->set_userdata('msg','Your user name or password is wrong');
			redirect(site_url().'admin/welcome');    
		} 
		
	}

	public function dashboard() {
		
		$this->load->view('admin/admin_header');
		$this->load->view('admin/dashboard/dashboard');
		$this->load->view('admin/admin_footer');
		
	}
	
	public function userslisting() {
		$data['users'] =  $this->common_model->select_all("*", "users");
		$this->load->view('admin/admin_header');
		$this->load->view('admin/users/listing', $data);
		$this->load->view('admin/admin_footer');
		
	}

	public function change_status(){
		$id = $this->input->get('id');
		$status = $this->input->get('status');
	
		if($id!="" && $status!=""){
			$data['status'] = $status; 
			$this->common_model->update_array(array('id'=>$id), 'admin', $data);
			redirect(site_url().'admin/welcome/userslisting'); 
		}
	}

	function logout ()
	{
        $this->session->unset_userdata('user_logged_in');
        $this->session->unset_userdata('usertype');
        $this->session->unset_userdata('username');
        redirect(site_url().'admin/welcome'); 
	}

	public function forget_password() {

		// $header_data['title'] = "Product Listing";
		// $header_data['heading'] = "Our Brands";
		// Getting all products
		$this->load->view('admin/login/login_header');
		$this->load->view('admin/forgetpassword/forget_password');
		$this->load->view('admin/login/login_footer');
	}

	function send_mail()
	{
		$this->load->helper('string');
		 
		$email = $this->input->post('email');
		$response = $this->common_model->select_where("id,password", "admin", array('email'=>$email)); 
	
		if($response->num_rows()>0) {
			$row = $response->row();
			$new_pass =  random_string('alnum',8);
			$data['password'] = $new_pass;
			$this->common_model->update_array(array('id'=>$row->id), 'admin', $data);
			$config = Array(
				'protocol' => 'smtp',
				'smtp_host' => 'mail.dgwebtech.com',
				'smtp_port' => 465,
				'smtp_user' => 'dgwebtech', // change it to yours
				'smtp_pass' => 'zfjU4GAvozLl', // change it to yours
				'mailtype' => 'html',
				'charset' => 'iso-8859-1',
				'wordwrap' => TRUE
			);
		
			$message = 'Here is yours new password</br>'.$pass.'</br> Kindly save it and you can change your password from Admin once logged in.';
			$this->load->library('email', $config);
			$this->email->set_newline("\r\n");
			$this->email->from('Azoozy.com'); // change it to yours
			$this->email->to('asgherjunaid@gmail.com');// change it to yours
			$this->email->subject('Password Reset');
			$this->email->message($message);
			if($this->email->send())
			{
				$this->session->set_userdata('email','Email sent.Kindly check your email');
			
			}
			else
			{
			show_error($this->email->print_debugger());
			}
			  
		 }
		else{

		$this->session->set_userdata('valid_email','Enter your Given email');
		
		redirect(site_url("admin/welcome/forget_password")); 

		}
    
	}

	public function settings(){
		$data['settings'] = $this->common_model->select_where("terms, price,arabic_terms", "settings", array('id'=>1))->row();
		$this->load->view('admin/admin_header');
		$this->load->view('admin/settings', $data);
		$this->load->view('admin/admin_footer');
	}

	public function update_settings(){
		$data['price'] = $this->input->post('package_price');
		$data['arabic_terms'] = $this->input->post('arabic_terms');
		$data['terms'] = $this->input->post('terms');
		$data['arabic_privacy'] = $this->input->post('arabic_privacy');
		$data['privacy_policy'] = $this->input->post('privacy');
		$this->common_model->update_array(array('id'=>1), 'settings', $data);
		redirect(site_url().'admin/welcome/settings'); 
	}
	
}
