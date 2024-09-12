<?php
defined('BASEPATH') or exit('No direct script access allowed');

class ActividadesController extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
        $this->load->database();
		$this->load->model('ActividadesModel');

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


	public function CrearActividad(){
		$caracteres_permitidos = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
		$longitud = 10;
		$id_actividad = '';

		for ($i = 0; $i < $longitud; $i++) {
			$indice_aleatorio = rand(0, strlen($caracteres_permitidos) - 1);
			$caracter_aleatorio = $caracteres_permitidos[$indice_aleatorio];
			$id_actividad .= $caracter_aleatorio;
		}

		if ($this->input->server("REQUEST_METHOD") == "POST") {

			$nombre = $this->input->post("nombre");
			$descripcion = $this->input->post("descripcion");
			$ubicacion = $this->input->post("ubicacion");
			$estado = $this->input->post("estado");
			$prioridad = $this->input->post("prioridad");

			if ($nombre && $descripcion && $ubicacion && $estado && $prioridad != "") {
				$this->ActividadesModel->insertarActividades($id_actividad, $nombre, $descripcion, $ubicacion, $estado, $prioridad);

				$data['Actividades'] = $this->ActividadesModel->findAll();
				$data['session'] = $this->session->userdata("session_actual");
				$data['actividadinsertada']=true;
				$this->load->view('Dashboard/superadmin/Actividades', $data);
			}else{
				$data['Actividades'] = $this->ActividadesModel->findAll();
				$data['session'] = $this->session->userdata("session_actual");
				$data['camposvacios']=true;
				$this->load->view('Dashboard/superadmin/Actividades', $data);			
			}
		}
	}


	public function EditarActividad($id_actividad = null){
		$id_actividad = $id_actividad;
		$data['session'] = $this->session->userdata("session_actual");

		$actividad = $this->ActividadesModel->findById($id_actividad);
		$data['actividad'] = $actividad;
		$this->load->view('Dashboard/superadmin/EditarActividades', $data);
	}


	public function ActualizarActividades(){
		$id = $this->input->post('id_actividad');
		$nombre = $this->input->post('nombre');
		$descripcion = $this->input->post('descripcion');
		$ubicacion = $this->input->post('ubicacion');
		$estado = $this->input->post('estado');
		$prioridad = $this->input->post('prioridad');

		if ($id && $nombre && $descripcion && $ubicacion && $estado && $prioridad != "") {
			$this->ActividadesModel->actualizaractividad($id, $nombre, $descripcion, $ubicacion, $estado, $prioridad);

			$data['Actividades'] = $this->ActividadesModel->findAll();
			$data['session'] = $this->session->userdata("session_actual");
			$data['actividadactualizada']=true;
			$this->load->view('Dashboard/superadmin/Actividades', $data);
		}else{
			$actividad = $this->ActividadesModel->findById($id);
			$data['session'] = $this->session->userdata("session_actual");
			$data['actividad'] = $actividad;
			$data['camposvacios']=true;
			$this->load->view('Dashboard/superadmin/EditarActividades', $data);
		}
	}


	public function deleteActividad($id_actividad)
	{
		$this->ActividadesModel->deleteActividad($id_actividad);
		redirect('superadmin/dashboard/Actividades/', 'refresh');
	}
}
