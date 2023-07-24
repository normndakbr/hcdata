<?php
defined('BASEPATH') or exit('No direct script access allowed');

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

class Login extends My_Controller
{
     public function __construct()
     {
          parent::__construct();
          $this->is_login();

          require APPPATH . 'libraries/phpmailer/src/Exception.php';
          require APPPATH . 'libraries/phpmailer/src/PHPMailer.php';
          require APPPATH . 'libraries/phpmailer/src/SMTP.php';
     }
     public function index()
     {
          $dtcap = array(
               'captcha' => $this->create_captcha(),
          );

          $this->load->view('login/login', $dtcap);
     }

     public function reset()
     {
          $this->load->view('login/resetlogin');
     }

     function sukses()
     {
          $this->load->view('login/sukseskirim');
     }

     function create_captcha()
     {
          $data = array(
               'img_path' => './assets/images/captcha/',
               'img_url' => base_url('assets/images/captcha/'),
               'font_path' => base_url() . 'assets/fonts/calibri.ttf',
               'font_size' => 30,
               'word_length'   => 6,
               'img_width' => '200',
               'img_height' => '43',
               'border' => 1,
               'expiration' => 3600
          );

          $captcha = create_captcha($data);
          $image = $captcha['image'];

          $this->session->set_userdata('captchaword', $captcha['word']);

          return $image;
     }

     public function refCaptcha()
     {
          // Captcha configuration
          $data = array(
               'img_path' => './assets/images/captcha/',
               'img_url' => base_url('assets/images/captcha/'),
               'font_path' => base_url() . 'assets/fonts/calibri.ttf',
               'font_size' => 30,
               'word_length'   => 6,
               'img_width' => '200',
               'img_height' => '43',
               'border' => 1,
               'expiration' => 3600
          );
          $captcha = create_captcha($data);

          $this->session->unset_userdata('captchaword');
          $this->session->set_userdata('captchaword', $captcha['word']);

          echo $captcha['image'];
     }

     // public function rst()
     // {
     //      $this->session->unset_userdata('attemps_temp');
     //      $this->session->unset_userdata('back_time');

     //      $dtcap = array(
     //           'captcha' => $this->create_captcha(),
     //      );

     //      $this->load->view('login/login', $dtcap);
     // }

     public function auth()
     {
          $attemp_temp = $this->session->userdata('attemps_temp');
          $back_time = $this->session->userdata('back_time');
          $ip_block = $this->session->userdata('ip_block');
          $ip = $_SERVER['REMOTE_ADDR'];

          if ($ip_block === $ip) {
               $dtcap = array(
                    'captcha' => $this->create_captcha(),
               );

               $this->session->set_flashdata('pesan', '<div class="pesan alert alert-danger animate__animated animate__bounce" role="alert">IP Address : ' . $ip . ' tidak diperkenankan meng-akses apps ini sampai pukul : ' . date('d-M-Y H:i:s', strtotime($back_time)) . ' </div>');
               $this->load->view('login/login', $dtcap);
          } else {
               if ($attemp_temp == 5) {
                    $now = date('Y-m-d H:i:s');
                    if ($now >= $back_time) {
                         $this->session->unset_userdata('attemps_temp');
                         $this->session->unset_userdata('back_time');
                         $this->session->unset_userdata('ip_block');
                         $this->log_user();
                    } else {
                         $dtcap = array(
                              'captcha' => $this->create_captcha(),
                         );

                         $this->session->set_flashdata('pesan', '<div class="pesan alert alert-danger animate__animated animate__bounce" role="alert">Tidak dapat login, Silahkan login kembali pada pukul : ' . date('d-M-Y H:i:s', strtotime($back_time)) . ' </div>');
                         $this->load->view('login/login', $dtcap);
                    }
               } else {
                    $this->log_user();
               }
          }
     }

