<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class RepuestosController extends CI_Controller {

	public function __construct(){
        parent::__construct();
		$this->load->database();
		$this->load->model('RepuestosModel');

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


    public function insertRepuesto(){
        $caracteres_permitidos = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
		$longitud = 10;
		$id_repuesto = '';
		for ($i = 0; $i < $longitud; $i++) {
			$indice_aleatorio = rand(0, strlen($caracteres_permitidos) - 1);
			$caracter_aleatorio = $caracteres_permitidos[$indice_aleatorio];
			$id_repuesto .= $caracter_aleatorio;
		}

        $codigo = $this->input->post('codigo');
		$nombre = $this->input->post('nombre');
        $tipo_repuesto = $this->input->post('tipo_repuesto');
        $cantidad = $this->input->post('cantidad');
        $precio_compra = $this->input->post('precio_compra');
        $descripcion = $this->input->post('descripcion');
        $id_proveedor = $this->input->post('id_proveedor');
        $estado = $this->input->post('estado');

		if ($id_repuesto!="" && $codigo!="" && $nombre!="" && $tipo_repuesto!="" && $cantidad!=""  && $precio_compra!="" && $descripcion!="" && $id_proveedor!="" && $estado!="") {
			
			$idValido = $this->RepuestosModel->validateId($id_repuesto);
			$codigoValido = $this->RepuestosModel->validateCodigo($codigo);

			if ($idValido && $codigoValido) {
				$this->RepuestosModel->insertRepuesto($id_repuesto, $codigo, $nombre, $tipo_repuesto, $cantidad, $precio_compra, $descripcion, $id_proveedor, $estado);

				$data['session'] = $this->session->userdata("session_actual");
				$data['dateValid'] = true;
                $data['repuestos'] = $this->RepuestosModel->getAllRepuestos();
                $data['proveedores'] = $this->RepuestosModel->getIdNameProveedores();
				$this->load->view('Dashboard/superadmin/Repuestos', $data);
			}else{
				$data['session'] = $this->session->userdata("session_actual");
				$data['dateRepeated'] = true;
                $data['repuestos'] = $this->RepuestosModel->getAllRepuestos();
                $data['proveedores'] = $this->RepuestosModel->getIdNameProveedores();
				$this->load->view('Dashboard/superadmin/Repuestos', $data);
			}
		}else{
			$data['session'] = $this->session->userdata("session_actual");
			$data['dateIncompletos'] = true;
            $data['repuestos'] = $this->RepuestosModel->getAllRepuestos();
            $data['proveedores'] = $this->RepuestosModel->getIdNameProveedores();
			$this->load->view('Dashboard/superadmin/Repuestos', $data);
		}

	}

    public function EditarRepuesto($id_repuesto = null){
		$id_repuesto = $id_repuesto;
		$data['session'] = $this->session->userdata("session_actual");

        $data['proveedor_actual'] = $this->RepuestosModel->getProveedorActual($id_repuesto);
		$data['proveedornull'] = $this->RepuestosModel->getIdNameProveedores();
        $data['proveedor_diferente_actual'] = $this->RepuestosModel->getProveedoresDiferentesdelActual($id_repuesto);
		$repuesto = $this->RepuestosModel->findById($id_repuesto);
		$data['repuesto'] = $repuesto;
		$this->load->view('Dashboard/superadmin/modificarRepuestos', $data);
	}

    public function actualizarDates(){
	
		if ($this->input->server("REQUEST_METHOD") == "POST"){

			$id_repuesto = $this->input->post('id_repuesto');
            $codigo = $this->input->post('codigo');
            $nombre = $this->input->post('nombre');
            $tipo_repuesto = $this->input->post('tipo_repuesto');
            $cantidad = $this->input->post('cantidad');
            $precio_compra = $this->input->post('precio_compra');
            $descripcion = $this->input->post('descripcion');
            $id_proveedor = $this->input->post('id_proveedor');
            $estado = $this->input->post('estado');


			if ($id_repuesto!="" && $codigo!="" && $nombre!="" && $tipo_repuesto!="" && $cantidad!=""  && $precio_compra!="" && $descripcion!="" && $id_proveedor!="" && $estado!="") {
                
				$idCodeValidoExistente = $this->RepuestosModel->RevalidarCodigo($codigo, $id_repuesto);

				if ($idCodeValidoExistente) {
					$this->RepuestosModel->updateRepuesto($id_repuesto, $codigo, $nombre, $tipo_repuesto, $cantidad, $precio_compra, $descripcion, $id_proveedor, $estado);

					$data['repuestos'] = $this->RepuestosModel->getAllRepuestos();
					$data['proveedornull'] = $this->RepuestosModel->getIdNameProveedores();
					$data['proveedor_actual'] = $this->RepuestosModel->getProveedorActual($id_repuesto);
        			$data['proveedor_diferente_actual'] = $this->RepuestosModel->getProveedoresDiferentesdelActual($id_repuesto);
					$data['session'] = $this->session->userdata("session_actual");
					$data['repuestoctualizado']=true;
					$this->load->view('Dashboard/superadmin/Repuestos', $data);
				}else{
					$data['proveedornull'] = $this->RepuestosModel->getIdNameProveedores();
					$data['proveedor_actual'] = $this->RepuestosModel->getProveedorActual($id_repuesto);
        			$data['proveedor_diferente_actual'] = $this->RepuestosModel->getProveedoresDiferentesdelActual($id_repuesto);
					$repuesto = $this->RepuestosModel->findById($id_repuesto);
					$data['repuesto'] = $repuesto;
					$data['session'] = $this->session->userdata("session_actual");
					$data['datorepetido']=true;
					$this->load->view('Dashboard/superadmin/modificarRepuestos', $data);
				}
			}else{
				$data['proveedornull'] = $this->RepuestosModel->getIdNameProveedores();
				$data['proveedor_actual'] = $this->RepuestosModel->getProveedorActual($id_repuesto);
        		$data['proveedor_diferente_actual'] = $this->RepuestosModel->getProveedoresDiferentesdelActual($id_repuesto);
				$repuesto = $this->RepuestosModel->findById($id_repuesto);
				$data['repuesto'] = $repuesto;
				$data['session'] = $this->session->userdata("session_actual");
				$data['camposvacios']=true;
				$this->load->view('Dashboard/superadmin/modificarRepuestos', $data);
			}
		}
	}

    public function deleteRepuestos($id_repuesto = null){
		$this->RepuestosModel->deleteRepuesto($id_repuesto);
		redirect('superadmin/Dashboard/Repuestos');
	}




    



}