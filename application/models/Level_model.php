<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Level_model extends CI_Model
{

     var $table = 'vw_lvl';
     var $column_order = array(null, 'kd_level', 'level', 'ket_level', 'stat_level', 'kode_perusahaan', 'nama_perusahaan', 'tgl_buat', null); //set column field database for datatable orderable
     var $column_search = array('kd_level', 'level', 'ket_level', 'stat_level', 'kode_perusahaan', 'nama_perusahaan', 'tgl_buat',); //set column field database for datatable searchable just firstname , lastname , address are searchable
     var $order = array('kd_level' => 'desc'); // default order 

     public function __construct()
     {
          parent::__construct();
          $this->load->database();
     }

     private function _get_datatables_query($auth_per)
     {
          $dtper = $this->prs->get_by_authper($auth_per);
          if (!empty($dtper)) {
               foreach ($dtper as $list) {
                    $id_perusahaan = $list->id_perusahaan;
               }
          } else {
               $id_perusahaan = 0;
          }

          $this->db->where(['id_perusahaan' => $id_perusahaan]);
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

     function get_datatables($auth_per)
     {
          $this->_get_datatables_query($auth_per);
          if ($_POST['length'] != -1)
               $this->db->limit($_POST['length'], $_POST['start']);
          $query = $this->db->get();
          return $query->result();
     }

     function count_filtered($auth_per)
     {
          $this->_get_datatables_query($auth_per);
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
          $this->db->where('id_level', $id);
          $query = $this->db->get();

          return $query->row();
     }

     public function count_all_level()
     {
          return $this->db->count_all_results('vw_level');
     }

     public function count_all_user()
     {
          return $this->db->count_all_results('vw_user');
     }

     public function input_level($data)
     {
          $this->db->insert('tb_level', $data);
          if ($this->db->affected_rows() > 0) {
               return true;
          } else {
               return false;
          }
     }

     public function cek_kode($id_perusahaan, $kd_level)
     {
          $query = $this->db->get_where('tb_level', ['kd_level' => $kd_level, 'id_perusahaan' => $id_perusahaan]);
          if (!empty($query->result())) {
               return true;
          } else {
               return false;
          }
     }

     public function cek_level($id_perusahaan, $level)
     {
          $query = $this->db->get_where('tb_level', ['level' => $level, 'id_perusahaan' => $id_perusahaan]);
          if (!empty($query->result())) {
               return true;
          } else {
               return false;
          }
     }

     public function hapus_level($auth_level)
     {
          $cek_id = $this->db->get_where('vw_level', ['auth_level' => $auth_level]);
          if (!empty($cek_id->result())) {
               foreach ($cek_id->result() as $list) {
                    $id_level = $list->id_level;
               }

               $this->db->delete('tb_level', ['id_level' => $id_level]);
               if ($this->db->affected_rows() > 0) {
                    return 200;
               } else {
                    return 201;
               }
          } else {
               return 202;
          }
     }

     public function get_level_id($auth_level)
     {
          $query = $this->db->get_where('vw_level', ['auth_level' => $auth_level]);
          return $query->result();
     }

     public function edit_level($kd_level, $level, $ket_level, $status)
     {
          $id_perusahaan = $this->session->userdata('id_perusahaan_lvl');
          $id_level = $this->session->userdata('id_level_hcdata');

          $query = $this->db->query("SELECT * FROM tb_level WHERE kd_level='" . $kd_level . "' AND id_perusahaan=" . $id_perusahaan . " AND id_level <> " . $id_level);
          if (!empty($query->result())) {
               return 203;
          }

          $query = $this->db->query("SELECT * FROM tb_level WHERE level='" . $level . "' AND id_perusahaan=" . $id_perusahaan . " AND id_level <> " . $id_level);
          if (!empty($query->result())) {
               return 204;
          }

          $this->db->set('kd_level', $kd_level);
          $this->db->set('level', $level);
          $this->db->set('ket_level', $ket_level);
          $this->db->set('stat_level', $status);
          $this->db->set('tgl_edit', date('Y-m-d H:i:s'));
          $this->db->where('id_level', $id_level);
          $this->db->update('tb_level');
          return 200;
     }

     public function get_all($auth_m_per)
     {
          $id_per = $this->prs->get_id_per_by_auth_m($auth_m_per);
          return $this->db->get_where('vw_lvl', ['id_perusahaan' => $id_per])->result();
     }

     public function get_by_authper($auth_per)
     {
          $this->db->where('auth_perusahaan', $auth_per);
          $this->db->from('vw_lvl');
          return  $this->db->get()->result();
     }

     public function get_by_idper($id_per)
     {
          $query = $this->db->get_where('vw_lvl', ['id_perusahaan' => $id_per]);
          return $query->result();
     }

     public function get_id_level($auth_level)
     {
          $query = $this->db->get_where('vw_level', ['auth_level' => $auth_level]);
          if (!empty($query->result())) {
               foreach ($query->result() as $list) {
                    $id_level = $list->id_level;
               }

               return $id_level;
          } else {
               return 0;
          }
     }

     public function get_auth_level($id_level)
     {
          $auth_level = "";
          $query = $this->db->get_where('vw_lvl', ['id_level' => $id_level]);
          if (!empty($query->result())) {
               foreach ($query->result() as $list) {
                    $auth_level = $list->auth_level;
               }
               echo json_encode(array("statusCode" => 200, "pesan" => "Success", "auth_level" => $auth_level));
               return;
          } else {
               return 0;
          }
     }
}