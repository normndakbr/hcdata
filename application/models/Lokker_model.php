<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Lokker_model extends CI_Model
{

     var $table = 'vw_lokker';
     var $column_order = array(null, 'kd_lokker', 'lokker', 'ket_lokker', 'stat_lokker', 'tgl_buat', null); //set column field database for datatable orderable
     var $column_search = array('kd_lokker', 'lokker', 'ket_lokker', 'stat_lokker', 'tgl_buat',); //set column field database for datatable searchable just firstname , lastname , address are searchable
     var $order = array('kd_lokker' => 'desc'); // default order 

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
          $this->db->where('id_lokker', $id);
          $query = $this->db->get();

          return $query->row();
     }

     public function count_all_lokker()
     {
          return $this->db->count_all_results('vw_lokker');
     }

     public function count_all_user()
     {
          return $this->db->count_all_results('vw_user');
     }

     public function input_lokker($data)
     {
          $this->db->insert('tb_lokker', $data);
          if ($this->db->affected_rows() > 0) {
               return true;
          } else {
               return false;
          }
     }

     public function cek_kode($kd_lokker)
     {
          $query = $this->db->get_where('tb_lokker', ['kd_lokker' => $kd_lokker]);
          if (!empty($query->result())) {
               return true;
          } else {
               return false;
          }
     }

     public function cek_lokker($lokker)
     {
          $query = $this->db->get_where('tb_lokker', ['lokker' => $lokker]);
          if (!empty($query->result())) {
               return true;
          } else {
               return false;
          }
     }

     public function hapus_lokker($auth_lokker)
     {
          $cek_id = $this->db->get_where('vw_lokker', ['auth_lokker' => $auth_lokker]);
          if (!empty($cek_id->result())) {
               foreach ($cek_id->result() as $list) {
                    $id_lokker = $list->id_lokker;
               }

               $this->db->delete('tb_lokker', ['id_lokker' => $id_lokker]);
               if ($this->db->affected_rows() > 0) {
                    return 200;
               } else {
                    return 201;
               }
          } else {
               return 202;
          }
     }

     public function get_lokker_id($auth_lokker)
     {
          $query = $this->db->get_where('vw_lokker', ['auth_lokker' => $auth_lokker]);
          return $query->result();
     }

     public function edit_lokker($kd_lokker, $lokker, $ket_lokker, $status)
     {
          $id_lokker = $this->session->userdata('id_lokker_hcdata');

          $query = $this->db->query("SELECT * FROM tb_lokker WHERE kd_lokker='" . $kd_lokker . "' AND id_lokker <> " . $id_lokker);
          if (!empty($query->result())) {
               return 203;
          }

          $query = $this->db->query("SELECT * FROM tb_lokker WHERE lokker='" . $lokker . "' AND id_lokker <> " . $id_lokker);
          if (!empty($query->result())) {
               return 204;
          }

          $this->db->set('kd_lokker', $kd_lokker);
          $this->db->set('lokker', $lokker);
          $this->db->set('ket_lokker', $ket_lokker);
          $this->db->set('stat_lokker', $status);
          $this->db->set('tgl_edit', date('Y-m-d H:i:s'));
          $this->db->where('id_lokker', $id_lokker);
          $this->db->update('tb_lokker');
          return 200;
     }

     public function get_all()
     {
          return $this->db->get('vw_lokker')->result();
     }

     public function get_id_lokker($auth_lokker)
     {
          $query = $this->db->get_where('vw_lokker', ['auth_lokker' => $auth_lokker]);
          if (!empty($query->result())) {
               foreach ($query->result() as $list) {
                    $id_lokker = $list->id_lokker;
               }

               return $id_lokker;
          } else {
               return 0;
          }
     }

     public function get_auth_lokker($id_lokker)
     {
          $auth_lokker = "";
          $query = $this->db->get_where('vw_lokker', ['id_lokker' => $id_lokker]);
          if (!empty($query->result())) {
               foreach ($query->result() as $list) {
                    $auth_lokker = $list->auth_lokker;
               }
               echo json_encode(array("statusCode" => 200, "pesan" => "Success", "auth_lokker" => $auth_lokker));
               return;
          } else {
               return 0;
          }
     }
}
