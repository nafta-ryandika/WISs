<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class C_cardKerja extends CI_Controller {
	public function __construct() {        
        parent::__construct();

        //cek session login
        if($this->session->userdata("user_id") == "") {
            redirect('login/C_login');
        }

		$this->load->model("M_cardKerja");
    }

	public function index(){
		$this->load->view('element/V_header');
		$this->load->view('element/V_navbar');
		$this->load->view('V_content');
		$this->load->view('element/V_footer');
		
		$data['data'] = 'mCardKerja';
		$this->load->view('element/V_load',$data);
	}

	public function viewData(){
		$data['data'] = $this->M_cardKerja->viewData();
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
		$data['data'] = $this->M_cardKerja->export($inModalType,$inDatatablesParameter);

		if ($inModalType == 'pdf') {
			$html = $this->load->view('V_exportPdf',$data);

			$this->load->library('pdfgenerator');

			$data['title_pdf'] = 'Data Card Pekrjaaan';
			$file_pdf = 'Data Card Pekerjaan';
			$paper = 'A4';
			$orientation = "potrait";
			$html = $this->load->view('V_exportPdf',$data, TRUE);
			$this->pdfgenerator->generate($html, $file_pdf, $paper, $orientation, TRUE);
		}
		else if ($inModalType == 'xls') {
			$this->load->library('excel');
			$this->excel->setActiveSheetIndex(0);
			$this->excel->getActiveSheet()->setTitle('Data Master Pekerjaan');

			$this->excel->getActiveSheet()->setCellValue('A1', 'No');
			$this->excel->getActiveSheet()->setCellValue('B1', 'ID Card');
			$this->excel->getActiveSheet()->setCellValue('C1', 'Pekerjaan');
			$this->excel->getActiveSheet()->getStyle('A1:C1')->getFont()->setSize(12);
			$this->excel->getActiveSheet()->getStyle('A1:C1')->getFont()->setBold(true);

			$this->excel->getActiveSheet()->getStyle('A1:C1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

			$no = 1;
			$i = 2;
			foreach($data['data'] as $row){
				$this->excel->getActiveSheet()->setCellValue('A'.$i, $no);
				$this->excel->getActiveSheet()->setCellValue('B'.$i, $row->id);
				$this->excel->getActiveSheet()->setCellValue('C'.$i, $row->kerja_name);

				$no++;
				$i++;
			}
			
			$filename ='Data Card Pekerjaan.xls';
			header('Content-Type: application/vnd.ms-excel');
			header('Content-Disposition: attachment;filename="'.$filename.'"');
			header('Cache-Control: max-age=0');
						
			$objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel2007');  
			$objWriter->save('php://output');
		}
	}
}