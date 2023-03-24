<?php if ( ! defined('BASEPATH')) exit ('No direct script  allow'); 

class Social_login_modal extends  CI_Model {

	function Is_already_register($id)
    {
        $this->db->where('google_id', $id);
        $query = $this->db->get('users');
        if($query->num_rows() > 0)
        {
            return 'true';
        }
        else
        {
            return 'false';
        }
    }

    function Update_google_user($data, $id)
    {
        $this->db->where('google_id', $id);
        $this->db->update('users', $data);
    }

    public function Insert_google_user()
    {
        if ($this->session->userdata('google_user')) {
            $data = $this->session->userdata('google_user');
    
            $user_data['google_id'] = $data['id']; // use 'id' instead of 'google_id'
            $user_data['name'] = $data['name'];
            $user_data['email'] = $data['email'];
            $user_data['phone_no'] = ''; // set phone_no to empty since it's not provided by Google
            $user_data['password'] = ''; // set password to empty since it's not provided by Google
    
            $this->db->insert('users', $user_data);
    
            $user_id = $this->db->insert_id();  
            if(!empty($user_id)){
                return 'success';
            }
        } 
        else{
            return 'error';
        }   
    }
    
}    
?>