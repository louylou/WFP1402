<?php
//All the CRUD functions for the site.

class MainModel extends CI_Model { //responsible for managing the data from the database. Does CRUD functions.
	
	var $gallery_path;
	var $gallery_path_url;
	
	public function __construct() { 
		
		//parent::Model();
		
		$this->gallery_path = realpath(APPPATH . '../userImages'); 		
		$this->gallery_path_url = base_url().'userImages/'; 
		
		$this->load->database(); //loads in MYSQL Database
		
	} //end __construct

	public function login($email, $pass) { //$email, $pass are the values the user typed into the input fields 

	
		// 1). Is there a user with that email? 
		$this->db->select('user_email, user_id, user_fullname, user_salt, user_password');
		$this->db->from('users');
		$this->db->where('user_email', $email);
		$result = $this->db->get();
		
		// 2). Answer to 1)... Yes
		if ($result->num_rows() > 0) {
		
			// 3). Get salt for that user
			$user = $result->row_array(); 
			$salt = $user['user_salt'];
			
			// 4). Create hash to compare
			$password = md5($pass.$salt);
				
			// 5). Does hash match password for user?
			if ($password == $user['user_password']) {
			
				// 6). Answer to 5)... Yes
				$this->session->set_userdata('email', $email); 
				$this->session->set_userdata('userId', $user['user_id']); 
				$this->session->set_userdata('username', $user['user_fullname']); 
				return $email;
			
			
			// 7). Answer to 5)... No
			} else {			
				//return 'Passwords dont match ('.$salt.'): '.$password.' not equal '.$user['user_password'];
				// error		
			}
		
		// 8). Answer to 1)... No	
		} else {
		
			//return 'invalid user';
			// error invalid user		
		}	

	} //end login
	
	//randomizes a string that can be used to mix with the user's md5 password thats hashed 
	function salt($length = 10) {
		$characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
		$randomString = '';
		for ($i = 0; $i < $length; $i++) {
			$randomString .= $characters[rand(0, strlen($characters) - 1)];
		}
    	return $randomString;
	}
	
	public function addUser($user_info) {
	
		//query to save data into the db table 		
		$this->db->insert('users',$user_info);
		
		$this->db->select('user_email, user_id, user_fullname');
		$this->db->from('users');
		$this->db->where('user_email', $user_info['user_email']);
		$result = $this->db->get();
		$user = $result->row_array(); 
		
		$this->session->set_userdata('email', $user['user_email']); 
		$this->session->set_userdata('userId', $user['user_id']); 
		$this->session->set_userdata('username', $user['user_fullname']); 
		
	}
	
	//when logging in. 
	//user_email matches 'groupname_emails' in 'groupnames' then returns which 'groupname_id' to be in
	// -(might have to do the 'join( allGroups.group_id = groupnames.groupname_id )' again)
	
	public function createGroup($newGroup, $sessEmail) {
		
	//want to create new group
	//user creates new groupname 
	//user's email get stored with 'groupnames' table with the corresponding group_id = groupname_id 	
	//-(adds new 'group_name' to 'allGroups') - check if group_name hasnt been taken before
	//-(adds session->userdata('email') 'groupnames_emails' to 'groupname' & join( allGroups.group_id = groupnames.groupname_id )
		
		
		//1.) add typed in group name to 'group_name' in 'allGroups
		$this->db->insert('allGroups', $newGroup); 

		//2.) getting table data to use for adding session Email to the table 'groupnames' in the field of 'groupname_emails' 
		$this->db->select('group_id, group_name, groupname_id, groupname_emails');
		$this->db->from('allGroups');
		$this->db->where('group_name', $newGroup['group_name']);
		$this->db->join('groupnames', 'groupnames.groupname_id = allGroups.group_id');		
		
		$result = $this->db->get();
		 
		//adding session email to 'groupname_emails' in the 'groupnames' table
		if ($sessEmail != ''){
		
			$this->db->where('groupname_emails', $this->session->userdata('email') );	
			$this->db->insert('allGroups', $newGroup); 				
			return $this->db->last_query();			
		}

		$groups = $result->row_array(); 
		
		$this->session->set_userdata('groupId', $groups['group_id']);
		//$this->session->set_userdata('email', $groups['']); 
		//$this->session->set_userdata('username', $groups['']);
		
	}
	
	public function joinGroup($joinGroup, $sessEmail) {
	//when joining a group
	//types in 'group_name' if matches a 'group_name' in 'allGroups' table
	//adds session->userdata('email') to 'groupnames_emails' in 'groupname' & join( allGroups.group_id = groupnames.groupname_id )
		
		//1.) does the groupname exist in db?
		$this->db->select('group_id, group_name, groupname_id, groupname_emails');
		$this->db->from('allGroups');
		$this->db->where('group_name', $groupname);
		$this->db->join('groupnames', 'groupnames.groupname_id = allGroups.group_id');
		$result = $this->db->get();
		
		if ($result->num_rows() > 0) {

			$groupExist = $result->row_array(); 
				
			// 5). Does the session email match the one stored in groupname_email?
			if ($sessEmail == $groupname['groupname_emails']) {
			
				// 6). Answer to 5)... Yes
				$this->session->set_userdata('email', $email); 
				$this->session->set_userdata('userId', $groupExist['user_id']);  
				return $groupExist;
			
			
			// 7). Answer to 5)... No
			} else {			

				// error		
			}
		
		// 8). Answer to 1)... No	
		} else {

			// error This groupname does not exist, please check spelling. 		
		}	
		
	}
	
	
	public function events() {	
				
		$this->db->select('event_title, event_date, event_user_id, event_starttime, event_endtime, event_location, user_fullname, user_id');
		$this->db->order_by('event_date', 'asc');
		$this->db->from('events'); 
		$this->db->join('users', 'users.user_id = events.event_user_id');
				
		$result = $this->db->get();
		
		if ($result->num_rows() > 0) {
		
			return $result->result_array();
			
		} else return false;
							
	}
	
