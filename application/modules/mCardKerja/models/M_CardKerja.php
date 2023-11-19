<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_cardKerja extends CI_model {
	public function viewData(){		
		$query = $this->db->query("SELECT * FROM 
									(
										SELECT id, id_kerja, card_status, card_start_date, card_end_date, card_log, created_by, created_at FROM m_card_kerja
									)dt1
									LEFT JOIN 
									(
										SELECT kerja_id, kerja_name, kerja_price, kerja_satuan_id FROM m_kerja
									)dt2
									ON dt1.id_kerja = dt2.kerja_id");
		$data = $query->row();

		if (!empty($data)) {
			return $query->result();
		} 
		else {
			return FALSE;
		}
	}

	public function addKerja($inMode,$inKerjaId,$inKerjaName,$inKerjaPrice,$inKerjaSatuanId){
		$this->db->select("kerja_id");
		$this->db->from("m_kerja");
		$this->db->where("kerja_id", $inKerjaId);

		$query = $this->db->get();
		$row  = $query->num_rows();
		$res = array();

		if ($row > 0) {
			if ($inMode == 'edit') {
				$data = array(
					'kerja_name' => $inKerjaName,
					'kerja_price' => $inKerjaPrice,
					'kerja_satuan_id' => $inKerjaSatuanId,
					'kerja_created_by' => $this->session->userdata['user_name'],
					'kerja_created_at' => date("Y-m-d H:i:s")
				);

				$this->db->db_debug = false;

				$this->db->where("kerja_id", $inKerjaId);

				if($this->db->update("m_kerja",$data)){
					$res['res'] = 'success';
				}
				else {
					$res['res'] =  $this->db->error();
					$res['res'] = $res['res']['message'];
				}
			}
			else { 
				$res['res'] = 'ID Pekerjaan already exists';
			// return FALSE;
			}
		}
		else {
			if ($inMode == 'add') {
				$data = array(
					'kerja_id' => $inKerjaId,
					'kerja_name' => $inKerjaName,
					'kerja_price' => $inKerjaPrice,
					'kerja_satuan_id' => $inKerjaSatuanId,
					'kerja_created_by' => $this->session->userdata['user_name'],
				);

				$this->db->db_debug = false;

				if($this->db->insert('m_kerja', $data)){
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

	public function getKerja($inKerjaId){
		$this->db->select("*");
		$this->db->from("m_kerja");
		$this->db->where("kerja_id", $inKerjaId);
		$query = $this->db->get();
		$data = $query->row();

		if (!empty($data)) {
			return $query->result();
		} 
		else {
			return FALSE;
		}
	}

	public function deleteKerja($inKerjaId){
		$res = array();

		$this->db->db_debug = false;
		$this->db->where('kerja_id', $inKerjaId);

		if($this->db->delete('m_kerja')){
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
		$query = $this->db->query("SELECT * FROM 
									(
										SELECT id, id_kerja FROM m_card_kerja
									)dt1
									LEFT JOIN 
									(
										SELECT kerja_id, kerja_name, kerja_price, kerja_satuan_id FROM m_kerja
									)dt2
									ON dt1.id_kerja = dt2.kerja_id");
									
		$data = $query->row();

		if (!empty($data)) {
			return $query->result();
		} 
		else {
			return FALSE;
		}
	}
}
