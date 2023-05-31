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

	public function popularCategories() 
	{
		// echo  1111;exit;
		$result=array();
		$data = $this->common_model->select_all_join_group_order("*", "users", "categories", "ON (categories.id=users.`category_id`)", "category_id", "(COUNT(category_id))", "DESC LIMIT 5" )->result();	
		// echo "<pre>"; print_r($data); exit;
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
		$result['message']['code'] = '500';
		$result['message']['success'] = true;
		$result['message']['msg'] = 'Popular Category listing';
		echo json_encode($result,JSON_UNESCAPED_UNICODE|JSON_UNESCAPED_SLASHES);exit;
	}

	public function categoryNames() 
	{
		$result=array();
		$data = $this->common_model->select_all("id, name, ur_name, ar_name", "categories")->result();	
		// echo "<pre>"; print_r($data);
		$result['data']=$data;
		$result['message']['code'] = '500';
		$result['message']['success'] = true;
		$result['message']['msg'] = 'Category listing with names and Ids';
		echo json_encode($result,JSON_UNESCAPED_UNICODE|JSON_UNESCAPED_SLASHES);exit;
		// echo json_encode($data);exit;
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
		echo json_encode($result, JSON_UNESCAPED_UNICODE|JSON_UNESCAPED_SLASHES); exit;
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
        echo json_encode($result, JSON_UNESCAPED_UNICODE|JSON_UNESCAPED_SLASHES); exit;
	}

	public function createUser() 
	{
		// echo 111111; exit;
		$data=array();
		$usertype=$data['user_type']= $this->input->post('user_type');	
		$data['username']= $this->input->post('username');
		$data['email']= $this->input->post('email');
		// $email	=	$this->input->post('email');
		$data['phone_no']= $this->input->post('phone_no');
		$data['category_id']= $this->input->post('category_id');
		$data['password']= sha1($this->input->post('password'));
		$data['image']='';
		$data['status'] = 'active';
		//echo "<pre>"; print_r($data);exit;
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
		$res = $this->common_model->select_where("*", "users", array('email'=>$this->input->post('email')));		
		$row = $res->row();
		if($res->num_rows()>0){
			// $data['user_id']=$row->id;
			$data = array(
				// 'user_id' => $row->id,
				'user_id'=>$row->id,
				'usertype' => $data['user_type'],
				'username' => $data['username'],
				'category_id'=>$data['category_id'],
				'email' => $data['email'],
				'image' => $data['image'],
				'phone_no' => $data['phone_no'],
			);
			$result['message']['code']='500';
			$result['message']['success'] = false;
			$result['message']['msg']='Already signed up';
		}else{
			
			$res1 =$this->common_model->insert_array('users', $data);
			// $res2 = $this->common_model->select_all("*", "users");
			$data['user_id']=strval($res1);
			$data = array(
				// 'user_created'  =>  TRUE,
				// 'user_id' => $row->id,
				'user_id'=>$data['user_id'],
				'usertype' => $data['user_type'],
				'username' => $data['username'],
				'category_id'=>$data['category_id'],
				'email' => $data['email'],
				'image' => $data['image'],
				'phone_no' => $data['phone_no'],
			);
			// $data['user_type']=$usertype;
			if($res1){
				$result['message']['code']='500';
				$result['message']['success'] = true;
				$result['message']['msg']='Registration successful';
			}else{
				$result['message']['success'] = false;
				$result['message']['code']='400';
				$result['message']['error']='user registration error';
			}
		}
		// echo "<pre>"; print_r($row); exit;

		
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
			// echo "<pre>"; print_r($row); exit;
			$data = array(
				'user_id' => $row->id,
				'usertype' => $row->user_type,
				'username' => $row->username,
				'category_id'=>$row->category_id,
				'email' => $row->email,
				'image' => $row->image,
				'phone_no' => $row->phone_no
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
		$data = $this->common_model->select_where("id as user_id, google_id, category_id, username, email,phone_no, image,user_type", "users", array('id'=> $this->input->post('user_id')));
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
		$id = $this->input->post('user_id');
	  	$data['username']= $this->input->post('username');
		$data['phone_no']= $this->input->post('phone_no');
		// $data['email']= $this->input->post('email');
		// $data['password']= sha1($this->input->post('password'));
		// $data['user_type']= $this->input->post('user_type');
		$data['category_id']= $this->input->post('category_id');
		// if (isset($_FILES['image'])) {
		// 	$file = $_FILES['image'];
		// 	if ($file['error'] == UPLOAD_ERR_OK) {
		// 	  $ext = pathinfo($file['name'], PATHINFO_EXTENSION);
	  
		// 	  $filename = uniqid() . '.' . $ext;
	  
		// 	  $destination = "images/$filename";
	  
		// 	  move_uploaded_file($file['tmp_name'], $destination);
	  
		// 	  $data['image'] = $filename;
		// 	}
		// }
		$res = $this->common_model->select_where("*", "users", array('id'=>$id));
	    if($res->num_rows()>0){
			$this->common_model->update_array(array('id' => $id), 'users', $data);
			$data = array(
				// 'user_id' => $row->id,
				'user_id'=>$id,
				// 'usertype' => $data['user_type'],
				'username' => $data['username'],
				'category_id'=> $data['category_id'],
				// 'email' => $data['email'],
				// 'image' => $data['image'],
				'phone_no' => $data['phone_no'],
			);
			$result['message']['code']='500';
			$result['message']['success'] = true;
			$result['message']['msg'] = 'Success, Your profile updated successfully.';
		}else{
			$data = array(
				'user_id'=>$id,
				// 'usertype' => $data['user_type'],
				'username' => $data['username'],
				'category_id'=> $data['category_id'],
				// 'email' => $data['email'],
				// 'image' => $data['image'],
				'phone_no' => $data['phone_no'],
			);
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
		$user = $this->common_model->select_where("id as user_id, username, category_id, email, phone_no, image, user_type", "users", array('id'=>$this->input->post('id'), 'password'=>$old_password)); 

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
	
	public function employeeList(){
		$user = $this->common_model->join_two_tab_where_simple("username, users.id AS user_id, name as category_name, category_id, user_type, phone_no, users.image", "categories", "users", "ON (categories.id=users.`category_id`)", "user_type = 'employee'");
		$data=$user->result();
		if($user->num_rows()>0){
			$result['data']=$data;
			$result['message']['success'] = true;
			$result['message']['code']='500';
			$result['message']['msg']='Employer listing';
		}else{
			$data=array();
			$result['data']=$data;
			$result['message']['success'] = false;
			$result['message']['msg']='No Employee in the list';
		}
		echo json_encode($result,JSON_UNESCAPED_UNICODE|JSON_UNESCAPED_SLASHES);exit;
	}

	public function employerList(){
		$user = $this->common_model->join_two_tab_where_simple("username, users.id AS user_id, name as category_name, category_id, user_type, phone_no, users.image", "categories", "users", "ON (categories.id=users.`category_id`)", "user_type = 'employer'");
		$data=$user->result();
		// echo "<pre>"; print_r($data); exit;
		if($user->num_rows()>0){
			$result['data']=$data;
			$result['message']['success'] = true;
			$result['message']['code']='500';
			$result['message']['msg']='Employer listing';
		}else{
			$data=array();
			$result['data']=$data;
			$result['message']['success'] = false;
			$result['message']['msg']='No Employer in the list';
		}
		
		echo json_encode($result,JSON_UNESCAPED_UNICODE|JSON_UNESCAPED_SLASHES);exit;
	}

	public function favouriteEmployees($id=''){
		$user = $this->common_model->join_three_tab_where_rows(("favourite_user.id, username, employee_id  AS user_id,categories.name, category_id, user_type, phone_no, users.image"), 
		"users", "favourite_user", "ON (favourite_user.employee_id=users.id)" ,"categories", "ON (categories.id=users.category_id)" ,
		array('employer_id'=>$id, 'favourite'=>"Y"));
		$data=$user->result();
		// echo "<pre>"; print_r($data); exit;
		if($user->num_rows()>0){
			$result['data']=$data;
			$result['message']['success'] = true;
			$result['message']['code']='500';
			$result['message']['msg']='Favourite Employee listing';
		}else{
			$data=array();
			$result['data']=$data;
			$result['message']['success'] = false;
			$result['message']['msg']='No Favourite Employee in the list';
		}	
		echo json_encode($result,JSON_UNESCAPED_UNICODE|JSON_UNESCAPED_SLASHES);exit;
	}

	public function favouriteEmployee(){
		$data=array();
		$data['employee_id']=$this->input->post('employee_id');
		$data['user_id']=$this->input->post('user_id');
		// $data['favourite']=$this->input->post('favourite');
		$fav_user=$this->common_model->select_where("*", "favourite_user", array('employee_id'=>$data['employee_id'], 'employer_id'=>$data['user_id']));
		if($fav_user->num_rows()==0){
			$res['employee_id']=$data['employee_id'];
			$res['employer_id']=$data['user_id'];
			$res['favourite']="Y";
			$this->db->insert('favourite_user',$res);
		
		 	$user=$this->common_model->join_two_tab_where_simple("username, users.id AS user_id, name as category_name, category_id, user_type, phone_no, email, users.image", "categories", "users", "ON (categories.id=users.`category_id`)", array('users.id'=>$data['employee_id']));
			$data=$user->result_array();
			$data = array(
				'Favourite'=>true,
				'user_id'=>$data[0]['user_id'],
				'usertype' => $data[0]['user_type'],
				'username' => $data[0]['username'],
				'category_id'=> $data[0]['category_id'],
				'category_name'=> $data[0]['category_name'],
				'email' => $data[0]['email'],
				'image' => $data[0]['image'],
				'phone_no' => $data[0]['phone_no'],
			);
			// echo "<pre>";print_r($data);exit;
			$result['data']=$data;
			$result['message']['success'] = true;
			$result['message']['code']='500';
			$result['message']['msg']='Employee liked';	
			echo json_encode($result,JSON_UNESCAPED_UNICODE|JSON_UNESCAPED_SLASHES);exit;
		}else{
			$this->common_model->delete_where(array('employee_id'=>$data['employee_id'], 'employer_id'=>$data['user_id']), 'favourite_user');
			$user=$this->common_model->join_two_tab_where_simple("username, users.id AS user_id, name as category_name, category_id, user_type, phone_no, email, users.image", "categories", "users", "ON (categories.id=users.`category_id`)", array('users.id'=>$data['employee_id']));
			$data=$user->result_array();
			$data = array(
				'Favourite'=>false,
				'user_id'=>$data[0]['user_id'],
				'usertype' => $data[0]['user_type'],
				'username' => $data[0]['username'],
				'category_id'=> $data[0]['category_id'],
				'category_name'=> $data[0]['category_name'],
				'email' => $data[0]['email'],
				'image' => $data[0]['image'],
				'phone_no' => $data[0]['phone_no'],
			);
			$result['data']=$data;
			$result['message']['success'] = true;
			$result['message']['code']='500';
			$result['message']['msg']='Employee disliked';
			echo json_encode($result,JSON_UNESCAPED_UNICODE|JSON_UNESCAPED_SLASHES);exit;
		}
	}

	public function forgotPassword(){
		$data['email']=$this->input->post('email');
		$user=$this->common_model->select_where("email", "users", array('email'=>$data['email']));
		if($user->num_rows()>0){
			$new_password =rand();
			$to = $data['email'];
			$subject = "Khadim-hazir";
			$txt = "Your new password for Khadim hazir account is : $new_password If you want to change your password login to your account and update your password";
			$headers = "From:Khadimhazir@gmail.com";

			mail($to,$subject,$txt,$headers);

			$this->common_model->update_array(array('email' => $data['email']), 'users', array('password' => sha1($new_password)));
			$data=array();
			$result['data']=$data;
			$result['message']['success'] = true;
			$result['message']['code']='500';
			$result['message']['msg']='We have sent a new password to your email';
		}else{
			$data=array();
			$result['data']=$data;
			$result['message']['success'] = false;
			$result['message']['code']='500';
			$result['message']['msg']='This user is not registered, Kindly register first';
		}
		echo json_encode($result,JSON_UNESCAPED_UNICODE|JSON_UNESCAPED_SLASHES);exit;
	}

}
