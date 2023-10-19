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
          $this->load->model('Audit_model', 'adt');
          $this->load->model('Pengajuansm_model', 'psm');
          $this->load->model('Pelanggaran_model', 'lgr');
          $this->load->model('Karyizin_model', 'kryizn');
          $this->load->model('NonaktifKary_model', 'nakary');
          $this->load->helper('url', 'form', 'captcha');
          $this->load->library('form_validation', 'session', 'user_agent');
     }

     public function is_logout()
     {
          if ($this->session->userdata("email_hcdata") == "") {
               redirect('login');
          }
     }

     public function is_login()
     {
          if ($this->session->userdata("email_hcdata") != "") {
               redirect('dash');
          }
     }

     public function cek_auth($auth)
     {
          $auth_valid =  $this->session->csrf_token;
          $email = $this->session->email_hcdata;
          if ($auth !== $auth_valid) {
               $data_err = [
                    'email_error' => $email,
                    'ip_error' => $_SERVER['REMOTE_ADDR'],
                    'ip_akses' => $_SERVER['REMOTE_ADDR'],
                    'msg_error' => 'Token tidak valid : ' . $auth . " - valid token : " . $auth_valid,
                    'tgl_buat' => date('Y-m-d H:i:s'),
               ];

               $err = $this->lgn->get_err_log($data_err);

               return 501;
          } else {
               return 500;
          }
     }

     public function cek_device()
     {
          $OSblock = ['Android', 'Linux', 'IOS'];

          if ($this->agent->is_browser()) {
               $agent2 = $this->agent->platform();
          } elseif ($this->agent->is_robot()) {
               $agent2 = $this->agent->platform();
          } elseif ($this->agent->is_mobile()) {
               $agent2 = $this->agent->platform();
          } else {
               $agent2 = 'Unidentified';
          }

          if (in_array($agent2, $OSblock)) {
               redirect(base_url('erraccess'));
               die;
          }
     }

     public function save_audit($data)
     {
          return $this->adt->input_audit($data);
     }
}
