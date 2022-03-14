<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Reservas extends CI_Controller
{


    public function __construct()
    {
        parent::__construct(); //invocando al constructor de la clase padre
        $this->load->database(); //cargando persistencia
        $this->load->library('Grocery_CRUD'); //cargando crud
        $this->load->model('usuario');
        $this->load->model('reserva');
        $this->load->model('disponibilidad');
        $this->load->model('servicio');
    }

    public function gestionReservas()
    {
        $reservas = new grocery_CRUD();
        $reservas->set_subject('Reservas');
        $reservas->set_table('reserva'); //estableciendo la tabla de l BDD
        $reservas->set_theme('datatables'); //definiendo al aspeto grafico
        $reservas->set_relation('fk_codigo_ser', 'servicios', 'nombre_ser');
        $reservas->columns('codigo_res', 'fecha_hora_inicio_res', 'apellido_res', 'nombre_res', 'celular_res', 'fk_codigo_ser', 'estado_res');
        $reservas->display_as('codigo_res', 'Código');
        $reservas->display_as('apellido_res', 'Apellido');
        $reservas->display_as('nombre_res', 'Nombre');
        $reservas->display_as('celular_res', 'Celular');
        $reservas->display_as('estado_res', 'Estado');
        $reservas->display_as('fk_codigo_ser', 'Servicio');
        //$reservas->order_by('estado_res', 'desc');

        $reservas->set_language("spanish");
        $reservas->set_theme("flexigrid");

        $reservas->callback_column('estado_res', array($this, 'changeColorRow'));

        //$reservas->callback_column('Whatsapp', array($this, 'apiWhatsapp'));

        $reservas->fields('apellido_res', 'nombre_res', 'celular_res', 'estado_res');

        $reservas->unset_clone();


        $reservas->field_type('estado_res', 'dropdown', array("ACTIVO" => "ACTIVO", "FINALIZADO" => "FINALIZADO"));

        $output = $reservas->render();

        $this->load->view('header');
        $this->load->view('reservas/gestionReservas', $output);
        $this->load->view('footer');
    }

    /*public function apiWhatsapp($value, $row)
    {
        return "<div class='whatsapp'><a target='_blank' href='https://api.whatsapp.com/send?phone=593" . $row->celular_res . "&text=Saludos%20le%20escribo%20para...'><i class='fab fa-whatsapp-square'></i></a></div>";
    }*/

    public function changeColorRow($value, $row)
    {
        return "<div class='" . ($value == 'ACTIVO' ? 'bg-success' : 'bg-danger') . "'>$value</div>";
    }

    public function formulario()
    {
        $data["disponibilidades"] = $this->disponibilidad->obtenerTodosActuales();
        $data["servicios"] = $this->servicio->obtenerDatos();
        $this->load->view('header');
        $this->load->view('reservas/formulario', $data);
        $this->load->view('footer');
    }

    public function calendario()
    {
        $data["solicitudes"] = $this->reserva->obtenerTodos();
        $this->load->view('header');
        $this->load->view('reservas/calendario', $data);
        $this->load->view('footer');
    }


    public function insertarReserva()
    {
        $data = array(
            "fecha_hora_inicio_res" => $this->input->post("fecha_hora_inicio_sol"),
            "apellido_res" => $this->input->post("apellido_sol"),
            "nombre_res" => $this->input->post("nombre_sol"),
            "celular_res" => $this->input->post("celular_sol"),
            "fk_codigo_ser" => $this->input->post("nombre_ser")
        );
        if ($this->reserva->insertarReserva($data)) {
            $this->session->set_flashdata("confirmacion", "Turno Agendado Existosamente.");
            redirect("reservas/calendario");
        } else {
            $this->session->set_flashdata("error", "El horario seleccionado ya no están disponibles, verifique e intente nuevamente.");
            redirect("reservas/formulario");
        }
    }

    public function finalizar()
    {
        $estado = "8999";
        $codigo = $this->input->post("codigo_res");
        $datosFinalizacion = array(
            "celular_res" => $estado
        );
        if ($this->reserva->actualizar($datosFinalizacion, $codigo)) {
            $this->session->set_flashdata("confirmacion", "Turno Finalizado Existosamente.");
            redirect("reservas/calendario");
        } else {
            $this->session->set_flashdata("error", "No se pudo finalizar el turno.");
            redirect("reservas/formulario");
        }
    }

    public function obtenerSolicitudPorCodigoJSON($codigo_sol)
    {
        $solicitud = $this->reserva->obtenerPorCodigo($codigo_sol);
        $solicitud->fecha = convertirFechaLetras($solicitud->fecha_hora_inicio_res);
        echo json_encode($solicitud);
    }

    /*public function validarSolicitudDiaria()
    {
        $cedula = $this->input->post("cedula_sol");
        $fecha = $this->input->post("fecha");
        $solicitudExistente = $this->reserva->obtenerSolicitudPorCedulaFecha($cedula, $fecha);
        if ($solicitudExistente) {
            echo json_encode(array("estado" => "error", "fecha" => $fecha));
        } else {
            echo json_encode(array("estado" => "ok", "fecha" => $fecha));
        }
    }*/

    public function listarReservas()
    {
        $this->load->model('reserva');
        $listadoReserva = $this->reserva->obtenerTodos();
        if ($listadoReserva) {
            echo json_encode(array(
                "estado" => "ok",
                "datos" => $listadoReserva->result()
            ));
        } else {
            echo json_encode(array(
                "estado" => "error",
                "mensaje" => "No existe reservas"
            ));
        }
    }
}
