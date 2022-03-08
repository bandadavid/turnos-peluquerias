<?php

class Servicio  extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
    }


    public function obtenerDatos()
    {
        $query = $this->db->get('servicios');
        if ($query->num_rows() > 0) {
            return $query;
        } else {
            return false;
        }
    }

    public function insertarServicio($dataServicio)
    {
        return $this->db->insert("servicios", $dataServicio);
    }

    public function eliminar($id)
    {
        $this->db->where("codigo_ser", $id);
        return $this->db->delete("servicios");
    }

    public function obtenerPorCodigo($codigo_ser)
    {
        $this->db->where("codigo_ser", $codigo_ser);
        $query = $this->db->get('servicios');
        if ($query->num_rows() > 0) {
            return $query->row();
        } else {
            return false;
        }
    }

    public function actualizar($data, $codigo_ser)
    {
        $this->db->where("codigo_ser", $codigo_ser);
        return $this->db->update("servicios", $data);
    }
}
