<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_recTransaction extends CI_model {
	public function viewData($inCardId){
		$sql = "SELECT dt3.kerja_name AS pekerjaan, 
				COUNT(card_user) AS jumlah,
				dt3.kerja_satuan_id AS satuan,
				dt3.kerja_price AS harga
				FROM 
				(
					SELECT * FROM `transaction` a WHERE `date` = CURDATE() AND card_user = '".$inCardId."'
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
				GROUP BY dt2.id_kerja
				ORDER BY dt3.kerja_name";

		$query = $this->db->query($sql);
		$data = $query->row();

		if (!empty($data)) {
			return $query->result();
		} 
		else {
			return FALSE;
		}
	}
}
