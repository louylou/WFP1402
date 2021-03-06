<?php

//this class is responsible for presenting the data from the model
class MainController extends CI_Controller { 

	
	public function __construct() {
		
		
		parent::__construct();
		
		//already autoloaded 'session' in the autoload file
		
		//loading in the model
		$this->load->model('MainModel');
	}

	public function index() { //the first things to display when you go to the site

		//print_r($this->session->all_userdata());
		
		if ($this->input->post('login') === 'Login') {
			$config = array (
				array (
					'field' => 'email',
					'label' => 'Email',
					'rules' => 'strip_tags|trim|required|xss_clean|valid_email', 
				),
				array (
					'field' => 'password',
					'label' => 'Password',
					'rules' => 'trim|required',
				),
			);
		} 
		
		else if ($this->input->post('submit') === 'Submit') {	
		
			$config = array (
				array ( 
					'field' => 'fullname',
					'label' => 'Full Name',
					'rules' => 'required',
				),
				/*array (
					'field' => 'groupName',
					'label' => 'Group',
					'rules' => 'strip_tags|trim|required|xss_clean', // add|is_unique[users.user_group] 
				),*/
				array (
					'field' => 'newEmail',
					'label' => 'Email',
					//add a doesnt match so you wont have two accounts with the same email
					'rules' => 'strip_tags|trim|required|xss_clean|is_unique[users.user_email]valid_email', 
				),
				array (
					'field' => 'newPassword',
					'label' => 'Password',
					'rules' => 'trim|required|matches[c_pwd]',
				),
				array (
					'field' => 'c_pwd',
					'label' => 'Confirm',
					'rules' => 'trim|xss_clean',
				),
			);
		}
	
		//logout
		else if ($this->input->post('logout') === 'Logout'){		
			
			$this->session->sess_destroy();
			redirect(base_url());
			exit();				
		}
		
		else {
			$config = array();			
		}

		$data['error'] = "";		
		$this->form_validation->set_error_delimiters('<p class="error">', '</p>');	
		$this->form_validation->set_message('required', 'Required!');		
		$this->form_validation->set_rules($config);

		if ($this->form_validation->run() !== FALSE) {
				
			//try to login		
			if ($this->input->post('login') === 'Login'){

				$email = $this->input->post('email');
				$password = $this->input->post('password');
				$user = $this->MainModel->login($email,$password);
	
				// Go to Group Page
				
				//removed .$this->session->userdata('userId')
				redirect( base_url().'groupHome', 'refresh');
				exit();				
			} 
			else if ($this->input->post('submit') === 'Submit') {
					
				$salt = $this->MainModel->salt(20);	
				$user_info = array( 
					'user_fullname' => $this->input->post('fullname'),				
					'user_email' => $this->input->post('newEmail'),
					'user_password' => md5( $this->input->post('newPassword').$salt ),
					'user_salt' => $salt
				);
				
				$this->MainModel->addUser($user_info);		
				
				//removed .$this->session->userdata('userId')				
				redirect( base_url().'groupHome', 'refresh');
				exit();			
			}														
		} //end form_validation
		
		else {		
			// Set Error Message
			$data['error'] = "Please Enter Correct User Info.";		
		} 
				
		$data['title'] = "Home: Perfect For Me"; //this $data makes variables that you can use in the view pages

		$this->load->view('header', $data); //passing $data in so it can load the Title on header.inc 
		$this->load->view('home', $data); //why join & create an account sections
		$this->load->view('footer');
	
	}
	
	public function groupHome(){ //removed $id
	
		if ($this->session->userdata('email') != '') {		
			$userId = $this->uri->segment(2);
			$data['title'] = "Group Home: Perfect For Me";
			$data['users'] = $this->MainModel->profileInfo(''); //removed $Id 
			$data['events'] = $this->MainModel->events(); 
	
			//var_dump($data['users']);
		
			$this->load->view('header', $data); 
			$this->load->view('groupHome', $data); 
			$this->load->view('footer');
		} else {
			//showing 404 page
			$data['title'] = "404 Error";			
			$this->load->view('header', $data);
			$this->load->view('404', $data);	
		}
		
	}
	
