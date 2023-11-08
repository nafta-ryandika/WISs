<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_rTransaction extends CI_model {
	public function viewData(){		
		$query = $this->db->query("SELECT 		
									dt4.*,
									dt1.date,
									dt3.kerja_name AS pekerjaan, 
									COUNT(card_user) AS jumlah,
									dt3.kerja_satuan_id AS satuan,
									dt3.kerja_price AS harga
									FROM 
									(
										SELECT id, card_user, card_kerja, `date`, created_by, created_at FROM `transaction` a
									)dt1
									LEFT JOIN 
									(
										SELECT id, id_kerja FROM m_card_kerja b
									)dt2 
									ON dt1.card_kerja = dt2.id
									LEFT JOIN 
									(
										SELECT kerja_id, kerja_name, kerja_price, kerja_satuan_id FROM m_kerja c
									)dt3
									ON dt2.id_kerja = dt3.kerja_id
									LEFT JOIN
									(
										SELECT id, rf_id, `name` FROM m_card_user d
									)dt4
									ON dt1.card_user = dt4.rf_id
									GROUP BY dt1.card_user, dt2.id_kerja, dt1.date
									ORDER BY dt1.date, dt4.id, dt3.kerja_name");
		$data = $query->row();

		if (!empty($data)) {
			return $query->result();
		} 
		else {
			return FALSE;
		}
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
		$query = $this->db->query("SELECT 		
								dt4.*,
								dt1.date,
								dt3.kerja_name AS pekerjaan, 
								COUNT(card_user) AS jumlah,
								dt3.kerja_satuan_id AS satuan,
								dt3.kerja_price AS harga
								FROM 
								(
									SELECT id, card_user, card_kerja, `date`, created_by, created_at FROM `transaction` a
								)dt1
								LEFT JOIN 
								(
									SELECT id, id_kerja FROM m_card_kerja b
								)dt2 
								ON dt1.card_kerja = dt2.id
								LEFT JOIN 
								(
									SELECT kerja_id, kerja_name, kerja_price, kerja_satuan_id FROM m_kerja c
								)dt3
								ON dt2.id_kerja = dt3.kerja_id
								LEFT JOIN
								(
									SELECT id, rf_id, `name` FROM m_card_user d
								)dt4
								ON dt1.card_user = dt4.rf_id
								GROUP BY dt1.card_user, dt2.id_kerja, dt1.date
								ORDER BY dt1.date, dt4.id, dt3.kerja_name");
									
		$data = $query->row();

		if (!empty($data)) {
			return $query->result();
		} 
		else {
			return FALSE;
		}
	}
}
