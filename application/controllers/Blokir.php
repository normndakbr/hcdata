<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Blokir extends My_Controller
{
     public function __construct()
     {
          parent::__construct();
     }

     public function index()
     {
          $ip = $_SERVER['REMOTE_ADDR'];
          $cek_ip = $this->lgn->cek_ip($ip);

          if (!empty($cek_ip)) {
               foreach ($cek_ip as $lstip) {
                    $waktu = $lstip->back_log;
               }

               $now = date("Y-m-d H:i:s");

               if ($waktu > $now) {
                    $data = [
                         'waktu' => $waktu,
                    ];

                    $this->load->view('errors/block', $data);
               } else {
                    redirect(base_url('verifikasi'));
               }
          } else {
               redirect(base_url('verifikasi'));
          }
     }

     public function errorvalidation()
     {
          $this->load->view('errors/errorvalidation');
     }

     public function notallowed()
     {
          $this->load->view('errors/notallowed');
     }
}
