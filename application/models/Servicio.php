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
}
