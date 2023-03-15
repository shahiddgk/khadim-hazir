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
	public function sign_up(){
		$data['categories'] = $this->common_model->select_where("*", "categories", array('language'=>'eng'))->result_array();
		$data['sub_categories'] = $this->common_model->select_where("*", "sub_categories", array('language'=>'eng'))->result_array();
		$this->load->view('front/header');
		$this->load->view('front/sign_up',$data);
		$this->load->view('front/footer');
	}

	public function sign_in(){
		$this->load->view('front/header');
		$this->load->view('front/sign_in');
		$this->load->view('front/footer');
	}

    public function user_lists($sub_id){
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

		$this->load->view('front/header');
        $this->load->view('user/user_detail',$data);
        $this->load->view('front/footer');
		} else {
			$this->session->set_flashdata('msg', 'Plese First Login.');
			redirect(site_url().'user/sign_in');
		}
    }

	public function send_mail_user($user_id){
		$query = $this->common_model->select_where("email", "users", array('id'=>$user_id))->row_array();
		$config = Array(
			'protocol' => 'smtp',
			'smtp_host' => 'smtp.gmail.com',
			'smtp_port' => 465,
			'smtp_user' => 'info.azoozy@gmail.com', // change it to yours
			'smtp_pass' => 'Delegate@access2022', // change it to yours
			'mailtype' => 'html',
			'charset' => 'utf-8',
			'wordwrap' => TRUE
		);
		$to_mail = $query["email"];
		$this->load->library('email', $config);
		$this->email->set_header('MIME-Version', '1.0; charset=utf-8');
		$this->email->set_header('Content-type', 'text/html');
		$this->email->set_newline("\r\n");
		$this->email->from('Azoozy.com'); // change it to yours
		$this->email->to($to_mail);// change it to yours
		$this->email->subject((string) $this->lang->line('subscription_successfull'));
		$this->email->message($this->load->view('front/emails/subscription', '', TRUE));
		$this->email->send();
	}

}