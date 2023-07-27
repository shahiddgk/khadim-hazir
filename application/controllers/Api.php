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
	public function index($category='') 
	{
		// echo $category; exit;
		$result=array();
		if($category != ''){
			$user = $this->common_model->like_value("slug", "categories", 'slug', $category);	
			$data=$user->result();
			if($user->num_rows()>0){
				$result['data']=$data;
				$result['message']['code'] = '500';
				$result['message']['success'] = true;
				$result['message']['msg'] = 'Category listing';
				echo json_encode($result,JSON_UNESCAPED_UNICODE|JSON_UNESCAPED_SLASHES);exit;
			}else{
				$result['data']=$data;
				$result['message']['code'] = '500';
				$result['message']['success'] = false;
				$result['message']['msg'] = 'No category found';
				echo json_encode($result,JSON_UNESCAPED_UNICODE|JSON_UNESCAPED_SLASHES);exit;
			}
		}else{
			$data = $this->common_model->select_all("*", "categories")->result();	
		}
		//echo "<pre>"; print_r($data); exit;
		foreach($data as $key=>$value){
			$en_array[$key]['id']=$value->id;
			$en_array[$key]['name']=$value->name;
			$en_array[$key]['image']=$value->image;
			$en_array[$key]['price']=$value->price;
			$en_array[$key]['slug']=$value->slug;
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
			$en_array[$key]['slug']=$value->slug;
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
		$data['phone_no']= (($this->input->post('phone_no')) ? ($this->input->post('phone_no')) : "");
		$data['category_id']= $this->input->post('category_id');
		// $data['address']= $this->input->post('address');
		$data['address']= (($this->input->post('address')) ? ($this->input->post('address')) : "");
		$data['password']= sha1($this->input->post('password'));
		$data['image']='';
		$data['status'] = 'active';
		$data['slug']=str_replace(" ", "-", strtolower($data['username']));
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
				'address' => $data['address']
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
				'address' => $data['address']
			);			
			if($res1){
				// if($usertype=="employee"){
				// 	$emp_categ=array(
				// 		'employee_id'=>$data['user_id'],
				// 		'subcategory_id'=>$subcategory,
				// 		'status'=>'active'
				// 	);
				// 	$this->common_model->insert_array('user_category', $emp_categ);
				// }
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
		echo json_encode($result , JSON_UNESCAPED_UNICODE|JSON_UNESCAPED_SLASHES);exit;		
	}
	
	public function loginUser() 
	{
		$email	=	$this->input->post('email');
		$password	=	$this->input->post('password');
		// echo $password; exit;
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
				'phone_no' => $row->phone_no,
				'address'=>$row->address
			);
			$result['message']['code']='500';
			$result['message']['success'] = true;
			$result['message']['msg'] = 'You have logged in succesfully';
			$result['data']=[$data];			
		}else{
			$result['data']= array();
			$result['message']['code']='500';
			$result['message']['success'] = false;
			$result['message']['msg'] = 'Your Email or password is wrong';
						
		} 
		echo json_encode($result , JSON_UNESCAPED_UNICODE|JSON_UNESCAPED_SLASHES);exit;		
		
	}

	function userLogout ()
	{
        $this->session->unset_userdata('user_logged_in');
        $this->session->unset_userdata('user_id');
        $this->session->unset_userdata('usertype');
        $this->session->unset_userdata('username');
        $this->session->unset_userdata('email');
		$result['message']['success'] = true;
		$result['message']['code']='500';
		$result['message']['error']='You have loged out';

        // redirect(site_url().'welcome'); 
	}

	public function profileData() 
	{
		// echo 'update_profile'; exit;
		$user_id=$this->input->post('user_id');

		$user_slug=@$this->input->post('user_slug');
		$category_id=@$this->input->post('category_id');
		// echo $category_slug; 
		if($user_slug !=''){
			$user = $this->common_model->select_where("id", "users", array('slug'=>$user_slug));
			if ($user->num_rows() > 0){
				$result =$user->result();
				$user_id = $result[0]->id;
			}
		}
		if($category_id == 0){
			$data = $this->common_model->select_where("users.id as user_id, category_id, username, phone_no, users.image,user_type,  users.slug as user_slug, address, email, password", "users", array('users.id'=>$user_id));
		}else{
			$data = $this->common_model->join_two_tab_where_simple("users.id as user_id, category_id, username, phone_no, users.image,user_type, categories.name as category_name, users.slug as user_slug, address, email, password", "users", "categories", "on (users.category_id=categories.id)", array('users.id'=>$user_id));	
		}
		
		
		
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
		// $data['phone_no']= $this->input->post('phone_no');
		$data['phone_no']= (($this->input->post('phone_no')) ? ($this->input->post('phone_no')) : "");
		// $data['address']= $this->input->post('address');
		$data['address']= (($this->input->post('address')) ? ($this->input->post('address')) : "");
		// $data['user_ty$data['image']pe']= $this->input->post('user_type');
		$data['category_id']= $this->input->post('category_id');
		$data['slug']=str_replace(" ", "-", strtolower($data['username']));
		if (isset($_FILES['image'])) {
			$file = $_FILES['image'];
			if ($file['error'] == UPLOAD_ERR_OK) {
			  $ext = pathinfo($file['name'], PATHINFO_EXTENSION);
	  
			  $filename = uniqid() . '.' . $ext;
	  
			  $destination = "images/$filename";

			  $user=$this->common_model->select_where("image", "users", array("id"=>$id));
			  $row=$user->row();
			//   echo ($row->image); exit;
			  $oldimage=$row->image;
			//   file::delete('khadim-hazir/images/'.$oldimage);
			  move_uploaded_file($file['tmp_name'], $destination);
	  
			  $data['image'] = $filename;
			}
		}
		$res = $this->common_model->select_where("*", "users", array('id'=>$id));
	    if($res->num_rows()>0){
			$this->common_model->update_array(array('id' => $id), 'users', $data);
			$data = array(
				// 'user_id' => $row->id,
				'user_id'=>$id,
				// 'usertype' => $data['user_type'],
				'username' => $data['username'],
				'category_id'=> $data['category_id'],
				'address' => $data['address'],
				'image' => @$data['image'],
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
				'address' => $data['address'],
				'image' => @$data['image'],
				'phone_no' => $data['phone_no'],
			);
			$result['message']['code']='500';
			$result['message']['success'] = false;
			$result['message']['msg'] = 'Failure, Your profile is not updated as you are not registered user.';
		}
		unset($data['password']);
		$result['data'] = [$data];
		echo json_encode($result , JSON_UNESCAPED_UNICODE|JSON_UNESCAPED_SLASHES);exit;				  
	}
	
	public function userDashboard() 
	{
		$this->load->view('front/header');
		$this->load->view('user/dashboard');
		$this->load->view('front/footer');
	}

	public function changePassword() 
	{
		$old_password = sha1($this->input->post('old_password'));
		// echo $old_password; exit;

		$user = $this->common_model->select_where("id as user_id, username, category_id, email, phone_no, image, user_type", "users", array('id'=>$this->input->post('id'), 'password'=>$old_password)); 

		if ($user->num_rows() > 0){
			$result['data']=$user->result();
			// $result['message']['code']='Old password is matched, enter new password';
			$new_password = sha1($this->input->post('new_password'));
			$this->common_model->update_array(array('id' => $this->input->post('id')), 'users', array('password' => $new_password));
			$result['message']['code']='500';
			$result['message']['success'] = true;
			$result['message']['msg']='Your have successfully updated yor password';
			
		}else{
			$result['data']= array();
			$result['message']['success'] = false;
			$result['message']['code']='500';
			$result['message']['msg']='Current Password is mismatching, try another password';
		}
		echo json_encode($result);exit;
	}	  
	
	// public function employeeList(){
	// 	$user = $this->common_model->join_two_tab_where_simple("username, users.id AS user_id, name as category_name, category_id, user_type, phone_no, users.image", "categories", "users", "ON (categories.id=users.`category_id`)", "user_type = 'employee'");
	// 	$data=$user->result();
	// 	if($user->num_rows()>0){
	// 		$result['data']=$data;
	// 		$result['message']['success'] = true;
	// 		$result['message']['code']='500';
	// 		$result['message']['msg']='Employer listing';
	// 	}else{
	// 		$data=array();
	// 		$result['data']=$data;
	// 		$result['message']['success'] = false;
	// 		$result['message']['msg']='No Employee in the list';
	// 	}
	// 	echo json_encode($result,JSON_UNESCAPED_UNICODE|JSON_UNESCAPED_SLASHES);exit;
	// }

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
		$user = $this->common_model->join_three_tab_where_rows(("favourite_user.id, username, employee_id,categories.name, ur_name, ar_name, category_id, user_type, phone_no, users.image"), 
		"users", "favourite_user", "ON (favourite_user.employee_id=users.id)" ,"categories", "ON (categories.id=users.category_id)" ,
		array('employer_id'=>$id, 'favourite'=>"Y"));
		$data=$user->result();
		// echo "<pre>"; print_r($data); exit;
		if($user->num_rows()>0){
			foreach($data as $key=>$value){
				$en_array[$key]['id']=$value->id;
				$en_array[$key]['username']=$value->username;
				$en_array[$key]['employee_id']=$value->employee_id;
				$en_array[$key]['name']=$value->name;
				$en_array[$key]['category_id']=$value->category_id;
				$en_array[$key]['user_type']=$value->user_type;
				$en_array[$key]['phone_no']=$value->phone_no;
				$en_array[$key]['image']=$value->image;

				$ur_array[$key]=$en_array[$key];
				$ur_array[$key]['name']=$value->ur_name;

				$ar_array[$key]=$en_array[$key];
				$ar_array[$key]['name']=$value->ar_name;
			}
			$result['data']['en'] = $en_array;
			$result['data']['ur'] = $ur_array;
			$result['data']['ar'] = $ar_array;

			// $result['data']=$data;
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
		
		 	$user=$this->common_model->join_two_tab_where_simple("username, users.id AS employee_id, name as category_name, category_id, user_type, phone_no, email, users.image, ur_name, ar_name", "categories", "users", "ON (categories.id=users.`category_id`)", array('users.id'=>$data['employee_id']));
			$data=$user->result();
			foreach($data as $key=>$value){
				$en_array[$key]['Favourite']=true;
				$en_array[$key]['employee_id']=$value->employee_id;
				$en_array[$key]['usertype']=$value->user_type;
				$en_array[$key]['category_id']=$value->category_id;
				$en_array[$key]['category_name']=$value->category_name;
				$en_array[$key]['email']=$value->email;
				$en_array[$key]['image']=$value->image;
				$en_array[$key]['phone_no']=$value->phone_no;

				$ur_array[$key]=$en_array[$key];
				$ur_array[$key]['category_name']=$value->ur_name;

				$ar_array[$key]=$en_array[$key];
				$ar_array[$key]['category_name']=$value->ar_name;
			}
			// $data = array(
			// 	'Favourite'=>true,
			// 	'user_id'=>$data[0]['user_id'],
			// 	'usertype' => $data[0]['user_type'],
			// 	'username' => $data[0]['username'],
			// 	'category_id'=> $data[0]['category_id'],
			// 	'category_name'=> $data[0]['category_name'],
			// 	'email' => $data[0]['email'],
			// 	'image' => $data[0]['image'],
			// 	'phone_no' => $data[0]['phone_no'],
			// );
			$result['data']['en'] = $en_array;
			$result['data']['ur'] = $ur_array;
			$result['data']['ar'] = $ar_array;
			// echo "<pre>";print_r($result);exit;
			// $result['data']=$data;
			$result['message']['success'] = true;
			$result['message']['code']='500';
			$result['message']['msg']='Employee liked';	
			echo json_encode($result,JSON_UNESCAPED_UNICODE|JSON_UNESCAPED_SLASHES);exit;
		}else{
			$this->common_model->delete_where(array('employee_id'=>$data['employee_id'], 'employer_id'=>$data['user_id']), 'favourite_user');
			$user=$this->common_model->join_two_tab_where_simple("username, users.id AS employee_id, name as category_name, category_id, user_type, phone_no, email, users.image, ar_name, ur_name", "categories", "users", "ON (categories.id=users.`category_id`)", array('users.id'=>$data['employee_id']));
			$data=$user->result();
			foreach($data as $key=>$value){
				$en_array[$key]['Favourite']=false;
				$en_array[$key]['employee_id']=$value->employee_id;
				$en_array[$key]['usertype']=$value->user_type;
				$en_array[$key]['category_id']=$value->category_id;
				$en_array[$key]['category_name']=$value->category_name;
				$en_array[$key]['email']=$value->email;
				$en_array[$key]['image']=$value->image;
				$en_array[$key]['phone_no']=$value->phone_no;

				$ur_array[$key]=$en_array[$key];
				$ur_array[$key]['category_name']=$value->ur_name;

				$ar_array[$key]=$en_array[$key];
				$ar_array[$key]['category_name']=$value->ar_name;
			}
			$result['data']['en'] = $en_array;
			$result['data']['ur'] = $ur_array;
			$result['data']['ar'] = $ar_array;
			// $data=$user->result_array();
			// $data = array(
			// 	'Favourite'=>false,
			// 	'user_id'=>$data[0]['user_id'],
			// 	'usertype' => $data[0]['user_type'],
			// 	'username' => $data[0]['username'],
			// 	'category_id'=> $data[0]['category_id'],
			// 	'category_name'=> $data[0]['category_name'],
			// 	'email' => $data[0]['email'],
			// 	'image' => $data[0]['image'],
			// 	'phone_no' => $data[0]['phone_no'],
			// );
			// $result['data']=$data;
			$result['message']['success'] = true;
			$result['message']['code']='500';
			$result['message']['msg']='Employee disliked';
			echo json_encode($result,JSON_UNESCAPED_UNICODE|JSON_UNESCAPED_SLASHES);exit;
		}
	}

	public function forgotPassword(){
		$data['email']=$this->input->post('email');
		$user=$this->common_model->select_where("email", "users", array('email'=>$data['email'], 'id !=' => NULL, 'username !='=> NULL));
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
			$result['message']['msg']='This user is not registered Kindly register first';
		}
		echo json_encode($result,JSON_UNESCAPED_UNICODE|JSON_UNESCAPED_SLASHES);exit;
	}

	public function employeesListing($multiLang=''){
		$data['category_id']=$this->input->post('category_id');
		$data['user_id']=$this->input->post('user_id');
		$id=$data['user_id'];
		$category=$data['category_id'];
		
		$category_slug = @$this->input->post('category_slug');
		//echo $category_slug;exit;
		if($category_slug!=''){
			$user = $this->common_model->select_where("id", "categories", array('slug'=>$category_slug));
			if ($user->num_rows() > 0){
				$result =$user->result();
				$category = $result[0]->id;
			}	
		}
		
		
		if($id=='' && $category!=''){
			$user=$this->common_model->join_two_tab_where_simple(" 'false' as favourite, username, users.id as employee_id, name as category_name, 
			category_id, user_type, phone_no, users.image, address, users.slug, ar_name, ur_name", "users", "categories", 
			"ON (categories.id=users.`category_id`)", array("user_type"=>"employee", "category_id"=>$category));
			$data = $user->result();

			$message='All employee list in a category';
		}elseif($id!='' && $category==''){
			$user = $this->common_model->join_two_tab_where_simple((" 'false' as favourite, username, users.id as employee_id, category_id, 
			name as category_name, user_type, phone_no, users.image, address, users.slug, ar_name, ur_name"), 
			"users", "categories", "ON (categories.id=users.category_id)" , "user_type = 'employee'");
			$data = $user->result();
			foreach($data as $key=>$value){
				$favourite = $this->common_model->join_two_tab_where_simple((" favourite, username, employee_id"), "users", "favourite_user", 
						"ON (favourite_user.employer_id=users.id)" , array("favourite_user.employee_id"=>$value->employee_id, "users.id"=>$id));
					$fav_data_num = $favourite->num_rows();
					if($fav_data_num>0){
						$data[$key]->favourite = 'true';				
					}
			}
			$message='All employee list for a specific user';
		}elseif($id!='' && $category!=''){
			//get specific employes againset category with favourit true as well
			// $favourite=true;
			// $user = $this->common_model->join_three_tab_where_rows((" 'true' as favourite, username, '$id' as user_id, category_id, name as category_name, user_type, phone_no, users.image"), 
			// "users", "favourite_user", "ON (favourite_user.employee_id=users.id)" ,"categories", "ON (categories.id=users.category_id)" ,
			// array('employer_id'=>$id,  "category_id"=>$category));

			$user=$this->common_model->join_two_tab_where_simple(" 'false' as favourite, username, users.id as employee_id, name as category_name, 
			category_id, user_type, phone_no, users.image, address, users.slug, ar_name, ur_name", "users", "categories", 
			"ON (categories.id=users.`category_id`)", array("user_type"=>"employee", "category_id"=>$category));

			$data = $user->result();
			foreach($data as $key=>$value){
				$favourite = $this->common_model->join_two_tab_where_simple((" favourite, username, employee_id"), "users", "favourite_user", 
						"ON (favourite_user.employer_id=users.id)" , array("favourite_user.employee_id"=>$value->employee_id, "users.id"=>$id));
					$fav_data_num = $favourite->num_rows();
					if($fav_data_num>0){
						$data[$key]->favourite = 'true';				
					}
			}

			$message='All employee list for a specific user and specific category';
		}
		else{
			
			$user = $this->common_model->join_two_tab_where_simple(" 'false' as favourite, username, users.id as employee_id, 
			name as category_name, category_id, user_type, phone_no, users.image, email, address, users.slug, ar_name, ur_name", "categories", "users", 
			 "ON (categories.id=users.`category_id`)", "user_type = 'employee'");
			 $data = $user->result();

			$message='All employee list';
		}

		if($multiLang != ''){
			foreach($data as $key=>$value){
				$en_array[$key]['favourite']=$value->favourite;
				$en_array[$key]['username']=$value->username;
				$en_array[$key]['employee_id']=$value->employee_id;
				$en_array[$key]['category_id']=$value->category_id;
				$en_array[$key]['category_name']=$value->category_name;
				$en_array[$key]['user_type']=$value->user_type;
				$en_array[$key]['phone_no']=$value->phone_no;
				$en_array[$key]['image']=$value->image;
				$en_array[$key]['address']=$value->address;
				$en_array[$key]['slug']=$value->slug;
	
				$ur_array[$key]=$en_array[$key];
				$ur_array[$key]['category_name']=$value->ur_name;
				// $ur_array[$key]['price']=$value->ur_price;
				$ar_array[$key]=$en_array[$key];
				$ar_array[$key]['category_name']=$value->ar_name;
				// $ar_array[$key]['price']=$value->ar_price;
			}
			$result['data']['en'] = $en_array;
			$result['data']['ur'] = $ur_array;
			$result['data']['ar'] = $ar_array;
		}else{
		$result['data']=$data;	
		}
		

		//$data = $user->result();
		// $result['data']=$data;
		$result['message']['success'] = true;
		$result['message']['code']='500';
		$result['message']['msg']=$message;
		echo json_encode($result,JSON_UNESCAPED_UNICODE|JSON_UNESCAPED_SLASHES);exit;
		// echo "<pre>"; print_r($result); exit;

	}

	public function creatNewJob(){
		$data['employer_id']=$this->input->post('employer_id');
		$data['category_id']=$this->input->post('category_id');
		$data['en_job_description']=$this->input->post('en_job_description');
		$data['ar_job_description']=$this->input->post('ar_job_description');
		$data['ur_job_description']=$this->input->post('ur_job_description');
		$data['en_min_price']=$this->input->post('en_min_price');
		$data['en_max_price']=$this->input->post('en_max_price');
		$data['ar_min_price']=$this->input->post('ar_min_price');
		$data['ar_max_price']=$this->input->post('ar_max_price');
		$data['ur_min_price']=$this->input->post('ur_min_price');
		$data['ur_max_price']=$this->input->post('ur_max_price');
		$data['active']=$this->input->post('active');
		$user=$this->common_model->insert_array('jobs',$data);
		// $user=$this->common_model->select_all("*","jobs");
		$data['job_id']=$user;
		$result['data']=$data;
		$result['message']['success'] = true;
		$result['message']['code']='500';
		$result['message']['msg']='New job created';
		echo json_encode($result,JSON_UNESCAPED_UNICODE|JSON_UNESCAPED_SLASHES);exit;
	}

    public function jobUpdate(){
		// echo "jobupdate"; exit;
		$id = $this->input->post('job_id');
		$data['en_job_description']=$this->input->post('en_job_description');
		$data['ar_job_description']=$this->input->post('ar_job_description');
		$data['ur_job_description']=$this->input->post('ur_job_description');
		$data['en_min_price']=$this->input->post('en_min_price');
		$data['en_max_price']=$this->input->post('en_max_price');
		$data['ar_min_price']=$this->input->post('ar_min_price');
		$data['ar_max_price']=$this->input->post('ar_max_price');
		$data['ur_min_price']=$this->input->post('ur_min_price');
		$data['ur_max_price']=$this->input->post('ur_max_price');
		$data['category_id']=$this->input->post('category_id');
		// $status=$this->input->post('active');
		// echo $id;exit;
		$user=$this->common_model->select_where("*", "jobs", array('id'=>$id));
		$employer=$user->result();
		// echo "<pre>"; print_r($employer[0]->category_id);exit;
		if($user->num_rows()>0){
			$user1=$this->common_model->select_where("*", "jobs", array('id'=>$id, 'active'=>"Y"));
			if($user1->num_rows()>0){
				$this->common_model->update_array(array('id' => $id), 'jobs', $data);
				// $data['status']=$status;
				$data['employer_id']=$employer[0]->employer_id;
				// $data['category_id']=$employer[0]->category_id;
				unset($data['password']);
				$result['data']=$data;
				$result['message']['success'] = true;
				$result['message']['code']='500';
				$result['message']['msg']='Job updated';
			}else{
				$data=array();
				$result['data']=$data;
				$result['message']['success'] = false;
				$result['message']['code']='500';
				$result['message']['msg']='Job is not active so it cannot be updated';
			}
		}else{
			$data=array();
			$result['data']=$data;
			$result['message']['success'] = false;
			$result['message']['code']='500';
			$result['message']['msg']='This Job is not availible';
		}

		echo json_encode($result,JSON_UNESCAPED_UNICODE|JSON_UNESCAPED_SLASHES);exit;
	}

	public function deleteJob(){
		$id = $this->input->post('job_id');
		$user=$this->common_model->select_where("jobs.id job_id, employer_id, jobs.category_id, en_job_description,ar_job_description,ur_job_description,
		en_min_price, en_max_price,ar_min_price, ar_max_price, ur_min_price, ur_max_price, active", "jobs", array('id'=>$id));
		$data=$user->result();
		if($user->num_rows()>0){
			$this->common_model->delete_where(array('id'=>$id,), 'jobs');
			$result['data']=$data;
			$result['message']['success'] = true;
			$result['message']['code']='500';
			$result['message']['msg']='Job is deleted';
		}else{
			$data=array();
			$result['message']['success'] = true;
			$result['message']['code']='500';
			$result['message']['msg']='This job is already deleted';
		}
		echo json_encode($result,JSON_UNESCAPED_UNICODE|JSON_UNESCAPED_SLASHES);exit;
	}

	public function jobsListing(){
		$employe_id = $this->input->post('employee_id');
		// 		echo $employe_id; exit;
		$user=$this->common_model->join_three_tab_where_rows(" $employe_id as employee_id, jobs.id job_id, employer_id, categories.name, ur_name, ar_name, jobs.category_id, en_job_description,ar_job_description,ur_job_description,
		en_min_price, en_max_price,ar_min_price, ar_max_price, ur_min_price, ur_max_price, categories.image, active", 
		"jobs", "users", "on (jobs.category_id=users.category_id)", 
		"categories", "on (categories.id=jobs.category_id)", 
		array("jobs.active"=>"Y",  "users.id"=>$employe_id));
		// $data=$user->result();
		if($user->num_rows()>0){
			$data=$user->result();
			foreach($data as $key=>$value){
				$en_array[$key]['job_id']=$value->job_id;
				$en_array[$key]['employer_id']=$value->employer_id;
				$en_array[$key]['name']=$value->name;
				$en_array[$key]['category_id']=$value->category_id;
				$en_array[$key]['en_job_description']=$value->en_job_description;
				$en_array[$key]['en_min_price']=$value->en_min_price;
				$en_array[$key]['en_max_price']=$value->en_max_price;
				$en_array[$key]['category_image']=$value->image;
				$en_array[$key]['active']=$value->active;
	
				$ur_array[$key]=$en_array[$key];
				$ur_array[$key]['name']=$value->ur_name;
				$ur_array[$key]['en_job_description']=$value->ur_job_description;
				$ur_array[$key]['en_min_price']=$value->ur_min_price;
				$ur_array[$key]['en_max_price']=$value->ur_max_price;
	
				$ar_array[$key]=$en_array[$key];
				$ar_array[$key]['name']=$value->ar_name;
				$ar_array[$key]['en_job_description']=$value->ar_job_description;
				$ar_array[$key]['en_min_price']=$value->ar_min_price;
				$ar_array[$key]['en_max_price']=$value->ar_max_price;
			}
			$result['data']['en'] = $en_array;
			$result['data']['ur'] = $ur_array;
			$result['data']['ar'] = $ar_array;
			// $result['data']=$data;
			$result['message']['success'] = true;
			$result['message']['code']='500';
			$result['message']['msg']='All active jobs';
		}else{
			// echo "last 10 jobs"; exit;
			$user=$this->common_model->join_two_tab_where_limit_order(" $employe_id as employee_id, jobs.id job_id, employer_id, categories.name, ur_name, ar_name, jobs.category_id, en_job_description,ar_job_description,ur_job_description,
			en_min_price, en_max_price,ar_min_price, ar_max_price, ur_min_price, ur_max_price, categories.image, active", 
			"jobs", "categories", "on (categories.id=jobs.category_id)", 
			array("jobs.active"=>"Y"), "10", "jobs.id", "DSC");
			$data=$user->result();
			foreach($data as $key=>$value){
				$en_array[$key]['job_id']=$value->job_id;
				$en_array[$key]['employer_id']=$value->employer_id;
				$en_array[$key]['name']=$value->name;
				$en_array[$key]['category_id']=$value->category_id;
				$en_array[$key]['en_job_description']=$value->en_job_description;
				$en_array[$key]['en_min_price']=$value->en_min_price;
				$en_array[$key]['en_max_price']=$value->en_max_price;
				$en_array[$key]['category_image']=$value->image;
				$en_array[$key]['active']=$value->active;
	
				$ur_array[$key]=$en_array[$key];
				$ur_array[$key]['name']=$value->ur_name;
				$ur_array[$key]['en_job_description']=$value->ur_job_description;
				$ur_array[$key]['en_min_price']=$value->ur_min_price;
				$ur_array[$key]['en_max_price']=$value->ur_max_price;
	
				$ar_array[$key]=$en_array[$key];
				$ar_array[$key]['name']=$value->ar_name;
				$ar_array[$key]['en_job_description']=$value->ar_job_description;
				$ar_array[$key]['en_min_price']=$value->ar_min_price;
				$ar_array[$key]['en_max_price']=$value->ar_max_price;
			}
			$result['data']['en'] = $en_array;
			$result['data']['ur'] = $ur_array;
			$result['data']['ar'] = $ar_array;
			// $result['data']=$data;
			$result['message']['success'] = true;
			$result['message']['code']='500';
			$result['message']['msg']='Previous 10 jobs listed';
		}
		echo json_encode($result,JSON_UNESCAPED_UNICODE|JSON_UNESCAPED_SLASHES);exit;
		// echo "<pre>"; print_r($data);exit;
	}

	public function employerJobHistory(){
		$employer_id=$this->input->post('employer_id');
		$user=$this->common_model->join_three_tab_where_rows("jobs.id as job_id, username, employer_id, categories.name, ur_name, ar_name, jobs.category_id, en_job_description,ar_job_description,ur_job_description, en_min_price, en_max_price,ar_min_price, ar_max_price, ur_min_price, ur_max_price, categories.image category_image, active",
		"jobs", "users", "on (jobs.employer_id=users.id)", 
		"categories", "on (categories.id=jobs.category_id)", 
		array("jobs.employer_id"=>$employer_id));
		if($user->num_rows()>0){
			$data=$user->result();
			foreach($data as $key=>$value){
				$en_array[$key]['job_id']=$value->job_id;
				$en_array[$key]['employer_id']=$value->employer_id;
				$en_array[$key]['username']=$value->username;
				$en_array[$key]['name']=$value->name;
				$en_array[$key]['category_id']=$value->category_id;
				$en_array[$key]['en_job_description']=$value->en_job_description;
				$en_array[$key]['en_min_price']=$value->en_min_price;
				$en_array[$key]['en_max_price']=$value->en_max_price;
				$en_array[$key]['category_image']=$value->category_image;
				$en_array[$key]['active']=$value->active;
	
				$ur_array[$key]=$en_array[$key];
				$ur_array[$key]['name']=$value->ur_name;
				$ur_array[$key]['en_job_description']=$value->ur_job_description;
				$ur_array[$key]['en_min_price']=$value->ur_min_price;
				$ur_array[$key]['en_max_price']=$value->ur_max_price;
	
				$ar_array[$key]=$en_array[$key];
				$ar_array[$key]['name']=$value->ar_name;
				$ar_array[$key]['en_job_description']=$value->ar_job_description;
				$ar_array[$key]['en_min_price']=$value->ar_min_price;
				$ar_array[$key]['en_max_price']=$value->ar_max_price;
			}
			$result['data']['en'] = $en_array;
			$result['data']['ur'] = $ur_array;
			$result['data']['ar'] = $ar_array;
			
			$result['message']['success'] = true;
			$result['message']['code']='500';
			$result['message']['msg']='Previous jobs listed by this employer';
		}else{	
		    $data=array();
			$result['data']=$data;
			$result['message']['success'] = false;
			$result['message']['code']='500';
			$result['message']['msg']='No job history';
		}
		echo json_encode($result,JSON_UNESCAPED_UNICODE|JSON_UNESCAPED_SLASHES);exit;
	}

	public function jobsByCategory(){
		// $employee_id=$this->input->post('employee_id');
		$category_id=$this->input->post('category_id');
		$user=$this->common_model->join_two_tab_where_simple("jobs.id as job_id, category_id, name, ur_name, ar_name, employer_id, categories.image, en_job_description,ar_job_description,ur_job_description, en_min_price, en_max_price,ar_min_price, ar_max_price, ur_min_price, ur_max_price, active", "jobs", "categories", "on (jobs.category_id=categories.id)", array("category_id"=>$category_id));
		$data=$user->result();
		
		if($user->num_rows()>0){
			foreach($data as $key=>$value){
				$en_array[$key]['job_id']=$value->job_id;
				$en_array[$key]['employer_id']=$value->employer_id;
				$en_array[$key]['name']=$value->name;
				$en_array[$key]['category_id']=$value->category_id;
				$en_array[$key]['en_job_description']=$value->en_job_description;
				$en_array[$key]['en_min_price']=$value->en_min_price;
				$en_array[$key]['en_max_price']=$value->en_max_price;
				$en_array[$key]['category_image']=$value->image;
				$en_array[$key]['active']=$value->active;
	
				$ur_array[$key]=$en_array[$key];
				$ur_array[$key]['name']=$value->ur_name;
				$ur_array[$key]['en_job_description']=$value->ur_job_description;
				$ur_array[$key]['en_min_price']=$value->ur_min_price;
				$ur_array[$key]['en_max_price']=$value->ur_max_price;
	
				$ar_array[$key]=$en_array[$key];
				$ar_array[$key]['name']=$value->ar_name;
				$ar_array[$key]['en_job_description']=$value->ar_job_description;
				$ar_array[$key]['en_min_price']=$value->ar_min_price;
				$ar_array[$key]['en_max_price']=$value->ar_max_price;
			}
			$result['data']['en'] = $en_array;
			$result['data']['ur'] = $ur_array;
			$result['data']['ar'] = $ar_array;
			$result['message']['success'] = true;
			$result['message']['code']='500';
			$result['message']['msg']='All jobs listed in this category';
		}else{
		    $data=array();
            $result['data']=$data;
			$result['message']['success'] = false;
			$result['message']['code']='500';
			$result['message']['msg']='No job availible in this category';
		}
		echo json_encode($result,JSON_UNESCAPED_UNICODE|JSON_UNESCAPED_SLASHES);exit;
	}

	public function sevenCategories($count=''){
		$result=array();
		if($count != ''){
			$data = $this->common_model->select_limit_order("*", "categories", $count, "id", "ASC")->result();	
		}else{
			$data = $this->common_model->select_limit_order("*", "categories", "7", "id", "ASC")->result();	
		}
		
		//echo "<pre>"; print_r($data); exit;
		foreach($data as $key=>$value){
			$en_array[$key]['id']=$value->id;
			$en_array[$key]['name']=$value->name;
			$en_array[$key]['image']=$value->image;
			$en_array[$key]['price']=$value->price;
			$en_array[$key]['slug']=$value->slug;
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
		// echo "<pre>"; print_r($result);exit;
		$result['message']['code'] = '500';
		$result['message']['success'] = true;
		$result['message']['msg'] = '7 Categories listing';
		echo json_encode($result,JSON_UNESCAPED_UNICODE|JSON_UNESCAPED_SLASHES);exit;
	}
	
	public function jobsDetail(){
		$employee_id=$this->input->post('employee_id');
		$job_id=$this->input->post('job_id');
		$user=$this->common_model->join_three_tab_where_rows("username, employer_id, categories.name, ur_name, ar_name, jobs.category_id, en_job_description,ar_job_description,ur_job_description,
		en_min_price, en_max_price,ar_min_price, ar_max_price, ur_min_price, ur_max_price, active", 
		"jobs", "users", "on (jobs.employer_id=users.id)", 
		"categories", "on (categories.id=jobs.category_id)", 
		array("jobs.id"=>$job_id));
        // echo $job_id;exit;
		$apply=$this->common_model->select_where("*", "jobs_applied", array("job_id"=>$job_id, "employee_id"=>$employee_id, "job_applied"=>"Y"));
        // echo ($applynum_rows());exit;
		$data=$user->result();
		
		foreach($data as $key=>$value){
			if($apply->num_rows()>0){
				$en_array[$key]['apply']=True;
			}else{
				$en_array[$key]['apply']=false;
			}
			$en_array[$key]['employer_id']=$value->employer_id;
			$en_array[$key]['username']=$value->username;
			$en_array[$key]['name']=$value->name;
			$en_array[$key]['category_id']=$value->category_id;
			$en_array[$key]['en_job_description']=$value->en_job_description;
			$en_array[$key]['en_min_price']=$value->en_min_price;
			$en_array[$key]['en_max_price']=$value->en_max_price;
			$en_array[$key]['active']=$value->active;

			$ur_array[$key]=$en_array[$key];
			$ur_array[$key]['name']=$value->ur_name;
			$ur_array[$key]['en_job_description']=$value->ur_job_description;
			$ur_array[$key]['en_min_price']=$value->ur_min_price;
			$ur_array[$key]['en_max_price']=$value->ur_max_price;

			$ar_array[$key]=$en_array[$key];
			$ar_array[$key]['name']=$value->ar_name;
			$ar_array[$key]['en_job_description']=$value->ar_job_description;
			$ar_array[$key]['en_min_price']=$value->ar_min_price;
			$ar_array[$key]['en_max_price']=$value->ar_max_price;
		}
		

		if($user->num_rows()>0){
			$result['data']['en'] = $en_array;
			$result['data']['ur'] = $ur_array;
			$result['data']['ar'] = $ar_array;

			$result['message']['success'] = true;
			$result['message']['code']='500';
			$result['message']['msg']='Current job details';
		}else{
			
            $data=array();
			$result['data']=$data;
			$result['message']['success'] = true;
			$result['message']['code']='500';
			$result['message']['msg']='No detail availible for this job';
		}
		echo json_encode($result,JSON_UNESCAPED_UNICODE|JSON_UNESCAPED_SLASHES);exit;
		// echo "<pre>"; print_r($data);exit;
	}
	public function applyForAJob(){
		$user_id=$this->input->post('employe_id');
		$job_id=$this->input->post('job_id');
		$user=$this->common_model->select_where("*", "jobs", array("id"=>$job_id, "active"=>"Y"));
		$data=$user->result_array();
		// echo $user_id; exit;
		// echo "<pre>"; print_r($data); exit;
		if($user->num_rows()>0){
			$job=$this->common_model->join_two_tab_where_simple("*", "jobs_applied", "users", "on (jobs_applied.employee_id=users.id)", array("job_id"=>$job_id, "user_type"=>"employee", "employee_id"=>$user_id));
			if($job->num_rows()==0){
			$data=array(
				'job_id'=>$data[0]['id'],
				'employer_id'=>$data[0]['employer_id'],
				'employee_id'=>$user_id,
				'job_applied'=>True
			);
			$this->common_model->insert_array('jobs_applied', $data);

			$result['data']=$data;
			$result['message']['success'] = true;
			$result['message']['code']='500';
			$result['message']['msg']='You have applied for this job successfully';
			}else{
				// $this->common_model->delete_where(array('employee_id'=>$user_id, 'job_id'=>$job_id), 'jobs_applied');
				$data=array(
					'job_id'=>$job_id,
					'employer_id'=>$data[0]['employer_id'],
					'employee_id'=>$user_id,
					'job_applied'=>false
				);

				// $data=array();
				$result['data']=$data;
				$result['message']['success'] = false;
				$result['message']['code']='500';
				$result['message']['msg']='You have already this job';
			}
		}else{
			$data=array();
			$result['data']=$data;
			$result['message']['success'] = false;
			$result['message']['code']='500';
			$result['message']['msg']='This job is not availible';
		}
		echo json_encode($result,JSON_UNESCAPED_UNICODE|JSON_UNESCAPED_SLASHES);exit;
	}

	public function employeeAppliedForJob(){
		// echo "job"; exit;
		$job_id=$this->input->post('job_id');
		$user=$this->common_model->join_two_tab_where_simple("*", "jobs_applied", "users", "on (jobs_applied.employee_id=users.id)", array("job_id"=>$job_id, "user_type"=>"employee"));
		// echo "<pre>";print_r($user->result());exit;
		if($user->num_rows()>0){
			$data=$user->result();
			foreach($data as $key=>$value){
				unset($data[$key]->password);
				unset($data[$key]->google_id);
				unset($data[$key]->status);
			}
			
			$result['data']=$data;
			$result['message']['success'] = true;
			$result['message']['code']='500';
			$result['message']['msg']='The employee details who have applied for the job';
		}else{
			$data=array();
			$result['data']=$data;
			$result['message']['success'] = false;
			$result['message']['code']='500';
			$result['message']['msg']='No one have applies for this job';
		}
		echo json_encode($result,JSON_UNESCAPED_UNICODE|JSON_UNESCAPED_SLASHES);exit;
	}

	public function jobStatusUpdate(){
		$employer_id=$this->input->post('employer_id');
		$job_id=$this->input->post('job_id');
		$user=$this->common_model->select_where("*", "jobs" , array("employer_id"=>$employer_id, "id"=>$job_id, "active"=>"Y"));
		if($user->num_rows()>0){
			$data['active']="N";
			$this->common_model->update_array(array('id' => $job_id), 'jobs', $data);
			// $data=array();
			$result['data']=$data;
			$result['message']['success'] = False;
			$result['message']['code']='500';
			$result['message']['msg']='This job is deactivated';	
		}else{
			$data['active']="Y";
			$this->common_model->update_array(array('id' => $job_id), 'jobs', $data);
			// $data=array();
			$result['data']=$data;
			$result['message']['success'] = True;
			$result['message']['code']='500';
			$result['message']['msg']='This Job is activated again';	
		}
		echo json_encode($result,JSON_UNESCAPED_UNICODE|JSON_UNESCAPED_SLASHES);exit;
	}

	public function privacyPolicy(){
		$user=$this->common_model->select_all("*", "settings");
		// echo "<pre>"; print_r($user->result());exit;
		$data=$user->result();
		// echo strip_tags($data[0]->privacy_policy);exit;
		foreach($data as $key=>$value){
			$en_array[$key]['id']=$value->id;
			$en_array[$key]['terms']=strip_tags($value->terms);
			$en_array[$key]['privacy_policy']=strip_tags($value->privacy_policy);
			$en_array[$key]['vedio_link']=strip_tags($value->vedio_link);
			$en_array[$key]['added_date']=strip_tags($value->added_date);

			$ur_array[$key]=$en_array[$key];
			$ur_array[$key]['terms']=strip_tags($value->ur_terms);
			$ur_array[$key]['privacy_policy']=strip_tags($value->ur_policy);

			$ar_array[$key]=$en_array[$key];
			$ar_array[$key]['terms']=strip_tags($value->ar_terms);
			$ar_array[$key]['privacy_policy']=strip_tags($value->ar_policy);
		}
		$result['data']['en'] = $en_array;
		$result['data']['ur'] = $ur_array;
		$result['data']['ar'] = $ar_array;
		
		//echo "<pre>"; print_r($result); exit;

		// $result['ar'] = $data;
		$result['message']['code'] = '500';
		$result['message']['success'] = true;
		$result['message']['msg'] = 'Terms & conditions and Privacy Policy';
		echo json_encode($result,JSON_UNESCAPED_UNICODE|JSON_UNESCAPED_SLASHES);exit;
	}

	public function contactUs(){
		$data['name']=$this->input->post('name');
		$data['email']=$this->input->post('email');
		$data['comments']=$this->input->post('comments');

		$user=$this->db->insert('contact_us',$data);
		if($user>0){
			$result['data']=$data;
			$result['message']['code'] = '500';
			$result['message']['success'] = true;
			$result['message']['msg'] = 'Your query will be entertained as soon as possible';
		}else{
			$data=array();
			$result['data']=$data;
			$result['message']['code'] = '500';
			$result['message']['success'] = true;
			$result['message']['msg'] = 'Your Questions was not posted';
		}
		echo json_encode($result,JSON_UNESCAPED_UNICODE|JSON_UNESCAPED_SLASHES);exit;
	}
}
