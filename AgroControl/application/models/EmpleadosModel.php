<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class EmpleadosModel extends CI_Model{

    public $table = 'asignaciones';
    public $table_id = 'id_asigacion';

    public function __construct(){
        $this->load->database();
    }
    
    function findAllasiganciones($id_usuario){
        $this->db->select('actividades.*, asignaciones.*, maquinaria.*');
        $this->db->from('actividades');
        $this->db->join('asignaciones', 'actividades.id_actividad = asignaciones.id_actividad', 'inner');
        $this->db->join('maquinaria', 'asignaciones.id_maquinaria = maquinaria.id_maquinaria', 'inner');
        $this->db->join('usuarios', 'asignaciones.id_usuario = usuarios.id_usuario', 'inner');
        $this->db->where("usuarios.id_usuario", $id_usuario);
        $this->db->where('actividades.estado_actividad', 'DISPONIBLE');
        $query = $this->db->get();
        return $query->result();
    }

    function findAsigancionesEnProgreso($id_usuario){
        $this->db->select('actividades.*, asignaciones.*, maquinaria.*');
        $this->db->from('actividades');
        $this->db->join('asignaciones', 'actividades.id_actividad = asignaciones.id_actividad', 'inner');
        $this->db->join('maquinaria', 'asignaciones.id_maquinaria = maquinaria.id_maquinaria', 'inner');
        $this->db->join('usuarios', 'asignaciones.id_usuario = usuarios.id_usuario', 'inner');
        $this->db->where("usuarios.id_usuario", $id_usuario);
        $this->db->where("asignaciones.estado_asignacion", 'En progreso');
        $this->db->where('actividades.estado_actividad', 'DISPONIBLE');
        $query = $this->db->get();
        return $query->result();
    }

    function findAsignacionesPendientes($id_usuario){
        $this->db->select('actividades.*, asignaciones.*, maquinaria.*');
        $this->db->from('actividades');
        $this->db->join('asignaciones', 'actividades.id_actividad = asignaciones.id_actividad', 'inner');
        $this->db->join('maquinaria', 'asignaciones.id_maquinaria = maquinaria.id_maquinaria', 'inner');
        $this->db->join('usuarios', 'asignaciones.id_usuario = usuarios.id_usuario', 'inner');
        $this->db->where("usuarios.id_usuario", $id_usuario);
        $this->db->where("asignaciones.estado_asignacion", 'Pendiente');
        $this->db->where('actividades.estado_actividad', 'DISPONIBLE');
        $query = $this->db->get();
        return $query->result();
    }

    function findAsignacionesCompletadas($id_usuario){
        $this->db->select('actividades.*, asignaciones.*, maquinaria.*');
        $this->db->from('actividades');
        $this->db->join('asignaciones', 'actividades.id_actividad = asignaciones.id_actividad', 'inner');
        $this->db->join('maquinaria', 'asignaciones.id_maquinaria = maquinaria.id_maquinaria', 'inner');
        $this->db->join('usuarios', 'asignaciones.id_usuario = usuarios.id_usuario', 'inner');
        $this->db->where("usuarios.id_usuario", $id_usuario);
        $this->db->where("asignaciones.estado_asignacion", 'Completada');
        $this->db->where('actividades.estado_actividad', 'DISPONIBLE');
        $query = $this->db->get();
        return $query->result();
    }

    function findAsignacionesAtrasadas($id_usuario){
        $this->db->select('actividades.*, asignaciones.*, maquinaria.*');
        $this->db->from('actividades');
        $this->db->join('asignaciones', 'actividades.id_actividad = asignaciones.id_actividad', 'inner');
        $this->db->join('maquinaria', 'asignaciones.id_maquinaria = maquinaria.id_maquinaria', 'inner');
        $this->db->join('usuarios', 'asignaciones.id_usuario = usuarios.id_usuario', 'inner');
        $this->db->where("usuarios.id_usuario", $id_usuario);
        $this->db->where("asignaciones.estado_asignacion", 'Atrasada');
        $this->db->where('actividades.estado_actividad', 'DISPONIBLE');
        $query = $this->db->get();
        return $query->result();
    }

    function findAsignacionesSuspendidas($id_usuario){
        $this->db->select('actividades.*, asignaciones.*, maquinaria.*');
        $this->db->from('actividades');
        $this->db->join('asignaciones', 'actividades.id_actividad = asignaciones.id_actividad', 'inner');
        $this->db->join('maquinaria', 'asignaciones.id_maquinaria = maquinaria.id_maquinaria', 'inner');
        $this->db->join('usuarios', 'asignaciones.id_usuario = usuarios.id_usuario', 'inner');
        $this->db->where("usuarios.id_usuario", $id_usuario);
        $this->db->where("asignaciones.estado_asignacion", 'Suspendida');
        $this->db->where('actividades.estado_actividad', 'DISPONIBLE');
        $query = $this->db->get();
        return $query->result();
    }

    function findAsignacionesCanceladas($id_usuario){
        $this->db->select('actividades.*, asignaciones.*, maquinaria.*');
        $this->db->from('actividades');
        $this->db->join('asignaciones', 'actividades.id_actividad = asignaciones.id_actividad', 'inner');
        $this->db->join('maquinaria', 'asignaciones.id_maquinaria = maquinaria.id_maquinaria', 'inner');
        $this->db->join('usuarios', 'asignaciones.id_usuario = usuarios.id_usuario', 'inner');
        $this->db->where("usuarios.id_usuario", $id_usuario);
        $this->db->where("asignaciones.estado_asignacion", 'Cancelada');
        $this->db->where('actividades.estado_actividad', 'DISPONIBLE');
        $query = $this->db->get();
        return $query->result();
    }

    public function contarasignacionestotales($id_usuario){
        $this->db->select('COUNT(id_usuario) as total_asignaciones');
        $this->db->from('asignaciones');
        $this->db->where('id_usuario', $id_usuario);

        $query = $this->db->get();
        $resultado = $query->result();

        return $resultado;
    }

    public function contarasignacionespendientes($id_usuario){
        $this->db->select('COUNT(id_usuario) as total_asignaciones');
        $this->db->from('asignaciones');
        $this->db->where('id_usuario', $id_usuario);
        $this->db->where('estado_asignacion', 'Pendiente');


        $query = $this->db->get();
        $resultado = $query->result();

        return $resultado;
    }

    public function contarasignacionesprogreso($id_usuario){
        $this->db->select('COUNT(id_usuario) as total_asignaciones');
        $this->db->from('asignaciones');
        $this->db->where('id_usuario', $id_usuario);
        $this->db->where('estado_asignacion', 'En progreso');


        $query = $this->db->get();
        $resultado = $query->result();

        return $resultado;
    }

    public function contarasignacionescompletadas($id_usuario){
        $this->db->select('COUNT(id_usuario) as total_asignaciones');
        $this->db->from('asignaciones');
        $this->db->where('id_usuario', $id_usuario);
        $this->db->where('estado_asignacion', 'Completada');


        $query = $this->db->get();
        $resultado = $query->result();

        return $resultado;
    }

    public function contarasignacionesatrasadas($id_usuario){
        $this->db->select('COUNT(id_usuario) as total_asignaciones');
        $this->db->from('asignaciones');
        $this->db->where('id_usuario', $id_usuario);
        $this->db->where('estado_asignacion', 'Atrasada');


        $query = $this->db->get();
        $resultado = $query->result();

        return $resultado;
    }

    public function contarasignacionessuspendidas($id_usuario){
        $this->db->select('COUNT(id_usuario) as total_asignaciones');
        $this->db->from('asignaciones');
        $this->db->where('id_usuario', $id_usuario);
        $this->db->where('estado_asignacion', 'Suspendida');


        $query = $this->db->get();
        $resultado = $query->result();

        return $resultado;
    }

    public function contarasignacionescanceladas($id_usuario){
        $this->db->select('COUNT(id_usuario) as total_asignaciones');
        $this->db->from('asignaciones');
        $this->db->where('id_usuario', $id_usuario);
        $this->db->where('estado_asignacion', 'Cancelada');


        $query = $this->db->get();
        $resultado = $query->result();

        return $resultado;
    }

    public function ActualizarEstadoAsignacion($id_usuario, $id_asignacion, $new_estado){
        $data = array(
            'estado_asignacion' => $new_estado,
        );

        $this->db->where('id_usuario', $id_usuario);
        $this->db->where('id_asignacion', $id_asignacion);
        $this->db->update('asignaciones', $data);

    }


    public function getCurrentPassword($id){
        
        $this->db->select('passw');
        $this->db->where('id_usuario', $id);
        $registros = $this->db->get('usuarios')->result();
        
        if(sizeof($registros)!=0){
            return $registros[0];
        }else{
            return null;
        }
    }


    public function ReValidarCedula($cedula, $id)
    {
        $this->db->select('*');
        $this->db->where("documento", $cedula);
        $this->db->where("id_usuario != ", $id);
        $registros = $this->db->get('usuarios')->result();

        return (sizeof($registros) == 0);
    }

    public function ReValidarEmail($email, $id)
    {
        $this->db->select('*');
        $this->db->where("email", $email);
        $this->db->where("id_usuario != ", $id);
        $registros = $this->db->get('usuarios')->result();

        return (sizeof($registros) == 0);
    }


    public function findById($id_usuario) {
        $this->db->where('id_usuario', $id_usuario);
        $query = $this->db->get('usuarios');

        if ($query->num_rows() > 0) {
            return $query->row();
        } else {
            return null;
        }
    }


    public function actualizarPerfil($id, $cedula, $nombre, $apellido, $telefono, $direccion, $email) {
        $data = array(
            'documento' => $cedula,
            'nombre' => $nombre,
            'apellido' => $apellido,
            'telefono' => $telefono,
            'direccion' => $direccion,
            'email' => $email,
        );

        $this->db->where('id_usuario', $id);
        $this->db->update('usuarios', $data);
    }

    public function UpdatePassword($id, $NewPassword) {
        $data = array(
            'passw' => md5($NewPassword),
        );

        if($NewPassword != ""){
            $this->db->where('id_usuario', $id);
            $this->db->update('usuarios', $data);
        }
    }

    public function UpdateProfilePic($id_usuario, $imguser){
        $data = array(
            'imguser' => $imguser,
        );

        $this->db->where('id_usuario', $id_usuario);
        $this->db->update('usuarios', $data);
    }


    public function guardarManteRepuesto($data) {
        $this->db->insert('mante_repuest', $data);
        return $this->db->affected_rows() > 0;
    }

    public function ActualizarEstadoMaquinariaMantenimiento($id_maquinaria){
        $data = array(
            'estado_maquinaria' => "MANTENIMIENTO",
        );

        $this->db->where('id_maquinaria', $id_maquinaria);
        $this->db->update('maquinaria', $data);
    }

    
    public function ActualizarMaquinariaActiva($id_maquinaria){
        $data = array(
            'estado_maquinaria' => "ACTIVA",
        );

        $this->db->where('id_maquinaria', $id_maquinaria);
        $this->db->update('maquinaria', $data);
    }

}

