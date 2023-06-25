<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Tipe_model extends CI_Model
{

     var $table = 'vw_tipe';
     var $column_order = array(null, 'tipe', 'ket_tipe', 'stat_tipe', 'tgl_buat', null); //set column field database for datatable orderable
     var $column_search = array('tipe', 'ket_tipe', 'stat_tipe', 'tgl_buat',); //set column field database for datatable searchable just firstname , lastname , address are searchable
     var $order = array('tipe' => 'desc'); // default order 

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
          $this->db->where('id_tipe', $id);
          $query = $this->db->get();

          return $query->row();
     }

     public function count_all_tipe()
     {
          return $this->db->count_all_results('vw_tipe');
     }

     public function count_all_user()
     {
          return $this->db->count_all_results('vw_user');
     }

     public function input_tipe($data)
     {
          $this->db->insert('tb_tipe', $data);
          if ($this->db->affected_rows() > 0) {
               return true;
          } else {
               return false;
          }
     }

     public function cek_tipe($tipe)
     {
          $query = $this->db->get_where('tb_tipe', ['tipe' => $tipe]);
          if (!empty($query->result())) {
               return true;
          } else {
               return false;
          }
     }

     public function hapus_tipe($auth_tipe)
     {
          $cek_id = $this->db->get_where('vw_tipe', ['auth_tipe' => $auth_tipe]);
          if (!empty($cek_id->result())) {
               foreach ($cek_id->result() as $list) {
                    $id_tipe = $list->id_tipe;
               }

               $this->db->delete('tb_tipe', ['id_tipe' => $id_tipe]);
               if ($this->db->affected_rows() > 0) {
                    return 200;
               } else {
                    return 201;
               }
          } else {
               return 202;
          }
     }

     public function get_tipe_id($auth_tipe)
     {
          $query = $this->db->get_where('vw_tipe', ['auth_tipe' => $auth_tipe]);
          return $query->result();
     }

     public function edit_tipe($tipe, $ket_tipe, $status)
     {
          $id_tipe = $this->session->userdata('id_tipe');

          $query = $this->db->query("SELECT * FROM tb_tipe WHERE tipe='" . $tipe . "' AND id_tipe <> " . $id_tipe);
          if (!empty($query->result())) {
               return 204;
          }

          $this->db->set('tipe', $tipe);
          $this->db->set('ket_tipe', $ket_tipe);
          $this->db->set('stat_tipe', $status);
          $this->db->set('tgl_edit', date('Y-m-d H:i:s'));
          $this->db->where('id_tipe', $id_tipe);
          $this->db->update('tb_tipe');
          if ($this->db->affected_rows() > 0) {
               return 200;
          } else {
               return 201;
          }
     }

     public function get_all()
     {
          return $this->db->get('vw_tipe')->result();
     }

     public function get_by_authper()
     {
          $query = $this->db->get('vw_tipe');
          return $query->result();
     }

     public function get_by_idper()
     {
          $query = $this->db->get('vw_tipe');
          return $query->result();
     }

     public function get_id_tipe($auth_tipe)
     {
          $query = $this->db->get_where('vw_tipe', ['auth_tipe' => $auth_tipe]);
          if (!empty($query->result())) {
               foreach ($query->result() as $list) {
                    $id_tipe = $list->id_tipe;
               }

               return $id_tipe;
          } else {
               return 0;
          }
     }
}
