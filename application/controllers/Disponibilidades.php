<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Disponibilidades extends CI_Controller
{

    public function __construct()
    {
        parent::__construct(); //invocando al constructor de la clase padre
        $this->load->database(); //cargando persistencia
        $this->load->library('Grocery_CRUD'); //cargando crud
        $this->load->model('usuario');
        $this->load->model('disponibilidad');
    }

    public function index()
    {
        $disponibilidad = new grocery_CRUD();
        $disponibilidad->set_subject('Disponibilidad');
        $disponibilidad->set_table('disponibilidad'); //estableciendo la tabla de l BDD
        $disponibilidad->set_theme('datatables'); //definiendo al aspeto grafico
        $disponibilidad->columns('codigo_dis', 'fecha_dis', 'hora_inicio_dis', 'hora_fin_dis');
        $disponibilidad->display_as('codigo_dis', '#');
        $disponibilidad->display_as('fecha_dis', 'Fecha');
        $disponibilidad->display_as('hora_inicio_dis', 'Hora Inicio');
        $disponibilidad->display_as('hora_fin_dis', 'Hora Fin');

        $disponibilidad->set_language("spanish");
        $disponibilidad->set_theme("flexigrid");

        $disponibilidad->unset_clone();
        $disponibilidad->fields('fecha_dis', 'hora_inicio_dis', 'hora_fin_dis');
        $disponibilidad->required_fields('fecha_dis', 'hora_inicio_dis', 'hora_fin_dis');

        $output = $disponibilidad->render();
        $this->load->view('header');
        $this->load->view('disponibilidades/index', $output);
        $this->load->view('footer');
    }


    public function listarDisponibilidades()
    {
        $this->load->model('disponibilidad');
        $listadoDisponibilidad = $this->disponibilidad->obtenerDatos();
        if ($listadoDisponibilidad) {
            echo json_encode(array(
                "estado" => "ok",
                "datos" => $listadoDisponibilidad->result()
            ));
        } else {
            echo json_encode(array(
                "estado" => "error",
                "mensaje" => "No existe disponibilidades"
            ));
        }
    }

    public function guardarDisponibilidad()
    {
        /*$fecha_dis = "2022-03-06";
        $hora_inicio_dis = "11:0";
        $hora_fin_dis = "13:0";*/

        $fecha_dis = $this->input->post("fecha_dis");
        $hora_inicio_dis = $this->input->post("hora_inicio_dis");
        $hora_fin_dis = $this->input->post("hora_fin_dis");

        $dataNuevoDisponibilidad = array(
            "fecha_dis" => $fecha_dis,
            "hora_inicio_dis" => $hora_inicio_dis,
            "hora_fin_dis" => $hora_fin_dis
        );
        if ($this->disponibilidad->insertarDisponibilidad($dataNuevoDisponibilidad)) {
            echo json_encode(array("estado" => "ok"));
        } else {
            echo json_encode(array("estado" => "error"));
        }
    }

    public function eliminarDisponibilidad($id)
    {
        $this->disponibilidad->obtenerPorCodigo($id);
        if ($this->disponibilidad->eliminar($id)) {
            echo json_encode(array("estado" => "ok"));
        } else {
            echo json_encode(array("estado" => "error"));
        }
    }

    public function editarDisponibilidad($id)
    {
        /*$fecha_dis = "2022-03-06";
        $hora_inicio_dis = "11:0";
        $hora_fin_dis = "13:0";*/
        //$id = $this->input->post("codigo_dis");
        $fecha_dis = $this->input->post("fecha_dis");
        $hora_inicio_dis = $this->input->post("hora_inicio_dis");
        $hora_fin_dis = $this->input->post("hora_fin_dis");

        $dataNuevoDisponibilidad = array(
            "fecha_dis" => $fecha_dis,
            "hora_inicio_dis" => $hora_inicio_dis,
            "hora_fin_dis" => $hora_fin_dis
        );
        if ($this->disponibilidad->actualizar($dataNuevoDisponibilidad, $id)) {
            echo json_encode(array("estado" => "ok"));
        } else {
            echo json_encode(array("estado" => "error"));
        }
    }
}
