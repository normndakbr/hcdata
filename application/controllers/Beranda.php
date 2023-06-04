<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Beranda extends My_Controller
{

     public function index()
     {
          $jml_user = $this->dsmod->count_all_user();
          $data['nama'] = $this->session->userdata("nama");
          $data['email'] = $this->session->userdata("email");
          $data['menu'] = $this->session->userdata("id_menu");
          $data['jml_user'] = $jml_user;

          $this->load->view('dashboard/beranda', $data);
     }
}
