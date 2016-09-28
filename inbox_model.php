<?php
class Inbox_model extends CI_Model
  {
	  function mymessages($id,$offset)
	  {
		  $dbres = $this->db->query("SELECT * FROM messages  WHERE `to` = '".$id."' and trashed ='0' order by id DESC LIMIT $offset,5");
		  $dbresResult=$dbres->result_array();
		  return $dbresResult;
	  }
	  function trashed_messages($id,$offset)
	  {
		  $dbres = $this->db->query("SELECT * FROM messages  WHERE `to` = '".$id."' and trashed ='1' order by id DESC  LIMIT $offset,5");
		  $dbresResult=$dbres->result_array();
		  return $dbresResult;
	  }
	  function sentmessages($id,$offset)
	  {
		  $dbres = $this->db->query("SELECT * FROM messages  WHERE `from` = '".$id."' and trashed ='0' order by id DESC  LIMIT $offset,5");
		  $dbresResult=$dbres->result_array();
		  return $dbresResult;
	  }
	  function search_messages($searchmessage,$offset)
	  {
		  $wut="SELECT * FROM messages  WHERE `subject` like '%".$searchmessage."%' OR `text` like '%".$searchmessage."%' order by id DESC limit $offset, 5";
		  //echo $wut;exit;
		  $dbres = $this->db->query($wut);
		  $dbresResult=$dbres->result_array();
		  return $dbresResult;
	  }
	  function message_count()
	  {
		  $inb_qu="SELECT * FROM messages  WHERE  `to` = '".$this->session->userdata('userid')."' AND trashed='0' AND `read` = '0' ";
		  //echo $inb_qu;exit;
		  $dbres2 = $this->db->query($inb_qu);
		  $unread=$dbres2->num_rows();
		  return $unread;
	  }
	  
	  function del_function($id)
	  {
		  $this->db->where('id', $id);
		  $this->db->update('messages', array('trashed' => '1'));
	  }
	  
	  function single_message($id)
	  {
		  //mark at read
		  $this->db->where('id', $id);
		  $this->db->update('messages', array('read' => '1'));
		  //fetch record
		  $dbres = $this->db->query("SELECT * FROM messages  WHERE `id` = '".$id."'");
		  $dbresResult=$dbres->result_array();
		  return $dbresResult;
	  }
	  function send_message($data)
	  {
		  //to email
		  $dbresto = $this->db->query("SELECT * FROM user  WHERE `id` = '".$data['to']."'");
		  $dbresResult_to=$dbresto->result_array();
		  //from email
		  $dbresfrom = $this->db->query("SELECT * FROM user  WHERE `id` = '".$this->session->userdata('userid')."'");
		  $dbresResult_from=$dbresfrom->result_array();
		  //from email end
		  $headers  = "MIME-Version: 1.0\r\n";
		  $headers .= "Content-type: text/html; charset=iso-8859-1\r\n";
		  $headers.="From: '".$dbresResult_from[0]['email']."' \r\n";
		  $headers.="Return-Path: '".$dbresResult_from[0]['email']."' \r\n";
		  mail($dbresResult_to[0]['email'], $data['subject'], $data['message'], $headers);
		  $files=implode(',',$data['files']);
		  $query="insert into messages SET `from`			='".$this->session->userdata('userid')."',
		  													  `to`  			='".$data['to']."',
															  `subject`			='".$data['subject']."',
															  `text`			='".$data['message']."',
															  `attachement`		='".$files."',
															  `time`			='".date('Y-m-d H:i:s')."'
															";
															//echo $query;exit;
		  $dbres = $this->db->query($query);
	  }
	  
  }