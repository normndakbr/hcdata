<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Audit_model extends CI_Model
{

     public function __construct()
     {
          parent::__construct();
          $this->load->database();
     }

     public function input_audit($data)
     {
          $this->db->insert('tb_audit', $data);
          if ($this->db->affected_rows() > 0) {
               return true;
          } else {
               return false;
          }
     }
}
