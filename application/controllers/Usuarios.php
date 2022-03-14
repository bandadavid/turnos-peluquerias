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
        if (!$this->session->userdata("Conectad0")) {
            redirect("security/logout");
        }
    }

    public function index()
    {
        $usuarios = new grocery_CRUD();
        $usuarios->set_subject('Usuarios');
        $usuarios->set_table('usuario'); //estableciendo la tabla de l BDD
        $usuarios->set_theme('datatables'); //definiendo al aspeto grafico
        $usuarios->columns('codigo_usu', 'apellido_usu', 'nombre_usu', 'usuario_usu', 'perfil_usu', 'estado_usu');
        $usuarios->display_as('codigo_usu', 'Código');
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

        $usuarios->callback_column('estado_usu', array($this, 'cambiarColorCelda'));

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

    public function cambiarColorCelda($value, $row)
    {
        return "<div class='" . ($value == 'ACTIVO' ? 'bg-success' : 'bg-danger') . "'>$value</div>";
        //return '<span style="background:red; color: #fff;"><span>' . $row->estado_res;
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
}
