<?php

class Reserva  extends CI_Model
{

    function obtenerReservaPorFechaHora($fechaInicio)
    {
        $sql = "select * from reserva where fecha_hora_inicio_res='$fechaInicio';";
        $query = $this->db->query($sql);
        if ($query->num_rows() > 0) {
            return $query;
        } else {
            return false;
        }
    }

    function insertarReserva($data)
    {
        return $this->db->insert("reserva", $data);
    }

    function actualizarReserva($codigo_sol, $data)
    {
        $this->db->where("codigo_res", $codigo_sol);
        return $this->db->update("reserva", $data);
    }

    public function obtenerTodos()
    {
        $query = $this->db->get('reserva');
        if ($query->num_rows() > 0) {
            return $query;
        } else {
            return false;
        }
    }

    function obtenerPorCodigo($codigo_sol)
    {
        //$sql="select * from reserva where codigo_sol=$codigo_sol;";
        $this->db->join('servicios', 'codigo_ser=fk_codigo_ser');
        $this->db->where("codigo_res", $codigo_sol);
        $query = $this->db->get("reserva");
        if ($query->num_rows() > 0) {
            return $query->row();
        } else {
            return false;
        }
    }

    function obtenerReservaPorCedulaFecha($cedula, $fecha)
    {
        $sql = "select * from reserva where cedula_sol='$cedula' and date(fecha_hora_inicio_res)=date('$fecha');";
        $query = $this->db->query($sql);
        if ($query->num_rows() > 0) {
            return $query->row();
        } else {
            return false;
        }
    }
}
