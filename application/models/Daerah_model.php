<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Daerah_model extends CI_Model
{


     public function get_prov()
     {
          $db2 = $this->load->database('db_daerah', TRUE);
          $query = $db2->get('provinces');
          return $query->result();
     }

     public function get_kab($id_prov)
     {
          $db2 = $this->load->database('db_daerah', TRUE);
          $query = $db2->get_where('regencies', ['province_id' => $id_prov]);
          return $query->result();
     }

     public function get_all_kab()
     {
          $db2 = $this->load->database('db_daerah', TRUE);
          $query = $db2->get_where('regencies');
          return $query->result();
     }

     public function get_kec($id_kab)
     {
          $db2 = $this->load->database('db_daerah', TRUE);
          $query = $db2->get_where('districts', ['regency_id' => $id_kab]);
          return $query->result();
     }

     public function get_kel($id_kec)
     {
          $db2 = $this->load->database('db_daerah', TRUE);
          $query = $db2->get_where('villages', ['district_id' => $id_kec]);
          return $query->result();
     }

     public function get_kel_by_id($id_kel)
     {
          $db2 = $this->load->database('db_daerah', TRUE);
          $query = $db2->get_where('villages', ['id' => $id_kel]);
          if (!empty($query->result())) {
               foreach ($query->result() as $list) {
                    $name = $list->name;
               }

               return $name;
          } else {
               $name = '';
               return $name;
          }
     }

     public function get_kec_by_id($id_kec)
     {
          $db2 = $this->load->database('db_daerah', TRUE);
          $query = $db2->get_where('districts', ['id' => $id_kec]);
          if (!empty($query->result())) {
               foreach ($query->result() as $list) {
                    $name = $list->name;
               }

               return $name;
          } else {
               $name = '';
               return $name;
          }
     }

     public function get_kab_by_id($id_kab)
     {
          $db2 = $this->load->database('db_daerah', TRUE);
          $query = $db2->get_where('regencies', ['id' => $id_kab]);
          if (!empty($query->result())) {
               foreach ($query->result() as $list) {
                    $name = $list->name;
               }

               return $name;
          } else {
               $name = '';
               return $name;
          }
     }

     public function get_prov_by_id($id_prov)
     {
          $db2 = $this->load->database('db_daerah', TRUE);
          $query = $db2->get_where('provinces', ['id' => $id_prov]);
          if (!empty($query->result())) {
               foreach ($query->result() as $list) {
                    $name = $list->name;
               }

               return $name;
          } else {
               $name = '';
               return $name;
          }
     }
}
