<?php
defined('BASEPATH') or exit('No direct script access allowed');

class ActividadesModel extends CI_Model
{
    public $table = 'actividades';
    public $table_id = 'id_actividad';

    public function __construct(){
        $this->load->database();
    }

    public function ContarActividadesDelSistema(){
        $cantidad_registros = $this->db->count_all('actividades');
        return $cantidad_registros;
    }

    //buscar las actividades
    function findAll(){
        $this->db->select();
        $this->db->from($this->table);

        $query = $this->db->get();
        return $query->result();
    }

    //insertar actividades
    public function insertarActividades($id_actividad, $nombre, $descripcion, $ubicacion, $estado, $prioridad){
        $data = [
            'id_actividad' => $id_actividad,
            'nombre_actividad' => $nombre,
            'descripcion' => $descripcion,
            'ubicacion' =>$ubicacion,
            'estado_actividad' => $estado,
            'prioridad' => $prioridad,
        ];
        return $this->db->insert('actividades', $data);
    }

    //buscar la actividad por id
    public function findById($id_actividad)
    {
        $this->db->where('id_actividad', $id_actividad);
        $query = $this->db->get('actividades');

        if ($query->num_rows() > 0) {
            return $query->row();
        } else {
            return null;
        }
    }

    //actualizar actividad
    public function actualizaractividad($id, $nombre, $descripcion, $ubicacion, $estado, $prioridad)
    {
        $data = array(
            'id_actividad' => $id,
            'nombre_actividad' => $nombre,
            'descripcion' => $descripcion,
            'ubicacion' => $ubicacion,
            'estado_actividad' => $estado,
            'prioridad' => $prioridad,
        );
        $this->db->where('id_actividad', $id);
        $this->db->update('actividades', $data);
    }

    //eliminar tarea
    function deleteActividad($id_actividad)
    {
        $this->db->where($this->table_id, $id_actividad);
        $this->db->delete($this->table);
    }

}