<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Kamar extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        //Codeigniter : Write Less Do More
    }

    public function Data()
    {
      echo json_encode($this->db->get('kamar')->result_array());
    }

    public function DataManagement()
    {
      $this->db->select('b.status, b.code_booking as booking, c.nama, a.code as kamar, b.tanggal_booking, b.tanggal_mulai, b.tanggal_selesai ')
               ->from('booking b')
               ->join('kamar a','b.kamar_id = a.id','left')
               ->join('users c','c.nik = b.user_nik','left')
               ->order_by('c.nama','ASC')
               ->where('b.status =',2);
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

    public function hapus($id)
    {
      echo json_encode($this->db->delete('kamar', ['id'=>$id]));
    }

    public function akhiri($code)
    {
      echo json_encode(
        $this->db->query("UPDATE booking a
                          INNER JOIN kamar b ON a.kamar_id = b.id
                          SET a.status = '3',
                              b.status = '1'
                          WHERE a.code_booking = '$code'"));
    }

    public function proses($tipe)
    {
      $data['harga'] = str_replace('.', '', $this->input->post('harga'));
      $data['tingkat'] = $this->input->post('tingkat');
      if ($this->input->post('gender')!==null) {
        $data['gender'] = 1;
      } else {
        $data['gender'] = 2;
      }

      if ($tipe=="update"){
        $id = $this->input->post('id');
        echo json_encode($this->db->update('kamar',$data,['id'=>$id]));
      } else {
        $num = $this->db->get('kamar')->num_rows();
        for ($i=1; $i <= $num+1 ; $i++) {
          if ($this->input->post('gender')!==null) {
            $kode = "A".$i;
          } else {
            $kode = "B".$i;
          }
          if ($this->db->get_where('kamar',['code'=>$kode])->num_rows()==0) {
            break;
          }
        }
        $data['status'] = "1";
        $data['code'] = $kode;
        echo json_encode($this->db->insert('kamar',$data));
      }
    }
}
