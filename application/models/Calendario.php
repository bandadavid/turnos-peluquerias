<?php

class Calendario extends CI_Model
{

    public function actualizar($data, $codigo_res)
    {
        $this->db->where("codigo_res", $codigo_res);
        return $this->db->update("reserva", $data);
    }
}
