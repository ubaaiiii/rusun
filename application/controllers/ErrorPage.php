<?php
defined('BASEPATH') or exit('No direct script access allowed');

class ErrorPage extends CI_Controller
{
  public function page404()
  {
    $sesi_login = (array) $this->session->userdata('user_rusun');

    $data = array(
      'lokasi'        => "Error",
      'dUser'         => $sesi_login,
      'booking'       => $this->db->get_where('booking', ['status' => 0])->num_rows(),
      'setting'       => $this->db->get('setting')->row_array()
    );

    $this->load->view('layout/header', $data);
    $this->load->view('errorPage/err404');
    $this->load->view('layout/footer', $data);
  }
}
