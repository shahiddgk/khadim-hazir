<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Service extends CI_Controller {

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
		// $data['category'] = $this->common_model->select_all("*", "sub_categories");

		$data = $this->common_model->select_all_order_by("*", "sub_categories", "id", "DESC");
		$result['sub_categories'] = $data->result();

		// foreach($data['category']->result() as $row) {
		// 	$data['sub_categories'][$row->sub_id][$row->language]['name'] = $row->name; 
		// 	$data['sub_categories'][$row->sub_id][$row->language]['category_id'] = $row->category_id; 
		// 	$data['sub_categories'][$row->sub_id][$row->language]['sub_id'] = $row->sub_id; 
		// 	$data['sub_categories'][$row->sub_id][$row->language]['category_name'] = $this->db->select('name')->from('categories')->where(array("category_id"=>$row->category_id,"language"=>'eng'))->get()->row_array();
		// 	$data['sub_categories'][$row->sub_id][$row->language]['image'] = $row->image; 
		// 	$data['sub_categories'][$row->sub_id][$row->language]['price'] = $row->price; 
		// 	$data['sub_categories'][$row->sub_id][$row->language]['currency'] = $row->currency; 
		// }

		$this->load->view('admin/admin_header');
		$this->load->view('admin/service/service_listing',$result);
		$this->load->view('admin/admin_footer');
	}

	public function add_service() 
	{

		$data['categories'] = $this->common_model->select_all("*", "categories" )->result_array();
		$this->load->view('admin/admin_header');
		$this->load->view('admin/service/add_service', $data);
		$this->load->view('admin/admin_footer');

	}

	function insert_service()
	{	
		// $data['sub_id'] = time();
		$data['category_id'] = $this->input->post('category_id');
		// $eng_data['category_id']  = $this->input->post('category_id');
		// $eng_data['sub_id']  = $data['sub_id'];
		// $eng_data['language'] = "eng";
		$data['name'] = $this->input->post('name');
		$data['ar_name'] = $this->input->post('ar_name');
		$data['ur_name'] = $this->input->post('ur_name');
		$data['price'] = $this->input->post('price');
		$data['ar_price'] = $this->input->post('ar_price');
		$data['ur_price'] = $this->input->post('ur_price');
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
		$this->common_model->insert_array('sub_categories', $data);

		// $data['language'] = "arb";
		// $data['name'] = $this->input->post('arabic_name');
		// $this->common_model->insert_array('sub_categories', $data);
		// $data['language'] = "urd";
		// $data['name'] = $this->input->post('urdu_name');
		// $this->common_model->insert_array('sub_categories', $data);

		$this->session->set_userdata('success',$data['name']);
		
		redirect(site_url().'admin/service'); 
	}

	function delete_service($id) 
	{

		$this->common_model->delete_where(array('id'=>$id), 'sub_categories');
		redirect(site_url().'admin/service');  
	}

	function edit_service($id, $sub_cat)
	{
		//echo 111; exit;
		$data['categories'] = $this->common_model->select_where("*", "categories", array('id'=>$id) )->result_array();
		$data['sub_category'] = $this->common_model->select_where("*", "sub_categories", array('id'=>$sub_cat))->result_array();
		// $result['category'] = $data->result();
		// echo "<pre>"; print_r($data);exit;
		// foreach($data['category']->result() as $row) {
		// 	$data['category'][$row->sub_id][$row->language]['name'] = $row->name; 
		// 	$data['category'][$row->sub_id][$row->language]['category_id'] = $row->category_id; 
		// 	// $data['category'][$row->sub_id][$row->language]['sub_id'] = $row->sub_id; 
		// 	$data['category'][$row->sub_id][$row->language]['price'] = $row->price; 
		// 	// $data['category'][$row->sub_id][$row->language]['currency'] = $row->currency; 
		// }
		$this->load->view('admin/admin_header');
		$this->load->view('admin/service/edit_service',$data);
		$this->load->view('admin/admin_footer');
	}

	function update_service() 
	{	
		
		$id = $this->input->post('id');
		$data['name'] = $this->input->post('name');
		$data['ar_name'] = $this->input->post('ar_name');
		$data['ur_name'] = $this->input->post('ur_name');
		$data['price'] = $this->input->post('price');
		$data['ar_price'] = $this->input->post('ar_price');
		$data['ur_price'] = $this->input->post('ur_price');
		$data['category_id'] = $this->input->post('category_id');
	
		// $this->common_model->update_array(array('sub_id'=>$id,'language'=>'eng'), 'sub_categories', $data);
		
		// $data['name'] = $this->input->post('arabic_name');
		// $this->common_model->update_array(array('sub_id'=>$id,'language'=>'arb'), 'sub_categories', $data);
		
		// $data['name'] = $this->input->post('urdu_name');
		// $this->common_model->update_array(array('sub_id'=>$id,'language'=>'urd'), 'sub_categories', $data);

		if($_FILES['image_file']['name']!=''){

			$img   =   $_FILES['image_file']['name'];
			$image =   str_replace("category_".time(),$img,$img);
			$data['image']  =  $image;
			$temp   =  $_FILES['image_file']['tmp_name'];
			$path= FCPATH.'uploads/category/'.$image;
			move_uploaded_file($temp,$path);
			// $this->common_model->update_array(array('category_id'=>$id,'language'=>'eng'), 'sub_categories', $eng_data);
		}
		$this->common_model->update_array(array('id'=>$id), 'sub_categories', $data);
		$this->session->set_userdata('update','data updated successfully');
		
		redirect(site_url().'admin/service'); 
	}	
}