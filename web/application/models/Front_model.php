<?php 

class Front_model extends CI_Model {
		
	public function __construct()
	{
		$this->load->database();
	}
	public function user_login($email,$pass){

	  $this->db->select('*');
	  $this->db->from('user');
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
	public function password_check_user($password,$id){



			  $this->db->select('*');

			  $this->db->from('user');

			  $this->db->where('password',$password);

			  $this->db->where('id',$id);

			  $query=$this->db->get();

			

			  if($query->num_rows()>0){

				return true;

			  }else{

				return false;

			  }

        

    }
	public function change_pass_user($npassword,$id){

        	$this->load->helper('url');

        

        	$data = array(

        		'password' => $npassword

        	);

        	

        	$this->db->where('id', $id);

        	return $this->db->update('user', $data);

    }
	public function get_count($id) {
		$s=$this->db->get_where('subcategories',array('sname' => $id))->row_array();
		
        $this->db->where('sname', $s['id']);
		$this->db->from("product");
		return $this->db->count_all_results();
	}
	public function get_count_r($id) {
        $this->db->where('brand',$id);
		$this->db->from("resellers");
		return $this->db->count_all_results();
	}
	public function get_authors_r($limit, $start,$id) {
		
	        $this->db->limit($limit, $start);
	       $this->db->where('brand', $id);
	        $query = $this->db->get('resellers');
			return $query->result_array();
	}
	public function get_authors($limit, $start,$id) {
		   $s=$this->db->get_where('subcategories',array('sname' => $id))->row_array();
		
	        $this->db->limit($limit, $start);
	        $this->db->where('sname', $s['id']);
			$this->db->ORDER_BY('id','DESC');
	        $query = $this->db->get('product');
			return $query->result_array();
	}
}
?>