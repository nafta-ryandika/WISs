<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_recTransaction extends CI_model {
	public function viewData($inCardId){
		$res = array();

		$sql = "SELECT rfid_no, `log` FROM test.t_card GROUP BY rfid_no";
		$query = $this->db->query($sql);	
			
		foreach ($query->result() as $data){
			$cardKerja = $data->rfid_no;

			$sql1 = "INSERT INTO `transaction` 
					(card_user, card_kerja, `date`, created_by, created_at) 
					VALUES 
					('".$inCardId."', '".$cardKerja."', curdate(), '".$_SERVER['REMOTE_ADDR']."', now())";
					
			if($this->db->query($sql1)){
				$sql2 = "DELETE FROM test.t_card WHERE rfid_no = '".$cardKerja."'";
				$this->db->query($sql2);
			}
		}

		// $sql2 = "TRUNCATE TABLE t_card";
		// $this->db->query($sql2);

		// return FALSE;

		// $sql1 = "select * from t_card";
		// $query1 = $this->db->query($sql1);
		// $data1 = $query1->row();

		// foreach ($data1 as $row1) {
		// 	$data = array(
		// 		'satuan_id' => $inSatuanId,
		// 		'satuan_name' => $inSatuanName,
		// 		'satuan_created_by' => $this->session->userdata['user_name'],
		// 	);

		// 	$this->db->db_debug = false;

		// 	if($this->db->insert('m_satuan', $data)){
		// 		$res['res'] = 'success';
		// 	}
		// 	else {
		// 		$res['res'] =  $this->db->error();
		// 		$res['res'] = $res['res']['message'];
		// 	}
		// }


		// get data from table

		// $sql_insertData = "";

		// insert compare with rfid employee
		// delete data from t_card
		// maks read card data 20 real 1000
		// add loading data

		// 169.254.72.83



		


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
