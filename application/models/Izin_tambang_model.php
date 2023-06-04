<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Izin_tambang_model extends CI_Model
{

     public function input_izin_tambang($data)
     {
          $this->db->insert('tb_izin_tambang', $data);
          if ($this->db->affected_rows() > 0) {
               return true;
          } else {
               return false;
          }
     }

     public function cek_izin_tambang($izin_tambang)
     {
          $query = $this->db->get_where('tb_izin_tambang', ['izin_tambang' => $izin_tambang]);
          if (!empty($query->result())) {
               return true;
          } else {
               return false;
          }
     }


     public function input_unit($data)
     {
          $this->db->insert('tb_izin_tambang_unit', $data);
          if ($this->db->affected_rows() > 0) {
               return true;
          } else {
               return false;
          }
     }

     function update_izin($where, $data, $table)
     {
          $this->db->where($where);
          $this->db->update($table, $data);
     }

     public function hapus_izin_tambang($auth_izin_tambang)
     {
          $cek_id = $this->db->get_where('vw_izin_tambang', ['auth_izin_tambang' => $auth_izin_tambang]);
          if (!empty($cek_id->result())) {
               foreach ($cek_id->result() as $list) {
                    $id_izin_tambang = $list->id_izin_tambang;
               }

               $this->db->delete('tb_izin_tambang', ['id_izin_tambang' => $id_izin_tambang]);
               if ($this->db->affected_rows() > 0) {
                    return 200;
               } else {
                    return 201;
               }
          } else {
               return 202;
          }
     }

     public function get_izin_tambang_id($auth_izin_tambang)
     {
          $query = $this->db->get_where('vw_izin_tambang', ['auth_izin_tambang' => $auth_izin_tambang]);
          return $query->result();
     }

     public function edit_izin_tambang($izin_tambang, $ket_izin_tambang, $status)
     {
          $id_izin_tambang = $this->session->userdata('id_izin_tambang');

          $query = $this->db->query("SELECT * FROM tb_izin_tambang WHERE izin_tambang='" . $izin_tambang . "' AND id_izin_tambang <> " . $id_izin_tambang);
          if (!empty($query->result())) {
               return 204;
          }

          $this->db->set('izin_tambang', $izin_tambang);
          $this->db->set('ket_izin_tambang', $ket_izin_tambang);
          $this->db->set('stat_izin_tambang', $status);
          $this->db->set('tgl_edit', date('Y-m-d H:i:s'));
          $this->db->where('id_izin_tambang', $id_izin_tambang);
          $this->db->update('tb_izin_tambang');
          if ($this->db->affected_rows() > 0) {
               return 200;
          } else {
               return 201;
          }
     }

     public function get_all_unit()
     {
          return $this->db->get('tb_unit')->result();
     }

     public function get_all_akses()
     {
          return $this->db->get('tb_tipe_akses_unit')->result();
     }

     public function get_unit($id_unit)
     {
          $query = $this->db->get_where('tb_unit', ['id_unit' => $id_unit]);
          if (!empty($query->result())) {
               foreach ($query->result() as $list) {
                    $unit = $list->unit;
               }

               return $unit;
          } else {
               return 0;
          }
     }

     public function get_akses($id_akses)
     {
          $query = $this->db->get_where('tb_tipe_akses_unit', ['id_tipe_akses_unit' => $id_akses]);
          if (!empty($query->result())) {
               foreach ($query->result() as $list) {
                    $akses = $list->tipe_akses_unit;
               }

               return $akses;
          } else {
               return 0;
          }
     }

     public function get_by_authper($auth_per)
     {
          $query = $this->db->get_where('vw_izin_tambang', ['auth_perusahaan' => $auth_per]);
          return $query->result();
     }

     public function get_by_idper($id_per)
     {
          $query = $this->db->get_where('vw_izin_tambang', ['id_perusahaan' => $id_per]);
          return $query->result();
     }
}
