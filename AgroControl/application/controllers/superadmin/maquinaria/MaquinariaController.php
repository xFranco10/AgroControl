<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MaquinariaController extends CI_Controller {
	public function __construct(){
        parent::__construct();
		$this->load->database();
		$this->load->model('MaquinariaModel');

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


    public function RegistrarMaquinaria(){
		$caracteres_permitidos = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
		$longitud = 10;
		$id_maquinaria = '';

		for ($i = 0; $i < $longitud; $i++) {
			$indice_aleatorio = rand(0, strlen($caracteres_permitidos) - 1);
			$caracter_aleatorio = $caracteres_permitidos[$indice_aleatorio];
			$id_maquinaria .= $caracter_aleatorio;
		}

		if($this->input->server("REQUEST_METHOD")=="POST"){
            $num_serie = $this->input->post("num_serie");
            $nombre = $this->input->post("nombre");
            $fabricante = $this->input->post("fabricante");
            $fecha_adquisicion = $this->input->post("fecha_adquisicion");
            $costo_adquisicion = $this->input->post("costo_adquisicion");
			$tipo = $this->input->post("tipo");
			$estado = $this->input->post("estado");

            if($id_maquinaria && $num_serie && $nombre && $fabricante && $fecha_adquisicion && $costo_adquisicion && $tipo && $estado != ""){
                
				$numserieValido = $this->MaquinariaModel->ValidarNumSerie($num_serie);

				if($numserieValido){
					$this->MaquinariaModel->insertar($id_maquinaria, $num_serie, $nombre, $fabricante, $fecha_adquisicion, $costo_adquisicion, $tipo, $estado);
					
					$data['maquinas'] = $this->MaquinariaModel->findAll();
					$data['session'] = $this->session->userdata("session_actual");
					$data['maquinariainsertada']=true;
					$this->load->view('Dashboard/superadmin/Maquinaria', $data);
					
				}else{
					$data['maquinas'] = $this->MaquinariaModel->findAll();
					$data['session'] = $this->session->userdata("session_actual");
					$data['datorepetido']=true;
					$this->load->view('Dashboard/superadmin/Maquinaria', $data);				
				}
            }else{
				$data['maquinas'] = $this->MaquinariaModel->findAll();
				$data['session'] = $this->session->userdata("session_actual");
				$data['camposvacios']=true;
				$this->load->view('Dashboard/superadmin/Maquinaria', $data);            
			}
		}
	}


	public function EditarMaquinaria($id_maquinaria=null) {
        $id_maquinaria = $id_maquinaria;
		$data['session'] = $this->session->userdata("session_actual");

        $DatosMaquinaria = $this->MaquinariaModel->findByid($id_maquinaria);
        $data['maquinaria'] = $DatosMaquinaria;
		$this->load->view('Dashboard/superadmin/EditarMaquinaria', $data);
    }


    public function ActualizarMaquinaria() {
        $id_maquinaria = $this->input->post('id_maquinaria');
        $num_serie = $this->input->post('num_serie');
        $nombre = $this->input->post('nombre');
        $fabricante = $this->input->post('fabricante');
        $fecha_adquisicion = $this->input->post('fecha_adquisicion');
        $costo_adquisicion = $this->input->post('costo_adquisicion');
        $tipo_maquinaria = $this->input->post('tipo_maquinaria');
        $estado = $this->input->post('estado');

		if($id_maquinaria && $num_serie && $nombre && $fabricante && $fecha_adquisicion && $costo_adquisicion && $tipo_maquinaria && $estado != ""){

			$NumSerieValido = $this->MaquinariaModel->ReValidarNumSerie($num_serie, $id_maquinaria);

			if($NumSerieValido){
				$this->MaquinariaModel->actualizarMaquinaria($id_maquinaria, $num_serie, $nombre, $fabricante, $fecha_adquisicion, $costo_adquisicion, $tipo_maquinaria, $estado);
				
				$data['maquinas'] = $this->MaquinariaModel->findAll();
				$data['session'] = $this->session->userdata("session_actual");
				$data['maquinariactualizada']=true;
				$this->load->view('Dashboard/superadmin/Maquinaria', $data);
				
			}else{
				$DatosMaquinaria = $this->MaquinariaModel->findByid($id_maquinaria);
				
				$data['session'] = $this->session->userdata("session_actual");
				$data['maquinaria'] = $DatosMaquinaria;
				$data['datorepetido']=true;
				$this->load->view('Dashboard/superadmin/EditarMaquinaria', $data);
			}
		}else{
			$DatosMaquinaria = $this->MaquinariaModel->findByid($id_maquinaria);
			
			$data['session'] = $this->session->userdata("session_actual");
			$data['maquinaria'] = $DatosMaquinaria;
			$data['camposvacios']=true;
			$this->load->view('Dashboard/superadmin/EditarMaquinaria', $data);
		}
	}


	public function deleteMaquinaria($id_maquinaria){
        $this->MaquinariaModel->delete($id_maquinaria);
		redirect('superadmin/Dashboard/Maquinaria', 'refresh');
    }
}
