<?php
class Products_model extends CI_Model
  {
	public function insert_complaint($data){
        $this->db->insert('tbl_complaints',$data);
    }
	public function get_brands_model()
	{
			$dbres = $this->db->query("SELECT * FROM tbl_brand  order by `pk_brand_id` DESC");
            $dbresResult=$dbres->result_array();
            return $dbresResult;
	}
	public function get_instruments_model()
	{
			$dbres = $this->db->query("SELECT * FROM tbl_instruments  order by `pk_instrument_id` DESC");
            $dbresResult=$dbres->result_array();
            return $dbresResult;
	}
	public function get_parts_model()
	{
			$dbres = $this->db->query("SELECT * FROM tbl_parts  order by `pk_part_id` DESC");
            $dbresResult=$dbres->result_array();
            return $dbresResult;
	}
	public function get_complaint_data($complaint_id)
	{
		$dbres = $this->db->query("SELECT * FROM tbl_complaints where pk_complaint_id = '".$complaint_id."'");
		$dbresResult=$dbres->result_array();
		return $dbresResult;
	}
  }