<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Category extends CI_Controller {

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
	function __construct()
	{
		parent:: __construct();
		$this->load->library('form_validation');
		$this->load->helper('cookie');
		
	}
	public function index() {

		// $header_data['title'] = "Product Listing";
		// $header_data['heading'] = "Our Brands";
		// Getting all products

		// echo base_url().'<br>';
		// echo APPPATH.'<br>';
		// echo PATH_DIR.'<br>';
		// echo site_url(); exit;
		$data['category'] = $this->common_model->select_all("*", "categories");

		foreach($data['category']->result() as $row) {
			$data['categories'][$row->category_id][$row->language]['name'] = $row->name; 
			$data['categories'][$row->category_id][$row->language]['category_id'] = $row->category_id; 
			$data['categories'][$row->category_id][$row->language]['image'] = $row->image; 
		}
		$this->load->view('admin/admin_header');
		$this->load->view('admin/category/category',$data);
		$this->load->view('admin/admin_footer');

	}
	
	function insert_category()
	{	
		$data['category_id'] = time();
		
		$eng_data['category_id']  = $data['category_id'];
		$eng_data['language'] = "eng";
		$eng_data['name'] = $this->input->post('category_name');
		if($_FILES['image_file']['name']!=''){

			$img   =   $_FILES['image_file']['name'];
			$image =   str_replace(" ","-",strtolower(time().'cat_'.$img));
			$eng_data['image']  =  $image;
			$temp   =  $_FILES['image_file']['tmp_name'];       
			if (!file_exists(PATH_DIR.'uploads/category')) {
				mkdir(PATH_DIR.'uploads/category', 0755, true);
			} 
			$path= PATH_DIR.'uploads/category/'.$image;
			move_uploaded_file($temp,$path);

		}
		$this->common_model->insert_array('categories', $eng_data);
		$data['language'] = "arb";
		$data['name'] = $this->input->post('arabic_name');
		$this->common_model->insert_array('categories', $data);
		$data['language'] = "urd";
		$data['name'] = $this->input->post('urdu_name');
		$this->common_model->insert_array('categories', $data);

		$this->session->set_userdata('success',$data['name']);
		
		redirect(site_url().'admin/category'); 
	}

	function delete_category($id)
	{
		$this->common_model->delete_where(array('category_id'=>$id), 'categories');
		// $this->common_model->delete_where(array('category_id'=>$id), 'category_img');
		redirect(site_url().'admin/category');  
	}

	function edit_category($id)
	{
		$data['category'] = $this->common_model->select_where("*", "categories", array('category_id'=>$id));
		foreach($data['category']->result() as $row) {
			$data['categories'][$row->category_id][$row->language]['name'] = $row->name; 
			$data['categories'][$row->category_id][$row->language]['category_id'] = $row->category_id; 
		}
		$this->load->view('admin/admin_header');
		$this->load->view('admin/category/edit_category',$data);
		$this->load->view('admin/admin_footer');
		 
	}

	function update_category()
	{	
		// echo  "<pre>"; print_r($_POST); 
		// echo  "<pre>"; print_r($_FILES);  exit();
		$id = $this->input->post('category_id');
		$data['name'] = $this->input->post('category_name');
	
		$this->common_model->update_array(array('category_id'=>$id,'language'=>'eng'), 'categories', $data);
		
		$data['name'] = $this->input->post('arabic_name');
		$this->common_model->update_array(array('category_id'=>$id,'language'=>'arb'), 'categories', $data);
		
		$data['name'] = $this->input->post('urdu_name');
		$this->common_model->update_array(array('category_id'=>$id,'language'=>'urd'), 'categories', $data);

		if($_FILES['image_file']['name']!=''){

			$img   =   $_FILES['image_file']['name'];
			$image =   str_replace("category_".time(),$img,$img);
			$eng_data['image']  =  $image;
			$temp   =  $_FILES['image_file']['tmp_name'];
			$path= PATH_DIR.'uploads/category/'.$image;
			move_uploaded_file($temp,$path);
			$this->common_model->update_array(array('category_id'=>$id,'language'=>'eng'), 'categories', $eng_data);

		}
		$this->session->set_userdata('success',$data['name']);
		
		redirect(site_url().'admin/category'); 
	}
	
}
