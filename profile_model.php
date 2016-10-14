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
           $dbres = $this->db->query("SELECT user.*,
		   COALESCE(tbl_offices.office_name) AS office_name,
		   COALESCE(tbl_cities.city_name) AS city_name,
		   COALESCE(GROUP_CONCAT(tbl_products.product_name SEPARATOR ', ')) AS training_equipment
		   FROM user   
		   LEFT JOIN tbl_offices ON user.fk_office_id = tbl_offices.pk_office_id
		   LEFT JOIN tbl_cities ON user.fk_city_id = tbl_cities.pk_city_id
		   LEFT JOIN tbl_trainings ON fk_engineer_id = user.id
		   LEFT JOIN tbl_products ON tbl_trainings.fk_brand_id = tbl_products.pk_product_id
		   WHERE user.delete_status = '0' GROUP BY user.id ORDER BY  `fk_office_id` ,  `userrole` ASC ");
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