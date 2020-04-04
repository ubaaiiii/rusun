<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Auth extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('M_Auth');
        //Codeigniter : Write Less Do More
    }

    public function index()
    {
        $kesalahan = $this->input->get('errcode');
        if ($this->session->userdata('user_rusun')) {
            redirect('home');
        } else {
            $data = array(
                'errcode' => $kesalahan,
                'lokasi'  => "Login",
                'setting' => $this->db->get('setting')->row_array()
            );
            $this->load->view('login/layout/header', $data);
            $this->load->view('login/form', $data);
            $this->load->view('login/layout/footer', $data);
        }
    }

    public function reLogin()
    {
      
    }

    public function login()
    {
        $sesi_login = (array) $this->session->userdata('user_rusun');
        $errcode = $this->input->get('errcode');
        if (!empty($sesi_login['id'])) {
            redirect('home');
        } else {
            redirect('auth');
        }
    }

    public function cek_login($tipe=null)
    {
        $email = $this->input->post('email');
        if ($tipe==null) {
          $pass = sha1($this->input->post('password'));
        } else {
          $pass = $this->input->post('password');
        }
        // $remember = $this->input->post('ingat');
        if ($row = $this->M_Auth->get_login($email, $pass)) {
            $this->session->set_userdata('user_rusun', $row);
            echo json_encode("berhasil");
        } else {
            echo json_encode("tidak");
        }
    }

    public function logout()
    {
        $this->session->unset_userdata('user_rusun');
        redirect('auth');
    }

    public function register()
    {
        $data = array(
            'lokasi' => "Daftar",
            'setting' => $this->db->get('setting')->row_array()
        );
        $this->load->view('login/layout/header', $data);
        $this->load->view('login/registration', $data);
        $this->load->view('login/layout/footer', $data);
    }

    public function forgot()
    {
        $data = array(
          'lokasi' => "Reset Password",
          'setting' => $this->db->get('setting')->row_array()
      );
        $this->load->view('login/layout/header', $data);
        $this->load->view('login/forgot', $data);
        $this->load->view('login/layout/footer', $data);
    }
}
