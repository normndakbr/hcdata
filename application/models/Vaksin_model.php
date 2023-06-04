<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Vaksin_model extends CI_Model
{

     var $table = 'vw_vaksin';
     var $column_order = array(null, 'kd_vaksin', 'vaksin', 'ket_vaksin', 'stat_vaksin', 'tgl_buat', null); //set column field database for datatable orderable
     var $column_search = array('kd_vaksin', 'vaksin', 'ket_vaksin', 'stat_vaksin', 'tgl_buat',); //set column field database for datatable searchable just firstname , lastname , address are searchable
     var $order = array('kd_vaksin' => 'desc'); // default order 

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
          $this->db->where('id_vaksin', $id);
          $query = $this->db->get();

          return $query->row();
     }

     public function count_all_vaksin()
     {
          return $this->db->count_all_results('vw_vaksin');
     }

     public function count_all_user()
     {
          return $this->db->count_all_results('vw_user');
     }

     public function input_vaksin($data)
     {
          $this->db->insert('tb_vaksin', $data);
          if ($this->db->affected_rows() > 0) {
               return true;
          } else {
               return false;
          }
     }

     public function cek_kode($id_perusahaan, $kd_vaksin)
     {
          $query = $this->db->get_where('tb_vaksin', ['kd_vaksin' => $kd_vaksin, 'id_perusahaan' => $id_perusahaan]);
          if (!empty($query->result())) {
               return true;
          } else {
               return false;
          }
     }

     public function cek_vaksin($id_perusahaan, $vaksin)
     {
          $query = $this->db->get_where('tb_vaksin', ['vaksin' => $vaksin, 'id_perusahaan' => $id_perusahaan]);
          if (!empty($query->result())) {
               return true;
          } else {
               return false;
          }
     }

     public function hapus_vaksin($auth_vaksin)
     {
          $cek_id = $this->db->get_where('vw_vaksin', ['auth_vaksin' => $auth_vaksin]);
          if (!empty($cek_id->result())) {
               foreach ($cek_id->result() as $list) {
                    $id_vaksin = $list->id_vaksin;
               }

               $this->db->delete('tb_vaksin', ['id_vaksin' => $id_vaksin]);
               if ($this->db->affected_rows() > 0) {
                    return 200;
               } else {
                    return 201;
               }
          } else {
               return 202;
          }
     }

     public function get_vaksin_id($auth_vaksin)
     {
          $query = $this->db->get_where('vw_vaksin', ['auth_vaksin' => $auth_vaksin]);
          return $query->result();
     }

     public function edit_vaksin($kd_vaksin, $vaksin, $ket_vaksin, $status)
     {
          $id_perusahaan = $this->session->userdata('id_perusahaan');
          $id_vaksin = $this->session->userdata('id_vaksin');

          $query = $this->db->query("SELECT * FROM tb_vaksin WHERE kd_vaksin='" . $kd_vaksin . "' AND id_perusahaan=" . $id_perusahaan . " AND id_vaksin <> " . $id_vaksin);
          if (!empty($query->result())) {
               return 203;
          }

          $query = $this->db->query("SELECT * FROM tb_vaksin WHERE vaksin='" . $vaksin . "' AND id_perusahaan=" . $id_perusahaan . " AND id_vaksin <> " . $id_vaksin);
          if (!empty($query->result())) {
               return 204;
          }

          $this->db->set('kd_vaksin', $kd_vaksin);
          $this->db->set('vaksin', $vaksin);
          $this->db->set('ket_vaksin', $ket_vaksin);
          $this->db->set('stat_vaksin', $status);
          $this->db->set('tgl_edit', date('Y-m-d H:i:s'));
          $this->db->where('id_vaksin', $id_vaksin);
          $this->db->update('tb_vaksin');
          if ($this->db->affected_rows() > 0) {
               return 200;
          } else {
               return 201;
          }
     }


     public function input_vaksin_kary($data)
     {
          $this->db->insert('tb_vaksin_kary', $data);
          if ($this->db->affected_rows() > 0) {
               return true;
          } else {
               return false;
          }
     }

     public function tabel_vaksin()
     {
          if ($this->session->has_userdata('idpersonal')) {
               $id_personal = $this->session->userdata('idpersonal');
               if (!empty($id_personal)) {
                    $query = $this->db->get_where('vw_vaksin_kary', ['id_personal' => $id_personal]);
                    return $query->result();
               } else {
                    return 0;
               }
          } else {
               return 0;
          }
     }

     public function get_vaksin_jenis_all()
     {
          return $this->db->get('tb_vaksin_jenis')->result();
     }

     public function get_vaksin_nama_all()
     {
          return $this->db->get('tb_vaksin_nama')->result();
     }
}
