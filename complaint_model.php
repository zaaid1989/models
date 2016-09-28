<?php
class Complaint_model extends CI_Model
  {
	public function insert_complaint($data)
	{
        $this->db->insert('tbl_complaints',$data);
	   /* $query="insert into messages SET 
			  `from`			='".$this->session->userdata('userid')."',
			  `to`  			='".$data['to']."',
			  `subject`			='".$data['subject']."',
			  `text`			='".$data['message']."',
			  `attachement`		='".$files."',
			  `time`			='".date('Y-m-d H:i:s')."'
			";
			//echo $query;exit;
		  $dbres = $this->db->query($query); */
    }
	public function complete_complaint($data,$id)
	{
		$this->db->where('pk_complaint_id', $id);
		$this->db->update('tbl_complaints', $data); 
    }
	public function is_allowed($role)
	  {
		  $query = $this->db->query("select * from user where id = '".$this->session->userdata('userid')."' and userrole = '$role'");
		  $rightcheck_q = $query->result_array();
		  //echo $_SESSION['adm']['user_type'];
		  if ($query->num_rows() > 0)
			  {
				  return true;
			  }
		  else
			  {
				  return false;
			  }
	  }
	  public function current_status($status)
	  {
		  if( $status=="Pending"){ 
			  echo '<span class="label label-sm label-danger"> Pending </span>';
		   } 
		   if( $status=="Pending Verification"){ 
			  echo '<span class="label label-sm label-warning"> Pending Verification </span>';
		   }
		   if( $status=="Pending Registration"){ 
			  echo '<span class="label label-sm label-warning"> Pending Registration </span>';
		   }
		   
		   if( $status=="Closed"){ 
			  echo '<span class="label label-sm label-success"> Close </span>';
		   }
		   if( $status=="Pending (BB)"){ 
			  echo '<span class="label label-sm label-danger"> Pending (BB) </span>';
		   }
			if( $status=="Pending Verification (BB)"){ 
			  echo '<span class="label label-sm label-warning"> Pending Verification (BB) </span>';
		   }
			if( $status=="Shifted"){ 
			  echo '<span class="label label-sm bg-blue"> Shifted </span>';
		  }
		  if( $status=="Completed"){ 
			  echo '<span class="label label-sm bg-blue"> Completed </span>';
		  }
		  if( $status=="Pending SPRF"){ 
			  echo '<span class="label label-sm bg-purple"> Pending SPRF </span>';
		  }
		  if( $status=="SPRF Approved"){ 
			  echo '<span class="label label-sm label-danger"> SPRF Approved </span>';
		  }
		  if( $status=="N/A"){ 
			  echo '<span class="label label-sm bg-grey-cascade"> N/A </span>';
		  }
	  }
	  public function nicetime($date)
		  {
			  if(empty($date)) {
				  return "No date provided";
			  }
			  $periods         = array("second", "minute", "hour", "day", "week", "month", "year", "decade");
			  $lengths         = array("60","60","24","7","4.35","12","10");
			  $now             = time();
			  $unix_date         = strtotime($date);
				 // check validity of date
			  if(empty($unix_date)) {   
				  return "Bad date";
			  }
			  // is it future date or past date
			  if($now > $unix_date) {   
				  $difference     = $now - $unix_date;
				  $tense         = "ago";
			  } else {
				  $difference     = $unix_date - $now;
				  $tense         = "from now";
			  }
			  for($j = 0; $difference >= $lengths[$j] && $j < count($lengths)-1; $j++) {
				  $difference /= $lengths[$j];
			  }
			  $difference = round($difference);
			  if($difference != 1) {
				  $periods[$j].= "s";
			  }
			  return "$difference $periods[$j] {$tense}";
		  }
	public function insert_customer($data){
        $this->db->insert('tbl_clients',$data);
    }
	public function update_my_customer($data,$id){
		$this->db->where('pk_client_id', $id);
		$this->db->update('tbl_clients', $data);
    }
	public function update_user($data)
	{
		$this->db->where('id', $this->session->userdata('userid'));
		$this->db->update('user', $data);
    }
	public function get_related_cities($client_name)
	{
			$dbres = $this->db->query("SELECT * FROM tbl_clients where client_name = '".$client_name."'");
            $dbresResult=$dbres->result_array();
            return $dbresResult;
	}
	public function get_sap_projects()
	{
			$dbres = $this->db->query("SELECT * FROM business_data where `Sales Person` = '".$this->session->userdata('userid')."' AND status='0'");
            $dbresResult=$dbres->result_array();
            return $dbresResult;
	}
	
	public function get_acs_model()
	{
			$dbres = $this->db->query("SELECT * FROM tbl_customer_sap_bridge ");
            $dbresResult=$dbres->result_array();
            return $dbresResult;
	}
	public function get_business_data_model()
	{
			$dbres = $this->db->query("SELECT * FROM business_data where status='0'");
            $dbresResult=$dbres->result_array();
            return $dbresResult;
	}
	
	public function get_deleted_business_data_model()
	{
			$dbres = $this->db->query("SELECT * FROM business_data where status='1'");
            $dbresResult=$dbres->result_array();
            return $dbresResult;
	}
	
	public function get_pending_business_data_model()
	{
			$dbres = $this->db->query("SELECT * FROM business_data where strategy_status='0' AND target_date!='0000-00-00'");
            $dbresResult=$dbres->result_array();
            return $dbresResult;
	}
	
	public function get_related_teritory($city_id)
	{
			$dbres = $this->db->query("SELECT * FROM tbl_cities where pk_city_id = '".$city_id."'");
            $dbresResult=$dbres->result_array();
            return $dbresResult;
	}
	public function get_update_business_project_model($business_project_id)
	{
			$dbres = $this->db->query("SELECT * FROM business_data where pk_businessproject_id = '".$business_project_id."'");
            $dbresResult=$dbres->result_array();
            return $dbresResult;
	}
	public function get_update_vs_project($vs_id)
	{
			$dbres = $this->db->query("SELECT * FROM tbl_vs where pk_vs_id = '".$vs_id."'");
            $dbresResult=$dbres->result_array();
            return $dbresResult;
	}
	public function get_update_dvr_project($dvr_id)
	{
			$dbres = $this->db->query("SELECT * FROM tbl_dvr where pk_dvr_id = '".$dvr_id."'");
            $dbresResult=$dbres->result_array();
            return $dbresResult;
	}
	
	public function get_eng_dvr_model()
	{
			$dbres = $this->db->query("SELECT * FROM tbl_dvr where fk_engineer_id = '".$this->session->userdata('userid')."' AND date like '".date('Y-m-d')."%'");
            $dbresResult=$dbres->result_array();
            return $dbresResult;
	}
	public function get_eng_asc_model()
	{
			$dbres = $this->db->query("SELECT * FROM tbl_dvr where fk_engineer_id = '".$this->session->userdata('userid')."' order by date DESC");
            $dbresResult=$dbres->result_array();
            return $dbresResult;
	}
	
	public function get_eng_vs_model()
	{
			$dbres = $this->db->query("SELECT * FROM tbl_vs where fk_engineer_id = '".$this->session->userdata('userid')."' ");
            $dbresResult=$dbres->result_array();
            return $dbresResult;
	}
	public function get_date_dvr_model($start_mydate,$end_mydate, $engineer, $table)
	{
			if($table=='tbl_dvr')
			{
				$id = 'pk_dvr_id';
			}
			else
			{
				$id = 'pk_vs_id';
			}
			$newdele=explode('-',$start_mydate); 
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
					$start_mydate_2=$newdele[2].'-'.$month.'-'.$newdele[0];
					//for end date
					$newdele=explode('-',$end_mydate); 
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
					$end_mydate_2=$newdele[2].'-'.$month.'-'.$newdele[0];
		
		$dbres = $this->db->query("SELECT * FROM $table where  date between '".$start_mydate_2."' AND '".$end_mydate_2."' AND fk_engineer_id = '".$engineer."' ORDER BY $id ASC");
        $dbresResult=$dbres->result_array();
        return $dbresResult;
	}
	public function get_sup_dvr_model()
	{
			$dbres = $this->db->query("SELECT * FROM tbl_dvr ");
            $dbresResult=$dbres->result_array();
            return $dbresResult;
	}
	public function get_single_eng_dvr_model($engineer_id, $table)
	{
			$dbres = $this->db->query("SELECT * FROM $table where fk_engineer_id = '".$engineer_id."'");
            $dbresResult=$dbres->result_array();
            return $dbresResult;
	}
	public function get_contact_no($pk_client_id)
	{
			$dbres = $this->db->query("SELECT * FROM tbl_clients where pk_client_id = '".$pk_client_id."'");
            $dbresResult=$dbres->result_array();
            return $dbresResult;
	}
	public function get_complaint_model()
	{
			$dbres = $this->db->query("SELECT * FROM tbl_complaints where complaint_nature='complaint' AND status!='Pending Registration'  order by `pk_complaint_id` DESC");
            $dbresResult=$dbres->result_array();
            return $dbresResult;
	}
	public function get_supervisor_complaint_model()
	{
			$dbres = $this->db->query("SELECT * FROM tbl_complaints  where status='Pending' AND assign_to='".$this->session->userdata('userid')."' order by `pk_complaint_id` DESC");
            $dbresResult=$dbres->result_array();
            return $dbresResult;
	}
	public function get_supervisor_pm_model()
	{
			$dbres = $this->db->query("SELECT * FROM tbl_complaints   order by `pk_complaint_id` DESC");
            $dbresResult=$dbres->result_array();
            return $dbresResult;
	}
	public function get_engineer_pm_model()
	{
			$dbres = $this->db->query("SELECT * FROM tbl_complaints   order by `pk_complaint_id` DESC");
            $dbresResult=$dbres->result_array();
            return $dbresResult;
	}
	
	public function get_engineer_complaints_model()
	{
			$dbres = $this->db->query("SELECT * FROM tbl_complaints  where assign_to='".$this->session->userdata('userid')."'  order by `pk_complaint_id` DESC");
            $dbresResult=$dbres->result_array();
            return $dbresResult;
	}
	public function get_customer_view_model()
	{
			$dbres = $this->db->query("SELECT * FROM tbl_clients   where delete_status = '0' order by `pk_client_id` DESC ");
            $dbresResult=$dbres->result_array();
            return $dbresResult;
	}
	public function get_customer_edit_model($client_id)
	{
			$dbres = $this->db->query("SELECT * FROM tbl_clients   where pk_client_id = '".$client_id."'");
            $dbresResult=$dbres->result_array();
            return $dbresResult;
	}
	public function get_operator_view_dc_model()
	{
			$dbres = $this->db->query("SELECT * FROM tbl_complaints  where status='SPRF_Approved'  order by `pk_complaint_id` DESC");
            $dbresResult=$dbres->result_array();
            return $dbresResult;
	}
	public function create_pefemployee_html($engineer_id,$shedule_id, $evaluater_role, $evaluater_id, $field_value)
	{
			$pef=" select * from tbl_pef where fk_engineer_id='".$engineer_id."' and fk_evaluater_id='".$engineer_id."'
			 and schedule_id='".$shedule_id."'";
			$pef_query=$this->db->query($pef);
			$pef_num_rows=$pef_query->num_rows();
			$pef_result=$pef_query->result_array();
			// supervisor
			$pef2=" select * from tbl_pef where fk_engineer_id='".$engineer_id."' and fk_evaluater_id='".$evaluater_id."'  
			and schedule_id='".$shedule_id."'";
			$pef_query2=$this->db->query($pef2);
			$pef_num_rows_supervisor=$pef_query2->num_rows();
			$pef_result2=$pef_query2->result_array();
			//
			$result_html='';
			if($evaluater_role=="FSE" || $evaluater_role=="Salesman")
						  {
							  if($pef_num_rows=='0')
							  {
								$result_html.= '<select class="form-control" name="'.$field_value.'" id="'.$field_value.'" required>
                                  <option value="">--Choose--</option>
                                  <option value="1">1</option>
                                  <option value="2">2</option>
                                  <option value="3">3</option>
                                  <option value="4">4</option>
                                  <option value="5">5</option>
                                </select>';
							  }
							  else
							  {
								  $result_html.=  $pef_result[0][$field_value];
							  }
						  }
						  elseif($evaluater_role=="Supervisor")
						  {
							  if($pef_num_rows=='0')
							  {
								  $result_html.=  "Not filled";
							  }
							  else
							  {
								  $result_html.=  $pef_result[0][$field_value];
							  }
						  }
						  elseif($evaluater_role=="Admin")
						  {
							  if($pef_num_rows=='0')
							  {
								  $result_html.=  "Not filled";
							  }
							  else
							  {
								  $result_html.=  $pef_result[0][$field_value];
							  }
						  }
						  $result_html.='</td>

                          <td>'; 
			//  supervisor TD
			if($evaluater_role=="Supervisor")
			{
				if($pef_num_rows_supervisor=='0' && $pef_num_rows=='0')
				{
					if($engineer_id!=$this->session->userdata('userid'))
					{
						$result_html.='Not Filled';
					}
					else
					{
						  $result_html.='<select class="form-control" name="'.$field_value.'" id="'.$field_value.'" required>
							<option value="">--Choose--</option>
							<option value="1">1</option>
							<option value="2">2</option>
							<option value="3">3</option>
							<option value="4">4</option>
							<option value="5">5</option>
						  </select>';
					}
				}
				elseif($pef_num_rows_supervisor=='0' && $pef_num_rows!='0')
				{
					  $result_html.='<select class="form-control" name="'.$field_value.'" id="'.$field_value.'" required>
						<option value="">--Choose--</option>
						<option value="1">1</option>
						<option value="2">2</option>
						<option value="3">3</option>
						<option value="4">4</option>
						<option value="5">5</option>
					  </select>';
				}
				else
				{
					$result_html.= $pef_result2[0][$field_value];
				}
			}
						  // for Admin
						  if($evaluater_role=="Admin")
						  {
							  // supervisor
								$pef3=" select * from tbl_pef where fk_engineer_id='".$engineer_id."' and evaluater_role='Supervisor'  
								and schedule_id='".$shedule_id."'";
								$pef_query3=$this->db->query($pef3);
								$pef_num_rows_admin=$pef_query3->num_rows();
								$pef_result3=$pef_query3->result_array();
							  if($pef_num_rows_admin=='0' && $pef_num_rows=='0')
							  {
							  	$result_html.= "Not Filled";
							  }
							  elseif($pef_num_rows_admin=='0' && $pef_num_rows!='0')
							  {
								$result_html.="Not Filled";
							  }
							  else
							  {
								  $result_html.= $pef_result3[0][$field_value];
							  }
						  }
						  // for FSE/Salesman
						  if($evaluater_role=="FSE" || $evaluater_role=="Salesman")
						  {
							  // supervisor
								$pef3=" select * from tbl_pef where fk_engineer_id='".$engineer_id."' and evaluater_role IN ('Supervisor')
								and schedule_id='".$shedule_id."'";
								$pef_query3=$this->db->query($pef3);
								$pef_num_rows_admin=$pef_query3->num_rows();
								$pef_result3=$pef_query3->result_array();
							  if($pef_num_rows_admin=='0' && $pef_num_rows=='0')
							  {
							  	$result_html.= "Not Filled";
							  }
							  elseif($pef_num_rows_admin=='0' && $pef_num_rows!='0')
							  {
								$result_html.="Not Filled";
							  }
							  else
							  {
								  $result_html.= $pef_result3[0][$field_value];
							  }
						  }
						  //
						  
						  
						 $result_html.=" </td>

                          <td>";
             // Admin TD
			  if($evaluater_role=="Admin")
			  {
				  // supervisor
					$pef3=" select * from tbl_pef where fk_engineer_id='".$engineer_id."' and evaluater_role='Supervisor'  
					and schedule_id='".$shedule_id."'";
					$pef_query3=$this->db->query($pef3);
					$pef_num_rows_sup=$pef_query3->num_rows();
					$pef_result3=$pef_query3->result_array();
					// admin
					$pef_admin=" select * from tbl_pef where fk_engineer_id='".$engineer_id."' and evaluater_role='Admin'  
					and schedule_id='".$shedule_id."'";
					$pef_query_admin=$this->db->query($pef_admin);
					$pef_num_rows_admin=$pef_query_admin->num_rows();
					$pef_result_admin=$pef_query_admin->result_array();
				  if($pef_num_rows_admin=='0' && $pef_num_rows_sup=='0' && $pef_num_rows=='0')
				  {
					  if($engineer_id!=$this->session->userdata('userid'))
					  {
						  $result_html.='Not Filled';
					  }
					  else
					  {
							$result_html.='<select class="form-control" name="'.$field_value.'" id="'.$field_value.'" required>
							  <option value="">--Choose--</option>
							  <option value="1">1</option>
							  <option value="2">2</option>
							  <option value="3">3</option>
							  <option value="4">4</option>
							  <option value="5">5</option>
							</select>';
					  }
				  }
				  elseif($pef_num_rows_admin=='0' && $pef_num_rows_sup=='0' && $pef_num_rows!='0')
				  {
					  if($engineer_id!=$this->session->userdata('userid'))
					  {
						  $result_html.='Not Filled';
					  }
					  else
					  {
							$result_html.='<select class="form-control" name="'.$field_value.'" id="'.$field_value.'" required>
							  <option value="">--Choose--</option>
							  <option value="1">1</option>
							  <option value="2">2</option>
							  <option value="3">3</option>
							  <option value="4">4</option>
							  <option value="5">5</option>
							</select>';
					  }
				  }
				  elseif($pef_num_rows_admin=='0' && $pef_num_rows_sup!='0' && $pef_num_rows!='0')
				  {
					   $result_html.=' <select class="form-control" name="'.$field_value.'" id="'.$field_value.'" required>
						  <option value="">--Choose--</option>
						  <option value="1">1</option>
						  <option value="2">2</option>
						  <option value="3">3</option>
						  <option value="4">4</option>
						  <option value="5">5</option>
						</select>';
				  }
				  else
				  {
					  $result_html.= $pef_result_admin[0][$field_value];
				  }
			  }
							  
							  
						// for FSE/Salesman
						  if($evaluater_role=="FSE" || $evaluater_role=="Salesman")
						  {
							  // supervisor
								$pef3=" select * from tbl_pef where fk_engineer_id='".$engineer_id."' and evaluater_role IN ('Admin')
								and schedule_id='".$shedule_id."'";
								$pef_query3=$this->db->query($pef3);
								$pef_num_rows_admin=$pef_query3->num_rows();
								$pef_result3=$pef_query3->result_array();
							  if($pef_num_rows_admin=='0' && $pef_num_rows=='0')
							  {
							  	$result_html.= "Not Filled";
							  }
							  elseif($pef_num_rows_admin=='0' && $pef_num_rows!='0')
							  {
								$result_html.="Not Filled";
							  }
							  else
							  {
								  $result_html.= $pef_result3[0][$field_value];
							  }
						  }
						  //
						  
						  
						  // for Supervisor
						  if($evaluater_role=="Supervisor" )
						  {
							  // supervisor
								$pef3=" select * from tbl_pef where fk_engineer_id='".$engineer_id."' and evaluater_role IN ('Admin')
								and schedule_id='".$shedule_id."'";
								$pef_query3=$this->db->query($pef3);
								$pef_num_rows_admin=$pef_query3->num_rows();
								$pef_result3=$pef_query3->result_array();
							  if($pef_num_rows_admin=='0' && $pef_num_rows=='0')
							  {
							  	$result_html.= "Not Filled";
							  }
							  elseif($pef_num_rows_admin=='0' && $pef_num_rows!='0')
							  {
								$result_html.="Not Filled";
							  }
							  else
							  {
								  $result_html.= $pef_result3[0][$field_value];
							  }
						  }
						  //
							  
							  
							  
                          $result_html.='</td>';
						  echo $result_html;
			//
            //return $result_html;
	}
	
	
  }