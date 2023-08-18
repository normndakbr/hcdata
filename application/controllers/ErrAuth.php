<?php
defined('BASEPATH') or exit('No direct script access allowed');

class ErrAuth extends My_Controller
{

     public function index()
     {
          $this->load->view('errors/errauth');
     }
}
