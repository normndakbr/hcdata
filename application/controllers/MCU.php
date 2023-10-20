<?php
defined('BASEPATH') or exit('No direct script access allowed');

class MCU extends My_Controller
{
     public function __construct()
     {
          parent::__construct();
          $this->is_logout();
     }
}
