<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class RepuestosModel extends CI_Model{

    public $table = 'repuestos';
    public $table_id = 'id_repuesto';

    public function __construct(){
        $this->load->database();
    }

    public function insertRepuesto($id_repuesto, $codigo, $nombre, $tipo_repuesto, $cantidad, $precio_compra, $descripcion, $id_proveedor, $estado){
        
        $data = [
            'id_repuesto' => $id_repuesto,
            'codigo' => $codigo,
            'nombre_repuesto' => $nombre,
            'tipo_repuesto' => $tipo_repuesto,
            'cantidad' => $cantidad,
            'precio_compra' => $precio_compra,
            'descripcion' => $descripcion,
            'id_proveedor' => $id_proveedor,
            'estado_repuesto' => $estado,
        ];
        return $this->db->insert('repuestos', $data);
    }

    function getAllRepuestos(){
        $this->db->select('repuestos.*, proveedores.nombre_proveedor');
        $this->db->from('repuestos');
        $this->db->join('proveedores', 'repuestos.id_proveedor = proveedores.id_proveedor', 'left');
       
        $query = $this->db->get();
        return $query->result();
    }

    function getAllRepuestosDisponibles(){
        $this->db->select('repuestos.*, proveedores.nombre_proveedor');
        $this->db->from('repuestos');
        $this->db->join('proveedores', 'repuestos.id_proveedor = proveedores.id_proveedor', 'inner');
		$this->db->where('repuestos.estado_repuesto', "DISPONIBLE");
       
        $query = $this->db->get();
        return $query->result();
    }

    public function findById($id){
		$this->db->where('id_repuesto', $id);
        $query = $this->db->get('repuestos');

        if ($query->num_rows() > 0) {
            return $query->row();
        } else {
            return null;
        }
	}

    public function updateRepuesto($id_repuesto, $codigo, $nombre, $tipo_repuesto, $cantidad, $precio_compra, $descripcion, $id_proveedor, $estado) {
        $data = [
            'id_repuesto' => $id_repuesto,
            'codigo' => $codigo,
            'nombre_repuesto' => $nombre,
            'tipo_repuesto' => $tipo_repuesto,
            'cantidad' => $cantidad,
            'precio_compra' => $precio_compra,
            'descripcion' => $descripcion,
            'id_proveedor' => $id_proveedor,
            'estado_repuesto' => $estado,
        ];

        $this->db->where('id_repuesto', $id_repuesto);
        $this->db->update('repuestos', $data);
    }

    public function getProveedorActual($id_repuesto){
        
        $this->db->select('proveedores.*');
        $this->db->from('proveedores');
        $this->db->join('repuestos', 'repuestos.id_proveedor = proveedores.id_proveedor', 'inner');
        $this->db->where("id_repuesto", $id_repuesto);

        $query = $this->db->get();
		return $query->result();
    }

    public function getProveedoresDiferentesdelActual($id_repuesto){
        
        $this->db->select('proveedores.*');
        $this->db->from('proveedores');
        $this->db->join('repuestos', 'repuestos.id_proveedor != proveedores.id_proveedor', 'inner');
        $this->db->where("id_repuesto", $id_repuesto);

        $query = $this->db->get();
		return $query->result();
    }


    public function getIdNameProveedores(){
        $this->db->select('id_proveedor, nombre_proveedor');
        $this->db->from('proveedores');

        $query = $this->db->get();
		return $query->result();
    }

    public function validateId($id_repuesto)
    {
        $this->db->select('*');
        $this->db->where("id_repuesto", $id_repuesto);
        $registros = $this->db->get('repuestos')->result();

        return (sizeof($registros) == 0);
    }

    public function validateCodigo($codigo)
    {
        $this->db->select('*');
        $this->db->where("codigo", $codigo);
        $registros = $this->db->get('repuestos')->result();

        return (sizeof($registros) == 0);
    }

    public function RevalidarCodigo($codigo, $id_repuesto){
		$this->db->select('*');
		$this->db->where("codigo", $codigo);
		$this->db->where("id_repuesto !=", $id_repuesto);
		$registros = $this->db->get('repuestos')->result();

		return (sizeof($registros)==0);
	}

    public function deleteRepuesto($id_repuesto){
		$this->db->where("id_repuesto", $id_repuesto);
		$this->db->delete('repuestos');
	}


    function validarCantidadDisponibleParaUsar($id_repuesto, $cantidadLista){
        $this->db->select('*');
        $this->db->from('repuestos');
		$this->db->where('id_repuesto', $id_repuesto);
       
        $query = $this->db->get();
        $resultado = $query->result();


        foreach ($resultado as $row) {
            $cantidadActual = $row->cantidad;
            
            if($cantidadLista > $cantidadActual){
                return true;
            }else if($cantidadLista < $cantidadActual){
                return false;
            }
        }
    }
    

    public function DisminuirCantidadDisponible($id_repuesto, $cantidadLista){
        $this->db->select('*');
        $this->db->from('repuestos');
		$this->db->where('id_repuesto', $id_repuesto);

        $query = $this->db->get();
        $resultado = $query->result();

        $newcantidad = 0;

        foreach ($resultado as $row) {
            $cantidadActual = $row->cantidad;
            
            $newcantidad = $cantidadActual - $cantidadLista;
        }

        if($newcantidad > 0){
            $data = [
                'cantidad' => $newcantidad,
            ];
    
            $this->db->where('id_repuesto', $id_repuesto);
            $this->db->update('repuestos', $data);
        }else{
            $data = [
                'cantidad' => $newcantidad,
                'estado_repuesto' => "NO DISPONIBLE",
            ];
    
            $this->db->where('id_repuesto', $id_repuesto);
            $this->db->update('repuestos', $data);
        }
        
    }


}