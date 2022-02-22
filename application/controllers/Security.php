<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Security extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('usuario');
        // $this->load->model('evento');

    }

    public function login()
    {
        $this->load->view('header');
        $this->load->view('security/login');
        $this->load->view('footer');
    }


    public function logout()
    {
        $this->session->sess_destroy();
        redirect("security/login");
    }

    public function ingresar()
    {
        $usuarioIngresado = $this->input->post("usuario_usu");
        $password = $this->input->post("password_usu");
        $usuario = $this->usuario->obtenerPorUsuarioPassword($usuarioIngresado, $password);

        $this->session->set_flashdata("usuario", $usuarioIngresado);
        //$config['sess_expiration'] = 10;
        if ($usuario) {
            if ($usuario->estado_usu == "ACTIVO") {
                $dataSesion = array(
                    "Conectad0" => $usuario,
                );
                $this->session->set_userdata($dataSesion);
                $this->session->set_flashdata("bienvenida", "Bienvenido al sistema.");
                redirect('welcome/index');
            } else {
                $this->session->set_flashdata("error", "El usuario ingresado está desactivado.");
            }
        } else {
            $this->session->set_flashdata("error", "Usuario o Contraseña Incorrectos.");
        }
        redirect('security/login');
    }


    public function perfil()
    {
        $this->load->view('header');
        $this->load->view('security/perfil');
        $this->load->view('footer');
    }

    public function cambiarPassword()
    {

        $passwordActual = $this->input->post("password_actual");
        $passwordNuevo = $this->input->post("password_nueva");
        $usuario = $this->usuario->obtenerPorCodigo($this->session->userdata("Conectad0")->codigo_usu);

        if ($usuario->password_usu == md5($passwordActual)) {
            $this->usuario->actualizar(array("password_usu" => md5($passwordNuevo)), $usuario->codigo_usu);
            $this->session->set_flashdata("confirmacion", "La contraseña ha sido actualizada exitosamente.");
            //redirect("security/logout");
        } else {
            $this->session->set_flashdata("error", "La contraseña actual ingresada es incorrecta");
        }
        redirect("security/perfil");
    }
}
