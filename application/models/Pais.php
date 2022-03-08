<?php

class Pais  extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
    }

    public function obtenerDatos()
    {
        $query = $this->db->get('paises_bd');
        if ($query->num_rows() > 0) {
            return $query;
        } else {
            return false;
        }
    }

    public function insertarServicio($dataServicio)
    {
        return $this->db->insert("paises_bd", $dataServicio);
    }

    public function eliminar($id)
    {
        $this->db->where("id_bd", $id);
        return $this->db->delete("paises_bd");
    }

    public function obtenerPorCodigo($id_bd)
    {
        $this->db->where("id_bd", $id_bd);
        $query = $this->db->get('paises_bd');
        if ($query->num_rows() > 0) {
            return $query->row();
        } else {
            return false;
        }
    }

    public function actualizar($data, $id_bd)
    {
        $this->db->where("id_bd", $id_bd);
        return $this->db->update("paises_bd", $data);
    }
}
