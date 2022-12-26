<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class User extends CI_Controller {

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
	public $language;
	function __construct() {
		parent:: __construct();
		$this->load->library('session');
		// require_once('vendor/autoload.php');
		
		// $this->google = new Google_Client();
		// $this->google->setClientId('411497194457-mholnatie510q2m0mjfo6597evl8vucm.apps.googleusercontent.com'); 
		// $this->google->setClientSecret('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'); 
		// $this->google->setRedirectUri('http://localhost/khadim-hazir/user/authenticate');
		// $this->google->addScope('email');
		// $this->google->addScope('profile');

		if($this->session->userdata('language')){
			$this->language = $this->session->userdata('language');
			$this->lang->load($this->language.'_lang', 'english');
		}
		else if($this->language = 'urd'){
			$this->lang->load('urd_lang', 'english');
			$this->session->set_userdata('language', 'urd');
		}
		else{
			$this->language = 'arb';
			$this->lang->load('arb_lang', 'english');
			$this->session->set_userdata('language', 'arb');
		}
		
	}

	
    // public function index(){ 
	// 	/* Redirect to profile page if the user already logged in */
	// 	if($this->session->userdata('loggedIn') == true){ 
	// 		redirect('user_authentication/profile/'); 
	// 	} 
		
	// 	if(isset($_GET['code'])){ 
				
	// 			/* Authenticate user with google */
	// 		if($this->google->getAuthenticate()){ 
				
	// 				/* Get user info from google */
	// 			$gpInfo = $this->google->getUserInfo(); 
					
	// 				/* Preparing data for database insertion */
	// 			$userData['oauth_provider']    = 'google'; 
	// 			$userData['oauth_uid']         = $gpInfo['id']; 
	// 			$userData['first_name']        = $gpInfo['given_name']; 
	// 			$userData['last_name']         = $gpInfo['family_name']; 
	// 			$userData['email']             = $gpInfo['email']; 
	// 			$userData['gender']            = !empty($gpInfo['gender'])?$gpInfo['gender']:''; 
	// 			$userData['locale']            = !empty($gpInfo['locale'])?$gpInfo['locale']:''; 
	// 			$userData['picture']           = !empty($gpInfo['picture'])?$gpInfo['picture']:''; 
					
	// 				/* Insert or update user data to the database  */
	// 			$userID = $this->user->checkUser($userData); 
					
	// 				/* Store the status and user profile info into session */
	// 			$this->session->set_userdata('loggedIn', true); 
	// 			$this->session->set_userdata('userData', $userData); 
					
	// 				/* Redirect to profile page */
	// 			redirect('user_authentication/profile/'); 
	// 		} 
	// 	}  
			
	// 		/* Google authentication url */
	// 	$data['loginURL'] = $this->google->loginURL(); 
			
	// 		/* Load google login view */
	// 	$this->load->view('user_authentication/index',$data); 
	// } 

	

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


	public function google_login(){
	  
		echo "<pre>here"; print_r($data); exit;
		if(isset($_GET["code"]))
		{

		 $token = $google_client->fetchAccessTokenWithAuthCode($_GET["code"]);

		}

		else{
			echo "Error"; exit;
		}
	}
	
	public function sign_up(){
		// $data['google_login_url'] = $this->google->createAuthUrl();
		$data = '';
		$this->load->view('front/header');
		$this->load->view('front/sign_up', $data);
		$this->load->view('front/footer');
	}

	public function sign_in(){
		// $data['google_login_url'] = $this->google->createAuthUrl();
		$data = '';
		$this->load->view('front/header');
		$this->load->view('front/sign_in', $data);
		$this->load->view('front/footer');
	}

	// if (isset($_GET['code'])) {
	// 	$this->client->authenticate($this->input->get('code'));
	// 	$this->session->set_userdata('access_token', $this->client->getAccessToken());
	// }
	// if ($this->session->has_userdata('access_token') && $this->session->userdata('access_token')) {
	// 	$this->client->setAccessToken($this->session->userdata('access_token'));
	// 	$people = new Google_Service_Oauth2($this->client);
	// 	// $person = $people->userinfo_v2_me->get();

	// 	echo "<pre>"; print_r($_SESSION); 
	// 	echo "<pre>"; print_r($person); exit();
	// 	$info['id'] = $person->getId();
	// 	$info['email'] = $person->getEmail();
	// 	$info['name'] = $person->getName();
	// 	$info['photo'] = $person->getPicture();
	// 	$info['link'] = $person->getLink();
	// 	$info['profile_pic'] = $person->getPicture();

	// 	echo "<pre>"; print_r($info); exit();
	// 	return $info;
	// }

	public function authenticate(){
		if(isset($_GET['code'])){ 
				
				$authenticate = $this->google->authenticate($this->input->get('code'));
				// $this->session->set_userdata('access_token', $this->google->getAccessToken());
			
				echo "<pre>"; print_r($authenticate); exit;
			if ($this->session->has_userdata('access_token') && $this->session->userdata('access_token')) {
				$this->client->setAccessToken($this->session->userdata('access_token'));
				$people = new Google_Service_Oauth2($this->client);
				// $person = $people->userinfo_v2_me->get(); 
				
					/* Get user info from google */
				$gpInfo = $this->google->getUserInfo(); 
					
					/* Preparing data for database insertion */
				$userData['oauth_provider']    = 'google'; 
				$userData['oauth_uid']         = $gpInfo['id']; 
				$userData['first_name']        = $gpInfo['given_name']; 
				$userData['last_name']         = $gpInfo['family_name']; 
				$userData['email']             = $gpInfo['email']; 
				$userData['gender']            = !empty($gpInfo['gender'])?$gpInfo['gender']:''; 
				$userData['locale']            = !empty($gpInfo['locale'])?$gpInfo['locale']:''; 
				$userData['picture']           = !empty($gpInfo['picture'])?$gpInfo['picture']:''; 
					
				echo "<pre>"; print_r($userData); exit;
			}
		}
		else{
			echo "Authentication failed"; exit;
		}

	}

	public function google_validate_login() {

        if ($this->session->userdata('google_user')) {
            $google_user = $this->session->userdata('google_user');
            
            $email = $google_user['email'];
            $credential = array('email' => $email, 'status' => 1);

            // Checking login credential for admin
            $query = $this->db->get_where('users', $credential);

            if ($query->num_rows() > 0) {
                $row = $query->row();
                $this->session->set_userdata('user_id', $row->id);
                $this->session->set_userdata('role_id', $row->role_id);
                $this->session->set_userdata('role', get_user_role('user_role', $row->id));
                $this->session->set_userdata('name', $row->first_name . ' ' . $row->last_name);
                $this->session->set_userdata('is_instructor', $row->is_instructor);
                $this->session->set_flashdata('flash_message', get_phrase('welcome') . ' ' . $row->first_name . ' ' . $row->last_name);
                
                // echo "<pre>"; print_r($_SESSION); exit;
                if ($row->role_id == 2) {
                    $this->session->set_userdata('user_login', '1');

                    if($this->session->userdata('url_history')){
                        redirect($this->session->userdata('url_history'), 'refresh');
                    }
                    redirect(site_url('my_courses'), 'refresh');
                }
            } 
        }
        else {
            $this->session->set_flashdata('error_message', get_phrase('invalid_login_credentials'));
            redirect(site_url('home/login'), 'refresh');
        }
    }
}
