<?php
//All the CRUD functions for the site.

class MainModel extends CI_Model { //responsible for managing the data from the database. Does CRUD functions.
	
	public function __construct() { 
		
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
		
	}
	
	
	//want to create new group
	//create new email
	//create new groupname btn 	
	//-(adds new 'group_name' to 'allGroups') - check if group_name hasnt been taken before
	//-(adds session->userdata('email') 'groupnames_emails' to 'groupname' & join( allGroups.group_id = groupnames.groupname_id )
	
	//when logging in. 
	//user_email matches 'groupname_emails' in 'groupnames' then returns which 'groupname_id' to be in
	// -(might have to do the 'join( allGroups.group_id = groupnames.groupname_id )' again)
	
	//when joining a group
	//types in 'group_name' if matches a 'group_name' in 'allGroups' table
	//adds session->userdata('email') to 'groupnames_emails' in 'groupname' & join( allGroups.group_id = groupnames.groupname_id )
	
	
	
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
	
		//$this->db->select('user_fullname, user_id');
		//$this->db->from('users');
		
		$this->db->select('user_fullname, user_id, event_title, event_date, event_user_id, event_starttime, event_endtime, event_location');
		$this->db->from('users'); 
		$this->db->join('events', 'events.event_user_id = users.user_id');
		
		
		if ($userId != ''){
		
			//doesnt know what 'user_id' is
			$this->db->where('user_id', $userId);//assigning 'user_id' to $userId
			
			$this->db->update('events', $addEvnt); 				
			return $this->db->last_query();			
		} 
		
		$result= $this->db->get(); 

		if ($result->num_rows() > 0) { 
				
			return $result->result_array(); 
			
		} else return false;		
		
	}
	
	public function profileInfo($userId = '') { //$userId is = $id in the controller
		
		// remove gift_name, gift_price, gift_url and make the gift table ID = user ID
		
		$this->db->select('user_fullname, user_id, gift_name, gift_price, gift_url, likes_clothes, likes_food, likes_movies, likes_hobbies, likes_other, dislikes');
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
		
		// make the gift table ID = user ID
		
		$this->db->select('user_fullname, user_id'); //info to display user fullname
		$this->db->from('users');//info to display user fullname
				
		if ($userId != ''){
			$this->db->where('user_id', $userId);
			
			//$userId = $this->session->userdata('userId');
					
			$this->db->update('users', $likes); //puts input field data into DB 				
			return $this->db->last_query();			
		}
								
		$fullNameDisplay= $this->db->get(); 

		if ($fullNameDisplay->num_rows() > 0) { 
				
			return $fullNameDisplay->result_array(); 
			
		} else return false;	
	
	}
	
	public function addGifts($gifts, $userId = '') {
		
		$this->db->select('user_fullname, user_id, gift_id, gift_user_id, gift_name, gift_price, gift_url'); 
		$this->db->order_by('gift_price', 'asc');
		$this->db->from('gifts');
		$this->db->join('users', 'users.user_id = gifts.gift_user_id');
		
		if ($userId != ''){
			$this->db->where('user_id', $userId);
						
			$this->db->update('gifts', $gifts); //puts input field data into DB 				
			return $this->db->last_query();		
		}
				
		$result = $this->db->get();
		
		if ($result->num_rows() > 0) {
		
			return $result->result_array();
			
		} else return false;
		
		/*
		$this->db->select('user_fullname, user_id, gift_id, gift_name, gift_price, gift_url'); 
		$this->db->from('gifts');
		$this->db->join('users', 'users.user_id = gifts.gift_id');
	
	
		if ($userId != ''){
			$this->db->where('user_id', $userId);
			
			//$this->db->update('users',$gifts); //puts input field data into DB 				
			//return $this->db->last_query();		
		}
		
		//doesnt know what 'user_id' is.... probably should call the 'users' table instead of 'gifts'
		//$this->db->update('gifts', $gifts); //puts input field data into DB 				
		//return $this->db->last_query();
		
		
		$result = $this->db->get();
		
		if ($result->num_rows() > 0) {
		
			return $result->result_array();
			
		} else return false;
		*/
	}
	

	
} //end Class MainModel

?>