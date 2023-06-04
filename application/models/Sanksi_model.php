<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Sanksi_model extends CI_Model
{

     var $table = 'vw_sanksi';
     var $column_order = array(null, 'kd_sanksi', 'sanksi', 'jml_hari_berlaku', 'ket_sanksi', 'stat_sanksi', 'tgl_buat', null); //set column field database for datatable orderable
     var $column_search = array('kd_sanksi', 'sanksi', 'jml_hari_berlaku', 'ket_sanksi', 'stat_sanksi', 'tgl_buat',); //set column field database for datatable searchable just firstname , lastname , address are searchable
     var $order = array('id_sanksi' => 'desc'); // default order 

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
          $this->db->where('id_sanksi', $id);
          $query = $this->db->get();

          return $query->row();
     }

     public function count_all_sanksi()
     {
          return $this->db->count_all_results('vw_sanksi');
     }

     public function count_all_user()
     {
          return $this->db->count_all_results('vw_user');
     }

     public function input_sanksi($data)
     {
          $this->db->insert('tb_sanksi', $data);
          if ($this->db->affected_rows() > 0) {
               return true;
          } else {
               return false;
          }
     }

     public function cek_kode($kd_sanksi)
     {
          $query = $this->db->get_where('tb_sanksi', ['kd_sanksi' => $kd_sanksi]);
          if (!empty($query->result())) {
               return true;
          } else {
               return false;
          }
     }

     public function cek_sanksi($sanksi)
     {
          $query = $this->db->get_where('tb_sanksi', ['sanksi' => $sanksi]);
          if (!empty($query->result())) {
               return true;
          } else {
               return false;
          }
     }

     public function hapus_sanksi($auth_sanksi)
     {
          $cek_id = $this->db->get_where('vw_sanksi', ['auth_sanksi' => $auth_sanksi]);
          if (!empty($cek_id->result())) {
               foreach ($cek_id->result() as $list) {
                    $id_sanksi = $list->id_sanksi;
               }

               $this->db->delete('tb_sanksi', ['id_sanksi' => $id_sanksi]);
               if ($this->db->affected_rows() > 0) {
                    return 200;
               } else {
                    return 201;
               }
          } else {
               return 202;
          }
     }

     public function get_sanksi_id($auth_sanksi)
     {
          $query = $this->db->get_where('vw_sanksi', ['auth_sanksi' => $auth_sanksi]);
          return $query->result();
     }

     public function edit_sanksi($kd_sanksi, $sanksi, $jml_hari, $ket_sanksi, $status)
     {
          $id_sanksi = $this->session->userdata('id_sanksi');

          $query = $this->db->query("SELECT * FROM tb_sanksi WHERE kd_sanksi='" . $kd_sanksi . "' AND id_sanksi <> " . $id_sanksi);
          if (!empty($query->result())) {
               return 203;
          }

          $query = $this->db->query("SELECT * FROM tb_sanksi WHERE sanksi='" . $sanksi . "' AND id_sanksi <> " . $id_sanksi);
          if (!empty($query->result())) {
               return 204;
          }

          $this->db->set('kd_sanksi', $kd_sanksi);
          $this->db->set('sanksi', $sanksi);
          $this->db->set('jml_hari_berlaku', $jml_hari);
          $this->db->set('ket_sanksi', $ket_sanksi);
          $this->db->set('stat_sanksi', $status);
          $this->db->set('tgl_edit', date('Y-m-d H:i:s'));
          $this->db->where('id_sanksi', $id_sanksi);
          $this->db->update('tb_sanksi');
          if ($this->db->affected_rows() > 0) {
               return 200;
          } else {
               return 201;
          }
     }

     public function get_all()
     {
          return $this->db->get('vw_sanksi')->result();
     }
}
