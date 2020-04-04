<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Laporan extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        //Codeigniter : Write Less Do More
    }

    public function Data()
    {
      $this->db->select('a.id, b.tanggal_booking, b.tanggal_selesai, d.code as kamar, c.nama, concat(e.bank," ",e.no_rek) as no_rek, a.uang')
               ->from('keuangan a')
               ->join('booking b','b.code_booking = a.code_booking')
               ->join('users c','c.nik = b.user_nik','left')
               ->join('kamar d','d.id = b.kamar_id','left')
               ->join('rekening e','e.id = b.rek_id','left');
      echo json_encode($this->db->get()->result_array());
    }

    public function cariKamar($id)
    {
      echo json_encode($this->db->get_where('kamar', ['id'=>$id])->row());
    }

    public function getKamar()
    {
      echo json_encode($this->db->get('kamar')->result_array());
    }

    public function hapusKamar($id)
    {
      echo json_encode($this->db->delete('kamar', ['id'=>$id]));
    }
}
