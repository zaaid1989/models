<?php
class Profile_model extends CI_Model
  {
	function userdata($id)
	{
		$dbres = $this->db->query("SELECT * FROM user  WHERE `id` = '".$id."'");
		$dbresResult=$dbres->result_array();
		return $dbresResult;
	}
	public function update_user($data)
	{
		$this->db->where('id', $this->session->userdata('userid'));
		$this->db->update('user', $data);
    }
	public function update_employee_model($data,$id)
	{
		$this->db->where('id', $id);
		$this->db->update('user', $data);
    }
	public function change_date_to_mysql_style($un_proper_date) {
		//echo $un_proper_date;exit;
		$newdele=explode('-',$un_proper_date); 
					if($newdele[1]=='Jan')
						{
							$month='01';
						}
					elseif($newdele[1]=='Feb')
						{
							$month='02';
						}
					elseif($newdele[1]=='Mar')
						{
							$month='03';
						}
					elseif($newdele[1]=='Apr')
						{
							$month='04';
						}
					elseif($newdele[1]=='May')
						{
							$month='05';
						}
					elseif($newdele[1]=='Jun')
						{
							$month='06';
						}
					elseif($newdele[1]=='Jul')
						{
							$month='07';
						}
					elseif($newdele[1]=='Aug')
						{
							$month='08';
						}
					elseif($newdele[1]=='Sep')
						{
							$month='09';
						}
					elseif($newdele[1]=='Oct')
						{
							$month='10';
						}
					elseif($newdele[1]=='Nov')
						{
							$month='11';
						}
					else
						{
							$month='12';
						}
					$proper_date=$newdele[2].'-'.$month.'-'.$newdele[0];
					return $proper_date;
	}
	public function view_user_model($id)
    {
	    $dbres = $this->db->query("SELECT * FROM user where id='".$id."' ");
		$dbresResult=$dbres->result_array();
		return $dbresResult;
    }
	public function get_users_model()
    {
           $dbres = $this->db->query("SELECT * FROM user   where delete_status = '1'  ORDER BY  `fk_office_id` ,  `userrole` ASC ");
            $dbresResult=$dbres->result_array();
            return $dbresResult;
    }
	public function get_all_employee_model()
    {
           $dbres = $this->db->query("SELECT * FROM user   where delete_status = '0'  ORDER BY  `fk_office_id` ,  `userrole` ASC ");
            $dbresResult=$dbres->result_array();
            return $dbresResult;
    }
	public function get_employee_model($employee_id)
    {
           $dbres = $this->db->query("SELECT * FROM user where id='".$employee_id."'   ORDER BY  `fk_office_id` ,  `userrole` ASC ");
            $dbresResult=$dbres->result_array();
            return $dbresResult;
    }
	public function insert_users($data){
        $this->db->insert('user',$data);
    }
	function check_user()
	  {
		  $this->db->where('username', $this->input->post('username'));
		  $query = $this->db->get('user');
		  if($query->num_rows == 1)
			{
				$dbres = $this->db->query("SELECT * FROM user  WHERE `username` = '".$this->input->post('username')."'");
				$dbresResult=$dbres->result_array();
				//print_r($dbresResult);exit;
            	return $dbresResult;
			}
	  }
  }