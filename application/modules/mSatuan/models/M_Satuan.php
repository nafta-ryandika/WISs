<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_satuan extends CI_model {
	public function viewData(){
		$this->db->select("*");
		$this->db->from("m_satuan");
		$this->db->order_by('satuan_id', 'ASC');		
		$query = $this->db->get();
		$data = $query->row();

		if (!empty($data)) {
			return $query->result();
		} 
		else {
			return FALSE;
		}
	}

	public function addSatuan($inMode,$inSatuanId,$inSatuanName){
		$this->db->select("satuan_id");
		$this->db->from("m_satuan");
		$this->db->where("satuan_id", $inSatuanId);

		$query = $this->db->get();
		$row  = $query->num_rows();
		$res = array();

		if ($row > 0) {
			if ($inMode == 'edit') {
				$data = array(
					'satuan_name' => $inSatuanName,
					'satuan_created_by' => $this->session->userdata['user_name'],
					'satuan_created_at' => date("Y-m-d H:i:s")
				);

				$this->db->db_debug = false;

				$this->db->where("satuan_id", $inSatuanId);

				if($this->db->update("m_satuan",$data)){
					$res['res'] = 'success';
				}
				else {
					$res['res'] =  $this->db->error();
					$res['res'] = $res['res']['message'];
				}
			}
			else { 
				$res['res'] = 'Satuan ID number already exists';
			// return FALSE;
			}
		}
		else {
			if ($inMode == 'add') {
				$data = array(
					'satuan_id' => $inSatuanId,
					'satuan_name' => $inSatuanName,
					'satuan_created_by' => $this->session->userdata['user_name'],
				);

				$this->db->db_debug = false;

				if($this->db->insert('m_satuan', $data)){
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

	public function getSatuan($inSatuanId){
		$this->db->select("*");
		$this->db->from("m_satuan");
		$this->db->where("satuan_id", $inSatuanId);
		$query = $this->db->get();
		$data = $query->row();

		if (!empty($data)) {
			return $query->result();
		} 
		else {
			return FALSE;
		}
	}

	public function deleteSatuan($inSatuanId){
		$res = array();

		$this->db->db_debug = false;
		$this->db->where('satuan_id', $inSatuanId);

		if($this->db->delete('m_satuan')){
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

	public function export(){
		$this->db->select("*");
		$this->db->from("m_satuan");		
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
