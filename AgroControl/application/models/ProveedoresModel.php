<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ProveedoresModel extends CI_Model{

    public $table = 'proveedores';
    public $table_id = 'id_proveedor';

    public function __construct(){
        $this->load->database();
    }

    public function ContarProveedoresDelSistema(){
        $cantidad_registros = $this->db->count_all('proveedores');
        return $cantidad_registros;
    }

    public function ReValidarNit($nit, $id)
    {
        $this->db->select('*');
        $this->db->where("nit", $nit);
        $this->db->where("id_proveedor != ", $id);
        $registros = $this->db->get('proveedores')->result();

        return (sizeof($registros) == 0);
    }

    public function ReValidarEmail($email, $id)
    {
        $this->db->select('*');
        $this->db->where("email", $email);
        $this->db->where("id_proveedor != ", $id);
        $registros = $this->db->get('proveedores')->result();

        return (sizeof($registros) == 0);
    }

    public function ValidarNit($nit)
    {
        $this->db->select('*');
        $this->db->where("nit", $nit);
        $registros = $this->db->get('proveedores')->result();

        return (sizeof($registros) == 0);
    }

    public function ValidarEmail($email)
    {
        $this->db->select('*');
        $this->db->where("email", $email);
        $registros = $this->db->get('proveedores')->result();

        return (sizeof($registros) == 0);
    }

    public function insertar($id_proveedor, $nit, $nombre, $codpostal, $direccion, $telefono, $email){
        $data = [
            'id_proveedor' => $id_proveedor,
            'nit' => $nit,
            'nombre_proveedor' => $nombre,
            'codpostal' => $codpostal,
            'direccion' => $direccion,
            'telefono' => $telefono,
            'email' => $email,
        ];
        return $this->db->insert('proveedores', $data);
    }

    function findAll(){
        $this->db->select();
        $this->db->from($this->table);
        $query = $this->db->get();
        return $query->result();
    }

    public function findById($id_proveedor) {
        $this->db->where('id_proveedor', $id_proveedor);
        $query = $this->db->get('proveedores');

        if ($query->num_rows() > 0) {
            return $query->row();
        } else {
            return null;
        }
    }

    public function actualizarProveedor($id_proveedor, $nit, $nombre, $codpostal, $direccion, $telefono, $email) {
        $data = array(
            'nit' => $nit,
            'nombre_proveedor' => $nombre,
            'codpostal' => $codpostal,
            'direccion' => $direccion,
            'telefono' => $telefono,
            'email' => $email,
        );

        $this->db->where('id_proveedor', $id_proveedor);
        $this->db->update('proveedores', $data);
    }


    function delete($id_proveedor){
        $this->db->where($this->table_id, $id_proveedor);
        $this->db->delete($this->table);
    }



}

