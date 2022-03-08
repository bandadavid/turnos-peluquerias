<?php

class Disponibilidad  extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
    }

    public function obtenerDatos()
    {
        $query = $this->db->get('disponibilidad');
        if ($query->num_rows() > 0) {
            return $query;
        } else {
            return false;
        }
    }


    public function obtenerTodosActuales()
    {
        $sql = "select * from disponibilidad where fecha_dis>=date(now());";
        $query = $this->db->query($sql);
        if ($query->num_rows() > 0) {
            return $query;
        } else {
            return false;
        }
    }


    public function insertarDisponibilidad($dataDisponibilidad)
    {
        return $this->db->insert("disponibilidad", $dataDisponibilidad);
    }

    public function obtenerPorCodigo($codigo_dis)
    {
        $this->db->where("codigo_dis", $codigo_dis);
        $query = $this->db->get('disponibilidad');
        if ($query->num_rows() > 0) {
            return $query->row();
        } else {
            return false;
        }
    }

    public function actualizar($data, $codigo_dis)
    {
        $this->db->where("codigo_dis", $codigo_dis);
        return $this->db->update("disponibilidad", $data);
    }

    public function eliminar($id)
    {
        $this->db->where("codigo_dis", $id);
        return $this->db->delete("disponibilidad");
    }
}
