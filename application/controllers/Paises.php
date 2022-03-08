<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Paises extends CI_Controller
{

    function __construct()
    {
        parent::__construct(); //invocando al constructor de la clase padre
        $this->load->database(); //cargando persistencia
        $this->load->library('Grocery_CRUD'); //cargando crud
        $this->load->model("pais");
    }

    public function index()
    {
        $paises = new grocery_CRUD();
        $paises->set_subject('Paises');
        $paises->set_table('paises_bd'); //estableciendo la tabla de l BDD
        $paises->set_theme('datatables'); //definiendo al aspeto grafico
        $paises->columns('id_bd', 'nombre_bd', 'continente_bd');
        $paises->display_as('id_bd', '#');
        $paises->display_as('nombre_bd', 'Nombre');
        $paises->display_as('continente_bd', 'Continente');
        $paises->set_language("spanish");
        $paises->set_theme("flexigrid");

        $paises->unset_clone();

        $output = $paises->render();
        $this->load->view('header');
        $this->load->view('paises/index', $output);
        $this->load->view('footer');
    }

    public function listarPaises()
    {
        $this->load->model('pais');
        $listadoPaises = $this->pais->obtenerDatos();
        if ($listadoPaises) {
            echo json_encode(array(
                "estado" => "ok",
                "datos" => $listadoPaises->result()
            ));
        } else {
            echo json_encode(array(
                "estado" => "error",
                "mensaje" => "No existe servicios"
            ));
        }
    }

    public function guardarPaises()
    {
        /*$nombre = "Pintado de Unas";
        $descripcion = "Pintado de unas";
        $precio = "3.50";
        $foto = "foto.png";*/

        $nombre = $this->input->post("nombre_bd");
        $continente = $this->input->post("continente_bd");


        //SUBIR ARCHIVO
        $dataNuevoPais = array(
            "nombre_bd" => $nombre,
            "continente_bd" => $continente
        );
        if ($this->pais->insertarServicio($dataNuevoPais)) {
            echo json_encode(array("estado" => "ok"));
        } else {
            echo json_encode(array("estado" => "error"));
        }
    }

    public function editarPaises($id)
    {
        /*$nombre = "Pintado de Unas";
        $descripcion = "Pintado de unas";
        $precio = "3.50";
        $foto = "foto.png";*/
        //$id = $this->input->post("codigo_res");
        $nombre = $this->input->post("nombre_bd");
        $continente = $this->input->post("continente_bd");

        $dataNuevoPais = array(
            "nombre_bd" => $nombre,
            "continente_bd" => $continente
        );
        if ($this->pais->actualizar($dataNuevoPais, $id)) {
            echo json_encode(array("estado" => "ok"));
        } else {
            echo json_encode(array("estado" => "error"));
        }
    }

    public function eliminarPaises($id)
    {
        $this->pais->obtenerPorCodigo($id);
        if ($this->pais->eliminar($id)) {
            echo json_encode(array("estado" => "ok"));
        } else {
            echo json_encode(array("estado" => "error"));
        }
    }
}
