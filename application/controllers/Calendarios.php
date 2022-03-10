<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Calendarios extends CI_Controller
{


    public function __construct()
    {
        parent::__construct(); //invocando al constructor de la clase padre
        $this->load->database(); //cargando persistencia
        $this->load->model('calendario');
    }


    public function finalizar()
    {
        $estado = "FINALIZADO";
        $codigo = $this->input->post("codigo_res");
        $datosFinalizacion = array(
            "estado_res" => $estado
        );
        if ($this->calendario->actualizar($datosFinalizacion, $codigo)) {

            $this->session->set_flashdata("confirmacion", "Turno Finalizado Existosamente.");
            redirect("reservas/calendario");
        } else {
            $this->session->set_flashdata("error", "No se pudo finalizar el turno.");
            redirect("reservas/formulario");
        }
    }
}
