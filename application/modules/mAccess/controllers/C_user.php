<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class C_user extends CI_Controller {
	public function __construct() {        
        parent::__construct();

        //cek session login
        if($this->session->userdata("user_id") == "") {
            redirect('login/C_login');
        }
    }

	public function index(){
		$this->load->view('element/V_header');
		$this->load->view('element/V_navbar');
		$this->load->view('V_content');
		$this->load->view('element/V_footer');
		
		$data['data'] = 'user';
		$this->load->view('element/V_load',$data);
	}

	public function viewData(){
		$this->load->model("M_user");
		$data['data'] = $this->M_user->viewData();
		$this->load->view('V_data',$data);
	}

	public function viewInput(){
		$inMode = $this->input->post("inMode");
		$inId = $this->input->post("inId");
		$inName = $this->input->post("inName");
		$inEmail = $this->input->post("inEmail");
		$inDepartment = $this->input->post("inDepartment");
		$inDivision = $this->input->post("inDivision");
		$inLevel = $this->input->post("inLevel");
		$inPassword = $this->input->post("inPassword");
		
		$data['inMode'] = $inMode;
		$data['inId'] = $inId;
		$data['inName'] = $inName;
		$data['inEmail'] = $inEmail;
		$data['inDepartment'] = $inDepartment;
		$data['inDivision'] = $inDivision;
		$data['inLevel'] = $inLevel;
		$data['inPassword'] = $inPassword;

		$this->load->model("M_user");
		$data['department'] = $this->M_user->getDepartment();
		$data['level'] = $this->M_user->getLevel();

		$this->load->view('V_input',$data);
	}

	public function getDivision(){
		$inDepartment = $this->input->post('inDepartment');
		$this->load->model("M_user");

		$data = $this->M_user->getDivision($inDepartment);
		echo json_encode($data);
	}

	public function addUser(){
		$inMode = $this->input->post('inMode');
		$inId = $this->input->post('inId');
		$inName = $this->input->post('inName');
		$inEmail = $this->input->post('inEmail');
		$inDepartment = $this->input->post('inDepartment');
		$inDivision = $this->input->post('inDivision');
		$inLevel = $this->input->post('inLevel');
		$inPassword = $this->input->post('inPassword');

		$this->load->model('M_user');

		$res = $this->M_user->addUser($inMode,$inId,$inName,$inEmail,$inDepartment,$inDivision,$inLevel,$inPassword);
		echo ($res);
	}

	public function getUser(){
		$inId = $this->input->post('inId');
		$this->load->model('M_user');

		$res = $this->M_user->getUser($inId);
		echo json_encode($res);
	}

	public function deleteUser(){
		$inId = $this->input->post('inId');

		$this->load->model('M_user');

		$res = $this->M_user->deleteUser($inId);
		echo ($res);
	}

	public function getOption(){
		$inIdx = $this->input->post('inIdx');
		$this->load->model("M_user");

		$data = $this->M_user->getOption($inIdx);
		echo json_encode($data);
	}

	public function exportXls(){
		$this->load->library('pdfGenerator');

		$this->load->model("M_user");
		$this->data['data'] = $this->M_user->exportXls();

        $this->data['title_pdf'] = 'Laporan Master Data User';
        
        // filename dari pdf ketika didownload
        $file_pdf = 'laporan_penjualan_toko_kita';
        // setting paper
        $paper = 'A4';
        //orientasi paper potrait / landscape
        $orientation = "landscape";
        
		$html = $this->load->view('V_exportPdf',$this->data, true);	    
        
        // run dompdf
        $this->pdfgenerator->generate($html, $file_pdf,$paper,$orientation);
	}
}