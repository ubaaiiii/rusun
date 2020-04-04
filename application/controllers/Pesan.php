<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Pesan extends CI_Controller
{
  public function simpan()
  {
    $judul = $this->input->post('judul');
    $pesan = $this->input->post('pesan');
    $data = array(
      'nama' => ucwords($this->input->post('nama')),
      'email' => $this->input->post('email'),
      'pesan' => ucwords($judul)." - ".$pesan
    );
    echo json_encode($this->db->insert('pesan',$data));
  }
}
