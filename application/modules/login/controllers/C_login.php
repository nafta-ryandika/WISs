<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class C_login extends CI_Controller {
	public function index(){
		$this->load->view('V_login');
	}

	public function checkLogin(){
		$this->load->model("M_login");

		$inId = $this->input->post("inId");
		$inPassword = $this->input->post("inPassword");

		$check = $this->M_login->checkLogin($inId, $inPassword);

		if(!empty($check)){
			foreach($check as $data) {

				$session_data = array(
					'user_id'	  => $data->user_id,
					'user_name'   => $data->user_name,
					'user_email'  => $data->user_email
				);

				$this->session->set_userdata($session_data);
			}
			echo "success";
		} 
		else {
			echo "error";
		}

	}

	public function logout(){
        //hapus session
        $this->session->sess_destroy();

        redirect('login/C_login');
    }
}