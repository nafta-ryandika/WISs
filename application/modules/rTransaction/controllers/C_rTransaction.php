<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class C_rTransaction extends CI_Controller {
	public function __construct() {        
        parent::__construct();

        //cek session login
        if($this->session->userdata("user_id") == "") {
            redirect('login/C_login');
        }

		$this->load->model("M_rTransaction");
    }

	public function index(){
		$this->load->view('element/V_header');
		$this->load->view('element/V_navbar');
		$this->load->view('V_content');
		$this->load->view('element/V_footer');
		
		$data['data'] = 'rTransaction';
		$this->load->view('element/V_load',$data);
	}

	public function viewData(){
		$data['data'] = $this->M_rTransaction->viewData();
		$this->load->view('V_data',$data);
	}

	public function export(){
		$inModalType = $this->input->get('inModalType');
		$inDatatablesParameter = $this->input->get('inDatatablesParameter');
		$data['data'] = $this->M_rTransaction->export($inModalType,$inDatatablesParameter);

		if ($inModalType == 'pdf') {
			$html = $this->load->view('V_exportPdf',$data);

			$this->load->library('pdfgenerator');

			$data['title_pdf'] = 'Report Transaction';
			$file_pdf = 'Report Transaction';
			$paper = 'A4';
			$orientation = "potrait";
			$html = $this->load->view('V_exportPdf',$data, TRUE);
			$this->pdfgenerator->generate($html, $file_pdf, $paper, $orientation, TRUE);
		}
		else if ($inModalType == 'xls') {
			$this->load->library('excel');
			$this->excel->setActiveSheetIndex(0);
			$this->excel->getActiveSheet()->setTitle('Report Transaction');

			$this->excel->getActiveSheet()->setCellValue('A1', 'No');
			$this->excel->getActiveSheet()->setCellValue('B1', 'ID');
			$this->excel->getActiveSheet()->setCellValue('C1', 'Nama');
			$this->excel->getActiveSheet()->setCellValue('D1', 'Tanggal');
			$this->excel->getActiveSheet()->setCellValue('E1', 'Pekerjaan');
			$this->excel->getActiveSheet()->setCellValue('F1', 'Jumlah');
			$this->excel->getActiveSheet()->setCellValue('G1', 'Satuan');
			$this->excel->getActiveSheet()->setCellValue('H1', 'Harga');
			$this->excel->getActiveSheet()->setCellValue('I1', 'Sub Total');
			$this->excel->getActiveSheet()->getStyle('A1:I1')->getFont()->setSize(12);
			$this->excel->getActiveSheet()->getStyle('A1:I1')->getFont()->setBold(true);

			$this->excel->getActiveSheet()->getStyle('A1:I1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

			$no = 1;
			$i = 2;
			foreach($data['data'] as $row){
				$subtotal = ($row->jumlah)*($row->harga);
				$this->excel->getActiveSheet()->setCellValue('A'.$i, $no);
				$this->excel->getActiveSheet()->setCellValue('B'.$i, $row->id);
				$this->excel->getActiveSheet()->setCellValue('C'.$i, $row->name);
				$this->excel->getActiveSheet()->setCellValue('D'.$i, $row->date);
				$this->excel->getActiveSheet()->setCellValue('E'.$i, $row->pekerjaan);
				$this->excel->getActiveSheet()->setCellValue('F'.$i, $row->jumlah);
				$this->excel->getActiveSheet()->setCellValue('G'.$i, $row->satuan);
				$this->excel->getActiveSheet()->setCellValue('H'.$i, $row->harga);
				$this->excel->getActiveSheet()->setCellValue('I'.$i, $subtotal);

				$no++;
				$i++;
			}
			
			$filename ='Report Transaction.xls';
			header('Content-Type: application/vnd.ms-excel');
			header('Content-Disposition: attachment;filename="'.$filename.'"');
			header('Cache-Control: max-age=0');
						
			$objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel2007');  
			$objWriter->save('php://output');
		}
	}
}