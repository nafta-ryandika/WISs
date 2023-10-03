<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_login extends CI_model {
	public function checkLogin($inId,$inPassword){
		$this->db->select("*");
		$this->db->from("m_user");
		$this->db->where("user_id", $inId);
		
		$query = $this->db->get();
		$data = $query->row();

		if (!empty($data)) {
			if (password_verify($inPassword, $data->user_password)) {
				return $query->result();
			}	 
			else {
				return FALSE;
			}
		} 
		else {
			return FALSE;
		}
	}
}
