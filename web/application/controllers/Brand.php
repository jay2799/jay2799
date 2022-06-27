<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Brand extends CI_Controller {
	
	
	public function __construct(){
		
		parent::__construct();
		$this->load->helper('url_helper');
		$this->load->helper('url');
		$this->load->model('Brand_model');
		$this->load->library('session');
		// Load file helper
        $this->load->helper('file');
		
            
	}

	public function login(){
		
		$this->load->view('Brand/login');
		
	}
	public function login_brand(){
	  
		  $login=array(

			'email'=>$this->input->post('email'),
			'password'=>md5($this->input->post('password'))

		  );

		  $data=$this->Brand_model->login_brand($login['email'],$login['password']);
		  if($data)
		  {
			$this->session->set_userdata('bid',$data['id']);
			$this->session->set_userdata('bemail',$data['email']);
			$this->session->set_userdata('bname',$data['bname']);
			
			
			redirect(base_url('brand/index'));
		  }
		  else
		  {
			$this->session->set_flashdata('error_msg', 'Email Id And Password Wrong..');
		   redirect(base_url('brand/login'));

		  }


	}
	public function index(){
		if($this->session->userdata('bid')=="")
		{
			redirect(base_url('brand/login'));
		}
		$this->load->view('Brand/header');
		$this->load->view('Brand/index');
		$this->load->view('Brand/footer');
		
	}
	public function brand_profile(){
		   if($this->session->userdata('bid')=="")
		   {
				redirect(base_url('brand/login'));
		   }
		   $id = $this->session->userdata('bid');
           $this->load->helper('form');
           $this->load->library('form_validation');
    

			  $query = $this->db->get_where('brand', array('id' => $id))->row_array();
			
			  $this->form_validation->set_rules('bname', 'bname', 'required');
	 
			  if ($this->form_validation->run() === FALSE)
			  {
			  $data['brand'] = $this->db->get_where('brand',array('id' => $id))->row();
			  
			  
			  $this->load->view("Brand/header");
			  $this->load->view("Brand/pages/forms/profile",$data);
			  $this->load->view("Brand/footer");
			 
	 
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
					'cover_image' => $cover_image,
					'bname' => $this->input->post('bname'),
					'email' => $this->input->post('email'),
					'mobile' => $this->input->post('mobile'), 
					'web' => $this->input->post('web'), 
					'overview' => $this->input->post('overview'), 
					
					
				 );
			
            $this->db->where('id',$id);
            $this->db->update('brand', $data);
			$this->session->set_flashdata('success_msg','Successfully Update Details');
            redirect(base_url('brand/brand_profile'));

           }
     }
	 public function change_password(){

		if($this->session->userdata('bid')=="")
			{
				redirect(base_url('brand/login'));
			}

			$id = $this->session->userdata('bid');
					
			if (empty($id))
			{
				show_404();
			}

			$this->load->helper('form');
			$this->load->library('form_validation');

			$data['users'] = $this->Brand_model->get_brand_by_id($id); 

			$this->form_validation->set_rules('password', 'password', 'required');
			$this->form_validation->set_rules('npassword', 'npassword', 'required');
			$this->form_validation->set_rules('cpassword', 'cpassword', 'required');

			if ($this->form_validation->run() === FALSE)
			{
				$this->load->view("Brand/header");
				$this->load->view("Brand/pages/forms/change_password",$data);
				$this->load->view("Brand/footer");

			}
			else
			{

				$password=md5($this->input->post('password'));

				$npassword=md5($this->input->post('npassword'));

				$cpassword=md5($this->input->post('cpassword'));



				if($npassword==$cpassword)

				{

					$password_check=$this->Brand_model->password_check_brand($password,$id);



					if($password_check){

					  $this->Brand_model->change_pass_brand($npassword,$id);

					  $this->session->set_flashdata('success_msg','successfully Changed');
					  redirect(base_url('brand/change_password'));

					}

					else
					{

						$this->session->set_flashdata('error_msg','Wrong Old password');
					   redirect(base_url('brand/change_password'));

					}

				}

				else{

				  $this->session->set_flashdata('error_msg','New Password And Confirm Password Not Match..');
				  redirect(base_url('brand/change_password'));

				}



			}
	}
	public function logout(){

	  $this->session->sess_destroy();
	  redirect(base_url().'brand/login', 'refresh');
	}
	public function add_product(){
		
		if($this->session->userdata('bid')=="")
		{
			redirect(base_url('brand/login'));
		}
	
		$this->load->view("Brand/header");
		$this->load->view("Brand/pages/forms/add_product");
		$this->load->view("Brand/footer");
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
		if($this->session->userdata('bid')=="")
		{
			redirect(base_url('brand/login'));
		}

		$this->load->helper('form');
		$this->load->library('form_validation');

		$this->form_validation->set_rules('product_name', 'product_name', 'required');
		

		if ($this->form_validation->run() === FALSE)
		{
			
		
	
			$this->load->view("Brand/header");
			$this->load->view("Brand/pages/forms/add_product");
			$this->load->view("Brand/footer");

		}
		else
		{
			
			$catalogues = array();
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
				
			}
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
			if(!empty($catalogues)) {
			$data['catalogues'] = implode(",", $catalogues); 
			}
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
				redirect(base_url('brand/create_product'));
			} 
			else 
			{
				$this->session->set_flashdata('error_msg','Database Error');
				redirect(base_url('brand/create_product'));
			}
		}
	}
	public function delete_product($id) {		
		$this->db->where('id', $id);
		if($this->db->delete('product'))	
		{		
			$this->session->set_flashdata('success_msg','Successfully Deleted');
			redirect(base_url('brand/product_list'));	
		} 		
		else	
		{	
			$this->session->set_flashdata('error_msg','Database Error');
			redirect(base_url('brand/product_list'));	
		}	
	}
	public function product_list(){	
		if($this->session->userdata('bid')=="")
		{
			redirect(base_url('brand/login'));
		}
		$brand_id = $this->session->userdata('bid');
		$data['product'] = $this->db->get_where('product',array('brand' =>$brand_id))->result_array();
		$this->load->view('Brand/header');
		$this->load->view('Brand/pages/tables/product_list',$data);
		$this->load->view('Brand/footer');	
	}
	public function create_resellers() {
		if($this->session->userdata('bid')=="")
		{
			redirect(base_url('brand/login'));
		}

		$this->load->helper('form');
		$this->load->library('form_validation');

		$this->form_validation->set_rules('name', 'name', 'required');
		

		if ($this->form_validation->run() === FALSE)
		{
			
			$this->load->view("Brand/header");
			$this->load->view("Brand/pages/forms/add_resellers");
			$this->load->view("Brand/footer");

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
				redirect(base_url('brand/create_resellers'));
			} else {
				$this->session->set_flashdata('error_msg','Database Error');
				redirect(base_url('brand/create_resellers'));
			}
		}
	}
	public function resellers_list(){
		if($this->session->userdata('bid')=="")
		{
			redirect(base_url('brand/login'));
		}
		$brand_id =$this->session->userdata('bid');
		$data['resellers'] = $this->db->get_where('resellers',array('brand' =>$brand_id))->result_array();
		$this->load->view('Brand/header');
		$this->load->view('Brand/pages/tables/resellers_list',$data);
		$this->load->view('Brand/footer');
		
	}
	public function delete_resellers($id) {
		

		$this->db->where('id', $id);
		if($this->db->delete('resellers'))
		{
			$this->session->set_flashdata('success_msg','Successfully Deleted');
			redirect(base_url('brand/resellers_list'));
		} 
		else
		{
			$this->session->set_flashdata('error_msg','Database Error');
			redirect(base_url('brand/resellers_list'));
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
			  
			  $this->load->view("Brand/header");
			  $this->load->view("Brand/pages/forms/edit_resellers",$data);
			  $this->load->view("Brand/footer");
			 
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
            redirect(base_url('brand/resellers_list'));

           }
     }
	 public function create_catalogue() {
		if($this->session->userdata('bid')=="")
		{
			redirect(base_url('brand/login'));
		}

		$this->load->helper('form');
		$this->load->library('form_validation');

		$this->form_validation->set_rules('title', 'title', 'required');
		

		if ($this->form_validation->run() === FALSE)
		{
			$this->load->view("Brand/header");
			$this->load->view("Brand/pages/forms/add_catalogue");
			$this->load->view("Brand/footer");

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
				redirect(base_url('brand/create_catalogue'));
			} else {
				$this->session->set_flashdata('error_msg','Database Error');
				redirect(base_url('brand/create_catalogue'));
			}
		}
	}
	public function catalogue_list(){
		if($this->session->userdata('bid')=="")
		{
			redirect(base_url('brand/login'));
		}
		$brand_id = $this->session->userdata('bid');
		$data['catalogue'] = $this->db->get_where('catalogue',array('brand' => $brand_id))->result_array();
		$this->load->view('Brand/header');
		$this->load->view('Brand/pages/tables/catalogue_list',$data);
		$this->load->view('Brand/footer');
		
	}
	public function delete_catalogue($id) {
		

		$this->db->where('id', $id);
		if($this->db->delete('catalogue'))
		{
			$this->session->set_flashdata('success_msg','Successfully Deleted');
			redirect(base_url('brand/catalogue_list'));
		} 
		else
		{
			$this->session->set_flashdata('error_msg','Database Error');
			redirect(base_url('brand/catalogue_list'));
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
			  
			  
			  $this->load->view("Brand/header");
			  $this->load->view("Brand/pages/forms/edit_catalogue",$data);
			  $this->load->view("Brand/footer");
			 
	 
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
            redirect(base_url('brand/catalogue_list'));

           }
     }
}