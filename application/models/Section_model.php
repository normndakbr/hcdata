<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Section_model extends CI_Model
{

     var $table = 'vw_section';
     var $column_order = array(null, 'kd_section', 'section', 'depart', 'ket_section', 'stat_section', 'tgl_buat', null); //set column field database for datatable orderable
     var $column_search = array('kd_section', 'section', 'depart', 'ket_section', 'stat_section', 'tgl_buat',); //set column field database for datatable searchable just firstname , lastname , address are searchable
     var $order = array('kd_section' => 'desc'); // default order 

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
          $this->db->where('id_section', $id);
          $query = $this->db->get();

          return $query->row();
     }

     public function count_all_section()
     {
          return $this->db->count_all_results('vw_section');
     }

     public function count_all_user()
     {
          return $this->db->count_all_results('vw_user');
     }

     public function input_section($data)
     {
          $this->db->insert('tb_section', $data);
          if ($this->db->affected_rows() > 0) {
               return true;
          } else {
               return false;
          }
     }

     public function cek_kode($id_perusahaan, $kd_section)
     {
          $query = $this->db->get_where('tb_section', ['kd_section' => $kd_section, 'id_perusahaan' => $id_perusahaan]);
          if (!empty($query->result())) {
               return true;
          } else {
               return false;
          }
     }

     public function cek_section($id_perusahaan, $section)
     {
          $query = $this->db->get_where('tb_section', ['section' => $section, 'id_perusahaan' => $id_perusahaan]);
          if (!empty($query->result())) {
               return true;
          } else {
               return false;
          }
     }

     public function hapus_section($auth_section)
     {
          $cek_id = $this->db->get_where('vw_section', ['auth_section' => $auth_section]);
          if (!empty($cek_id->result())) {
               foreach ($cek_id->result() as $list) {
                    $id_section = $list->id_section;
               }

               $this->db->delete('tb_section', ['id_section' => $id_section]);
               if ($this->db->affected_rows() > 0) {
                    return 200;
               } else {
                    return 201;
               }
          } else {
               return 202;
          }
     }

     public function get_section_id($auth_section)
     {
          $query = $this->db->get_where('vw_section', ['auth_section' => $auth_section]);
          return $query->result();
     }

     public function edit_section($kd_section, $section, $depart, $ket_section, $status)
     {
          $id_perusahaan = $this->session->userdata('id_perusahaan');
          $id_section = $this->session->userdata('id_section');

          $query = $this->db->get_where('vw_depart', ['auth_depart' => $depart]);
          if (!empty($query->result())) {
               foreach ($query->result() as $list) {
                    $id_depart = $list->id_depart;
               }
          } else {
               $id_depart = 0;
          }

          $query = $this->db->query("SELECT * FROM tb_section WHERE kd_section='" . $kd_section .
               "' AND id_perusahaan=" . $id_perusahaan . " AND id_depart=" . $id_depart .
               " AND id_section <> " . $id_section);
          if (!empty($query->result())) {
               return 203;
          }

          $query = $this->db->query("SELECT * FROM tb_section WHERE section='" . $section .
               "' AND id_perusahaan=" . $id_perusahaan . " AND id_depart=" . $id_depart .
               " AND id_section <> " . $id_section);
          if (!empty($query->result())) {
               return 204;
          }

          $this->db->set('kd_section', $kd_section);
          $this->db->set('section', $section);
          $this->db->set('id_depart', $id_depart);
          $this->db->set('ket_section', $ket_section);
          $this->db->set('stat_section', $status);
          $this->db->set('tgl_edit', date('Y-m-d H:i:s'));
          $this->db->where('id_section', $id_section);
          $this->db->update('tb_section');
          if ($this->db->affected_rows() > 0) {
               return 200;
          } else {
               return 201;
          }
     }

     public function get_by_authdepart($auth_depart)
     {
          $query = $this->db->get_where('vw_section', ['auth_depart' => $auth_depart]);
          return $query->result();
     }
}
