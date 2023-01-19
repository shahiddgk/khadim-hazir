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
		$data['sub_categories'] = $this->common_model->select_where("*", "sub_categories", array('language'=>'arb'))->result_array();
		$this->load->view('front/header');
		$this->load->view('front/sign_up',$data);
		$this->load->view('front/footer');
	}

	public function sign_in(){
		$this->load->view('front/header');
		$this->load->view('front/sign_in');
		$this->load->view('front/footer');
	}
}
