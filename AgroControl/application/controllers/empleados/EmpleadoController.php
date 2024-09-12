<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class EmpleadoController extends CI_Controller {

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

    public function ActualizarMiPerfil() {
        $id = $this->input->post('id');
        $cedula = $this->input->post('cedula');
        $nombre = $this->input->post('nombre');
        $apellido = $this->input->post('apellido');
        $telefono = $this->input->post('telefono');
        $direccion = $this->input->post('direccion');
        $email = $this->input->post('email');

		if($cedula && $nombre && $apellido && $telefono && $direccion && $email != ""){
                
			$cedulaValida = $this->EmpleadosModel->ReValidarCedula($cedula, $id);
			$userValido = $this->EmpleadosModel->ReValidarEmail($email, $id);

			if($cedulaValida && $userValido){
				$this->EmpleadosModel->actualizarPerfil($id, $cedula, $nombre, $apellido, $telefono, $direccion, $email);
				
				$data['perfilactualizado'] = true;
				$data['session'] = $this->session->userdata("session_actual");
				$this->load->view('Dashboard/empleados/perfil', $data);
			}else{
				$data['datosrepetidos'] = true;
				$data['session'] = $this->session->userdata("session_actual");
				$this->load->view('Dashboard/empleados/perfil', $data);
			}
		}else{
			$data['camposvacios'] = true;
			$data['session'] = $this->session->userdata("session_actual");
			$this->load->view('Dashboard/empleados/perfil', $data);
		}
	}
	

	public function cambiarPassword($id){
        $CurrentPasword = $this->input->post('CurrentPassword');
        $NewPassword = $this->input->post('nuevaPassword');
        $ConfirmPassword = $this->input->post('confirmarPassword');
		
		$datoUsuario = $this->EmpleadosModel->getCurrentPassword($id);
		$contrasenaEnBdD = $datoUsuario->passw;

		if($CurrentPasword && $NewPassword && $ConfirmPassword != ""){
			if(md5($CurrentPasword) == $contrasenaEnBdD){
				if($NewPassword == $ConfirmPassword){
					$this->EmpleadosModel->UpdatePassword($id, $NewPassword);

					$data['passwordActualizada'] = true;
					$data['session'] = $this->session->userdata("session_actual");
					$this->load->view('Dashboard/empleados/perfil', $data);
				}else{										
					$data['NewPasswordNoCoincide'] = true;
					$data['session'] = $this->session->userdata("session_actual");
					$this->load->view('Dashboard/empleados/perfil', $data);
				}
			}else{
				$data['passwordincorrecta'] = true;
				$data['session'] = $this->session->userdata("session_actual");
				$this->load->view('Dashboard/empleados/perfil', $data);
			}
		}else{
			$data['camposvacios'] = true;
			$data['session'] = $this->session->userdata("session_actual");
			$this->load->view('Dashboard/empleados/perfil', $data);
		}
	}

	function cargar_imagen() {
        $id_usuario = $this->input->post('id_usuario');
		$nombreArchivo = $_FILES["upload"]["name"];
		
        $mi_archivo = 'upload';
        $config['upload_path'] = "uploads/";
        $config['file_name'] = "UserImg@".$id_usuario."-".$nombreArchivo;
        $config['allowed_types'] = "jpg|jpeg|png";
        $config['max_size'] = "50000";
        $config['max_width'] = "2000";
        $config['max_height'] = "2000";

        $this->load->library('upload', $config);
        
		if (isset($_FILES["upload"]) && $_FILES["upload"]["error"] == 0) {
			if (!$this->upload->do_upload($mi_archivo)) {
				//*** ocurrio un error
				//$data['uploadError'] = $this->upload->display_errors();
				//echo $this->upload->display_errors();
				//return;
				$data['formatoincorrecto'] = true;
				$data['session'] = $this->session->userdata("session_actual");
				$this->load->view('Dashboard/empleados/perfil', $data);
			}else{
				//var_dump($this->upload->data());
				$nombreImagen = $config['file_name'];
				$nombreImagensinespacios = str_replace(" ", "_", $nombreImagen);
				$imguser = $nombreImagensinespacios;
				
				$this->EmpleadosModel->UpdateProfilePic($id_usuario, $imguser);
				$data['ImgProfileActualizada'] = true;
				$data['session'] = $this->session->userdata("session_actual");
				$this->load->view('Dashboard/empleados/perfil', $data);
			}
		} else {
			$data['camposvacios'] = true;
			$data['session'] = $this->session->userdata("session_actual");
			$this->load->view('Dashboard/empleados/perfil', $data);
		}
    }


}
