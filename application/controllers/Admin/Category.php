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
	public function index() 
	{
		$data = $this->common_model->select_all_order_by("*", "categories", "id", "DESC");
		//echo "<pre>"; print_r($data->result());
		$result['categories'] = $data->result();
		$this->load->view('admin/admin_header');
		$this->load->view('admin/category/category',$result);
		$this->load->view('admin/admin_footer');

	}
	
	function insert_category()
	{	
		$data['name'] = $this->input->post('name');
		$data['ar_name'] = $this->input->post('ar_name');
		$data['ur_name'] = $this->input->post('ur_name');
		$data['price'] = $this->input->post('price');
		$data['ar_price'] = $this->input->post('ar_price');
		$data['ur_price'] = $this->input->post('ur_price');
		$data['slug'] = $this->input->post('slug');
		if($_FILES['image_file']['name']!=''){
			$img   =   $_FILES['image_file']['name'];
			$image =   str_replace(" ","-",strtolower(time().'cat_'.$img));
			$data['image']  =  $image;
			$temp   =  $_FILES['image_file']['tmp_name'];       
			if (!file_exists(FCPATH.'uploads/category')) {
				mkdir(FCPATH.'uploads/category', 0755, true);
			} 
			$path= FCPATH.'uploads/category/'.$image;
			move_uploaded_file($temp,$path);
		}		
		$this->common_model->insert_array('categories', $data);

		$this->session->set_userdata('success',$data['name']);		
		redirect(site_url().'admin/category'); 
	}

	function delete_category($id)
	{
		$this->common_model->delete_where(array('id'=>$id), 'categories');
		// $this->common_model->delete_where(array('category_id'=>$id), 'category_img');
		redirect(site_url().'admin/category');  
	}

	function edit_category($id)
	{
		$data= $this->common_model->select_where("*", "categories", array('id'=>$id));
		$result['categories'] = $data->result();
		$this->load->view('admin/admin_header');
		$this->load->view('admin/category/edit_category',$result);
		$this->load->view('admin/admin_footer');
		 
	}

	function add_category()
	{
		$this->load->view('admin/admin_header');
		$this->load->view('admin/category/add_category');
		$this->load->view('admin/admin_footer');
		 
	}

	function update_category()
	{	
		// echo  "<pre>"; print_r($_POST); 
		// echo  "<pre>"; print_r($_FILES);  exit();
		$id = $this->input->post('id');
		$data['name'] = $this->input->post('name');
		$data['ar_name'] = $this->input->post('ar_name');
		$data['ur_name'] = $this->input->post('ur_name');
		$data['price'] = $this->input->post('price');
		$data['ar_price'] = $this->input->post('ar_price');
		$data['ur_price'] = $this->input->post('ur_price');
		$data['slug'] = $this->input->post('slug');		
		if($_FILES['image_file']['name']!=''){
			$img   =   $_FILES['image_file']['name'];
			$image =   str_replace("category_".time(),$img,$img);
			$data['image']  =  $image;
			$temp   =  $_FILES['image_file']['tmp_name'];
			$path= FCPATH.'uploads/category/'.$image;
			move_uploaded_file($temp,$path);
		}
		$this->common_model->update_array(array('id'=>$id), 'categories', $data);

		$this->session->set_userdata('success',$data['name']);
		
		redirect(site_url().'admin/category'); 
	}
	
}