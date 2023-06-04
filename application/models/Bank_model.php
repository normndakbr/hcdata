<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Bank_model extends CI_Model
{

     var $table = 'vw_bank';
     var $column_order = array(null,  'bank', 'ket_bank', 'stat_bank', 'tgl_buat', null); //set column field database for datatable orderable
     var $column_search = array('bank', 'ket_bank', 'stat_bank', 'tgl_buat',); //set column field database for datatable searchable just firstname , lastname , address are searchable
     var $order = array('bank' => 'desc'); // default order 

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
          $this->db->where('id_bank', $id);
          $query = $this->db->get();

          return $query->row();
     }

     public function count_all_bank()
     {
          return $this->db->count_all_results('vw_bank');
     }

     public function count_all_user()
     {
          return $this->db->count_all_results('vw_user');
     }

     public function input_bank($data)
     {
          $this->db->insert('tb_bank', $data);
          if ($this->db->affected_rows() > 0) {
               return true;
          } else {
               return false;
          }
     }

     public function cek_bank($bank)
     {
          $query = $this->db->get_where('tb_bank', ['bank' => $bank]);
          if (!empty($query->result())) {
               return true;
          } else {
               return false;
          }
     }

     public function hapus_bank($auth_bank)
     {
          $cek_id = $this->db->get_where('vw_bank', ['auth_bank' => $auth_bank]);
          if (!empty($cek_id->result())) {
               foreach ($cek_id->result() as $list) {
                    $id_bank = $list->id_bank;
               }

               $this->db->delete('tb_bank', ['id_bank' => $id_bank]);
               if ($this->db->affected_rows() > 0) {
                    return 200;
               } else {
                    return 201;
               }
          } else {
               return 202;
          }
     }

     public function get_bank_id($auth_bank)
     {
          $query = $this->db->get_where('vw_bank', ['auth_bank' => $auth_bank]);
          return $query->result();
     }

     public function edit_bank($bank, $ket_bank, $status)
     {
          $id_bank = $this->session->userdata('id_bank');

          $query = $this->db->query("SELECT * FROM tb_bank WHERE bank='" . $bank . "' AND id_bank <> " . $id_bank);
          if (!empty($query->result())) {
               return 204;
          }

          $this->db->set('bank', $bank);
          $this->db->set('ket_bank', $ket_bank);
          $this->db->set('stat_bank', $status);
          $this->db->set('tgl_edit', date('Y-m-d H:i:s'));
          $this->db->where('id_bank', $id_bank);
          $this->db->update('tb_bank');
          if ($this->db->affected_rows() > 0) {
               return 200;
          } else {
               return 201;
          }
     }

     public function get_all()
     {
          return $this->db->get('vw_bank')->result();
     }

     public function get_by_authper($auth_per)
     {
          $query = $this->db->get_where('vw_bank', ['auth_perusahaan' => $auth_per]);
          return $query->result();
     }

     public function get_by_idper($id_per)
     {
          $query = $this->db->get_where('vw_bank', ['id_perusahaan' => $id_per]);
          return $query->result();
     }
}