	public function addEvnts($addEvnt, $userId = '') {
		
		$this->db->select('event_title, event_date, event_user_id, event_starttime, event_endtime, event_location');
		$this->db->from('events'); 
			
		if ($userId != ''){
		
			$this->db->where('event_user_id', $this->session->userdata('userId') ); //$this->session->userdata('userId') = $userId
			
			$this->db->insert('events', $addEvnt); 				
			return $this->db->last_query();			
		} 
		
		$result= $this->db->get(); 

		if ($result->num_rows() > 0) { 
				
			return $result->result_array(); 
			
		} else return false;		
		
	}
	
	public function profileInfo($userId = '') { //$userId is = $id in the controller
		
		// gift_name, gift_price, gift_url 
		
		$this->db->select('user_fullname, user_id, likes_clothes, likes_food, likes_movies, likes_hobbies, likes_other, dislikes');
		$this->db->order_by('user_fullname', 'asc');
		$this->db->from('users'); 
		
		if ($userId != ''){
			$this->db->where('user_id', $userId);
		}
		$fullNameDisplay= $this->db->get(); 

		if ($fullNameDisplay->num_rows() > 0) { 
		
			return $fullNameDisplay->result_array(); 
			
		} else return false;	
	
	}
	
	public function editPro($likes, $userId = '') { //$userId = $id in controller
		
		//, likes_clothes, likes_food, likes_movies, likes_hobbies, likes_other, dislikes
		
		$this->db->select('user_fullname, user_id'); //info to display user fullname
		$this->db->from('users');//info to display user fullname
				
		if ($userId != ''){
			$this->db->where('user_id', $this->session->userdata('userId'));
					
			$this->db->update('users', $likes); //puts input field data into DB 				
			return $this->db->last_query();			
		}
			
								
		$fullNameDisplay= $this->db->get(); 

		if ($fullNameDisplay->num_rows() > 0) { 
				
			return $fullNameDisplay->result_array(); 
			
		} else return false;	
		
	}
		
	public function do_upload() {
	
		$config = array (
			'allowed_types' => 'jpg|jpeg|gif|png',
			'upload_path' => $this->gallery_path,
			'max_size' => 2000 //2MB
		);

		$this->load->library('upload', $config);
		$this->upload->do_upload(); //reads uploaded file & saves it to the according path
		$image_data = $this->upload->data();
		
		
		$config = array (
			'source_image' => $image_data['full_path'],
			'new_image' => $this->gallery_path . '/thumbs',
			'maintain_ration' => true,
			'width' => 75,
			'height' => 73
		);
		
		$this->load->library('image_lib', $config);
		$this->image_lib->resize();
		
	}
	
	public function get_images() {
		
		$files = scandir($this->gallery_path);
		$files = array_diff($files, array('.', '..', 'thumbs'));
		$images = array();
		
		foreach ($files as $file) {
			$images [] = array (
				'url' => $this->gallery_path_url . $file,
				'thumb_url' => $this->gallery_path_url . 'thumbs/' . $file,
			
			);
		}
		return $images;
	}
	

	public function addGifts($gifts, $userId = '') {
		
		$this->db->select('gift_id, gift_user_id, gift_name, gift_price, gift_url'); 
		$this->db->order_by('gift_price', 'asc');
		$this->db->from('gifts');
		
		if ($userId != ''){
			$this->db->where('gift_user_id', $this->session->userdata('userId'));
			
			$this->db->insert('gifts', $gifts); //puts input field data into DB 				
			return $this->db->last_query();		
		}
				
		$result = $this->db->get();
		
		if ($result->num_rows() > 0) {
		
			return $result->result_array();
			
		} else return false;
	}
	
	public function displayGifts($userId = '') {
		
		// select gift items from database where gift_user_id = user_id (on which page I'm on)
		
		$this->db->select('user_fullname, gift_id, user_id, gift_user_id, gift_name, gift_price, gift_url');
		$this->db->order_by('gift_price', 'asc');
		$this->db->from('gifts'); 
		$this->db->join('users', 'users.user_id = gifts.gift_user_id');
		
		if ($userId != ''){
		
			$this->db->where('gift_user_id', $userId );
		}
				
		$result = $this->db->get();
		
		if ($result->num_rows() > 0) {
		
			return $result->result_array();
			
		} else return false;
	
	
	}	
} //end Class MainModel

?>