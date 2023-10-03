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
		$inModalParameter = $this->input->get('inModalParameter');
		$inDatatablesParameter = $this->input->get('inDatatablesParameter');

		if ($inModalType == 'pdf') {
			$this->load->model("M_user");
			$data['data'] = $this->M_user->export($inModalType,$inModalParameter,$inDatatablesParameter);
			$html = $this->load->view('V_exportPdf',$data);

			$this->load->library('pdfgenerator');

			$data['title_pdf'] = 'Report Data Master User';
			$file_pdf = 'Report Data Master User';
			$paper = 'A4';
			$orientation = "landscape";
			$html = $this->load->view('V_exportPdf',$data, TRUE);
			$this->pdfgenerator->generate($html, $file_pdf, $paper, $orientation, TRUE);
		}
	}
}