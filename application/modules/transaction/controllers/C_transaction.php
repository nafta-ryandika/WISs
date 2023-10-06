<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class C_transaction extends CI_Controller {
	public function __construct() {        
        parent::__construct();

        //cek session login
        if($this->session->userdata("user_id") == "") {
            redirect('login/C_login');
        }

		$this->load->model("M_transaction");
    }

	public function index(){
		$this->load->view('element/V_header');
		$this->load->view('element/V_navbar');
		$this->load->view('V_content');
		$this->load->view('element/V_footer');
		
		$data['data'] = 'transaction';
		$this->load->view('element/V_load',$data);
	}

	public function viewData(){
		$inCardId = $this->input->post("inCardId");

		$data['data'] = $this->M_transaction->viewData($inCardId);
		$this->load->view('V_data',$data);
	}

	public function viewInput(){
		$inMode = $this->input->post("inMode");
		$inKerjaId = $this->input->post("inKerjaId");
		$inKerjaName = $this->input->post("inKerjaName");
		$inKerjaPrice = $this->input->post("inKerjaPrice");
		$inKerjaSatuanId = $this->input->post("inKerjaSatuanId");
		
		$data['inMode'] = $inMode;
		$data['inKerjaId'] = $inKerjaId;
		$data['inKerjaName'] = $inKerjaName;
		$data['inKerjaPrice'] = $inKerjaPrice;
		$data['inKerjaSatuanId'] = $inKerjaSatuanId;
		
		$this->load->view('V_input',$data);
	}

	public function addKerja(){
		$inMode = $this->input->post('inMode');
		$inKerjaId = $this->input->post('inKerjaId');
		$inKerjaName = $this->input->post('inKerjaName');
		$inKerjaPrice = $this->input->post('inKerjaPrice');
		$inKerjaSatuanId = $this->input->post('inKerjaSatuanId');

		$res = $this->M_kerja->addKerja($inMode,$inKerjaId,$inKerjaName,$inKerjaPrice,$inKerjaSatuanId);
		echo ($res);
	}

	public function getKerja(){
		$inKerjaId = $this->input->post('inKerjaId');

		$res = $this->M_kerja->getKerja($inKerjaId);
		echo json_encode($res);
	}

	public function deleteKerja(){
		$inKerjaId = $this->input->post('inKerjaId');

		$res = $this->M_kerja->deleteKerja($inKerjaId);
		echo ($res);
	}

	public function export(){
		$inModalType = $this->input->get('inModalType');
		$inDatatablesParameter = $this->input->get('inDatatablesParameter');
		$data['data'] = $this->M_kerja->export($inModalType,$inDatatablesParameter);

		if ($inModalType == 'pdf') {
			$html = $this->load->view('V_exportPdf',$data);

			$this->load->library('pdfgenerator');

			$data['title_pdf'] = 'Data Master Pekerjaan';
			$file_pdf = 'Data Master Pekerjaan';
			$paper = 'A4';
			$orientation = "landscape";
			$html = $this->load->view('V_exportPdf',$data, TRUE);
			$this->pdfgenerator->generate($html, $file_pdf, $paper, $orientation, TRUE);
		}
		else if ($inModalType == 'xls') {
			$this->load->library('excel');
			$this->excel->setActiveSheetIndex(0);
			$this->excel->getActiveSheet()->setTitle('Data Master Pekerjaan');

			$this->excel->getActiveSheet()->setCellValue('A1', 'No');
			$this->excel->getActiveSheet()->setCellValue('B1', 'ID Pekerjaan');
			$this->excel->getActiveSheet()->setCellValue('C1', 'Pekerjaan');
			$this->excel->getActiveSheet()->setCellValue('D1', 'Harga');
			$this->excel->getActiveSheet()->setCellValue('E1', 'Satuan');
			$this->excel->getActiveSheet()->setCellValue('F1', 'Created By');
			$this->excel->getActiveSheet()->setCellValue('G1', 'Created At');
			$this->excel->getActiveSheet()->getStyle('A1:G1')->getFont()->setSize(12);
			$this->excel->getActiveSheet()->getStyle('A1:G1')->getFont()->setBold(true);

			$this->excel->getActiveSheet()->getStyle('A1:G1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

			$no = 1;
			$i = 2;
			foreach($data['data'] as $row){
				$this->excel->getActiveSheet()->setCellValue('A'.$i, $no);
				$this->excel->getActiveSheet()->setCellValue('B'.$i, $row->kerja_id);
				$this->excel->getActiveSheet()->setCellValue('C'.$i, $row->kerja_name);
				$this->excel->getActiveSheet()->setCellValue('D'.$i, $row->kerja_price);
				$this->excel->getActiveSheet()->setCellValue('E'.$i, $row->kerja_satuan_id);
				$this->excel->getActiveSheet()->setCellValue('F'.$i, $row->kerja_created_by);
				$this->excel->getActiveSheet()->setCellValue('G'.$i, $row->kerja_created_at);

				$no++;
				$i++;
			}
			
			$filename ='Data Master Pekerjaan.xls';
			header('Content-Type: application/vnd.ms-excel');
			header('Content-Disposition: attachment;filename="'.$filename.'"');
			header('Cache-Control: max-age=0');
						
			$objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel2007');  
			$objWriter->save('php://output');
		}
	}
}