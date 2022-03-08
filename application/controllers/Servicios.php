<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Servicios extends CI_Controller
{

    function __construct()
    {
        parent::__construct(); //invocando al constructor de la clase padre
        $this->load->database(); //cargando persistencia
        $this->load->library('Grocery_CRUD'); //cargando crud
        $this->load->model("servicio");
    }

    public function index()
    {
        $this->load->view('welcome_message');
    }


    public function gestionServicios()
    {
        $reservas = new grocery_CRUD();
        $reservas->set_subject('Servicios');
        $reservas->set_table('servicios'); //estableciendo la tabla de l BDD
        $reservas->set_theme('datatables'); //definiendo al aspeto grafico
        $reservas->columns('codigo_ser', 'nombre_ser', 'descripcion_ser', 'precio_ser', 'foto_ser');
        $reservas->display_as('codigo_ser', '#');
        $reservas->display_as('nombre_ser', 'Nombre');
        $reservas->display_as('descripcion_ser', 'Descripcion');
        $reservas->display_as('precio_ser', 'Precio');
        $reservas->set_field_upload('foto_ser', 'uploads');
        $reservas->set_language("spanish");
        $reservas->set_theme("flexigrid");

        $reservas->unset_clone();

        $output = $reservas->render();
        $this->load->view('header');
        $this->load->view('servicios/index', $output);
        $this->load->view('footer');
    }

    public function listarServicios()
    {
        $this->load->model('servicio');
        $listadoServicios = $this->servicio->obtenerDatos();
        if ($listadoServicios) {
            echo json_encode(array(
                "estado" => "ok",
                "datos" => $listadoServicios->result()
            ));
        } else {
            echo json_encode(array(
                "estado" => "error",
                "mensaje" => "No existe servicios"
            ));
        }
    }

    public function guardarServicios()
    {
        /*$nombre = "Pintado de Unas";
        $descripcion = "Pintado de unas";
        $precio = "3.50";
        $foto = "foto.png";*/

        $nombre = $this->input->post("nombre_ser");
        $descripcion = $this->input->post("descripcion_ser");
        $precio = $this->input->post("precio_ser");
        $foto = $this->input->post("foto_ser");

        //SUBIR ARCHIVO
        $dataNuevoServicio = array(
            "nombre_ser" => $nombre,
            "descripcion_ser" => $descripcion,
            "precio_ser" => $precio,
            "foto_ser" => $foto
        );
        if ($this->servicio->insertarServicio($dataNuevoServicio)) {
            echo json_encode(array("estado" => "ok"));
        } else {
            echo json_encode(array("estado" => "error"));
        }
    }

    public function editarServicios()
    {
        /*$nombre = "Pintado de Unas";
        $descripcion = "Pintado de unas";
        $precio = "3.50";
        $foto = "foto.png";*/
        $id = $this->input->post("codigo_res");
        $nombre = $this->input->post("nombre_ser");
        $descripcion = $this->input->post("descripcion_ser");
        $precio = $this->input->post("precio_ser");
        $foto = $this->input->post("foto_ser");

        //SUBIR ARCHIVO
        $dataNuevoServicio = array(
            "nombre_ser" => $nombre,
            "descripcion_ser" => $descripcion,
            "precio_ser" => $precio,
            "foto_ser" => $foto
        );
        if ($this->servicio->actualizar($dataNuevoServicio, $id)) {
            echo json_encode(array("estado" => "ok"));
        } else {
            echo json_encode(array("estado" => "error"));
        }
    }

    public function eliminarServicios($id)
    {
        $this->servicio->obtenerPorCodigo($id);
        if ($this->servicio->eliminar($id)) {
            echo json_encode(array("estado" => "ok"));
        } else {
            echo json_encode(array("estado" => "error"));
        }
    }
}
