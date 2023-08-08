<?php

class My_Controller extends CI_Controller
{

     public function __construct()
     {
          parent::__construct();
          $this->load->model("login_model", "lgn");
          $this->load->model('depart_model', 'dprt');
          $this->load->model('posisi_model', 'pss');
          $this->load->model('level_model', 'lvl');
          $this->load->model('grade_model', 'grd');
          $this->load->model('tipe_model', 'tpe');
          $this->load->model('perjanjian_model', 'janji');
          $this->load->model('unit_model', 'unt');
          $this->load->model('sim_model', 'smm');
          $this->load->model('sanksi_model', 'snk');
          $this->load->model('lokker_model', 'lkr');
          $this->load->model('lokterima_model', 'lkt');
          $this->load->model('poh_model', 'pho');
          $this->load->model('daerah_model', 'drh');
          $this->load->model('dash_model', 'dsmod');
          $this->load->model('User_model', 'usr');
          $this->load->model('Struktur_model', 'str');
          $this->load->model('perusahaan_model', 'prs');
          $this->load->model('Karyawan_model', 'kry');
          $this->load->model('Klasifikasi_model', 'kls');
          $this->load->model('Pendidikan_model', 'pdk');
          $this->load->model('Izin_tambang_model', 'smp');
          $this->load->model('Sertifikasi_model', 'srt');
          $this->load->model('Vaksin_model', 'vks');
          $this->load->model('NonaktifKary_model', 'nakary');
          $this->load->helper('url', 'form', 'captcha');
          $this->load->library('form_validation', 'session');
     }

     public function is_logout()
     {
          if ($this->session->userdata("email_hcdata") == "") {
               header("location: http://localhost:8080/hcdata");
          }
     }

     public function is_login()
     {
          if ($this->session->userdata("email_hcdata") != "") {
               header("location: http://localhost:8080/hcdata/dash");
          }
     }
}