	public function groups($id) {
		if ($this->session->userdata('email') != '') {
			if ($this->input->post('createGroup') === 'Create Group') {
				$config = array (
					array ( 
						'field' => 'newGroup',
						'label' => 'New Group Name',
						'rules' => 'strip_tags|trim|required|xss_clean|is_unique[allGroups.group_name]',
					),
				);						
			}
			else if ($this->input->post('joinGroup') === 'Join Group') {
				$config = array (
					array ( 
						'field' => 'joiningGroup',
						'label' => 'Group Name',
						'rules' => 'strip_tags|trim|required|xss_clean',
					),
				);						
			}
			else {
				$config = array();			
			}

			$data['error'] = "";
			$this->form_validation->set_error_delimiters('<legend class="error">', '</legend>');			
			$this->form_validation->set_message('required', 'Required!');		
			$this->form_validation->set_rules($config);

			if ($this->form_validation->run() !== FALSE) {
		
				if ($this->input->post('createGroup') === 'Create Group') {
		
					//removed .$this->session->userdata('userId')
					$this->MainModel->createGroup($this->session->userdata('userId'), $this->input->post('newGroup') );			
					redirect(base_url().'groupHome', 'refresh');
					exit();	
				}
		
				else if ($this->input->post('joinGroup') === 'Join Group') {

					$joinGroup = $this->input->post('joiningGroup');
					$groupExist = $this->MainModel->joinGroup($joinGroup, $this->session->userdata('userId'));													
				
					//var_dump($groupExist);
				
					//removed .$this->session->userdata('userId')
					redirect(base_url().'groupHome', 'refresh');
					exit();	
		
				}
			}//end form validation
		 
	 
			$data['title'] = "Create/Join a Group: Perfect For Me";
			$this->load->view('header', $data); 
			$this->load->view('groups', $data); 
			$this->load->view('footer');
		} else {
			//showing 404 page
			$data['title'] = "404 Error";			
			$this->load->view('header', $data);
			$this->load->view('404', $data);	
		}	
	}//end groups
	
	public function userProfile($id){
		if ($this->session->userdata('email') != '') {
			$data['title'] = "User Profile: Perfect For Me"; 
			$data['proInfo'] = $this->MainModel->profileInfo($id); //$userId		
			$data['gifts'] = $this->MainModel->displayGifts($id);
		
			/*
			var_dump($data['gifts']);						
			session_start();
			var_dump($this->session->userdata('userId'));
			var_dump($data['proInfo']);		
			print_r($this->session->all_userdata());
			*/
				
			$this->load->view('header', $data); 
			$this->load->view('profilePg', $data); 
			$this->load->view('footer');
		} else {
			//showing 404 page
			$data['title'] = "404 Error";			
			$this->load->view('header', $data);
			$this->load->view('404', $data);	
		}	
	
		
	}//end userProfile
	
	public function editProfile($id){ //$id is the user id# in the URL 
	
		if ($this->session->userdata('userId') == $id) {
		
			//edit profile likes & dislikes 
			if ($this->input->post('editSave') === 'Save'){
	
				$config = array (
					array ( 
						'field' => 'clothes',
						'label' => 'Clothes Style',
						'rules' => 'trim|xss_clean',
					),
					array (
						'field' => 'food',
						'label' => 'Food Style',
						'rules' => 'trim|xss_clean',
					),
					array (
						'field' => 'movies',
						'label' => 'Movie Genre',
						'rules' => 'trim|xss_clean',  
					),
					array (
						'field' => 'hobbies',
						'label' => 'Hobbies',
						'rules' => 'trim|xss_clean', 
					),
					array (
						'field' => 'other',
						'label' => 'Other',
						'rules' => 'trim|xss_clean',
					),
					array (
						'field' => 'dislikes',
						'label' => 'Dislikes',
						'rules' => 'trim|xss_clean',
					),
				);		
			}
			
			if ($this->input->post('editSave') === 'Save') {
		
				$likes = array( 
					'likes_clothes' => $this->input->post('clothes'), 
					'likes_food' => $this->input->post('food'),
					'likes_movies' => $this->input->post('movies'),
					'likes_hobbies' => $this->input->post('hobbies'),
					'likes_other' => $this->input->post('other'),
					'dislikes' => $this->input->post('dislikes'),
				);				
				// Edit User
				$this->MainModel->editPro($likes, $this->session->userdata('userId'));
			}
		
			else if ($this->input->post('addGift') === 'Add Gift') {
		
				$gifts = array( 
					'gift_name' => $this->input->post('item'), 
					'gift_price' => $this->input->post('price'),
					'gift_url' => $this->input->post('url'),
					'gift_user_id' => $this->session->userdata('userId')
				);
				$this->MainModel->addGifts($gifts, $this->session->userdata('userId'));			
			}
			
			//adding a gift item
		/* else if ($this->input->post('addGift') === 'Add Gift'){
	
			$config = array (
				array ( 
					'field' => 'item',
					'label' => 'Item Name',
					'rules' => 'required|trim|xss_clean',
				),
				array (
					'field' => 'price',
					'label' => 'Price',
					'rules' => 'required|trim|xss_clean',
				),
				array (
					'field' => 'url',
					'label' => 'URL (optional)',
					'rules' => 'trim|xss_clean',  
				),
			);
		}*/
			
			else { //not needed		
				// Set Error Message
				$data['error'] = "Please Enter Correct gift Info.";		
			}
	
			//$data['proInfo'] = $this->MainModel->editPro($id);
		
			$data['title'] = "Edit Profile: Perfect For Me";
		
			$this->load->view('header', $data); 
			$this->load->view('editProfile', $data); 
			$this->load->view('footer');	

		} else {	
			//showing 404 page
			$data['title'] = "404 Error";
			
			$this->load->view('header', $data);
			$this->load->view('404', $data);			
		}
	}
	
