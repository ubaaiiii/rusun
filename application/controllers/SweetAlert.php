<?php
defined('BASEPATH') or exit('No direct script access allowed');

class SweetAlert extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        //Codeigniter : Write Less Do More
    }

    public function index($tipe,$tujuan,$pesan)
    {
      $data['tujuan'] = $tujuan;
      $data['pesan'] = $pesan;
      $data['tipe'] = $tipe;
      $this->load->view('sweetalert',$data);
    }

}
