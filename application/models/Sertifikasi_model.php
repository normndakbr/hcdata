<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Sertifikasi_model extends CI_Model
{

     var $table = 'vw_sertifikasi';
     var $column_order = array(null,  'sertifikasi', 'ket_sertifikasi', 'stat_sertifikasi', 'tgl_buat', null); //set column field database for datatable orderable
     var $column_search = array('sertifikasi', 'ket_sertifikasi', 'stat_sertifikasi', 'tgl_buat',); //set column field database for datatable searchable just firstname , lastname , address are searchable
     var $order = array('sertifikasi' => 'desc'); // default order 

     public function __construct()
     {
          parent::__construct();
          $this->load->database();
     }

     private function _get_datatables_query()
     {

          $this->db->from($this->table);

          $i = 0;

          foreach ($this->column_search as $item) // loop column 
          {
               if ($_POST['search']['value']) // if datatable send POST for search
               {

                    if ($i === 0) // first loop
                    {
                         $this->db->group_start(); // open bracket. query Where with OR clause better with bracket. because maybe can combine with other WHERE with AND.
                         $this->db->like($item, $_POST['search']['value']);
                    } else {
                         $this->db->or_like($item, $_POST['search']['value']);
                    }

                    if (count($this->column_search) - 1 == $i) //last loop
                         $this->db->group_end(); //close bracket
               }
               $i++;
          }

          if (isset($_POST['order'])) // here order processing
          {
               $this->db->order_by($this->column_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
          } else if (isset($this->order)) {
               $order = $this->order;
               $this->db->order_by(key($order), $order[key($order)]);
          }
     }

     function get_datatables()
     {
          $this->_get_datatables_query();
          if ($_POST['length'] != -1)
               $this->db->limit($_POST['length'], $_POST['start']);
          $query = $this->db->get();
          return $query->result();
     }

     function count_filtered()
     {
          $this->_get_datatables_query();
          $query = $this->db->get();
          return $query->num_rows();
     }

     public function count_all()
     {
          $this->db->from($this->table);
          return $this->db->count_all_results();
     }

     public function get_by_id($id)
     {
          $this->db->from($this->table);
          $this->db->where('id_sertifikasi', $id);
          $query = $this->db->get();

          return $query->row();
     }

     public function count_all_sertifikasi()
     {
          return $this->db->count_all_results('vw_sertifikasi');
     }

     public function count_all_user()
     {
          return $this->db->count_all_results('vw_user');
     }

     public function input_sertifikasi($data)
     {
          $this->db->insert('tb_sertifikasi_kary', $data);
          if ($this->db->affected_rows() > 0) {
               return true;
          } else {
               return false;
          }
     }

     public function tabel_sertifikasi($id_personal)
     {
          if ($id_personal !== "") {
               $query = $this->db->get_where('vw_sertifikasi', ['id_personal' => $id_personal]);
               return $query->result();
          } else {
               return 0;
          }
     }

     public function cek_sertifikasi($sertifikasi)
     {
          $query = $this->db->get_where('tb_sertifikasi', ['sertifikasi' => $sertifikasi]);
          if (!empty($query->result())) {
               return true;
          } else {
               return false;
          }
     }

     public function hps_sert($auth_sertifikasi)
     {

          $cek_id = $this->db->get_where('vw_sertifikasi', ['auth_sertifikat' => $auth_sertifikasi])->result();
          if (!empty($cek_id)) {
               foreach ($cek_id as $list) {
                    $id_sertifikasi = $list->id_sertifikasi;
               }

               $this->db->delete('tb_sertifikasi_kary', ['id_sertifikasi' => $id_sertifikasi]);
               if ($this->db->affected_rows() > 0) {
                    return 200;
               } else {
                    return 201;
               }
          } else {
               return 202;
          }
     }

     public function get_jenis_sertifikasi()
     {
          return $this->db->get('tb_jenis_sertifikasi')->result();
     }

     public function get_sertifikasi_id($auth_sertifikasi)
     {
          $query = $this->db->get_where('vw_sertifikasi', ['auth_sertifikat' => $auth_sertifikasi]);
          return $query->result();
     }

     public function edit_sertifikasi($sertifikasi, $ket_sertifikasi, $status)
     {
          $id_sertifikasi = $this->session->userdata('id_sertifikasi');

          $query = $this->db->query("SELECT * FROM tb_sertifikasi WHERE sertifikasi='" . $sertifikasi . "' AND id_sertifikasi <> " . $id_sertifikasi);
          if (!empty($query->result())) {
               return 204;
          }

          $this->db->set('sertifikasi', $sertifikasi);
          $this->db->set('ket_sertifikasi', $ket_sertifikasi);
          $this->db->set('stat_sertifikasi', $status);
          $this->db->set('tgl_edit', date('Y-m-d H:i:s'));
          $this->db->where('id_sertifikasi', $id_sertifikasi);
          $this->db->update('tb_sertifikasi');
          if ($this->db->affected_rows() > 0) {
               return 200;
          } else {
               return 201;
          }
     }

     public function update_sertifikasi($id_ser, $dtser)
     {
          $this->db->where('id_sertifikasi', $id_ser);
          $this->db->update('tb_sertifikasi_kary', $dtser);
     }

     public function get_all()
     {
          return $this->db->get('vw_sertifikasi')->result();
     }

     public function get_by_authper($auth_per)
     {
          $query = $this->db->get_where('vw_sertifikasi', ['auth_perusahaan' => $auth_per]);
          return $query->result();
     }

     public function get_by_idper($id_per)
     {
          $query = $this->db->get_where('vw_sertifikasi', ['id_perusahaan' => $id_per]);
          return $query->result();
     }

     public function get_by_idser($auth_ser)
     {
          $query = $this->db->get_where('vw_sertifikasi', ['auth_sertifikat' => $auth_ser])->result();
          if (!empty($query)) {
               foreach ($query as $list) {
                    $id_ser = $list->id_sertifikasi;
               }

               return  $id_ser;
          } else {
               return;
          }
     }
}
