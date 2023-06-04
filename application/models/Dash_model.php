<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Dash_model extends CI_Model
{

     public function count_all_user()
     {
          return $this->db->count_all_results('vw_user');
     }

     public function count_all_karyawan()
     {
          return $this->db->count_all_results('vw_karyawan');
     }

     public function data_grafik_1()
     {
          return $this->db->get('vw_grafik1_1')->result();
     }

     public function data_grafik_2()
     {
          return $this->db->get('vw_grafik1_2')->result();
     }

     public function data_grafik_3()
     {
          return $this->db->get('vw_grafik1_3')->result();
     }

     public function get_data_grafik()
     {

          $sql = "SELECT DISTINCT kode_perusahaan FROM vw_m_perusahaan WHERE stat_m_perusahaan = 'T' ORDER BY kode_perusahaan ASC";
          $query = $this->db->query($sql)->result();

          if (!empty($query)) {
               foreach ($query as $prs) {
                    $kode_perusahaan = $prs->kode_perusahaan;
                    $sql = "SELECT COUNT(tahun_doh) as bulan_now, id_perusahaan FROM vw_jml_karyawan WHERE kode_perusahaan = '" . $kode_perusahaan . "'";
                    $query1 = $this->db->query($sql)->result();
                    foreach ($query1 as $list) {
                         $jml = $list->bulan_now;
                         $data[] = array("x" => $kode_perusahaan, "y" => $jml);
                    }
               }

               return json_encode($data);
          }
     }
}
