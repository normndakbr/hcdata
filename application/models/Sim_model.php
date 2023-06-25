<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Sim_model extends CI_Model
{

     var $table = 'vw_sim';
     var $column_order = array(null,  'sim', 'ket_sim', 'stat_sim', 'tgl_buat', null); //set column field database for datatable orderable
     var $column_search = array('sim', 'ket_sim', 'stat_sim', 'tgl_buat',); //set column field database for datatable searchable just firstname , lastname , address are searchable
     var $order = array('sim' => 'desc'); // default order 

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
          $this->db->where('id_sim', $id);
          $query = $this->db->get();

          return $query->row();
     }

     public function count_all_sim()
     {
          return $this->db->count_all_results('vw_sim');
     }

     public function count_all_user()
     {
          return $this->db->count_all_results('vw_user');
     }

     public function input_sim($data)
     {
          $this->db->insert('tb_sim', $data);
          if ($this->db->affected_rows() > 0) {
               return true;
          } else {
               return false;
          }
     }

     public function cek_sim($sim)
     {
          $query = $this->db->get_where('tb_sim', ['sim' => $sim]);
          if (!empty($query->result())) {
               return true;
          } else {
               return false;
          }
     }

     public function hapus_sim($auth_sim)
     {
          $cek_id = $this->db->get_where('vw_sim', ['auth_sim' => $auth_sim]);
          if (!empty($cek_id->result())) {
               foreach ($cek_id->result() as $list) {
                    $id_sim = $list->id_sim;
               }

               $this->db->delete('tb_sim', ['id_sim' => $id_sim]);
               if ($this->db->affected_rows() > 0) {
                    return 200;
               } else {
                    return 201;
               }
          } else {
               return 202;
          }
     }

     public function get_sim_id($auth_sim)
     {
          $query = $this->db->get_where('vw_sim', ['auth_sim' => $auth_sim]);
          return $query->result();
     }

     public function edit_sim($sim, $ket_sim, $status)
     {
          $id_sim = $this->session->userdata('id_sim');

          $query = $this->db->query("SELECT * FROM tb_sim WHERE sim='" . $sim . "' AND id_sim <> " . $id_sim);
          if (!empty($query->result())) {
               return 204;
          }

          $this->db->set('sim', $sim);
          $this->db->set('ket_sim', $ket_sim);
          $this->db->set('stat_sim', $status);
          $this->db->set('tgl_edit', date('Y-m-d H:i:s'));
          $this->db->where('id_sim', $id_sim);
          $this->db->update('tb_sim');
          if ($this->db->affected_rows() > 0) {
               return 200;
          } else {
               return 201;
          }
     }

     public function get_all()
     {
          return $this->db->get('vw_sim')->result();
     }

     public function get_by_authper($auth_per)
     {
          $query = $this->db->get_where('vw_sim', ['auth_perusahaan' => $auth_per]);
          return $query->result();
     }

     public function get_by_idper($id_per)
     {
          $query = $this->db->get_where('vw_sim', ['id_perusahaan' => $id_per]);
          return $query->result();
     }
}
