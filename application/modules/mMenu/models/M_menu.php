<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_menu extends CI_model {
	public function viewData(){
		$this->db->select("*,
						(SELECT department_name FROM m_department WHERE department_id = user_department_id) AS user_department,
						(SELECT division_name FROM m_division WHERE division_id = user_division_id) AS user_division,
						(SELECT level_name FROM m_level WHERE level_id = user_level_id) AS user_level");
		$this->db->from("m_user");		
		$query = $this->db->get();
		$data = $query->row();

		if (!empty($data)) {
			return $query->result();
		} 
		else {
			return FALSE;
		}
	}

	public function getDepartment(){
		$this->db->select("*");
		$this->db->from("m_department");		
		$query = $this->db->get();
		$data = $query->row();

		if (!empty($data)) {
			return $query->result();
		} 
		else {
			return FALSE;
		}
	}

	public function getDivision($inDepartment){
		$this->db->select("*");
		$this->db->from("m_division");
		$this->db->where("division_department_id", $inDepartment);		
		$query = $this->db->get();
		$data = $query->row();

		if (!empty($data)) {
			return $query->result();
		} 
		else {
			return FALSE;
		}
	}

	public function getLevel(){
		$this->db->select("*");
		$this->db->from("m_level");		
		$query = $this->db->get();
		$data = $query->row();

		if (!empty($data)) {
			return $query->result();
		} 
		else {
			return FALSE;
		}
	}

	public function addUser($inMode,$inId,$inName,$inEmail,$inDepartment,$inDivision,$inLevel,$inPassword){
		$this->db->select("user_id");
		$this->db->from("m_user");
		$this->db->where("user_id", $inId);

		$query = $this->db->get();
		$row  = $query->num_rows();
		$res = array();

		if ($row > 0) {
			if ($inMode == 'edit') {
				$data = array(
					'user_name' => $inName,
					'user_email' => $inEmail,
					'user_department_id' => $inDepartment,
					'user_division_id' => $inDivision,
					'user_level_id' => $inLevel,
					'user_created_by' => $this->session->userdata['user_name'],
					'user_created_at' => date("Y-m-d H:i:s")
				);

				$this->db->db_debug = false;

				$this->db->where("user_id", $inId);

				if($this->db->update("m_user",$data)){
					$res['res'] = 'success';
				}
				else {
					$res['res'] =  $this->db->error();
					$res['res'] = $res['res']['message'];
				}
			}
			else { 
				$res['res'] = 'ID number already exists';
			// return FALSE;
			}
		}
		else {
			if ($inMode == 'add') {
				$data = array(
					'user_id' => $inId,
					'user_name' => $inName,
					'user_email' => $inEmail,
					'user_department_id' => $inDepartment,
					'user_division_id' => $inDivision,
					'user_level_id' => $inLevel,
					'user_created_by' => $this->session->userdata['user_name'],
					'user_password' => password_hash($inPassword,PASSWORD_DEFAULT)
				);

				$this->db->db_debug = false;

				if($this->db->insert('m_user', $data)){
					$res['res'] = 'success';
				}
				else {
					$res['res'] =  $this->db->error();
					$res['res'] = $res['res']['message'];
				}
			}
		}

		echo json_encode($res);
	}

	public function getUser($inId){
		$this->db->select("*");
		$this->db->from("m_user");
		$this->db->where("user_id", $inId);
		$query = $this->db->get();
		$data = $query->row();

		if (!empty($data)) {
			return $query->result();
		} 
		else {
			return FALSE;
		}
	}

	public function deleteUser($inId){
		$res = array();

		$this->db->db_debug = false;
		$this->db->where('user_id', $inId);

		if($this->db->delete('m_user')){
			$res['res'] = 'success';
		}
		else {
			$res['res'] =  $this->db->error();
			$res['res'] = $res['res']['message'];
		}

		echo json_encode($res);
	}

	public function getOption($inIdx){
		$this->db->select("*");
		$this->db->from($inIdx);		
		$query = $this->db->get();
		$data = $query->row();

		if (!empty($data)) {
			return $query->result();
		} 
		else {
			return FALSE;
		}
	}

	public function exportXls(){
		$this->db->select("*,
						(SELECT department_name FROM m_department WHERE department_id = user_department_id) AS user_department,
						(SELECT division_name FROM m_division WHERE division_id = user_division_id) AS user_division,
						(SELECT level_name FROM m_level WHERE level_id = user_level_id) AS user_level");
		$this->db->from("m_user");		
		$query = $this->db->get();
		$data = $query->row();

		if (!empty($data)) {
			return $query->result();
		} 
		else {
			return FALSE;
		}
	}
}
