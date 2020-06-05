<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Home extends CI_Controller
{
  public function __construct()
  {
    parent::__construct();
  }

  public function index()
  {
    $sesi_login = (array) $this->session->userdata('user_rusun');

    if ($sesi_login) {
      $data = array(
        'setting'       => $this->db->get('setting')->row_array(),
        'lokasi'        => "Dashboard",
        'admins'        => $this->db->get_where('admin', ['email !='=>$sesi_login['email']])->result_array(),
        'dUser'         => $sesi_login,
        'booking'       => $this->db->get_where('booking', ['status' => 1])->num_rows(),
        'userCowok'     => $this->db->get_where('users', ['gender'=>1])->num_rows(),
        'userCewek'     => $this->db->get_where('users', ['gender'=>2])->num_rows(),
        'penghuniCowok' => $this->db->get_where('kamar', ['gender'=>1,'status'=>3])->num_rows(),
        'penghuniCewek' => $this->db->get_where('kamar', ['gender'=>2,'status'=>3])->num_rows(),
        'jumlahKamar'   => $this->db->get('kamar')->num_rows(),
        'sisaKamar'     => $this->db->get_where('kamar', ['status'=>1])->num_rows(),
      );

      $this->load->view('layout/header', $data);
      $this->load->view('home/dashboard', $data);
      $this->load->view('layout/footer', $data);
    } else {
      redirect('auth');
    }
  }

  public function Booking()
  {
    $sesi_login = (array) $this->session->userdata('user_rusun');

    if ($sesi_login) {

      if (isset($sesi_login['admin'])) {
        $data = array(
          'setting'       => $this->db->get('setting')->row_array(),
          'booking'       => $this->db->get_where('booking', ['status' => '1'])->num_rows(),
          'lokasi'        => "Booking",
          'dUser'         => $sesi_login
          );
          $this->load->view('layout/header', $data);
          $this->load->view('home/booking', $data);
          $this->load->view('layout/footer', $data);
        } else {
          if ($sesi_login['status']==0) {
            redirect('home');
          } else {
            $cek_booking = $this->db->get_where('booking',['user_nik'=>$sesi_login['nik'],'status'=>0])->num_rows();
            $cek_history = $this->db->get_where('booking',['user_nik'=>$sesi_login['nik'],'status'=>'!=0'])->num_rows();
            $cek_perpanjang = $this->db->get_where('booking',['user_nik'=>$sesi_login['nik'],'status'=>6])->num_rows();
            if($cek_booking >= 1){
              $data = array(
              // 'lunas'         => true,
              'setting'       => $this->db->get('setting')->row_array(),
              'booking'       => $this->db->get_where('booking', ['status' => 1])->num_rows(),
              'lokasi'        => "Booking",
              'dUser'         => $sesi_login,
              'rekening'      => $this->db->get('rekening')->result_array(),
              'invoice'       => $this->db->select('a.code_booking, b.code, b.tingkat, a.jumlah, b.harga, a.tanggal_booking, a.status')
                                          ->from('booking a')
                                          ->join('kamar b','a.kamar_id = b.id')
                                          ->where('user_nik',$sesi_login['nik'])
                                          ->where('a.status','0')
                                          ->get()
                                          ->row_array()
              );
              $this->load->view('layout/header', $data);
              $this->load->view('home/booking_invoice', $data);
              $this->load->view('layout/footer', $data);
            } elseif ($cek_perpanjang >= 1) {
              $data = array(
              'setting'       => $this->db->get('setting')->row_array(),
              'booking'       => $this->db->get_where('booking', ['status' => 1])->num_rows(),
              'lokasi'        => "Booking",
              'dUser'         => $sesi_login,
              'rekening'      => $this->db->get('rekening')->result_array(),
              'invoice'       => $this->db->select('a.code_booking, b.code, b.tingkat, a.jumlah, b.harga, a.tanggal_booking, a.status')
                                          ->from('booking a')
                                          ->join('kamar b','a.kamar_id = b.id')
                                          ->where('user_nik',$sesi_login['nik'])
                                          ->where('a.status','6')
                                          ->get()
                                          ->row_array(),
              'perpanjang'    => $this->db->select('a.*')
                                          ->from('perpanjang a')
                                          ->join('booking b','a.code_booking = b.code_booking')
                                          ->where('b.user_nik',$sesi_login['nik'])
                                          ->where('a.status','0')
                                          ->get()
                                          ->row_array()
              );
              $this->load->view('layout/header', $data);
              $this->load->view('home/booking_invoice', $data);
              $this->load->view('layout/footer', $data);
            } else {
              $data = array(
              'setting'       => $this->db->get('setting')->row_array(),
              'booking'       => $this->db->get_where('booking', ['status' => 1])->num_rows(),
              'kamar'         => $this->db->select('a.id,a.code,a.tingkat,a.harga,a.status,b.tanggal_selesai,b.tanggal_booking,a.gender')
              ->from('kamar a')
              ->join('booking b','b.kamar_id = a.id','left')
              ->where('a.gender',$sesi_login['gender'])
              ->order_by('gender','ASC')
              ->get()
              ->result_array(),
              'lokasi'        => "Booking",
              'dUser'         => $sesi_login,
              );
              if ($cek_history >= 1) {
                $data['history'] = "ada";
              }
              $this->load->view('layout/header', $data);
              $this->load->view('home/booking', $data);
              $this->load->view('layout/footer', $data);
            }
          }
        }
      } else {
        redirect('auth');
      }
    }

    public function Laporan($cetak=null)
    {
      $sesi_login = (array) $this->session->userdata('user_rusun');

      if (isset($sesi_login['admin'])) {
        if($cetak=="print"){
          $periode = $this->input->post('periode');
          $data = array(
            'setting' => $this->db->get('setting')->row_array(),
            'periode' => $periode,
            'data'    => $this->db->get('keuangan')->result_array()
          );
          if($periode=="All Periode"){
            $data['datanya'] = $this->db->select('a.id, b.code_booking as booking,b.tanggal_booking, b.tanggal_selesai, d.code as kamar, c.nama, b.rek_id, a.uang')
            ->from('keuangan a')
            ->join('booking b','b.code_booking = a.code_booking','left')
            ->join('users c','c.nik = b.user_nik')
            ->join('kamar d','d.id = b.kamar_id')
            ->order_by('b.tanggal_selesai','ASC')
            ->get()->result_array();

            $data['total'] = $this->db->select('sum(uang) as uang,')
            ->from('keuangan a')
            ->join('booking b','b.code_booking = a.code_booking','left')
            ->join('users c','c.nik = b.user_nik')
            ->join('kamar d','d.id = b.kamar_id')
            ->order_by('b.tanggal_selesai','ASC')
            ->get()->row_array();
          } else {
            $this->db->select('a.id, b.code_booking as booking, b.tanggal_booking, b.tanggal_selesai, d.code as kamar, c.nama, b.rek_id, a.uang')
            ->from('keuangan a')
            ->join('booking b','b.code_booking = a.code_booking','left')
            ->join('users c','c.nik = b.user_nik')
            ->join('kamar d','d.id = b.kamar_id')
            ->where('b.tanggal_selesai >=',substr($periode,0,10))
            ->where('b.tanggal_selesai <=',substr($periode,13,10))
            ->order_by('b.tanggal_selesai','ASC');
            $data['datanya'] = $this->db->get()->result_array();
            $this->db->select('sum(uang) as uang')
            ->from('keuangan a')
            ->join('booking b','b.code_booking = a.code_booking','left')
            ->join('users c','c.nik = b.user_nik')
            ->join('kamar d','d.id = b.kamar_id')
            ->where('b.tanggal_selesai >=',substr($periode,0,10))
            ->where('b.tanggal_selesai <=',substr($periode,13,10))
            ->order_by('b.tanggal_selesai','ASC');
            $data['total'] = $this->db->get()->row_array();
          }
          $this->load->view('home/laporan_cetak', $data);
        } else {
          $data = array(
          'setting'       => $this->db->get('setting')->row_array(),
          'booking'       => $this->db->get_where('booking', ['status' => 1])->num_rows(),
          'lokasi'        => "Laporan Keuangan",
          'dUser'         => $sesi_login
          );
          $this->load->view('layout/header', $data);
          $this->load->view('home/laporan', $data);
          $this->load->view('layout/footer', $data);
        }
      } else {
        redirect('auth');
      }
    }

    public function Gallery()
    {
      $sesi_login = (array) $this->session->userdata('user_rusun');

      if (isset($sesi_login['admin'])) {
        $data = array(
        'lokasi'        => "Gallery",
        'dUser'         => $sesi_login,
        'booking'       => $this->db->get_where('booking', ['status' => 1])->num_rows(),
        'setting'       => $this->db->get('setting')->row_array(),
        'gallery'       => $this->db->get('gallery')->result_array()
        );

        $this->load->view('layout/header', $data);
        $this->load->view('home/gallery', $data);
        $this->load->view('layout/footer', $data);
      } else {
        redirect('auth');
      }
    }

    public function Profile()
    {
      $sesi_login = (array) $this->session->userdata('user_rusun');

      if ($sesi_login) {
        if (isset($sesi_login['nik'])) {
          if ($sesi_login['status']==0) {
            redirect('home');
          } else {
            $data = array(
            'lokasi'        => "Profile",
            'dUser'         => $sesi_login,
            'booking'       => $this->db->get_where('booking', ['status' => 1])->num_rows(),
            'setting'       => $this->db->get('setting')->row_array()
            );
            $this->load->view('layout/header', $data);
            $this->load->view('home/profile', $data);
            $this->load->view('layout/footer', $data);
          }
        } else {
          $data = array(
          'lokasi'        => "Profile",
          'dUser'         => $sesi_login,
          'booking'       => $this->db->get_where('booking', ['status' => 1])->num_rows(),
          'setting'       => $this->db->get('setting')->row_array()
          );

          $this->load->view('layout/header', $data);
          $this->load->view('home/profile', $data);
          $this->load->view('layout/footer', $data);
        }
      } else {
        redirect('auth');
      }
    }

    public function Kamar($lokasi='')
    {
      $sesi_login = (array) $this->session->userdata('user_rusun');

      if (isset($sesi_login['admin'])) {
        $data = array(
        'setting'       => $this->db->get('setting')->row_array(),
        'booking'       => $this->db->get_where('booking', ['status' => 1])->num_rows(),
        'dUser'         => $sesi_login
        );
        switch ($lokasi) {
          case 'management':
          $data['dataKamar'] = $this->db->get_where('kamar',['status'=>3])->result_array();
          $data['lokasi']    = "Management Kamar";
          $data['tabel']     = "Management";
          break;

          default:
          $data['dataKamar'] = $this->db->get('kamar')->result_array();
          $data['lokasi']    = "Data Kamar";
          $data['tabel']     = "Data";
          break;
        }
        $this->load->view('layout/header', $data);
        $this->load->view('home/kamar', $data);
        $this->load->view('layout/footer', $data);
      } else {
        redirect('auth');
      }
    }

    public function Users($lokasi=null)
    {
      $sesi_login = (array) $this->session->userdata('user_rusun');

      if (isset($sesi_login['admin'])) {
        $data = array(
        'setting'       => $this->db->get('setting')->row_array(),
        'booking'       => $this->db->get_where('booking', ['status' => 1])->num_rows(),
        'dUser'         => $sesi_login
        );
        switch ($lokasi) {
          case 'admin':
          $data['dataKamar'] = $this->db->get_where('kamar',['status'=>3])->result_array();
          $data['lokasi']    = "Admins";
          break;

          default:
          $data['dataKamar'] = $this->db->get('kamar')->result_array();
          $data['lokasi']    = "Users";
          break;
        }
        $this->load->view('layout/header', $data);
        $this->load->view('home/users', $data);
        $this->load->view('layout/footer', $data);
      } else {
        redirect('auth');
      }
    }

    public function Setting()
    {
      $sesi_login = (array) $this->session->userdata('user_rusun');

      if (isset($sesi_login['admin'])) {
        $data = array(
        'lokasi'        => "Pengaturan Aplikasi",
        'dUser'         => $sesi_login,
        'booking'       => $this->db->get_where('booking', ['status' => 1])->num_rows(),
        'setting'       => $this->db->get('setting')->row_array()
        );

        $this->load->view('layout/header', $data);
        $this->load->view('home/setting', $data);
        $this->load->view('layout/footer', $data);
      } else {
        redirect('auth');
      }
    }
}
