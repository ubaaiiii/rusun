<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Modal extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        //Codeigniter : Write Less Do More
    }

    public function rekening($id=null)
    {
      if ($id==null) {
        $data['kosong'] = null;
      } else {
        $data['rekening'] = $this->db->get_where('rekening',['id'=>$id])->row_array();
      }
      $this->load->view('modal/rekening',$data);
    }

    public function kamar($id=null)
    {
      $data['dataKosong'] = null;
      if ($id!=null) {
        $data['kamar'] = $this->db->get_where('kamar',['id'=>$id])->row_array();
      }
      $this->load->view('modal/kamar',$data);
    }

    public function booking($id)
    {
      $data['kamar'] = $this->db->get_where('kamar',['id'=>$id])->row_array();
      $this->load->view('modal/booking',$data);
    }

    public function perpanjang($id)
    {
      $data['perpanjang'] = $this->db->select('*')
                                     ->from('booking a')
                                     ->join('kamar b','a.kamar_id = b.id')
                                     ->where('a.code_booking',$id)
                                     ->get()
                                     ->row_array();
      $this->load->view('modal/perpanjang',$data);
    }

    public function bukti($gambar='')
    {
      $data['gambar'] = $gambar;
      $this->load->view('modal/bukti',$data);
    }

    public function user($kode=null,$id=null)
    {
      if ($kode!=null) {
        if ($kode=="admin") {
          $data['user'] = $this->db->get_where('admin',['id'=>$id])->row_array();
        } else {
          $data['user'] = $this->db->get_where('users',['nik'=>$id])->row_array();
        }
      } else {
        $data = null;
      }
      $this->load->view('modal/user',$data);
      // $this->load->view('login/layout/header', $data);
    }

    public function admin($value=null)
    {
      $data['user'] = $this->db->get_where('admin',['id'=>$value])->row_array();
      $this->load->view('modal/admin',$data);
    }

    public function gambar($id=null,$aksi=null)
    {
      if ($aksi==null) {
        $data['gambar'] = $this->db->get_where('gallery',['id'=>$id])->row_array();
        $this->load->view('modal/gambar',$data);
      } else if ($aksi=="edit") {
        $data['gambar'] = $this->db->get_where('gallery',['id'=>$id])->row_array();
        $data['aksi'] = "edit";
        $this->load->view('modal/gambar',$data);
      }
    }

    public function ktp($id=null)
    {
      $this->load->view('modal/ktp');
    }

    public function upload_bukti($id=null)
    {
      $data['rekening'] = $this->db->get('rekening')->result_array();
      $data['dataBooking'] = $this->db->get_where('booking',['code_booking'=>$id])->row_array();
      $this->load->view('modal/upload_bukti',$data);
    }
}
