<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Grade_model extends CI_Model
{

     var $table = 'vw_grade';
     var $column_order = array(null, 'grade', 'level', 'ket_grade', 'stat_grade', 'tgl_buat', null); //set column field database for datatable orderable
     var $column_search = array('grade', 'level', 'ket_grade', 'stat_grade', 'tgl_buat',); //set column field database for datatable searchable just firstname , lastname , address are searchable
     var $order = array('grade' => 'desc'); // default order 

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
          $this->db->where('id_grade', $id);
          $query = $this->db->get();

          return $query->row();
     }

     public function count_all_grade()
     {
          return $this->db->count_all_results('vw_grade');
     }

     public function count_all_user()
     {
          return $this->db->count_all_results('vw_user');
     }

     public function input_grade($data)
     {
          $this->db->insert('tb_grade', $data);
          if ($this->db->affected_rows() > 0) {
               return true;
          } else {
               return false;
          }
     }

     public function cek_grade($id_perusahaan, $grade)
     {
          $query = $this->db->get_where('tb_grade', ['grade' => $grade, 'id_perusahaan' => $id_perusahaan]);
          if (!empty($query->result())) {
               return true;
          } else {
               return false;
          }
     }

     public function hapus_grade($auth_grade)
     {
          $cek_id = $this->db->get_where('vw_grade', ['auth_grade' => $auth_grade]);
          if (!empty($cek_id->result())) {
               foreach ($cek_id->result() as $list) {
                    $id_grade = $list->id_grade;
               }

               $this->db->delete('tb_grade', ['id_grade' => $id_grade]);
               if ($this->db->affected_rows() > 0) {
                    return 200;
               } else {
                    return 201;
               }
          } else {
               return 202;
          }
     }

     public function get_grade_id($auth_grade)
     {
          $query = $this->db->get_where('vw_grade', ['auth_grade' => $auth_grade]);
          return $query->result();
     }

     public function edit_grade($grade, $level, $ket_grade, $status)
     {
          $id_perusahaan = $this->session->userdata('id_perusahaan_level');
          $id_grade = $this->session->userdata('id_grade');

          $query = $this->db->get_where('vw_level', ['auth_level' => $level]);
          if (!empty($query->result())) {
               foreach ($query->result() as $list) {
                    $id_level = $list->id_level;
               }
          } else {
               $id_level = 0;
          }

          $query = $this->db->query("SELECT * FROM tb_grade WHERE grade=" . $grade .
               " AND id_level =" . $id_level . " AND id_perusahaan=" . $id_perusahaan .
               " AND id_grade <> " . $id_grade);
          if (!empty($query->result())) {
               return 204;
          }

          $this->db->set('grade', $grade);
          $this->db->set('id_level', $id_level);
          $this->db->set('ket_grade', $ket_grade);
          $this->db->set('stat_grade', $status);
          $this->db->set('tgl_edit', date('Y-m-d H:i:s'));
          $this->db->where('id_grade', $id_grade);
          $this->db->update('tb_grade');
          if ($this->db->affected_rows() > 0) {
               return 200;
          } else {
               return 201;
          }
     }

     public function get_by_authlevel($auth_level)
     {
          $query = $this->db->get_where('vw_grade', ['auth_level' => $auth_level]);
          return $query->result();
     }

     public function get_by_authper($auth_per)
     {
          $query = $this->db->get_where('vw_grade', ['auth_perusahaan' => $auth_per]);
          return $query->result();
     }
}
