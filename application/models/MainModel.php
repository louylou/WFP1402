<?php
//All the CRUD functions for the site.

class MainModel extends CI_Model { //responsible for managing the data from the database. Does CRUD functions.
	
	public function __construct() { 
		
		$this->load->database(); //loads in MYSQL Database
		
	} //end __construct

	public function login($email, $pass) {

		$this->db->select('user_email, user_id, user_fullname');
		$this->db->from('users');
		$this->db->where('user_email', $email);
		$this->db->where('user_password', $pass);
		$result = $this->db->get();
		
		if ($result->num_rows() > 0) {
		
			$user = $result->row_array(); 
			$email = strtolower($user['user_email']);
			
			//this is identifying which user logged in by their email name
			//make this a global variable so you can use it throughout the site
			$this->session->set_userdata('email', $email); 
			$this->session->set_userdata('loggedIn', '1'); 
			$this->session->set_userdata('userId', $user['user_id']); 
			$this->session->set_userdata('username', $user['user_fullname']); 
			return $email;
			
		} else return false;
	} //end login
	
	
	
	
	//want to create new group
	//create new email/create new groupname
	//emailname & groupname stored in GROUPS table
	//join(users.user_email = groups.group_name
	
	//when logging in. 
	//user_email matches group_name to know which group to be in
	
	//when joining a group
	//create new email
	//types in groupName matches a group_name in GROUPS table
	//email is added to GROUPS table
	
	
	

	public function addUser($user_info) {
	
		//query to save data into the db table 		
		$this->db->insert('users',$user_info);
	}
	
	public function homeProfiles() {
		
		//SELECT user_fullname From the users table
		$this->db->select('user_fullname, user_id');
		$this->db->from('users'); 
		
		$result = $this->db->get();
		
		if ($result->num_rows() > 0) {
		
			return $result->result_array();
			
		} else return false;	
	
	}
	
	public function events() {	
		
		$this->db->select('event_title, event_date, event_user_id, user_fullname');
		$this->db->from('events'); //SELECT user_fullname From the users table
		$this->db->join('users', 'users.user_id = events.event_user_id');
		$result = $this->db->get();
		
		if ($result->num_rows() > 0) {
		
			return $result->result_array();
			
		} else return false;
		
			
	}//events()
	public function profileInfo($userId = '') {
		
		$this->db->select('user_fullname, user_id');
		$this->db->from('users'); 
		
		if ($userId != ''){
			$this->db->where('user_id', $userId);
		}
		$fullNameDisplay= $this->db->get(); 

		if ($fullNameDisplay->num_rows() > 0) { 
		
			return $fullNameDisplay->result_array(); 
			
		} else return false;	
	
	}
	public function editPro($likes, $userId = '') {
		
		
		if ($userId != ''){
			$this->db->where('user_id', $userId);
		}
		$this->db->update('users', $likes); //insert
		
		
		return $this->db->last_query();
		
		//$this->db->update('users',$addItem);

		
		
		//$this->db->where('profile_id', $id);
		//$this->db->update('profiles', $data); 
		
		//if ($result->num_rows() > 0) {
		
		//	return $result->result_array();
			
		//} else return false;	
	
	}

	
} //end Class MainModel

?>