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
        echo json_encode($this->db->update('rekening',$data,['id'=>$id]));
      } else {
        $num = $this->db->get('rekening')->num_rows();
        for ($i=1; $i <= $num+1 ; $i++) {
          if ($this->input->post('gender')!==null) {
            $kode = "A".$i;
          } else {
            $kode = "B".$i;
          }
          if ($this->db->get_where('rekening',['code'=>$kode])->num_rows()==0) {
            break;
          }
        }
        $data['status'] = "1";
        $data['code'] = $kode;
        echo json_encode($this->db->insert('rekening',$data));
      }
    }
}
