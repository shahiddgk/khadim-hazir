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
	public function index() 
	{
		$result=array();
		$data = $this->common_model->select_all("*", "categories")->result();	
		//echo "<pre>"; print_r($data); exit;
		foreach($data as $key=>$value){
			$en_array[$key]['id']=$value->id;
			$en_array[$key]['name']=$value->name;
			$en_array[$key]['image']=$value->image;
			$en_array[$key]['price']=$value->price;
			$en_array[$key]['added_date']=$value->added_date;
			$ur_array[$key]=$en_array[$key];
			$ur_array[$key]['name']=$value->ur_name;
			$ur_array[$key]['price']=$value->ur_price;
			$ar_array[$key]=$en_array[$key];
			$ar_array[$key]['name']=$value->ar_name;
			$ar_array[$key]['price']=$value->ar_price;
		}
		$result['data']['en'] = $en_array;
		$result['data']['ur'] = $ur_array;
		$result['data']['ar'] = $ar_array;
		
		//echo "<pre>"; print_r($result); exit;

		// $result['ar'] = $data;
		$result['message']['code'] = '500';
		$result['message']['success'] = true;
		$result['message']['msg'] = 'Category listing';
		echo json_encode($result,JSON_UNESCAPED_UNICODE|JSON_UNESCAPED_SLASHES);exit;
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
	public function subCategoryByCategory($id='')
	{
		$data =array();
		$response = $this->common_model->select_where("*", "sub_categories", array('category_id'=>$id)); 
		$result['message']['code']='500';
		if($response->num_rows()>0){
			$data = $response->result();

			foreach($data as $key=>$value){
				$en_array[$key]['id']=$value->id;
				$en_array[$key]['category_id']=$value->category_id;				
				$en_array[$key]['name']=$value->name;
				$en_array[$key]['image']=$value->image;
				$en_array[$key]['price']=$value->price;
				$en_array[$key]['added_date']=$value->added_date;

				$ur_array[$key]=$en_array[$key];
				$ur_array[$key]['name']=$value->ur_name;
				$ur_array[$key]['price']=$value->ur_price;
				$ar_array[$key]=$en_array[$key];
				$ar_array[$key]['name']=$value->ar_name;
				$ar_array[$key]['price']=$value->ar_price;
			}
			$result['data']['en'] = $en_array;
			$result['data']['ur'] = $ur_array;
			$result['data']['ar'] = $ar_array;
			$result['data']['message']['success'] = true;			
			$result['data']['message']['text']="Sub Category listing on category_id";
			
		}else{
			$result['data'] = array();
			$result['message']['success'] = false;
			$result['message']['text']="No Record found";
		}
		echo json_encode($result); exit;
	}

	public function subCategory($id='')
	{
		$data=array();
		if($id==''){
			$response = $this->common_model->select_all("*", "sub_categories");
		}else{
			$response = $this->common_model->select_where("*", "sub_categories", array('id'=>$id)); 
		}
		if($response->num_rows()>0){
			$data = $response->result();

			foreach($data as $key=>$value){
				$en_array[$key]['id']=$value->id;
				$en_array[$key]['category_id']=$value->category_id;				
				$en_array[$key]['name']=$value->name;
				$en_array[$key]['image']=$value->image;
				$en_array[$key]['price']=$value->price;
				$en_array[$key]['added_date']=$value->added_date;

				$ur_array[$key]=$en_array[$key];
				$ur_array[$key]['name']=$value->ur_name;
				$ur_array[$key]['price']=$value->ur_price;
				$ar_array[$key]=$en_array[$key];
				$ar_array[$key]['name']=$value->ar_name;
				$ar_array[$key]['price']=$value->ar_price;
			}
			$result['data']['en'] = $en_array;
			$result['data']['ur'] = $ur_array;
			$result['data']['ar'] = $ar_array;
			$result['data']['message']['success'] = true;


			$result['data']['message']['code']='500';
		
			$result['data']['message']['text']="Sub Category listing on Id";
			
		}else{
			$result['data'] = array();
			$result['message']['success'] = false;
			$result['message']['text']="No Record found";
		}
		//$result['data']=$data;
		// echo"<pre>";print_r($data);exit;
        echo json_encode($result); exit;
	}

	public function createUser() 
	{
		// echo 111111; exit;
		$data['user_type']= $this->input->post('user_type');	
		$data['name']= $this->input->post('name');
		$data['email']= $this->input->post('email');
		$data['phone_no']= $this->input->post('phone_no');
		$data['category_id']= $this->input->post('category_id');
		$data['password']= sha1($this->input->post('password'));
		$data['status'] = 'active';

		$res = $this->common_model->select_where("*", "users", array('email'=>$this->input->post('email')));
		//echo"<pre>";print_r($result);exit;
		if($res->num_rows()>0){
			$result['message']['code']='500';
			$result['message']['success'] = false;
			$result['message']['msg']='Already signed up';
		}else{
			$res =$this->common_model->insert_array('users', $data);
			if($res){
				$result['message']['code']='500';
				$result['message']['success'] = true;
				$result['message']['msg']='Registration successful';
			}else{
				$result['message']['success'] = false;
				$result['message']['code']='400';
				$result['message']['error']='user registration error';
			}
		}
		unset($data['password']);
		$result['data'] = [$data];
		echo json_encode($result);exit;		
	}
	
	public function loginUser() 
	{
		$email	=	$this->input->post('email');
		$password	=	$this->input->post('password');
		
		$data = $this->common_model->select_where("*","users", array('email'=>$email,'password'=>sha1($password)));
		
		if($data->num_rows()>0){
			// echo 1; exit;
			$row = $data->row(); 
			$data = array(
				'user_logged_in'  =>  TRUE,
				'user_id' => $row->id,
				'usertype' => $row->user_type,
				'username' => $row->name,
				'email' => $row->email,
				'image' => $row->image
			);
			$result['message']['code']='500';
			$result['message']['success'] = true;
			$result['message']['msg'] = 'You are now logged in';
			$result['data']=[$data];			
		}else{
			$result['data']= array();
			$result['message']['code']='500';
			$result['message']['success'] = false;
			$result['message']['msg'] = 'Your Email or password is wrong';
						
		} 
		echo json_encode($result);exit;
		
	}

	function userLogout ()
	{
        $this->session->unset_userdata('user_logged_in');
        $this->session->unset_userdata('user_id');
        $this->session->unset_userdata('usertype');
        $this->session->unset_userdata('username');
        $this->session->unset_userdata('email');
        redirect(site_url().'welcome'); 
	}

	public function profileData() 
	{
		// echo 'update_profile'; exit;
		$data = $this->common_model->select_where("id, google_id, name, email,phone_no, image,user_type", "users", array('id'=> $this->input->post('id')));
		if($data->num_rows()>0){	
			$result['data']=$data->result();
			// echo "<pre>"; print_r($data); exit;
			$result['message']['code']='500';
			$result['message']['success'] = true;
			$result['message']['msg'] = 'Your Profile data';
		}
		else{
			$result['message']['code']='500';
			$result['message']['success'] = false;
			$result['message']['msg'] = 'Loading profile unsuccessful';
		}
		// unset($data['data']['password']);
		echo json_encode($result);exit;
		// $this->load->view('front/header');
		// $this->load->view('front/user_profile',$data);
		// $this->load->view('front/footer');
	}

	public function updateProfile() 
	{
		$id = $this->input->post('id');
	  	$data['name']= $this->input->post('name');
		$data['phone_no']= $this->input->post('phone_no');
		$data['email']= $this->input->post('email');
		$data['password']= sha1($this->input->post('password'));
		$data['category_id']= $this->input->post('category_id');
		if (isset($_FILES['image'])) {
			$file = $_FILES['image'];
			if ($file['error'] == UPLOAD_ERR_OK) {
			  $ext = pathinfo($file['name'], PATHINFO_EXTENSION);
	  
			  $filename = uniqid() . '.' . $ext;
	  
			  $destination = "image/$filename";
	  
			  move_uploaded_file($file['tmp_name'], $destination);
	  
			  $data['image'] = $filename;
			}
		  }
		$res = $this->common_model->select_where("*", "users", array('id'=>$id));
	    if($res->num_rows()>0){
			$this->common_model->update_array(array('id' => $id), 'users', $data);
			$result['message']['code']='500';
			$result['message']['success'] = true;
			$result['message']['msg'] = 'Success, Your profile updated successfully.';
		}else{
			$result['message']['code']='500';
			$result['message']['success'] = false;
			$result['message']['msg'] = 'Failure, Your profile is not updated as you are not registered user.';
			
		}
		unset($data['password']);
		$result['data'] = [$data];
		echo json_encode($result);exit;			  
	}
	
	public function userDashboard() 
	{
		$this->load->view('front/header');
		$this->load->view('user/dashboard');
		$this->load->view('front/footer');
	}

	public function changePassword() 
	{
		// echo 'change_password'; exit;
		$old_password = sha1($this->input->post('old_password'));
		$user = $this->common_model->select_where("id, name, email, phone_no, image, user_type", "users", array('id'=>$this->input->post('id'), 'password'=>$old_password)); 

		if ($user->num_rows() > 0){
			$result['data']=$user->result();
			$result['message']['code']='Old password is matched, enter new password';
			$new_password = sha1($this->input->post('new_password'));
			$this->common_model->update_array(array('id' => $this->input->post('id')), 'users', array('password' => $new_password));
			$result['message']['code']='500';
			$result['message']['success'] = true;
			$result['message']['msg']='Password updated Successfully';
			
		}else{
			$result['data']= array();
			$result['message']['success'] = false;
			$result['message']['code']='500';
			$result['message']['msg']='Your password is not matching, try another password';
		}
		echo json_encode($result);exit;
	}	  
	
	
}
