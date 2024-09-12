<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class UsuariosModel extends CI_Model{

    public $table = 'usuarios';
    public $table_id = 'id_usuario';

    public function __construct(){
        $this->load->database();
    }

    public function ContarUsuariosDelSistema(){
        $cantidad_registros = $this->db->count_all('usuarios');
        return $cantidad_registros;
    }

    public function validarIngreso($email, $password){
        $this->db->select('email, passw');
		$this->db->where('email', $email);
		$this->db->where('passw', md5($password) );
		$this->db->where('estado', 'ACTIVO');
		$registros = $this->db->get('usuarios')->result();

		if (sizeof($registros)==0) {
			return false;
		}else{
			return true;
		}
    }

    public function getUsuarioByEmail($email){
        
        $this->db->select('id_usuario, documento, nombre, apellido, telefono, direccion, rol, estado, email, passw, imguser');
        $this->db->where('email', $email);
        $registros = $this->db->get('usuarios')->result();
        
        if(sizeof($registros)!=0){
            return $registros[0];
        }else{
            return null;
        }
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

    public function validarCedula($cedula)
    {
        $this->db->select('*');
        $this->db->where("documento", $cedula);
        $registros = $this->db->get('usuarios')->result();

        return (sizeof($registros) == 0);
    }

    public function validarEmail($email)
    {
        $this->db->select('*');
        $this->db->where("email", $email);
        $registros = $this->db->get('usuarios')->result();

        return (sizeof($registros) == 0);
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

    public function insertar($id_usuario, $cedula, $nombre, $apellido, $telefono, $direccion, $email, $rol, $estado, $password, $imguser){
        $data = [
            'id_usuario' => $id_usuario,
            'documento' => $cedula,
            'nombre' => $nombre,
            'apellido' => $apellido,
            'telefono' => $telefono,
            'direccion' => $direccion,
            'email' => $email,
            'rol' => $rol,
            'estado' => $estado,
            'passw' => md5($password),
            'imguser'=>$imguser
        ];
        return $this->db->insert('usuarios', $data);
    }

    function findAll($id_usuario){
        $this->db->select();
        $this->db->where("id_usuario != ", $id_usuario);
        $this->db->from($this->table);
        $query = $this->db->get();
        return $query->result();
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

    public function actualizarUsuario($id, $cedula, $nombre, $apellido, $telefono, $direccion, $email, $tipo, $estado) {
        $data = array(
            'documento' => $cedula,
            'nombre' => $nombre,
            'apellido' => $apellido,
            'telefono' => $telefono,
            'direccion' => $direccion,
            'rol' => $tipo,
            'estado' => $estado,
            'email' => $email,
        );

        $this->db->where('id_usuario', $id);
        $this->db->update('usuarios', $data);
    }

    public function actualizarPerfil($id, $cedula, $nombre, $apellido, $telefono, $direccion, $email, $tipo, $estado) {
        $data = array(
            'documento' => $cedula,
            'nombre' => $nombre,
            'apellido' => $apellido,
            'telefono' => $telefono,
            'direccion' => $direccion,
            'rol' => $tipo,
            'estado' => $estado,
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

    function delete($id_usuario){
        $this->db->where($this->table_id, $id_usuario);
        $this->db->delete($this->table);
    }



}

