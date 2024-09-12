<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

	public function __construct(){
        parent::__construct();
		$this->load->database();
		$this->load->model('EmpleadosModel');

        $validacion = $this->session->has_userdata("session_actual");
		
        if ($validacion) {
            $session = $this->session->userdata("session_actual");
            if ($session['rol'] == "AGRICULTORES" || $session['rol'] == "JARDINEROS" || $session['rol'] == "OPERADOR MAQUINARIA" || $session['rol'] == "GANADEROS" || $session['rol'] == "ASEADOR" || $session['rol'] == "PERSONAL MANTENIMIENTO" || $session['rol'] == "MECANICO" && $session['estado'] == "ACTIVO") {
                return false;
            } else {
                redirect('Start/cerrarSession');
                die();
            }
        } else {
            redirect('Start/cerrarSession');
            die();
        }
    }


	public function Inicio(){
        $session = $this->session->userdata("session_actual");
		$id_usuario = $session['id_usuario']; 
		$data['session'] = $this->session->userdata("session_actual");
        
        $data['contadorAsignacionesPendientes'] = $this->EmpleadosModel->contarasignacionespendientes($id_usuario);
        $data['contadorAsignacionesProgreso'] = $this->EmpleadosModel->contarasignacionesprogreso($id_usuario);
        $data['contadorAsignacionesCompletadas'] = $this->EmpleadosModel->contarasignacionescompletadas($id_usuario);
        $data['contadorAsignacionesAtrasadas'] = $this->EmpleadosModel->contarasignacionesatrasadas($id_usuario);
        
		$this->load->view('Dashboard/empleados/plantilla', $data);
	}

	

	public function MiPerfil(){
		$data['session'] = $this->session->userdata("session_actual");
		$this->load->view('Dashboard/empleados/perfil', $data);
	}


	public function Asignaciones(){
        $session = $this->session->userdata("session_actual");
		$id_usuario = $session['id_usuario']; 
		$data['session'] = $this->session->userdata("session_actual");

		
		$data['asignacionesTotales'] = $this->EmpleadosModel->findAllasiganciones($id_usuario);
		$data['asignacionesEnProgreso'] = $this->EmpleadosModel->findAsigancionesEnProgreso($id_usuario);
		$data['asignacionesPendientes'] = $this->EmpleadosModel->findAsignacionesPendientes($id_usuario);
        $data['asignacionesCompletadas'] = $this->EmpleadosModel->findAsignacionesCompletadas($id_usuario);
        $data['asignacionesAtrasadas'] = $this->EmpleadosModel->findAsignacionesAtrasadas($id_usuario);
        $data['asignacionesSuspendidas'] = $this->EmpleadosModel->findAsignacionesSuspendidas($id_usuario);
        $data['asignacionesCanceladas'] = $this->EmpleadosModel->findAsignacionesCanceladas($id_usuario);

        $data['contadorTotalAsignaciones'] = $this->EmpleadosModel->contarasignacionestotales($id_usuario);
        $data['contadorAsignacionesPendientes'] = $this->EmpleadosModel->contarasignacionespendientes($id_usuario);
        $data['contadorAsignacionesProgreso'] = $this->EmpleadosModel->contarasignacionesprogreso($id_usuario);
        $data['contadorAsignacionesCompletadas'] = $this->EmpleadosModel->contarasignacionescompletadas($id_usuario);
        $data['contadorAsignacionesAtrasadas'] = $this->EmpleadosModel->contarasignacionesatrasadas($id_usuario);
        $data['contadorAsignacionesSuspendidas'] = $this->EmpleadosModel->contarasignacionessuspendidas($id_usuario);
        $data['contadorAsignacionesCanceladas'] = $this->EmpleadosModel->contarasignacionescanceladas($id_usuario);


		$this->load->view('Dashboard/empleados/asignaciones', $data);
	}
}
