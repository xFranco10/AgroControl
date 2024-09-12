<?php
defined('BASEPATH') or exit('No direct script access allowed');

class MaquinariaModel extends CI_Model
{
    public $table = 'maquinaria';
    public $table_id = 'id_maquinaria';

    public function __construct(){
        $this->load->database();
    }


    function findAll(){
        $this->db->select();
        $this->db->from($this->table);

        $query = $this->db->get();
        return $query->result();
    }


    public function ContarMaquinariaDelSistema(){
        $cantidad_registros = $this->db->count_all('maquinaria');
        return $cantidad_registros;
    }


    public function insertar($id_maquinaria, $num_serie, $nombre, $fabricante, $fecha_adquisicion, $costo_adquisicion, $tipo, $estado){
        $data = [
            'id_maquinaria' => $id_maquinaria,
            'num_serie' => $num_serie,
            'nombre_maquinaria' => $nombre,
            'fabricante' => $fabricante,
            'fecha_adquisicion' =>$fecha_adquisicion,
            'costo_adquisicion' => $costo_adquisicion,
            'tipo_maquinaria' => $tipo,
            'estado_maquinaria' => $estado,
        ];
        return $this->db->insert('maquinaria', $data);
    }


    public function ValidarNumSerie($num_serie)
    {
        $this->db->select('*');
        $this->db->where("num_serie", $num_serie);
        $registros = $this->db->get('maquinaria')->result();

        return (sizeof($registros) == 0);
    }
    public function ReValidarNumSerie($num_serie, $id_maquinaria)
    {
        $this->db->select('*');
        $this->db->where("num_serie", $num_serie);
        $this->db->where("id_maquinaria != ", $id_maquinaria);
        $registros = $this->db->get('maquinaria')->result();

        return (sizeof($registros) == 0);
    }

    //buscar la actividad por id
    public function findById($id_maquinaria)
    {
        $this->db->where('id_maquinaria', $id_maquinaria);
        $query = $this->db->get('maquinaria');

        if ($query->num_rows() > 0) {
            return $query->row();
        } else {
            return null;
        }
    }

    //actualizar actividad
    public function actualizarMaquinaria($id_maquinaria, $num_serie, $nombre, $fabricante, $fecha_adquisicion, $costo_adquisicion, $tipo_maquinaria, $estado){
        $data = array(
            'id_maquinaria' => $id_maquinaria,
            'num_serie' => $num_serie,
            'nombre_maquinaria' => $nombre,
            'fabricante' => $fabricante,
            'fecha_adquisicion' => $fecha_adquisicion,
            'costo_adquisicion' => $costo_adquisicion,
            'tipo_maquinaria' => $tipo_maquinaria,
            'estado_maquinaria' => $estado,
        );
        $this->db->where('id_maquinaria', $id_maquinaria);
        $this->db->update('maquinaria', $data);
    }

    //eliminar tarea
    function delete($id_maquinaria)
    {
        $this->db->where($this->table_id, $id_maquinaria);
        $this->db->delete($this->table);
    }

}