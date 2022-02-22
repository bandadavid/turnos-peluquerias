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
        if (!$this->session->userdata("Conectad0")) {
            redirect("security/logout");
        }
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
}
