<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Api extends CI_Controller {

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
	function __construct() 
	{
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
	public function index($subcate='') 
	{
		$data=array();
		$data = $this->common_model->select_all("*", "categories")->result();
		// echo 111; exit;
		// foreach($data['data']['category'] as $row) {
		// 	//echo "<pre>"; print_r($row); exit;

		// 	$data['data']['category'][$row->category_id][$row->language]['name'] = $row->name; 
		// 	$data['data']['category'][$row->category_id][$row->language]['category_id'] = $row->category_id; 
		// 	$data['data']['category'][$row->category_id][$row->language]['image'] = $row->image; 
		// 	$data['data']['category'][$row->category_id][$row->language]['price'] = $row->price; 
		// 	$data['data']['category'][$row->category_id][$row->language]['currency'] = $row->currency; 
		// }
        
        
		// $data['subcategories']  = $this->common_model->select_where_ASC_DESC("table_id, name, image_name, region_id", "brands", array('language'=>$this->language), "priority", "ASC");
		// $data['subname'] = "";
		// if($subcate!=""){
		// 	$data['subname'] = $this->common_model->select_single_field("name" ,"brands", array('region_id'=>$subcate, 'language'=>$this->language));
		// }
		
		// $data['data']['subcateid'] = $subcate;
		// echo "<pre>"; print_r($data); exit; 

		// $data['data']['popup'] = '';
		// if($this->session->userdata('user_logged_in') && $subcate!=''){
		// 	if($this->session->userdata('paymentstatus')=='unpaid'){
		// 		$data['data']['popup'] = 'subcription';
		// 	}
		// }
		// else if($subcate!=''){
		// 	$data['data']['popup'] = 'registration';
		// }
		
		//$data['data'] = $data;
		$data['message']['code'] = '500';
		$data['message']['msg'] = 'Category listing';
		echo json_encode($data,JSON_UNESCAPED_UNICODE|JSON_UNESCAPED_SLASHES);exit;
		// echo json_encode($data);exit;
		/*$this->load->view('front/header');
		$this->load->view('front/home', $data);
		$this->load->view('front/footer');*/
	}

	public function set_session($lang=null)
	{
		if($lang!=""){
			$this->session->set_userdata('language', $lang);
		}
	}

	public function subCategory() 
	{
		// echo 1111; exit;
		$response = $this->common_model->select_all("*", "sub_categories"); 	
		if($response->num_rows()>0) {			
			// foreach($response->result() as $row) {
			// 	$data['data'][$row->sub_id][$row->language]['name'] = $row->name; 
			// 	$data['data'][$row->sub_id][$row->language]['sub_id'] = $row->sub_id; 
			// 	$data['data'][$row->sub_id][$row->language]['image'] = $row->image; 
			// 	$data['data'][$row->sub_id][$row->language]['price'] = $row->price; 
			// 	$data['data'][$row->sub_id][$row->language]['currency'] = $row->currency; 
			// }
			$data = $response->result();
			$data['message']['code']='500';
			$data['message']['text']="Sub Category listing";
			// echo"<pre>";print_r($data);exit;	
		}else{
			$data['data'] = array();
			$data['message']['text']="No Record found";
		}
		echo json_encode($data,JSON_UNESCAPED_UNICODE|JSON_UNESCAPED_SLASHES);exit;
		// echo json_encode($data);exit;	
		/*$this->load->view('front/header');
		$this->load->view('front/sub_category', $data);
		$this->load->view('front/footer');*/

		
	}

	public function ajax_subcategory($id='')
	{
		$id = $this->input->post('category_id');
		$response = $this->common_model->select_where("*", "sub_categories", array('category_id'=>$id)); 
		if($response->num_rows()>0){
			$data = $response->result();
			$data['message']['code']='500';
			$data['message']['text']="Sub Category listing on category_id";
		}else{
			$data['data'] = array();
			$data['message']['text']="No Record found";
		}
		// echo"<pre>";print_r($data);exit;
        echo json_encode($data); exit;
	}

	public function subcategory_id($id='')
	{
		$id = $this->input->post('id');
		$response = $this->common_model->select_where("*", "sub_categories", array('id'=>$id)); 
		if($response->num_rows()>0){
			$data = $response->result();
			$data['message']['code']='500';
			$data['message']['text']="Sub Category listing on Id";
		}else{
			$data['data'] = array();
			$data['message']['text']="No Record found";
		}
		// echo"<pre>";print_r($data);exit;
        echo json_encode($data); exit;
	}

	public function create_user() 
	{
		// echo 111111; exit;
		$data['user_type']= $this->input->post('user_type');	
		$data['name']= $this->input->post('name');
		$data['email']= $this->input->post('email');
		$data['phone_no']= $this->input->post('phone_no');
		$data['password']= sha1($this->input->post('password'));
		$data['status'] = 'active';

		$result = $this->common_model->select_where("*", "users", array('email'=>$this->input->post('email')));

		if($result->num_rows()>0){
			$data['message']['code']='500';
			$data['message']['msg']='Already signed up';
			echo json_encode($data);exit;
		}else{
			$result = $this->common_model->insert_array('users', $data);
			if($result){
			$data['message']['code']='500';
			$data['message']['msg']='Registration successful';
			}else{
			$data['message']['error']='user registration error';
			}
		echo json_encode($data);exit;
		}
		// echo"<pre>";print_r($result);exit;
		if($result){
			$this->session->set_flashdata('flash_message', 'User Registered successfully please login.');
			redirect('user/sign_in', 'refresh');
		}
		
	}
	
	public function login_user() 
	{
		$email	=	$this->input->post('email');
		$password	=	$this->input->post('password');
		
		$data['login'] = $this->common_model->select_where("*","users", array('email'=>$email,'password'=>sha1($password)));
		
		if($data['login']->num_rows()>0){
		// echo 1; exit;
		$row = $data['login']->row(); 
		$data = array(
			'user_logged_in'  =>  TRUE,
			'user_id' => $row->id,
			'usertype' => $row->user_type,
			'username' => $row->name,
			'email' => $row->email,
			'images' => $row->images
		);
		$data['message']['code']='500';
		$data['message']['msg'] = 'You are now logged in';
		echo json_encode($data);exit;

		$this->session->set_userdata($data);
			redirect(site_url().'welcome/update_profile');
		}else{
			$data=array();
			$data['message']['msg'] = 'Your Email or password is wrong';
			echo json_encode($data);exit;
			$this->session->set_flashdata('msg','Your Email or password is wrong');
			redirect(site_url().'user/sign_in');    
		} 
		
	}

	function user_logout ()
	{
        $this->session->unset_userdata('user_logged_in');
        $this->session->unset_userdata('user_id');
        $this->session->unset_userdata('usertype');
        $this->session->unset_userdata('username');
        $this->session->unset_userdata('email');
        redirect(site_url().'welcome'); 
	}

	public function profile_data($id='') 
	{
		// echo 'update_profile'; exit;
		$result = $this->common_model->select_where("*", "users", array('id'=> $this->input->post('id')));
		if($result->num_rows()>0){	
			$data=$result->result();
			// echo "<pre>"; print_r($data); exit;
			$data['message']['code']='500';
			$data['message']['msg'] = 'you can update your profile from here';
		}
		else{
			$data['setting'] = '';
			$data['message']['msg'] = 'Loading profile unsuccessful';
		}
		echo json_encode($data);exit;
		// $this->load->view('front/header');
		// $this->load->view('front/user_profile',$data);
		// $this->load->view('front/footer');
	}

	public function update() 
	{
		$id = $this->input->post('id');
	  	$data['name']= $this->input->post('name');
		$data['phone_no']= $this->input->post('phone_no');
		$data['email']= $this->input->post('email');
		$data['password']= sha1($this->input->post('password'));

		if (isset($_FILES['images'])) {
			$file = $_FILES['images'];
			if ($file['error'] == UPLOAD_ERR_OK) {
			  $ext = pathinfo($file['name'], PATHINFO_EXTENSION);
	  
			  $filename = uniqid() . '.' . $ext;
	  
			  $destination = "images/$filename";
	  
			  move_uploaded_file($file['tmp_name'], $destination);
	  
			  $data['images'] = $filename;
			}
		  }
		$result = $this->common_model->select_where("*", "users", array('id'=>$id));
	    if($result->num_rows()>0){
			$this->common_model->update_array(array('id' => $id), 'users', $data);
			$data['message']['code']='500';
			$data['message']['msg'] = 'success, Your profile was updated successfully.';
			echo json_encode($data);exit;
		}else{
			$data['message']['msg'] = 'Failure, Your profile was not updated.';
			echo json_encode($data);exit;
		}
		$this->session->set_flashdata('success', 'Your profile was updated successfully.');
		redirect(base_url() . 'welcome/update_profile');
			  
	}
	
	public function user_dashboard() 
	{
		$this->load->view('front/header');
		$this->load->view('user/dashboard');
		$this->load->view('front/footer');
	}

	public function change_password() 
	{
		// echo 'change_password'; exit;
		$old_password = sha1($this->input->post('old_password'));
		$user = $this->common_model->select_where("*", "users", array('id'=>$this->input->post('id'), 'password'=>$old_password)); 

		if ($user->num_rows() > 0){
			$data=$user->result();
			$data['message']['code']='Old password is matched, enter new password';
			$new_password = sha1($this->input->post('new_password'));

			$result = $this->common_model->update_array(
			array('id' => $this->input->post('id')), 'users', array('password' => $new_password));
			$data['message']['code']='500';
			$data['message']['msg']='Password updated successfully';
			
		}else{
			$data['message']['code']='Your passworrd is not matching, try another password';
		}
		echo json_encode($data);exit;
	}
	  
	public function user_type() 
	{
		$data['user_type']= $this->input->post('user_type');	
		$data['category_id'] = $this->input->post('category_id'); 
		$data['sub_id'] = $this->input->post('sub_id'); 

		$result = $this->common_model->insert_array('users', $data);
		if($result){
			$this->session->set_flashdata('flash_message', 'User Registered successfully please login.');
			redirect('user/sign_in', 'refresh');
		}
	}
	
}
