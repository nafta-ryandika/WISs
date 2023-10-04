<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class C_satuan extends CI_Controller {
	public function __construct() {        
        parent::__construct();

        //cek session login
        if($this->session->userdata("user_id") == "") {
            redirect('login/C_login');
        }

		$this->load->model("M_satuan");
    }

	public function index(){
		$this->load->view('element/V_header');
		$this->load->view('element/V_navbar');
		$this->load->view('V_content');
		$this->load->view('element/V_footer');
		
		$data['data'] = 'mSatuan';
		$this->load->view('element/V_load',$data);
	}

	public function viewData(){
		$data['data'] = $this->M_satuan->viewData();
		$this->load->view('V_data',$data);
	}

	public function viewInput(){
		$inMode = $this->input->post("inMode");
		$inSatuanId = $this->input->post("inSatuanId");
		$inSatuanName = $this->input->post("inSatuanName");
		
		$data['inMode'] = $inMode;
		$data['inSatuanId'] = $inSatuanId;
		$data['inSatuanName'] = $inSatuanName;
		
		$this->load->view('V_input',$data);
	}

	public function addSatuan(){
		$inMode = $this->input->post('inMode');
		$inSatuanId = $this->input->post('inSatuanId');
		$inSatuanName = $this->input->post('inSatuanName');

		$res = $this->M_satuan->addSatuan($inMode,$inSatuanId,$inSatuanName);
		echo ($res);
	}

	public function getSatuan(){
		$inSatuanId = $this->input->post('inSatuanId');

		$res = $this->M_satuan->getSatuan($inSatuanId);
		echo json_encode($res);
	}

	public function deleteSatuan(){
		$inSatuanId = $this->input->post('inSatuanId');

		$this->load->model('M_satuan');

		$res = $this->M_satuan->deleteSatuan($inSatuanId);
		echo ($res);
	}

	public function export(){
		$inModalType = $this->input->get('inModalType');
		$inDatatablesParameter = $this->input->get('inDatatablesParameter');
		$data['data'] = $this->M_satuan->export($inModalType,$inDatatablesParameter);

		if ($inModalType == 'pdf') {
			$html = $this->load->view('V_exportPdf',$data);

			$this->load->library('pdfgenerator');

			$data['title_pdf'] = 'Data Master Satuan';
			$file_pdf = 'Data Master Satuan';
			$paper = 'A4';
			$orientation = "landscape";
			$html = $this->load->view('V_exportPdf',$data, TRUE);
			$this->pdfgenerator->generate($html, $file_pdf, $paper, $orientation, TRUE);
		}
		else if ($inModalType == 'xls') {
			$this->load->library('excel');
			$this->excel->setActiveSheetIndex(0);
			$this->excel->getActiveSheet()->setTitle('Data Master Satuan');

			$this->excel->getActiveSheet()->setCellValue('A1', 'No');
			$this->excel->getActiveSheet()->setCellValue('B1', 'Satuan ID');
			$this->excel->getActiveSheet()->setCellValue('C1', 'Satuan Name');
			$this->excel->getActiveSheet()->setCellValue('D1', 'Created By');
			$this->excel->getActiveSheet()->setCellValue('E1', 'Created At');
			$this->excel->getActiveSheet()->getStyle('A1:E1')->getFont()->setSize(12);
			$this->excel->getActiveSheet()->getStyle('A1:E1')->getFont()->setBold(true);

			$this->excel->getActiveSheet()->getStyle('A1:E1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

			$no = 1;
			$i = 2;
			foreach($data['data'] as $row){
				$this->excel->getActiveSheet()->setCellValue('A'.$i, $no);
				$this->excel->getActiveSheet()->setCellValue('B'.$i, $row->satuan_id);
				$this->excel->getActiveSheet()->setCellValue('C'.$i, $row->satuan_name);
				$this->excel->getActiveSheet()->setCellValue('D'.$i, $row->satuan_created_by);
				$this->excel->getActiveSheet()->setCellValue('E'.$i, $row->satuan_created_at);

				$no++;
				$i++;
			}
			
			$filename ='Data Master Satuan.xls';
			header('Content-Type: application/vnd.ms-excel');
			header('Content-Disposition: attachment;filename="'.$filename.'"');
			header('Cache-Control: max-age=0');
						
			$objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel2007');  
			$objWriter->save('php://output');
		}
	}
}