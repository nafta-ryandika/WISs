<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class C_recTransaction extends CI_Controller {
	public function __construct() {        
        parent::__construct();

		$this->load->model("M_recTransaction");
    }

	public function index(){
		$this->load->view('element/V_header');
		// $this->load->view('element/V_navbar');
		$this->load->view('V_content');
		$this->load->view('element/V_footer');
		
		$data['data'] = 'recTransaction';
		$this->load->view('element/V_load',$data);
	}

	public function viewData(){
		$inCardId = $this->input->post("inCardId");

		$data['data'] = $this->M_recTransaction->viewData($inCardId);
		$this->load->view('V_data',$data);
	}
}