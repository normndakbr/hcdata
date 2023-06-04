<?php if (!defined('BASEPATH')) exit('No direct script access allowed');


class Rekursif_Menu extends CI_Controller
{

     function __construct()
     {
          parent::__construct();
          $this->load->database();
     }

     public function calldata()
     {
          return $this->menu(0, $h = "");
     }

     private function menu($parent = 0, $hasil)
     {
          $w = $this->db->query("SELECT * from vw_m_perusahaan where id_parent='" . $parent . "'");
          static $space;
          $test = "";
          foreach ($w->result() as $h) {
               if (($w->num_rows()) > 0) {
                    $space .= "&rAarr;";
               }

               $hasil .= "{" . $space . $h->nama_perusahaan . ", " . $h->jenis_perusahaan . "},";
               $hasil = $this->menu($h->id_m_perusahaan, $hasil);
               $space = substr($space, 0, strlen($space) - 7);
          }

          return $hasil;
     }

     public function getdata()
     {

          // if (!empty($query)) {
          echo json_encode(array("draw" => 1, "recordsTotal" => 5, "recordsFiltered" => 5, "data" => $this->calldata()));
          // } else {
          //      echo json_encode(array("draw" => 0, "recordsTotal" => 5, "recordsFiltered" => 5, "data" => ''));
          // }
     }
}
