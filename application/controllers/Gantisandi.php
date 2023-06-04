<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Gantisandi extends My_Controller
{
     public function __construct()
     {
          parent::__construct();
          $this->is_logout();
     }

     public function index()
     {
          $data['nama'] = $this->session->userdata("nama");
          $data['email'] = $this->session->userdata("email");
          $data['menu'] = $this->session->userdata("id_menu");
          $this->load->view('dashboard/template/header', $data);
          $this->load->view('dashboard/ganti_snd/ganti_sandi');
          $this->load->view('dashboard/modal/gantisandi');
          $this->load->view('dashboard/template/footer', $data);
          $this->load->view('dashboard/code/gantisandi');
          $this->session->set_flashdata('msg', '');
     }

     public function ganti()
     {
          $this->form_validation->set_rules("lamaSandi", "lamaSandi", "required|trim", [
               'required' => 'Sandi lama wajib diisi'
          ]);
          $this->form_validation->set_rules("baruSandi", "baruSandi", "required|trim|min_length[6]", [
               'required' => 'Sandi baru wajib diisi',
               'min_length' => 'Sandi baru minimal 6 karakter'
          ]);
          $this->form_validation->set_rules("ulangSandi", "ulangSandi", "required|trim|min_length[6]|matches[baruSandi]", [
               'required' => 'Konfirmasi ulang sandi baru wajib diisi',
               'matches' => 'Konfirmasi ulang sandi tidak sama'
          ]);

          if ($this->form_validation->run() == false) {
               $data['nama'] = $this->session->userdata("nama");
               $data['email'] = $this->session->userdata("email");
               $data['menu'] = $this->session->userdata("id_menu");
               $this->load->view('dashboard/template/header', $data);
               $this->load->view('dashboard/ganti_snd/ganti_sandi');
               $this->load->view('dashboard/modal/gantisandi');
               $this->load->view('dashboard/template/footer', $data);
               $this->load->view('dashboard/code/gantisandi');
          } else {
               $sandi_lama = htmlspecialchars($this->input->post("lamaSandi", true));
               $sandi_baru = htmlspecialchars($this->input->post("baruSandi", true));

               $query = $this->lgn->ganti_sandi($sandi_lama, $sandi_baru);
               if ($query == 200) {
                    $this->session->set_flashdata('msg', '<div class="err_psn_sandi alert alert-info animate__animated animate__bounce"> Sandi berhasil diganti </div>');
               } else if ($query == 202) {
                    $this->session->set_flashdata('msg', '<div class="err_psn_sandi alert alert-danger animate__animated animate__bounce"> Sandi gagal diganti </div>');
               } else if ($query == 201) {
                    $this->session->set_flashdata('msg', '<div class="err_psn_sandi alert alert-danger animate__animated animate__bounce"> Sandi lama salah </div>');
               } else if ($query == 203) {
                    $this->session->set_flashdata('msg', '<div class="err_psn_sandi alert alert-danger animate__animated animate__bounce"> User tidak ditemukan </div>');
               }

               $data['nama'] = $this->session->userdata("nama");
               $data['email'] = $this->session->userdata("email");
               $data['menu'] = $this->session->userdata("id_menu");
               $this->load->view('dashboard/template/header', $data);
               $this->load->view('dashboard/ganti_snd/ganti_sandi');
               $this->load->view('dashboard/modal/gantisandi');
               $this->load->view('dashboard/template/footer', $data);
               $this->load->view('dashboard/code/gantisandi');
          }
     }
}
