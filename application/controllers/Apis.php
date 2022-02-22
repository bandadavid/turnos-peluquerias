<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Apis extends CI_Controller
{

    function __construct()
    {
        parent::__construct(); //invocando al constructor de la clase padre
        $this->load->model('usuario');
        if (!$this->session->userdata("Conectad0")) {
            redirect("security/logout");
        }
    }

    public function index()
    {
        $this->load->view('header');
        $this->load->view('apis/index');
        $this->load->view('footer');
    }
}
