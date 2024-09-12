<?php
defined('BASEPATH') OR exit('No direct script access allowed');
header("Access-Control-Allow-Origin: *"); // Permite el acceso desde cualquier origen, o usa "http://localhost" si solo quieres permitirlo desde localhost.
header("Access-Control-Allow-Methods: GET, POST");
header("Access-Control-Allow-Headers: Content-Type");


class AsignacionesController extends CI_Controller {

	public function __construct(){
        parent::__construct();
		$this->load->database();
		$this->load->model('EmpleadosModel');
		$this->load->model('RepuestosModel');

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

    public function CambiarEstadoAsignacion(){
        if($this->input->server("REQUEST_METHOD")=="POST"){

            $session = $this->session->userdata("session_actual");
            $id_usuario = $session['id_usuario']; 
            $id_asignacion = $this->input->post("id_asignacion");
            $estado_asignacion = $this->input->post("estado_asignacion");

            if($id_usuario && $id_asignacion && $estado_asignacion != ""){

                if($estado_asignacion == "Pendiente"){

                    $new_estado = "En progreso";
                    $this->EmpleadosModel->ActualizarEstadoAsignacion($id_usuario, $id_asignacion, $new_estado);
		            redirect('empleados/Dashboard/Asignaciones', 'refresh');

                }elseif($estado_asignacion == "En progreso"){

                    $new_estado = "Completada";
                    $this->EmpleadosModel->ActualizarEstadoAsignacion($id_usuario, $id_asignacion, $new_estado);
		            redirect('empleados/Dashboard/Asignaciones', 'refresh');

                }elseif($estado_asignacion == "Atrasada"){

                    $new_estado = "En progreso";
                    $this->EmpleadosModel->ActualizarEstadoAsignacion($id_usuario, $id_asignacion, $new_estado);
		            redirect('empleados/Dashboard/Asignaciones', 'refresh');

                }elseif($estado_asignacion == "Completada"){

		            redirect('empleados/Dashboard/Asignaciones', 'refresh');

                }elseif($estado_asignacion == "Suspendida"){

		            redirect('empleados/Dashboard/Asignaciones', 'refresh');

                }elseif($estado_asignacion == "Cancelada"){

		            redirect('empleados/Dashboard/Asignaciones', 'refresh');

                }
            
            }else{
                redirect('empleados/Dashboard/Asignaciones', 'refresh');
            }
        }
    }

    public function AsignacionMantenimiento(){
        if($this->input->server("REQUEST_METHOD")=="POST"){

            $session = $this->session->userdata("session_actual");
            $id_usuario = $session['id_usuario']; 
            $id_asignacion = $this->input->post("id_asignacion");
            $estado_asignacion = $this->input->post("estado_asignacion");
            $id_maquinaria = $this->input->post("id_maquinaria");            

            if($id_usuario && $id_asignacion && $estado_asignacion != ""){

                if($estado_asignacion == "Pendiente"){

                    $data['repuestos'] = $this->RepuestosModel->getAllRepuestosDisponibles();
                    $data['proveedores'] = $this->RepuestosModel->getIdNameProveedores();
                    $data['session'] = $this->session->userdata("session_actual");

                    $data['id_asignacion']=$id_asignacion;
                    $data['estado_asignacion']=$estado_asignacion;
                    $data['id_maquinaria']=$id_maquinaria;

                    $this->load->view('Dashboard/empleados/usarRepuestos', $data);

                }elseif($estado_asignacion == "Atrasada"){

                    $data['repuestos'] = $this->RepuestosModel->getAllRepuestosDisponibles();
                    $data['proveedores'] = $this->RepuestosModel->getIdNameProveedores();
                    $data['session'] = $this->session->userdata("session_actual");

                    $data['id_asignacion']=$id_asignacion;
                    $data['estado_asignacion']=$estado_asignacion;
                    $data['id_maquinaria']=$id_maquinaria;

                    $this->load->view('Dashboard/empleados/usarRepuestos', $data);

                }elseif($estado_asignacion == "En progreso"){
                    $new_estado = "Completada";
                    $this->EmpleadosModel->ActualizarEstadoAsignacion($id_usuario, $id_asignacion, $new_estado);
                    $this->EmpleadosModel->ActualizarMaquinariaActiva($id_maquinaria); 

		            redirect('empleados/Dashboard/Asignaciones', 'refresh');

                }elseif($estado_asignacion == "Completada"){
		            redirect('empleados/Dashboard/Asignaciones', 'refresh');                    
                }elseif($estado_asignacion == "Suspendida"){
		            redirect('empleados/Dashboard/Asignaciones', 'refresh');                    
                }elseif($estado_asignacion == "Cancelada"){
		            redirect('empleados/Dashboard/Asignaciones', 'refresh');                    
                }
            
            }else{
                redirect('empleados/Dashboard/Asignaciones', 'refresh');
            }
        }
    }

    public function UsarRepuestosMantenimiento() {
        $carrito = $this->input->post('carrito');
        $session = $this->session->userdata("session_actual");

        $new_estado = "En progreso";
        $id_usuario = $session['id_usuario']; 


        if (!empty($carrito)) {
            $validarcantidadrespuesta=null;

            foreach ($carrito as $repuesto) {
      
                $RepuestoSinEspacios = trim($repuesto['codigo']);
                $cantidad = $repuesto['cantidad'];
                $id_asignacion = $repuesto['asignacion'];
                $estado_asignacion = $repuesto['estado_asignacion'];
                $id_maquinaria = $repuesto['id_maquinaria'];

                if ($id_asignacion && $RepuestoSinEspacios && $id_maquinaria && $cantidad && $estado_asignacion != ""){
                    if ($cantidad <= 0) {
                        $validarcantidadrespuesta = "negativo";                    
                    }else{
                        $validarcantidad = $this->RepuestosModel->validarCantidadDisponibleParaUsar($RepuestoSinEspacios, $cantidad);
        
                        if ($validarcantidad == true) {
                            $validarcantidadrespuesta = true;
                        }else if($validarcantidad == false){
                            $data = array(
        
                                'id_asignacion' => $repuesto['asignacion'],
                                'id_repuesto' => $RepuestoSinEspacios,
                                'cant_usada' => $cantidad
                            );
            
                            $validarcantidadrespuesta = false;
                            $this->EmpleadosModel->guardarManteRepuesto($data); 
                            $this->RepuestosModel->DisminuirCantidadDisponible($RepuestoSinEspacios, $cantidad);
                            $this->EmpleadosModel->ActualizarEstadoAsignacion($id_usuario, $id_asignacion, $new_estado); 
                            $this->EmpleadosModel->ActualizarEstadoMaquinariaMantenimiento($id_maquinaria); 
                        }
                    }

                }else{
                    $validarcantidadrespuesta = "EmptyData";
                }
            }
            
            if ($validarcantidadrespuesta === "EmptyData") {
                $response = [
                                'status' => "EmptyData",
                                'mesagge' => "ALERT##DATOS##VACIOS"
                            ];
                echo json_encode($response);

            }else if ($validarcantidadrespuesta == true) {
                $response = [
                                'status' => "cantidad",
                                'mesagge' => "ALERT##REPUESTOS##INSUFICIENTE"
                            ];
                echo json_encode($response);

            }else if($validarcantidadrespuesta == false){
                $response = [
                                'status' => true,
                                'mesagge' => "OK##REPUESTOS##INSERT"
                            ];
                echo json_encode($response);

            }else if($validarcantidadrespuesta === "negativo"){
                $response = [
                                'status' => "negativo",
                                'mesagge' => "ERROR##VALOR##NEGATIVO"
                            ];
                echo json_encode($response);
            }
  
        } else {
            $response = [
                            'status' => false,
                            'mesagge' => "ERROR##LISTA##VACIA"
                        ];
            echo json_encode($response);
        }
    }
}

