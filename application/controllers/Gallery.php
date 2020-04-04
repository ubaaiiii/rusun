<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Gallery extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        //Codeigniter : Write Less Do More
    }

    public function tambah()
    {
      $config['upload_path']    = "./assets/images/gallery/";
      $config['allowed_types']  = 'gif|jpg|png';
      $config['encrypt_name']   = TRUE;
      $config['max_size']       = 2000;
      $this->load->library('upload',$config);
      $deskripsi = ucwords($this->input->post('judul-gambar'));
      if($this->upload->do_upload("file_gallery")){
        $data = array('upload_data' => $this->upload->data());
        $image= $data['upload_data']['file_name'];
        $result = $this->db->insert('gallery',['foto'=>$image,'deskripsi'=>$deskripsi]);
        echo json_encode($result);
      } else {
        echo "false";
      }
    }

    public function edit($id)
    {
      $deskripsi = $this->input->post('deskripsi');
      echo json_encode($this->db->where('id',$id)->update('gallery',['deskripsi'=>$deskripsi]));
    }

    public function hapus($id)
    {
      $row = $this->db->get_where('gallery',['id'=>$id])->row_array();
      $gambarnya = "./assets/images/gallery/".$row['foto'];

      if ($this->db->delete('gallery', ['id' => $id])){
        echo json_encode(unlink($gambarnya));
      } else {
        echo "gagal";
      }
    }

    public function foto()
    {
      $data['gallery'] = $this->db->get('gallery')->result_array();
      $data['setting'] = $this->db->get('setting')->row_array();
      $this->load->view('home/gallery-foto',$data);
    }
}
