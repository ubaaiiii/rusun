<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Rekening extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        //Codeigniter : Write Less Do More
    }

    public function hapus($id)
    {
      echo json_encode($this->db->delete('rekening', ['id'=>$id]));
    }

    public function proses($tipe)
    {
      $data['no_rek'] = $this->input->post('nomor-rekening');
      $data['nama'] = $this->input->post('pemilik');
      $data['bank'] = $this->input->post('bank');


      if ($tipe=="update"){
        $id = $this->input->post('id');
        $cek = $this->db->get_where('rekening',['id'=>$id])->row_array();
        if ($cek['no_rek'] !== $data['no_rek']) {
          if ($this->db->get_where('rekening',['no_rek'=>$data['no_rek']])->num_rows() > 0) {
            echo "exists";
          }
        }
        echo json_encode($this->db->update('rekening',$data,['id'=>$id]));
      } else {
        if ($this->db->get_where('rekening',['no_rek'=>$data['no_rek']])->num_rows() > 0) {
          echo "exists";
        } else {
          echo json_encode($this->db->insert('rekening',$data));
        }
      }
    }
}
