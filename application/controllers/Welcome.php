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
	 * @see https://codeigniter.com/userguide3/general/urls.html
	 */
	public $language;
	function __construct() {
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
	public function index($subcate='') {
	    
	   // $this->load->view('front/under-construction');
	    
		// $data['categories'] = $this->common_model->select_where("*", "categories", array('language'=>$this->language));

		$data['category'] = $this->common_model->select_all("*", "categories");

		foreach($data['category']->result() as $row) {
			$data['categories'][$row->category_id][$row->language]['name'] = $row->name; 
			$data['categories'][$row->category_id][$row->language]['category_id'] = $row->category_id; 
			$data['categories'][$row->category_id][$row->language]['image'] = $row->image; 
		}

		$data['subcategories']  = $this->common_model->select_where_ASC_DESC("table_id, name, image_name, region_id", "brands", array('language'=>$this->language), "priority", "ASC");
		$data['subname'] = "";
		if($subcate!=""){
			$data['subname'] = $this->common_model->select_single_field("name" ,"brands", array('region_id'=>$subcate, 'language'=>$this->language));
		}
		
		$data['subcateid'] = $subcate;
		//if user not logged in then registraiton popup will show else payment popup will show up.
		$data['popup'] = '';
		if($this->session->userdata('user_logged_in') && $subcate!=''){
			if($this->session->userdata('paymentstatus')=='unpaid'){
				$data['popup'] = 'subcription';
			}
		}
		else if($subcate!=''){
			$data['popup'] = 'registration';
		}
		$this->load->view('front/header');
		$this->load->view('front/home', $data);
		$this->load->view('front/footer');
	}

	
	public function set_session($lang=null){
		if($lang!=""){
			$this->session->set_userdata('language', $lang);
		}
	}

	public function subCategory($id) {
		
		$response = $this->common_model->select_where("*", "sub_categories", array('category_id'=>$id)); 
		if($response->num_rows()>0) {
			foreach($response->result() as $row) {
				$data['sub_categories'][$row->sub_id][$row->language]['name'] = $row->name; 
				$data['sub_categories'][$row->sub_id][$row->language]['sub_id'] = $row->sub_id; 
				$data['sub_categories'][$row->sub_id][$row->language]['image'] = $row->image; 
			}
		}
		else{
			$data = array();
		}
			
		$this->load->view('front/header');
		$this->load->view('front/sub_category', $data);
		$this->load->view('front/footer');
		
	}
	
}
