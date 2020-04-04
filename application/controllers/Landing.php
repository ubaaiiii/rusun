<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Landing extends CI_Controller
{

  /**
  * Index Page for this controller.
  *
  * Maps to the following URL
  * 		http://example.com/index.php/welcome
  *	- or -
  * 		http://example.com/index.php/welcome/index
  *	- or -
  * Since this controller is set as the default controller in
  * config/routes.php, it's displayed at http://example.com/
  *
  * So any other public methods not prefixed with an underscore will
  * map to /index.php/welcome/<method_name>
  * @see https://codeigniter.com/user_guide/general/urls.html
  */
  public function __construct()
  {
    parent::__construct();
    $this->load->database();
    $this->load->model('M_Kamar');
  }

  public function index()
  {

    $this->db->query("UPDATE booking
                      JOIN kamar on kamar.id = booking.kamar_id
                      SET kamar.status = '1',
                      booking.status = '3'
                      WHERE booking.tanggal_selesai < NOW()
                      AND booking.status = '2'");
    $this->db->query("UPDATE kamar
                      JOIN booking on kamar.id = booking.kamar_id
                      SET kamar.status = '1'
                      WHERE DATE_ADD(tanggal_mulai, INTERVAL 1 HOUR) < NOW()
                      AND booking.status = '1'");
                      $this->db->where('DATE_ADD(tanggal_mulai, INTERVAL 1 HOUR) < NOW()')
                      ->where('status', '1')
                      ->delete('booking');

    $data['setting'] = $this->db->get_where('setting', ['id' => 1])->row_array();
    $data['gallery'] = $this->db->get('gallery')->result_array();
    $data['juml_lantai'] = $this->M_Kamar->get_lantai();

    for ($i=1; $i <= $data['juml_lantai']; $i++) {
      $data['hCowokL'][$i] = $this->M_Kamar->get_harga(1, $i, 1);			// get_harga(gender,lantai,status);
      $data['hCewekL'][$i] = $this->M_Kamar->get_harga(2, $i, 1);
      $data['kCowokL'][$i] = $this->M_Kamar->get_kamar(1, $i, 1);			// get_kamar(gender,lantai,status);
      $data['kCewekL'][$i] = $this->M_Kamar->get_kamar(2, $i, 1);
      $data['pCowokL'][$i] = $this->M_Kamar->get_penghuni(1, $i, 1);
      $data['pCewekL'][$i] = $this->M_Kamar->get_penghuni(2, $i, 1);
    }
    if ($this->session->userdata('user_rusun')) {
      $data['dUser'] = (array) $this->session->userdata('user_rusun');
      $data['login'] = "sudah";
    } else {
      $data['login'] = "belum";
    }
    $data['laki'] = $this->db->get_where('kamar', array('gender' => 1, 'status !=' => 1))->num_rows();
    $data['cewe'] = $this->db->get_where('kamar', array('gender' => 2, 'status !=' => 1))->num_rows();

    $this->load->view('landing', $data);
  }
}
