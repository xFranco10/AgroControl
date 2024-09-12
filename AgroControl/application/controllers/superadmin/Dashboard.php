<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

	public function __construct(){
        parent::__construct();
		$this->load->database();
		$this->load->model('ProveedoresModel');
		$this->load->model('UsuariosModel');
		$this->load->model('RepuestosModel');
		$this->load->model('ActividadesModel');
		$this->load->model('MaquinariaModel');
		$this->load->model('AsignacionesModel');


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


	public function Inicio(){
		$data['usuariostotales'] = $this->UsuariosModel->ContarUsuariosDelSistema();
		$data['maquinastotales'] = $this->MaquinariaModel->ContarMaquinariaDelSistema();
		$data['proveedorestotales'] = $this->ProveedoresModel->ContarProveedoresDelSistema();
		$data['actividadestotales'] = $this->ActividadesModel->ContarActividadesDelSistema();


        $data['session'] = $this->session->userdata("session_actual");
		$this->load->view('Dashboard/superadmin/plantilla', $data);
	}


	public function Usuarios(){
        $session = $this->session->userdata("session_actual");
		$id_usuario = $session['id_usuario']; 
		
		$data['Usuarios'] = $this->UsuariosModel->findAll($id_usuario);
		$data['session'] = $this->session->userdata("session_actual");
		$this->load->view('Dashboard/superadmin/usuarios', $data);
	}


	public function Proveedores(){
		$data['Proveedores'] = $this->ProveedoresModel->findAll();

		$data['session'] = $this->session->userdata("session_actual");
		$this->load->view('Dashboard/superadmin/proveedores', $data);
	}


	public function MiPerfil(){
		$data['session'] = $this->session->userdata("session_actual");
		$this->load->view('Dashboard/superadmin/perfil', $data);
	}


	public function Repuestos(){
        $data['repuestos'] = $this->RepuestosModel->getAllRepuestos();
        $data['proveedores'] = $this->RepuestosModel->getIdNameProveedores();
        $data['session'] = $this->session->userdata("session_actual");
		$this->load->view('Dashboard/superadmin/Repuestos', $data);
    }


	public function Actividades(){
		$data['Actividades'] = $this->ActividadesModel->findAll();

		$data['session'] = $this->session->userdata("session_actual");
		$this->load->view('Dashboard/superadmin/actividades', $data);
	}

	
	public function Maquinaria(){
		$data['maquinas'] = $this->MaquinariaModel->findAll();

		$data['session'] = $this->session->userdata("session_actual");
		$this->load->view('Dashboard/superadmin/maquinaria', $data);
	}

	public function Asignaciones(){
		$data['asignaciones'] = $this->AsignacionesModel->findAll();
		$data['actividades'] = $this->AsignacionesModel->getIdNameActividades();
		$data['usuarios'] = $this->AsignacionesModel->getIdNameUsuarios();
		$data['maquinarias'] = $this->AsignacionesModel->getIdNameMaquinarias();
		

		$data['session'] = $this->session->userdata("session_actual");
		$this->load->view('Dashboard/superadmin/asignaciones', $data);
	}
}
