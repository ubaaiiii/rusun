<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_Auth extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    public function get_by_cookie($cookie)
    {
        if ($rowAdmin = $this->db->get_where('admin', ['cookie'=>$cookie])) {
            return $rowAdmin->row();
        } elseif ($rowUser = $this->db->get_where('users', ['cookie'=>$cookie])) {
            return $rowUser->row();
        } else {
            return false;
        }
    }

    public function get_login($email, $password)
    {
        $rowUser = $this->db->get_where('users', ['email'=>$email,'password'=>$password]);
        $rowAdmin = $this->db->get_where('admin', ['email'=>$email,'password'=>$password]);
        if ($rowUser->num_rows() >= 1) {
            return $rowUser->row();
        } elseif ($rowAdmin->num_rows() >= 1) {
            return $rowAdmin->row();
        } else {
            return false;
        }
    }

    public function get_nik($nik)
    {
        return $this->db->get_where('users', ['nik'=>$nik])->row();
    }
}
