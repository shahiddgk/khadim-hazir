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

	// public function google_login(){
	  
	// 	echo "<pre>here"; print_r($data); exit;
	// 	if(isset($_GET["code"]))
	// 	{

	// 	 $token = $google_client->fetchAccessTokenWithAuthCode($_GET["code"]);

	// 	}

	// 	else{
	// 		echo "Error"; exit;
	// 	}
	// }
	
	public function sign_up(){
		// $data['google_login_url'] = $this->google->createAuthUrl();
		$this->load->view('front/header');
		$this->load->view('front/sign_up');
		$this->load->view('front/footer');
	}

	public function sign_in(){
		// $data['google_login_url'] = $this->google->createAuthUrl();
		$this->load->view('front/header');
		$this->load->view('front/sign_in');
		$this->load->view('front/footer');
	}


	// public function authenticate(){
	// 	if(isset($_GET['code'])){ 
				
	// 			$authenticate = $this->google->authenticate($this->input->get('code'));
	// 			// $this->session->set_userdata('access_token', $this->google->getAccessToken());
			
	// 			echo "<pre>"; print_r($authenticate); exit;
	// 		if ($this->session->has_userdata('access_token') && $this->session->userdata('access_token')) {
	// 			$this->client->setAccessToken($this->session->userdata('access_token'));
	// 			$people = new Google_Service_Oauth2($this->client);
	// 			// $person = $people->userinfo_v2_me->get(); 
				
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
					
	// 			echo "<pre>"; print_r($userData); exit;
	// 		}
	// 	}
	// 	else{
	// 		echo "Authentication failed"; exit;
	// 	}

	// }

	// public function google_validate_login() {

    //     if ($this->session->userdata('google_user')) {
    //         $google_user = $this->session->userdata('google_user');
            
    //         $email = $google_user['email'];
    //         $credential = array('email' => $email, 'status' => 1);

    //         // Checking login credential for admin
    //         $query = $this->db->get_where('users', $credential);

    //         if ($query->num_rows() > 0) {
    //             $row = $query->row();
    //             $this->session->set_userdata('user_id', $row->id);
    //             $this->session->set_userdata('role_id', $row->role_id);
    //             $this->session->set_userdata('role', get_user_role('user_role', $row->id));
    //             $this->session->set_userdata('name', $row->first_name . ' ' . $row->last_name);
    //             $this->session->set_userdata('is_instructor', $row->is_instructor);
    //             $this->session->set_flashdata('flash_message', get_phrase('welcome') . ' ' . $row->first_name . ' ' . $row->last_name);
                
    //             // echo "<pre>"; print_r($_SESSION); exit;
    //             if ($row->role_id == 2) {
    //                 $this->session->set_userdata('user_login', '1');

    //                 if($this->session->userdata('url_history')){
    //                     redirect($this->session->userdata('url_history'), 'refresh');
    //                 }
    //                 redirect(site_url('my_courses'), 'refresh');
    //             }
    //         } 
    //     }
    //     else {
    //         $this->session->set_flashdata('error_message', get_phrase('invalid_login_credentials'));
    //         redirect(site_url('home/login'), 'refresh');
    //     }
    // }
}
