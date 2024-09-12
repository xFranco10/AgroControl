<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Start extends CI_Controller {

	public function index()
	{
		redirect('Start/Inicio','refresh');
	}

	public function Inicio(){
		$this->load->view('PaginaPrincipal');
	}

	public function cerrarSession(){
        $this->session->sess_destroy();
		redirect('Start/Inicio','refresh');

    }
}
