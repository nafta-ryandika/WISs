<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class C_getDataAbsensi extends CI_Controller {
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
		
		$data['data'] = 'getDataAbsensi';
		$this->load->view('element/V_load',$data);
	}

	public function viewData(){
		$this->load->model("M_getDataAbsensi");
		$data['data'] = $this->M_getDataAbsensi->viewData();
		$this->load->view('V_data',$data);
	}

	public function processData(){
		$inDate1 = $this->input->post('inDate1');
		$inDate2 = $this->input->post('inDate2');

		$this->load->model('M_getDataAbsensi');

		$res = $this->M_getDataAbsensi->processData($inDate1,$inDate2);
		echo ($res);
	}
}