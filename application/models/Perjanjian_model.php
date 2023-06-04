<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Perjanjian_model extends CI_Model
{

     var $table = 'vw_stat_perjanjian';
     var $column_order = array(null, 'kd_stat_perjanjian', 'stat_perjanjian', 'ket_stat_perjanjian', 'stat_stat_perjanjian', 'tgl_buat', null); //set column field database for datatable orderable
     var $column_search = array('kd_stat_perjanjian', 'stat_perjanjian', 'ket_stat_perjanjian', 'stat_stat_perjanjian', 'tgl_buat',); //set column field database for datatable searchable just firstname , lastname , address are searchable
     var $order = array('kd_stat_perjanjian' => 'desc'); // default order 

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
          $this->db->where('id_stat_perjanjian', $id);
          $query = $this->db->get();

          return $query->row();
     }

     public function count_all_stat_perjanjian()
     {
          return $this->db->count_all_results('vw_stat_perjanjian');
     }

     public function count_all_user()
     {
          return $this->db->count_all_results('vw_user');
     }

     public function input_stat_perjanjian($data)
     {
          $this->db->insert('tb_stat_perjanjian', $data);
          if ($this->db->affected_rows() > 0) {
               return true;
          } else {
               return false;
          }
     }

     public function cek_kode($id_perusahaan, $kd_stat_perjanjian)
     {
          $query = $this->db->get_where('tb_stat_perjanjian', ['kd_stat_perjanjian' => $kd_stat_perjanjian, 'id_perusahaan' => $id_perusahaan]);
          if (!empty($query->result())) {
               return true;
          } else {
               return false;
          }
     }

     public function cek_stat_perjanjian($id_perusahaan, $stat_perjanjian)
     {
          $query = $this->db->get_where('tb_stat_perjanjian', ['stat_perjanjian' => $stat_perjanjian, 'id_perusahaan' => $id_perusahaan]);
          if (!empty($query->result())) {
               return true;
          } else {
               return false;
          }
     }

     public function hapus_stat_perjanjian($auth_stat_perjanjian)
     {
          $cek_id = $this->db->get_where('vw_stat_perjanjian', ['auth_stat_perjanjian' => $auth_stat_perjanjian]);
          if (!empty($cek_id->result())) {
               foreach ($cek_id->result() as $list) {
                    $id_stat_perjanjian = $list->id_stat_perjanjian;
               }

               $this->db->delete('tb_stat_perjanjian', ['id_stat_perjanjian' => $id_stat_perjanjian]);
               if ($this->db->affected_rows() > 0) {
                    return 200;
               } else {
                    return 201;
               }
          } else {
               return 202;
          }
     }

     public function get_stat_perjanjian_id($auth_stat_perjanjian)
     {
          $query = $this->db->get_where('vw_stat_perjanjian', ['auth_stat_perjanjian' => $auth_stat_perjanjian]);
          return $query->result();
     }

     public function edit_stat_perjanjian($kd_stat_perjanjian, $stat_perjanjian, $ket_stat_perjanjian, $status)
     {
          $id_perusahaan = $this->session->userdata('id_perusahaan');
          $id_stat_perjanjian = $this->session->userdata('id_stat_perjanjian');

          $query = $this->db->query("SELECT * FROM tb_stat_perjanjian WHERE kd_stat_perjanjian='" . $kd_stat_perjanjian . "' AND id_perusahaan=" . $id_perusahaan . " AND id_stat_perjanjian <> " . $id_stat_perjanjian);
          if (!empty($query->result())) {
               return 203;
          }

          $query = $this->db->query("SELECT * FROM tb_stat_perjanjian WHERE stat_perjanjian='" . $stat_perjanjian . "' AND id_perusahaan=" . $id_perusahaan . " AND id_stat_perjanjian <> " . $id_stat_perjanjian);
          if (!empty($query->result())) {
               return 204;
          }

          $this->db->set('kd_stat_perjanjian', $kd_stat_perjanjian);
          $this->db->set('stat_perjanjian', $stat_perjanjian);
          $this->db->set('ket_stat_perjanjian', $ket_stat_perjanjian);
          $this->db->set('stat_stat_perjanjian', $status);
          $this->db->set('tgl_edit', date('Y-m-d H:i:s'));
          $this->db->where('id_stat_perjanjian', $id_stat_perjanjian);
          $this->db->update('tb_stat_perjanjian');
          if ($this->db->affected_rows() > 0) {
               return 200;
          } else {
               return 201;
          }
     }

     public function get_all()
     {
          return $this->db->get('vw_stat_perjanjian')->result();
     }

     public function get_by_authper($auth_per)
     {
          $query = $this->db->get_where('vw_stat_perjanjian', ['auth_perusahaan' => $auth_per]);
          return $query->result();
     }

     public function get_by_idper($id_per)
     {
          $query = $this->db->get_where('vw_stat_perjanjian', ['id_perusahaan' => $id_per]);
          return $query->result();
     }

     public function get_stat_Waktu($stat_kary)
     {
          $query = $this->db->get_where('vw_stat_perjanjian', ['id_stat_perjanjian' => $stat_kary]);
          if (!empty($query->result())) {
               foreach ($query->result() as $list) {
                    $stat_waktu = $list->stat_waktu;
               }

               return $stat_waktu;
          } else {
               return 0;
          }
     }
}