     function log_user()
     {
          $this->form_validation->set_rules('captcha', 'captcha', 'trim|required', [
               'required' => "Kode wajib diisi",
          ]);
          $this->form_validation->set_rules('temail', 'email', 'required|trim|valid_email', [
               'required' => "Email tidak boleh kosong",
               'valid_email' => 'Format email anda salah'
          ]);
          $this->form_validation->set_rules('tsandi', 'sandi', 'required|trim', [
               'required' => "Sandi tidak boleh kosong"
          ]);
          if ($this->form_validation->run() == false) {
               $dtcap = array(
                    'captcha' => $this->create_captcha(),
               );

               $this->load->view('login/login', $dtcap);
          } else {
               $email = htmlspecialchars(trim($this->input->post('temail', true)));
               $captcha_save = htmlspecialchars($this->session->userdata('captchaword'), true);
               $captcha = htmlspecialchars(trim($this->input->post('captcha', true)));
               $sandi = md5(trim($this->input->post('tsandi')));

               if ($captcha_save != "") {
                    if ($captcha_save === $captcha) {
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
                                        'id_m_perusahaan' => $data->{'id_m_perusahaan'},
                                        'id_perusahaan' => $data->{'id_perusahaan'}
                                   );

                                   $this->session->set_userdata($session_data);

                                   redirect('dash');
                              } else {
                                   $dtcap = array(
                                        'captcha' => $this->create_captcha(),
                                   );

                                   $this->session->set_flashdata('pesan', '<div class="pesan alert alert-danger animate__animated animate__bounce" role="alert"> ' . $data->{'pesan'} . '</div>');
                                   $this->load->view('login/login', $dtcap);
                              }
                         } else {
                              $dtcap = array(
                                   'captcha' => $this->create_captcha(),
                              );

                              $this->session->set_flashdata('pesan', '<div class="pesan alert alert-danger animate__animated animate__bounce" role="alert"> Email tidak ditemukan</div>');
                              $this->load->view('login/login', $dtcap);
                         }
                    } else {
                         $dtcap = array(
                              'captcha' => $this->create_captcha(),
                         );

                         $this->session->set_flashdata('pesan', '<div class="pesan alert alert-danger animate__animated animate__bounce" role="alert">Kode salah</div>');
                         $this->load->view('login/login', $dtcap);
                    }
               } else {
                    $dtcap = array(
                         'captcha' => $this->create_captcha(),
                    );

                    $this->session->set_flashdata('pesan', '<div class="pesan alert alert-danger animate__animated animate__bounce" role="alert">Refresh Kode</div>');
                    $this->load->view('login/login', $dtcap);
               }
          }
     }

     public function resetsandi()
     {
          $this->form_validation->set_rules('email', 'email', 'required|trim|valid_email', [
               'required' => "Email tidak boleh kosong",
               'valid_email' => 'Format email anda salah'
          ]);

          if ($this->form_validation->run() == false) {
               $error = [
                    'statusCode' => 201,
                    'email' => form_error('email')
               ];

               echo json_encode($error);
          } else {
               $email = htmlspecialchars(trim($this->input->post('email', true)));
               $cek = $this->lgn->reset_sandi($email);
               if ($cek != "") {
                    $data = json_decode($cek);
                    if ($data->{'statusCode'} == 200) {
                         $response = false;
                         $mail = new PHPMailer();
                         $mail->isSMTP();
                         $mail->Host     = 'smtp.office365.com';
                         $mail->SMTPAuth = true;
                         $mail->Username = 'license.system@indexim.co.id';
                         $mail->Password = 'indexim.123';
                         $mail->SMTPSecure = 'tls';
                         $mail->Port     = 587;
                         $mail->Timeout = 60;
                         $mail->SMTPKeepAlive = true;
                         $mail->setFrom('license.system@indexim.co.id', '');
                         $mail->addReplyTo('license.system@indexim.co.id', '');
                         $mail->addAddress($email);
                         $mail->Subject = 'Reset Sandi';
                         $mail->isHTML(true);
                         $mailContent = "<h3 style='margin-buttom:20px;'>Reset Sandi</h3>
                              <p style='margin-buttom:30px;'>Berikut link untuk reset sandi anda :</p>
                              <a href='#' style='padding:20px;width:50px;background-color:blue;'> Reset Sandi </a>";
                         $mail->Body =  $mailContent;
                         if (!$mail->send()) {
                              echo json_encode(array('statusCode' => 202, 'pesan' => "Email reset sandi gagal dikirim"));
                              return;
                         } else {
                              echo json_encode(array('statusCode' => 200, 'pesan' => "Sukses"));
                              return;
                         }
                    } else {
                         echo json_encode(array('statusCode' => 202, 'pesan' => $data->{'pesan'}));
                         return;
                    }
               } else {
                    echo json_encode(array('statusCode' => 202, 'pesan' => 'Email tidak ditemukan'));
                    return;
               }
          }
     }

     // function kirim_email($email)
     // {
     //      $response = false;
     //      $mail = new PHPMailer();
     //      $mail->isSMTP();
     //      $mail->Host     = 'smtp.office365.com'; //sesuaikan sesuai nama domain hosting/server yang digunakan
     //      $mail->SMTPAuth = true;
     //      $mail->Username = 'license.system@indexim.co.id'; // user email
     //      $mail->Password = 'indexim.123'; // password email
     //      $mail->SMTPSecure = 'tls';
     //      $mail->Port     = 587;
     //      $mail->Timeout = 60;
     //      $mail->SMTPKeepAlive = true;
     //      $mail->setFrom('license.system@indexim.co.id', ''); // user email
     //      $mail->addReplyTo('license.system@indexim.co.id', ''); //user email
     //      // Add a recipient
     //      $mail->addAddress($email); //email tujuan pengiriman email
     //      // Email subject
     //      $mail->Subject = 'Reset Sandi'; //subject email
     //      // Set email format to HTML
     //      $mail->isHTML(true);
     //      // Email body content
     //      $mailContent = "<h3 style='margin-buttom:20px;'>Reset Sandi</h3>
     //        <p style='margin-buttom:30px;'>Berikut link untuk reset sandi anda :</p>
     //        <a href='#' style='padding:20px;width:50px;background-color:blue;'> Reset Sandi </a>";
     //      $mail->Body =  $mailContent;
     //      // Send email
     //      if (!$mail->send()) {
     //           echo 'Message could not be sent.';
     //           echo 'Mailer Error: ' . $mail->ErrorInfo;
     //      } else {
     //           $this->load->view('login/sukseskirim');
     //      }
     // }
}
