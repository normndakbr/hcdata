<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Posisi_model extends CI_Model
{

     var $table = 'vw_pss';
     var $column_order = array(null, 'posisi', 'depart', 'ket_posisi', 'stat_posisi', 'kode_perusahaan', 'nama_perusahaan', 'tgl_buat', null); //set column field database for datatable orderable
     var $column_search = array('posisi', 'depart', 'ket_posisi', 'stat_posisi', 'kode_perusahaan', 'nama_perusahaan', 'tgl_buat',); //set column field database for datatable searchable just firstname , lastname , address are searchable
     var $order = array('id_perusahaan' => 'desc'); // default order 

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
          $this->db->where('id_posisi', $id);
          $query = $this->db->get();

          return $query->row();
     }

     public function count_all_posisi()
     {
          return $this->db->count_all_results('vw_posisi');
     }

     public function count_all_user()
     {
          return $this->db->count_all_results('vw_user');
     }

     public function input_posisi($data)
     {
          $this->db->insert('tb_posisi', $data);
          if ($this->db->affected_rows() > 0) {
               return true;
          } else {
               return false;
          }
     }

     public function cek_posisi($id_perusahaan, $id_depart, $posisi)
     {
          $query = $this->db->get_where('tb_posisi', ['posisi' => $posisi, 'id_depart' => $id_depart, 'id_perusahaan' => $id_perusahaan]);
          if (!empty($query->result())) {
               return true;
          } else {
               return false;
          }
     }

     public function hapus_posisi($auth_posisi)
     {
          $cek_id = $this->db->get_where('vw_posisi', ['auth_posisi' => $auth_posisi]);
          if (!empty($cek_id->result())) {
               foreach ($cek_id->result() as $list) {
                    $id_posisi = $list->id_posisi;
               }

               $this->db->delete('tb_posisi', ['id_posisi' => $id_posisi]);
               if ($this->db->affected_rows() > 0) {
                    return 200;
               } else {
                    return 201;
               }
          } else {
               return 202;
          }
     }

     public function get_posisi_id($auth_posisi)
     {
          $query = $this->db->get_where('vw_posisi', ['auth_posisi' => $auth_posisi]);
          return $query->result();
     }

     public function edit_posisi($posisi, $depart, $ket_posisi, $status)
     {
          $id_perusahaan = $this->session->userdata('id_perusahaan');
          $id_posisi = $this->session->userdata('id_posisi');

          $query = $this->db->get_where('vw_depart', ['auth_depart' => $depart]);
          if (!empty($query->result())) {
               foreach ($query->result() as $list) {
                    $id_depart = $list->id_depart;
               }
          } else {
               $id_depart = 0;
          }

          $query = $this->db->query("SELECT * FROM tb_posisi WHERE posisi='" . $posisi .
               "' AND id_perusahaan=" . $id_perusahaan . " AND id_depart=" . $id_depart .
               " AND id_posisi <> " . $id_posisi);
          if (!empty($query->result())) {
               return 204;
          }

          $this->db->set('posisi', $posisi);
          $this->db->set('id_depart', $id_depart);
          $this->db->set('ket_posisi', $ket_posisi);
          $this->db->set('stat_posisi', $status);
          $this->db->set('tgl_edit', date('Y-m-d H:i:s'));
          $this->db->where('id_posisi', $id_posisi);
          $this->db->update('tb_posisi');
          if ($this->db->affected_rows() > 0) {
               return 200;
          } else {
               return 201;
          }
     }

     public function get_by_authdepart($auth_depart)
     {
          $query = $this->db->get_where('vw_pss', ['auth_depart' => $auth_depart]);
          return $query->result();
     }

     public function get_id_posisi($auth_posisi)
     {
          $query = $this->db->get_where('vw_posisi', ['auth_posisi' => $auth_posisi]);
          if (!empty($query->result())) {
               foreach ($query->result() as $list) {
                    $id_posisi = $list->id_posisi;
               }

               return $id_posisi;
          } else {
               return 0;
          }
     }

     public function get_auth_posisi($id_posisi)
     {
          $auth_posisi = "";
          $query = $this->db->get_where('vw_posisi', ['id_posisi' => $id_posisi]);
          if (!empty($query->result())) {
               foreach ($query->result() as $list) {
                    $auth_posisi = $list->auth_posisi;
               }
               echo json_encode(array("statusCode" => 200, "pesan" => "Success", "auth_posisi" => $auth_posisi));
               return;
          } else {
               return 0;
          }
     }
}
