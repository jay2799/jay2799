<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {
	
	
	public function __construct(){
		
		parent::__construct();
		$this->load->helper('url_helper');
		$this->load->helper('url');
		$this->load->model('Front_model');
		$this->load->library('session');
		// Load file helper
        $this->load->helper('file');
		$this->load->library("pagination");
		
            
	}

	public function index(){
		
		$data['blog'] = $this->db->order_by('id','DESC')->limit('3')->get('blog')->result_array();
		$data['brand'] = $this->db->get('brand')->result_array();
		$this->load->view('Front/header');
		$this->load->view('Front/index',$data);
		$this->load->view('Front/footer');
	}
	public function gallery(){
		
		$data['category'] = $this->db->get('categories')->result_array();
		$this->load->view('Front/header1');
		$this->load->view('Front/gallery',$data);
		$this->load->view('Front/footer');
	}
	public function blog(){
		
		$data['blog'] = $this->db->get('blog')->result_array();
		$this->load->view('Front/header1');
		$this->load->view('Front/blog',$data);
		$this->load->view('Front/footer');
	}
	public function blog_info($id){
		
		$data['blog'] = $this->db->get_where('blog',array('id' => $id))->row_array();
		$data['recent'] = $this->db->order_by('id','DESC')->limit('3')->get('blog')->result_array();
		$this->load->view('Front/header1');
		$this->load->view('Front/blog_info',$data);
		$this->load->view('Front/footer');
	}
	
	public function sub_category($id){
	    $newid=str_replace('_', ' ', $id);
		$cat_name = $this->db->get_where('categories',array('cname'=> $newid))->row_array();
		$data['sub_cat'] = $this->db->get_where('subcategories',array('cname' => $cat_name['id']))->result_array();
		$data['product_best'] = $this->db->order_by('wcount','DESC')->limit('10')->get('product')->result_array();
		$data['product_new'] = $this->db->order_by('id','DESC')->limit('10')->get('product')->result_array();
		$data['product_brand'] = $this->db->query("SELECT * FROM `brand` WHERE FIND_IN_SET(".$cat_name['id'].",`categories`)")->result_array();
		$this->load->view('Front/header1');
		$this->load->view('Front/sub_category',$data);
		$this->load->view('Front/footer');
	}
	
	public function brand_profile($id){
		$newid=str_replace('_', ' ', $id);
		$data['product'] = $this->db->get_where('product',array('product_name' => $newid))->row_array();
		$product_id = $this->db->get_where('product',array('product_name' => $newid))->row_array();
		$data['color'] = $this->db->get_where('product_color',array('product_id' => $product_id['id']))->result_array();
		$this->load->view('Front/header1');
		$this->load->view('Front/brand_profile',$data);
		$this->load->view('Front/footer');
	}
	public function resellers($id){
		
		$newid=str_replace('_', ' ', $id);
		$data['product'] = $this->db->get_where('product',array('product_name' => $newid))->row_array();
		$product_id = $this->db->get_where('product',array('product_name' => $newid))->row_array();
		$data['color'] = $this->db->get_where('product_color',array('product_id' => $product_id['id']))->result_array();
		//$data['resellers'] = $this->db->get_where('resellers',array('brand' => $product_id['brand']))->result_array();
		
		$config = array();
		$config["base_url"] = base_url() . "resellers/".$id;
		$config["total_rows"] = $this->Front_model->get_count_r($product_id['brand']);
		$config["per_page"] = 5;
		$config["uri_segment"] = 2;
		//$config['use_page_numbers'] = TRUE;
		$config['full_tag_open'] = '<ul class="pagination  pagination-sm m-t-none m-b-none">';
		$config['full_tag_close'] = '</ul>';
		$config['prev_link'] = '<i class="fa fa-chevron-left"></i>';
		$config['prev_tag_open'] = '<li>';
		$config['prev_tag_close'] = '</li>';
		$config['next_link'] = '<i class="fa fa-chevron-right"></i>';
		$config['next_tag_open'] = '<li>';
		$config['next_tag_close'] = '</li>';
		$config['cur_tag_open'] = '<li class="active"><a href="'.base_url() . "resellers/".$id.'">';
		$config['cur_tag_close'] = '</a></li>';
		$config['num_tag_open'] = '<li>';
		$config['num_tag_close'] = '</li>';
		
		$config['first_tag_open'] = '<li>';
		$config['first_tag_close'] = '</li>';
		$config['last_tag_open'] = '<li>';
		$config['last_tag_close'] = '</li>';
		
		$config['first_link'] = '<i class="fa fa-chevron-left"></i> <i class="fa fa-chevron-left"></i>';
		$config['last_link'] = '<i class="fa fa-chevron-right"></i><i class="fa fa-chevron-right"></i>';
		//$this->pagination->create_links();
		$this->pagination->initialize($config);
		$page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
		$data["links"] = $this->pagination->create_links();
		$data['resellers'] = $this->Front_model->get_authors_r($config["per_page"], $page,$product_id['brand']);
		
		$this->load->view('Front/header1');
		$this->load->view('Front/resellers',$data);
		$this->load->view('Front/footer');
	}
	public function brandprofile($id){
		$newid=str_replace('_', ' ', $id);
		$data['brand'] = $this->db->get_where('brand',array('bname' => $newid))->row_array();
		$brand_id = $this->db->get_where('brand',array('bname' => $newid))->row_array();
		$data['catalog'] = $this->db->get_where('catalogue',array('brand' => $brand_id['id']))->result_array();
		$data['product'] = $this->db->get_where('product',array('brand' => $brand_id['id']))->result_array();
		$data['resellers'] = $this->db->get_where('resellers',array('brand' => $brand_id['id']))->result_array();
		$this->load->view('Front/header1');
		$this->load->view('Front/brandprofile',$data);
		$this->load->view('Front/footer');
	}
	public function wishlist(){
		if($this->session->userdata('user_id')=="")
		{
			redirect(base_url('login'));
		}
		$user_id = $this->session->userdata('user_id');
		$data['wishlist'] = $this->db->get_where('wishlist',array('user_id' => $user_id))->result_array();
		$this->load->view('Front/header1');
		$this->load->view('Front/wishlist',$data);
		$this->load->view('Front/footer');
	}
	public function moodboard(){
		
		$this->load->view('Front/header1');
		$this->load->view('Front/moodboard');
		$this->load->view('Front/footer');
	}
	public function register(){
		
		$this->load->view('Front/header1');
		$this->load->view('Front/register');
		$this->load->view('Front/footer');
	}
	public function add_user(){

			

			$data =  array(
				'name' => $this->input->post('name'),
				'email' => $this->input->post('email'),
				'password' => md5($this->input->post('password')),
				'date' =>  date('Y-m-d'),
			    'type' => "Manual",
				
			);
				

			$ins = $this->db->insert('user',$data);
			if($ins){
			
			$insert_id = $this->db->insert_id();

			  $dataa = array(
			     
				 'user_id' => $insert_id,
				 
				 'folder_name' => "My Project",
				 
				 'status' => "1",
				 
				 'date' => date('Y-m-d'),
				
			  );
			  
			 $insa = $this->db->insert('folder',$dataa);
			 
				
			$this->session->set_flashdata('success','Congratulations, your account has been successfully created. ');
			redirect(base_url('login'));
			}else{
				$this->session->set_flashdata('error','Data Error Successfull....!');
			redirect(base_url('login'));
			}

		
	}
	public function login(){
		
		$this->load->view('Front/header1');
		$this->load->view('Front/login');
		$this->load->view('Front/footer');
	}
	
	public function login_user(){
	  
	  $login=array(

	  'email'=>$this->input->post('email'),
	  'password'=>md5($this->input->post('password'))

		);

		$data=$this->Front_model->user_login($login['email'],$login['password']);
		  if($data)
		  {
			$this->session->set_userdata('user_id',$data['id']);
			$this->session->set_userdata('user_email',$data['email']);
			
			
			
			redirect(base_url());
		  }
		  else
		  {
			$this->session->set_flashdata('error', 'Email Id And Password Wrong..');
		   redirect(base_url('login'));

		  }
	}
	public function my_account(){
		if($this->session->userdata('user_id')=="")
		{
			redirect(base_url('login'));
		}
		$user_id = $this->session->userdata('user_id');
		$data['user'] = $this->db->get_where('user',array('id' => $user_id))->row_array();
		$this->load->view('Front/header1');
		$this->load->view('Front/my_account',$data);
		$this->load->view('Front/footer');
	}
	public function logout(){

	  $this->session->sess_destroy();
	  redirect(base_url(), 'refresh');
	}
	public function user_profile(){
		   if($this->session->userdata('user_id')=="")
		   {
				redirect(base_url('login'));
		   }
		   $id = $this->session->userdata('user_id');
           $this->load->helper('form');
           $this->load->library('form_validation');
    

			  $query = $this->db->get_where('user', array('id' => $id))->row_array();
			
			  $this->form_validation->set_rules('name', 'name', 'required');
	 
			  if ($this->form_validation->run() === FALSE)
			  {
			  $data['user'] = $this->db->get_where('user',array('id' => $id))->row();
			  
			  
			  $this->load->view('Front/header1');
			  $this->load->view('Front/my_account',$data);
			  $this->load->view('Front/footer');
			 
	 
			  }
			  else
			  {
			   $imagename =$query['images'];
			   if($_FILES['images']['name'] != "")
			  {
                  $config['upload_path']          = './uploads/user';
                  $config['allowed_types']        = 'gif|jpg|jpeg|png|pdf|doc';
                  $config['file_name'] = uniqid();
                  $config['max_size']             = 100000;
                  $config['max_width']            = 100000;
                  $config['max_height']           = 100000;

                  $this->load->library('upload', $config);

                  if ( ! $this->upload->do_upload('images'))
                  {
                          
                      $this->form_validation->set_error_delimiters('<p class="error">', '</p>');

                      $error = array('error' => $this->upload->display_errors());

                      $this->load->view('upload', $error);
                  }
                  else
                  {
				$imagename =  $this->upload->data('file_name');
                      
                  }
			  }
			  
			   
				 $data = array(
					'images' => $imagename,
					
					'name' => $this->input->post('name'),
					'number' => $this->input->post('number'), 
					 
					
					
				 );
			
            $this->db->where('id',$id);
            $this->db->update('user', $data);
			$this->session->set_flashdata('success','Successfully Update Details');
            redirect(base_url('my-account'));

           }
     }
	 public function change_password(){

		if($this->session->userdata('user_id')=="")
			{
				redirect(base_url('login'));
			}

			$id = $this->session->userdata('user_id');
					
			

			$this->load->helper('form');
			$this->load->library('form_validation');

			

			$this->form_validation->set_rules('password', 'password', 'required');
			$this->form_validation->set_rules('npassword', 'npassword', 'required');
			$this->form_validation->set_rules('cpassword', 'cpassword', 'required');

			if ($this->form_validation->run() === FALSE)
			{
			  $data['user'] = $this->db->get_where('user',array('id' => $id))->row();
			  $this->load->view('Front/header1');
			  $this->load->view('Front/my_account',$data);
			  $this->load->view('Front/footer');

			}
			else
			{

				$password=md5($this->input->post('password'));

				$npassword=md5($this->input->post('npassword'));

				$cpassword=md5($this->input->post('cpassword'));



				if($npassword==$cpassword)

				{

					$password_check=$this->Front_model->password_check_user($password,$id);



					if($password_check){

					  $this->Front_model->change_pass_user($npassword,$id);

					  $this->session->set_flashdata('success','successfully Changed');
					  redirect(base_url('my-account'));

					}

					else
					{

						$this->session->set_flashdata('error','Wrong Old password');
					   redirect(base_url('my-account'));

					}

				}

				else{

				  $this->session->set_flashdata('error','New Password And Confirm Password Not Match..');
				  redirect(base_url('my-account'));

				}



			}
	}
	public function brand_list(){
		
		$data['brand'] = $this->db->get('brand')->result_array();
		$this->load->view('Front/header1');
		$this->load->view('Front/brand_list',$data);
		$this->load->view('Front/footer');
	}
	public function get_number(){
		$uri_id =$this->uri->segment(2);
		$uri_ida =$this->uri->segment(3);
		if($this->session->userdata('user_id')=="")
		{
			redirect(base_url('login'));
		}

		$user_id = $this->session->userdata('user_id');
		
		$data = array(
		
			
			'user_id' => $user_id, 
			'resellers_id' => $uri_id, 
			'date' => date('Y-m-d')
		);
		$this->db->insert('get_number', $data);
		
		redirect(base_url('brandprofile/'.$uri_ida));
		
		
	}
	public function get_number_re(){
		$uri_id =$this->uri->segment(2);
		$uri_ida =$this->uri->segment(3);
		if($this->session->userdata('user_id')=="")
		{
			redirect(base_url('login'));
		}

		$user_id = $this->session->userdata('user_id');
		
		$data = array(
		
			
			'user_id' => $user_id, 
			'resellers_id' => $uri_id, 
			'date' => date('Y-m-d')
		);
		$this->db->insert('get_number', $data);
		
		redirect(base_url('resellers/'.$uri_ida));
		
		
	}
	public function number_request(){
		$uri_id =$this->input->post('uri');
		
		
		
		$data = array(
		
			
			'name' => $this->input->post('name'), 
			'number' => $this->input->post('number'), 
			'email' => $this->input->post('email'), 
			'message' => $this->input->post('message'), 
			'date' => date('Y-m-d')
		);
		$this->db->insert('number_request', $data);
		$this->session->set_flashdata('success','Your Inquiry Send Successfully....');
		redirect(base_url('brandprofile/'.$uri_id));
		
		
	}
	public function number_request_re(){
		$uri_id =$this->input->post('uri');
		
		
		
		$data = array(
		
			
			'name' => $this->input->post('name'), 
			'number' => $this->input->post('number'), 
			'email' => $this->input->post('email'), 
			'message' => $this->input->post('message'), 
			'date' => date('Y-m-d')
		);
		$this->db->insert('number_request', $data);
		$this->session->set_flashdata('success','Your Inquiry Send Successfully....');
		redirect(base_url('resellers/'.$uri_id));
		
		
	}
	public function product_list($id)
    { 
       	
            $newid=str_replace('_', ' ', $id);
        	$config = array();
	        $config["base_url"] = base_url() . "product-list/".$id;
	        $config["total_rows"] = $this->Front_model->get_count($newid);
	        $config["per_page"] = 12;
	        $config["uri_segment"] = 2;
	        //$config['use_page_numbers'] = TRUE;
	        $config['full_tag_open'] = '<ul class="pagination  pagination-sm m-t-none m-b-none">';
            $config['full_tag_close'] = '</ul>';
            $config['prev_link'] = '<i class="fa fa-chevron-left"></i>';
            $config['prev_tag_open'] = '<li>';
            $config['prev_tag_close'] = '</li>';
            $config['next_link'] = '<i class="fa fa-chevron-right"></i>';
            $config['next_tag_open'] = '<li>';
            $config['next_tag_close'] = '</li>';
            $config['cur_tag_open'] = '<li class="active"><a href="'.base_url() . "product-list/".$id.'">';
            $config['cur_tag_close'] = '</a></li>';
            $config['num_tag_open'] = '<li>';
            $config['num_tag_close'] = '</li>';
            
            $config['first_tag_open'] = '<li>';
            $config['first_tag_close'] = '</li>';
            $config['last_tag_open'] = '<li>';
            $config['last_tag_close'] = '</li>';
            
            $config['first_link'] = '<i class="fa fa-chevron-left"></i> <i class="fa fa-chevron-left"></i>';
            $config['last_link'] = '<i class="fa fa-chevron-right"></i><i class="fa fa-chevron-right"></i>';
            //$this->pagination->create_links();
			$this->pagination->initialize($config);
			$page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
			$data["links"] = $this->pagination->create_links();
			$data['products'] = $this->Front_model->get_authors($config["per_page"], $page,$newid);
		
        
			
		
			$this->load->view('Front/header1');
			$this->load->view('Front/product_list',$data);
			$this->load->view('Front/footer');
	
        }
		public function status_update(){
			$f_id =$this->input->post('f_id');
			$data = array(
		
			
			'status' => "0", 
			
			);
			$this->db->update('folder', $data);
			
			
			$dataa = array(
			
				
				'status' => "1", 
				
			);
			$this->db->where('id', $f_id);
			$this->db->update('folder', $dataa);
			echo "success";	
		}
		public function add_wishlist(){
			$id = $this->uri->segment(2); 
			$uri_id = $this->uri->segment(3); 
			
			$user_id = $this->session->userdata('user_id');
			$folder = $this->db->get_where('folder',array('user_id' =>$user_id,'status' =>1))->row_array();
			$data = array(
			
		    	'user_id' => $user_id,
				'product_id' => $id,
				'date' => date('Y-m-d'),	
				'folder' =>$folder['id'],
			);
			$this->db->insert('wishlist', $data);
			
			$product = $this->db->get_where('product',array('id' =>$id))->row_array();
			$dataa = array(
			
		    	'wcount' => $product['wcount'] + 1,
			
			);
			$this->db->where('id', $id);
			$this->db->update('product', $dataa);
			
			redirect(base_url('product-list/'.$uri_id));
			
		}
		public function remove_wishlist() {
			$id = $this->uri->segment(2); 
			$uri_id = $this->uri->segment(3); 
			
			$user_id = $this->session->userdata('user_id');
			$remove = $this->db->get_where('wishlist',array('product_id' =>$id,'user_id' =>$user_id))->row_array();
			$remove_id = $remove['id'];
			$this->db->where('id', $remove_id);
			$this->db->delete('wishlist');
			$product = $this->db->get_where('product',array('id' =>$id))->row_array();
			$dataa = array(
			
		    	'wcount' => $product['wcount'] - 1,
			
			);
			$this->db->where('id', $id);
			$this->db->update('product', $dataa);
			redirect(base_url('product-list/'.$uri_id));
		}
		public function update_order(){
			$cc = count($_POST["page_id_array"]);
			
			for($i=0; $i<$cc; $i++)
			{
			$query = $this->db->query("
			UPDATE folder 
			SET page_order = '".$i."' 
			WHERE id = '".$_POST["page_id_array"][$i]."'");
			}
			echo 'Page Order has been updated'; 
		}
		public function add_project(){
			
			$user_id = $this->session->userdata('user_id');
			
			$page_order = $this->db->order_by('page_order','DESC')->get_where('folder',array('user_id' => $user_id))->row_array();
			
			$data = array(
			
		    	'user_id' => $user_id,
				'folder_name' =>  $this->input->post('folder_name'),
				'status' => 0,
				'date' => date('Y-m-d'),	
				'page_order' =>$page_order['page_order'] + 1,
			);
			$this->db->insert('folder', $data);
			redirect(base_url('wishlist'));
		}
		public function folder_remove($id){
			$user_id = $this->session->userdata('user_id');
			$get_folder = $this->db->get_where('folder',array('id'=>$id))->row_array();
			if($get_folder['status']== 1){
				
				$this->db->where('id', $id);
				$this->db->delete('folder');
				
				$get_foldera = $this->db->order_by('id','DESC')->get_where('folder',array('user_id'=>$user_id))->row_array();
				$data = array(
			
		    	
				'status' => 1,
				
			);
			$this->db->where('id', $get_foldera['id']);
			$this->db->update('folder', $data);
				
			}
			else{
				$this->db->where('id', $id);
				$this->db->delete('folder');
			}
			
			$this->db->where('folder', $id);
			if($this->db->delete('wishlist'))
			{
				
				$this->session->set_flashdata('success_msg','Successfully Deleted');
				redirect(base_url('wishlist'));
			} 
			else
			{
				$this->session->set_flashdata('error_msg','Database Error');
				redirect(base_url('wishlist'));
			}
		}
		public function wishlist_remove($id){
			$user_id = $this->session->userdata('user_id');
			$remove = $this->db->get_where('wishlist',array('product_id' =>$id,'user_id' =>$user_id))->row_array();
			$remove_id = $remove['id'];
			$this->db->where('id', $remove_id);
			$this->db->delete('wishlist');
			$product = $this->db->get_where('product',array('id' =>$id))->row_array();
			$dataa = array(
			
		    	'wcount' => $product['wcount'] - 1,
			
			);
			$this->db->where('id', $id);
			$this->db->update('product', $dataa);
			redirect(base_url('wishlist'));
		}
		public function wishlist_folder($id){
			if($this->session->userdata('user_id')=="")
			{
				redirect(base_url('login'));
			}
			$user_id = $this->session->userdata('user_id');
			$newid=str_replace('_', ' ', $id);
			$data['folder'] = $this->db->get_where('folder',array('folder_name' => $newid))->row_array();
			$folder_id = $this->db->get_where('folder',array('folder_name' => $newid))->row_array();
			
			$data['wishlist'] = $this->db->get_where('wishlist',array('folder' => $folder_id['id'],'user_id' =>$user_id))->result_array();
			$this->load->view('Front/header1');
			$this->load->view('Front/wishlist',$data);
			$this->load->view('Front/footer');
		}
	
	public function get_sub_cat_img()
	{
	    $id = $this->input->post('id');
	    
	    $subcategories = $this->db->get_where('subcategories',array('id' => $id))->row_array();
	    
	    echo $subcategories['images'];
	}
	public function installation_data(){
		header("Content-type:application/json");
		$id = $this->input->post('i_id');
		$s_id = $this->input->post('s_id');
		
	    $s=$this->db->get_where('subcategories',array('sname' => $s_id))->row_array();
		$c_id = $s['id'];
	    $subcategories = $this->db->query("SELECT * FROM product WHERE FIND_IN_SET(".$id.",`installation`) AND sname = '$c_id'")->result_array();
		$html ="";
		if($subcategories) {
		foreach($subcategories as $pro) {
		

			 $user_id = $this->session->userdata('user_id');
			 $get_wishlist = $this->db->get_where('wishlist',array('user_id' =>$user_id,'product_id'=>$pro['id']))->num_rows();
			 if($get_wishlist == 0) {
			 if(!empty($user_id)) { $link = base_url('add-wishlist/').$pro['id'].'/'.$this->uri->segment(2);  } else { $link = base_url('login'); } 
			 
		  $btn ='<a href="'.$link .' " style="width:100%;"> <span class="product_icon" style="width:100%;"><img src="'.base_url().'assets/img/Union.png" style="width:20%;display:inline-block;"> <span style="display: inline-block;">'.$count = $this->db->get_where('wishlist',array('product_id' =>$pro['id'] ))->num_rows().'</span></span></a>';
		  } else{ 
		  $btn ='<a href="'.base_url('remove-wishlist/').$pro['id'].'/'.$this->uri->segment(2).'" style="width:100%;"> <span class="product_icon" style="width:100%;"><img src="'.base_url().'assets/img/unwishlist.png" style="width:20%;display:inline-block;"> <span style="display: inline-block;">'.$count = $this->db->get_where('wishlist',array('product_id' =>$pro['id'] ))->num_rows().'</span></span></a>';
		   } 			
		$html .='<div class="col-xl-4 col-lg-6 col-md-6 mb-3">
		  <div class="produc_list_page product_hover">
			 <a href="#popup7'.$pro['id'].'" class="popup_link"><img class="hover_view  flaticon-visibility" src="'. base_url().'assets/img/Group313.png"></a>
			 <a class="product_link" href="'.base_url('brand-profile/'.str_replace(' ', '_', $pro['product_name'])).'">';
			 
			 $images=explode(",", $pro['product_image']);
			$html .=' <img class="p_main" src="'.base_url().'/uploads/product/'.$images[0].'">
			 </a>
			 <div class="product_text   mt-2 mb-2 __web-inspector-hide-shortcut__">';
				$brand_name = $this->db->get_where('brand',array('id' => $pro['brand']))->row_array();
				
				$html .='<div class="row">
				   <div class="col-md-7">
					  <h4>'.$brand_name['bname'].'</h4>
					  <p class="product_space">'.$pro['product_name'].'</p>
				   </div>
				   <div class="col-md-5">
					  '.$btn.' 
				   </div>
				</div>
			 </div>
		  </div>
	   </div>
	   <div id="popup7'.$pro['id'].'" class="product-gird__quick-view-popup mfp-hide">
		  <div class="row justify-content-between align-items-center">
			 <div class="col-lg-8">
				<div class="quick-view__left-content">
				   <div class="tabs">
					  <div class="popup-product-thumb-box tabsa">
						 <ul>';
							$imagesa=explode(",", $pro['product_image']);
							   $no = 0;
							   foreach ($imagesa as $key => $value) {
							   $no = $no + 1;	
							  
							$html .='<li class="tab-nav popup-product-thumb"> <a
							   href="#tab'.$no.'"> <img
							   src="'.base_url().'/uploads/product/'.$value.'"
							   alt="" /> </a> </li>';
							}
						$html .='
						 </ul>
					  </div>
					  <div class="popup-product-main-image-box">';
						 $imagesa=explode(",", $pro['product_image']);
							$no = 0;
							foreach ($imagesa as $key => $value) {
							$no = $no + 1;
							
						 $html .='<div id="tab'.$no.'"
							class="tab-item popup-product-image">
							<div class="popup-product-single-image"> <img
							   src="'.base_url().'/uploads/product/'.$value.'"
							   alt="" /> </div>
						 </div>';
						 } 	
						 $html .='<button class="prev"> <i
							class="flaticon-back"></i> </button> <button
							class="next"> <i class="flaticon-next"></i>
						 </button>
					  </div>
				   </div>
				</div>
			 </div>
			 <div class="col-lg-4">
				<div class="popup-right-content">
				   <div class="brand_logo_details mb-3">
					  <a href="'.base_url('brandprofile/'.str_replace(' ', '_', $brand_name['bname'])).'">
					  <img src="'.base_url().'uploads/brand/'.$brand_name['images'].'" class="img-thumbnail"></a>
				   </div>
				   <h3>'.$brand_name['bname'].'</h3>
				   <p class="text"> '.$pro['product_name'].'
				   </p>
				   <div class="price">
					  <p>'.substr($pro['description'], 0, 50).'</p>
				   </div>
				   <div class="mt-3 metalic">
					  <p><b>Collection :  </b>'.$pro['collection'].'</p>
					
					  <p><b>Finish :  </b>';
						  $finish=explode(",", $pro['finish']);
							foreach ($finish as $key => $fi) {
							   $fini = $this->db->get_where('finish',array('id' => $fi))->row_array();
							
							 $fini['finish']."," ;  } 	
							
					  $html .='</p>
					  <p><b>Use :  </b>'.$pro['indoor_outdoor'].' </p>
				   </div>
				</div>
			 </div>
		  </div>
	   </div>';
		}
		}
		else{
		$html .=' <h3 style="color:red;text-align:center;">No Record Found</h3>';
		}
		$data['html'] = $html;
        echo json_encode($data);
	}
	public function application_data(){
		header("Content-type:application/json");
		$id = $this->input->post('i_id');
		$s_id = $this->input->post('s_id');
		
	    $s=$this->db->get_where('subcategories',array('sname' => $s_id))->row_array();
		$c_id = $s['id'];
	    $subcategories = $this->db->query("SELECT * FROM product WHERE FIND_IN_SET(".$id.",`application`) AND sname = '$c_id'")->result_array();
	    
	   
		$html ="";
		if($subcategories) {
		foreach($subcategories as $pro) {
		

			 $user_id = $this->session->userdata('user_id');
			 $get_wishlist = $this->db->get_where('wishlist',array('user_id' =>$user_id,'product_id'=>$pro['id']))->num_rows();
			 if($get_wishlist == 0) {
			 if(!empty($user_id)) { $link = base_url('add-wishlist/').$pro['id'].'/'.$this->uri->segment(2);  } else { $link = base_url('login'); } 
			 
		  $btn ='<a href="'.$link .' " style="width:100%;"> <span class="product_icon" style="width:100%;"><img src="'.base_url().'assets/img/Union.png" style="width:20%;display:inline-block;"> <span style="display: inline-block;">'.$count = $this->db->get_where('wishlist',array('product_id' =>$pro['id'] ))->num_rows().'</span></span></a>';
		  } else{ 
		  $btn ='<a href="'.base_url('remove-wishlist/').$pro['id'].'/'.$this->uri->segment(2).'" style="width:100%;"> <span class="product_icon" style="width:100%;"><img src="'.base_url().'assets/img/unwishlist.png" style="width:20%;display:inline-block;"> <span style="display: inline-block;">'.$count = $this->db->get_where('wishlist',array('product_id' =>$pro['id'] ))->num_rows().'</span></span></a>';
		   } 			
		$html .='<div class="col-xl-4 col-lg-6 col-md-6 mb-3">
		  <div class="produc_list_page product_hover">
			 <a href="#popup7'.$pro['id'].'" class="popup_link"><img class="hover_view  flaticon-visibility" src="'. base_url().'assets/img/Group313.png"></a>
			 <a class="product_link" href="'.base_url('brand-profile/'.str_replace(' ', '_', $pro['product_name'])).'">';
			 
			 $images=explode(",", $pro['product_image']);
			$html .=' <img class="p_main" src="'.base_url().'/uploads/product/'.$images[0].'">
			 </a>
			 <div class="product_text   mt-2 mb-2 __web-inspector-hide-shortcut__">';
				$brand_name = $this->db->get_where('brand',array('id' => $pro['brand']))->row_array();
				
				$html .='<div class="row">
				   <div class="col-md-7">
					  <h4>'.$brand_name['bname'].'</h4>
					  <p class="product_space">'.$pro['product_name'].'</p>
				   </div>
				   <div class="col-md-5">
					  '.$btn.' 
				   </div>
				</div>
			 </div>
		  </div>
	   </div>
	   <div id="popup7'.$pro['id'].'" class="product-gird__quick-view-popup mfp-hide">
		  <div class="row justify-content-between align-items-center">
			 <div class="col-lg-8">
				<div class="quick-view__left-content">
				   <div class="tabs">
					  <div class="popup-product-thumb-box tabsa">
						 <ul>';
							$imagesa=explode(",", $pro['product_image']);
							   $no = 0;
							   foreach ($imagesa as $key => $value) {
							   $no = $no + 1;	
							  
							$html .='<li class="tab-nav popup-product-thumb"> <a
							   href="#tab'.$no.'"> <img
							   src="'.base_url().'/uploads/product/'.$value.'"
							   alt="" /> </a> </li>';
							}
						$html .='
						 </ul>
					  </div>
					  <div class="popup-product-main-image-box">';
						 $imagesa=explode(",", $pro['product_image']);
							$no = 0;
							foreach ($imagesa as $key => $value) {
							$no = $no + 1;
							
						 $html .='<div id="tab'.$no.'"
							class="tab-item popup-product-image">
							<div class="popup-product-single-image"> <img
							   src="'.base_url().'/uploads/product/'.$value.'"
							   alt="" /> </div>
						 </div>';
						 } 	
						 $html .='<button class="prev"> <i
							class="flaticon-back"></i> </button> <button
							class="next"> <i class="flaticon-next"></i>
						 </button>
					  </div>
				   </div>
				</div>
			 </div>
			 <div class="col-lg-4">
				<div class="popup-right-content">
				   <div class="brand_logo_details mb-3">
					  <a href="'.base_url('brandprofile/'.str_replace(' ', '_', $brand_name['bname'])).'">
					  <img src="'.base_url().'uploads/brand/'.$brand_name['images'].'" class="img-thumbnail"></a>
				   </div>
				   <h3>'.$brand_name['bname'].'</h3>
				   <p class="text"> '.$pro['product_name'].'
				   </p>
				   <div class="price">
					  <p>'.substr($pro['description'], 0, 50).'</p>
				   </div>
				   <div class="mt-3 metalic">
					  <p><b>Collection :  </b>'.$pro['collection'].'</p>
					
					  <p><b>Finish :  </b>';
						  $finish=explode(",", $pro['finish']);
							foreach ($finish as $key => $fi) {
							   $fini = $this->db->get_where('finish',array('id' => $fi))->row_array();
							
							 $fini['finish']."," ;  } 	
							
					  $html .='</p>
					  <p><b>Use :  </b>'.$pro['indoor_outdoor'].' </p>
				   </div>
				</div>
			 </div>
		  </div>
	   </div>';
		}
		}
		else{
		$html .=' <h3 style="color:red;text-align:center;">No Record Found</h3>';
		}
		$data['html'] = $html;
        echo json_encode($data);
	}
	public function material_data(){
		header("Content-type:application/json");
		header("Content-type:application/json");
		$id = $this->input->post('i_id');
		$s_id = $this->input->post('s_id');
		
	    $s=$this->db->get_where('subcategories',array('sname' => $s_id))->row_array();
		$c_id = $s['id'];
	    $subcategories = $this->db->query("SELECT * FROM product WHERE FIND_IN_SET(".$id.",`material`) AND sname = '$c_id'")->result_array();
	    
	    
		$html ="";
		if($subcategories) {
		foreach($subcategories as $pro) {
		

			 $user_id = $this->session->userdata('user_id');
			 $get_wishlist = $this->db->get_where('wishlist',array('user_id' =>$user_id,'product_id'=>$pro['id']))->num_rows();
			 if($get_wishlist == 0) {
			 if(!empty($user_id)) { $link = base_url('add-wishlist/').$pro['id'].'/'.$this->uri->segment(2);  } else { $link = base_url('login'); } 
			 
		  $btn ='<a href="'.$link .' " style="width:100%;"> <span class="product_icon" style="width:100%;"><img src="'.base_url().'assets/img/Union.png" style="width:20%;display:inline-block;"> <span style="display: inline-block;">'.$count = $this->db->get_where('wishlist',array('product_id' =>$pro['id'] ))->num_rows().'</span></span></a>';
		  } else{ 
		  $btn ='<a href="'.base_url('remove-wishlist/').$pro['id'].'/'.$this->uri->segment(2).'" style="width:100%;"> <span class="product_icon" style="width:100%;"><img src="'.base_url().'assets/img/unwishlist.png" style="width:20%;display:inline-block;"> <span style="display: inline-block;">'.$count = $this->db->get_where('wishlist',array('product_id' =>$pro['id'] ))->num_rows().'</span></span></a>';
		   } 			
		$html .='<div class="col-xl-4 col-lg-6 col-md-6 mb-3">
		  <div class="produc_list_page product_hover">
			 <a href="#popup7'.$pro['id'].'" class="popup_link"><img class="hover_view  flaticon-visibility" src="'. base_url().'assets/img/Group313.png"></a>
			 <a class="product_link" href="'.base_url('brand-profile/'.str_replace(' ', '_', $pro['product_name'])).'">';
			 
			 $images=explode(",", $pro['product_image']);
			$html .=' <img class="p_main" src="'.base_url().'/uploads/product/'.$images[0].'">
			 </a>
			 <div class="product_text   mt-2 mb-2 __web-inspector-hide-shortcut__">';
				$brand_name = $this->db->get_where('brand',array('id' => $pro['brand']))->row_array();
				
				$html .='<div class="row">
				   <div class="col-md-7">
					  <h4>'.$brand_name['bname'].'</h4>
					  <p class="product_space">'.$pro['product_name'].'</p>
				   </div>
				   <div class="col-md-5">
					  '.$btn.' 
				   </div>
				</div>
			 </div>
		  </div>
	   </div>
	   <div id="popup7'.$pro['id'].'" class="product-gird__quick-view-popup mfp-hide">
		  <div class="row justify-content-between align-items-center">
			 <div class="col-lg-8">
				<div class="quick-view__left-content">
				   <div class="tabs">
					  <div class="popup-product-thumb-box tabsa">
						 <ul>';
							$imagesa=explode(",", $pro['product_image']);
							   $no = 0;
							   foreach ($imagesa as $key => $value) {
							   $no = $no + 1;	
							  
							$html .='<li class="tab-nav popup-product-thumb"> <a
							   href="#tab'.$no.'"> <img
							   src="'.base_url().'/uploads/product/'.$value.'"
							   alt="" /> </a> </li>';
							}
						$html .='
						 </ul>
					  </div>
					  <div class="popup-product-main-image-box">';
						 $imagesa=explode(",", $pro['product_image']);
							$no = 0;
							foreach ($imagesa as $key => $value) {
							$no = $no + 1;
							
						 $html .='<div id="tab'.$no.'"
							class="tab-item popup-product-image">
							<div class="popup-product-single-image"> <img
							   src="'.base_url().'/uploads/product/'.$value.'"
							   alt="" /> </div>
						 </div>';
						 } 	
						 $html .='<button class="prev"> <i
							class="flaticon-back"></i> </button> <button
							class="next"> <i class="flaticon-next"></i>
						 </button>
					  </div>
				   </div>
				</div>
			 </div>
			 <div class="col-lg-4">
				<div class="popup-right-content">
				   <div class="brand_logo_details mb-3">
					  <a href="'.base_url('brandprofile/'.str_replace(' ', '_', $brand_name['bname'])).'">
					  <img src="'.base_url().'uploads/brand/'.$brand_name['images'].'" class="img-thumbnail"></a>
				   </div>
				   <h3>'.$brand_name['bname'].'</h3>
				   <p class="text"> '.$pro['product_name'].'
				   </p>
				   <div class="price">
					  <p>'.substr($pro['description'], 0, 50).'</p>
				   </div>
				   <div class="mt-3 metalic">
					  <p><b>Collection :  </b>'.$pro['collection'].'</p>
					
					  <p><b>Finish :  </b>';
						  $finish=explode(",", $pro['finish']);
							foreach ($finish as $key => $fi) {
							   $fini = $this->db->get_where('finish',array('id' => $fi))->row_array();
							
							 $fini['finish']."," ;  } 	
							
					  $html .='</p>
					  <p><b>Use :  </b>'.$pro['indoor_outdoor'].' </p>
				   </div>
				</div>
			 </div>
		  </div>
	   </div>';
		}
		}
		else{
		$html .=' <h3 style="color:red;text-align:center;">No Record Found</h3>';
		}
		$data['html'] = $html;
        echo json_encode($data);
	}
	public function shape_data(){
		header("Content-type:application/json");
		$id = $this->input->post('i_id');
		$s_id = $this->input->post('s_id');
		
	    $s=$this->db->get_where('subcategories',array('sname' => $s_id))->row_array();
		$c_id = $s['id'];
	    $subcategories = $this->db->query("SELECT * FROM product WHERE FIND_IN_SET(".$id.",`shape`) AND sname = '$c_id'")->result_array();
	    
	    
		$html ="";
		if($subcategories) {
		foreach($subcategories as $pro) {
		

			 $user_id = $this->session->userdata('user_id');
			 $get_wishlist = $this->db->get_where('wishlist',array('user_id' =>$user_id,'product_id'=>$pro['id']))->num_rows();
			 if($get_wishlist == 0) {
			 if(!empty($user_id)) { $link = base_url('add-wishlist/').$pro['id'].'/'.$this->uri->segment(2);  } else { $link = base_url('login'); } 
			 
		  $btn ='<a href="'.$link .' " style="width:100%;"> <span class="product_icon" style="width:100%;"><img src="'.base_url().'assets/img/Union.png" style="width:20%;display:inline-block;"> <span style="display: inline-block;">'.$count = $this->db->get_where('wishlist',array('product_id' =>$pro['id'] ))->num_rows().'</span></span></a>';
		  } else{ 
		  $btn ='<a href="'.base_url('remove-wishlist/').$pro['id'].'/'.$this->uri->segment(2).'" style="width:100%;"> <span class="product_icon" style="width:100%;"><img src="'.base_url().'assets/img/unwishlist.png" style="width:20%;display:inline-block;"> <span style="display: inline-block;">'.$count = $this->db->get_where('wishlist',array('product_id' =>$pro['id'] ))->num_rows().'</span></span></a>';
		   } 			
		$html .='<div class="col-xl-4 col-lg-6 col-md-6 mb-3">
		  <div class="produc_list_page product_hover">
			 <a href="#popup7'.$pro['id'].'" class="popup_link"><img class="hover_view  flaticon-visibility" src="'. base_url().'assets/img/Group313.png"></a>
			 <a class="product_link" href="'.base_url('brand-profile/'.str_replace(' ', '_', $pro['product_name'])).'">';
			 
			 $images=explode(",", $pro['product_image']);
			$html .=' <img class="p_main" src="'.base_url().'/uploads/product/'.$images[0].'">
			 </a>
			 <div class="product_text   mt-2 mb-2 __web-inspector-hide-shortcut__">';
				$brand_name = $this->db->get_where('brand',array('id' => $pro['brand']))->row_array();
				
				$html .='<div class="row">
				   <div class="col-md-7">
					  <h4>'.$brand_name['bname'].'</h4>
					  <p class="product_space">'.$pro['product_name'].'</p>
				   </div>
				   <div class="col-md-5">
					  '.$btn.' 
				   </div>
				</div>
			 </div>
		  </div>
	   </div>
	   <div id="popup7'.$pro['id'].'" class="product-gird__quick-view-popup mfp-hide">
		  <div class="row justify-content-between align-items-center">
			 <div class="col-lg-8">
				<div class="quick-view__left-content">
				   <div class="tabs">
					  <div class="popup-product-thumb-box tabsa">
						 <ul>';
							$imagesa=explode(",", $pro['product_image']);
							   $no = 0;
							   foreach ($imagesa as $key => $value) {
							   $no = $no + 1;	
							  
							$html .='<li class="tab-nav popup-product-thumb"> <a
							   href="#tab'.$no.'"> <img
							   src="'.base_url().'/uploads/product/'.$value.'"
							   alt="" /> </a> </li>';
							}
						$html .='
						 </ul>
					  </div>
					  <div class="popup-product-main-image-box">';
						 $imagesa=explode(",", $pro['product_image']);
							$no = 0;
							foreach ($imagesa as $key => $value) {
							$no = $no + 1;
							
						 $html .='<div id="tab'.$no.'"
							class="tab-item popup-product-image">
							<div class="popup-product-single-image"> <img
							   src="'.base_url().'/uploads/product/'.$value.'"
							   alt="" /> </div>
						 </div>';
						 } 	
						 $html .='<button class="prev"> <i
							class="flaticon-back"></i> </button> <button
							class="next"> <i class="flaticon-next"></i>
						 </button>
					  </div>
				   </div>
				</div>
			 </div>
			 <div class="col-lg-4">
				<div class="popup-right-content">
				   <div class="brand_logo_details mb-3">
					  <a href="'.base_url('brandprofile/'.str_replace(' ', '_', $brand_name['bname'])).'">
					  <img src="'.base_url().'uploads/brand/'.$brand_name['images'].'" class="img-thumbnail"></a>
				   </div>
				   <h3>'.$brand_name['bname'].'</h3>
				   <p class="text"> '.$pro['product_name'].'
				   </p>
				   <div class="price">
					  <p>'.substr($pro['description'], 0, 50).'</p>
				   </div>
				   <div class="mt-3 metalic">
					  <p><b>Collection :  </b>'.$pro['collection'].'</p>
					
					  <p><b>Finish :  </b>';
						  $finish=explode(",", $pro['finish']);
							foreach ($finish as $key => $fi) {
							   $fini = $this->db->get_where('finish',array('id' => $fi))->row_array();
							
							 $fini['finish']."," ;  } 	
							
					  $html .='</p>
					  <p><b>Use :  </b>'.$pro['indoor_outdoor'].' </p>
				   </div>
				</div>
			 </div>
		  </div>
	   </div>';
		}
		}
		else{
		$html .=' <h3 style="color:red;text-align:center;">No Record Found</h3>';
		}
		$data['html'] = $html;
        echo json_encode($data);
	}
	public function effects_data(){
		header("Content-type:application/json");
		$id = $this->input->post('i_id');
		$s_id = $this->input->post('s_id');
		
	    $s=$this->db->get_where('subcategories',array('sname' => $s_id))->row_array();
		$c_id = $s['id'];
	    $subcategories = $this->db->query("SELECT * FROM product WHERE FIND_IN_SET(".$id.",`effects`) AND sname = '$c_id'")->result_array();
	    
	    
		$html ="";
		if($subcategories) {
		foreach($subcategories as $pro) {
		

			 $user_id = $this->session->userdata('user_id');
			 $get_wishlist = $this->db->get_where('wishlist',array('user_id' =>$user_id,'product_id'=>$pro['id']))->num_rows();
			 if($get_wishlist == 0) {
			 if(!empty($user_id)) { $link = base_url('add-wishlist/').$pro['id'].'/'.$this->uri->segment(2);  } else { $link = base_url('login'); } 
			 
		  $btn ='<a href="'.$link .' " style="width:100%;"> <span class="product_icon" style="width:100%;"><img src="'.base_url().'assets/img/Union.png" style="width:20%;display:inline-block;"> <span style="display: inline-block;">'.$count = $this->db->get_where('wishlist',array('product_id' =>$pro['id'] ))->num_rows().'</span></span></a>';
		  } else{ 
		  $btn ='<a href="'.base_url('remove-wishlist/').$pro['id'].'/'.$this->uri->segment(2).'" style="width:100%;"> <span class="product_icon" style="width:100%;"><img src="'.base_url().'assets/img/unwishlist.png" style="width:20%;display:inline-block;"> <span style="display: inline-block;">'.$count = $this->db->get_where('wishlist',array('product_id' =>$pro['id'] ))->num_rows().'</span></span></a>';
		   } 			
		$html .='<div class="col-xl-4 col-lg-6 col-md-6 mb-3">
		  <div class="produc_list_page product_hover">
			 <a href="#popup7'.$pro['id'].'" class="popup_link"><img class="hover_view  flaticon-visibility" src="'. base_url().'assets/img/Group313.png"></a>
			 <a class="product_link" href="'.base_url('brand-profile/'.str_replace(' ', '_', $pro['product_name'])).'">';
			 
			 $images=explode(",", $pro['product_image']);
			$html .=' <img class="p_main" src="'.base_url().'/uploads/product/'.$images[0].'">
			 </a>
			 <div class="product_text   mt-2 mb-2 __web-inspector-hide-shortcut__">';
				$brand_name = $this->db->get_where('brand',array('id' => $pro['brand']))->row_array();
				
				$html .='<div class="row">
				   <div class="col-md-7">
					  <h4>'.$brand_name['bname'].'</h4>
					  <p class="product_space">'.$pro['product_name'].'</p>
				   </div>
				   <div class="col-md-5">
					  '.$btn.' 
				   </div>
				</div>
			 </div>
		  </div>
	   </div>
	   <div id="popup7'.$pro['id'].'" class="product-gird__quick-view-popup mfp-hide">
		  <div class="row justify-content-between align-items-center">
			 <div class="col-lg-8">
				<div class="quick-view__left-content">
				   <div class="tabs">
					  <div class="popup-product-thumb-box tabsa">
						 <ul>';
							$imagesa=explode(",", $pro['product_image']);
							   $no = 0;
							   foreach ($imagesa as $key => $value) {
							   $no = $no + 1;	
							  
							$html .='<li class="tab-nav popup-product-thumb"> <a
							   href="#tab'.$no.'"> <img
							   src="'.base_url().'/uploads/product/'.$value.'"
							   alt="" /> </a> </li>';
							}
						$html .='
						 </ul>
					  </div>
					  <div class="popup-product-main-image-box">';
						 $imagesa=explode(",", $pro['product_image']);
							$no = 0;
							foreach ($imagesa as $key => $value) {
							$no = $no + 1;
							
						 $html .='<div id="tab'.$no.'"
							class="tab-item popup-product-image">
							<div class="popup-product-single-image"> <img
							   src="'.base_url().'/uploads/product/'.$value.'"
							   alt="" /> </div>
						 </div>';
						 } 	
						 $html .='<button class="prev"> <i
							class="flaticon-back"></i> </button> <button
							class="next"> <i class="flaticon-next"></i>
						 </button>
					  </div>
				   </div>
				</div>
			 </div>
			 <div class="col-lg-4">
				<div class="popup-right-content">
				   <div class="brand_logo_details mb-3">
					  <a href="'.base_url('brandprofile/'.str_replace(' ', '_', $brand_name['bname'])).'">
					  <img src="'.base_url().'uploads/brand/'.$brand_name['images'].'" class="img-thumbnail"></a>
				   </div>
				   <h3>'.$brand_name['bname'].'</h3>
				   <p class="text"> '.$pro['product_name'].'
				   </p>
				   <div class="price">
					  <p>'.substr($pro['description'], 0, 50).'</p>
				   </div>
				   <div class="mt-3 metalic">
					  <p><b>Collection :  </b>'.$pro['collection'].'</p>
					
					  <p><b>Finish :  </b>';
						  $finish=explode(",", $pro['finish']);
							foreach ($finish as $key => $fi) {
							   $fini = $this->db->get_where('finish',array('id' => $fi))->row_array();
							
							 $fini['finish']."," ;  } 	
							
					  $html .='</p>
					  <p><b>Use :  </b>'.$pro['indoor_outdoor'].' </p>
				   </div>
				</div>
			 </div>
		  </div>
	   </div>';
		}
		}
		else{
		$html .=' <h3 style="color:red;text-align:center;">No Record Found</h3>';
		}
		$data['html'] = $html;
        echo json_encode($data);
	}
	public function finish_data(){
		header("Content-type:application/json");
		$id = $this->input->post('i_id');
		$s_id = $this->input->post('s_id');
		
	    $s=$this->db->get_where('subcategories',array('sname' => $s_id))->row_array();
		$c_id = $s['id'];
	    $subcategories = $this->db->query("SELECT * FROM product WHERE FIND_IN_SET(".$id.",`finish`) AND sname = '$c_id'")->result_array();
	    
	    
		$html ="";
		if($subcategories) {
		foreach($subcategories as $pro) {
		

			 $user_id = $this->session->userdata('user_id');
			 $get_wishlist = $this->db->get_where('wishlist',array('user_id' =>$user_id,'product_id'=>$pro['id']))->num_rows();
			 if($get_wishlist == 0) {
			 if(!empty($user_id)) { $link = base_url('add-wishlist/').$pro['id'].'/'.$this->uri->segment(2);  } else { $link = base_url('login'); } 
			 
		  $btn ='<a href="'.$link .' " style="width:100%;"> <span class="product_icon" style="width:100%;"><img src="'.base_url().'assets/img/Union.png" style="width:20%;display:inline-block;"> <span style="display: inline-block;">'.$count = $this->db->get_where('wishlist',array('product_id' =>$pro['id'] ))->num_rows().'</span></span></a>';
		  } else{ 
		  $btn ='<a href="'.base_url('remove-wishlist/').$pro['id'].'/'.$this->uri->segment(2).'" style="width:100%;"> <span class="product_icon" style="width:100%;"><img src="'.base_url().'assets/img/unwishlist.png" style="width:20%;display:inline-block;"> <span style="display: inline-block;">'.$count = $this->db->get_where('wishlist',array('product_id' =>$pro['id'] ))->num_rows().'</span></span></a>';
		   } 			
		$html .='<div class="col-xl-4 col-lg-6 col-md-6 mb-3">
		  <div class="produc_list_page product_hover">
			 <a href="#popup7'.$pro['id'].'" class="popup_link"><img class="hover_view  flaticon-visibility" src="'. base_url().'assets/img/Group313.png"></a>
			 <a class="product_link" href="'.base_url('brand-profile/'.str_replace(' ', '_', $pro['product_name'])).'">';
			 
			 $images=explode(",", $pro['product_image']);
			$html .=' <img class="p_main" src="'.base_url().'/uploads/product/'.$images[0].'">
			 </a>
			 <div class="product_text   mt-2 mb-2 __web-inspector-hide-shortcut__">';
				$brand_name = $this->db->get_where('brand',array('id' => $pro['brand']))->row_array();
				
				$html .='<div class="row">
				   <div class="col-md-7">
					  <h4>'.$brand_name['bname'].'</h4>
					  <p class="product_space">'.$pro['product_name'].'</p>
				   </div>
				   <div class="col-md-5">
					  '.$btn.' 
				   </div>
				</div>
			 </div>
		  </div>
	   </div>
	   <div id="popup7'.$pro['id'].'" class="product-gird__quick-view-popup mfp-hide">
		  <div class="row justify-content-between align-items-center">
			 <div class="col-lg-8">
				<div class="quick-view__left-content">
				   <div class="tabs">
					  <div class="popup-product-thumb-box tabsa">
						 <ul>';
							$imagesa=explode(",", $pro['product_image']);
							   $no = 0;
							   foreach ($imagesa as $key => $value) {
							   $no = $no + 1;	
							  
							$html .='<li class="tab-nav popup-product-thumb"> <a
							   href="#tab'.$no.'"> <img
							   src="'.base_url().'/uploads/product/'.$value.'"
							   alt="" /> </a> </li>';
							}
						$html .='
						 </ul>
					  </div>
					  <div class="popup-product-main-image-box">';
						 $imagesa=explode(",", $pro['product_image']);
							$no = 0;
							foreach ($imagesa as $key => $value) {
							$no = $no + 1;
							
						 $html .='<div id="tab'.$no.'"
							class="tab-item popup-product-image">
							<div class="popup-product-single-image"> <img
							   src="'.base_url().'/uploads/product/'.$value.'"
							   alt="" /> </div>
						 </div>';
						 } 	
						 $html .='<button class="prev"> <i
							class="flaticon-back"></i> </button> <button
							class="next"> <i class="flaticon-next"></i>
						 </button>
					  </div>
				   </div>
				</div>
			 </div>
			 <div class="col-lg-4">
				<div class="popup-right-content">
				   <div class="brand_logo_details mb-3">
					  <a href="'.base_url('brandprofile/'.str_replace(' ', '_', $brand_name['bname'])).'">
					  <img src="'.base_url().'uploads/brand/'.$brand_name['images'].'" class="img-thumbnail"></a>
				   </div>
				   <h3>'.$brand_name['bname'].'</h3>
				   <p class="text"> '.$pro['product_name'].'
				   </p>
				   <div class="price">
					  <p>'.substr($pro['description'], 0, 50).'</p>
				   </div>
				   <div class="mt-3 metalic">
					  <p><b>Collection :  </b>'.$pro['collection'].'</p>
					
					  <p><b>Finish :  </b>';
						  $finish=explode(",", $pro['finish']);
							foreach ($finish as $key => $fi) {
							   $fini = $this->db->get_where('finish',array('id' => $fi))->row_array();
							
							 $fini['finish']."," ;  } 	
							
					  $html .='</p>
					  <p><b>Use :  </b>'.$pro['indoor_outdoor'].' </p>
				   </div>
				</div>
			 </div>
		  </div>
	   </div>';
		}
		}
		else{
		$html .=' <h3 style="color:red;text-align:center;">No Record Found</h3>';
		}
		$data['html'] = $html;
        echo json_encode($data);
	}
	public function size_data(){
		header("Content-type:application/json");
		$id = $this->input->post('i_id');
		$s_id = $this->input->post('s_id');
		
	    $s=$this->db->get_where('subcategories',array('sname' => $s_id))->row_array();
		$c_id = $s['id'];
	    $subcategories = $this->db->query("SELECT * FROM product WHERE FIND_IN_SET(".$id.",`size`) AND sname = '$c_id'")->result_array();
	    
	    
		$html ="";
		if($subcategories) {
		foreach($subcategories as $pro) {
		

			 $user_id = $this->session->userdata('user_id');
			 $get_wishlist = $this->db->get_where('wishlist',array('user_id' =>$user_id,'product_id'=>$pro['id']))->num_rows();
			 if($get_wishlist == 0) {
			 if(!empty($user_id)) { $link = base_url('add-wishlist/').$pro['id'].'/'.$this->uri->segment(2);  } else { $link = base_url('login'); } 
			 
		  $btn ='<a href="'.$link .' " style="width:100%;"> <span class="product_icon" style="width:100%;"><img src="'.base_url().'assets/img/Union.png" style="width:20%;display:inline-block;"> <span style="display: inline-block;">'.$count = $this->db->get_where('wishlist',array('product_id' =>$pro['id'] ))->num_rows().'</span></span></a>';
		  } else{ 
		  $btn ='<a href="'.base_url('remove-wishlist/').$pro['id'].'/'.$this->uri->segment(2).'" style="width:100%;"> <span class="product_icon" style="width:100%;"><img src="'.base_url().'assets/img/unwishlist.png" style="width:20%;display:inline-block;"> <span style="display: inline-block;">'.$count = $this->db->get_where('wishlist',array('product_id' =>$pro['id'] ))->num_rows().'</span></span></a>';
		   } 			
		$html .='<div class="col-xl-4 col-lg-6 col-md-6 mb-3">
		  <div class="produc_list_page product_hover">
			 <a href="#popup7'.$pro['id'].'" class="popup_link"><img class="hover_view  flaticon-visibility" src="'. base_url().'assets/img/Group313.png"></a>
			 <a class="product_link" href="'.base_url('brand-profile/'.str_replace(' ', '_', $pro['product_name'])).'">';
			 
			 $images=explode(",", $pro['product_image']);
			$html .=' <img class="p_main" src="'.base_url().'/uploads/product/'.$images[0].'">
			 </a>
			 <div class="product_text   mt-2 mb-2 __web-inspector-hide-shortcut__">';
				$brand_name = $this->db->get_where('brand',array('id' => $pro['brand']))->row_array();
				
				$html .='<div class="row">
				   <div class="col-md-7">
					  <h4>'.$brand_name['bname'].'</h4>
					  <p class="product_space">'.$pro['product_name'].'</p>
				   </div>
				   <div class="col-md-5">
					  '.$btn.' 
				   </div>
				</div>
			 </div>
		  </div>
	   </div>
	   <div id="popup7'.$pro['id'].'" class="product-gird__quick-view-popup mfp-hide">
		  <div class="row justify-content-between align-items-center">
			 <div class="col-lg-8">
				<div class="quick-view__left-content">
				   <div class="tabs">
					  <div class="popup-product-thumb-box tabsa">
						 <ul>';
							$imagesa=explode(",", $pro['product_image']);
							   $no = 0;
							   foreach ($imagesa as $key => $value) {
							   $no = $no + 1;	
							  
							$html .='<li class="tab-nav popup-product-thumb"> <a
							   href="#tab'.$no.'"> <img
							   src="'.base_url().'/uploads/product/'.$value.'"
							   alt="" /> </a> </li>';
							}
						$html .='
						 </ul>
					  </div>
					  <div class="popup-product-main-image-box">';
						 $imagesa=explode(",", $pro['product_image']);
							$no = 0;
							foreach ($imagesa as $key => $value) {
							$no = $no + 1;
							
						 $html .='<div id="tab'.$no.'"
							class="tab-item popup-product-image">
							<div class="popup-product-single-image"> <img
							   src="'.base_url().'/uploads/product/'.$value.'"
							   alt="" /> </div>
						 </div>';
						 } 	
						 $html .='<button class="prev"> <i
							class="flaticon-back"></i> </button> <button
							class="next"> <i class="flaticon-next"></i>
						 </button>
					  </div>
				   </div>
				</div>
			 </div>
			 <div class="col-lg-4">
				<div class="popup-right-content">
				   <div class="brand_logo_details mb-3">
					  <a href="'.base_url('brandprofile/'.str_replace(' ', '_', $brand_name['bname'])).'">
					  <img src="'.base_url().'uploads/brand/'.$brand_name['images'].'" class="img-thumbnail"></a>
				   </div>
				   <h3>'.$brand_name['bname'].'</h3>
				   <p class="text"> '.$pro['product_name'].'
				   </p>
				   <div class="price">
					  <p>'.substr($pro['description'], 0, 50).'</p>
				   </div>
				   <div class="mt-3 metalic">
					  <p><b>Collection :  </b>'.$pro['collection'].'</p>
					
					  <p><b>Finish :  </b>';
						  $finish=explode(",", $pro['finish']);
							foreach ($finish as $key => $fi) {
							   $fini = $this->db->get_where('finish',array('id' => $fi))->row_array();
							
							 $fini['finish']."," ;  } 	
							
					  $html .='</p>
					  <p><b>Use :  </b>'.$pro['indoor_outdoor'].' </p>
				   </div>
				</div>
			 </div>
		  </div>
	   </div>';
		}
		}
		else{
		$html .=' <h3 style="color:red;text-align:center;">No Record Found</h3>';
		}
		$data['html'] = $html;
        echo json_encode($data);
	}
	public function thickness_data(){
		header("Content-type:application/json");
		$id = $this->input->post('i_id');
		$s_id = $this->input->post('s_id');
		
	    $s=$this->db->get_where('subcategories',array('sname' => $s_id))->row_array();
		$c_id = $s['id'];
	    $subcategories = $this->db->query("SELECT * FROM product WHERE FIND_IN_SET(".$id.",`thickness`) AND sname = '$c_id'")->result_array();
	    
	   
		$html ="";
		if($subcategories) {
		foreach($subcategories as $pro) {
		

			 $user_id = $this->session->userdata('user_id');
			 $get_wishlist = $this->db->get_where('wishlist',array('user_id' =>$user_id,'product_id'=>$pro['id']))->num_rows();
			 if($get_wishlist == 0) {
			 if(!empty($user_id)) { $link = base_url('add-wishlist/').$pro['id'].'/'.$this->uri->segment(2);  } else { $link = base_url('login'); } 
			 
		  $btn ='<a href="'.$link .' " style="width:100%;"> <span class="product_icon" style="width:100%;"><img src="'.base_url().'assets/img/Union.png" style="width:20%;display:inline-block;"> <span style="display: inline-block;">'.$count = $this->db->get_where('wishlist',array('product_id' =>$pro['id'] ))->num_rows().'</span></span></a>';
		  } else{ 
		  $btn ='<a href="'.base_url('remove-wishlist/').$pro['id'].'/'.$this->uri->segment(2).'" style="width:100%;"> <span class="product_icon" style="width:100%;"><img src="'.base_url().'assets/img/unwishlist.png" style="width:20%;display:inline-block;"> <span style="display: inline-block;">'.$count = $this->db->get_where('wishlist',array('product_id' =>$pro['id'] ))->num_rows().'</span></span></a>';
		   } 			
		$html .='<div class="col-xl-4 col-lg-6 col-md-6 mb-3">
		  <div class="produc_list_page product_hover">
			 <a href="#popup7'.$pro['id'].'" class="popup_link"><img class="hover_view  flaticon-visibility" src="'. base_url().'assets/img/Group313.png"></a>
			 <a class="product_link" href="'.base_url('brand-profile/'.str_replace(' ', '_', $pro['product_name'])).'">';
			 
			 $images=explode(",", $pro['product_image']);
			$html .=' <img class="p_main" src="'.base_url().'/uploads/product/'.$images[0].'">
			 </a>
			 <div class="product_text   mt-2 mb-2 __web-inspector-hide-shortcut__">';
				$brand_name = $this->db->get_where('brand',array('id' => $pro['brand']))->row_array();
				
				$html .='<div class="row">
				   <div class="col-md-7">
					  <h4>'.$brand_name['bname'].'</h4>
					  <p class="product_space">'.$pro['product_name'].'</p>
				   </div>
				   <div class="col-md-5">
					  '.$btn.' 
				   </div>
				</div>
			 </div>
		  </div>
	   </div>
	   <div id="popup7'.$pro['id'].'" class="product-gird__quick-view-popup mfp-hide">
		  <div class="row justify-content-between align-items-center">
			 <div class="col-lg-8">
				<div class="quick-view__left-content">
				   <div class="tabs">
					  <div class="popup-product-thumb-box tabsa">
						 <ul>';
							$imagesa=explode(",", $pro['product_image']);
							   $no = 0;
							   foreach ($imagesa as $key => $value) {
							   $no = $no + 1;	
							  
							$html .='<li class="tab-nav popup-product-thumb"> <a
							   href="#tab'.$no.'"> <img
							   src="'.base_url().'/uploads/product/'.$value.'"
							   alt="" /> </a> </li>';
							}
						$html .='
						 </ul>
					  </div>
					  <div class="popup-product-main-image-box">';
						 $imagesa=explode(",", $pro['product_image']);
							$no = 0;
							foreach ($imagesa as $key => $value) {
							$no = $no + 1;
							
						 $html .='<div id="tab'.$no.'"
							class="tab-item popup-product-image">
							<div class="popup-product-single-image"> <img
							   src="'.base_url().'/uploads/product/'.$value.'"
							   alt="" /> </div>
						 </div>';
						 } 	
						 $html .='<button class="prev"> <i
							class="flaticon-back"></i> </button> <button
							class="next"> <i class="flaticon-next"></i>
						 </button>
					  </div>
				   </div>
				</div>
			 </div>
			 <div class="col-lg-4">
				<div class="popup-right-content">
				   <div class="brand_logo_details mb-3">
					  <a href="'.base_url('brandprofile/'.str_replace(' ', '_', $brand_name['bname'])).'">
					  <img src="'.base_url().'uploads/brand/'.$brand_name['images'].'" class="img-thumbnail"></a>
				   </div>
				   <h3>'.$brand_name['bname'].'</h3>
				   <p class="text"> '.$pro['product_name'].'
				   </p>
				   <div class="price">
					  <p>'.substr($pro['description'], 0, 50).'</p>
				   </div>
				   <div class="mt-3 metalic">
					  <p><b>Collection :  </b>'.$pro['collection'].'</p>
					
					  <p><b>Finish :  </b>';
						  $finish=explode(",", $pro['finish']);
							foreach ($finish as $key => $fi) {
							   $fini = $this->db->get_where('finish',array('id' => $fi))->row_array();
							
							 $fini['finish']."," ;  } 	
							
					  $html .='</p>
					  <p><b>Use :  </b>'.$pro['indoor_outdoor'].' </p>
				   </div>
				</div>
			 </div>
		  </div>
	   </div>';
		}
		}
		else{
		$html .=' <h3 style="color:red;text-align:center;">No Record Found</h3>';
		}
		$data['html'] = $html;
        echo json_encode($data);
	}
	public function type_data(){
		header("Content-type:application/json");
		$id = $this->input->post('i_id');
		$s_id = $this->input->post('s_id');
		
	    $s=$this->db->get_where('subcategories',array('sname' => $s_id))->row_array();
		$c_id = $s['id'];
	    $subcategories = $this->db->query("SELECT * FROM product WHERE FIND_IN_SET(".$id.",`type`) AND sname = '$c_id'")->result_array();
	    
		$html ="";
		if($subcategories) {
		foreach($subcategories as $pro) {
		

			 $user_id = $this->session->userdata('user_id');
			 $get_wishlist = $this->db->get_where('wishlist',array('user_id' =>$user_id,'product_id'=>$pro['id']))->num_rows();
			 if($get_wishlist == 0) {
			 if(!empty($user_id)) { $link = base_url('add-wishlist/').$pro['id'].'/'.$this->uri->segment(2);  } else { $link = base_url('login'); } 
			 
		  $btn ='<a href="'.$link .' " style="width:100%;"> <span class="product_icon" style="width:100%;"><img src="'.base_url().'assets/img/Union.png" style="width:20%;display:inline-block;"> <span style="display: inline-block;">'.$count = $this->db->get_where('wishlist',array('product_id' =>$pro['id'] ))->num_rows().'</span></span></a>';
		  } else{ 
		  $btn ='<a href="'.base_url('remove-wishlist/').$pro['id'].'/'.$this->uri->segment(2).'" style="width:100%;"> <span class="product_icon" style="width:100%;"><img src="'.base_url().'assets/img/unwishlist.png" style="width:20%;display:inline-block;"> <span style="display: inline-block;">'.$count = $this->db->get_where('wishlist',array('product_id' =>$pro['id'] ))->num_rows().'</span></span></a>';
		   } 			
		$html .='<div class="col-xl-4 col-lg-6 col-md-6 mb-3">
		  <div class="produc_list_page product_hover">
			 <a href="#popup7'.$pro['id'].'" class="popup_link"><img class="hover_view  flaticon-visibility" src="'. base_url().'assets/img/Group313.png"></a>
			 <a class="product_link" href="'.base_url('brand-profile/'.str_replace(' ', '_', $pro['product_name'])).'">';
			 
			 $images=explode(",", $pro['product_image']);
			$html .=' <img class="p_main" src="'.base_url().'/uploads/product/'.$images[0].'">
			 </a>
			 <div class="product_text   mt-2 mb-2 __web-inspector-hide-shortcut__">';
				$brand_name = $this->db->get_where('brand',array('id' => $pro['brand']))->row_array();
				
				$html .='<div class="row">
				   <div class="col-md-7">
					  <h4>'.$brand_name['bname'].'</h4>
					  <p class="product_space">'.$pro['product_name'].'</p>
				   </div>
				   <div class="col-md-5">
					  '.$btn.' 
				   </div>
				</div>
			 </div>
		  </div>
	   </div>
	   <div id="popup7'.$pro['id'].'" class="product-gird__quick-view-popup mfp-hide">
		  <div class="row justify-content-between align-items-center">
			 <div class="col-lg-8">
				<div class="quick-view__left-content">
				   <div class="tabs">
					  <div class="popup-product-thumb-box tabsa">
						 <ul>';
							$imagesa=explode(",", $pro['product_image']);
							   $no = 0;
							   foreach ($imagesa as $key => $value) {
							   $no = $no + 1;	
							  
							$html .='<li class="tab-nav popup-product-thumb"> <a
							   href="#tab'.$no.'"> <img
							   src="'.base_url().'/uploads/product/'.$value.'"
							   alt="" /> </a> </li>';
							}
						$html .='
						 </ul>
					  </div>
					  <div class="popup-product-main-image-box">';
						 $imagesa=explode(",", $pro['product_image']);
							$no = 0;
							foreach ($imagesa as $key => $value) {
							$no = $no + 1;
							
						 $html .='<div id="tab'.$no.'"
							class="tab-item popup-product-image">
							<div class="popup-product-single-image"> <img
							   src="'.base_url().'/uploads/product/'.$value.'"
							   alt="" /> </div>
						 </div>';
						 } 	
						 $html .='<button class="prev"> <i
							class="flaticon-back"></i> </button> <button
							class="next"> <i class="flaticon-next"></i>
						 </button>
					  </div>
				   </div>
				</div>
			 </div>
			 <div class="col-lg-4">
				<div class="popup-right-content">
				   <div class="brand_logo_details mb-3">
					  <a href="'.base_url('brandprofile/'.str_replace(' ', '_', $brand_name['bname'])).'">
					  <img src="'.base_url().'uploads/brand/'.$brand_name['images'].'" class="img-thumbnail"></a>
				   </div>
				   <h3>'.$brand_name['bname'].'</h3>
				   <p class="text"> '.$pro['product_name'].'
				   </p>
				   <div class="price">
					  <p>'.substr($pro['description'], 0, 50).'</p>
				   </div>
				   <div class="mt-3 metalic">
					  <p><b>Collection :  </b>'.$pro['collection'].'</p>
					
					  <p><b>Finish :  </b>';
						  $finish=explode(",", $pro['finish']);
							foreach ($finish as $key => $fi) {
							   $fini = $this->db->get_where('finish',array('id' => $fi))->row_array();
							
							 $fini['finish']."," ;  } 	
							
					  $html .='</p>
					  <p><b>Use :  </b>'.$pro['indoor_outdoor'].' </p>
				   </div>
				</div>
			 </div>
		  </div>
	   </div>';
		}
		}
		else{
		$html .=' <h3 style="color:red;text-align:center;">No Record Found</h3>';
		}
		$data['html'] = $html;
        echo json_encode($data);
	}
	public function themes_data(){
		header("Content-type:application/json");
		$id = $this->input->post('i_id');
		$s_id = $this->input->post('s_id');
		
	    $s=$this->db->get_where('subcategories',array('sname' => $s_id))->row_array();
		$c_id = $s['id'];
	    $subcategories = $this->db->query("SELECT * FROM product WHERE FIND_IN_SET(".$id.",`themes`) AND sname = '$c_id'")->result_array();
	    
	    
		$html ="";
		if($subcategories) {
		foreach($subcategories as $pro) {
		

			 $user_id = $this->session->userdata('user_id');
			 $get_wishlist = $this->db->get_where('wishlist',array('user_id' =>$user_id,'product_id'=>$pro['id']))->num_rows();
			 if($get_wishlist == 0) {
			 if(!empty($user_id)) { $link = base_url('add-wishlist/').$pro['id'].'/'.$this->uri->segment(2);  } else { $link = base_url('login'); } 
			 
		  $btn ='<a href="'.$link .' " style="width:100%;"> <span class="product_icon" style="width:100%;"><img src="'.base_url().'assets/img/Union.png" style="width:20%;display:inline-block;"> <span style="display: inline-block;">'.$count = $this->db->get_where('wishlist',array('product_id' =>$pro['id'] ))->num_rows().'</span></span></a>';
		  } else{ 
		  $btn ='<a href="'.base_url('remove-wishlist/').$pro['id'].'/'.$this->uri->segment(2).'" style="width:100%;"> <span class="product_icon" style="width:100%;"><img src="'.base_url().'assets/img/unwishlist.png" style="width:20%;display:inline-block;"> <span style="display: inline-block;">'.$count = $this->db->get_where('wishlist',array('product_id' =>$pro['id'] ))->num_rows().'</span></span></a>';
		   } 			
		$html .='<div class="col-xl-4 col-lg-6 col-md-6 mb-3">
		  <div class="produc_list_page product_hover">
			 <a href="#popup7'.$pro['id'].'" class="popup_link"><img class="hover_view  flaticon-visibility" src="'. base_url().'assets/img/Group313.png"></a>
			 <a class="product_link" href="'.base_url('brand-profile/'.str_replace(' ', '_', $pro['product_name'])).'">';
			 
			 $images=explode(",", $pro['product_image']);
			$html .=' <img class="p_main" src="'.base_url().'/uploads/product/'.$images[0].'">
			 </a>
			 <div class="product_text   mt-2 mb-2 __web-inspector-hide-shortcut__">';
				$brand_name = $this->db->get_where('brand',array('id' => $pro['brand']))->row_array();
				
				$html .='<div class="row">
				   <div class="col-md-7">
					  <h4>'.$brand_name['bname'].'</h4>
					  <p class="product_space">'.$pro['product_name'].'</p>
				   </div>
				   <div class="col-md-5">
					  '.$btn.' 
				   </div>
				</div>
			 </div>
		  </div>
	   </div>
	   <div id="popup7'.$pro['id'].'" class="product-gird__quick-view-popup mfp-hide">
		  <div class="row justify-content-between align-items-center">
			 <div class="col-lg-8">
				<div class="quick-view__left-content">
				   <div class="tabs">
					  <div class="popup-product-thumb-box tabsa">
						 <ul>';
							$imagesa=explode(",", $pro['product_image']);
							   $no = 0;
							   foreach ($imagesa as $key => $value) {
							   $no = $no + 1;	
							  
							$html .='<li class="tab-nav popup-product-thumb"> <a
							   href="#tab'.$no.'"> <img
							   src="'.base_url().'/uploads/product/'.$value.'"
							   alt="" /> </a> </li>';
							}
						$html .='
						 </ul>
					  </div>
					  <div class="popup-product-main-image-box">';
						 $imagesa=explode(",", $pro['product_image']);
							$no = 0;
							foreach ($imagesa as $key => $value) {
							$no = $no + 1;
							
						 $html .='<div id="tab'.$no.'"
							class="tab-item popup-product-image">
							<div class="popup-product-single-image"> <img
							   src="'.base_url().'/uploads/product/'.$value.'"
							   alt="" /> </div>
						 </div>';
						 } 	
						 $html .='<button class="prev"> <i
							class="flaticon-back"></i> </button> <button
							class="next"> <i class="flaticon-next"></i>
						 </button>
					  </div>
				   </div>
				</div>
			 </div>
			 <div class="col-lg-4">
				<div class="popup-right-content">
				   <div class="brand_logo_details mb-3">
					  <a href="'.base_url('brandprofile/'.str_replace(' ', '_', $brand_name['bname'])).'">
					  <img src="'.base_url().'uploads/brand/'.$brand_name['images'].'" class="img-thumbnail"></a>
				   </div>
				   <h3>'.$brand_name['bname'].'</h3>
				   <p class="text"> '.$pro['product_name'].'
				   </p>
				   <div class="price">
					  <p>'.substr($pro['description'], 0, 50).'</p>
				   </div>
				   <div class="mt-3 metalic">
					  <p><b>Collection :  </b>'.$pro['collection'].'</p>
					
					  <p><b>Finish :  </b>';
						  $finish=explode(",", $pro['finish']);
							foreach ($finish as $key => $fi) {
							   $fini = $this->db->get_where('finish',array('id' => $fi))->row_array();
							
							 $fini['finish']."," ;  } 	
							
					  $html .='</p>
					  <p><b>Use :  </b>'.$pro['indoor_outdoor'].' </p>
				   </div>
				</div>
			 </div>
		  </div>
	   </div>';
		}
		}
		else{
		$html .=' <h3 style="color:red;text-align:center;">No Record Found</h3>';
		}
		$data['html'] = $html;
        echo json_encode($data);
	}
	public function light_bulb_type_data(){
		header("Content-type:application/json");
		$id = $this->input->post('i_id');
		$s_id = $this->input->post('s_id');
		
	    $s=$this->db->get_where('subcategories',array('sname' => $s_id))->row_array();
		$c_id = $s['id'];
	    $subcategories = $this->db->query("SELECT * FROM product WHERE FIND_IN_SET(".$id.",`light_bulb`) AND sname = '$c_id'")->result_array();
	    
		$html ="";
		if($subcategories) {
		foreach($subcategories as $pro) {
		

			 $user_id = $this->session->userdata('user_id');
			 $get_wishlist = $this->db->get_where('wishlist',array('user_id' =>$user_id,'product_id'=>$pro['id']))->num_rows();
			 if($get_wishlist == 0) {
			 if(!empty($user_id)) { $link = base_url('add-wishlist/').$pro['id'].'/'.$this->uri->segment(2);  } else { $link = base_url('login'); } 
			 
		  $btn ='<a href="'.$link .' " style="width:100%;"> <span class="product_icon" style="width:100%;"><img src="'.base_url().'assets/img/Union.png" style="width:20%;display:inline-block;"> <span style="display: inline-block;">'.$count = $this->db->get_where('wishlist',array('product_id' =>$pro['id'] ))->num_rows().'</span></span></a>';
		  } else{ 
		  $btn ='<a href="'.base_url('remove-wishlist/').$pro['id'].'/'.$this->uri->segment(2).'" style="width:100%;"> <span class="product_icon" style="width:100%;"><img src="'.base_url().'assets/img/unwishlist.png" style="width:20%;display:inline-block;"> <span style="display: inline-block;">'.$count = $this->db->get_where('wishlist',array('product_id' =>$pro['id'] ))->num_rows().'</span></span></a>';
		   } 			
		$html .='<div class="col-xl-4 col-lg-6 col-md-6 mb-3">
		  <div class="produc_list_page product_hover">
			 <a href="#popup7'.$pro['id'].'" class="popup_link"><img class="hover_view  flaticon-visibility" src="'. base_url().'assets/img/Group313.png"></a>
			 <a class="product_link" href="'.base_url('brand-profile/'.str_replace(' ', '_', $pro['product_name'])).'">';
			 
			 $images=explode(",", $pro['product_image']);
			$html .=' <img class="p_main" src="'.base_url().'/uploads/product/'.$images[0].'">
			 </a>
			 <div class="product_text   mt-2 mb-2 __web-inspector-hide-shortcut__">';
				$brand_name = $this->db->get_where('brand',array('id' => $pro['brand']))->row_array();
				
				$html .='<div class="row">
				   <div class="col-md-7">
					  <h4>'.$brand_name['bname'].'</h4>
					  <p class="product_space">'.$pro['product_name'].'</p>
				   </div>
				   <div class="col-md-5">
					  '.$btn.' 
				   </div>
				</div>
			 </div>
		  </div>
	   </div>
	   <div id="popup7'.$pro['id'].'" class="product-gird__quick-view-popup mfp-hide">
		  <div class="row justify-content-between align-items-center">
			 <div class="col-lg-8">
				<div class="quick-view__left-content">
				   <div class="tabs">
					  <div class="popup-product-thumb-box tabsa">
						 <ul>';
							$imagesa=explode(",", $pro['product_image']);
							   $no = 0;
							   foreach ($imagesa as $key => $value) {
							   $no = $no + 1;	
							  
							$html .='<li class="tab-nav popup-product-thumb"> <a
							   href="#tab'.$no.'"> <img
							   src="'.base_url().'/uploads/product/'.$value.'"
							   alt="" /> </a> </li>';
							}
						$html .='
						 </ul>
					  </div>
					  <div class="popup-product-main-image-box">';
						 $imagesa=explode(",", $pro['product_image']);
							$no = 0;
							foreach ($imagesa as $key => $value) {
							$no = $no + 1;
							
						 $html .='<div id="tab'.$no.'"
							class="tab-item popup-product-image">
							<div class="popup-product-single-image"> <img
							   src="'.base_url().'/uploads/product/'.$value.'"
							   alt="" /> </div>
						 </div>';
						 } 	
						 $html .='<button class="prev"> <i
							class="flaticon-back"></i> </button> <button
							class="next"> <i class="flaticon-next"></i>
						 </button>
					  </div>
				   </div>
				</div>
			 </div>
			 <div class="col-lg-4">
				<div class="popup-right-content">
				   <div class="brand_logo_details mb-3">
					  <a href="'.base_url('brandprofile/'.str_replace(' ', '_', $brand_name['bname'])).'">
					  <img src="'.base_url().'uploads/brand/'.$brand_name['images'].'" class="img-thumbnail"></a>
				   </div>
				   <h3>'.$brand_name['bname'].'</h3>
				   <p class="text"> '.$pro['product_name'].'
				   </p>
				   <div class="price">
					  <p>'.substr($pro['description'], 0, 50).'</p>
				   </div>
				   <div class="mt-3 metalic">
					  <p><b>Collection :  </b>'.$pro['collection'].'</p>
					
					  <p><b>Finish :  </b>';
						  $finish=explode(",", $pro['finish']);
							foreach ($finish as $key => $fi) {
							   $fini = $this->db->get_where('finish',array('id' => $fi))->row_array();
							
							 $fini['finish']."," ;  } 	
							
					  $html .='</p>
					  <p><b>Use :  </b>'.$pro['indoor_outdoor'].' </p>
				   </div>
				</div>
			 </div>
		  </div>
	   </div>';
		}
		}
		else{
		$html .=' <h3 style="color:red;text-align:center;">No Record Found</h3>';
		}
		$data['html'] = $html;
        echo json_encode($data);
	}
	public function number_of_seat_data(){
		header("Content-type:application/json");
		$id = $this->input->post('i_id');
		$s_id = $this->input->post('s_id');
		
	    $s=$this->db->get_where('subcategories',array('sname' => $s_id))->row_array();
		$c_id = $s['id'];
	    $subcategories = $this->db->query("SELECT * FROM product WHERE FIND_IN_SET(".$id.",`number_of_seat`) AND sname = '$c_id'")->result_array();
	    
	    
		$html ="";
		if($subcategories) {
		foreach($subcategories as $pro) {
		

			 $user_id = $this->session->userdata('user_id');
			 $get_wishlist = $this->db->get_where('wishlist',array('user_id' =>$user_id,'product_id'=>$pro['id']))->num_rows();
			 if($get_wishlist == 0) {
			 if(!empty($user_id)) { $link = base_url('add-wishlist/').$pro['id'].'/'.$this->uri->segment(2);  } else { $link = base_url('login'); } 
			 
		  $btn ='<a href="'.$link .' " style="width:100%;"> <span class="product_icon" style="width:100%;"><img src="'.base_url().'assets/img/Union.png" style="width:20%;display:inline-block;"> <span style="display: inline-block;">'.$count = $this->db->get_where('wishlist',array('product_id' =>$pro['id'] ))->num_rows().'</span></span></a>';
		  } else{ 
		  $btn ='<a href="'.base_url('remove-wishlist/').$pro['id'].'/'.$this->uri->segment(2).'" style="width:100%;"> <span class="product_icon" style="width:100%;"><img src="'.base_url().'assets/img/unwishlist.png" style="width:20%;display:inline-block;"> <span style="display: inline-block;">'.$count = $this->db->get_where('wishlist',array('product_id' =>$pro['id'] ))->num_rows().'</span></span></a>';
		   } 			
		$html .='<div class="col-xl-4 col-lg-6 col-md-6 mb-3">
		  <div class="produc_list_page product_hover">
			 <a href="#popup7'.$pro['id'].'" class="popup_link"><img class="hover_view  flaticon-visibility" src="'. base_url().'assets/img/Group313.png"></a>
			 <a class="product_link" href="'.base_url('brand-profile/'.str_replace(' ', '_', $pro['product_name'])).'">';
			 
			 $images=explode(",", $pro['product_image']);
			$html .=' <img class="p_main" src="'.base_url().'/uploads/product/'.$images[0].'">
			 </a>
			 <div class="product_text   mt-2 mb-2 __web-inspector-hide-shortcut__">';
				$brand_name = $this->db->get_where('brand',array('id' => $pro['brand']))->row_array();
				
				$html .='<div class="row">
				   <div class="col-md-7">
					  <h4>'.$brand_name['bname'].'</h4>
					  <p class="product_space">'.$pro['product_name'].'</p>
				   </div>
				   <div class="col-md-5">
					  '.$btn.' 
				   </div>
				</div>
			 </div>
		  </div>
	   </div>
	   <div id="popup7'.$pro['id'].'" class="product-gird__quick-view-popup mfp-hide">
		  <div class="row justify-content-between align-items-center">
			 <div class="col-lg-8">
				<div class="quick-view__left-content">
				   <div class="tabs">
					  <div class="popup-product-thumb-box tabsa">
						 <ul>';
							$imagesa=explode(",", $pro['product_image']);
							   $no = 0;
							   foreach ($imagesa as $key => $value) {
							   $no = $no + 1;	
							  
							$html .='<li class="tab-nav popup-product-thumb"> <a
							   href="#tab'.$no.'"> <img
							   src="'.base_url().'/uploads/product/'.$value.'"
							   alt="" /> </a> </li>';
							}
						$html .='
						 </ul>
					  </div>
					  <div class="popup-product-main-image-box">';
						 $imagesa=explode(",", $pro['product_image']);
							$no = 0;
							foreach ($imagesa as $key => $value) {
							$no = $no + 1;
							
						 $html .='<div id="tab'.$no.'"
							class="tab-item popup-product-image">
							<div class="popup-product-single-image"> <img
							   src="'.base_url().'/uploads/product/'.$value.'"
							   alt="" /> </div>
						 </div>';
						 } 	
						 $html .='<button class="prev"> <i
							class="flaticon-back"></i> </button> <button
							class="next"> <i class="flaticon-next"></i>
						 </button>
					  </div>
				   </div>
				</div>
			 </div>
			 <div class="col-lg-4">
				<div class="popup-right-content">
				   <div class="brand_logo_details mb-3">
					  <a href="'.base_url('brandprofile/'.str_replace(' ', '_', $brand_name['bname'])).'">
					  <img src="'.base_url().'uploads/brand/'.$brand_name['images'].'" class="img-thumbnail"></a>
				   </div>
				   <h3>'.$brand_name['bname'].'</h3>
				   <p class="text"> '.$pro['product_name'].'
				   </p>
				   <div class="price">
					  <p>'.substr($pro['description'], 0, 50).'</p>
				   </div>
				   <div class="mt-3 metalic">
					  <p><b>Collection :  </b>'.$pro['collection'].'</p>
					
					  <p><b>Finish :  </b>';
						  $finish=explode(",", $pro['finish']);
							foreach ($finish as $key => $fi) {
							   $fini = $this->db->get_where('finish',array('id' => $fi))->row_array();
							
							 $fini['finish']."," ;  } 	
							
					  $html .='</p>
					  <p><b>Use :  </b>'.$pro['indoor_outdoor'].' </p>
				   </div>
				</div>
			 </div>
		  </div>
	   </div>';
		}
		}
		else{
		$html .=' <h3 style="color:red;text-align:center;">No Record Found</h3>';
		}
		$data['html'] = $html;
        echo json_encode($data);
	}
	public function bed_size_data(){
		header("Content-type:application/json");
		$id = $this->input->post('i_id');
		$s_id = $this->input->post('s_id');
		
	    $s=$this->db->get_where('subcategories',array('sname' => $s_id))->row_array();
		$c_id = $s['id'];
	    $subcategories = $this->db->query("SELECT * FROM product WHERE FIND_IN_SET(".$id.",`bed_size`) AND sname = '$c_id'")->result_array();
	    
	    
		$html ="";
		if($subcategories) {
		foreach($subcategories as $pro) {
		

			 $user_id = $this->session->userdata('user_id');
			 $get_wishlist = $this->db->get_where('wishlist',array('user_id' =>$user_id,'product_id'=>$pro['id']))->num_rows();
			 if($get_wishlist == 0) {
			 if(!empty($user_id)) { $link = base_url('add-wishlist/').$pro['id'].'/'.$this->uri->segment(2);  } else { $link = base_url('login'); } 
			 
		  $btn ='<a href="'.$link .' " style="width:100%;"> <span class="product_icon" style="width:100%;"><img src="'.base_url().'assets/img/Union.png" style="width:20%;display:inline-block;"> <span style="display: inline-block;">'.$count = $this->db->get_where('wishlist',array('product_id' =>$pro['id'] ))->num_rows().'</span></span></a>';
		  } else{ 
		  $btn ='<a href="'.base_url('remove-wishlist/').$pro['id'].'/'.$this->uri->segment(2).'" style="width:100%;"> <span class="product_icon" style="width:100%;"><img src="'.base_url().'assets/img/unwishlist.png" style="width:20%;display:inline-block;"> <span style="display: inline-block;">'.$count = $this->db->get_where('wishlist',array('product_id' =>$pro['id'] ))->num_rows().'</span></span></a>';
		   } 			
		$html .='<div class="col-xl-4 col-lg-6 col-md-6 mb-3">
		  <div class="produc_list_page product_hover">
			 <a href="#popup7'.$pro['id'].'" class="popup_link"><img class="hover_view  flaticon-visibility" src="'. base_url().'assets/img/Group313.png"></a>
			 <a class="product_link" href="'.base_url('brand-profile/'.str_replace(' ', '_', $pro['product_name'])).'">';
			 
			 $images=explode(",", $pro['product_image']);
			$html .=' <img class="p_main" src="'.base_url().'/uploads/product/'.$images[0].'">
			 </a>
			 <div class="product_text   mt-2 mb-2 __web-inspector-hide-shortcut__">';
				$brand_name = $this->db->get_where('brand',array('id' => $pro['brand']))->row_array();
				
				$html .='<div class="row">
				   <div class="col-md-7">
					  <h4>'.$brand_name['bname'].'</h4>
					  <p class="product_space">'.$pro['product_name'].'</p>
				   </div>
				   <div class="col-md-5">
					  '.$btn.' 
				   </div>
				</div>
			 </div>
		  </div>
	   </div>
	   <div id="popup7'.$pro['id'].'" class="product-gird__quick-view-popup mfp-hide">
		  <div class="row justify-content-between align-items-center">
			 <div class="col-lg-8">
				<div class="quick-view__left-content">
				   <div class="tabs">
					  <div class="popup-product-thumb-box tabsa">
						 <ul>';
							$imagesa=explode(",", $pro['product_image']);
							   $no = 0;
							   foreach ($imagesa as $key => $value) {
							   $no = $no + 1;	
							  
							$html .='<li class="tab-nav popup-product-thumb"> <a
							   href="#tab'.$no.'"> <img
							   src="'.base_url().'/uploads/product/'.$value.'"
							   alt="" /> </a> </li>';
							}
						$html .='
						 </ul>
					  </div>
					  <div class="popup-product-main-image-box">';
						 $imagesa=explode(",", $pro['product_image']);
							$no = 0;
							foreach ($imagesa as $key => $value) {
							$no = $no + 1;
							
						 $html .='<div id="tab'.$no.'"
							class="tab-item popup-product-image">
							<div class="popup-product-single-image"> <img
							   src="'.base_url().'/uploads/product/'.$value.'"
							   alt="" /> </div>
						 </div>';
						 } 	
						 $html .='<button class="prev"> <i
							class="flaticon-back"></i> </button> <button
							class="next"> <i class="flaticon-next"></i>
						 </button>
					  </div>
				   </div>
				</div>
			 </div>
			 <div class="col-lg-4">
				<div class="popup-right-content">
				   <div class="brand_logo_details mb-3">
					  <a href="'.base_url('brandprofile/'.str_replace(' ', '_', $brand_name['bname'])).'">
					  <img src="'.base_url().'uploads/brand/'.$brand_name['images'].'" class="img-thumbnail"></a>
				   </div>
				   <h3>'.$brand_name['bname'].'</h3>
				   <p class="text"> '.$pro['product_name'].'
				   </p>
				   <div class="price">
					  <p>'.substr($pro['description'], 0, 50).'</p>
				   </div>
				   <div class="mt-3 metalic">
					  <p><b>Collection :  </b>'.$pro['collection'].'</p>
					
					  <p><b>Finish :  </b>';
						  $finish=explode(",", $pro['finish']);
							foreach ($finish as $key => $fi) {
							   $fini = $this->db->get_where('finish',array('id' => $fi))->row_array();
							
							 $fini['finish']."," ;  } 	
							
					  $html .='</p>
					  <p><b>Use :  </b>'.$pro['indoor_outdoor'].' </p>
				   </div>
				</div>
			 </div>
		  </div>
	   </div>';
		}
		}
		else{
		$html .=' <h3 style="color:red;text-align:center;">No Record Found</h3>';
		}
		$data['html'] = $html;
        echo json_encode($data);
	}
	public function bowl_data(){
		header("Content-type:application/json");
		$id = $this->input->post('i_id');
		$s_id = $this->input->post('s_id');
		
	    $s=$this->db->get_where('subcategories',array('sname' => $s_id))->row_array();
		$c_id = $s['id'];
	    $subcategories = $this->db->query("SELECT * FROM product WHERE FIND_IN_SET(".$id.",`bowl`) AND sname = '$c_id'")->result_array();
	    
	    
		$html ="";
		if($subcategories) {
		foreach($subcategories as $pro) {
		

			 $user_id = $this->session->userdata('user_id');
			 $get_wishlist = $this->db->get_where('wishlist',array('user_id' =>$user_id,'product_id'=>$pro['id']))->num_rows();
			 if($get_wishlist == 0) {
			 if(!empty($user_id)) { $link = base_url('add-wishlist/').$pro['id'].'/'.$this->uri->segment(2);  } else { $link = base_url('login'); } 
			 
		  $btn ='<a href="'.$link .' " style="width:100%;"> <span class="product_icon" style="width:100%;"><img src="'.base_url().'assets/img/Union.png" style="width:20%;display:inline-block;"> <span style="display: inline-block;">'.$count = $this->db->get_where('wishlist',array('product_id' =>$pro['id'] ))->num_rows().'</span></span></a>';
		  } else{ 
		  $btn ='<a href="'.base_url('remove-wishlist/').$pro['id'].'/'.$this->uri->segment(2).'" style="width:100%;"> <span class="product_icon" style="width:100%;"><img src="'.base_url().'assets/img/unwishlist.png" style="width:20%;display:inline-block;"> <span style="display: inline-block;">'.$count = $this->db->get_where('wishlist',array('product_id' =>$pro['id'] ))->num_rows().'</span></span></a>';
		   } 			
		$html .='<div class="col-xl-4 col-lg-6 col-md-6 mb-3">
		  <div class="produc_list_page product_hover">
			 <a href="#popup7'.$pro['id'].'" class="popup_link"><img class="hover_view  flaticon-visibility" src="'. base_url().'assets/img/Group313.png"></a>
			 <a class="product_link" href="'.base_url('brand-profile/'.str_replace(' ', '_', $pro['product_name'])).'">';
			 
			 $images=explode(",", $pro['product_image']);
			$html .=' <img class="p_main" src="'.base_url().'/uploads/product/'.$images[0].'">
			 </a>
			 <div class="product_text   mt-2 mb-2 __web-inspector-hide-shortcut__">';
				$brand_name = $this->db->get_where('brand',array('id' => $pro['brand']))->row_array();
				
				$html .='<div class="row">
				   <div class="col-md-7">
					  <h4>'.$brand_name['bname'].'</h4>
					  <p class="product_space">'.$pro['product_name'].'</p>
				   </div>
				   <div class="col-md-5">
					  '.$btn.' 
				   </div>
				</div>
			 </div>
		  </div>
	   </div>
	   <div id="popup7'.$pro['id'].'" class="product-gird__quick-view-popup mfp-hide">
		  <div class="row justify-content-between align-items-center">
			 <div class="col-lg-8">
				<div class="quick-view__left-content">
				   <div class="tabs">
					  <div class="popup-product-thumb-box tabsa">
						 <ul>';
							$imagesa=explode(",", $pro['product_image']);
							   $no = 0;
							   foreach ($imagesa as $key => $value) {
							   $no = $no + 1;	
							  
							$html .='<li class="tab-nav popup-product-thumb"> <a
							   href="#tab'.$no.'"> <img
							   src="'.base_url().'/uploads/product/'.$value.'"
							   alt="" /> </a> </li>';
							}
						$html .='
						 </ul>
					  </div>
					  <div class="popup-product-main-image-box">';
						 $imagesa=explode(",", $pro['product_image']);
							$no = 0;
							foreach ($imagesa as $key => $value) {
							$no = $no + 1;
							
						 $html .='<div id="tab'.$no.'"
							class="tab-item popup-product-image">
							<div class="popup-product-single-image"> <img
							   src="'.base_url().'/uploads/product/'.$value.'"
							   alt="" /> </div>
						 </div>';
						 } 	
						 $html .='<button class="prev"> <i
							class="flaticon-back"></i> </button> <button
							class="next"> <i class="flaticon-next"></i>
						 </button>
					  </div>
				   </div>
				</div>
			 </div>
			 <div class="col-lg-4">
				<div class="popup-right-content">
				   <div class="brand_logo_details mb-3">
					  <a href="'.base_url('brandprofile/'.str_replace(' ', '_', $brand_name['bname'])).'">
					  <img src="'.base_url().'uploads/brand/'.$brand_name['images'].'" class="img-thumbnail"></a>
				   </div>
				   <h3>'.$brand_name['bname'].'</h3>
				   <p class="text"> '.$pro['product_name'].'
				   </p>
				   <div class="price">
					  <p>'.substr($pro['description'], 0, 50).'</p>
				   </div>
				   <div class="mt-3 metalic">
					  <p><b>Collection :  </b>'.$pro['collection'].'</p>
					
					  <p><b>Finish :  </b>';
						  $finish=explode(",", $pro['finish']);
							foreach ($finish as $key => $fi) {
							   $fini = $this->db->get_where('finish',array('id' => $fi))->row_array();
							
							 $fini['finish']."," ;  } 	
							
					  $html .='</p>
					  <p><b>Use :  </b>'.$pro['indoor_outdoor'].' </p>
				   </div>
				</div>
			 </div>
		  </div>
	   </div>';
		}
		}
		else{
		$html .=' <h3 style="color:red;text-align:center;">No Record Found</h3>';
		}
		$data['html'] = $html;
        echo json_encode($data);
	}
	public function color_data(){
		header("Content-type:application/json");
		$id = $this->input->post('i_id');
		$s_id = $this->input->post('s_id');
		
	    $s=$this->db->get_where('subcategories',array('sname' => $s_id))->row_array();
		$c_id = $s['id'];
	    $subcategories = $this->db->query("SELECT * FROM product WHERE FIND_IN_SET(".$id.",`color`) AND sname = '$c_id'")->result_array();
	    
	    
		$html ="";
		if($subcategories) {
		foreach($subcategories as $pro) {
		

			 $user_id = $this->session->userdata('user_id');
			 $get_wishlist = $this->db->get_where('wishlist',array('user_id' =>$user_id,'product_id'=>$pro['id']))->num_rows();
			 if($get_wishlist == 0) {
			 if(!empty($user_id)) { $link = base_url('add-wishlist/').$pro['id'].'/'.$this->uri->segment(2);  } else { $link = base_url('login'); } 
			 
		  $btn ='<a href="'.$link .' " style="width:100%;"> <span class="product_icon" style="width:100%;"><img src="'.base_url().'assets/img/Union.png" style="width:20%;display:inline-block;"> <span style="display: inline-block;">'.$count = $this->db->get_where('wishlist',array('product_id' =>$pro['id'] ))->num_rows().'</span></span></a>';
		  } else{ 
		  $btn ='<a href="'.base_url('remove-wishlist/').$pro['id'].'/'.$this->uri->segment(2).'" style="width:100%;"> <span class="product_icon" style="width:100%;"><img src="'.base_url().'assets/img/unwishlist.png" style="width:20%;display:inline-block;"> <span style="display: inline-block;">'.$count = $this->db->get_where('wishlist',array('product_id' =>$pro['id'] ))->num_rows().'</span></span></a>';
		   } 			
		$html .='<div class="col-xl-4 col-lg-6 col-md-6 mb-3">
		  <div class="produc_list_page product_hover">
			 <a href="#popup7'.$pro['id'].'" class="popup_link"><img class="hover_view  flaticon-visibility" src="'. base_url().'assets/img/Group313.png"></a>
			 <a class="product_link" href="'.base_url('brand-profile/'.str_replace(' ', '_', $pro['product_name'])).'">';
			 
			 $images=explode(",", $pro['product_image']);
			$html .=' <img class="p_main" src="'.base_url().'/uploads/product/'.$images[0].'">
			 </a>
			 <div class="product_text   mt-2 mb-2 __web-inspector-hide-shortcut__">';
				$brand_name = $this->db->get_where('brand',array('id' => $pro['brand']))->row_array();
				
				$html .='<div class="row">
				   <div class="col-md-7">
					  <h4>'.$brand_name['bname'].'</h4>
					  <p class="product_space">'.$pro['product_name'].'</p>
				   </div>
				   <div class="col-md-5">
					  '.$btn.' 
				   </div>
				</div>
			 </div>
		  </div>
	   </div>
	   <div id="popup7'.$pro['id'].'" class="product-gird__quick-view-popup mfp-hide">
		  <div class="row justify-content-between align-items-center">
			 <div class="col-lg-8">
				<div class="quick-view__left-content">
				   <div class="tabs">
					  <div class="popup-product-thumb-box tabsa">
						 <ul>';
							$imagesa=explode(",", $pro['product_image']);
							   $no = 0;
							   foreach ($imagesa as $key => $value) {
							   $no = $no + 1;	
							  
							$html .='<li class="tab-nav popup-product-thumb"> <a
							   href="#tab'.$no.'"> <img
							   src="'.base_url().'/uploads/product/'.$value.'"
							   alt="" /> </a> </li>';
							}
						$html .='
						 </ul>
					  </div>
					  <div class="popup-product-main-image-box">';
						 $imagesa=explode(",", $pro['product_image']);
							$no = 0;
							foreach ($imagesa as $key => $value) {
							$no = $no + 1;
							
						 $html .='<div id="tab'.$no.'"
							class="tab-item popup-product-image">
							<div class="popup-product-single-image"> <img
							   src="'.base_url().'/uploads/product/'.$value.'"
							   alt="" /> </div>
						 </div>';
						 } 	
						 $html .='<button class="prev"> <i
							class="flaticon-back"></i> </button> <button
							class="next"> <i class="flaticon-next"></i>
						 </button>
					  </div>
				   </div>
				</div>
			 </div>
			 <div class="col-lg-4">
				<div class="popup-right-content">
				   <div class="brand_logo_details mb-3">
					  <a href="'.base_url('brandprofile/'.str_replace(' ', '_', $brand_name['bname'])).'">
					  <img src="'.base_url().'uploads/brand/'.$brand_name['images'].'" class="img-thumbnail"></a>
				   </div>
				   <h3>'.$brand_name['bname'].'</h3>
				   <p class="text"> '.$pro['product_name'].'
				   </p>
				   <div class="price">
					  <p>'.substr($pro['description'], 0, 50).'</p>
				   </div>
				   <div class="mt-3 metalic">
					  <p><b>Collection :  </b>'.$pro['collection'].'</p>
					
					  <p><b>Finish :  </b>';
						  $finish=explode(",", $pro['finish']);
							foreach ($finish as $key => $fi) {
							   $fini = $this->db->get_where('finish',array('id' => $fi))->row_array();
							
							 $fini['finish']."," ;  } 	
							
					  $html .='</p>
					  <p><b>Use :  </b>'.$pro['indoor_outdoor'].' </p>
				   </div>
				</div>
			 </div>
		  </div>
	   </div>';
		}
		}
		else{
		$html .=' <h3 style="color:red;text-align:center;">No Record Found</h3>';
		}
		$data['html'] = $html;
        echo json_encode($data);
	}
	public function city_data_filter (){
		
		header("Content-type:application/json");
		$id = $this->input->post('i_id');
	    
	    $subcategories = $this->db->get_where('resellers',array('city'=>$id))->result_array();
		$html ="";
		if($subcategories) {
		foreach($subcategories as $re) {
			
			
		$html .='	<div class="card-sec mb-3">
                     <div class="row">
                        <div class="col-md-6">
                           <div class="review-single pt-0 hed">
                              <div class="ratting">
                                 <span class="ananta">'. $re['name'].'</span> ';
								 $city = $this->db->get_where('city',array('id' => $re['city']))->row_array();
           $html .='            <p class="text-ananta"> '.$city['city'].'</p>
                              </div>
                           </div>
                        </div>
                        <div class="col-md-6 text-rightsec">';
                          $user_id = $this->session->userdata('user_id');
                              $check = $this->db->get_where('get_number',array('user_id' => $user_id,'resellers_id' => $re['id'],'date' => date('Y-m-d')))->num_rows();
                              if($check == 0){
                              if($user_id == "") {
                              
                          $html .='  <a href="'.base_url('login').'" class="call-back mb-2" >GET NUMBER</a>';
                            } else { 
                         $html .='  <a href="'. base_url('get-number-re/'.$re['id'].'/'.$this->uri->segment(2)).'" class="call-back mb-2" >GET NUMBER</a>';
                           } } else { 
                          $html .='   <i class="fas fa-phone-alt"></i> &nbsp;<span>'. $re['contact'].'</span>';
                            } 
                        $html .='   <p>OR</p>
                        </div>
                        <div class="col-md-8 mt-2">
                           <p class="address-text">'. $re['address'].'</p>
                        </div>
                        <div class="col-md-4 text-rightsec mt-2">
                           <a href="#popup56" class="call-back popup_link">REQUEST A CALL BACK</a>
                        </div>
                     </div>
                  </div>';
		
		
	}
	}
	else{
		$html .=' <h3 style="color:red;text-align:center;">No Record Found</h3>';
	}
	$data['html'] = $html;
    echo json_encode($data);
	}
	public function add_product_wishlist(){
			$id = $this->uri->segment(2); 
			$uri_id = $this->uri->segment(3); 
			
			$user_id = $this->session->userdata('user_id');
			$folder = $this->db->get_where('folder',array('user_id' =>$user_id,'status' =>1))->row_array();
			$data = array(
			
		    	'user_id' => $user_id,
				'product_id' => $id,
				'date' => date('Y-m-d'),	
				'folder' =>$folder['id'],
			);
			$this->db->insert('wishlist', $data);
			
			$product = $this->db->get_where('product',array('id' =>$id))->row_array();
			$dataa = array(
			
		    	'wcount' => $product['wcount'] + 1,
			
			);
			$this->db->where('id', $id);
			$this->db->update('product', $dataa);
			
			redirect(base_url('brand-profile/'.$uri_id));
			
		}
		public function remove_product_wishlist() {
			$id = $this->uri->segment(2); 
			$uri_id = $this->uri->segment(3); 
			
			$user_id = $this->session->userdata('user_id');
			$remove = $this->db->get_where('wishlist',array('product_id' =>$id,'user_id' =>$user_id))->row_array();
			$remove_id = $remove['id'];
			$this->db->where('id', $remove_id);
			$this->db->delete('wishlist');
			$product = $this->db->get_where('product',array('id' =>$id))->row_array();
			$dataa = array(
			
		    	'wcount' => $product['wcount'] - 1,
			
			);
			$this->db->where('id', $id);
			$this->db->update('product', $dataa);
			redirect(base_url('brand-profile/'.$uri_id));
		}
		public function brand_request(){
		
			$uri = $this->input->post('uri');
			
			$u_id = $this->input->post('user_id');
			
			if(empty($u_id)){
			
			  $u_id = 0;		
				
			}
			
			
			$data =  array(
				'user_id' => $u_id,
				'brand_id' => $this->input->post('brand_id'),
				'product_id' => $this->input->post('product_id'), 
				'f_name' => $this->input->post('f_name'),
				'l_name' => $this->input->post('l_name'),
				'email' => $this->input->post('email'),
				'proffasion' => $this->input->post('proffasion'),
				'compny' => $this->input->post('compny'),
				'city' => $this->input->post('city'),
				'postcode' => $this->input->post('postcode'),
				'address' => $this->input->post('address'),
				'm_no' => $this->input->post('m_no'),
				'message' => $this->input->post('message'),
				'date' => date('Y-m-d')
			);
			$ins = $this->db->insert('brand_request',$data);
			if($ins){
			$this->session->set_flashdata('success','Request for information Sent Successfull....!');
			
			redirect(base_url('brand-profile/'.$uri));
			}else{
				
			$this->session->set_flashdata('error','Data Error ....!');
			redirect(base_url('brand-profile/'.$uri));
			}
			
			
		}
		public function door_data(){
		header("Content-type:application/json");
		$id = $this->input->post('i_id');
		
		
	    
	    $subcategories = $this->db->get_where('product',array('indoor_outdoor' => $id))->result_array();
	    
	    
		$html ="";
		if($subcategories) {
		foreach($subcategories as $pro) {
		

			 $user_id = $this->session->userdata('user_id');
			 $get_wishlist = $this->db->get_where('wishlist',array('user_id' =>$user_id,'product_id'=>$pro['id']))->num_rows();
			 if($get_wishlist == 0) {
			 if(!empty($user_id)) { $link = base_url('add-wishlist/').$pro['id'].'/'.$this->uri->segment(2);  } else { $link = base_url('login'); } 
			 
		  $btn ='<a href="'.$link .' " style="width:100%;"> <span class="product_icon" style="width:100%;"><img src="'.base_url().'assets/img/Union.png" style="width:20%;display:inline-block;"> <span style="display: inline-block;">'.$count = $this->db->get_where('wishlist',array('product_id' =>$pro['id'] ))->num_rows().'</span></span></a>';
		  } else{ 
		  $btn ='<a href="'.base_url('remove-wishlist/').$pro['id'].'/'.$this->uri->segment(2).'" style="width:100%;"> <span class="product_icon" style="width:100%;"><img src="'.base_url().'assets/img/unwishlist.png" style="width:20%;display:inline-block;"> <span style="display: inline-block;">'.$count = $this->db->get_where('wishlist',array('product_id' =>$pro['id'] ))->num_rows().'</span></span></a>';
		   } 			
		$html .='<div class="col-xl-4 col-lg-6 col-md-6 mb-3">
		  <div class="produc_list_page product_hover">
			 <a href="#popup7'.$pro['id'].'" class="popup_link"><img class="hover_view  flaticon-visibility" src="'. base_url().'assets/img/Group313.png"></a>
			 <a class="product_link" href="'.base_url('brand-profile/'.str_replace(' ', '_', $pro['product_name'])).'">';
			 
			 $images=explode(",", $pro['product_image']);
			$html .=' <img class="p_main" src="'.base_url().'/uploads/product/'.$images[0].'">
			 </a>
			 <div class="product_text   mt-2 mb-2 __web-inspector-hide-shortcut__">';
				$brand_name = $this->db->get_where('brand',array('id' => $pro['brand']))->row_array();
				
				$html .='<div class="row">
				   <div class="col-md-7">
					  <h4>'.$brand_name['bname'].'</h4>
					  <p class="product_space">'.$pro['product_name'].'</p>
				   </div>
				   <div class="col-md-5">
					  '.$btn.' 
				   </div>
				</div>
			 </div>
		  </div>
	   </div>
	   <div id="popup7'.$pro['id'].'" class="product-gird__quick-view-popup mfp-hide">
		  <div class="row justify-content-between align-items-center">
			 <div class="col-lg-8">
				<div class="quick-view__left-content">
				   <div class="tabs">
					  <div class="popup-product-thumb-box tabsa">
						 <ul>';
							$imagesa=explode(",", $pro['product_image']);
							   $no = 0;
							   foreach ($imagesa as $key => $value) {
							   $no = $no + 1;	
							  
							$html .='<li class="tab-nav popup-product-thumb"> <a
							   href="#tab'.$no.'"> <img
							   src="'.base_url().'/uploads/product/'.$value.'"
							   alt="" /> </a> </li>';
							}
						$html .='
						 </ul>
					  </div>
					  <div class="popup-product-main-image-box">';
						 $imagesa=explode(",", $pro['product_image']);
							$no = 0;
							foreach ($imagesa as $key => $value) {
							$no = $no + 1;
							
						 $html .='<div id="tab'.$no.'"
							class="tab-item popup-product-image">
							<div class="popup-product-single-image"> <img
							   src="'.base_url().'/uploads/product/'.$value.'"
							   alt="" /> </div>
						 </div>';
						 } 	
						 $html .='<button class="prev"> <i
							class="flaticon-back"></i> </button> <button
							class="next"> <i class="flaticon-next"></i>
						 </button>
					  </div>
				   </div>
				</div>
			 </div>
			 <div class="col-lg-4">
				<div class="popup-right-content">
				   <div class="brand_logo_details mb-3">
					  <a href="'.base_url('brandprofile/'.str_replace(' ', '_', $brand_name['bname'])).'">
					  <img src="'.base_url().'uploads/brand/'.$brand_name['images'].'" class="img-thumbnail"></a>
				   </div>
				   <h3>'.$brand_name['bname'].'</h3>
				   <p class="text"> '.$pro['product_name'].'
				   </p>
				   <div class="price">
					  <p>'.substr($pro['description'], 0, 50).'</p>
				   </div>
				   <div class="mt-3 metalic">
					  <p><b>Collection :  </b>'.$pro['collection'].'</p>
					
					  <p><b>Finish :  </b>';
						  $finish=explode(",", $pro['finish']);
							foreach ($finish as $key => $fi) {
							   $fini = $this->db->get_where('finish',array('id' => $fi))->row_array();
							
							 $fini['finish']."," ;  } 	
							
					  $html .='</p>
					  <p><b>Use :  </b>'.$pro['indoor_outdoor'].' </p>
				   </div>
				</div>
			 </div>
		  </div>
	   </div>';
		}
		}
		else{
		$html .=' <h3 style="color:red;text-align:center;">No Record Found</h3>';
		}
		$data['html'] = $html;
        echo json_encode($data);
	}
	
	public function sensor_data(){
		header("Content-type:application/json");
		$id = $this->input->post('i_id');
		
		
	    
	    $subcategories = $this->db->get_where('product',array('sensor' => $id))->result_array();
	    
	    
		$html ="";
		if($subcategories) {
		foreach($subcategories as $pro) {
		

			 $user_id = $this->session->userdata('user_id');
			 $get_wishlist = $this->db->get_where('wishlist',array('user_id' =>$user_id,'product_id'=>$pro['id']))->num_rows();
			 if($get_wishlist == 0) {
			 if(!empty($user_id)) { $link = base_url('add-wishlist/').$pro['id'].'/'.$this->uri->segment(2);  } else { $link = base_url('login'); } 
			 
		  $btn ='<a href="'.$link .' " style="width:100%;"> <span class="product_icon" style="width:100%;"><img src="'.base_url().'assets/img/Union.png" style="width:20%;display:inline-block;"> <span style="display: inline-block;">'.$count = $this->db->get_where('wishlist',array('product_id' =>$pro['id'] ))->num_rows().'</span></span></a>';
		  } else{ 
		  $btn ='<a href="'.base_url('remove-wishlist/').$pro['id'].'/'.$this->uri->segment(2).'" style="width:100%;"> <span class="product_icon" style="width:100%;"><img src="'.base_url().'assets/img/unwishlist.png" style="width:20%;display:inline-block;"> <span style="display: inline-block;">'.$count = $this->db->get_where('wishlist',array('product_id' =>$pro['id'] ))->num_rows().'</span></span></a>';
		   } 			
		$html .='<div class="col-xl-4 col-lg-6 col-md-6 mb-3">
		  <div class="produc_list_page product_hover">
			 <a href="#popup7'.$pro['id'].'" class="popup_link"><img class="hover_view  flaticon-visibility" src="'. base_url().'assets/img/Group313.png"></a>
			 <a class="product_link" href="'.base_url('brand-profile/'.str_replace(' ', '_', $pro['product_name'])).'">';
			 
			 $images=explode(",", $pro['product_image']);
			$html .=' <img class="p_main" src="'.base_url().'/uploads/product/'.$images[0].'">
			 </a>
			 <div class="product_text   mt-2 mb-2 __web-inspector-hide-shortcut__">';
				$brand_name = $this->db->get_where('brand',array('id' => $pro['brand']))->row_array();
				
				$html .='<div class="row">
				   <div class="col-md-7">
					  <h4>'.$brand_name['bname'].'</h4>
					  <p class="product_space">'.$pro['product_name'].'</p>
				   </div>
				   <div class="col-md-5">
					  '.$btn.' 
				   </div>
				</div>
			 </div>
		  </div>
	   </div>
	   <div id="popup7'.$pro['id'].'" class="product-gird__quick-view-popup mfp-hide">
		  <div class="row justify-content-between align-items-center">
			 <div class="col-lg-8">
				<div class="quick-view__left-content">
				   <div class="tabs">
					  <div class="popup-product-thumb-box tabsa">
						 <ul>';
							$imagesa=explode(",", $pro['product_image']);
							   $no = 0;
							   foreach ($imagesa as $key => $value) {
							   $no = $no + 1;	
							  
							$html .='<li class="tab-nav popup-product-thumb"> <a
							   href="#tab'.$no.'"> <img
							   src="'.base_url().'/uploads/product/'.$value.'"
							   alt="" /> </a> </li>';
							}
						$html .='
						 </ul>
					  </div>
					  <div class="popup-product-main-image-box">';
						 $imagesa=explode(",", $pro['product_image']);
							$no = 0;
							foreach ($imagesa as $key => $value) {
							$no = $no + 1;
							
						 $html .='<div id="tab'.$no.'"
							class="tab-item popup-product-image">
							<div class="popup-product-single-image"> <img
							   src="'.base_url().'/uploads/product/'.$value.'"
							   alt="" /> </div>
						 </div>';
						 } 	
						 $html .='<button class="prev"> <i
							class="flaticon-back"></i> </button> <button
							class="next"> <i class="flaticon-next"></i>
						 </button>
					  </div>
				   </div>
				</div>
			 </div>
			 <div class="col-lg-4">
				<div class="popup-right-content">
				   <div class="brand_logo_details mb-3">
					  <a href="'.base_url('brandprofile/'.str_replace(' ', '_', $brand_name['bname'])).'">
					  <img src="'.base_url().'uploads/brand/'.$brand_name['images'].'" class="img-thumbnail"></a>
				   </div>
				   <h3>'.$brand_name['bname'].'</h3>
				   <p class="text"> '.$pro['product_name'].'
				   </p>
				   <div class="price">
					  <p>'.substr($pro['description'], 0, 50).'</p>
				   </div>
				   <div class="mt-3 metalic">
					  <p><b>Collection :  </b>'.$pro['collection'].'</p>
					
					  <p><b>Finish :  </b>';
						  $finish=explode(",", $pro['finish']);
							foreach ($finish as $key => $fi) {
							   $fini = $this->db->get_where('finish',array('id' => $fi))->row_array();
							
							 $fini['finish']."," ;  } 	
							
					  $html .='</p>
					  <p><b>Use :  </b>'.$pro['indoor_outdoor'].' </p>
				   </div>
				</div>
			 </div>
		  </div>
	   </div>';
		}
		}
		else{
		$html .=' <h3 style="color:red;text-align:center;">No Record Found</h3>';
		}
		$data['html'] = $html;
        echo json_encode($data);
	}

}
