<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class C_dashboard extends CI_Controller {
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
		$this->load->view('V_data');
		$this->load->view('element/V_footer');
	}

	public function viewData(){	
		$this->load->view('element/V_header');
		$this->load->view('element/V_navbar');
		$this->load->view('V_data');
		$this->load->view('element/V_footer');
	}
}