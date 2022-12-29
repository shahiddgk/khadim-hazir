<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Keywords extends CI_Controller {

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

		$data['response'] = $this->listing_model->parts_lisitng();
		// $data['response'] = $this->common_model->join_two_tab("a.id, a.name, a.language, a.table_id, p.name catagory_name", "autoparts a", "parts_catagories p", "a.cat_id = p.table_id", "a.name", "DESC");
		if ($data['response']->num_rows()>0){
		
			foreach($data['response']->result() as $row) {
				$data['catagories'][$row->table_id][$row->language]['name'] = $row->name;
				$data['catagories'][$row->table_id][$row->language]['catagory_name'] = $row->catagory_name;
				$data['catagories'][$row->table_id][$row->language]['table_id'] = $row->table_id;
				
			}}
			else{
				
				$data['catagories'] = $data['response']->result();
				
			}
		$this->load->view('admin/admin_header');
		$this->load->view('admin/autoparts/listing',$data);
		$this->load->view('admin/admin_footer');

	}
	
	public function add_part() {
		
		$data['response'] = $this->common_model->select_all("id, name, language, table_id", "parts_catagories");
		foreach($data['response']->result() as $row) {
			$data['catagories'][$row->table_id][$row->language]['name'] = $row->name;
			$data['catagories'][$row->table_id][$row->language]['table_id'] = $row->table_id;
		}
		
		$this->load->view('admin/admin_header');
		$this->load->view('admin/autoparts/add', $data);
		$this->load->view('admin/admin_footer');

	}
		
	function insert_part()
	{	
	$data['table_id'] = time();
	$data['cat_id'] = $this->input->post('catagory');
	$data['language'] = "arb";
	$data['name'] = $this->input->post('arabic_name');
	$this->common_model->insert_array('autoparts', $data);
	$data['language'] = "eng";
	$data['name'] = $this->input->post('part_name');
	$this->common_model->insert_array('autoparts', $data);
	$this->session->set_userdata('success',$data['name']);
	redirect(site_url().'autoparts'); 
	}
	
	function delete_part($id)
	{
		$this->common_model->delete_where(array('table_id'=>$id), 'autoparts');
		redirect(site_url().'autoparts');  
	}
	function edit_part($id)
	{
		$data['catagories'] = $this->common_model->select_where("table_id, name", "parts_catagories", array("language"=>DFT));
		$name = $this->common_model->select_single_field('cat_id','autoparts',array('table_id'=>$id));
		$reg['catagory'] = $this->common_model->select_where("name", "parts_catagories", array('table_id'=>$name));
		if($reg['catagory']->num_rows()>0){
		$data['response'] = $this->common_model->join_two_tab_where("a.id, a.name, a.cat_id, a.language, a.table_id,  p.name catagory_name, p.table_id ", "autoparts a", "parts_catagories p", "a.cat_id = p.table_id", array("a.table_id"=>$id), 4, 0, "a.name", "");
		//$data['region'] = $this->common_model->select_where("id, name, language, table_id", "car_brand", array('table_id'=>$id));
		foreach($data['response']->result() as $row) {
			$data['autoparts'][$row->table_id][$row->language]['id'] = $row->id;
			$data['autoparts'][$row->table_id][$row->language]['name'] = $row->name;
			$data['autoparts'][$row->table_id][$row->language]['cat_id'] = $row->cat_id;
			$data['autoparts'][$row->table_id][$row->language]['catagory_name'] = $row->catagory_name;
			$data['autoparts'][$row->table_id][$row->language]['table_id'] = $row->table_id;
		}}
		else{
			$data['response'] = $this->common_model->select_where("id, name, table_id, language, cat_id", "autoparts", array('table_id'=>$id));
			foreach($data['response']->result() as $row) {
				$data['autoparts'][$row->table_id][$row->language]['name'] = $row->name;
				$data['autoparts'][$row->table_id][$row->language]['cat_id'] = $row->cat_id;
				$data['autoparts'][$row->table_id][$row->language]['id'] = $row->id;
		}}
		$this->load->view('admin/admin_header');
		$this->load->view('admin/autoparts/edit',$data);
		$this->load->view('admin/admin_footer');
		 
	}
	
	function update_part()
	{	
		$data['cat_id'] = $this->input->post('catagory');
		$id = $this->input->post('arb_id');
		$data['name'] = $this->input->post('arabic_name');
		$this->common_model->update_array(array('id'=>$id), 'autoparts', $data);
		$data['name'] = $this->input->post('part_name');
		$id = $this->input->post('eng_id');
		$this->common_model->update_array(array('id'=>$id), 'autoparts', $data);
		$this->session->set_userdata('update','data updated successfully');
		
		redirect(site_url().'autoparts'); 
	}
	
}
