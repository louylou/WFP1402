<?php

//this class is responsible for presenting the data from the model
class MainController extends CI_Controller { 

	//create any variables you want here
	
	public function __construct() {
		
		parent::__construct();
		
		//already autoloaded 'session' in the autoload file
		
		//loading in the model
		$this->load->model('MainModel');
	}

	public function index() { //the first things to display when you go to the site

		//print_r($this->session->all_userdata());
		
		if ($this->input->post('login') === 'Login')
		{
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
				array ( //was firstName
					'field' => 'fullname',
					'label' => 'Full Name',
					'rules' => 'required',
				),
				/*array (
					'field' => 'lastName',
					'label' => 'Last Name',
					'rules' => 'required',
				),*/
				array (
					'field' => 'groupName',
					'label' => 'Group',
					'rules' => 'strip_tags|trim|required|xss_clean', // add|is_unique[users.user_group] 
				),
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
		//edit profile likes & dislikes 
		 else if ($this->input->post('editSave') === 'Save'){
	
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
		//adding a gift item
		 else if ($this->input->post('addGift') === 'Add Gift'){
	
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
		}
		//logout
		else if ($this->input->post('logout') === 'Logout'){
			require_once('logout.php');
			$logout = new logout();
			$logout->index();
		}
		else {
			$config = array();			
		}

		$data['error'] = "";
		//$this->load->library('form_validation');
		$this->form_validation->set_error_delimiters('<label class="error">', '</label>');
		$this->form_validation->set_message('required', 'Required!');
		
		$this->form_validation->set_rules($config);

		if ($this->form_validation->run() !== FALSE) {
				
			//try to login		
			if ($this->input->post('login') === 'Login'){

				$email = $this->input->post('email');
				$password = $this->input->post('password');
				$user = $this->MainModel->login($email,$password);
			
			//} else if ( $user !== false ) {
					
					// Go to Group Page
					redirect( base_url().'groupHome', 'refresh');
					exit();				
			} 
			else if ($this->input->post('submit') === 'Submit') {
				
				$user_info = array( 
				'user_fullname' => $this->input->post('fullname'), //was firstName
				//'user_lastName' => $this->input->post('lastName'),
				
				//add gruop id here to assign users to it
				'user_email' => $this->input->post('newEmail'),
				'user_password' => md5($this->input->post('newPassword')),
				);
				
				$this->MainModel->addUser($user_info);
				redirect( base_url().'groupHome', 'refresh');
				exit();	
		
			}					
			//edit profile likes & dislikes 
			else if ($this->input->post('editSave') === 'Save') {
			
				$likes = array( 
				'likes_clothes' => $this->input->post('clothes'), 
				'likes_food' => $this->input->post('food'),
				'likes_movies' => $this->input->post('movies'),
				'likes_hobbies' => $this->input->post('hobbies'),
				'likes_other' => $this->input->post('other'),
				'dislikes' => $this->input->post('dislikes'),
				);
			
				$this->MainModel->editPro($likes);
				redirect( base_url().'editProfile', 'refresh');
				exit();		
			}//end if		
			else if ($this->input->post('addGift') === 'Add Gift') {
			
				$addItem = array( 
				'gift_name' => $this->input->post('item'), 
				'gift_price' => $this->input->post('price'),
				'gift_url' => $this->input->post('url'),
				);
			
				$this->MainModel->editPro($addItem,$addItem);
				redirect( base_url().'editProfile', 'refresh');
				exit();		
			}//end if		
									
		} //end form_validation
		else {		
			// Set Error Message
			$data['error'] = "Please Enter Correct User Info.";		
		} 
				
		$data['title'] = "Home: Perfect For Me"; //this $data makes variables that you can use in the view pages

		$this->load->view('header', $data); //passing $data in so it can load the Title on header.inc 
		$this->load->view('home'); //why join & create an account sections
		$this->load->view('footer');
	
	}
	public function groupHome(){
		
		$data['title'] = "Group Home: Perfect For Me";
		$data['users'] = $this->MainModel->homeProfiles();
		$data['events'] = $this->MainModel->events();
		
		$this->load->view('header', $data); 
		$this->load->view('groupHome', $data); 
		$this->load->view('footer');	
	}

	public function userProfile(){
	
		$data['title'] = "User Profile: Perfect For Me";
		$userId =  $this->uri->segment(2);  //the 2 stands for the userID in the URL ex: www.domain/function/2
		$data['proInfo'] = $this->MainModel->profileInfo($userId);
		
		
		$this->load->view('header', $data); 
		$this->load->view('profilePg', $data); 
		$this->load->view('footer');
		
	}//end userProfile
	
	public function editProfile(){

		$data['title'] = "Edit Profile: Perfect For Me";
		
		//$userId =  $this->uri->segment(2);
		//$data['edit'] = $this->MainModel->editPro($userId);
		
		$this->load->view('header', $data); 
		$this->load->view('editProfile', $data); 
		$this->load->view('footer');
	
	}
	public function allEvents(){
		$data['title'] = "All Events: Perfect For Me";
		$data['events'] = $this->MainModel->events();
		
		$this->load->view('header', $data); 
		$this->load->view('allCal', $data); 
		$this->load->view('footer');
	
	}
	public function addEvents(){
		$data['title'] = "Add An Event: Perfect For Me";
		//$data['proList'] = $this->MainModel->homeProfiles();
		
		$this->load->view('header', $data); 
		$this->load->view('addEvent', $data); 
		$this->load->view('footer');
	
	}
	
	public function about(){
		$data['title'] = "About: Perfect For Me";
		//$data['proList'] = $this->MainModel->homeProfiles();
		
		$this->load->view('header', $data); 
		$this->load->view('about', $data); 
		$this->load->view('footer');
	
	}
	public function contact(){
		$data['title'] = "Contact: Perfect For Me";
		//$data['proList'] = $this->MainModel->homeProfiles();
		
		$this->load->view('header', $data); 
		$this->load->view('contact', $data); 
		$this->load->view('footer');
	
	}
	public function terms(){
		$data['title'] = "Terms: Perfect For Me";
		//$data['proList'] = $this->MainModel->homeProfiles();
		
		$this->load->view('header', $data); 
		$this->load->view('terms', $data); 
		$this->load->view('footer');
	
	}
	

//end MainController

}
?>