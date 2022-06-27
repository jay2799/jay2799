<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {
	
	
	public function __construct(){
		
		parent::__construct();
		$this->load->helper('url_helper');
		$this->load->helper('url');
		$this->load->model('Admin_model');
		$this->load->library('session');
		// Load file helper
        $this->load->helper('file');
		
            
	}

	public function login(){
		
		$this->load->view('Admin/login');
		
	}
	public function login_admin(){
	  
	  $login=array(

	  'email'=>$this->input->post('email'),
	  'password'=>md5($this->input->post('password'))

		);

		$data=$this->Admin_model->login_admin($login['email'],$login['password']);
		  if($data)
		  {
			$this->session->set_userdata('aid',$data['id']);
			$this->session->set_userdata('aemail',$data['email']);
			$this->session->set_userdata('aname',$data['name']);
			
			
			redirect(base_url('admin/index'));
		  }
		  else
		  {
			$this->session->set_flashdata('error_msg', 'Email Id And Password Wrong..');
		   redirect(base_url('admin/login'));

		  }


	}
	public function index(){
		if($this->session->userdata('aid')=="")
		{
			redirect(base_url('admin/login'));
		}
		$this->load->view('Admin/header');
		$this->load->view('Admin/index');
		$this->load->view('Admin/footer');
		
	}
	public function admin_profile() {
		if($this->session->userdata('aid')=="")
		{
			redirect(base_url('admin/login'));
		}

		$id = $this->session->userdata('aid');
				
		if (empty($id))
		{
			show_404();
		}

		$this->load->helper('form');
		$this->load->library('form_validation');

		$data['users'] = $this->Admin_model->get_admin_by_id($id); 

		$this->form_validation->set_rules('name', 'Name', 'required');
		$this->form_validation->set_rules('email', 'Email', 'required');

		if ($this->form_validation->run() === FALSE)
		{
			$this->load->view("Admin/header");
			$this->load->view("Admin/pages/forms/profile",$data);
			$this->load->view("Admin/footer");

		}
		else
		{
		
		$user=array(


			'name'=>$this->input->post('name'),

			'email'=>$this->input->post('email'),
			
			
			'mobile'=>$this->input->post('mobile'),
			
			'date' => date('Y-m-d'),

			'id'=>$id

		);


			$profile_pic = "";

			if(isset($_FILES['profile_pic']['name']) && $_FILES['profile_pic']['name'] !="") {

				$image_exts = array("tif", "jpg", "gif", "png","jpeg");

				//Get Extension of file

				$path_parts = pathinfo($_FILES["profile_pic"]["name"]);

				$ext = $path_parts['extension'];



				if(in_array($ext, $image_exts)) {



					$config['upload_path'] = './uploads/admin';

					$config['allowed_types'] = 'gif|jpg|png|jpeg';

					$config['file_name'] = uniqid();

					$config['overwrite'] = TRUE;

					$config['max_size'] = '5000';

					$config['max_width'] = '4000';

					$config['max_height'] = '4000';

		

					//Load Upload Library

					$this->load->library('upload', $config);



					if (!$this->upload->do_upload('profile_pic')) {

						$error = array('error' => $this->upload->display_errors('<div class="alert alert-danger">', '</div>'));
						
						$this->session->set_flashdata('error_msg','Invalid Image');

					}

					else {



						$upload_data = $this->upload->data();

						$profile_pic = $upload_data['file_name'];

					

					}


					
					



				} else {

					$this->session->set_flashdata('error_msg','Invalid Image Extension');

				}

			}

			if($profile_pic != "") {
				$user['images'] = $profile_pic;
			}


			// Make Database Post

			$reg=$this->Admin_model->update_admin($user,$user['id']);
			
			$this->session->set_flashdata('success_msg','Successfully Update');
			
			redirect(base_url('admin/admin_profile'));
		}
	}
	public function change_password(){

		if($this->session->userdata('aid')=="")
			{
				redirect(base_url('admin/login'));
			}

			$id = $this->session->userdata('aid');
					
			if (empty($id))
			{
				show_404();
			}

			$this->load->helper('form');
			$this->load->library('form_validation');

			$data['users'] = $this->Admin_model->get_admin_by_id($id); 

			$this->form_validation->set_rules('password', 'password', 'required');
			$this->form_validation->set_rules('npassword', 'npassword', 'required');
			$this->form_validation->set_rules('cpassword', 'cpassword', 'required');

			if ($this->form_validation->run() === FALSE)
			{
				$this->load->view("Admin/header");
				$this->load->view("Admin/pages/forms/change_password",$data);
				$this->load->view("Admin/footer");

			}
			else
			{

				$password=md5($this->input->post('password'));

				$npassword=md5($this->input->post('npassword'));

				$cpassword=md5($this->input->post('cpassword'));



				if($npassword==$cpassword)

				{

					$password_check=$this->Admin_model->password_check_admin($password,$id);



					if($password_check){

					  $this->Admin_model->change_pass_admin($npassword,$id);

					  $this->session->set_flashdata('success_msg','successfully Changed');
					  redirect(base_url('admin/change_password'));

					}

					else
					{

						$this->session->set_flashdata('error_msg','Wrong Old password');
					   redirect(base_url('admin/change_password'));

					}

				}

				else{

				  $this->session->set_flashdata('error_msg','New Password And Confirm Password Not Match..');
				  redirect(base_url('admin/change_password'));

				}



			}
	}
	public function logout(){

	  $this->session->sess_destroy();
	  redirect(base_url().'admin/login', 'refresh');
	}
	public function create_subadmin() {
		if($this->session->userdata('aid')=="")
		{
			redirect(base_url('admin/login'));
		}

		$this->load->helper('form');
		$this->load->library('form_validation');

		$this->form_validation->set_rules('name', 'name', 'required');
		

		if ($this->form_validation->run() === FALSE)
		{
			$this->load->view("Admin/header");
			$this->load->view("Admin/pages/forms/add_subadmin");
			$this->load->view("Admin/footer");

		}
		else
		{

			$imagse = "";
			$image_exts = array("tif", "jpg", "gif", "png");

			//Get Extension of file
			if($_FILES['images']['name']) {
				$path_parts = pathinfo($_FILES["images"]["name"]);
				$ext = $path_parts['extension'];
				if(in_array($ext, $image_exts)) {

					$config['upload_path'] = './uploads/admin/';
					$config['allowed_types'] = 'gif|jpg|png|jpeg';
					$config['file_name'] = uniqid();
					$config['overwrite'] = TRUE;
					$config['max_size'] = '50000';
					$config['max_width'] = '40000';
					$config['max_height'] = '40000';   

					//Load Upload Library
					$this->load->library('upload', $config);
					if (!$this->upload->do_upload('images')) {
						$error = array('error' => $this->upload->display_errors('<div class="alert alert-danger">', '</div>'));
						$this->session->set_flashdata('error_msg',$error['error']);
						
					}
					else {

						$upload_data = $this->upload->data();
						$imagse = $upload_data['file_name'];
					}
				} else {
					$this->session->set_flashdata('error_msg','Invalid Image Extension');

				}
			}

			// Make DB Query
			$data = array();

			$data['name'] = $this->input->post('name');
			$data['email'] = $this->input->post('email');
			$data['password'] = md5($this->input->post('password'));
			$data['mobile'] = $this->input->post('mobile');
			$data['role'] = 0;
			$data['date'] = date('Y-m-d');
			$data['images'] = $imagse;

			if($this->db->insert('admin', $data)) {
				$this->session->set_flashdata('success_msg','Successfully Inserted');
				redirect(base_url('admin/create_subadmin'));
			} else {
				$this->session->set_flashdata('error_msg','Database Error');
				redirect(base_url('admin/create_subadmin'));
			}
		}
	}
	public function sub_admin(){
		if($this->session->userdata('aid')=="")
		{
			redirect(base_url('admin/login'));
		}
		$data['sub_admin'] = $this->db->get_where('admin',array('role' =>0))->result_array();
		$this->load->view('Admin/header');
		$this->load->view('Admin/pages/tables/subadmin_list',$data);
		$this->load->view('Admin/footer');
		
	}
	public function delete_subadmin($id) {
		

		$this->db->where('id', $id);
		if($this->db->delete('admin'))
		{
			$this->session->set_flashdata('success_msg','Successfully Deleted');
			redirect(base_url('admin/sub_admin'));
		} 
		else
		{
			$this->session->set_flashdata('error_msg','Database Error');
			redirect(base_url('admin/sub_admin'));
		}
	}
	public function edit_subadmin($id){
		
           $this->load->helper('form');
           $this->load->library('form_validation');
    

			  $query = $this->db->get_where('admin', array('id' => $id))->row_array();
			
			  $this->form_validation->set_rules('name', 'Name', 'required');
	 
			  if ($this->form_validation->run() === FALSE)
			  {
			  $data['admin'] = $this->db->get_where('admin',array('id' => $id))->row();
			  
			  
			  $this->load->view("Admin/header");
			  $this->load->view("Admin/pages/forms/edit_subadmin",$data);
			  $this->load->view("Admin/footer");
			 
	 
			  }
			  else
			  {
			   $imagename =$query['images'];
			   if($_FILES['images']['name'] != "")
			  {
                  $config['upload_path']          = './uploads/admin';
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
					'email' => $this->input->post('email'),
					'mobile' => $this->input->post('mobile'), 
					'password' => md5($this->input->post('password'))
					
				 );
           

            $this->db->where('id',$id);
            $this->db->update('admin', $data);
			$this->session->set_flashdata('success_msg','Successfully Update Details');
            redirect(base_url('admin/sub_admin'));

           }
     }
	 public function create_brand() {
		if($this->session->userdata('aid')=="")
		{
			redirect(base_url('admin/login'));
		}

		$this->load->helper('form');
		$this->load->library('form_validation');

		$this->form_validation->set_rules('bname', 'bname', 'required');
		
		

		if ($this->form_validation->run() === FALSE)
		{
			$this->load->view("Admin/header");
			$this->load->view("Admin/pages/forms/add_brand");
			$this->load->view("Admin/footer");

		}
		else
		{

			$imagse = "";
			$image_exts = array("tif", "jpg", "gif", "png");

			//Get Extension of file
			if($_FILES['images']['name']) {
				$path_parts = pathinfo($_FILES["images"]["name"]);
				$ext = $path_parts['extension'];
				if(in_array($ext, $image_exts)) {

					$config['upload_path'] = './uploads/brand/';
					$config['allowed_types'] = 'gif|jpg|png|jpeg';
					$config['file_name'] = uniqid();
					$config['overwrite'] = TRUE;
					$config['max_size'] = '50000';
					$config['max_width'] = '40000';
					$config['max_height'] = '40000';   

					//Load Upload Library
					$this->load->library('upload', $config);
					if (!$this->upload->do_upload('images')) {
						$error = array('error' => $this->upload->display_errors('<div class="alert alert-danger">', '</div>'));
						$this->session->set_flashdata('error_msg',$error['error']);
						
					}
					else {

						$upload_data = $this->upload->data();
						$imagse = $upload_data['file_name'];
					}
				} else {
					$this->session->set_flashdata('error_msg','Invalid Image Extension');

				}
			}
			
			
			$cover_image = "";
			$image_exts = array("tif", "jpg", "gif", "png");

			//Get Extension of file
			if($_FILES['cover_image']['name']) {
				$path_parts = pathinfo($_FILES["cover_image"]["name"]);
				$ext = $path_parts['extension'];
				if(in_array($ext, $image_exts)) {

					$config['upload_path'] = './uploads/brand/';
					$config['allowed_types'] = 'gif|jpg|png|jpeg';
					$config['file_name'] = uniqid();
					$config['overwrite'] = TRUE;
					$config['max_size'] = '50000';
					$config['max_width'] = '40000';
					$config['max_height'] = '40000';   

					//Load Upload Library
					$this->load->library('upload', $config);
					if (!$this->upload->do_upload('cover_image')) {
						$error = array('error' => $this->upload->display_errors('<div class="alert alert-danger">', '</div>'));
						$this->session->set_flashdata('error_msg',$error['error']);
						
					}
					else {

						$upload_data = $this->upload->data();
						$cover_image = $upload_data['file_name'];
					}
				} else {
					$this->session->set_flashdata('error_msg','Invalid Image Extension');

				}
			}
			

			// Make DB Query
			$data = array();

			$data['bname'] = $this->input->post('bname');
			$data['categories'] = implode(",",$this->input->post('categories'));
			$data['subcategories'] = implode(",",$this->input->post('subcategories'));
			$data['email'] = $this->input->post('email');
			$data['password'] = md5($this->input->post('password'));
			$data['mobile'] = $this->input->post('mobile');
			$data['web'] = $this->input->post('web');
			$data['location'] = $this->input->post('location');
			$data['address'] = $this->input->post('address');
			$data['overview'] = $this->input->post('overview');
			$data['date'] = date('Y-m-d');
			$data['images'] = $imagse;
			$data['cover_image'] = $cover_image;

			if($this->db->insert('brand', $data)) {
				
				$this->session->set_flashdata('success_msg','Successfully Inserted');
				redirect(base_url('admin/create_brand'));
			} else {
				$this->session->set_flashdata('error_msg','Database Error');
				redirect(base_url('admin/create_brand'));
			}
		}
	}
	public function brand_list(){
		if($this->session->userdata('aid')=="")
		{
			redirect(base_url('admin/login'));
		}
		$data['brand_list'] = $this->db->get('brand')->result_array();
		$this->load->view('Admin/header');
		$this->load->view('Admin/pages/tables/brand_list',$data);
		$this->load->view('Admin/footer');
		
	}
	public function delete_brand($id) {
		

		$this->db->where('id', $id);
		if($this->db->delete('brand'))
		{
			$this->session->set_flashdata('success_msg','Successfully Deleted');
			redirect(base_url('admin/brand_list'));
		} 
		else
		{
			$this->session->set_flashdata('error_msg','Database Error');
			redirect(base_url('admin/brand_list'));
		}
	}
	public function edit_brand($id){
		
           $this->load->helper('form');
           $this->load->library('form_validation');
    

			  $query = $this->db->get_where('brand', array('id' => $id))->row_array();
			
			  $this->form_validation->set_rules('bname', 'bname', 'required');
	 
			  if ($this->form_validation->run() === FALSE)
			  {
			  $data['brand'] = $this->db->get_where('brand',array('id' => $id))->row();
			  
			  
			  $this->load->view("Admin/header");
			  $this->load->view("Admin/pages/forms/edit_brand",$data);
			  $this->load->view("Admin/footer");
			 
	 
			  }
			  else
			  {
			   $imagename =$query['images'];
			   if($_FILES['images']['name'] != "")
			  {
                  $config['upload_path']          = './uploads/brand';
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
			  
			    $cover_image =$query['cover_image'];
			   if($_FILES['cover_image']['name'] != "")
			  {
                  $config['upload_path']          = './uploads/brand';
                  $config['allowed_types']        = 'gif|jpg|jpeg|png|pdf|doc';
                  $config['file_name'] = uniqid();
                  $config['max_size']             = 100000;
                  $config['max_width']            = 100000;
                  $config['max_height']           = 100000;

                  $this->load->library('upload', $config);

                  if ( ! $this->upload->do_upload('cover_image'))
                  {
                          
                      $this->form_validation->set_error_delimiters('<p class="error">', '</p>');

                      $error = array('error' => $this->upload->display_errors());

                      $this->load->view('upload', $error);
                  }
                  else
                  {
				$cover_image =  $this->upload->data('file_name');
                      
                  }
			  }
				 $data = array(
					'images' => $imagename,
					'categories' => implode(",",$this->input->post('categories')),
					'subcategories' => implode(",",$this->input->post('subcategories')),
					'cover_image' => $cover_image,
					'bname' => $this->input->post('bname'),
					'email' => $this->input->post('email'),
					'mobile' => $this->input->post('mobile'), 
					'web' => $this->input->post('web'), 
					'location' => $this->input->post('location'),
			        'address' => $this->input->post('address'),
			        'overview' => $this->input->post('overview'),
					
				 );
				 
				 if($this->input->post('password') == "") 
				 {
				 $data['password'] = $query['password'];
				 }
				 else
				 {
				 $data['password'] = md5($this->input->post('password'));	 
				 }
           

            $this->db->where('id',$id);
            $this->db->update('brand', $data);
			$this->session->set_flashdata('success_msg','Successfully Update Details');
            redirect(base_url('admin/brand_list'));

           }
     }
	 public function create_categories() {
		if($this->session->userdata('aid')=="")
		{
			redirect(base_url('admin/login'));
		}

		$this->load->helper('form');
		$this->load->library('form_validation');

		$this->form_validation->set_rules('cname', 'cname', 'required');
		

		if ($this->form_validation->run() === FALSE)
		{
			$this->load->view("Admin/header");
			$this->load->view("Admin/pages/forms/add_categories");
			$this->load->view("Admin/footer");

		}
		else
		{

			$imagse = "";
			$image_exts = array("tif", "jpg", "gif", "png");

			//Get Extension of file
			if($_FILES['images']['name']) {
				$path_parts = pathinfo($_FILES["images"]["name"]);
				$ext = $path_parts['extension'];
				if(in_array($ext, $image_exts)) {

					$config['upload_path'] = './uploads/categories/';
					$config['allowed_types'] = 'gif|jpg|png|jpeg';
					$config['file_name'] = uniqid();
					$config['overwrite'] = TRUE;
					$config['max_size'] = '50000';
					$config['max_width'] = '40000';
					$config['max_height'] = '40000';   

					//Load Upload Library
					$this->load->library('upload', $config);
					if (!$this->upload->do_upload('images')) {
						$error = array('error' => $this->upload->display_errors('<div class="alert alert-danger">', '</div>'));
						$this->session->set_flashdata('error_msg',$error['error']);
						
					}
					else {

						$upload_data = $this->upload->data();
						$imagse = $upload_data['file_name'];
					}
				} else {
					$this->session->set_flashdata('error_msg','Invalid Image Extension');

				}
			}
			
			
			$menu = "";
			$image_exts = array("tif", "jpg", "gif", "png");

			//Get Extension of file
			if($_FILES['menu_image']['name']) {
				$path_parts = pathinfo($_FILES["menu_image"]["name"]);
				$ext = $path_parts['extension'];
				if(in_array($ext, $image_exts)) {

					$config['upload_path'] = './uploads/categories/';
					$config['allowed_types'] = 'gif|jpg|png|jpeg';
					$config['file_name'] = uniqid();
					$config['overwrite'] = TRUE;
					$config['max_size'] = '50000';
					$config['max_width'] = '40000';
					$config['max_height'] = '40000';   

					//Load Upload Library
					$this->load->library('upload', $config);
					if (!$this->upload->do_upload('menu_image')) {
						$error = array('error' => $this->upload->display_errors('<div class="alert alert-danger">', '</div>'));
						$this->session->set_flashdata('error_msg',$error['error']);
						
					}
					else {

						$upload_data = $this->upload->data();
						$menu = $upload_data['file_name'];
					}
				} else {
					$this->session->set_flashdata('error_msg','Invalid Image Extension');

				}
			}

			// Make DB Query
			$data = array();

			$data['cname'] = $this->input->post('cname');
			$data['date'] = date('Y-m-d');
			$data['images'] = $imagse;
			$data['menu_image'] = $menu;

			if($this->db->insert('categories', $data)) {
				$this->session->set_flashdata('success_msg','Successfully Inserted');
				redirect(base_url('admin/create_categories'));
			} else {
				$this->session->set_flashdata('error_msg','Database Error');
				redirect(base_url('admin/create_categories'));
			}
		}
	}
	public function get_all_categories(){
		if($this->session->userdata('aid')=="")
		{
			redirect(base_url('admin/login'));
		}
		$data['categories'] = $this->db->get('categories')->result_array();
		$this->load->view('Admin/header');
		$this->load->view('Admin/pages/tables/categories_list',$data);
		$this->load->view('Admin/footer');
		
	}
	public function delete_categories($id) {
		

		$this->db->where('id', $id);
		if($this->db->delete('categories'))
		{
			$this->session->set_flashdata('success_msg','Successfully Deleted');
			redirect(base_url('admin/get_all_categories'));
		} 
		else
		{
			$this->session->set_flashdata('error_msg','Database Error');
			redirect(base_url('admin/get_all_categories'));
		}
	}
	public function edit_categories($id){
		
           $this->load->helper('form');
           $this->load->library('form_validation');
    

			  $query = $this->db->get_where('categories', array('id' => $id))->row_array();
			
			  $this->form_validation->set_rules('cname', 'Cname', 'required');
	 
			  if ($this->form_validation->run() === FALSE)
			  {
			  $data['categories'] = $this->db->get_where('categories',array('id' => $id))->row();
			  
			  
			  $this->load->view("Admin/header");
			  $this->load->view("Admin/pages/forms/edit_categories",$data);
			  $this->load->view("Admin/footer");
			 
	 
			  }
			  else
			  {
			   $imagename =$query['images'];
			   if($_FILES['images']['name'] != "")
			  {
                  $config['upload_path']          = './uploads/categories';
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
			  $menu =$query['menu_image'];
			   if($_FILES['menu_image']['name'] != "")
			  {
                  $config['upload_path']          = './uploads/categories';
                  $config['allowed_types']        = 'gif|jpg|jpeg|png|pdf|doc';
                  $config['file_name'] = uniqid();
                  $config['max_size']             = 100000;
                  $config['max_width']            = 100000;
                  $config['max_height']           = 100000;

                  $this->load->library('upload', $config);

                  if ( ! $this->upload->do_upload('menu_image'))
                  {
                          
                      $this->form_validation->set_error_delimiters('<p class="error">', '</p>');

                      $error = array('error' => $this->upload->display_errors());

                      $this->load->view('upload', $error);
                  }
                  else
                  {
				$menu =  $this->upload->data('file_name');
                      
                  }
			  }
				 $data = array(
					'images' => $imagename,
					'menu_image' => $menu,
					'cname' => $this->input->post('cname'),
					
					
				 );
           

            $this->db->where('id',$id);
            $this->db->update('categories', $data);
			$this->session->set_flashdata('success_msg','Successfully Update Details');
            redirect(base_url('admin/get_all_categories'));

           }
     }
	 public function create_subcategories() {
		if($this->session->userdata('aid')=="")
		{
			redirect(base_url('admin/login'));
		}

		$this->load->helper('form');
		$this->load->library('form_validation');

		$this->form_validation->set_rules('sname', 'sname', 'required');
		

		if ($this->form_validation->run() === FALSE)
		{
			$this->load->view("Admin/header");
			$this->load->view("Admin/pages/forms/add_subcategories");
			$this->load->view("Admin/footer");

		}
		else
		{

			$imagse = "";
			$image_exts = array("tif", "jpg", "gif", "png");

			//Get Extension of file
			if($_FILES['images']['name']) {
				$path_parts = pathinfo($_FILES["images"]["name"]);
				$ext = $path_parts['extension'];
				if(in_array($ext, $image_exts)) {

					$config['upload_path'] = './uploads/subcategories/';
					$config['allowed_types'] = 'gif|jpg|png|jpeg';
					$config['file_name'] = uniqid();
					$config['overwrite'] = TRUE;
					$config['max_size'] = '50000';
					$config['max_width'] = '40000';
					$config['max_height'] = '40000';   

					//Load Upload Library
					$this->load->library('upload', $config);
					if (!$this->upload->do_upload('images')) {
						$error = array('error' => $this->upload->display_errors('<div class="alert alert-danger">', '</div>'));
						$this->session->set_flashdata('error_msg',$error['error']);
						
					}
					else {

						$upload_data = $this->upload->data();
						$imagse = $upload_data['file_name'];
					}
				} else {
					$this->session->set_flashdata('error_msg','Invalid Image Extension');

				}
			}

			// Make DB Query
			$data = array();

			$data['cname'] = $this->input->post('cname');
			$data['sname'] = $this->input->post('sname');
			$data['date'] = date('Y-m-d');
			$data['images'] = $imagse;

			if($this->db->insert('subcategories', $data)) {
				$this->session->set_flashdata('success_msg','Successfully Inserted');
				redirect(base_url('admin/create_subcategories'));
			} else {
				$this->session->set_flashdata('error_msg','Database Error');
				redirect(base_url('admin/create_subcategories'));
			}
		}
	}
	public function sub_categories_list(){
		if($this->session->userdata('aid')=="")
		{
			redirect(base_url('admin/login'));
		}
		$data['subcategories'] = $this->db->get('subcategories')->result_array();
		$this->load->view('Admin/header');
		$this->load->view('Admin/pages/tables/subcategories_list',$data);
		$this->load->view('Admin/footer');
		
	}
	public function delete_subcategories($id) {
		

		$this->db->where('id', $id);
		if($this->db->delete('subcategories'))
		{
			$this->session->set_flashdata('success_msg','Successfully Deleted');
			redirect(base_url('admin/sub_categories_list'));
		} 
		else
		{
			$this->session->set_flashdata('error_msg','Database Error');
			redirect(base_url('admin/sub_categories_list'));
		}
	}
	public function edit_subcategories($id){
		
           $this->load->helper('form');
           $this->load->library('form_validation');
    

			  $query = $this->db->get_where('subcategories', array('id' => $id))->row_array();
			
			  $this->form_validation->set_rules('sname', 'sname', 'required');
	 
			  if ($this->form_validation->run() === FALSE)
			  {
			  $data['subcategories'] = $this->db->get_where('subcategories',array('id' => $id))->row();
			  
			  
			  $this->load->view("Admin/header");
			  $this->load->view("Admin/pages/forms/edit_subcategories",$data);
			  $this->load->view("Admin/footer");
			 
	 
			  }
			  else
			  {
			   $imagename =$query['images'];
			   if($_FILES['images']['name'] != "")
			  {
                  $config['upload_path']          = './uploads/subcategories';
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
					'cname' => $this->input->post('cname'),
					'sname' => $this->input->post('sname'),
					
					
				 );
           

            $this->db->where('id',$id);
            $this->db->update('subcategories', $data);
			$this->session->set_flashdata('success_msg','Successfully Update Details');
            redirect(base_url('admin/sub_categories_list'));

           }
     }
	 public function create_blog() {
		if($this->session->userdata('aid')=="")
		{
			redirect(base_url('admin/login'));
		}

		$this->load->helper('form');
		$this->load->library('form_validation');

		$this->form_validation->set_rules('title', 'title', 'required');
		

		if ($this->form_validation->run() === FALSE)
		{
			$this->load->view("Admin/header");
			$this->load->view("Admin/pages/forms/add_blog");
			$this->load->view("Admin/footer");

		}
		else
		{

			$imagse = "";
			$image_exts = array("tif", "jpg", "gif", "png");

			//Get Extension of file
			if($_FILES['images']['name']) {
				$path_parts = pathinfo($_FILES["images"]["name"]);
				$ext = $path_parts['extension'];
				if(in_array($ext, $image_exts)) {

					$config['upload_path'] = './uploads/blog/';
					$config['allowed_types'] = 'gif|jpg|png|jpeg';
					$config['file_name'] = uniqid();
					$config['overwrite'] = TRUE;
					$config['max_size'] = '50000';
					$config['max_width'] = '40000';
					$config['max_height'] = '40000';   

					//Load Upload Library
					$this->load->library('upload', $config);
					if (!$this->upload->do_upload('images')) {
						$error = array('error' => $this->upload->display_errors('<div class="alert alert-danger">', '</div>'));
						$this->session->set_flashdata('error_msg',$error['error']);
						
					}
					else {

						$upload_data = $this->upload->data();
						$imagse = $upload_data['file_name'];
					}
				} else {
					$this->session->set_flashdata('error_msg','Invalid Image Extension');

				}
			}

			// Make DB Query
			$data = array();

			$data['title'] = $this->input->post('title');
			$data['description'] = $this->input->post('description');
			$data['date'] = date('Y-m-d');
			$data['images'] = $imagse;

			if($this->db->insert('blog', $data)) {
				$this->session->set_flashdata('success_msg','Successfully Inserted');
				redirect(base_url('admin/create_blog'));
			} else {
				$this->session->set_flashdata('error_msg','Database Error');
				redirect(base_url('admin/create_blog'));
			}
		}
	}
	public function blog_list(){
		if($this->session->userdata('aid')=="")
		{
			redirect(base_url('admin/login'));
		}
		$data['blog'] = $this->db->get('blog')->result_array();
		$this->load->view('Admin/header');
		$this->load->view('Admin/pages/tables/blog_list',$data);
		$this->load->view('Admin/footer');
		
	}
	public function delete_blog($id) {
		

		$this->db->where('id', $id);
		if($this->db->delete('blog'))
		{
			$this->session->set_flashdata('success_msg','Successfully Deleted');
			redirect(base_url('admin/blog_list'));
		} 
		else
		{
			$this->session->set_flashdata('error_msg','Database Error');
			redirect(base_url('admin/blog_list'));
		}
	}
	public function edit_blog($id){
		
           $this->load->helper('form');
           $this->load->library('form_validation');
    

			  $query = $this->db->get_where('blog', array('id' => $id))->row_array();
			
			  $this->form_validation->set_rules('title', 'title', 'required');
	 
			  if ($this->form_validation->run() === FALSE)
			  {
			  $data['blog'] = $this->db->get_where('blog',array('id' => $id))->row();
			  
			  
			  $this->load->view("Admin/header");
			  $this->load->view("Admin/pages/forms/edit_blog",$data);
			  $this->load->view("Admin/footer");
			 	 
			  }
			  else
			  {
			   $imagename =$query['images'];
			   if($_FILES['images']['name'] != "")
			  {
                  $config['upload_path']          = './uploads/blog';
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
					'title' => $this->input->post('title'),
					'description' => $this->input->post('description'),
									
				 );
           
            $this->db->where('id',$id);
            $this->db->update('blog', $data);
			$this->session->set_flashdata('success_msg','Successfully Update Details');
            redirect(base_url('admin/blog_list'));

           }
     }
	 public function add_user() {
		if($this->session->userdata('aid')=="")
		{
			redirect(base_url('admin/login'));
		}

		$this->load->helper('form');
		$this->load->library('form_validation');

		$this->form_validation->set_rules('name', 'name', 'required');
		

		if ($this->form_validation->run() === FALSE)
		{
			$this->load->view("Admin/header");
			$this->load->view("Admin/pages/forms/add_user");
			$this->load->view("Admin/footer");

		}
		else
		{

			$imagse = "";
			$image_exts = array("tif", "jpg", "gif", "png");

			//Get Extension of file
			if($_FILES['images']['name']) {
				$path_parts = pathinfo($_FILES["images"]["name"]);
				$ext = $path_parts['extension'];
				if(in_array($ext, $image_exts)) {

					$config['upload_path'] = './uploads/user/';
					$config['allowed_types'] = 'gif|jpg|png|jpeg';
					$config['file_name'] = uniqid();
					$config['overwrite'] = TRUE;
					$config['max_size'] = '50000';
					$config['max_width'] = '40000';
					$config['max_height'] = '40000';   

					//Load Upload Library
					$this->load->library('upload', $config);
					if (!$this->upload->do_upload('images')) {
						$error = array('error' => $this->upload->display_errors('<div class="alert alert-danger">', '</div>'));
						$this->session->set_flashdata('error_msg',$error['error']);
						
					}
					else {

						$upload_data = $this->upload->data();
						$imagse = $upload_data['file_name'];
					}
				} else {
					$this->session->set_flashdata('error_msg','Invalid Image Extension');

				}
			}
			// Make DB Query
			$data = array();

			$data['name'] = $this->input->post('name');
			$data['email'] = $this->input->post('email');
			$data['number'] = $this->input->post('number');
			$data['password'] = md5($this->input->post('password'));
			$data['date'] = date('Y-m-d');
			$data['type'] = "Admin";
			$data['images'] = $imagse;

			if($this->db->insert('user', $data)) {
				$this->session->set_flashdata('success_msg','Successfully Inserted');
				redirect(base_url('admin/add_user'));
			} else {
				$this->session->set_flashdata('error_msg','Database Error');
				redirect(base_url('admin/add_user'));
			}
		}
	}
	public function user_list(){
		if($this->session->userdata('aid')=="")
		{
			redirect(base_url('admin/login'));
		}
		$data['user'] = $this->db->get('user')->result_array();
		$this->load->view('Admin/header');
		$this->load->view('Admin/pages/tables/user_list',$data);
		$this->load->view('Admin/footer');
		
	}
	public function delete_user($id) {
		

		$this->db->where('id', $id);
		if($this->db->delete('user'))
		{
			$this->session->set_flashdata('success_msg','Successfully Deleted');
			redirect(base_url('admin/user_list'));
		} 
		else
		{
			$this->session->set_flashdata('error_msg','Database Error');
			redirect(base_url('admin/user_list'));
		}
	}
	public function edit_user($id){
		
           $this->load->helper('form');
           $this->load->library('form_validation');
    

			  $query = $this->db->get_where('user', array('id' => $id))->row_array();
			
			  $this->form_validation->set_rules('name', 'name', 'required');
	 
			  if ($this->form_validation->run() === FALSE)
			  {
			  $data['user'] = $this->db->get_where('user',array('id' => $id))->row();
			  
			  
			  $this->load->view("Admin/header");
			  $this->load->view("Admin/pages/forms/edit_user",$data);
			  $this->load->view("Admin/footer");
			 
	 
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
					'email' => $this->input->post('email'),
					'number' => $this->input->post('number'),
					//'password' => md5($this->input->post('password')),
					
				 );
				 
				 if($this->input->post('password') == "") 
				 {
				 $data['password'] = $query['password'];
				 }
				 else
				 {
				 $data['password'] = md5($this->input->post('password'));	 
				 }
           
            $this->db->where('id',$id);
            $this->db->update('user', $data);
			$this->session->set_flashdata('success_msg','Successfully Update Details');
            redirect(base_url('admin/user_list'));

           }
     }
	 public function create_gallery() {
		if($this->session->userdata('aid')=="")
		{
			redirect(base_url('admin/login'));
		}

		$this->load->helper('form');
		$this->load->library('form_validation');

		$this->form_validation->set_rules('cname', 'cname', 'required');
		

		if ($this->form_validation->run() === FALSE)
		{
			$this->load->view("Admin/header");
			$this->load->view("Admin/pages/forms/add_gallery");
			$this->load->view("Admin/footer");

		}
		else
		{

			$imagse = "";
			$image_exts = array("tif", "jpg", "gif", "png");

			//Get Extension of file
			if($_FILES['images']['name']) {
				$path_parts = pathinfo($_FILES["images"]["name"]);
				$ext = $path_parts['extension'];
				if(in_array($ext, $image_exts)) {

					$config['upload_path'] = './uploads/gallery/';
					$config['allowed_types'] = 'gif|jpg|png|jpeg';
					$config['file_name'] = uniqid();
					$config['overwrite'] = TRUE;
					$config['max_size'] = '50000';
					$config['max_width'] = '40000';
					$config['max_height'] = '40000';   

					//Load Upload Library
					$this->load->library('upload', $config);
					if (!$this->upload->do_upload('images')) {
						$error = array('error' => $this->upload->display_errors('<div class="alert alert-danger">', '</div>'));
						$this->session->set_flashdata('error_msg',$error['error']);
						
					}
					else {

						$upload_data = $this->upload->data();
						$imagse = $upload_data['file_name'];
					}
				} else {
					$this->session->set_flashdata('error_msg','Invalid Image Extension');

				}
			}

			// Make DB Query
			$data = array();

			$data['cname'] = $this->input->post('cname');
			$data['date'] = date('Y-m-d');
			$data['images'] = $imagse;

			if($this->db->insert('gallery', $data)) {
				$this->session->set_flashdata('success_msg','Successfully Inserted');
				redirect(base_url('admin/create_gallery'));
			} else {
				$this->session->set_flashdata('error_msg','Database Error');
				redirect(base_url('admin/create_gallery'));
			}
		}
	}
	public function gallery_list(){
		if($this->session->userdata('aid')=="")
		{
			redirect(base_url('admin/login'));
		}
		$data['gallery'] = $this->db->get('gallery')->result_array();
		$this->load->view('Admin/header');
		$this->load->view('Admin/pages/tables/gallery_list',$data);
		$this->load->view('Admin/footer');
		
	}
	public function delete_gallery($id) {
		

		$this->db->where('id', $id);
		if($this->db->delete('gallery'))
		{
			$this->session->set_flashdata('success_msg','Successfully Deleted');
			redirect(base_url('admin/gallery_list'));
		} 
		else
		{
			$this->session->set_flashdata('error_msg','Database Error');
			redirect(base_url('admin/gallery_list'));
		}
	}
	public function edit_gallery($id){
		
           $this->load->helper('form');
           $this->load->library('form_validation');
    

			  $query = $this->db->get_where('gallery', array('id' => $id))->row_array();
			
			  $this->form_validation->set_rules('cname', 'cname', 'required');
	 
			  if ($this->form_validation->run() === FALSE)
			  {
			  $data['gallery'] = $this->db->get_where('gallery',array('id' => $id))->row();
			  
			  
			  $this->load->view("Admin/header");
			  $this->load->view("Admin/pages/forms/edit_gallery",$data);
			  $this->load->view("Admin/footer");
			 	 
			  }
			  else
			  {
			   $imagename =$query['images'];
			   if($_FILES['images']['name'] != "")
			  {
                  $config['upload_path']          = './uploads/gallery';
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
					'cname' => $this->input->post('cname'),
													
				 );
           
            $this->db->where('id',$id);
            $this->db->update('gallery', $data);
			$this->session->set_flashdata('success_msg','Successfully Update Details');
            redirect(base_url('admin/gallery_list'));

           }
     }
	 public function create_slider() {
		if($this->session->userdata('aid')=="")
		{
			redirect(base_url('admin/login'));
		}
		error_reporting('0');
		if ($_FILES['images']['name'] == "")
		{
			$this->load->view("Admin/header");
			$this->load->view("Admin/pages/forms/add_slider");
			$this->load->view("Admin/footer");

		}
		else
		{

			$imagse = "";
			$image_exts = array("tif", "jpg", "gif", "png");

			//Get Extension of file
			if($_FILES['images']['name']) {
				$path_parts = pathinfo($_FILES["images"]["name"]);
				$ext = $path_parts['extension'];
				if(in_array($ext, $image_exts)) {

					$config['upload_path'] = './uploads/slider/';
					$config['allowed_types'] = 'gif|jpg|png|jpeg';
					$config['file_name'] = uniqid();
					$config['overwrite'] = TRUE;
					$config['max_size'] = '50000';
					$config['max_width'] = '40000';
					$config['max_height'] = '40000';   

					//Load Upload Library
					$this->load->library('upload', $config);
					if (!$this->upload->do_upload('images')) {
						$error = array('error' => $this->upload->display_errors('<div class="alert alert-danger">', '</div>'));
						$this->session->set_flashdata('error_msg',$error['error']);
						
					}
					else {

						$upload_data = $this->upload->data();
						$imagse = $upload_data['file_name'];
					}
				} else {
					$this->session->set_flashdata('error_msg','Invalid Image Extension');

				}
			}

			// Make DB Query
			$data = array();

			
			$data['date'] = date('Y-m-d');
			$data['url'] = $this->input->post('url');
			$data['images'] = $imagse;

			if($this->db->insert('slider', $data)) {
				$this->session->set_flashdata('success_msg','Successfully Inserted');
				redirect(base_url('admin/create_slider'));
			} else {
				$this->session->set_flashdata('error_msg','Database Error');
				redirect(base_url('admin/create_slider'));
			}
		}
	}
	public function slider_list(){
		if($this->session->userdata('aid')=="")
		{
			redirect(base_url('admin/login'));
		}
		$data['slider'] = $this->db->get('slider')->result_array();
		$this->load->view('Admin/header');
		$this->load->view('Admin/pages/tables/slider_list',$data);
		$this->load->view('Admin/footer');
		
	}
	public function delete_slider($id) {
		

		$this->db->where('id', $id);
		if($this->db->delete('slider'))
		{
			$this->session->set_flashdata('success_msg','Successfully Deleted');
			redirect(base_url('admin/slider_list'));
		} 
		else
		{
			$this->session->set_flashdata('error_msg','Database Error');
			redirect(base_url('admin/slider_list'));
		}
	}
	public function installation() {
		if($this->session->userdata('aid')=="")
		{
			redirect(base_url('admin/login'));
		}

		$this->load->helper('form');
		$this->load->library('form_validation');

		$this->form_validation->set_rules('text', 'text', 'required');
		

		if ($this->form_validation->run() === FALSE)
		{
			$data['installation'] = $this->db->get('installation')->result_array();
			$this->load->view("Admin/header");
			$this->load->view("Admin/pages/forms/installation",$data);
			$this->load->view("Admin/footer");
		}
		else
		{

			// Make DB Query
			$data = array();
			$data['text'] = $this->input->post('text');
			$data['cat'] = implode(",",$this->input->post('cat'));
			$data['sub_cat'] = implode(",",$this->input->post('sub_cat'));		
			if($this->db->insert('installation', $data)) {
				$this->session->set_flashdata('success_msg','Successfully Inserted');
				redirect(base_url('admin/installation'));
			} else {
				$this->session->set_flashdata('error_msg','Database Error');
				redirect(base_url('admin/installation'));
			}
		}
	}
	public function delete_installation($id) {
		

		$this->db->where('id', $id);
		if($this->db->delete('installation'))
		{
			$this->session->set_flashdata('success_msg','Successfully Deleted');
			redirect(base_url('admin/installation'));
		} 
		else
		{
			$this->session->set_flashdata('error_msg','Database Error');
			redirect(base_url('admin/installation'));
		}
	}
	public function edit_installation($id){
		
           $this->load->helper('form');
           $this->load->library('form_validation');
    

			  $query = $this->db->get_where('installation', array('id' => $id))->row_array();
			
			  $this->form_validation->set_rules('text', 'text', 'required');
	 
			  if ($this->form_validation->run() === FALSE)
			  {
			  $data['install'] = $this->db->get_where('installation',array('id' => $id))->row();
			  
			  $data['installation'] = $this->db->get('installation')->result_array();
			  $this->load->view("Admin/header");
			  $this->load->view("Admin/pages/forms/installation",$data);
			  $this->load->view("Admin/footer");
			 
	 		  }
			  else
			  {
			   
				 $data = array(
				 
					'text' => $this->input->post('text'),
					'cat' => implode(",",$this->input->post('cat')),
					'sub_cat' => implode(",",$this->input->post('sub_cat')),	
				 );
           
            $this->db->where('id',$id);
            $this->db->update('installation', $data);
			$this->session->set_flashdata('success_msg','Successfully Update Details');
            redirect(base_url('admin/installation'));

           }
     }
	 public function application() {
		if($this->session->userdata('aid')=="")
		{
			redirect(base_url('admin/login'));
		}

		$this->load->helper('form');
		$this->load->library('form_validation');

		$this->form_validation->set_rules('application', 'application', 'required');
		

		if ($this->form_validation->run() === FALSE)
		{
			$data['application'] = $this->db->get('application')->result_array();
			$this->load->view("Admin/header");
			$this->load->view("Admin/pages/forms/application",$data);
			$this->load->view("Admin/footer");

		}
		else
		{

			// Make DB Query
			$data = array();
			$data['application'] = $this->input->post('application');
			$data['cat'] = implode(",",$this->input->post('cat'));
			$data['sub_cat'] = implode(",",$this->input->post('sub_cat'));	
			
			if($this->db->insert('application', $data)) {
				$this->session->set_flashdata('success_msg','Successfully Inserted');
				redirect(base_url('admin/application'));
			} else {
				$this->session->set_flashdata('error_msg','Database Error');
				redirect(base_url('admin/application'));
			}
		}
	}
	public function delete_application($id) {
		

		$this->db->where('id', $id);
		if($this->db->delete('application'))
		{
			$this->session->set_flashdata('success_msg','Successfully Deleted');
			redirect(base_url('admin/application'));
		} 
		else
		{
			$this->session->set_flashdata('error_msg','Database Error');
			redirect(base_url('admin/application'));
		}
	}
	public function edit_application($id){
		
           $this->load->helper('form');
           $this->load->library('form_validation');
    

			  $query = $this->db->get_where('application', array('id' => $id))->row_array();
			
			  $this->form_validation->set_rules('application', 'application', 'required');
	 
			  if ($this->form_validation->run() === FALSE)
			  {
			  $data['apps'] = $this->db->get_where('application',array('id' => $id))->row();
			  
			  $data['application'] = $this->db->get('application')->result_array();
			  $this->load->view("Admin/header");
			  $this->load->view("Admin/pages/forms/application",$data);
			  $this->load->view("Admin/footer");
			 
	 
			  }
			  else
			  {
			   
				 $data = array(
				 
					'application' => $this->input->post('application'),
					'cat' => implode(",",$this->input->post('cat')),
					'sub_cat' => implode(",",$this->input->post('sub_cat')),	
				 );
           

            $this->db->where('id',$id);
            $this->db->update('application', $data);
			$this->session->set_flashdata('success_msg','Successfully Update Details');
            redirect(base_url('admin/application'));

           }
     }
	 public function material() {
		if($this->session->userdata('aid')=="")
		{
			redirect(base_url('admin/login'));
		}

		$this->load->helper('form');
		$this->load->library('form_validation');

		$this->form_validation->set_rules('material', 'material', 'required');
		

		if ($this->form_validation->run() === FALSE)
		{
			$data['material'] = $this->db->get('material')->result_array();
			$this->load->view("Admin/header");
			$this->load->view("Admin/pages/forms/material",$data);
			$this->load->view("Admin/footer");

		}
		else
		{

			// Make DB Query
			$data = array();
			$data['material'] = $this->input->post('material');
			$data['cat'] = implode(",",$this->input->post('cat'));
			$data['sub_cat'] = implode(",",$this->input->post('sub_cat'));	
			
			if($this->db->insert('material', $data)) {
				$this->session->set_flashdata('success_msg','Successfully Inserted');
				redirect(base_url('admin/material'));
			} else {
				$this->session->set_flashdata('error_msg','Database Error');
				redirect(base_url('admin/material'));
			}
		}
	}
	public function delete_material($id) {
		

		$this->db->where('id', $id);
		if($this->db->delete('material'))
		{
			$this->session->set_flashdata('success_msg','Successfully Deleted');
			redirect(base_url('admin/material'));
		} 
		else
		{
			$this->session->set_flashdata('error_msg','Database Error');
			redirect(base_url('admin/material'));
		}
	}
	public function edit_material($id){
		
           $this->load->helper('form');
           $this->load->library('form_validation');
    

			  $query = $this->db->get_where('material', array('id' => $id))->row_array();
			
			  $this->form_validation->set_rules('material', 'material', 'required');
	 
			  if ($this->form_validation->run() === FALSE)
			  {
			  $data['mate'] = $this->db->get_where('material',array('id' => $id))->row();
			  
			  $data['material'] = $this->db->get('material')->result_array();
			  $this->load->view("Admin/header");
			  $this->load->view("Admin/pages/forms/material",$data);
			  $this->load->view("Admin/footer");
			 
	 
			  }
			  else
			  {
			   
				 $data = array(
				 
					'material' => $this->input->post('material'),
					'cat' => implode(",",$this->input->post('cat')),
					'sub_cat' => implode(",",$this->input->post('sub_cat')),	
				 );
             

            $this->db->where('id',$id);
            $this->db->update('material', $data);
			$this->session->set_flashdata('success_msg','Successfully Update Details');
            redirect(base_url('admin/material'));

           }
     }
	 public function shape() {
		if($this->session->userdata('aid')=="")
		{
			redirect(base_url('admin/login'));
		}

		$this->load->helper('form');
		$this->load->library('form_validation');

		$this->form_validation->set_rules('shape', 'shape', 'required');
		

		if ($this->form_validation->run() === FALSE)
		{
			$data['shape'] = $this->db->get('shape')->result_array();
			$this->load->view("Admin/header");
			$this->load->view("Admin/pages/forms/shape",$data);
			$this->load->view("Admin/footer");

		}
		else
		{

			// Make DB Query
			$data = array();
			$data['shape'] = $this->input->post('shape');
			$data['cat'] = implode(",",$this->input->post('cat'));
			$data['sub_cat'] = implode(",",$this->input->post('sub_cat'));	
			
			if($this->db->insert('shape', $data)) {
				$this->session->set_flashdata('success_msg','Successfully Inserted');
				redirect(base_url('admin/shape'));
			} else {
				$this->session->set_flashdata('error_msg','Database Error');
				redirect(base_url('admin/shape'));
			}
		}
	}
	public function delete_shape($id) {
		

		$this->db->where('id', $id);
		if($this->db->delete('shape'))
		{
			$this->session->set_flashdata('success_msg','Successfully Deleted');
			redirect(base_url('admin/shape'));
		} 
		else
		{
			$this->session->set_flashdata('error_msg','Database Error');
			redirect(base_url('admin/shape'));
		}
	}
	public function edit_shape($id){
		
           $this->load->helper('form');
           $this->load->library('form_validation');
    

			  $query = $this->db->get_where('shape', array('id' => $id))->row_array();
			
			  $this->form_validation->set_rules('shape', 'shape', 'required');
	 
			  if ($this->form_validation->run() === FALSE)
			  {
			  $data['sha'] = $this->db->get_where('shape',array('id' => $id))->row();
			  
			  $data['shape'] = $this->db->get('shape')->result_array();
			  $this->load->view("Admin/header");
			  $this->load->view("Admin/pages/forms/shape",$data);
			  $this->load->view("Admin/footer");
			 
	 
			  }
			  else
			  {
			   
				 $data = array(
				 
					'shape' => $this->input->post('shape'),
					'cat' => implode(",",$this->input->post('cat')),
					'sub_cat' => implode(",",$this->input->post('sub_cat')),
				 );
           

            $this->db->where('id',$id);
            $this->db->update('shape', $data);
			$this->session->set_flashdata('success_msg','Successfully Update Details');
            redirect(base_url('admin/shape'));

           }
     }
	 public function effects() {
		if($this->session->userdata('aid')=="")
		{
			redirect(base_url('admin/login'));
		}

		$this->load->helper('form');
		$this->load->library('form_validation');

		$this->form_validation->set_rules('effects', 'effects', 'required');
		

		if ($this->form_validation->run() === FALSE)
		{
			$data['effects'] = $this->db->get('effects')->result_array();
			$this->load->view("Admin/header");
			$this->load->view("Admin/pages/forms/effects",$data);
			$this->load->view("Admin/footer");

		}
		else
		{

			// Make DB Query
			$data = array();
			$data['effects'] = $this->input->post('effects');
			$data['cat'] = implode(",",$this->input->post('cat'));
			$data['sub_cat'] = implode(",",$this->input->post('sub_cat'));
			
			if($this->db->insert('effects', $data)) {
				$this->session->set_flashdata('success_msg','Successfully Inserted');
				redirect(base_url('admin/effects'));
			} else {
				$this->session->set_flashdata('error_msg','Database Error');
				redirect(base_url('admin/effects'));
			}
		}
	}
	public function delete_effects($id) {
		

		$this->db->where('id', $id);
		if($this->db->delete('effects'))
		{
			$this->session->set_flashdata('success_msg','Successfully Deleted');
			redirect(base_url('admin/effects'));
		} 
		else
		{
			$this->session->set_flashdata('error_msg','Database Error');
			redirect(base_url('admin/effects'));
		}
	}
	public function edit_effects($id){
		
           $this->load->helper('form');
           $this->load->library('form_validation');
    

			  $query = $this->db->get_where('effects', array('id' => $id))->row_array();
			
			  $this->form_validation->set_rules('effects', 'effects', 'required');
	 
			  if ($this->form_validation->run() === FALSE)
			  {
			  $data['effe'] = $this->db->get_where('effects',array('id' => $id))->row();
			  
			  $data['effects'] = $this->db->get('effects')->result_array();
			  $this->load->view("Admin/header");
			  $this->load->view("Admin/pages/forms/effects",$data);
			  $this->load->view("Admin/footer");
			 
	 
			  }
			  else
			  {
			   
				 $data = array(
				 
					'effects' => $this->input->post('effects'),
					'cat' => implode(",",$this->input->post('cat')),
					'sub_cat' => implode(",",$this->input->post('sub_cat')),
				 );
           

            $this->db->where('id',$id);
            $this->db->update('effects', $data);
			$this->session->set_flashdata('success_msg','Successfully Update Details');
            redirect(base_url('admin/effects'));

           }
     }
	 public function finish() {
		if($this->session->userdata('aid')=="")
		{
			redirect(base_url('admin/login'));
		}

		$this->load->helper('form');
		$this->load->library('form_validation');

		$this->form_validation->set_rules('finish', 'finish', 'required');
		

		if ($this->form_validation->run() === FALSE)
		{
			$data['finish'] = $this->db->get('finish')->result_array();
			$this->load->view("Admin/header");
			$this->load->view("Admin/pages/forms/finish",$data);
			$this->load->view("Admin/footer");

		}
		else
		{

			// Make DB Query
			$data = array();
			$data['finish'] = $this->input->post('finish');
			$data['cat'] = implode(",",$this->input->post('cat'));
			$data['sub_cat'] = implode(",",$this->input->post('sub_cat'));
			
			if($this->db->insert('finish', $data)) {
				$this->session->set_flashdata('success_msg','Successfully Inserted');
				redirect(base_url('admin/finish'));
			} else {
				$this->session->set_flashdata('error_msg','Database Error');
				redirect(base_url('admin/finish'));
			}
		}
	}
	public function delete_finish($id) {
		

		$this->db->where('id', $id);
		if($this->db->delete('finish'))
		{
			$this->session->set_flashdata('success_msg','Successfully Deleted');
			redirect(base_url('admin/finish'));
		} 
		else
		{
			$this->session->set_flashdata('error_msg','Database Error');
			redirect(base_url('admin/finish'));
		}
	}
	public function edit_finish($id){
		
           $this->load->helper('form');
           $this->load->library('form_validation');
    

			  $query = $this->db->get_where('finish', array('id' => $id))->row_array();
			
			  $this->form_validation->set_rules('finish', 'finish', 'required');
	 
			  if ($this->form_validation->run() === FALSE)
			  {
			  $data['fini'] = $this->db->get_where('finish',array('id' => $id))->row();
			  
			  $data['finish'] = $this->db->get('finish')->result_array();
			  $this->load->view("Admin/header");
			  $this->load->view("Admin/pages/forms/finish",$data);
			  $this->load->view("Admin/footer");
			 
	 
			  }
			  else
			  {
			   
				 $data = array(
				 
					'finish' => $this->input->post('finish'),
					'cat' => implode(",",$this->input->post('cat')),
					'sub_cat' => implode(",",$this->input->post('sub_cat')),
				 );
           

            $this->db->where('id',$id);
            $this->db->update('finish', $data);
			$this->session->set_flashdata('success_msg','Successfully Update Details');
            redirect(base_url('admin/finish'));

           }
     }
	 public function size() {
		if($this->session->userdata('aid')=="")
		{
			redirect(base_url('admin/login'));
		}

		$this->load->helper('form');
		$this->load->library('form_validation');

		$this->form_validation->set_rules('size', 'size', 'required');
		

		if ($this->form_validation->run() === FALSE)
		{
			$data['size'] = $this->db->get('size')->result_array();
			$this->load->view("Admin/header");
			$this->load->view("Admin/pages/forms/size",$data);
			$this->load->view("Admin/footer");

		}
		else
		{

			// Make DB Query
			$data = array();
			$data['size'] = $this->input->post('size');
			$data['cat'] = implode(",",$this->input->post('cat'));
			$data['sub_cat'] = implode(",",$this->input->post('sub_cat'));
			
			if($this->db->insert('size', $data)) {
				$this->session->set_flashdata('success_msg','Successfully Inserted');
				redirect(base_url('admin/size'));
			} else {
				$this->session->set_flashdata('error_msg','Database Error');
				redirect(base_url('admin/size'));
			}
		}
	}
	public function delete_size($id) {
		

		$this->db->where('id', $id);
		if($this->db->delete('size'))
		{
			$this->session->set_flashdata('success_msg','Successfully Deleted');
			redirect(base_url('admin/size'));
		} 
		else
		{
			$this->session->set_flashdata('error_msg','Database Error');
			redirect(base_url('admin/size'));
		}
	}
	public function edit_size($id){
		
           $this->load->helper('form');
           $this->load->library('form_validation');
    

			  $query = $this->db->get_where('size', array('id' => $id))->row_array();
			
			  $this->form_validation->set_rules('size', 'size', 'required');
	 
			  if ($this->form_validation->run() === FALSE)
			  {
			  $data['siz'] = $this->db->get_where('size',array('id' => $id))->row();
			  
			  $data['size'] = $this->db->get('size')->result_array();
			  $this->load->view("Admin/header");
			  $this->load->view("Admin/pages/forms/size",$data);
			  $this->load->view("Admin/footer");
			 
	 
			  }
			  else
			  {
			   
				 $data = array(
				 
					'size' => $this->input->post('size'),
					'cat' => implode(",",$this->input->post('cat')),
					'sub_cat' => implode(",",$this->input->post('sub_cat')),
				 );
           

            $this->db->where('id',$id);
            $this->db->update('size', $data);
			$this->session->set_flashdata('success_msg','Successfully Update Details');
            redirect(base_url('admin/size'));

           }
     }
	 public function thickness() {
		if($this->session->userdata('aid')=="")
		{
			redirect(base_url('admin/login'));
		}

		$this->load->helper('form');
		$this->load->library('form_validation');

		$this->form_validation->set_rules('thickness', 'thickness', 'required');
		

		if ($this->form_validation->run() === FALSE)
		{
			$data['thickness'] = $this->db->get('thickness')->result_array();
			$this->load->view("Admin/header");
			$this->load->view("Admin/pages/forms/thickness",$data);
			$this->load->view("Admin/footer");

		}
		else
		{

			// Make DB Query
			$data = array();
			$data['thickness'] = $this->input->post('thickness');
			$data['cat'] = implode(",",$this->input->post('cat'));
			$data['sub_cat'] = implode(",",$this->input->post('sub_cat'));
			
			if($this->db->insert('thickness', $data)) {
				$this->session->set_flashdata('success_msg','Successfully Inserted');
				redirect(base_url('admin/thickness'));
			} else {
				$this->session->set_flashdata('error_msg','Database Error');
				redirect(base_url('admin/thickness'));
			}
		}
	}
	public function delete_thickness($id) {
		

		$this->db->where('id', $id);
		if($this->db->delete('thickness'))
		{
			$this->session->set_flashdata('success_msg','Successfully Deleted');
			redirect(base_url('admin/thickness'));
		} 
		else
		{
			$this->session->set_flashdata('error_msg','Database Error');
			redirect(base_url('admin/thickness'));
		}
	}
	public function edit_thickness($id){
		
           $this->load->helper('form');
           $this->load->library('form_validation');
    

			  $query = $this->db->get_where('thickness', array('id' => $id))->row_array();
			
			  $this->form_validation->set_rules('thickness', 'thickness', 'required');
	 
			  if ($this->form_validation->run() === FALSE)
			  {
			  $data['thic'] = $this->db->get_where('thickness',array('id' => $id))->row();
			  
			  $data['thickness'] = $this->db->get('thickness')->result_array();
			  $this->load->view("Admin/header");
			  $this->load->view("Admin/pages/forms/thickness",$data);
			  $this->load->view("Admin/footer");
			 
	 		  }
			  else
			  {
			    $data = array(
				 
					'thickness' => $this->input->post('thickness'),
					'cat' => implode(",",$this->input->post('cat')),
					'sub_cat' => implode(",",$this->input->post('sub_cat')),
				 );
           
            $this->db->where('id',$id);
            $this->db->update('thickness', $data);
			$this->session->set_flashdata('success_msg','Successfully Update Details');
            redirect(base_url('admin/thickness'));

           }
     }
	 public function type() {
		if($this->session->userdata('aid')=="")
		{
			redirect(base_url('admin/login'));
		}

		$this->load->helper('form');
		$this->load->library('form_validation');

		$this->form_validation->set_rules('type', 'type', 'required');
		

		if ($this->form_validation->run() === FALSE)
		{
			$data['type'] = $this->db->get('type')->result_array();
			$this->load->view("Admin/header");
			$this->load->view("Admin/pages/forms/type",$data);
			$this->load->view("Admin/footer");

		}
		else
		{

			// Make DB Query
			$data = array();
			$data['type'] = $this->input->post('type');
			$data['cat'] = implode(",",$this->input->post('cat'));
			$data['sub_cat'] = implode(",",$this->input->post('sub_cat'));
			
			if($this->db->insert('type', $data)) {
				$this->session->set_flashdata('success_msg','Successfully Inserted');
				redirect(base_url('admin/type'));
			} else {
				$this->session->set_flashdata('error_msg','Database Error');
				redirect(base_url('admin/type'));
			}
		}
	}
	public function delete_type($id) {
		

		$this->db->where('id', $id);
		if($this->db->delete('type'))
		{
			$this->session->set_flashdata('success_msg','Successfully Deleted');
			redirect(base_url('admin/type'));
		} 
		else
		{
			$this->session->set_flashdata('error_msg','Database Error');
			redirect(base_url('admin/type'));
		}
	}
	public function edit_type($id){
		
           $this->load->helper('form');
           $this->load->library('form_validation');
    

			  $query = $this->db->get_where('type', array('id' => $id))->row_array();
			
			  $this->form_validation->set_rules('type', 'type', 'required');
	 
			  if ($this->form_validation->run() === FALSE)
			  {
			  $data['typ'] = $this->db->get_where('type',array('id' => $id))->row();
			  
			  $data['type'] = $this->db->get('type')->result_array();
			  $this->load->view("Admin/header");
			  $this->load->view("Admin/pages/forms/type",$data);
			  $this->load->view("Admin/footer");
			 
	 		  }
			  else
			  {
			    $data = array(
				 
					'type' => $this->input->post('type'),
					'cat' => implode(",",$this->input->post('cat')),
					'sub_cat' => implode(",",$this->input->post('sub_cat')),
				 );
           
            $this->db->where('id',$id);
            $this->db->update('type', $data);
			$this->session->set_flashdata('success_msg','Successfully Update Details');
            redirect(base_url('admin/type'));

           }
     }
	 public function themes() {
		if($this->session->userdata('aid')=="")
		{
			redirect(base_url('admin/login'));
		}

		$this->load->helper('form');
		$this->load->library('form_validation');

		$this->form_validation->set_rules('themes', 'themes', 'required');
		

		if ($this->form_validation->run() === FALSE)
		{
			$data['themes'] = $this->db->get('themes')->result_array();
			$this->load->view("Admin/header");
			$this->load->view("Admin/pages/forms/themes",$data);
			$this->load->view("Admin/footer");

		}
		else
		{

			// Make DB Query
			$data = array();
			$data['themes'] = $this->input->post('themes');
			$data['cat'] = implode(",",$this->input->post('cat'));
			$data['sub_cat'] = implode(",",$this->input->post('sub_cat'));
			
			if($this->db->insert('themes', $data)) {
				$this->session->set_flashdata('success_msg','Successfully Inserted');
				redirect(base_url('admin/themes'));
			} else {
				$this->session->set_flashdata('error_msg','Database Error');
				redirect(base_url('admin/themes'));
			}
		}
	}
	public function delete_themes($id) {
		

		$this->db->where('id', $id);
		if($this->db->delete('themes'))
		{
			$this->session->set_flashdata('success_msg','Successfully Deleted');
			redirect(base_url('admin/themes'));
		} 
		else
		{
			$this->session->set_flashdata('error_msg','Database Error');
			redirect(base_url('admin/themes'));
		}
	}
	public function edit_themes($id){
		
           $this->load->helper('form');
           $this->load->library('form_validation');
    

			  $query = $this->db->get_where('themes', array('id' => $id))->row_array();
			
			  $this->form_validation->set_rules('themes', 'themes', 'required');
	 
			  if ($this->form_validation->run() === FALSE)
			  {
			  $data['the'] = $this->db->get_where('themes',array('id' => $id))->row();
			  
			  $data['themes'] = $this->db->get('themes')->result_array();
			  $this->load->view("Admin/header");
			  $this->load->view("Admin/pages/forms/themes",$data);
			  $this->load->view("Admin/footer");
			 
	 		  }
			  else
			  {
			    $data = array(
				 
					'themes' => $this->input->post('themes'),
					'cat' => implode(",",$this->input->post('cat')),
					'sub_cat' => implode(",",$this->input->post('sub_cat')),
				 );
           
            $this->db->where('id',$id);
            $this->db->update('themes', $data);
			$this->session->set_flashdata('success_msg','Successfully Update Details');
            redirect(base_url('admin/themes'));

           }
     }
	 public function light_bulb_type() {
		if($this->session->userdata('aid')=="")
		{
			redirect(base_url('admin/login'));
		}

		$this->load->helper('form');
		$this->load->library('form_validation');

		$this->form_validation->set_rules('light_bulb', 'light_bulb', 'required');
		

		if ($this->form_validation->run() === FALSE)
		{
			$data['light_bulb'] = $this->db->get('light_bulb_type')->result_array();
			$this->load->view("Admin/header");
			$this->load->view("Admin/pages/forms/light_bulb_type",$data);
			$this->load->view("Admin/footer");

		}
		else
		{

			// Make DB Query
			$data = array();
			$data['light_bulb'] = $this->input->post('light_bulb');
			$data['cat'] = implode(",",$this->input->post('cat'));
			$data['sub_cat'] = implode(",",$this->input->post('sub_cat'));
			
			if($this->db->insert('light_bulb_type', $data)) {
				$this->session->set_flashdata('success_msg','Successfully Inserted');
				redirect(base_url('admin/light_bulb_type'));
			} else {
				$this->session->set_flashdata('error_msg','Database Error');
				redirect(base_url('admin/light_bulb_type'));
			}
		}
	}
	public function delete_light_bulb_type($id) {
		

		$this->db->where('id', $id);
		if($this->db->delete('light_bulb_type'))
		{
			$this->session->set_flashdata('success_msg','Successfully Deleted');
			redirect(base_url('admin/light_bulb_type'));
		} 
		else
		{
			$this->session->set_flashdata('error_msg','Database Error');
			redirect(base_url('admin/light_bulb_type'));
		}
	}
	public function edit_light_bulb_type($id){
		
           $this->load->helper('form');
           $this->load->library('form_validation');
    

			  $query = $this->db->get_where('light_bulb_type', array('id' => $id))->row_array();
			
			  $this->form_validation->set_rules('light_bulb', 'light_bulb', 'required');
	 
			  if ($this->form_validation->run() === FALSE)
			  {
			  $data['lig'] = $this->db->get_where('light_bulb_type',array('id' => $id))->row();
			  
			  $data['light_bulb'] = $this->db->get('light_bulb_type')->result_array();
			  $this->load->view("Admin/header");
			  $this->load->view("Admin/pages/forms/light_bulb_type",$data);
			  $this->load->view("Admin/footer");
			 
	 		  }
			  else
			  {
			    $data = array(
				 
					'light_bulb' => $this->input->post('light_bulb'),
					'cat' => implode(",",$this->input->post('cat')),
					'sub_cat' => implode(",",$this->input->post('sub_cat')),
				 );
           
            $this->db->where('id',$id);
            $this->db->update('light_bulb_type', $data);
			$this->session->set_flashdata('success_msg','Successfully Update Details');
            redirect(base_url('admin/light_bulb_type'));

           }
     }
	 public function number_of_seat() {
		if($this->session->userdata('aid')=="")
		{
			redirect(base_url('admin/login'));
		}

		$this->load->helper('form');
		$this->load->library('form_validation');

		$this->form_validation->set_rules('number_of_seat', 'number_of_seat', 'required');
		

		if ($this->form_validation->run() === FALSE)
		{
			$data['number_of_seat'] = $this->db->get('number_of_seat')->result_array();
			$this->load->view("Admin/header");
			$this->load->view("Admin/pages/forms/number_of_seat",$data);
			$this->load->view("Admin/footer");

		}
		else
		{

			// Make DB Query
			$data = array();
			$data['number_of_seat'] = $this->input->post('number_of_seat');
			$data['cat'] = implode(",",$this->input->post('cat'));
			$data['sub_cat'] = implode(",",$this->input->post('sub_cat'));
			
			if($this->db->insert('number_of_seat', $data)) {
				$this->session->set_flashdata('success_msg','Successfully Inserted');
				redirect(base_url('admin/number_of_seat'));
			} else {
				$this->session->set_flashdata('error_msg','Database Error');
				redirect(base_url('admin/number_of_seat'));
			}
		}
	}
	public function delete_number_of_seat($id) {
		

		$this->db->where('id', $id);
		if($this->db->delete('number_of_seat'))
		{
			$this->session->set_flashdata('success_msg','Successfully Deleted');
			redirect(base_url('admin/number_of_seat'));
		} 
		else
		{
			$this->session->set_flashdata('error_msg','Database Error');
			redirect(base_url('admin/number_of_seat'));
		}
	}
	public function edit_number_of_seat($id){
		
           $this->load->helper('form');
           $this->load->library('form_validation');
    

			  $query = $this->db->get_where('number_of_seat', array('id' => $id))->row_array();
			
			  $this->form_validation->set_rules('number_of_seat', 'number_of_seat', 'required');
	 
			  if ($this->form_validation->run() === FALSE)
			  {
			  $data['num'] = $this->db->get_where('number_of_seat',array('id' => $id))->row();
			  
			  $data['number_of_seat'] = $this->db->get('number_of_seat')->result_array();
			  $this->load->view("Admin/header");
			  $this->load->view("Admin/pages/forms/number_of_seat",$data);
			  $this->load->view("Admin/footer");
			 
	 		  }
			  else
			  {
			    $data = array(
				 
					'number_of_seat' => $this->input->post('number_of_seat'),
					'cat' => implode(",",$this->input->post('cat')),
					'sub_cat' => implode(",",$this->input->post('sub_cat')),
				 );
           
            $this->db->where('id',$id);
            $this->db->update('number_of_seat', $data);
			$this->session->set_flashdata('success_msg','Successfully Update Details');
            redirect(base_url('admin/number_of_seat'));

           }
     }
	 public function bed_size() {
		if($this->session->userdata('aid')=="")
		{
			redirect(base_url('admin/login'));
		}

		$this->load->helper('form');
		$this->load->library('form_validation');

		$this->form_validation->set_rules('bed_size', 'bed_size', 'required');
		

		if ($this->form_validation->run() === FALSE)
		{
			$data['bed_size'] = $this->db->get('bed_size')->result_array();
			$this->load->view("Admin/header");
			$this->load->view("Admin/pages/forms/bed_size",$data);
			$this->load->view("Admin/footer");

		}
		else
		{

			// Make DB Query
			$data = array();
			$data['bed_size'] = $this->input->post('bed_size');
			$data['cat'] = implode(",",$this->input->post('cat'));
			$data['sub_cat'] = implode(",",$this->input->post('sub_cat'));
			
			if($this->db->insert('bed_size', $data)) {
				$this->session->set_flashdata('success_msg','Successfully Inserted');
				redirect(base_url('admin/bed_size'));
			} else {
				$this->session->set_flashdata('error_msg','Database Error');
				redirect(base_url('admin/bed_size'));
			}
		}
	}
	public function delete_bed_size($id) {
		

		$this->db->where('id', $id);
		if($this->db->delete('bed_size'))
		{
			$this->session->set_flashdata('success_msg','Successfully Deleted');
			redirect(base_url('admin/bed_size'));
		} 
		else
		{
			$this->session->set_flashdata('error_msg','Database Error');
			redirect(base_url('admin/bed_size'));
		}
	}
	public function edit_bed_size($id){
		
           $this->load->helper('form');
           $this->load->library('form_validation');
    

			  $query = $this->db->get_where('bed_size', array('id' => $id))->row_array();
			
			  $this->form_validation->set_rules('bed_size', 'bed_size', 'required');
	 
			  if ($this->form_validation->run() === FALSE)
			  {
			  $data['bed'] = $this->db->get_where('bed_size',array('id' => $id))->row();
			  
			  $data['bed_size'] = $this->db->get('bed_size')->result_array();
			  $this->load->view("Admin/header");
			  $this->load->view("Admin/pages/forms/bed_size",$data);
			  $this->load->view("Admin/footer");
			 
	 		  }
			  else
			  {
			    $data = array(
				 
					'bed_size' => $this->input->post('bed_size'),
					'cat' => implode(",",$this->input->post('cat')),
					'sub_cat' => implode(",",$this->input->post('sub_cat')),
				 );
           
            $this->db->where('id',$id);
            $this->db->update('bed_size', $data);
			$this->session->set_flashdata('success_msg','Successfully Update Details');
            redirect(base_url('admin/bed_size'));

           }
     }
	 public function bowl() {
		if($this->session->userdata('aid')=="")
		{
			redirect(base_url('admin/login'));
		}

		$this->load->helper('form');
		$this->load->library('form_validation');

		$this->form_validation->set_rules('bowl', 'bowl', 'required');
		

		if ($this->form_validation->run() === FALSE)
		{
			$data['bowl'] = $this->db->get('bowl')->result_array();
			$this->load->view("Admin/header");
			$this->load->view("Admin/pages/forms/bowl",$data);
			$this->load->view("Admin/footer");

		}
		else
		{

			// Make DB Query
			$data = array();
			$data['bowl'] = $this->input->post('bowl');
			$data['cat'] = implode(",",$this->input->post('cat'));
			$data['sub_cat'] = implode(",",$this->input->post('sub_cat'));
			
			if($this->db->insert('bowl', $data)) {
				$this->session->set_flashdata('success_msg','Successfully Inserted');
				redirect(base_url('admin/bowl'));
			} else {
				$this->session->set_flashdata('error_msg','Database Error');
				redirect(base_url('admin/bowl'));
			}
		}
	}
	public function delete_bowl($id) {
		

		$this->db->where('id', $id);
		if($this->db->delete('bowl'))
		{
			$this->session->set_flashdata('success_msg','Successfully Deleted');
			redirect(base_url('admin/bowl'));
		} 
		else
		{
			$this->session->set_flashdata('error_msg','Database Error');
			redirect(base_url('admin/bowl'));
		}
	}
	public function edit_bowl($id){
		
           $this->load->helper('form');
           $this->load->library('form_validation');
    

			  $query = $this->db->get_where('bowl', array('id' => $id))->row_array();
			
			  $this->form_validation->set_rules('bowl', 'bowl', 'required');
	 
			  if ($this->form_validation->run() === FALSE)
			  {
			  $data['bow'] = $this->db->get_where('bowl',array('id' => $id))->row();
			  
			  $data['bowl'] = $this->db->get('bowl')->result_array();
			  $this->load->view("Admin/header");
			  $this->load->view("Admin/pages/forms/bowl",$data);
			  $this->load->view("Admin/footer");
			 
	 		  }
			  else
			  {
			    $data = array(
				 
					'bowl' => $this->input->post('bowl'),
					'cat' => implode(",",$this->input->post('cat')),
					'sub_cat' => implode(",",$this->input->post('sub_cat')),
				 );
           
            $this->db->where('id',$id);
            $this->db->update('bowl', $data);
			$this->session->set_flashdata('success_msg','Successfully Update Details');
            redirect(base_url('admin/bowl'));

           }
     }
	 public function aj_fetch_data()
            {
            
            header("Content-type:application/json");
            
            $pro_id = $this->input->post('s_id');
            
            $subcat = $this->db->get_where("subcategories", array("cname" => $pro_id))->result();
            
             $html = "<option value=''>Select Sub Category</option>";
            
            foreach ($subcat as $key => $del_id) {
                $html .= "
                    <option value='".$del_id->id."'>".$del_id->sname."</option>
                ";
            }
            
            $data['html'] = $html;
            echo json_encode($data);
     }
	 public function get_sub_cat()
            {
            
            header("Content-type:application/json");
            
            $ids = $this->input->post('ids');
			$html = "";
			$html .= "<option value=''>Select Sub Category</option>";
            foreach($ids as $pro_id) {
            $subcat = $this->db->get_where("subcategories", array("cname" => $pro_id))->result();
            
             
            
            foreach ($subcat as $key => $del_id) {
                $html .= "
                    <option value='".$del_id->id."'>".$del_id->sname."</option>
                ";
            }
            }
            $data['html'] = $html;
            echo json_encode($data);
     }
	 public function add_color() {
		if($this->session->userdata('aid')=="")
		{
			redirect(base_url('admin/login'));
		}

		$this->load->helper('form');
		$this->load->library('form_validation');

		$this->form_validation->set_rules('name', 'name', 'required');
		

		if ($this->form_validation->run() === FALSE)
		{
			$data['colora'] = $this->db->get('color')->result_array();
			$this->load->view("Admin/header");
			$this->load->view("Admin/pages/forms/add_color",$data);
			$this->load->view("Admin/footer");

		}
		else
		{

			$imagse = "";
			$image_exts = array("tif", "jpg", "gif", "png");

			//Get Extension of file
			if($_FILES['images']['name']) {
				$path_parts = pathinfo($_FILES["images"]["name"]);
				$ext = $path_parts['extension'];
				if(in_array($ext, $image_exts)) {

					$config['upload_path'] = './uploads/color/';
					$config['allowed_types'] = 'gif|jpg|png|jpeg';
					$config['file_name'] = uniqid();
					$config['overwrite'] = TRUE;
					$config['max_size'] = '50000';
					$config['max_width'] = '40000';
					$config['max_height'] = '40000';   

					//Load Upload Library
					$this->load->library('upload', $config);
					if (!$this->upload->do_upload('images')) {
						$error = array('error' => $this->upload->display_errors('<div class="alert alert-danger">', '</div>'));
						$this->session->set_flashdata('error_msg',$error['error']);
						
					}
					else {

						$upload_data = $this->upload->data();
						$imagse = $upload_data['file_name'];
					}
				} else {
					$this->session->set_flashdata('error_msg','Invalid Image Extension');

				}
			}

			// Make DB Query
			$data = array();

			$data['name'] = $this->input->post('name');
			$data['date'] = date('Y-m-d');
			$data['images'] = $imagse;
			$data['cat'] = implode(",",$this->input->post('cat'));
			$data['sub_cat'] = implode(",",$this->input->post('sub_cat'));

			if($this->db->insert('color', $data)) {
				$this->session->set_flashdata('success_msg','Successfully Inserted');
				redirect(base_url('admin/add_color'));
			} else {
				$this->session->set_flashdata('error_msg','Database Error');
				redirect(base_url('admin/add_color'));
			}
		}
	}
	
	public function delete_color($id) {
		

		$this->db->where('id', $id);
		if($this->db->delete('color'))
		{
			$this->session->set_flashdata('success_msg','Successfully Deleted');
			redirect(base_url('admin/add_color'));
		} 
		else
		{
			$this->session->set_flashdata('error_msg','Database Error');
			redirect(base_url('admin/add_color'));
		}
	}
	public function edit_color($id){
		
	   $this->load->helper('form');
	   $this->load->library('form_validation');


		  $query = $this->db->get_where('color', array('id' => $id))->row_array();
		
		  $this->form_validation->set_rules('name', 'name', 'required');
 
		  if ($this->form_validation->run() === FALSE)
		  {
		  $data['color'] = $this->db->get_where('color',array('id' => $id))->row_array();
		  $data['colora'] = $this->db->get('color')->result_array();
		  
		  $this->load->view("Admin/header");
		  $this->load->view("Admin/pages/forms/add_color",$data);
		  $this->load->view("Admin/footer");
			 
		  }
		  else
		  {
		   $imagename =$query['images'];
		   if($_FILES['images']['name'] != "")
		  {
			  $config['upload_path']          = './uploads/color';
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
				'cat' => implode(",",$this->input->post('cat')),
				'sub_cat' => implode(",",$this->input->post('sub_cat')),
												
			 );
	   
		$this->db->where('id',$id);
		$this->db->update('color', $data);
		$this->session->set_flashdata('success_msg','Successfully Update Details');
		redirect(base_url('admin/add_color'));

	   }
     }
	 public function create_catalogue() {
		if($this->session->userdata('aid')=="")
		{
			redirect(base_url('admin/login'));
		}

		$this->load->helper('form');
		$this->load->library('form_validation');

		$this->form_validation->set_rules('title', 'title', 'required');
		

		if ($this->form_validation->run() === FALSE)
		{
			$this->load->view("Admin/header");
			$this->load->view("Admin/pages/forms/add_catalogue");
			$this->load->view("Admin/footer");

		}
		else
		{

			$imagse = "";
			$image_exts = array("tif", "jpg", "gif", "png","pdf");

			//Get Extension of file
			if($_FILES['images']['name']) {
				$path_parts = pathinfo($_FILES["images"]["name"]);
				$ext = $path_parts['extension'];
				if(in_array($ext, $image_exts)) {

					$config['upload_path'] = './uploads/catalogue/';
					$config['allowed_types'] = 'gif|jpg|png|jpeg|pdf';
					$config['file_name'] = uniqid();
					$config['overwrite'] = TRUE;
					$config['max_size'] = '50000';
					$config['max_width'] = '40000';
					$config['max_height'] = '40000';   

					//Load Upload Library
					$this->load->library('upload', $config);
					if (!$this->upload->do_upload('images')) {
						$error = array('error' => $this->upload->display_errors('<div class="alert alert-danger">', '</div>'));
						$this->session->set_flashdata('error_msg',$error['error']);
						
					}
					else {

						$upload_data = $this->upload->data();
						$imagse = $upload_data['file_name'];
					}
				} else {
					$this->session->set_flashdata('error_msg','Invalid Image Extension');

				}
			}
			
			
			$pdf = "";
			$image_exts = array("tif", "jpg", "gif", "png","pdf");

			//Get Extension of file
			if($_FILES['pdf']['name']) {
				$path_parts = pathinfo($_FILES["pdf"]["name"]);
				$ext = $path_parts['extension'];
				if(in_array($ext, $image_exts)) {

					$config['upload_path'] = './uploads/catalogue/';
					$config['allowed_types'] = 'gif|jpg|png|jpeg|pdf';
					$config['file_name'] = uniqid();
					$config['overwrite'] = TRUE;
					$config['max_size'] = '50000';
					$config['max_width'] = '40000';
					$config['max_height'] = '40000';   

					//Load Upload Library
					$this->load->library('upload', $config);
					if (!$this->upload->do_upload('pdf')) {
						$error = array('error' => $this->upload->display_errors('<div class="alert alert-danger">', '</div>'));
						$this->session->set_flashdata('error_msg',$error['error']);
						
					}
					else {

						$upload_data = $this->upload->data();
						$pdf = $upload_data['file_name'];
					}
				} else {
					$this->session->set_flashdata('error_msg','Invalid Image Extension');

				}
			}
			

			// Make DB Query
			$data = array();

			$data['brand'] = $this->input->post('brand');
			$data['title'] = $this->input->post('title');
			$data['date'] = date('Y-m-d');
			$data['images'] = $imagse;
			$data['pdf'] = $pdf;

			if($this->db->insert('catalogue', $data)) {
				$this->session->set_flashdata('success_msg','Successfully Inserted');
				redirect(base_url('admin/create_catalogue'));
			} else {
				$this->session->set_flashdata('error_msg','Database Error');
				redirect(base_url('admin/create_catalogue'));
			}
		}
	}
	public function catalogue_list(){
		if($this->session->userdata('aid')=="")
		{
			redirect(base_url('admin/login'));
		}
		$data['catalogue'] = $this->db->get('catalogue')->result_array();
		$this->load->view('Admin/header');
		$this->load->view('Admin/pages/tables/catalogue_list',$data);
		$this->load->view('Admin/footer');
		
	}
	public function delete_catalogue($id) {
		

		$this->db->where('id', $id);
		if($this->db->delete('catalogue'))
		{
			$this->session->set_flashdata('success_msg','Successfully Deleted');
			redirect(base_url('admin/catalogue_list'));
		} 
		else
		{
			$this->session->set_flashdata('error_msg','Database Error');
			redirect(base_url('admin/catalogue_list'));
		}
	}
	public function edit_catalogue($id){
		
           $this->load->helper('form');
           $this->load->library('form_validation');
    

			  $query = $this->db->get_where('catalogue', array('id' => $id))->row_array();
			
			  $this->form_validation->set_rules('title', 'title', 'required');
	 
			  if ($this->form_validation->run() === FALSE)
			  {
			  $data['catalogue'] = $this->db->get_where('catalogue',array('id' => $id))->row();
			  
			  
			  $this->load->view("Admin/header");
			  $this->load->view("Admin/pages/forms/edit_catalogue",$data);
			  $this->load->view("Admin/footer");
			 
	 
			  }
			  else
			  {
			   $imagename =$query['images'];
			   if($_FILES['images']['name'] != "")
			  {
                  $config['upload_path']          = './uploads/catalogue';
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
			  
			    $pdf =$query['pdf'];
			   if($_FILES['pdf']['name'] != "")
			  {
                  $config['upload_path']          = './uploads/catalogue';
                  $config['allowed_types']        = 'gif|jpg|jpeg|png|pdf|doc';
                  $config['file_name'] = uniqid();
                  $config['max_size']             = 100000;
                  $config['max_width']            = 100000;
                  $config['max_height']           = 100000;

                  $this->load->library('upload', $config);

                  if ( ! $this->upload->do_upload('pdf'))
                  {
                          
                      $this->form_validation->set_error_delimiters('<p class="error">', '</p>');

                      $error = array('error' => $this->upload->display_errors());

                      $this->load->view('upload', $error);
                  }
                  else
                  {
				$pdf =  $this->upload->data('file_name');
                      
                  }
			  }
				 $data = array(
					'images' => $imagename,
					'pdf' => $pdf,
					'brand' => $this->input->post('brand'),
					'title' => $this->input->post('title'),
					
					
				 );
			
            $this->db->where('id',$id);
            $this->db->update('catalogue', $data);
			$this->session->set_flashdata('success_msg','Successfully Update Details');
            redirect(base_url('admin/catalogue_list'));

           }
     }
	 public function create_resellers() {
		if($this->session->userdata('aid')=="")
		{
			redirect(base_url('admin/login'));
		}

		$this->load->helper('form');
		$this->load->library('form_validation');

		$this->form_validation->set_rules('name', 'name', 'required');
		

		if ($this->form_validation->run() === FALSE)
		{
			
			$this->load->view("Admin/header");
			$this->load->view("Admin/pages/forms/add_resellers");
			$this->load->view("Admin/footer");

		}
		else
		{

			// Make DB Query
			$data = array();
			$data['name'] = $this->input->post('name');
			$data['brand'] = $this->input->post('brand');
			$data['address'] = $this->input->post('address');
			$data['contact'] = $this->input->post('contact');
			$data['city'] = $this->input->post('city');
			$data['date'] = date('Y-m-d');
			
			if($this->db->insert('resellers', $data)) {
				$this->session->set_flashdata('success_msg','Successfully Inserted');
				redirect(base_url('admin/create_resellers'));
			} else {
				$this->session->set_flashdata('error_msg','Database Error');
				redirect(base_url('admin/create_resellers'));
			}
		}
	}
	public function resellers_list(){
		if($this->session->userdata('aid')=="")
		{
			redirect(base_url('admin/login'));
		}
		$data['resellers'] = $this->db->get('resellers')->result_array();
		$this->load->view('Admin/header');
		$this->load->view('Admin/pages/tables/resellers_list',$data);
		$this->load->view('Admin/footer');
		
	}
	public function delete_resellers($id) {
		

		$this->db->where('id', $id);
		if($this->db->delete('resellers'))
		{
			$this->session->set_flashdata('success_msg','Successfully Deleted');
			redirect(base_url('admin/resellers_list'));
		} 
		else
		{
			$this->session->set_flashdata('error_msg','Database Error');
			redirect(base_url('admin/resellers_list'));
		}
	}
	public function edit_resellers($id){
		
           $this->load->helper('form');
           $this->load->library('form_validation');
    

			  $query = $this->db->get_where('resellers', array('id' => $id))->row_array();
			
			  $this->form_validation->set_rules('name', 'name', 'required');
	 
			  if ($this->form_validation->run() === FALSE)
			  {
			  $data['resellers'] = $this->db->get_where('resellers',array('id' => $id))->row();
			  
			  $this->load->view("Admin/header");
			  $this->load->view("Admin/pages/forms/edit_resellers",$data);
			  $this->load->view("Admin/footer");
			 
	 		  }
			  else
			  {
			    $data = array(
				 
					'brand' => $this->input->post('brand'),
					'name' => $this->input->post('name'),
					'address' => $this->input->post('address'),
					'city' => $this->input->post('city'),
					'contact' => $this->input->post('contact'),
				 );
           
            $this->db->where('id',$id);
            $this->db->update('resellers', $data);
			$this->session->set_flashdata('success_msg','Successfully Update Details');
            redirect(base_url('admin/resellers_list'));

           }
     }
	 public function banner_list(){
		if($this->session->userdata('aid')=="")
		{
			redirect(base_url('admin/login'));
		}
		$data['banner'] = $this->db->get('banner')->result_array();
		$this->load->view('Admin/header');
		$this->load->view('Admin/pages/tables/banner_list',$data);
		$this->load->view('Admin/footer');
		
	}
	public function edit_banner($id){
		
           $this->load->helper('form');
           $this->load->library('form_validation');
    

			  $query = $this->db->get_where('banner', array('id' => $id))->row_array();
			
			  $this->form_validation->set_rules('url', 'url', 'required');
	 
			  if ($this->form_validation->run() === FALSE)
			  {
			  $data['banner'] = $this->db->get_where('banner',array('id' => $id))->row();
			  
			  
			  $this->load->view("Admin/header");
			  $this->load->view("Admin/pages/forms/edit_banner",$data);
			  $this->load->view("Admin/footer");
			 
	 
			  }
			  else
			  {
			  $imagename =$query['images'];
			  if($_FILES['images']['name'] != "")
			  {
                  $config['upload_path']          = './uploads/banner';
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
					'url' => $this->input->post('url'),
					
				 );
			
            $this->db->where('id',$id);
            $this->db->update('banner', $data);
			$this->session->set_flashdata('success_msg','Successfully Update Details');
            redirect(base_url('admin/banner_list'));

           }
     }
	 public function design_list(){
		if($this->session->userdata('aid')=="")
		{
			redirect(base_url('admin/login'));
		}
		$data['design'] = $this->db->get('design')->result_array();
		$this->load->view('Admin/header');
		$this->load->view('Admin/pages/tables/design_list',$data);
		$this->load->view('Admin/footer');
		
	}
	public function edit_design($id){
		
           $this->load->helper('form');
           $this->load->library('form_validation');
    

			  $query = $this->db->get_where('design', array('id' => $id))->row_array();
			
			  $this->form_validation->set_rules('title', 'title', 'required');
	 
			  if ($this->form_validation->run() === FALSE)
			  {
			  $data['design'] = $this->db->get_where('design',array('id' => $id))->row();
			  
			  
			  $this->load->view("Admin/header");
			  $this->load->view("Admin/pages/forms/edit_design",$data);
			  $this->load->view("Admin/footer");
			 
	 
			  }
			  else
			  {
			  $imagename =$query['images'];
			  if($_FILES['images']['name'] != "")
			  {
                  $config['upload_path']          = './uploads/design';
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
					'title' => $this->input->post('title'),
					'url' => $this->input->post('url'),
					
				 );
			
            $this->db->where('id',$id);
            $this->db->update('design', $data);
			$this->session->set_flashdata('success_msg','Successfully Update Details');
            redirect(base_url('admin/design_list'));

           }
     }
	 public function ads_list(){
		if($this->session->userdata('aid')=="")
		{
			redirect(base_url('admin/login'));
		}
		$data['ads'] = $this->db->get('ads')->result_array();
		$this->load->view('Admin/header');
		$this->load->view('Admin/pages/tables/ads_list',$data);
		$this->load->view('Admin/footer');
		
	}
	public function edit_ads($id){
		
           $this->load->helper('form');
           $this->load->library('form_validation');
    

			  $query = $this->db->get_where('ads', array('id' => $id))->row_array();
			
			  $this->form_validation->set_rules('url', 'url', 'required');
	 
			  if ($this->form_validation->run() === FALSE)
			  {
			  $data['ads'] = $this->db->get_where('ads',array('id' => $id))->row();
			  
			  
			  $this->load->view("Admin/header");
			  $this->load->view("Admin/pages/forms/edit_ads",$data);
			  $this->load->view("Admin/footer");
			 
	 
			  }
			  else
			  {
			  $imagename =$query['images'];
			  if($_FILES['images']['name'] != "")
			  {
                  $config['upload_path']          = './uploads/ads';
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
					
					'url' => $this->input->post('url'),
					
				 );
			
            $this->db->where('id',$id);
            $this->db->update('ads', $data);
			$this->session->set_flashdata('success_msg','Successfully Update Details');
            redirect(base_url('admin/ads_list'));

           }
     }
	 public function get_number(){
		$data['number'] = $this->db->get('get_number')->result_array();
		$this->load->view('Admin/header');
		$this->load->view('Admin/pages/tables/get_number',$data);
		$this->load->view('Admin/footer');
	 }
	 
	 public function color_fetch()
            {
            
            header("Content-type:application/json");
            
            $sid = $this->input->post('s_id');
            $did = $this->input->post('d_id');
            
            $color = $this->db->get_where("color", array("cname" => $sid, "sname" => $did ))->result_array();
            
            
            $html = "";
            foreach ($color as $key => $co) {
                $html .= "
                    <div class='col-md-4'>
					   <div class='form-check'>
						  <label class='form-check-label'>
						  <input type='checkbox' class='form-check-input' name='color[]' value='".$co['id']."' >
						  ".$co['name']."   ";
				$html .="
						  <i class='input-helper'></i></label>
					   </div>
					</div>
					<div class='col-md-4'>
					   <div class='form-group'>
						  <input id='Text' class='form-control' type='text' name='color_code[]' placeholder='Enter Text'>
					   </div>
					</div>
					<div class='col-md-4'> ";
					 $html .="
					   <img src='".base_url('uploads/color/'.$co['images'])."' style='width: 11%;'>
					</div>
                ";
            }
            $data['html'] = $html;
            echo json_encode($data);
     }
	 public function upload_files1($i){
		 
        $config = array(
            'upload_path'   => 'uploads/color',
            'allowed_types' => 'jpg|gif|png',
            'overwrite'     => 1,
        );

        $this->load->library('upload', $config);
        $images = [];
        $images = array();

       
            $_FILES['image']['name']     = $_FILES['img_'.$i]['name'];
            $_FILES['image']['type']     = $_FILES['img_'.$i]['type'];
            $_FILES['image']['tmp_name']    = $_FILES['img_'.$i]['tmp_name'];
            $_FILES['image']['error']     = $_FILES['img_'.$i]['error'];
            $_FILES['image']['size']     = $_FILES['img_'.$i]['size'];

            $fileName = time() .'_'. $_FILES['img_'.$i]['name'];

            $images[] = $fileName;

            $_POST['img_'.$i] = $fileName;
            $config['file_name'] = $fileName;

            $this->upload->initialize($config);

            if ($this->upload->do_upload('image')) {
                $fileData = $this->upload->data('file_name');
                return $fileData;
            } else {
                $error = array('error' => $this->upload->display_errors());
                return false;
            }
      

     }
     	
	 public function create_product() {
		if($this->session->userdata('aid')=="")
		{
			redirect(base_url('admin/login'));
		}

		$this->load->helper('form');
		$this->load->library('form_validation');

		$this->form_validation->set_rules('product_name', 'product_name', 'required');
		

		if ($this->form_validation->run() === FALSE)
		{
			
			$this->load->view("Admin/header");
			$this->load->view("Admin/pages/forms/add_product");
			$this->load->view("Admin/footer");

		}
		else
		{
			
			/* $catalogues = array();
			if ($_FILES['catalogues']['name']) {
				//echo "image detected";
				if (is_array($_FILES['catalogues']['name'])) {
					$filesCount = count($_FILES['catalogues']['name']);
					for ($i = 0;$i < $filesCount;$i++) {
						$_FILES['file']['name'] = $_FILES['catalogues']['name'][$i];
						$_FILES['file']['type'] = $_FILES['catalogues']['type'][$i];
						$_FILES['file']['tmp_name'] = $_FILES['catalogues']['tmp_name'][$i];
						$_FILES['file']['error'] = $_FILES['catalogues']['error'][$i];
						$_FILES['file']['size'] = $_FILES['catalogues']['size'][$i];
						// File upload configuration
						$config['upload_path'] = './uploads/product';
						$config['allowed_types'] = 'gif|jpg|png|jpeg|pdf|dwg|dxf|dwf';
						$config['file_name'] = uniqid();
						$config['overwrite'] = TRUE;
						// Load and initialize upload library
						$this->load->library('upload');
						$this->upload->initialize($config);
						// Upload file to server
						if ($this->upload->do_upload('file')) {
							// Uploaded file data
							$fileData = $this->upload->data();
							  
							array_push($catalogues, $fileData['file_name']);
							
							
						} else {
							$error = array('error' => $this->upload->display_errors('<div class="alert alert-danger">', '</div>'));
							$this->session->set_flashdata('error', $error['error']);
						}
					}
				}
				 //print_r($catalogues);
				
			} */
			// exit();
			$cad = array();
			if ($_FILES['cad']['name']) {
				//echo "image detected";
				if (is_array($_FILES['cad']['name'])) {
					$filesCount = count($_FILES['cad']['name']);
					for ($i = 0;$i < $filesCount;$i++) {
						$_FILES['file']['name'] = $_FILES['cad']['name'][$i];
						$_FILES['file']['type'] = $_FILES['cad']['type'][$i];
						$_FILES['file']['tmp_name'] = $_FILES['cad']['tmp_name'][$i];
						$_FILES['file']['error'] = $_FILES['cad']['error'][$i];
						$_FILES['file']['size'] = $_FILES['cad']['size'][$i];
						// File upload configuration
						$config['upload_path'] = './uploads/product';
						$config['allowed_types'] = 'gif|jpg|png|jpeg|pdf|dwg|dxf|dwf';
						$config['file_name'] = uniqid();
						$config['overwrite'] = TRUE;
						// Load and initialize upload library
						$this->load->library('upload');
						$this->upload->initialize($config);
						// Upload file to server
						if ($this->upload->do_upload('file')) {
							// Uploaded file data
							$fileData = $this->upload->data();
							array_push($cad, $fileData['file_name']);
							
							
							
						} else {
							$error = array('error' => $this->upload->display_errors('<div class="alert alert-danger">', '</div>'));
							$this->session->set_flashdata('error', $error['error']);
						}
						
					}
				}
			
			}
			$product_image = array();
			if ($_FILES['product_image']['name']) {
				//echo "image detected";
				if (is_array($_FILES['product_image']['name'])) {
					$filesCount = count($_FILES['product_image']['name']);
					for ($i = 0;$i < $filesCount;$i++) {
						$_FILES['file']['name'] = $_FILES['product_image']['name'][$i];
						$_FILES['file']['type'] = $_FILES['product_image']['type'][$i];
						$_FILES['file']['tmp_name'] = $_FILES['product_image']['tmp_name'][$i];
						$_FILES['file']['error'] = $_FILES['product_image']['error'][$i];
						$_FILES['file']['size'] = $_FILES['product_image']['size'][$i];
						// File upload configuration
						$config['upload_path'] = './uploads/product';
						$config['allowed_types'] = 'gif|jpg|png|jpeg|pdf|dwg|dxf|dwf';
						$config['file_name'] = uniqid();
						$config['overwrite'] = TRUE;
						// Load and initialize upload library
						$this->load->library('upload');
						$this->upload->initialize($config);
						// Upload file to server
						if ($this->upload->do_upload('file')) {
							// Uploaded file data
							$fileData = $this->upload->data();
							array_push($product_image, $fileData['file_name']);
							
							
							
						} else {
							$error = array('error' => $this->upload->display_errors('<div class="alert alert-danger">', '</div>'));
							$this->session->set_flashdata('error', $error['error']);
						}
						
					}
				}
			
			}
			
			$d_image = "";
			$image_exts = array("tif", "jpg", "gif", "png" ,"jpeg","pdf","dwg","dxf","dwf");

			//Get Extension of file
			if($_FILES['d_image']['name']) {
				$path_parts = pathinfo($_FILES["d_image"]["name"]);
				$ext = $path_parts['extension'];
				if(in_array($ext, $image_exts)) {

					$config['upload_path'] = './uploads/product/';
					$config['allowed_types'] = 'gif|jpg|png|jpeg|pdf|dwg|dxf|dwf';
					$config['file_name'] = uniqid();
					$config['overwrite'] = TRUE;
					$config['max_size'] = '50000';
					$config['max_width'] = '40000';
					$config['max_height'] = '40000';   

					//Load Upload Library
					$this->load->library('upload', $config);
					if (!$this->upload->do_upload('d_image')) {
						$error = array('error' => $this->upload->display_errors('<div class="alert alert-danger">', '</div>'));
						$this->session->set_flashdata('error_msg',$error['error']);
						
					}
					else {

						$upload_data = $this->upload->data();
						$d_image = $upload_data['file_name'];
					}
				} else {
					$this->session->set_flashdata('error_msg','Invalid Image Extension');

				}
			}
			
			// Make DB Query
			$data = array();
			$data['cname'] = $this->input->post('cname');
			$data['sname'] = $this->input->post('sname');
			$data['brand'] = $this->input->post('brand');
			
			$data['product_name'] = $this->input->post('product_name');	
			$data['collection'] = $this->input->post('collection');
			$data['c_origin'] = $this->input->post('c_origin');			
			$data['manufacture_year'] = $this->input->post('manufacture_year');			
			$data['designer'] = $this->input->post('designer');						
			$data['price_range'] = $this->input->post('price_range');	 					
			$data['lenth_width'] = $this->input->post('lenth_width');
			$data['height'] = $this->input->post('height');						
			$data['l_w_h'] = $this->input->post('l_w_h');						
			$data['thickness_input'] = $this->input->post('thickness_input'); 						
			$data['area'] = $this->input->post('area');			
			$data['sku'] = $this->input->post('sku');			
			$data['description'] = $this->input->post('description');
			$data['tags'] = implode(",",$this->input->post('tags'));
			$data['color'] = implode(",",$this->input->post('color'));			
			$data['sensor'] = $this->input->post('sensor');						
			$data['indoor_outdoor'] = $this->input->post('indoor_outdoor');						
			$data['installation'] = implode(",",$this->input->post('installation'));			
			$data['application'] = implode(",",$this->input->post('application'));
			$data['material'] = implode(",",$this->input->post('material'));
			$data['shape'] = implode(",",$this->input->post('shape'));						
			$data['effects'] = implode(",",$this->input->post('effects'));						
			$data['finish'] = implode(",",$this->input->post('finish'));			
			$data['size'] = implode(",",$this->input->post('size'));					
			$data['thickness'] = implode(",",$this->input->post('thickness'));			
			$data['type'] = implode(",",$this->input->post('type'));			
			$data['themes'] = implode(",",$this->input->post('themes'));			
			$data['light_bulb'] = implode(",",$this->input->post('light_bulb'));						
			$data['number_of_seat'] = implode(",",$this->input->post('number_of_seat'));						
			$data['bed_size'] = implode(",",$this->input->post('bed_size'));			
			$data['bowl'] = implode(",",$this->input->post('bowl'));					
			$data['d_image'] = $d_image;
			if(!empty($product_image)) {
			$data['product_image'] = implode(",", $product_image); 
			}
			/* if(!empty($catalogues)) {
			$data['catalogues'] = implode(",", $catalogues); 
			} */
			if(!empty($cad)) {
			$data['cad'] = implode(",", $cad); 
			}			
			$data['date'] = date('Y-m-d');
			
			if($this->db->insert('product', $data)) 
			{	
			    
			$insert_id = $this->db->insert_id();
			$video_link = count($this->input->post('video_link'));	
			for($i = 0; $i <$video_link;$i++) {									 
			$dataa['videolink'] = $this->input->post('video_link')[$i];			
			$dataa['product_id'] = $insert_id;				  				 
			$this->db->insert('product_video', $dataa);									
			}														
			$variant_name = count($this->input->post('variant_name'));
			for($i = 0; $i <$variant_name;$i++)
				{									
			$dataab['variant_name'] = $this->input->post('variant_name')[$i];	
			$dataab['variant_code'] = $this->input->post('variant_code')[$i];
			
			$dataab['product_id'] = $insert_id;	

			$variant_image = $this->upload_files1($i);
			
			$dataab['variant_image'] = $variant_image;
			$this->db->insert('product_color', $dataab); 	
			}								
				$this->session->set_flashdata('success_msg','Successfully Inserted');
				redirect(base_url('admin/create_product'));
			} 
			else 
			{
				$this->session->set_flashdata('error_msg','Database Error');
				redirect(base_url('admin/create_product'));
			}
		}
	}	
	public function product_list(){	
		if($this->session->userdata('aid')=="")	
		{			
			redirect(base_url('admin/login'));
		}		
			$data['product'] = $this->db->get('product')->result_array();
			$this->load->view('Admin/header');
			$this->load->view('Admin/pages/tables/product_list',$data);
			$this->load->view('Admin/footer');	
	}
	public function brand_wise_product($id){	
		if($this->session->userdata('aid')=="")	
		{			
			redirect(base_url('admin/login'));
		}		
			$data['product'] = $this->db->get_where('product',array('brand' => $id))->result_array();
			$this->load->view('Admin/header');
			$this->load->view('Admin/pages/tables/product_list',$data);
			$this->load->view('Admin/footer');	
	}
	
	public function delete_product($id) {		
		$this->db->where('id', $id);
		if($this->db->delete('product'))	
		{		
			$this->session->set_flashdata('success_msg','Successfully Deleted');
			redirect(base_url('admin/product_list'));	
		} 		
		else	
		{	
			$this->session->set_flashdata('error_msg','Database Error');
			redirect(base_url('admin/product_list'));	
		}	
	}
	public function city_list() {
		if($this->session->userdata('aid')=="")
		{
			redirect(base_url('admin/login'));
		}

		$this->load->helper('form');
		$this->load->library('form_validation');

		$this->form_validation->set_rules('city', 'city', 'required');
		

		if ($this->form_validation->run() === FALSE)
		{
			$data['city'] = $this->db->get('city')->result_array();
			$this->load->view("Admin/header");
			$this->load->view("Admin/pages/tables/city_list",$data);
			$this->load->view("Admin/footer");

		}
		else
		{

			// Make DB Query
			$data = array();
			$data['city'] = $this->input->post('city');
			$data['date'] = date('Y-m-d');
			
			if($this->db->insert('city', $data)) {
				$this->session->set_flashdata('success_msg','Successfully Inserted');
				redirect(base_url('admin/city_list'));
			} else {
				$this->session->set_flashdata('error_msg','Database Error');
				redirect(base_url('admin/city_list'));
			}
		}
	}
	public function edit_city($id){
		
           $this->load->helper('form');
           $this->load->library('form_validation');
    

			  $query = $this->db->get_where('city', array('id' => $id))->row_array();
			
			  $this->form_validation->set_rules('city', 'city', 'required');
	 
			  if ($this->form_validation->run() === FALSE)
			  {
			  $data['citya'] = $this->db->get_where('city',array('id' => $id))->row();
			  
			  $data['city'] = $this->db->get('city')->result_array();
			  $this->load->view("Admin/header");
			  $this->load->view("Admin/pages/tables/city_list",$data);
			  $this->load->view("Admin/footer");
			 
	 		  }
			  else
			  {
			    $data = array(
				 
					'city' => $this->input->post('city'),
				 );
           
            $this->db->where('id',$id);
            $this->db->update('city', $data);
			$this->session->set_flashdata('success_msg','Successfully Update Details');
            redirect(base_url('admin/city_list'));

           }
     }	
	 public function delete_city($id) {		
		$this->db->where('id', $id);
		if($this->db->delete('city'))	
		{		
			$this->session->set_flashdata('success_msg','Successfully Deleted');
			redirect(base_url('admin/city_list'));	
		} 		
		else	
		{	
			$this->session->set_flashdata('error_msg','Database Error');
			redirect(base_url('admin/city_list'));	
		}	
	}
	public function update_installation(){
		
		 $data = array(
				 
					'cat' => implode(",",$this->input->post('categories')),
					'sub_cat' => implode(",",$this->input->post('subcategories')),
				 );
           
         $this->db->where('id',1);
         $this->db->update('filter', $data);
		 $this->session->set_flashdata('installation','Successfully Update');
		 redirect(base_url('admin/installation'));	
	}
	public function update_application(){
		
		 $data = array(
				 
					'cat' => implode(",",$this->input->post('categories')),
					'sub_cat' => implode(",",$this->input->post('subcategories')),
				 );
           
         $this->db->where('id',2);
         $this->db->update('filter', $data);
		 $this->session->set_flashdata('application','Successfully Update');
		 redirect(base_url('admin/application'));	
	}
	public function update_material(){
		
		 $data = array(
				 
					'cat' => implode(",",$this->input->post('categories')),
					'sub_cat' => implode(",",$this->input->post('subcategories')),
				 );
           
         $this->db->where('id',3);
         $this->db->update('filter', $data);
		 $this->session->set_flashdata('material','Successfully Update');
		 redirect(base_url('admin/material'));	
	}
	public function update_shape(){
		
		 $data = array(
				 
					'cat' => implode(",",$this->input->post('categories')),
					'sub_cat' => implode(",",$this->input->post('subcategories')),
				 );
           
         $this->db->where('id',4);
         $this->db->update('filter', $data);
		 $this->session->set_flashdata('shape','Successfully Update');
		 redirect(base_url('admin/shape'));	
	}
	public function update_effects(){
		
		 $data = array(
				 
					'cat' => implode(",",$this->input->post('categories')),
					'sub_cat' => implode(",",$this->input->post('subcategories')),
				 );
           
         $this->db->where('id',5);
         $this->db->update('filter', $data);
		 $this->session->set_flashdata('effects','Successfully Update');
		 redirect(base_url('admin/effects'));	
	}
	public function update_finish(){
		
		 $data = array(
				 
					'cat' => implode(",",$this->input->post('categories')),
					'sub_cat' => implode(",",$this->input->post('subcategories')),
				 );
           
         $this->db->where('id',6);
         $this->db->update('filter', $data);
		 $this->session->set_flashdata('finish','Successfully Update');
		 redirect(base_url('admin/finish'));	
	}
	public function update_size(){
		
		 $data = array(
				 
					'cat' => implode(",",$this->input->post('categories')),
					'sub_cat' => implode(",",$this->input->post('subcategories')),
				 );
           
         $this->db->where('id',7);
         $this->db->update('filter', $data);
		 $this->session->set_flashdata('size','Successfully Update');
		 redirect(base_url('admin/size'));	
	}
	public function update_thickness(){
		
		 $data = array(
				 
					'cat' => implode(",",$this->input->post('categories')),
					'sub_cat' => implode(",",$this->input->post('subcategories')),
				 );
           
         $this->db->where('id',8);
         $this->db->update('filter', $data);
		 $this->session->set_flashdata('thickness','Successfully Update');
		 redirect(base_url('admin/thickness'));	
	}
	public function update_type(){
		
		 $data = array(
				 
					'cat' => implode(",",$this->input->post('categories')),
					'sub_cat' => implode(",",$this->input->post('subcategories')),
				 );
           
         $this->db->where('id',9);
         $this->db->update('filter', $data);
		 $this->session->set_flashdata('type','Successfully Update');
		 redirect(base_url('admin/type'));	
	}
	public function update_themes(){
		
		 $data = array(
				 
					'cat' => implode(",",$this->input->post('categories')),
					'sub_cat' => implode(",",$this->input->post('subcategories')),
				 );
           
         $this->db->where('id',10);
         $this->db->update('filter', $data);
		 $this->session->set_flashdata('themes','Successfully Update');
		 redirect(base_url('admin/themes'));	
	}
	public function update_l_b_t(){
		
		 $data = array(
				 
					'cat' => implode(",",$this->input->post('categories')),
					'sub_cat' => implode(",",$this->input->post('subcategories')),
				 );
           
         $this->db->where('id',11);
         $this->db->update('filter', $data);
		 $this->session->set_flashdata('light_bulb_type','Successfully Update');
		 redirect(base_url('admin/light_bulb_type'));	
	}
	public function update_n_o_s(){
		
		 $data = array(
				 
					'cat' => implode(",",$this->input->post('categories')),
					'sub_cat' => implode(",",$this->input->post('subcategories')),
				 );
           
         $this->db->where('id',12);
         $this->db->update('filter', $data);
		 $this->session->set_flashdata('number_of_seat','Successfully Update');
		 redirect(base_url('admin/number_of_seat'));	
	}
	public function update_b_s(){
		
		 $data = array(
				 
					'cat' => implode(",",$this->input->post('categories')),
					'sub_cat' => implode(",",$this->input->post('subcategories')),
				 );
           
         $this->db->where('id',13);
         $this->db->update('filter', $data);
		 $this->session->set_flashdata('bed_size','Successfully Update');
		 redirect(base_url('admin/bed_size'));	
	}
	public function update_bowl(){
		
		 $data = array(
				 
					'cat' => implode(",",$this->input->post('categories')),
					'sub_cat' => implode(",",$this->input->post('subcategories')),
				 );
           
         $this->db->where('id',14);
         $this->db->update('filter', $data);
		 $this->session->set_flashdata('bowl','Successfully Update');
		 redirect(base_url('admin/bowl'));	
	}
	public function update_color(){
		
		 $data = array(
				 
					'cat' => implode(",",$this->input->post('categories')),
					'sub_cat' => implode(",",$this->input->post('subcategories')),
				 );
           
         $this->db->where('id',15);
         $this->db->update('filter', $data);
		 $this->session->set_flashdata('add_color','Successfully Update');
		 redirect(base_url('admin/add_color'));	
	}
	public function edit_product($id){
		
           $this->load->helper('form');
           $this->load->library('form_validation');
    

          $query = $this->db->get_where('product',array('id'=>$id))->row_array();
        
          $this->form_validation->set_rules('product_name', 'product_name', 'required');
 
          if ($this->form_validation->run() === FALSE)
          {
			$data['product'] = $this->db->get_where('product',array('id'=>$id))->row_array();
          
			$this->load->view("Admin/header");
			$this->load->view("Admin/pages/forms/edit_product",$data);
			$this->load->view("Admin/footer");
         
 
		  }
          else
          {
          /*  $imagename =$query['catalogues'];
           $res_image = array();
			if ($_FILES['catalogues']['name'][0] != "") {
            //echo "image detected";
            if (is_array($_FILES['catalogues']['name'])) {
                $filesCount = count($_FILES['catalogues']['name']);
                for ($i = 0;$i < $filesCount;$i++) {
                    $_FILES['filec']['name'] = $_FILES['catalogues']['name'][$i];
                    $_FILES['filec']['type'] = $_FILES['catalogues']['type'][$i];
                    $_FILES['filec']['tmp_name'] = $_FILES['catalogues']['tmp_name'][$i];
                    $_FILES['filec']['error'] = $_FILES['catalogues']['error'][$i];
                    $_FILES['filec']['size'] = $_FILES['catalogues']['size'][$i];
                    // File upload configuration
                    $config['upload_path'] = './uploads/product';
					$config['allowed_types'] = 'gif|jpg|png|jpeg|pdf|dwg|dxf|dwf';
                    $config['file_name'] = uniqid();
                    $config['overwrite'] = TRUE;
                    // Load and initialize upload library
                    $this->load->library('upload');
                    $this->upload->initialize($config);
                    // Upload file to server
                    if ($this->upload->do_upload('filec')) {
                        // Uploaded file data
                        $fileData = $this->upload->data();
                        array_push($res_image, $fileData['file_name']);
                        //$res_image = $fileData['file_name'];
                        
                    } else {
                        $error = array('error' => $this->upload->display_errors('<div class="alert alert-danger">', '</div>'));
                        $this->session->set_flashdata('error', $error['error']);
                    }
                }
                $res_imagea = implode(",", $res_image);
            }
        } 
		else   
		{
            $res_imagea = $imagename;
        } */
		
		$cadnameabc =$query['cad'];
           $cadname = array();
			if ($_FILES['cad']['name'][0] != "") {
            //echo "image detected";
            if (is_array($_FILES['cad']['name'])) {
                $filesCount = count($_FILES['cad']['name']);
                for ($i = 0;$i < $filesCount;$i++) {
                    $_FILES['file']['name'] = $_FILES['cad']['name'][$i];
                    $_FILES['file']['type'] = $_FILES['cad']['type'][$i];
                    $_FILES['file']['tmp_name'] = $_FILES['cad']['tmp_name'][$i];
                    $_FILES['file']['error'] = $_FILES['cad']['error'][$i];
                    $_FILES['file']['size'] = $_FILES['cad']['size'][$i];
                    // File upload configuration
                    $config['upload_path'] = './uploads/product';
					$config['allowed_types'] = 'gif|jpg|png|jpeg|pdf|dwg|dxf|dwf';
                    $config['file_name'] = uniqid();
                    $config['overwrite'] = TRUE;
                    // Load and initialize upload library
                    $this->load->library('upload');
                    $this->upload->initialize($config);
                    // Upload file to server
                    if ($this->upload->do_upload('file')) {
                        // Uploaded file data
                        $fileData = $this->upload->data();
                        array_push($cadname, $fileData['file_name']);
                        //$res_image = $fileData['file_name'];
                        
                    } else {
                        $error = array('error' => $this->upload->display_errors('<div class="alert alert-danger">', '</div>'));
                        $this->session->set_flashdata('error', $error['error']);
                    }
                }
                $cadnamea = implode(",", $cadname);
            }
        } 
		else   
		{
            $cadnamea = $cadnameabc;
        }
		
		
		$product_imageabc =$query['product_image'];
           $product_imagea = array();
			if ($_FILES['product_image']['name'][0] != "") {
            //echo "image detected";
            if (is_array($_FILES['product_image']['name'])) {
                $filesCount = count($_FILES['product_image']['name']);
                for ($i = 0;$i < $filesCount;$i++) {
                    $_FILES['file']['name'] = $_FILES['product_image']['name'][$i];
                    $_FILES['file']['type'] = $_FILES['product_image']['type'][$i];
                    $_FILES['file']['tmp_name'] = $_FILES['product_image']['tmp_name'][$i];
                    $_FILES['file']['error'] = $_FILES['product_image']['error'][$i];
                    $_FILES['file']['size'] = $_FILES['product_image']['size'][$i];
                    // File upload configuration
                    $config['upload_path'] = './uploads/product';
					$config['allowed_types'] = 'gif|jpg|png|jpeg|pdf|dwg|dxf|dwf';
                    $config['file_name'] = uniqid();
                    $config['overwrite'] = TRUE;
                    // Load and initialize upload library
                    $this->load->library('upload');
                    $this->upload->initialize($config);
                    // Upload file to server
                    if ($this->upload->do_upload('file')) {
                        // Uploaded file data
                        $fileData = $this->upload->data();
                        array_push($product_imagea, $fileData['file_name']);
                        //$res_image = $fileData['file_name'];
                        
                    } else {
                        $error = array('error' => $this->upload->display_errors('<div class="alert alert-danger">', '</div>'));
                        $this->session->set_flashdata('error', $error['error']);
                    }
                }
                $pname = implode(",", $product_imagea);
            }
        } 
		else   
		{
            $pname = $product_imageabc;
        }
		
		
		$d_imagename =$query['d_image'];
           if($_FILES['d_image']['name'] != "")
          {
                  $config['upload_path']          = './uploads/product';
                  $config['allowed_types']        = 'gif|jpg|png|jpeg|pdf|dwg|dxf|dwf';
                  $config['file_name'] = uniqid();
                  $config['max_size']             = 100000;
                  $config['max_width']            = 100000;
                  $config['max_height']           = 100000;

                  $this->load->library('upload', $config);

                  if ( ! $this->upload->do_upload('d_image'))
                  {
                          
                      $this->form_validation->set_error_delimiters('<p class="error">', '</p>');

                      $error = array('error' => $this->upload->display_errors());

                      $this->load->view('upload', $error);
                  }
                  else
                  {
					$d_imagename =  $this->upload->data('file_name');
                      
                  }
          }



             $data = array(
             	//'catalogues' => $res_imagea,
             	'd_image' => $d_imagename,
             	'cad' => $cadnamea,
             	'product_image' => $pname,
             	'product_name' => $this->input->post('product_name'), 
				'cname' => $this->input->post('cname'),
				'sname' => $this->input->post('sname'),
				'brand' => $this->input->post('brand'),
				'collection' => $this->input->post('collection'),
				'c_origin' => $this->input->post('c_origin'),			
				'manufacture_year' => $this->input->post('manufacture_year'),			
				'designer' => $this->input->post('designer'),						
				'price_range' => $this->input->post('price_range'), 					
				'lenth_width' => $this->input->post('lenth_width'),
				'height' => $this->input->post('height'),						
				'l_w_h' => $this->input->post('l_w_h'),						
				'thickness_input' => $this->input->post('thickness_input'), 						
				'area' => $this->input->post('area'),			
				'sku' => $this->input->post('sku'),			
				'description' => $this->input->post('description'),
				'tags' => implode(",",$this->input->post('tags')),
				'color' => implode(",",$this->input->post('color')),			
				'sensor' => $this->input->post('sensor'),						
				'indoor_outdoor' => $this->input->post('indoor_outdoor'),						
				'installation' => implode(",",$this->input->post('installation')),			
				'application' => implode(",",$this->input->post('application')),
				'material' => implode(",",$this->input->post('material')),
				'shape' => implode(",",$this->input->post('shape')),						
				'effects' => implode(",",$this->input->post('effects')),						
				'finish' => implode(",",$this->input->post('finish')),			
				'size' => implode(",",$this->input->post('size')),					
				'thickness' => implode(",",$this->input->post('thickness')),			
				'type' => implode(",",$this->input->post('type')),			
				'themes' => implode(",",$this->input->post('themes')),			
				'light_bulb' => implode(",",$this->input->post('light_bulb')),						
				'number_of_seat' => implode(",",$this->input->post('number_of_seat')),						
				'bed_size' => implode(",",$this->input->post('bed_size')),			
				'bowl' => implode(",",$this->input->post('bowl')),
				
				
			);
           

            $this->db->where('id',$id);
            $update = $this->db->update('product', $data);
            if($update)
            {
                
                $this->db->where('product_id',$id);
                $this->db->delete('product_video');
                
                $this->db->where('product_id',$id);
                $this->db->delete('product_color');
                
                $insert_id = $id;
    			$video_link = count($this->input->post('video_link'));	
    			for($i = 0; $i <$video_link;$i++) {									 
    			$dataa['videolink'] = $this->input->post('video_link')[$i];			
    			$dataa['product_id'] = $insert_id;				  				 
    			$this->db->insert('product_video', $dataa);									
    			}
				if(!empty($this->input->post('variant_name'))) {
    			$variant_name = count($this->input->post('variant_name'));
    			for($i = 0; $i <$variant_name;$i++)
    				{									
    			$dataab['variant_name'] = $this->input->post('variant_name')[$i];	
    			$dataab['variant_code'] = $this->input->post('variant_code')[$i];
    			
    			$dataab['product_id'] = $insert_id;	
    
    			$variant_image = $this->upload_files1($i);
    			
    			$dataab['variant_image'] = $variant_image;
    			$this->db->insert('product_color', $dataab); 
                }
				}
				else{
					$variant_name = "";
				}
				
            }
			$this->session->set_flashdata('success_msg','Successfully Update Details');
            redirect(base_url('admin/product_list'));

          }
     }
	 public function copy_product($id) {
		if($this->session->userdata('aid')=="")
		{
			redirect(base_url('admin/login'));
		}

		$this->load->helper('form');
		$this->load->library('form_validation');

		$this->form_validation->set_rules('product_name', 'product_name', 'required');
		

		if ($this->form_validation->run() === FALSE)
		{
			$data['product'] = $this->db->get_where('product',array('id'=>$id))->row_array();
			$this->load->view("Admin/header");
			$this->load->view("Admin/pages/forms/copy_product",$data);
			$this->load->view("Admin/footer");

		}
		else
		{
			
			/* $catalogues = array();
			if ($_FILES['catalogues']['name']) {
				//echo "image detected";
				if (is_array($_FILES['catalogues']['name'])) {
					$filesCount = count($_FILES['catalogues']['name']);
					for ($i = 0;$i < $filesCount;$i++) {
						$_FILES['file']['name'] = $_FILES['catalogues']['name'][$i];
						$_FILES['file']['type'] = $_FILES['catalogues']['type'][$i];
						$_FILES['file']['tmp_name'] = $_FILES['catalogues']['tmp_name'][$i];
						$_FILES['file']['error'] = $_FILES['catalogues']['error'][$i];
						$_FILES['file']['size'] = $_FILES['catalogues']['size'][$i];
						// File upload configuration
						$config['upload_path'] = './uploads/product';
						$config['allowed_types'] = 'gif|jpg|png|jpeg|pdf|dwg|dxf|dwf';
						$config['file_name'] = uniqid();
						$config['overwrite'] = TRUE;
						// Load and initialize upload library
						$this->load->library('upload');
						$this->upload->initialize($config);
						// Upload file to server
						if ($this->upload->do_upload('file')) {
							// Uploaded file data
							$fileData = $this->upload->data();
							  
							array_push($catalogues, $fileData['file_name']);
							
							
						} else {
							$error = array('error' => $this->upload->display_errors('<div class="alert alert-danger">', '</div>'));
							$this->session->set_flashdata('error', $error['error']);
						}
					}
				}
				 //print_r($catalogues);
				
			} */
			// exit();
			$cad = array();
			if ($_FILES['cad']['name']) {
				//echo "image detected";
				if (is_array($_FILES['cad']['name'])) {
					$filesCount = count($_FILES['cad']['name']);
					for ($i = 0;$i < $filesCount;$i++) {
						$_FILES['file']['name'] = $_FILES['cad']['name'][$i];
						$_FILES['file']['type'] = $_FILES['cad']['type'][$i];
						$_FILES['file']['tmp_name'] = $_FILES['cad']['tmp_name'][$i];
						$_FILES['file']['error'] = $_FILES['cad']['error'][$i];
						$_FILES['file']['size'] = $_FILES['cad']['size'][$i];
						// File upload configuration
						$config['upload_path'] = './uploads/product';
						$config['allowed_types'] = 'gif|jpg|png|jpeg|pdf|dwg|dxf|dwf';
						$config['file_name'] = uniqid();
						$config['overwrite'] = TRUE;
						// Load and initialize upload library
						$this->load->library('upload');
						$this->upload->initialize($config);
						// Upload file to server
						if ($this->upload->do_upload('file')) {
							// Uploaded file data
							$fileData = $this->upload->data();
							array_push($cad, $fileData['file_name']);
							
							
							
						} else {
							$error = array('error' => $this->upload->display_errors('<div class="alert alert-danger">', '</div>'));
							$this->session->set_flashdata('error', $error['error']);
						}
						
					}
				}
			
			}
			$product_image = array();
			if ($_FILES['product_image']['name']) {
				//echo "image detected";
				if (is_array($_FILES['product_image']['name'])) {
					$filesCount = count($_FILES['product_image']['name']);
					for ($i = 0;$i < $filesCount;$i++) {
						$_FILES['file']['name'] = $_FILES['product_image']['name'][$i];
						$_FILES['file']['type'] = $_FILES['product_image']['type'][$i];
						$_FILES['file']['tmp_name'] = $_FILES['product_image']['tmp_name'][$i];
						$_FILES['file']['error'] = $_FILES['product_image']['error'][$i];
						$_FILES['file']['size'] = $_FILES['product_image']['size'][$i];
						// File upload configuration
						$config['upload_path'] = './uploads/product';
						$config['allowed_types'] = 'gif|jpg|png|jpeg|pdf|dwg|dxf|dwf';
						$config['file_name'] = uniqid();
						$config['overwrite'] = TRUE;
						// Load and initialize upload library
						$this->load->library('upload');
						$this->upload->initialize($config);
						// Upload file to server
						if ($this->upload->do_upload('file')) {
							// Uploaded file data
							$fileData = $this->upload->data();
							array_push($product_image, $fileData['file_name']);
							
							
							
						} else {
							$error = array('error' => $this->upload->display_errors('<div class="alert alert-danger">', '</div>'));
							$this->session->set_flashdata('error', $error['error']);
						}
						
					}
				}
			
			}
			
			$d_image = "";
			$image_exts = array("tif", "jpg", "gif", "png" ,"jpeg","pdf","dwg","dxf","dwf");

			//Get Extension of file
			if($_FILES['d_image']['name']) {
				$path_parts = pathinfo($_FILES["d_image"]["name"]);
				$ext = $path_parts['extension'];
				if(in_array($ext, $image_exts)) {

					$config['upload_path'] = './uploads/product/';
					$config['allowed_types'] = 'gif|jpg|png|jpeg|pdf|dwg|dxf|dwf';
					$config['file_name'] = uniqid();
					$config['overwrite'] = TRUE;
					$config['max_size'] = '50000';
					$config['max_width'] = '40000';
					$config['max_height'] = '40000';   

					//Load Upload Library
					$this->load->library('upload', $config);
					if (!$this->upload->do_upload('d_image')) {
						$error = array('error' => $this->upload->display_errors('<div class="alert alert-danger">', '</div>'));
						$this->session->set_flashdata('error_msg',$error['error']);
						
					}
					else {

						$upload_data = $this->upload->data();
						$d_image = $upload_data['file_name'];
					}
				} else {
					$this->session->set_flashdata('error_msg','Invalid Image Extension');

				}
			}
			
			// Make DB Query
			$data = array();
			$data['cname'] = $this->input->post('cname');
			$data['sname'] = $this->input->post('sname');
			$data['brand'] = $this->input->post('brand');
			
			$data['product_name'] = $this->input->post('product_name');	
			$data['collection'] = $this->input->post('collection');
			$data['c_origin'] = $this->input->post('c_origin');			
			$data['manufacture_year'] = $this->input->post('manufacture_year');			
			$data['designer'] = $this->input->post('designer');						
			$data['price_range'] = $this->input->post('price_range');	 					
			$data['lenth_width'] = $this->input->post('lenth_width');
			$data['height'] = $this->input->post('height');						
			$data['l_w_h'] = $this->input->post('l_w_h');						
			$data['thickness_input'] = $this->input->post('thickness_input'); 						
			$data['area'] = $this->input->post('area');			
			$data['sku'] = $this->input->post('sku');			
			$data['description'] = $this->input->post('description');
			$data['tags'] = implode(",",$this->input->post('tags'));
			$data['color'] = implode(",",$this->input->post('color'));			
			$data['sensor'] = $this->input->post('sensor');						
			$data['indoor_outdoor'] = $this->input->post('indoor_outdoor');						
			$data['installation'] = implode(",",$this->input->post('installation'));			
			$data['application'] = implode(",",$this->input->post('application'));
			$data['material'] = implode(",",$this->input->post('material'));
			$data['shape'] = implode(",",$this->input->post('shape'));						
			$data['effects'] = implode(",",$this->input->post('effects'));						
			$data['finish'] = implode(",",$this->input->post('finish'));			
			$data['size'] = implode(",",$this->input->post('size'));					
			$data['thickness'] = implode(",",$this->input->post('thickness'));			
			$data['type'] = implode(",",$this->input->post('type'));			
			$data['themes'] = implode(",",$this->input->post('themes'));			
			$data['light_bulb'] = implode(",",$this->input->post('light_bulb'));						
			$data['number_of_seat'] = implode(",",$this->input->post('number_of_seat'));						
			$data['bed_size'] = implode(",",$this->input->post('bed_size'));			
			$data['bowl'] = implode(",",$this->input->post('bowl'));					
			$data['d_image'] = $d_image;
			if(!empty($product_image)) {
			$data['product_image'] = implode(",", $product_image); 
			}
			/* if(!empty($catalogues)) {
			$data['catalogues'] = implode(",", $catalogues); 
			} */
			if(!empty($cad)) {
			$data['cad'] = implode(",", $cad); 
			}			
			$data['date'] = date('Y-m-d');
			
			if($this->db->insert('product', $data)) 
			{	
			    
			$insert_id = $this->db->insert_id();
			$video_link = count($this->input->post('video_link'));	
			for($i = 0; $i <$video_link;$i++) {									 
			$dataa['videolink'] = $this->input->post('video_link')[$i];			
			$dataa['product_id'] = $insert_id;				  				 
			$this->db->insert('product_video', $dataa);									
			}
			if(!empty($this->input->post('variant_name'))) {	
			$variant_name = count($this->input->post('variant_name'));
			for($i = 0; $i <$variant_name;$i++)
				{									
			$dataab['variant_name'] = $this->input->post('variant_name')[$i];	
			$dataab['variant_code'] = $this->input->post('variant_code')[$i];
			
			$dataab['product_id'] = $insert_id;	

			$variant_image = $this->upload_files1($i);
			
			$dataab['variant_image'] = $variant_image;
			$this->db->insert('product_color', $dataab); 	
			}
			}
			else{
				$variant_name = "";
			}
				
				$this->session->set_flashdata('success_msg','Successfully Inserted');
				redirect(base_url('admin/create_product'));
			} 
			else 
			{
				$this->session->set_flashdata('error_msg','Database Error');
				redirect(base_url('admin/create_product'));
			}
		}
	}
}