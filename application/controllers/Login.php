<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Login extends My_Controller
{
     public function __construct()
     {
          parent::__construct();
          $this->is_login();
     }
     public function index()
     {
          $this->load->view('login/login');
     }

     public function auth()
     {

          $this->form_validation->set_rules('temail', 'email', 'required|trim|valid_email', [
               'required' => "Email tidak boleh kosong",
               'valid_email' => 'Format email anda salah'
          ]);
          $this->form_validation->set_rules('tsandi', 'sandi', 'required|trim', [
               'required' => "Sandi tidak boleh kosong"
          ]);
          if ($this->form_validation->run() == false) {
               $this->load->view('login/login');
          } else {
               $email = htmlspecialchars(trim($this->input->post('temail', true)));
               $sandi = md5(trim($this->input->post('tsandi')));

               $cek = $this->lgn->get_login($email, $sandi);

               if ($cek != "") {
                    $data = json_decode($cek);
                    if ($data->{'statusCode'} == 200) {
                         $session_data = array(
                              'id_user'   => $data->{'id_user'},
                              'email'  => $data->{'email_user'},
                              'nama'  => $data->{'nama_user'},
                              'auth_user' => $data->{'auth_user'},
                              'id_menu' => $data->{'id_menu'},
                              'id_m_perusahaan' => $data->{'id_m_perusahaan'}
                         );

                         $this->session->set_userdata($session_data);

                         redirect('dash');
                    } else {
                         $this->session->set_flashdata('pesan', '<div class="pesan alert alert-danger animate__animated animate__bounce" role="alert"> ' . $data->{'pesan'} . '</div>');
                         $this->load->view('login/login');
                    }
               } else {
                    $this->session->set_flashdata('pesan', '<div class="pesan alert alert-danger animate__animated animate__bounce" role="alert"> Email tidak ditemukan</div>');
                    $this->load->view('login/login');
               }
          }
     }
}
