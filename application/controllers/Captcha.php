<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Captcha extends My_Controller
{
     function index()
     {
          $this->form_validation->set_rules('captcha', 'Captcha', 'trim|callback_check_captcha|required');

          if ($this->form_validation->run() == false) {

               $data = array(
                    'captcha' => $this->create_captcha(),
               );

               $this->load->view('captcha', $data);
          } else {

               echo "Captcha telah sesuai";
          }
     }

     function create_captcha()
     {
          $data = array(
               'img_path' => './captcha',
               'img_url' => base_url('captcha'),
               'img_width' => '250',
               'img_height' => '40',
               'expiration' => 7200
          );

          $captcha = create_captcha($data);
          $image = $captcha['image'];

          $this->session->set_userdata('captchaword', $captcha['word']);

          return $image;
     }

     function check_captcha()
     {
          if ($this->input->post('captcha') == $this->session->userdata('captchaword')) {
               return true;
          } else {
               $this->form_validation->set_message('check_captcha', 'Captcha tidak sama');
               return false;
          }
     }
}
