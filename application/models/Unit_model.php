<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Unit_model extends CI_Model
{

     var $table = 'vw_unit';
     var $column_order = array(null,  'kode_unit', 'unit', 'ket_unit', 'stat_unit', 'tgl_buat', null); //set column field database for datatable orderable
     var $column_search = array('kode_unit', 'unit', 'ket_unit', 'stat_unit', 'tgl_buat',); //set column field database for datatable searchable just firstname , lastname , address are searchable
     var $order = array('unit' => 'desc'); // default order 

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
          $this->db->where('id_unit', $id);
          $query = $this->db->get();

          return $query->row();
     }

     public function count_all_unit()
     {
          return $this->db->count_all_results('vw_unit');
     }

     public function count_all_user()
     {
          return $this->db->count_all_results('vw_user');
     }

     public function input_unit($data)
     {
          $this->db->insert('tb_unit', $data);
          if ($this->db->affected_rows() > 0) {
               return true;
          } else {
               return false;
          }
     }

     public function cek_unit($unit)
     {
          $query = $this->db->get_where('tb_unit', ['unit' => $unit]);
          if (!empty($query->result())) {
               return true;
          } else {
               return false;
          }
     }


     public function cek_kode_unit($kode_unit)
     {
          $query = $this->db->get_where('tb_unit', ['kode_unit' => $kode_unit]);
          if (!empty($query->result())) {
               return true;
          } else {
               return false;
          }
     }

     public function hapus_unit($auth_unit)
     {
          $cek_id = $this->db->get_where('vw_unit', ['auth_unit' => $auth_unit]);
          if (!empty($cek_id->result())) {
               foreach ($cek_id->result() as $list) {
                    $id_unit = $list->id_unit;
               }

               $this->db->delete('tb_unit', ['id_unit' => $id_unit]);
               if ($this->db->affected_rows() > 0) {
                    return 200;
               } else {
                    return 201;
               }
          } else {
               return 202;
          }
     }

     public function get_unit_id($auth_unit)
     {
          $query = $this->db->get_where('vw_unit', ['auth_unit' => $auth_unit]);
          return $query->result();
     }

     public function edit_unit($kode_unit, $unit, $ket_unit, $status)
     {
          $id_unit = $this->session->userdata('id_unit');

          $query = $this->db->query("SELECT * FROM tb_unit WHERE unit='" . $unit . "' AND id_unit <> " . $id_unit);
          if (!empty($query->result())) {
               return 204;
          }

          $this->db->set('kode_unit', $kode_unit);
          $this->db->set('unit', $unit);
          $this->db->set('ket_unit', $ket_unit);
          $this->db->set('stat_unit', $status);
          $this->db->set('tgl_edit', date('Y-m-d H:i:s'));
          $this->db->where('id_unit', $id_unit);
          $this->db->update('tb_unit');
          if ($this->db->affected_rows() > 0) {
               return 200;
          } else {
               return 201;
          }
     }

     public function get_all()
     {
          return $this->db->get('vw_unit')->result();
     }

     public function get_by_authper($auth_per)
     {
          $query = $this->db->get_where('vw_unit', ['auth_perusahaan' => $auth_per]);
          return $query->result();
     }

     public function get_by_idper($id_per)
     {
          $query = $this->db->get_where('vw_unit', ['id_perusahaan' => $id_per]);
          return $query->result();
     }
}
