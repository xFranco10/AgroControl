<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

	public function __construct(){
		parent::__construct();
        $this->load->database();
		$this->load->model('UsuariosModel'); 
    }

	public function index(){
		
	}

	public function validarInicioSession(){

		if ($this->input->server("REQUEST_METHOD") == "POST") {
			$email = $this->input->post('email');
			$password = $this->input->post('password');

			if ($email != '' && $password != '') {
				$validacion = $this->UsuariosModel->validarIngreso($email, $password);

				if ($validacion == true) {
					$datosUsuario = $this->UsuariosModel->getUsuarioByEmail($email);
					

					$dataSession = [
						"id_usuario" => $datosUsuario->id_usuario,
						"documento" => $datosUsuario->documento,
						"nombre" => $datosUsuario->nombre,
						"apellido" => $datosUsuario->apellido,
						"telefono" => $datosUsuario->telefono,
						"direccion" => $datosUsuario->direccion,
						"rol" => $datosUsuario->rol,
						"estado" => $datosUsuario->estado,
						"email" => $datosUsuario->email,
						"passw" => $datosUsuario->passw,
						"imguser" => $datosUsuario->imguser,
					];

					$this->session->set_userdata("session_actual", $dataSession);

					if ($datosUsuario->rol == "SUPERADMIN") {
						redirect('superadmin/Dashboard/Inicio', 'refresh');
					} else if ($datosUsuario->rol == "ADMIN") {
						redirect('superadmin/dashboard/Inicio', 'refresh');
					} else if ($datosUsuario->rol == "AGRICULTORES" || $datosUsuario->rol == "JARDINEROS" || $datosUsuario->rol == "OPERADOR MAQUINARIA" || $datosUsuario->rol == "GANADEROS" || $datosUsuario->rol == "ASEADOR" || $datosUsuario->rol == "PERSONAL MANTENIMIENTO" || $datosUsuario->rol == "MECANICO") {
						redirect('empleados/dashboard/Inicio', 'refresh');
					} else {
						redirect('Start', 'refresh');
					}
				} else {
					$data['datosInvalidos'] = true;
					redirect('Start', 'refresh');
					//usuario no existe
					
				}
			} else {
				// creamos variables de data para decir que faltan datos por llenar
				$data['ErrorInData'] = true;
				$data['valuePassword'] = $password;
				// este se encarga de redicrecionar la vista si los datos no son ingresados correctamente 
				redirect('Start', 'refresh');
				
			}
		}
	}
	

}