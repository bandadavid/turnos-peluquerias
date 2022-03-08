<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Usuarios extends CI_Controller
{

    function __construct()
    {
        parent::__construct(); //invocando al constructor de la clase padre
        $this->load->database(); //cargando persistencia
        $this->load->library('Grocery_CRUD'); //cargando crud
        $this->load->model('usuario');
    }

    public function index()
    {
        $usuarios = new grocery_CRUD();
        $usuarios->set_subject('Usuarios');
        $usuarios->set_table('usuario'); //estableciendo la tabla de l BDD
        $usuarios->set_theme('datatables'); //definiendo al aspeto grafico
        $usuarios->columns('codigo_usu', 'apellido_usu', 'nombre_usu', 'usuario_usu', 'perfil_usu', 'estado_usu');
        $usuarios->display_as('codigo_usu', '#');
        $usuarios->display_as('apellido_usu', 'Apellido');
        $usuarios->display_as('nombre_usu', 'Nombre');
        $usuarios->display_as('usuario_usu', 'Usuario');
        $usuarios->display_as('perfil_usu', 'Perfil');
        $usuarios->display_as('estado_usu', 'Estado');
        $usuarios->display_as('password_usu', 'Contraseña');

        $usuarios->set_language("spanish");
        $usuarios->set_theme("flexigrid");

        $usuarios->unset_clone();
        $usuarios->field_type('perfil_usu', 'dropdown', array("ADMINISTRADOR" => "ADMINISTRADOR", "EMPLEADO" => "EMPLEADO"));
        $usuarios->field_type('estado_usu', 'dropdown', array("ACTIVO" => "ACTIVO", "INACTIVO" => "INACTIVO"));
        $usuarios->field_type('password_usu', 'password');
        $usuarios->fields('apellido_usu', 'nombre_usu', 'usuario_usu', 'password_usu', 'perfil_usu', 'estado_usu');
        $usuarios->required_fields('apellido_usu', 'nombre_usu', 'usuario_usu', 'password_usu', 'perfil_usu', 'estado_usu');
        $usuarios->callback_before_insert(array($this, 'encrypt_password_callback'));

        if ($usuarios->getState() != "add") {
            $usuarios->field_type("password_usu", "hidden");
        }
        $output = $usuarios->render();
        $this->load->view('header');
        $this->load->view('usuarios/index', $output);
        $this->load->view('footer');
    }


    public function encrypt_password_callback($post_array)
    {
        $post_array['password_usu'] = md5($post_array['password_usu']);
        return $post_array;
    }

    public function listarUsuarios()
    {
        $this->load->model('usuario');
        $listadoUsuarios = $this->usuario->obtenerDatos();
        if ($listadoUsuarios) {
            echo json_encode(array(
                "estado" => "ok",
                "datos" => $listadoUsuarios->result()
            ));
        } else {
            echo json_encode(array(
                "estado" => "error",
                "mensaje" => "No existe usuarios"
            ));
        }
    }

    public function guardarUsuarios()
    {
        /*$usuario = "luisito";
        $password = "123luis";
        $estado = "ACTIVO";
        $perfil = "ADMINISTRADOR";
        $apellido = "Toapanta";
        $nombre = "Luis";*/

        $usuario = $this->input->post("usuario_usu");
        $password = $this->input->post("password_usu");
        $estado = $this->input->post("estado_usu");
        $perfil = $this->input->post("perfil_usu");
        $apellido = $this->input->post("apellido_usu");
        $nombre = $this->input->post("nombre_usu");

        $dataNuevoUsuario = array(
            "usuario_usu" => $usuario,
            "password_usu" => md5($password),
            "estado_usu" => $estado,
            "perfil_usu" => $perfil,
            "apellido_usu" => $apellido,
            "nombre_usu" => $nombre
        );
        if ($this->usuario->insertarUsuario($dataNuevoUsuario)) {
            echo json_encode(array("estado" => "ok"));
        } else {
            echo json_encode(array("estado" => "error"));
        }
    }

    public function editarUsuarios($id)
    {
        /*$id = "12";
        $usuario = "Luisito";
        //$password = "123luis";
        $estado = "ACTIVO";
        //$perfil = "ADMINISTRADOR";
        $apellido = "Iza";
        $nombre = "Rafel";*/

        $usuario = $this->input->post("usuario_usu");
        //$password = $this->input->post("password_usu");
        $estado = $this->input->post("estado_usu");
        //$perfil = $this->input->post("perfil_usu");
        $apellido = $this->input->post("apellido_usu");
        $nombre = $this->input->post("nombre_usu");

        $dataNuevoUsuario = array(
            "usuario_usu" => $usuario,
            "estado_usu" => $estado,
            "apellido_usu" => $apellido,
            "nombre_usu" => $nombre
        );
        if ($this->usuario->actualizar($dataNuevoUsuario, $id)) {
            echo json_encode(array("estado" => "ok"));
        } else {
            echo json_encode(array("estado" => "error"));
        }
    }

    public function eliminarUsuarios($id)
    {
        $this->usuario->obtenerPorCodigo($id);
        if ($this->usuario->eliminar($id)) {
            echo json_encode(array("estado" => "ok"));
        } else {
            echo json_encode(array("estado" => "error"));
        }
    }
}
