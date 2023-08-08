<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Depart_model extends CI_Model
{

     var $table = 'vw_dprt';
     var $column_order = array(null, 'kd_depart', 'depart', 'ket_depart', 'stat_depart', 'kode_perusahaan', 'nama_perusahaan', 'tgl_buat', null); //set column field database for datatable orderable
     var $column_search = array('kd_depart', 'depart', 'ket_depart', 'stat_depart', 'kode_perusahaan', 'nama_perusahaan', 'tgl_buat',); //set column field database for datatable searchable just firstname , lastname , address are searchable
     var $order = array('kd_depart' => 'desc'); // default order 

     public function __construct()
     {
          parent::__construct();
          $this->load->database();
     }

     private function _get_datatables_query($auth_per, $csrf_name, $csrf_hash)
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

     function get_datatables($auth_per, $csrf_name, $csrf_hash)
     {
          $this->_get_datatables_query($auth_per, $csrf_name, $csrf_hash);
          if ($_POST['length'] != -1)
               $this->db->limit($_POST['length'], $_POST['start']);
          $query = $this->db->get();
          return $query->result();
     }

     function count_filtered($auth_per, $csrf_name, $csrf_hash)
     {
          $this->_get_datatables_query($auth_per, $csrf_name, $csrf_hash);
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
          $this->db->where('id_depart', $id);
          $query = $this->db->get();

          return $query->row();
     }

     public function count_all_depart()
     {
          return $this->db->count_all_results('vw_depart');
     }

     public function count_all_user()
     {
          return $this->db->count_all_results('vw_user');
     }

     public function tabel_depart($auth_perusahaan)
     {
          if ($auth_perusahaan !== "") {
               $query = $this->db->get_where('vw_dprt', ['auth_perusahaan' => $auth_perusahaan]);
               return $query->result();
          } else {
               return 0;
          }
     }

     public function input_depart($data)
     {
          $this->db->insert('tb_depart', $data);
          if ($this->db->affected_rows() > 0) {
               return true;
          } else {
               return false;
          }
     }

     public function cek_kode($id_perusahaan, $kd_depart)
     {
          $query = $this->db->get_where('tb_depart', ['kd_depart' => $kd_depart, 'id_perusahaan' => $id_perusahaan]);
          if (!empty($query->result())) {
               return true;
          } else {
               return false;
          }
     }

     public function cek_depart($id_perusahaan, $depart)
     {
          $query = $this->db->get_where('tb_depart', ['depart' => $depart, 'id_perusahaan' => $id_perusahaan]);
          if (!empty($query->result())) {
               return true;
          } else {
               return false;
          }
     }

     public function hapus_depart($auth_depart)
     {
          $cek_id = $this->db->get_where('vw_depart', ['auth_depart' => $auth_depart]);
          if (!empty($cek_id->result())) {
               foreach ($cek_id->result() as $list) {
                    $id_depart = $list->id_depart;
               }

               $this->db->delete('tb_depart', ['id_depart' => $id_depart]);
               if ($this->db->affected_rows() > 0) {
                    return 200;
               } else {
                    return 201;
               }
          } else {
               return 202;
          }
     }

     public function get_depart_id($auth_depart)
     {
          $query = $this->db->get_where('vw_depart', ['auth_depart' => $auth_depart]);
          return $query->result();
     }

     public function edit_depart($kd_depart, $depart, $ket_depart, $status)
     {
          $id_perusahaan = $this->session->userdata('id_perusahaan');
          $id_depart = $this->session->userdata('id_depart');

          $query = $this->db->query("SELECT * FROM tb_depart WHERE kd_depart='" . $kd_depart . "' AND id_perusahaan=" . $id_perusahaan . " AND id_depart <> " . $id_depart);
          if (!empty($query->result())) {
               return 203;
          }

          $query = $this->db->query("SELECT * FROM tb_depart WHERE depart='" . $depart . "' AND id_perusahaan=" . $id_perusahaan . " AND id_depart <> " . $id_depart);
          if (!empty($query->result())) {
               return 204;
          }

          $this->db->set('kd_depart', $kd_depart);
          $this->db->set('depart', $depart);
          $this->db->set('ket_depart', $ket_depart);
          $this->db->set('stat_depart', $status);
          $this->db->set('tgl_edit', date('Y-m-d H:i:s'));
          $this->db->where('id_depart', $id_depart);
          $this->db->update('tb_depart');
          if ($this->db->affected_rows() > 0) {
               return 200;
          } else {
               return 201;
          }
     }

     public function get_all()
     {
          return $this->db->get('vw_depart')->result();
     }

     public function get_by_idper($id_per)
     {
          $query = $this->db->get_where('vw_depart', ['id_perusahaan' => $id_per]);
          return $query->result();
     }

     public function get_id_depart($auth_depart)
     {
          $query = $this->db->get_where('vw_depart', ['auth_depart' => $auth_depart]);
          if (!empty($query->result())) {
               foreach ($query->result() as $list) {
                    $id_depart = $list->id_depart;
               }

               return $id_depart;
          } else {
               return 0;
          }
     }

     public function get_by_authper($auth_per)
     {
          $query_per = $this->db->get_where('vw_m_prs', ['auth_perusahaan' => $auth_per]);
          if (!empty($query_per->result())) {
               foreach ($query_per->result() as $list) {
                    $id_perusahaan = $list->id_perusahaan;
               }

               $query = $this->db->get_where('vw_dprt', ['id_perusahaan' => $id_perusahaan]);
               return $query->result();
          }
     }

     public function get_by_auth_m_per($auth_per)
     {
          $query_per = $this->db->get_where('vw_m_perusahaan', ['auth_m_perusahaan' => $auth_per]);
          if (!empty($query_per->result())) {
               foreach ($query_per->result() as $list) {
                    $id_perusahaan = $list->id_perusahaan;
               }

               $query = $this->db->get_where('vw_dprt', ['id_perusahaan' => $id_perusahaan]);
               return $query->result();
          }
     }

     public function get_auth_depart($id_depart)
     {
          $auth_depart = "";
          $query = $this->db->get_where('vw_depart', ['id_depart' => $id_depart]);
          if (!empty($query->result())) {
               foreach ($query->result() as $list) {
                    $auth_depart = $list->auth_depart;
               }
               echo json_encode(array("statusCode" => 200, "pesan" => "Success", "auth_depart" => $auth_depart));
               return;
          } else {
               return 0;
          }
     }
}
