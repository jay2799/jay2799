<?php 

class Brand_model extends CI_Model {
		
	public function __construct()
	{
		$this->load->database();
	}
	public function login_brand($email,$pass){

	  $this->db->select('*');
	  $this->db->from('brand');
	  $this->db->where('email',$email);
	  $this->db->where('password',$pass);

		  if($query=$this->db->get())
		  {
			  return $query->row_array();
		  }
		  else
		  {
			return false;
		  }
	}
	public function get_brand_by_id($id) {
			return $this->db->get_where('brand', array('id' => $id), 1)->row();
	}
	public function password_check_brand($password,$id){



			  $this->db->select('*');

			  $this->db->from('brand');

			  $this->db->where('password',$password);

			  $this->db->where('id',$id);

			  $query=$this->db->get();

			

			  if($query->num_rows()>0){

				return true;

			  }else{

				return false;

			  }

        

    }
	public function change_pass_brand($npassword,$id){

        	$this->load->helper('url');

        

        	$data = array(

        		'password' => $npassword

        	);

        	

        	$this->db->where('id', $id);

        	return $this->db->update('brand', $data);

    }
}
?>