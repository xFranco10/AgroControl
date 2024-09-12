<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ProveedoresController extends CI_Controller {
	public function __construct(){
        parent::__construct();
		$this->load->database();
		$this->load->model('ProveedoresModel');

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


    public function CrearProveedor(){
		$caracteres_permitidos = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
		$longitud = 10;
		$id_proveedor = '';

		for ($i = 0; $i < $longitud; $i++) {
			$indice_aleatorio = rand(0, strlen($caracteres_permitidos) - 1);
			$caracter_aleatorio = $caracteres_permitidos[$indice_aleatorio];
			$id_proveedor .= $caracter_aleatorio;
		}

		if($this->input->server("REQUEST_METHOD")=="POST"){
            $id = $this->input->post("id_proveedor");
            $nit = $this->input->post("nit");
            $nombre = $this->input->post("nombre");
            $codpostal = $this->input->post("codpostal");
            $direccion = $this->input->post("direccion");
            $telefono = $this->input->post("telefono");
			$email = $this->input->post("email");
			
            if($nit && $nombre && $codpostal && $direccion && $telefono && $email != ""){
                
				$NitValido = $this->ProveedoresModel->ValidarNit($nit);
				$EmailValido = $this->ProveedoresModel->ValidarEmail($email);

				if($NitValido && $EmailValido){
					$this->ProveedoresModel->insertar($id_proveedor, $nit, $nombre, $codpostal, $direccion, $telefono, $email);
					
					$data['Proveedores'] = $this->ProveedoresModel->findAll();
					$data['session'] = $this->session->userdata("session_actual");
					$data['proveedorinsertado']=true;
					$this->load->view('Dashboard/superadmin/proveedores', $data);
					
				}else{
					$data['Proveedores'] = $this->ProveedoresModel->findAll();
					$data['session'] = $this->session->userdata("session_actual");
					$data['datorepetido']=true;
					$this->load->view('Dashboard/superadmin/proveedores', $data);				
				}
            }else{
				$data['Proveedores'] = $this->ProveedoresModel->findAll();
				$data['session'] = $this->session->userdata("session_actual");
				$data['camposvacios']=true;
				$this->load->view('Dashboard/superadmin/proveedores', $data);            
			}
		}
	}


	public function EditarProveedor($id_proveedor=null) {
        $id_proveedor = $id_proveedor;
		$data['session'] = $this->session->userdata("session_actual");

        $DatosProveedor = $this->ProveedoresModel->findByid($id_proveedor);
        $data['proveedor'] = $DatosProveedor;
		$this->load->view('Dashboard/superadmin/EditarProveedor', $data);
    }


    public function ActualizarDatosProveedor() {
        $id_proveedor = $this->input->post('id_proveedor');
        $nit = $this->input->post('nit');
        $nombre = $this->input->post('nombre');
        $codpostal = $this->input->post('codpostal');
        $direccion = $this->input->post('direccion');
        $telefono = $this->input->post('telefono');
        $email = $this->input->post('email');

		if($id_proveedor && $nit && $nombre && $codpostal && $direccion && $telefono && $email != ""){

			$emailValido = $this->ProveedoresModel->ReValidarNit($nit, $id_proveedor);
			$nitValido = $this->ProveedoresModel->ReValidarEmail($email, $id_proveedor);


			if($emailValido && $nitValido){
				$this->ProveedoresModel->actualizarProveedor($id_proveedor, $nit, $nombre, $codpostal, $direccion, $telefono, $email);
				
				$data['Proveedores'] = $this->ProveedoresModel->findAll();
				$data['session'] = $this->session->userdata("session_actual");
				$data['proveedoractualizado']=true;
				$this->load->view('Dashboard/superadmin/proveedores', $data);
				
			}else{
				$session = $this->session->userdata("session_actual");
				$DatosProveedor = $this->ProveedoresModel->findByid($id_proveedor);
				
				$data['session'] = $this->session->userdata("session_actual");
				$data['proveedor'] = $DatosProveedor;
				$data['datorepetido']=true;
				$this->load->view('Dashboard/superadmin/EditarProveedor', $data);
			}
		}else{
			$session = $this->session->userdata("session_actual");
			$DatosProveedor = $this->ProveedoresModel->findByid($id_proveedor);
			
			$data['session'] = $this->session->userdata("session_actual");
			$data['proveedor'] = $DatosProveedor;
			$data['camposvacios']=true;
			$this->load->view('Dashboard/superadmin/EditarProveedor', $data);
		}
	}


	public function deleteProveedores($id_proveedor){
        $this->ProveedoresModel->delete($id_proveedor);
		redirect('superadmin/Dashboard/Proveedores', 'refresh');
    }
}
