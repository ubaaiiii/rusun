<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Booking extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        date_default_timezone_set('Asia/Jakarta');
        //Codeigniter : Write Less Do More
    }

    public function Data($nik=null)
    {
        if ($nik==null) {
            $this->db->select('a.code_booking as booking,(a.jumlah*c.harga) as uang, b.nama, c.code as kamar, c.id as id_kamar, a.tanggal_booking, a.tanggal_mulai, a.tanggal_selesai, concat(d.bank," - ",d.nama) as rekening, a.upload_bukti, a.status as bookstats, a.tanggal_lunas')
                    ->from('booking a')
                    ->join('users b', 'b.nik = a.user_nik', 'left')
                    ->join('kamar c', 'c.id = a.kamar_id', 'left')
                    ->join('rekening d', 'd.id = a.rek_id', 'left');
                    // ->join('perpanjang e', 'e.code_booking = a.code_booking', 'left')
                    // ->where('a.status != ', '0');
            echo json_encode($this->db->get()->result_array());
        } else {
            $this->db->select('a.code_booking as booking, b.nama, c.code as kamar, c.id as id_kamar, a.tanggal_booking, a.tanggal_mulai, a.tanggal_selesai, concat(d.bank," - ",d.nama) as rekening, a.upload_bukti, a.status as bookstats, a.tanggal_lunas')
                    ->from('booking a')
                    ->join('users b', 'b.nik = a.user_nik', 'left')
                    ->join('kamar c', 'c.id = a.kamar_id')
                    ->join('rekening d', 'd.id = a.rek_id')
                    ->where('user_nik', $nik);
            echo json_encode($this->db->get()->result_array());
        }
    }

    public function DataManagement()
    {
        $this->db->select('b.code_booking as booking, c.nama, a.code as kamar, b.tanggal_booking, b.tanggal_mulai, b.tanggal_selesai ')
               ->from('booking b')
               ->join('kamar a', 'b.kamar_id = a.id', 'left')
               ->join('users c', 'c.nik = b.user_nik', 'left')
               ->order_by('c.nama', 'ASC')
               ->where('b.status !=', 0);
        echo json_encode($this->db->get()->result_array());
    }

    public function Invoice()
    {
        $sesi_login = (array) $this->session->userdata('user_rusun');
        $data = array(
        'setting'       => $this->db->get('setting')->row_array(),
        'booking'       => $this->db->get_where('booking', ['status' => 0])->num_rows(),
        'lokasi'        => "Booking",
        'dUser'         => $sesi_login,
        'rekening'      => $this->db->get('rekening')->result_array(),
        'invoice'       => $this->db->select('*')
                                    ->from('booking a')
                                    ->join('kamar b', 'a.kamar_id = b.id')
                                    ->get()
                                    ->row_array()
      );
        $this->load->view('layout/header', $data);
        $this->load->view('home/booking_invoice', $data);
        $this->load->view('layout/footer', $data);
    }

    public function konfirmasi($kode, $uang)
    {
        $data = array(
        'tanggal_lunas' => date('Y-m-d H:i:s'),
        'status'        => 2
      );
        $dataKeuangan = array(
        'tanggal_confirm' => date('Y-m-d H:i:s'),
        'uang'            => $uang,
        'deskripsi'       => 'Konfirmasi Pembayaran Booking',
        'code_booking'    => $kode
      );
        $booking = $this->db->get_where('booking', ['code_booking'=>$kode])->row_array();
        if ($this->db->update('kamar', ['status'=>'3'], ['id'=>$booking['kamar_id']])=="true") {
            if ($this->db->insert('keuangan', $dataKeuangan)==true) {
                echo json_encode($this->db->update('booking', $data, ['code_booking'=>$kode]));
            } else {
                echo json_encode("gagal_keuangan");
            }
        } else {
            echo json_encode("gagal_kamar");
        }
    }

    public function tolak($kode)
    {
        $this->db->query('UPDATE kamar a join booking b on a.id = b.kamar_id
                        SET a.status=1
                        WHERE b.code_booking='.$kode);
        $data = array(
        'tanggal_lunas' => date('Y-m-d H:i:s'),
        'status'        => 4
      );
        echo json_encode($this->db->update('booking', $data, ['code_booking'=>$kode]));
    }

    public function simpan()
    {
        $dUser = (array) $this->session->userdata('user_rusun');
        $id = $this->input->post('id-kamar');
        $jumlah = $this->input->post('bulan');
        $data = $this->db->get_where('kamar', ['id'=>$id])->row_array();
        $randnum = random_string('basic', 9);
        $datanya = array(
          'code_booking'    => $randnum,
          'user_nik'        => $dUser['nik'],
          'kamar_id'        => $id,
          'jumlah'          => $jumlah,
          'tanggal_mulai'   => $this->input->post('tanggal-mulai')." ".$this->input->post('waktu-mulai'),
          'tanggal_selesai' => $this->input->post('tanggal-selesai')." ".$this->input->post('waktu-mulai'),
          'tanggal_booking' => date('Y-m-d H:i:s'),
        );
        if ($this->db->get_where('booking', ['code_booking'=>$randnum])->num_rows()>=1) {
            echo "exists";
        } else {
            if ($this->db->update('kamar', ['status'=>2], ['id'=>$id])) {
                echo json_encode($this->db->insert('booking', $datanya));
            }
        }
    }

    public function perpanjang()
    {
        $dUser = (array) $this->session->userdata('user_rusun');
        $id = $this->input->post('id-kamar');
        $kode = $this->input->post('id-booking');
        $jumlah = $this->input->post('bulan');
        $jenis = $this->input->post('jenis');
        $booking = $this->db->get_where('booking', ['code_booking'=>$kode])->row_array();
        $data_perpanjang = array(
          'code_booking'      => $kode,
          'tanggal_request'   => date('Y-m-d H:i:s'),
          'tanggal_awal'      => $booking['tanggal_selesai'],
          'tanggal_akhir'     => $this->input->post('tanggal-selesai')." ".$this->input->post('waktu-mulai'),
          'jumlah_bulan'      => $jumlah
        );
        if ($this->db->insert('perpanjang', $data_perpanjang)) {
            if ($jenis == 'approval') {
                echo json_encode($this->db->update('booking', ['status'=>2,'tanggal_selesai'=>$this->input->post('tanggal-selesai')." ".$this->input->post('waktu-mulai')], ['code_booking'=>$kode]));
            } else {
                echo json_encode($this->db->update('booking', ['status'=>5], ['code_booking'=>$kode]));
            }
        } else {
            echo json_encode("gagal perpanjang");
        }
    }

    public function upload_bukti()
    {
        $config['upload_path']    = "assets/images/bukti/";
        $config['allowed_types']  = 'gif|jpg|png|jpeg';
        $config['encrypt_name']   = true;
        $config['max_size']       = 2000;
        $this->load->library('upload', $config);
        $this->upload->initialize($config);

        if ($this->upload->do_upload("file_bukti")) {
            $data = array('upload_data' => $this->upload->data());
            $image= $data['upload_data']['file_name'];
            $codeBooking = $this->input->post('code-booking');
            $bookingnya = $this->db->get_where('booking', ['code_booking'=>$codeBooking])->row_array();
            $rekening = $this->input->post('rekening');
            if ($bookingnya['status']==0) {
                $result = $this->db->set(['upload_bukti'=>$image,'rek_id'=>$rekening,'status'=>1])->where('code_booking', $codeBooking)->update('booking');
            } elseif ($bookingnya['status']==5) {
                $perpanjang = $this->db->get_where('perpanjang', ['code_booking'=>$codeBooking,'status'=>0])->row_array();
                $this->db->update('booking', ['status'=>6], ['code_booking'=>$codeBooking]);
                $result = $this->db->update('perpanjang', ['upload_bukti'=>$image,'rek_id'=>$rekening,'tanggal_bayar'=>date('Y-m-d H:i:s')], ['code_booking'=>$codeBooking,'status'=>0]);
            }
            echo json_encode($result);
        } else {
            // echo "upload_error";
            echo $this->load->display_errors();
        }
    }

    public function batal($tipe, $code)
    {
        if ($tipe=="booking") {
            $this->db->query("UPDATE kamar
          JOIN booking on kamar.id = booking.kamar_id
          SET kamar.status = '1'
          WHERE booking.code_booking = $code");
            echo json_encode($this->db->delete('booking', ['code_booking'=>$code]));
        } elseif ($tipe=="perpanjang") {
            if ($this->db->update('booking', ['status'=>2], ['code_booking'=>$code])) {
                echo json_encode($this->db->delete('perpanjang', ['code_booking'=>$code,'status'=>0]));
            }
        }
    }

    public function getKamar()
    {
        echo json_encode($this->db->get('kamar')->result_array());
    }
}
