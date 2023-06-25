<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Lokterima_model extends CI_Model
{

     var $table = 'vw_lokterima';
     var $column_order = array(null, 'kd_lokterima', 'lokterima', 'ket_lokterima', 'stat_lokterima', 'kode_perusahaan', 'nama_perusahaan', 'tgl_buat', null); //set column field database for datatable orderable
     var $column_search = array('kd_lokterima', 'lokterima', 'ket_lokterima', 'stat_lokterima', 'kode_perusahaan', 'nama_perusahaan', 'tgl_buat',); //set column field database for datatable searchable just firstname , lastname , address are searchable
     var $order = array('kd_lokterima' => 'desc'); // default order 

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
          $this->db->where('id_lokterima', $id);
          $query = $this->db->get();

          return $query->row();
     }

     public function count_all_lokterima()
     {
          return $this->db->count_all_results('vw_lokterima');
     }

     public function count_all_user()
     {
          return $this->db->count_all_results('vw_user');
     }

     public function input_lokterima($data)
     {
          $this->db->insert('tb_lokterima', $data);
          if ($this->db->affected_rows() > 0) {
               return true;
          } else {
               return false;
          }
     }

     public function cek_kode($id_perusahaan, $kd_lokterima)
     {
          $query = $this->db->get_where('tb_lokterima', ['kd_lokterima' => $kd_lokterima, 'id_perusahaan' => $id_perusahaan]);
          if (!empty($query->result())) {
               return true;
          } else {
               return false;
          }
     }

     public function cek_lokterima($id_perusahaan, $lokterima)
     {
          $query = $this->db->get_where('tb_lokterima', ['lokterima' => $lokterima, 'id_perusahaan' => $id_perusahaan]);
          if (!empty($query->result())) {
               return true;
          } else {
               return false;
          }
     }

     public function hapus_lokterima($auth_lokterima)
     {
          $cek_id = $this->db->get_where('vw_lokterima', ['auth_lokterima' => $auth_lokterima]);
          if (!empty($cek_id->result())) {
               foreach ($cek_id->result() as $list) {
                    $id_lokterima = $list->id_lokterima;
               }

               $this->db->delete('tb_lokterima', ['id_lokterima' => $id_lokterima]);
               if ($this->db->affected_rows() > 0) {
                    return 200;
               } else {
                    return 201;
               }
          } else {
               return 202;
          }
     }

     public function get_lokterima_id($auth_lokterima)
     {
          $query = $this->db->get_where('vw_lokterima', ['auth_lokterima' => $auth_lokterima]);
          return $query->result();
     }

     public function edit_lokterima($kd_lokterima, $lokterima, $ket_lokterima, $status)
     {
          $id_perusahaan = $this->session->userdata('id_perusahaan');
          $id_lokterima = $this->session->userdata('id_lokterima');

          $query = $this->db->query("SELECT * FROM tb_lokterima WHERE kd_lokterima='" . $kd_lokterima . "' AND id_perusahaan=" . $id_perusahaan . " AND id_lokterima <> " . $id_lokterima);
          if (!empty($query->result())) {
               return 203;
          }

          $query = $this->db->query("SELECT * FROM tb_lokterima WHERE lokterima='" . $lokterima . "' AND id_perusahaan=" . $id_perusahaan . " AND id_lokterima <> " . $id_lokterima);
          if (!empty($query->result())) {
               return 204;
          }

          $this->db->set('kd_lokterima', $kd_lokterima);
          $this->db->set('lokterima', $lokterima);
          $this->db->set('ket_lokterima', $ket_lokterima);
          $this->db->set('stat_lokterima', $status);
          $this->db->set('tgl_edit', date('Y-m-d H:i:s'));
          $this->db->where('id_lokterima', $id_lokterima);
          $this->db->update('tb_lokterima');
          if ($this->db->affected_rows() > 0) {
               return 200;
          } else {
               return 201;
          }
     }

     public function get_all()
     {
          return $this->db->get('vw_lokterima')->result();
     }

     public function get_by_authper($auth_per)
     {
          $query = $this->db->get_where('vw_m_perusahaan', ['auth_m_perusahaan' => $auth_per]);
          foreach ($query->result() as $list) {
               $id_perusahaan = $list->id_perusahaan;
          }

          $query = $this->db->get_where('vw_lokterima', ['id_perusahaan' => $id_perusahaan]);
          return $query->result();
     }

     public function get_by_idper($id_per)
     {
          $query = $this->db->get_where('vw_lokterima', ['id_perusahaan' => $id_per]);
          return $query->result();
     }

     public function get_id_lokterima($auth_lokterima)
     {
          $query = $this->db->get_where('vw_lokterima', ['auth_lokterima' => $auth_lokterima]);
          if (!empty($query->result())) {
               foreach ($query->result() as $list) {
                    $id_lokterima = $list->id_lokterima;
               }

               return $id_lokterima;
          } else {
               return 0;
          }
     }
}