	public function profileImg() {
	
		if ($this->input->post('upload') === 'Upload'){
	
			$this->MainModel->do_upload();
		}
		
		$data['images'] = $this->MainModel->get_images();
		
		$this->load->view('header', $data); 
		$this->load->view('editProfile', $data); 
		$this->load->view('footer');	
		
	
	}	
	
	public function allEvents(){
		
		if ($this->session->userdata('email') != '') {
		
			$data['title'] = "All Events: Perfect For Me";
			$data['events'] = $this->MainModel->events();
		
			$this->load->view('header', $data); 
			$this->load->view('allCal', $data); 
			$this->load->view('footer');
		
		} else {
			//showing 404 page
			$data['title'] = "404 Error";			
			$this->load->view('header', $data);
			$this->load->view('404', $data);	
		}		
	}//end allEvents
	
	public function addEvents($id){
		if ($this->session->userdata('email') != '') {
			if ($this->input->post('addEvent') === 'addEvent'){
	
					$config = array (
						array ( 
							'field' => 'eventTitle',
							'label' => 'Event Title',
							'rules' => 'trim|required|xss_clean',
						),
						array (
							'field' => 'eventType',
							'label' => 'Event Type',
							'rules' => 'required|xss_clean|is_natural_no_zero',
						),
						array (
							'field' => 'location',
							'label' => 'Location',
							'rules' => 'trim|required|xss_clean',  
						),
						array (
							'field' => 'date',
							'label' => 'Date',
							'rules' => 'trim|required|xss_clean', 
						),
						array (
							'field' => 'startTime',
							'label' => 'Start Time',
							'rules' => 'trim|required|xss_clean',
						),
						array (
							'field' => 'am',
							'label' => '',
							'rules' => 'required|xss_clean',
						),
						array (
							'field' => 'endTime',
							'label' => 'End Time',
							'rules' => 'trim|required|xss_clean',
						),
						array (
							'field' => 'pm',
							'label' => '',
							'rules' => 'required|xss_clean',
						),
					);
				}
			
				if ($this->input->post('addEvent') === 'Add Event') {
	
					$addEvnt = array( 
						'event_title' => $this->input->post('eventTitle'), 
						'event_date' => $this->input->post('date'),
						'event_location' => $this->input->post('location'),
						'event_starttime' => $this->input->post('startTime'),
						'event_endtime' => $this->input->post('endTime'),	
						'event_user_id' => $this->session->userdata('userId')				
					);

					$this->MainModel->addEvnts($addEvnt, $this->session->userdata('userId')); 
			
					redirect( base_url().'allEvents', 'refresh');
					exit();
			
				}
				else { 		
					// Set Error Message
					$data['error'] = "Please Enter Correct Event Info.";		
				}

				$data['proInfo'] = $this->MainModel->addEvnts($id);
	
				$data['title'] = "Add An Event: Perfect For Me";
				
				$this->load->view('header', $data); 
				$this->load->view('addEvent', $data); 
				$this->load->view('footer');
		} else {
			//showing 404 page
			$data['title'] = "404 Error";			
			$this->load->view('header', $data);
			$this->load->view('404', $data);	
		}	
	}
	
	public function about(){
		$data['title'] = "About: Perfect For Me";
		
		$this->load->view('header', $data); 
		$this->load->view('about', $data); 
		$this->load->view('footer');
	
	}
	
	public function contact(){
		$data['title'] = "Contact: Perfect For Me";
		
		$this->load->view('header', $data); 
		$this->load->view('contact', $data); 
		$this->load->view('footer');
	
	}
	
	public function terms(){
		$data['title'] = "Terms: Perfect For Me";
		
		$this->load->view('header', $data); 
		$this->load->view('terms', $data); 
		$this->load->view('footer');
	
	}
}//end MainController
?>