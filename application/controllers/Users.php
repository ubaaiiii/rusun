<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Users extends CI_Controller
{
  public function __construct()
  {
    parent::__construct();
    $this->load->model('M_Auth');
    //Codeigniter : Write Less Do More
  }

  public function Data($table)
  {
    echo json_encode($this->db->get($table)->result_array());
  }

  public function proses($role,$tipe)
  {
    if ($role=="admin") {
      $data = array(
        'nama'    => ucwords($this->input->post('nama')),
        'no_telp' => $this->input->post('no_telp'),
        'email'   => $this->input->post('email')
      );
      if ($tipe=="simpan") {  //admin
        if ($this->db->get_where('admin',['email'=>$data['email']])->num_rows()) {
          echo "email_exists";
        } else if ($this->db->get_where('admin',['no_telp'=>$data['no_telp']])->num_rows()) {
          echo "telp_exists";
        } else {
          $data['password'] = sha1($this->input->post('password'));
          $data['foto'] = "king.png";
          $data['admin'] = 1;
          if ($this->db->insert('admin',$data)) {
            echo "saved";
          }
        }

      } else if ($tipe=="edit") {
        $id = $this->input->post('id');
        if ($this->db->update('admin',$data,['id'=>$id])) {
          echo "edited";
        }
      } else {
        echo "error";
      }
    } else {            // user
      $data = array(
        'nik'   => $this->input->post('nik'),
        'nama'  => ucwords($this->input->post('nama')),
        'no_telp' => $this->input->post('no_telp'),
        'email' => $this->input->post('email'),
        'gender' => $this->input->post('gender'),
        'alamat' => $this->input->post('alamat')
        );
        if ($tipe=="simpan") {
          if ($this->db->get_where('users',['nik'=>$data['nik']])->num_rows()) {
            echo "nik_exists";
          } else if ($this->db->get_where('users',['email'=>$data['email']])->num_rows()) {
            echo "email_exists";
          } else if ($this->db->get_where('users',['no_telp'=>$data['no_telp']])->num_rows()) {
            echo "telp_exists";
          } else {
            $data['password'] = sha1($this->input->post('password'));
            if ($data['gender']==1) {
              $data['foto'] = "male.png";
            } else {
              $data['foto'] = "female.png";
            }
            if ($this->db->insert('users',$data)) {
              echo "saved";
            }
          }
        } else if ($tipe=="edit") {
          $id = $this->input->post('id');
          if ($id != $data['nik']) {
            if ($this->db->update('users',$data,['nik'=>$id])) {
              if ($this->db->update('booking',['user_nik'=>$data['nik']],['user_nik'=>$id])) {
                echo "edited";
              }
            }
          } else {
            if ($this->db->update('users',$data,['nik'=>$id])) {
              echo "edited";
            }
          }
        } else {
          echo "error";
        }
      }
    }

    public function foto_profile()
    {
      $user = (array) $this->session->userdata('user_rusun');
      if (isset($user['admin'])) {
        $config['upload_path']    = "./assets/images/author/";
      } else {
        $config['upload_path']    = "./assets/images/users/";
      }
      $config['allowed_types']  = 'gif|jpg|png';
      $config['encrypt_name']   = TRUE;
      $config['max_size']       = 2000;
      $this->load->library('upload',$config);
      $gambarnya = $config['upload_path'].$user['foto'];

      if($this->upload->do_upload("foto_profile")){
        $data = array('upload_data' => $this->upload->data());
        $image= $data['upload_data']['file_name'];

        if (isset($user['admin'])) {
          if ($this->db->update('admin',['foto'=>$image],['id'=>$user['id']])) {
            if ($row = $this->M_Auth->get_login($user['email'], $user['password'])) {
              $this->session->set_userdata('user_rusun', $row);
              if (file_exists($gambarnya)) {
                unlink($gambarnya);
              }
              echo "true";
            } else {
              echo "gagal_login";
            }
          } else {
            echo "gagal_update";
          }
        } else {
          if ($this->db->update('users',['foto'=>$image],['nik'=>$user['nik']])) {
            if ($row = $this->M_Auth->get_login($user['email'], $user['password'])) {
              $this->session->set_userdata('user_rusun', $row);
              if (file_exists($gambarnya)) {
                if ($user['foto'] != "male.png" || $user['foto'] != "female.png") {
                  unlink($gambarnya);
                }
              }
              echo "true";
            } else {
              echo "gagal_login";
            }
          } else {
            echo "gagal_update";
          }
        }
      } else {
        echo "gagal_upload";
      }
    }

    public function hapus($role,$id)
    {
      if ($role=="admin") {
        echo json_encode($this->db->delete('admin',['id'=>$id]));
      } else {
        if ($booking = $this->db->get_where('booking',['user_nik'=>$id])->row_array()) {
          if ($booking['status']==2) {
            echo "forbid";
          } else {
            if ($this->db->update('booking',['user_nik'=>1],['user_nik'=>$id])) {
              echo json_encode($this->db->delete('users',['nik'=>$id]));
            }
          }
        } else {
          echo json_encode($this->db->delete('users',['nik'=>$id]));
        }
      }
    }

    public function ubah_bio()
    {
      $role = $this->input->post('role');
      $id = $this->input->post('id');

      if ($role=="admin") {
        $data = array(
          'nama' => ucwords($this->input->post('nama')),
          'email' => $this->input->post('email'),
          'no_telp' => $this->input->post('no_telp')
        );
        if ($this->db->update('admin',$data,['id'=>$id])) {
          $row = $this->db->get_where('admin',['id'=>$id])->row_array();
          $this->session->set_userdata('user_rusun',$row);
          echo "true";
        } else {
          echo "false";
        }
      } else {
        $data = array(
          'nik' => $this->input->post('nik'),
          'nama' => $this->input->post('nama'),
          'email' => $this->input->post('email'),
          'no_telp' => $this->input->post('no_telp'),
          'gender' => $this->input->post('gender'),
          'alamat' => $this->input->post('alamat')
        );
        if ($this->db->update('users',$data,['nik'=>$id])) {
          $row = $this->db->get_where('users',['nik'=>$id])->row_array();
          $this->session->set_userdata('user_rusun',$row);
          echo "true";
        } else {
          echo "false";
        }
      }
    }

    public function ubah_password()
    {
      $id = $this->input->post('id');
      $psLama = sha1($this->input->post('psLama'));
      $psBaru = sha1($this->input->post('psBaru'));
      $role = $this->input->post('role');

      if ($role=="admin") {
        if ($this->db->get_where('admin',['id'=>$id,'password'=>$psLama])->row_array()) {
          $this->db->update('admin',['password'=>$psBaru],['id'=>$id]);
          if ($row = $this->db->get_where('admin',['id'=>$id])->row_array()) {
            $this->session->set_userdata('user_rusun', $row);
            echo "logged_in";
          } else {
            echo "signt";
          }
        } else {
          echo "wrong";
        }
      } else {
        if ($this->db->get_where('users',['nik'=>$id,'password'=>$psLama])->row_array()) {
          $this->db->update('users',['password'=>$psBaru],['nik'=>$id]);
          if ($row = $this->db->get_where('users',['nik'=>$id])->row_array()) {
            $this->session->set_userdata('user_rusun', $row);
            echo "logged_in";
          } else {
            echo "signt";
          }
        } else {
          echo "wrong";
        }
      }
    }

    public function simpan_ktp()
    {
      $sesi_login = (array) $this->session->userdata('user_rusun');
      $config['upload_path']    = "assets/images/ktp/";
      $config['allowed_types']  = 'gif|jpg|png|jpeg';
      $config['encrypt_name']   = TRUE;
      $config['max_size']       = 2000;
      $this->load->library('upload',$config);
      $this->upload->initialize($config);

      if($this->upload->do_upload("file_ktp")){
        $data = array('upload_data' => $this->upload->data());
        $image= $data['upload_data']['file_name'];
        if ($this->db->set(['ktp'=>$image,'status'=>1])->where('nik', $sesi_login['nik'])->update('users')) {
          if ($row = $this->M_Auth->get_login($sesi_login['email'], $sesi_login['password'])) {
            $this->session->set_userdata('user_rusun', $row);
            echo "true";
          } else {
            echo "gagal_login";
          }
        } else {
          echo "gagal_update";
        }
      } else {
        // echo "gagal_upload";
        echo $this->upload->display_errors();
      }
    }

  }
