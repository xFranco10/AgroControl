<?php
defined('BASEPATH') or exit('No direct script access allowed');

class AsignacionesModel extends CI_Model
{
    public $table = 'asignaciones';
    public $table_id = 'id_asignacion';

    public function __construct(){
        $this->load->database();
    }


    function findAll(){
        $this->db->select('asignaciones.*, actividades.*, usuarios.*, maquinaria.*');
        $this->db->from('asignaciones');
        $this->db->join('actividades', 'actividades.id_actividad = asignaciones.id_actividad', 'left');
        $this->db->join('maquinaria', 'asignaciones.id_maquinaria = maquinaria.id_maquinaria', 'left');
        $this->db->join('usuarios', 'asignaciones.id_usuario = usuarios.id_usuario', 'left');
        $query = $this->db->get();
        return $query->result();
    }

    function getActividadActual($id_asignacion){
        $this->db->select('actividades.*');
        $this->db->from('actividades');
        $this->db->join('asignaciones', 'actividades.id_actividad = asignaciones.id_actividad', 'inner');
        $this->db->where('id_asignacion =', $id_asignacion);
       
        $query = $this->db->get();
        return $query->result();
    }
    function getActividadDiferente($id_asignacion){
        $this->db->select('actividades.*');
        $this->db->from('actividades');
        $this->db->join('asignaciones', 'actividades.id_actividad != asignaciones.id_actividad', 'inner');
        $this->db->where('id_asignacion =', $id_asignacion);
       
        $query = $this->db->get();
        return $query->result();
    }


    function getUsuarioActual($id_asignacion){
        $this->db->select('usuarios.*');
        $this->db->from('usuarios');
        $this->db->join('asignaciones', 'usuarios.id_usuario = asignaciones.id_usuario', 'inner');
        $this->db->where('rol !=', 'SUPERADMIN');
        $this->db->where('estado !=', 'INACTIVO');
        $this->db->where('id_asignacion =', $id_asignacion);
       
        $query = $this->db->get();
        return $query->result();
    }
    function getUsuarioDiferente($id_asignacion){
        $this->db->select('usuarios.*');
        $this->db->from('usuarios');
        $this->db->join('asignaciones', 'usuarios.id_usuario != asignaciones.id_usuario', 'inner');
        $this->db->where('rol !=', 'SUPERADMIN');
        $this->db->where('estado !=', 'INACTIVO');
        $this->db->where('id_asignacion =', $id_asignacion);
       
        $query = $this->db->get();
        return $query->result();
    }


    function getMaquinariaActual($id_asignacion){
        $this->db->select('maquinaria.*');
        $this->db->from('maquinaria');
        $this->db->join('asignaciones', 'maquinaria.id_maquinaria = asignaciones.id_maquinaria', 'inner');
        $this->db->where('estado_maquinaria !=', 'INACTIVA');
        $this->db->where('estado_maquinaria !=', 'SUPENDIDA');
        $this->db->where('id_asignacion =', $id_asignacion);
       
        $query = $this->db->get();
        return $query->result();
    }
    function getMaquinariaDiferente($id_asignacion){
        $this->db->select('maquinaria.*');
        $this->db->from('maquinaria');
        $this->db->join('asignaciones', 'maquinaria.id_maquinaria != asignaciones.id_maquinaria', 'inner');
        $this->db->where('estado_maquinaria !=', 'INACTIVA');
        $this->db->where('estado_maquinaria !=', 'SUPENDIDA');
        $this->db->where('id_asignacion =', $id_asignacion);
       
        $query = $this->db->get();
        return $query->result();
    }

    
    public function getIdNameActividades(){
        $this->db->select('id_actividad, nombre_actividad');
        $this->db->from('actividades');
        $this->db->where('estado_actividad !=', 'NO DISPONIBLE');

        $query = $this->db->get();
		return $query->result();
    }

    public function getIdNameUsuarios(){
        $this->db->select('id_usuario, nombre, rol');
        $this->db->from('usuarios');
        $this->db->where('rol !=', 'SUPERADMIN');
        $this->db->where('estado !=', 'INACTIVO');


        $query = $this->db->get();
		return $query->result();
    }

    public function getIdNameMaquinarias(){
        $this->db->select('id_maquinaria, nombre_maquinaria');
        $this->db->from('maquinaria');
        $this->db->where('estado_maquinaria !=', 'INACTIVA');
        $this->db->where('estado_maquinaria !=', 'SUPENDIDA');


        $query = $this->db->get();
		return $query->result();
    }

    
    public function insertAsignacion($id_asignacion, $id_actividad, $id_usuario, $id_maquinaria, $estado_asignacion, $fecha_inicio, $fecha_finalizacion){
        
        $data = [
            'id_asignacion' => $id_asignacion,
            'id_actividad' => $id_actividad,
            'id_usuario' => $id_usuario,
            'id_maquinaria' => $id_maquinaria,
            'estado_asignacion' => $estado_asignacion,
            'fecha_inicio' => $fecha_inicio,
            'fecha_finalizacion' => $fecha_finalizacion,
        ];
        return $this->db->insert('asignaciones', $data);
    }

    //buscar la actividad por id
    public function findById($id_asignacion)
    {
        $this->db->where('id_asignacion', $id_asignacion);
        $query = $this->db->get('asignaciones');

        if ($query->num_rows() > 0) {
            return $query->row();
        } else {
            return null;
        }
    }

    public function updateAsignaciones($id_asignacion, $id_actividad, $id_usuario, $id_maquinaria, $estado_asignacion, $fecha_inicio, $fecha_finalizacion) {
        $data = [
            'id_asignacion' => $id_asignacion,
            'id_actividad' => $id_actividad,
            'id_usuario' => $id_usuario,
            'id_maquinaria' => $id_maquinaria,
            'estado_asignacion' => $estado_asignacion,
            'fecha_inicio' => $fecha_inicio,
            'fecha_finalizacion' => $fecha_finalizacion,
        ];

        $this->db->where('id_asignacion', $id_asignacion);
        $this->db->update('asignaciones', $data);
    }

    //eliminar tarea
    function deleteAsignaciones($id_asignacion)
    {
        $this->db->where($this->table_id, $id_asignacion);
        $this->db->delete($this->table);
    }

}