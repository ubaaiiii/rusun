<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Setting extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        //Codeigniter : Write Less Do More
    }

    public function DataRekening()
    {
      echo json_encode($this->db->get('rekening')->result_array());
    }

    public function rekening()
    {
      $rekening = $this->input->post('nomor-rekening');
      $data = array(
        'no_rek'=> $rekening,
        'bank'    => $this->input->post('bank'),
        'nama' => $this->input->post('pemilik')
      );

      $cek = $this->db->get_where('rekening',['no_rek'=>$rekening])->num_rows();
      if ($cek>0) {
        echo "exists";
      } else {
        echo json_encode($this->db->insert('rekening',$data));
      }
    }

    public function hapus($idnya)
    {
      if ($this->db->get_where('rekening',['id'=>$idnya])) {
        echo json_encode($this->db->delete('rekening',['id'=>$idnya]));
      } else {
        echo "not found";
      }
    }

}
