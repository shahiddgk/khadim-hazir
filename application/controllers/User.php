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

	function __construct()
	{
		parent::__construct();
		$this->load->library('google');
		$this->load->library('session');
		if ($this->session->userdata('language')) {
			$this->language = $this->session->userdata('language');
			$this->lang->load($this->language.'_lang', 'english');
		} else if ($this->language == 'urd') {
			$this->lang->load('urd_lang', 'english');
			$this->session->set_userdata('language', 'urd');
		} else {
			$this->language = 'arb';
			$this->lang->load('arb_lang', 'english');
			$this->session->set_userdata('language', 'arb');
		}
	}
	
	public function google_login()
	{
		$google_data = $this->google->validate();
        if(isset($google_data)){
			$session_data = array(
				'id'=>$google_data['id'],
                'name'=>$google_data['name'],
                'email'=>$google_data['email'],
                'source'=>'google',
                'profile_pic'=>$google_data['profile_pic'],
                'link'=>$google_data['link']
            );
			
            $this->session->set_userdata('google_user', $session_data);
            $is_register = $this->social_login_modal->is_already_register($session_data['email']);
			
            if($is_register == 'false'){
				
				$user_data['google_id'] = $google_data['id']; 
				$user_data['name'] = $google_data['name'];
				$user_data['email'] = $google_data['email'];
				$user_data['phone_no'] = ''; 
				$user_data['password'] = ''; 
				
				$this->db->insert('users', $user_data);
				$user_id = $this->db->insert_id();  
				if(!empty($user_id)){
					redirect(site_url('user/sign_up'));
				}
				
				else{
					$this->session->set_flashdata('error_message', 'Session not set!');
					redirect(site_url('user/sign_up'));
				}
			}
			
            elseif($is_register == 'true'){

                $this->db->where('email' , $session_data['email'])->update('users', array('google_id'=>$session_data['id']));
				redirect(site_url('user/sign_up'));
            }
        }
	}

	public function sign_up()
	{
		$data['categories'] = $this->common_model->select_where("*", "categories", array('language'=>'eng'))->result_array();
		$data['sub_categories'] = $this->common_model->select_where("*", "sub_categories", array('language'=>'eng'))->result_array();
		$data['google_login_url']=$this->google->get_login_url();
		
		$this->load->view('front/header');
		$this->load->view('front/sign_up',$data);
		$this->load->view('front/footer');
    }

	public function sign_in()
	{
		$data['google_login_url']=$this->google->get_login_url();

		$this->load->view('front/header');
		$this->load->view('front/sign_in', $data);
		$this->load->view('front/footer');
	}

    public function user_lists($sub_id)
	{
		if ($this->session->userdata('user_logged_in')) { 

        $data['users'] = $this->common_model->select_where("*", "users", array('sub_id'=>$sub_id))->result_array();
		$data['sub_categories'] = $this->common_model->select_where("*", "sub_categories", array('sub_id'=>$sub_id,'language'=>'eng' ))->result_array();

		$this->load->view('front/header');
        $this->load->view('front/user_list',$data);
        $this->load->view('front/footer');
		} else {
			$this->session->set_flashdata('msg', 'Plese First Login.');
			redirect(site_url().'user/sign_in');
		}

    }

	public function user_detail($id)
	{
		if ($this->session->userdata('user_logged_in')) { 
			$data['users'] = $this->common_model->select_where("*", "users", array('id'=>$id))->result_array();
			$query = $this->db->query("SELECT SUM(rating) as total_rating FROM user_review WHERE user_id = '$id'");
			$user_total_rating = $query->row_array()['total_rating'];
			$query = $this->db->query("SELECT hiring.*, users.name AS employer_name, users.email AS employer_email FROM hiring JOIN users ON hiring.employer_id = users.id WHERE hiring.employee_id = '$id'");
			$hiring = $query->result_array();

			$user_rating = $this->common_model->select_where('*', 'user_review', array('user_id' => $id))->row_array();

			if (empty($user_rating)) {
				$user_rating['rating'] = 0;
			}

			$user_rating['total_rating'] = $user_total_rating;

			$data['user_rating'] = $user_rating;
			$data['hiring'] = $hiring;

			$this->load->view('front/header');
			$this->load->view('user/user_detail', $data);
			$this->load->view('front/footer');
		} else {
			$this->session->set_flashdata('msg', 'Please first login.');
			redirect(site_url().'user/sign_in');
		}
	}

	public function send_mail_user($user_id)
	{
		$query = $this->common_model->select_where("email", "users", array('id'=>$user_id))->row_array();
		$config = Array(
			'protocol' => 'smtp',
			'smtp_host' => 'smtp.gmail.com',
			'smtp_port' => 465,
			'smtp_user' => 'haseeb@ratedsolution.com', // change it to yours
			'smtp_pass' => 'H_*A!n8eUfq(', // change it to yours
			'mailtype' => 'html',
			'charset' => 'utf-8',
			'wordwrap' => TRUE
		);
		$to_mail = $query["email"];
		$this->load->library('email', $config);
		$this->email->set_header('MIME-Version', '1.0; charset=utf-8');
		$this->email->set_header('Content-type', 'text/html');
		$this->email->set_newline("\r\n");
		$this->email->from('khadim-hazir.com'); // change it to yours
		$this->email->to($to_mail);// change it to yours
		$this->email->subject((string) $this->lang->line('subscription_successfull'));
		$this->email->message($this->load->view('front/emails/subscription', '', TRUE));
		$this->email->send();

		$data = array(
			'employee_id' => $user_id,
			'employer_id' => $_SESSION['user_id'],
            'status'      => 'pending'
		);
		$this->common_model->insert_array('hiring', $data);

	}

	public function submit_review($user_id, $given_by) 
	{
		$rating = $this->input->post('rating');
		$comment = $this->input->post('comment');
		$data = array(
			'user_id' => $user_id,
			'given_by' => $given_by,
			'rating' => $rating,
			'comment' => $comment
		);
		$this->common_model->insert_array('user_review', $data);
		redirect('user/user_detail/'.$user_id);
	}
		  
	public function add_review($user_id)
	{
        $data['users'] = $this->common_model->select_where("*", "users", array('id'=>$user_id))->result_array();
		
		$this->load->view('front/header');
		$this->load->view('user/add_review', $data); 
        $this->load->view('front/footer');
	}			

	public function user_type()
	{
		$data['categories'] = $this->common_model->select_where("*", "categories", array('language'=>'eng'))->result_array();
		$data['sub_categories'] = $this->common_model->select_where("*", "sub_categories", array('language'=>'eng'))->result_array();
		
		$this->load->view('front/header');
		$this->load->view('front/user_type',$data);
		$this->load->view('front/footer');
    }


}