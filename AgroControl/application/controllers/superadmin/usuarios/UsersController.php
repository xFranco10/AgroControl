<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class UsersController extends CI_Controller {


	public function __construct(){
        parent::__construct();
		$this->load->database();
		$this->load->model('UsuariosModel');

        $validacion = $this->session->has_userdata("session_actual");
		
        if ($validacion) {
            $session = $this->session->userdata("session_actual");
            if ($session['rol'] == "SUPERADMIN" && $session['estado'] == "ACTIVO") {
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


    public function CrearUsuario(){
		$caracteres_permitidos = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
		$longitud = 10;
		$id_usuario = '';

		for ($i = 0; $i < $longitud; $i++) {
			$indice_aleatorio = rand(0, strlen($caracteres_permitidos) - 1);
			$caracter_aleatorio = $caracteres_permitidos[$indice_aleatorio];
			$id_usuario .= $caracter_aleatorio;
		}

		if($this->input->server("REQUEST_METHOD")=="POST"){
			$cedula = $this->input->post("documento");
            $nombre = $this->input->post("nombres");
            $apellido = $this->input->post("apellidos");
            $telefono = $this->input->post("telefono");
            $direccion = $this->input->post("direccion");
			$email = $this->input->post("email");
			$password = $this->input->post("password");
			$rol = $this->input->post("rol");
			$estado = $this->input->post("estado");
			$imguser = "default.png"; 
			
            if($id_usuario && $cedula && $nombre && $apellido && $telefono && $direccion && $email && $password && $rol && $estado && $imguser != ""){
                
				$cedulaValida = $this->UsuariosModel->validarCedula($cedula);
				$emailValido = $this->UsuariosModel->validarEmail($email);

				if($cedulaValida && $emailValido){
					$this->UsuariosModel->insertar($id_usuario, $cedula, $nombre, $apellido, $telefono, $direccion, $email, $rol, $estado, $password, $imguser);
					
					$session = $this->session->userdata("session_actual");
					$id_usuario = $session['id_usuario'];  

					$data['Usuarios'] = $this->UsuariosModel->findAll($id_usuario);
					$data['session'] = $this->session->userdata("session_actual");
					$data['usuarioinsertado']=true;
					$this->load->view('Dashboard/superadmin/usuarios', $data);
					
				}else{
					$session = $this->session->userdata("session_actual");
					$id_usuario = $session['id_usuario'];  

					$data['Usuarios'] = $this->UsuariosModel->findAll($id_usuario);
					$data['session'] = $this->session->userdata("session_actual");
					$data['datorepetido']=true;
					$this->load->view('Dashboard/superadmin/usuarios', $data);
				}
            }else{
				$session = $this->session->userdata("session_actual");
				$id_usuario = $session['id_usuario'];  

				$data['Usuarios'] = $this->UsuariosModel->findAll($id_usuario);
				$data['session'] = $this->session->userdata("session_actual");
				$data['camposvacios']=true;
				$this->load->view('Dashboard/superadmin/usuarios', $data);
            }
		}
	}


	public function EditarUsuario($id_usuario=null) {
        $id_usuario = $id_usuario;
		$data['session'] = $this->session->userdata("session_actual");

        $DatosUsuario = $this->UsuariosModel->findByid($id_usuario);
        $data['usuario'] = $DatosUsuario;
		$this->load->view('Dashboard/superadmin/Editar', $data);
	}


    public function ActualizarDatosUsuario() {
        $id = $this->input->post('id');
        $cedula = $this->input->post('cedula');
        $nombre = $this->input->post('nombre');
        $apellido = $this->input->post('apellido');
        $telefono = $this->input->post('telefono');
        $direccion = $this->input->post('direccion');
        $email = $this->input->post('email');
        $rol = $this->input->post('rol');
        $estado = $this->input->post('estado');

		if($cedula && $nombre && $apellido && $telefono && $direccion && $email && $rol && $estado != ""){
                
			$cedulaValida = $this->UsuariosModel->ReValidarCedula($cedula, $id);
			$userValido = $this->UsuariosModel->ReValidarEmail($email, $id);

			if($cedulaValida && $userValido){
				$this->UsuariosModel->actualizarUsuario($id, $cedula, $nombre, $apellido, $telefono, $direccion, $email, $rol, $estado);
				$session = $this->session->userdata("session_actual");
				$id_usuario = $session['id_usuario'];  

				$data['Usuarios'] = $this->UsuariosModel->findAll($id_usuario);
				$data['session'] = $this->session->userdata("session_actual");
				$data['usuarioactualizado']=true;
				$this->load->view('Dashboard/superadmin/usuarios', $data);
			}else{
				$session = $this->session->userdata("session_actual");
				$DatosUsuario = $this->UsuariosModel->findByid($id);
				
				$data['session'] = $this->session->userdata("session_actual");
				$data['usuario'] = $DatosUsuario;
				$data['datorepetido']=true;

				$this->load->view('Dashboard/superadmin/Editar', $data);
			}
		}else{
			$session = $this->session->userdata("session_actual");
			$DatosUsuario = $this->UsuariosModel->findByid($id);

			$data['session'] = $this->session->userdata("session_actual");
			$data['usuario'] = $DatosUsuario;
			$data['camposvacios']=true;
			
			$this->load->view('Dashboard/superadmin/Editar', $data);
		}
	}

	public function deleteUsuario($id_usuario){
        $this->UsuariosModel->delete($id_usuario);
		redirect('superadmin/Dashboard/Usuarios', 'refresh');
    }


	public function ActualizarMiPerfil() {
        $id = $this->input->post('id');
        $cedula = $this->input->post('cedula');
        $nombre = $this->input->post('nombre');
        $apellido = $this->input->post('apellido');
        $telefono = $this->input->post('telefono');
        $direccion = $this->input->post('direccion');
        $email = $this->input->post('email');
        $tipo = $this->input->post('rol');
        $estado = $this->input->post('estado');

		if($cedula && $nombre && $apellido && $telefono && $direccion && $email != ""){
                
			$cedulaValida = $this->UsuariosModel->ReValidarCedula($cedula, $id);
			$userValido = $this->UsuariosModel->ReValidarEmail($email, $id);

			if($cedulaValida && $userValido){
				$this->UsuariosModel->actualizarPerfil($id, $cedula, $nombre, $apellido, $telefono, $direccion, $email, $tipo, $estado);
				
				$data['perfilactualizado'] = true;
				$data['session'] = $this->session->userdata("session_actual");
				$this->load->view('Dashboard/superadmin/perfil', $data);
			}else{
				$data['datosrepetidos'] = true;
				$data['session'] = $this->session->userdata("session_actual");
				$this->load->view('Dashboard/superadmin/perfil', $data);
			}
		}else{
			$data['camposvacios'] = true;
			$data['session'] = $this->session->userdata("session_actual");
			$this->load->view('Dashboard/superadmin/perfil', $data);
		}
	}
	

	public function cambiarPassword($id){
        $CurrentPasword = $this->input->post('CurrentPassword');
        $NewPassword = $this->input->post('nuevaPassword');
        $ConfirmPassword = $this->input->post('confirmarPassword');
		
		$datoUsuario = $this->UsuariosModel->getCurrentPassword($id);
		$contrasenaEnBdD = $datoUsuario->passw;

		if($CurrentPasword && $NewPassword && $ConfirmPassword != ""){
			if(md5($CurrentPasword) == $contrasenaEnBdD){
				if($NewPassword == $ConfirmPassword){
					$this->UsuariosModel->UpdatePassword($id, $NewPassword);

					$data['passwordActualizada'] = true;
					$data['session'] = $this->session->userdata("session_actual");
					$this->load->view('Dashboard/superadmin/perfil', $data);
				}else{										
					$data['NewPasswordNoCoincide'] = true;
					$data['session'] = $this->session->userdata("session_actual");
					$this->load->view('Dashboard/superadmin/perfil', $data);
				}
			}else{
				$data['passwordincorrecta'] = true;
				$data['session'] = $this->session->userdata("session_actual");
				$this->load->view('Dashboard/superadmin/perfil', $data);
			}
		}else{
			$data['camposvacios'] = true;
			$data['session'] = $this->session->userdata("session_actual");
			$this->load->view('Dashboard/superadmin/perfil', $data);
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
				$this->load->view('Dashboard/superadmin/perfil', $data);
			}else{
				//var_dump($this->upload->data());
				$nombreImagen = $config['file_name'];
				$nombreImagensinespacios = str_replace(" ", "_", $nombreImagen);
				$imguser = $nombreImagensinespacios;
				
				$this->UsuariosModel->UpdateProfilePic($id_usuario, $imguser);
				$data['ImgProfileActualizada'] = true;
				$data['session'] = $this->session->userdata("session_actual");
				$this->load->view('Dashboard/superadmin/perfil', $data);
			}
		} else {
			$data['camposvacios'] = true;
			$data['session'] = $this->session->userdata("session_actual");
			$this->load->view('Dashboard/superadmin/perfil', $data);
		}
    }
}
