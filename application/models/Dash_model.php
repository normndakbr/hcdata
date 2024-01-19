<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Dash_model extends CI_Model
{
     public function get_menu()
     {
          $idmenu = $this->session->userdata('id_menu_hcdata');
          return $this->db->get_where('vw_modul_role_menu', ['id_menu' => $idmenu])->result();
     }

     public function count_all_user()
     {
          return $this->db->count_all_results('vw_user');
     }

     public function count_all_perusahaan()
     {
          $sql = "SELECT kode_perusahaan, id_parent, id_m_perusahaan FROM vw_m_prs WHERE stat_m_perusahaan = 'T' AND (id_parent = 0 OR id_parent = 1) ORDER BY id_m_perusahaan ASC";
          $query = $this->db->query($sql);
          return $query->num_rows();
     }

     public function count_all_karyawan()
     {
          return $this->db->get_where('vw_karyawan', ['tgl_nonaktif' => null])->num_rows();
     }

     public function new_emp()
     {

          $tglnowstart = date('Y-m-d 00:00:00');
          $tglnowend = date('Y-m-d 23:59:59');

          return $this->db->query("SELECT auth_karyawan FROM vw_karyawan WHERE tgl_nonaktif is null AND (tgl_buat >= '" . $tglnowstart . "' AND tgl_buat <= '" . $tglnowend . "') order by tgl_buat asc")->num_rows();
     }

     public function get_data_sum($tgl_aktif)
     {

          $sql = "SELECT kode_perusahaan, id_parent, id_m_perusahaan, nama_perusahaan FROM vw_m_prs WHERE stat_m_perusahaan = 'T' AND  id_parent = 0 OR id_parent =1 ORDER BY id_m_perusahaan ASC";
          $query = $this->db->query($sql)->result();

          if (!empty($query)) {
               foreach ($query as $prs) {
                    $id_parent = $prs->id_parent;
                    $id_m_perusahaan = $prs->id_m_perusahaan;
                    $kode_perusahaan = $prs->kode_perusahaan;
                    $nama_perusahaan = $prs->nama_perusahaan;

                    if ($id_parent == 0) {
                         $sql = "SELECT COUNT(tahun_doh) as bulan_now, id_perusahaan FROM vw_jml_karyawan WHERE id_parent = 0 AND doh <= '" . $tgl_aktif . "' AND tgl_nonaktif is null";
                         $sqlr = "SELECT COUNT(id_kary) as jml_r FROM vw_karyawan WHERE id_parent = 0 AND id_stat_tinggal=1 AND doh <= '" . $tgl_aktif . "' AND tgl_nonaktif is null";
                         $sqlnr = "SELECT COUNT(id_kary) as jml_nr FROM vw_karyawan WHERE id_parent = 0 AND id_stat_tinggal=2 AND doh <= '" . $tgl_aktif . "' AND tgl_nonaktif is null";
                         $sqllkl = "SELECT COUNT(id_kary) as jml_l FROM vw_karyawan WHERE id_parent = 0 AND jenis_lokasi='LOKAL' AND doh <= '" . $tgl_aktif . "' AND tgl_nonaktif is null";
                         $sqlnlkl = "SELECT COUNT(id_kary) as jml_nl FROM vw_karyawan WHERE id_parent = 0 AND jenis_lokasi='NONLOKAL' AND doh <= '" . $tgl_aktif . "' AND tgl_nonaktif is null";
                    } else {
                         $sql = "SELECT COUNT(tahun_doh) as bulan_now, id_perusahaan FROM vw_jml_karyawan WHERE (id_m_perusahaan = " . $id_m_perusahaan . " OR id_parent = " . $id_m_perusahaan . ") AND doh <='" . $tgl_aktif . "' AND tgl_nonaktif is null";
                         $sqlr = "SELECT COUNT(id_kary) as jml_r FROM vw_karyawan WHERE (id_m_perusahaan = " . $id_m_perusahaan . " OR id_parent = " . $id_m_perusahaan . ") AND id_stat_tinggal=1 AND doh <= '" . $tgl_aktif . "' AND tgl_nonaktif is null";
                         $sqlnr = "SELECT COUNT(id_kary) as jml_nr FROM vw_karyawan WHERE (id_m_perusahaan = " . $id_m_perusahaan . " OR id_parent = " . $id_m_perusahaan . ") AND id_stat_tinggal=2 AND doh <= '" . $tgl_aktif . "' AND tgl_nonaktif is null";
                         $sqllkl = "SELECT COUNT(id_kary) as jml_l FROM vw_karyawan WHERE (id_m_perusahaan = " . $id_m_perusahaan . " OR id_parent = " . $id_m_perusahaan . ") AND jenis_lokasi='LOKAL' AND doh <= '" . $tgl_aktif . "' AND tgl_nonaktif is null";
                         $sqlnlkl = "SELECT COUNT(id_kary) as jml_nl FROM vw_karyawan WHERE (id_m_perusahaan = " . $id_m_perusahaan . " OR id_parent = " . $id_m_perusahaan . ") AND jenis_lokasi='NONLOKAL' AND doh <= '" . $tgl_aktif . "' AND tgl_nonaktif is null";
                    }

                    $query1 = $this->db->query($sql)->result();
                    foreach ($query1 as $list) {
                         $rsd = $this->db->query($sqlr)->row();
                         $nonrsd = $this->db->query($sqlnr)->row();
                         $lkl = $this->db->query($sqllkl)->row();
                         $nonlkl = $this->db->query($sqlnlkl)->row();
                         $jml = $list->bulan_now;
                         $data[] = array(
                              "nama_per" => $nama_perusahaan,
                              "kode_per" => $kode_perusahaan,
                              "jml" => $jml,
                              'r' => $rsd->jml_r,
                              'nr' => $nonrsd->jml_nr,
                              'lkl' => $lkl->jml_l,
                              'nlkl' => $nonlkl->jml_nl,
                         );
                    }
               }

               $sqljml = "SELECT COUNT(id_kary) as jmlkary FROM vw_jml_karyawan WHERE stat_m_perusahaan = 'T' AND doh <='" . $tgl_aktif . "' AND tgl_nonaktif = null";
               $qjml = $this->db->query($sqljml)->row();

               $dtakary['data'] = $data;
               $dtakary['jmlall'] = $qjml->jmlkary;
               return $dtakary;
          }
     }

     public function get_langgar_aktif()
     {
          $now = date('Y-m-d');
          return $this->db->get_where('vw_langgar', ['tgl_akhir_langgar >' => $now])->num_rows();
     }

     public function data_langgar_aktif($prs)
     {
          if ($prs == 0) {
               $now = date('Y-m-d');
               $this->db->where('tgl_akhir_langgar >', $now);
               $this->db->from('vw_langgar');
               $this->db->order_by('tgl_punishment', 'DESC');
               $query = $this->db->get()->result();

               return $query;
          } else {
               $now = date('Y-m-d');
               $this->db->where('tgl_akhir_langgar >', $now);
               $this->db->where('auth_m_per', $prs);
               $this->db->from('vw_langgar');
               $this->db->order_by('tgl_punishment', 'DESC');
               $query = $this->db->get()->result();

               return $query;
          }
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

          $sql = "SELECT kode_perusahaan, id_parent, id_m_perusahaan FROM vw_m_prs WHERE stat_m_perusahaan = 'T' AND (id_parent = 0 OR id_parent =1) ORDER BY id_m_perusahaan ASC";
          $query = $this->db->query($sql)->result();

          if (!empty($query)) {
               foreach ($query as $prs) {
                    $id_parent = $prs->id_parent;
                    $id_m_perusahaan = $prs->id_m_perusahaan;
                    $kode_perusahaan = $prs->kode_perusahaan;

                    if ($id_parent == 0) {
                         $sql = "SELECT COUNT(tahun_doh) as bulan_now, id_perusahaan FROM vw_jml_karyawan WHERE id_parent = 0 AND tgl_nonaktif is null";
                    } else {
                         $sql = "SELECT COUNT(tahun_doh) as bulan_now, id_perusahaan FROM vw_jml_karyawan WHERE (id_m_perusahaan = " . $id_m_perusahaan . " OR id_parent = " . $id_m_perusahaan . ") AND tgl_nonaktif is null";
                    }

                    $query1 = $this->db->query($sql)->result();
                    foreach ($query1 as $list) {
                         $jml = $list->bulan_now;
                         $data[] = array("x" => $kode_perusahaan, "y" => $jml);
                    }
               }

               return json_encode($data);
          }
     }

     public function get_gender_grafik()
     {
          $sql = "SELECT DISTINCT jk FROM tb_personal";
          $query = $this->db->query($sql)->result();

          if (!empty($query)) {
               foreach ($query as $prs) {
                    $jk = $prs->jk;
                    if ($jk == "LK") {
                         $jkk = "LAKI-LAKI";
                    } else {
                         $jkk = "PEREMPUAN";
                    }
                    $sql = "SELECT COUNT(jk) as jenis_kelamin FROM vw_karyawan WHERE jk='" . $jk .
                         "' AND tgl_nonaktif is null";
                    $query1 = $this->db->query($sql)->result();
                    foreach ($query1 as $list) {
                         $jml = $list->jenis_kelamin;
                         $data[] = array("x" => $jkk, "y" => $jml);
                    }
               }

               return json_encode($data);
          }
     }

     public function get_lokasi_grafik()
     {
          $sql = "SELECT DISTINCT jenis_lokasi FROM tb_lokterima";
          $query = $this->db->query($sql)->result();

          if (!empty($query)) {
               foreach ($query as $prs) {
                    $jlok = $prs->jenis_lokasi;
                    $sql = "SELECT COUNT(jenis_lokasi) as jml_jlok FROM vw_karyawan WHERE jenis_lokasi='" . $jlok .
                         "' AND tgl_nonaktif is null";
                    $query1 = $this->db->query($sql)->result();
                    foreach ($query1 as $list) {
                         $jml = $list->jml_jlok;
                         $data[] = array("x" => $jlok, "y" => $jml);
                    }
               }

               return json_encode($data);
          }
     }

     public function get_klasifikasi_grafik()
     {
          $sql = "SELECT DISTINCT klasifikasi FROM tb_klasifikasi";
          $query = $this->db->query($sql)->result();

          if (!empty($query)) {
               foreach ($query as $prs) {
                    $kls = $prs->klasifikasi;
                    $sql = "SELECT COUNT(klasifikasi) as jml_kls FROM vw_karyawan WHERE klasifikasi='" . $kls .
                         "' AND  tgl_nonaktif is null";
                    $query1 = $this->db->query($sql)->result();
                    foreach ($query1 as $list) {
                         $jml = $list->jml_kls;
                         $data[] = array("x" => $kls, "y" => $jml);
                    }
               }

               return json_encode($data);
          }
     }

     public function get_pendidikan_grafik()
     {
          $sql = "SELECT DISTINCT id_pendidikan, pendidikan FROM tb_pendidikan";
          $query = $this->db->query($sql)->result();

          if (!empty($query)) {
               foreach ($query as $prs) {
                    $id_pendidikan = $prs->id_pendidikan;
                    $didik = $prs->pendidikan;
                    $sql = "SELECT COUNT(id_pendidikan) as jml_didik FROM vw_karyawan WHERE id_pendidikan=" . $id_pendidikan .
                         " AND tgl_nonaktif is null";
                    $query1 = $this->db->query($sql)->result();
                    foreach ($query1 as $list) {
                         $jml = $list->jml_didik;
                         $data[] = array("x" => $didik, "y" => $jml);
                    }
               }

               return json_encode($data);
          }
     }

     public function get_residence_grafik()
     {
          $sql = "SELECT DISTINCT stat_tinggal FROM tb_stat_tinggal";
          $query = $this->db->query($sql)->result();

          if (!empty($query)) {
               foreach ($query as $prs) {
                    $sttgl = $prs->stat_tinggal;
                    $sql = "SELECT COUNT(stat_tinggal) as jml_sttinggal FROM vw_karyawan WHERE stat_tinggal='" . $sttgl .
                         "' AND tgl_nonaktif is null";
                    $query1 = $this->db->query($sql)->result();
                    foreach ($query1 as $list) {
                         $jml = $list->jml_sttinggal;
                         $data[] = array("x" => $sttgl, "y" => $jml);
                    }
               }

               return json_encode($data);
          }
     }

     public function get_sertifikasi_grafik()
     {
          $sql = "SELECT DISTINCT kode_jenis_sertifikasi FROM tb_jenis_sertifikasi WHERE beranda = 'T' order by id_jenis_sertifikasi asc";
          $query = $this->db->query($sql)->result();

          if (!empty($query)) {
               foreach ($query as $prs) {
                    $jsrt = $prs->kode_jenis_sertifikasi;
                    $sql = "SELECT COUNT(kode_jenis_sertifikasi) as jmlsrt FROM vw_karyawan_sertifikasi WHERE kode_jenis_sertifikasi='" . $jsrt . "'";
                    $query1 = $this->db->query($sql)->result();
                    foreach ($query1 as $list) {
                         $jml = $list->jmlsrt;
                         $data[] = array("x" => $jsrt, "y" => $jml);
                    }
               }

               return json_encode($data);
          }
     }
}
