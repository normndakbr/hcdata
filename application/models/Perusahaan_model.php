<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Perusahaan_model extends CI_Model
{

     var $table = 'vw_perusahaan';
     var $column_order = array(null, 'kode_perusahaan', 'nama_perusahaan', 'alamat_perusahaan', 'ket_perusahaan', 'stat_perusahaan', 'tgl_buat', null); //set column field database for datatable orderable
     var $column_search = array('kode_perusahaan', 'nama_perusahaan', 'alamat_perusahaan', 'ket_perusahaan', 'stat_perusahaan', 'tgl_buat',); //set column field database for datatable searchable just firstname , lastname , address are searchable
     var $order = array('kode_perusahaan' => 'desc'); // default order 

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
          $this->db->where('id_perusahaan', $id);
          $query = $this->db->get();

          return $query->row();
     }

     public function count_all_perusahaan()
     {
          return $this->db->count_all_results('vw_perusahaan');
     }

     public function count_all_user()
     {
          return $this->db->count_all_results('vw_user');
     }

     public function input_perusahaan($data)
     {
          $this->db->insert('tb_perusahaan', $data);
          if ($this->db->affected_rows() > 0) {
               return true;
          } else {
               return false;
          }
     }

     public function cek_kode($kode_perusahaan)
     {
          $query = $this->db->get_where('tb_perusahaan', ['kode_perusahaan' => $kode_perusahaan]);
          if (empty($query->result())) {
               return 200;
          } else {
               return 201;
          }
     }

     public function cek_perusahaan($nama_perusahaan)
     {
          $query = $this->db->get_where('tb_perusahaan', ['nama_perusahaan' => $nama_perusahaan]);
          if (empty($query->result())) {
               return 200;
          } else {
               return 201;
          }
     }

     public function hapus_perusahaan($auth_perusahaan)
     {
          $cekper = $this->get_m_per_auth($auth_perusahaan);
          if (!empty($cekper)) {
               return 203;
          } else {
               $cek_id = $this->db->get_where('vw_perusahaan', ['auth_perusahaan' => $auth_perusahaan]);
               if (!empty($cek_id->result())) {
                    foreach ($cek_id->result() as $list) {
                         $id_perusahaan = $list->id_perusahaan;
                    }
                    $this->db->delete('tb_perusahaan', ['id_perusahaan' => $id_perusahaan]);
                    if ($this->db->affected_rows() > 0) {
                         return 200;
                    } else {
                         return 201;
                    }
               } else {
                    return 202;
               }
          }
     }

     public function hapus_izin_perusahaan($id_izin)
     {
          $this->db->delete('tb_izin_perusahaan', ['id_izin_perusahaan' => $id_izin]);
          if ($this->db->affected_rows() > 0) {
               return 200;
          } else {
               return 201;
          }
     }

     public function get_perusahaan_id($auth_perusahaan)
     {
          $query = $this->db->get_where('vw_perusahaan', ['auth_perusahaan' => $auth_perusahaan]);
          return $query->result();
     }

     public function get_m_per_auth($auth_perusahaan)
     {
          $query = $this->db->get_where('vw_m_perusahaan', ['auth_perusahaan' => $auth_perusahaan]);

          if (!empty($query->result())) {
               foreach ($query->result() as $list) {
                    $nama_perusahaan = $list->nama_perusahaan;
               }
          } else {
               $nama_perusahaan = "";
          }

          return $nama_perusahaan;
     }

     function edit_data_perusahaan($where, $data)
     {
          $this->db->where($where);
          $this->db->update('tb_perusahaan', $data);
          return 200;
     }

     public function edit_perusahaan($kd_perusahaan)
     {
          $id_perusahaan = $this->session->userdata('id_perusahaan_prs_edit');

          $query = $this->db->query("SELECT * FROM tb_perusahaan WHERE kode_perusahaan='" . $kd_perusahaan . "' AND id_perusahaan=" . $id_perusahaan . " AND id_perusahaan <> " . $id_perusahaan);
          if (!empty($query->result())) {
               return 203;
          }

          $this->db->set('kode_perusahaan', $kd_perusahaan);
          $this->db->set('perusahaan', '');
          $this->db->set('ket_perusahaan', '');
          $this->db->set('stat_perusahaan', 'T');
          $this->db->set('tgl_edit', date('Y-m-d H:i:s'));
          $this->db->where('id_perusahaan', $id_perusahaan);
          $this->db->update('tb_perusahaan');
          if ($this->db->affected_rows() > 0) {
               return 200;
          } else {
               return 201;
          }
     }

     public function get_by_authper($auth_per)
     {
          $query = $this->db->get_where('vw_perusahaan', ['auth_perusahaan' => $auth_per]);
          return $query->result();
     }

     public function get_by_idper($id_per)
     {
          $query = $this->db->get_where('vw_perusahaan', ['id_perusahaan' => $id_per]);
          return $query->result();
     }

     public function get_all($id_m_perusahaan)
     {
          $this->db->or_where(['id_m_perusahaan' => $id_m_perusahaan, 'id_parent' => $id_m_perusahaan]);
          $this->db->from('vw_m_prs');
          $this->db->order_by('id_m_perusahaan', 'ASC');

          return $this->db->get()->result();
     }

     public function get_m_all()
     {
          $id_m_perusahaan = $this->session->userdata('id_m_perusahaan_hcdata');
          return $this->db->get_where('vw_m_per', ['id_parent' => $id_m_perusahaan])->result();
     }
     public function get_con_per()
     {
          $id_m_perusahaan = $this->session->userdata('id_m_perusahaan_hcdata');
          return $this->db->get_where('vw_m_per', ['id_m_perusahaan' => $id_m_perusahaan])->result();
     }

     public function get_by_auth($auth_perusahaan)
     {
          $query = $this->db->get_where('vw_perusahaan', ['auth_perusahaan' => $auth_perusahaan]);
          if (!empty($query->result())) {
               foreach ($query->result() as $list) {
                    return $list->id_perusahaan;
               }
          } else {
               return;
          }
     }

     public function get_by_auth_izin($auth_izin)
     {
          $query = $this->db->get_where('vw_izin_perusahaan', ['auth_izin_perusahaan' => $auth_izin]);
          if (!empty($query->result())) {
               foreach ($query->result() as $list) {
                    return $list->id_izin_perusahaan;
               }
          } else {
               return;
          }
     }

     public function get_auth_m_by_auth_izin($auth_izin)
     {
          $query = $this->db->get_where('vw_izin_perusahaan', ['auth_izin_perusahaan' => $auth_izin]);
          if (!empty($query->result())) {
               foreach ($query->result() as $list) {
                    return $list->auth_m_perusahaan;
               }
          } else {
               return;
          }
     }

     public function get_by_auth_sio($auth_sio)
     {
          $query = $this->db->get_where('vw_sio_perusahaan', ['auth_sio_perusahaan' => $auth_sio]);
          if (!empty($query->result())) {
               foreach ($query->result() as $list) {
                    return $list->id_sio_perusahaan;
               }
          } else {
               return;
          }
     }

     public function get_by_auth_kontrak($auth_kontrak)
     {
          $query = $this->db->get_where('vw_kontrak_perusahaan', ['auth_kontrak_perusahaan' => $auth_kontrak]);
          if (!empty($query->result())) {
               foreach ($query->result() as $list) {
                    return $list->id_kontrak_perusahaan;
               }
          } else {
               return;
          }
     }

     public function get_m_by_auth($auth_m_per)
     {
          $query = $this->db->get_where('vw_m_per', ['auth_m_perusahaan' => $auth_m_per]);
          if (!empty($query->result())) {
               foreach ($query->result() as $list) {
                    return $list->id_m_perusahaan;
               }
          } else {
               return;
          }
     }

     public function get_id_per_by_auth_m($auth_per)
     {
          $query = $this->db->get_where('vw_m_per', ['auth_perusahaan' => $auth_per]);
          if (!empty($query->result())) {
               foreach ($query->result() as $list) {
                    return $list->id_perusahaan;
               }
          } else {
               return;
          }
     }

     public function get_parent_by_auth($auth_m_per)
     {
          $query = $this->db->get_where('vw_m_per', ['auth_m_perusahaan' => $auth_m_per]);
          if (!empty($query->result())) {
               foreach ($query->result() as $list) {
                    return $list->id_parent;
               }
          } else {
               return;
          }
     }

     public function get_kode_per_by_parent($id_m_per)
     {
          $query = $this->db->get_where('tb_m_perusahaan', ['id_m_perusahaan' => $id_m_per]);
          if (!empty($query->result())) {
               foreach ($query->result() as $list) {
                    $id_parent = $list->id_parent;
               }

               $dtper = $this->db->get_where('vw_m_per', ['id_m_perusahaan' => $id_parent]);
               if(!empty($dtper->result())){
                    foreach ($dtper->result() as $ls) {
                         $kode_per = $ls->kode_perusahaan;
                    }
               } else{
                    $kode_per ="";
               }
               
               return $kode_per;
          } else {
               return;
          }
     }

     public function get_rk3l_by_auth_m($auth_m_per)
     {
          $query = $this->db->get_where('vw_m_perusahaan', ['auth_m_perusahaan' => $auth_m_per]);
          if (!empty($query->result())) {
               foreach ($query->result() as $list) {
                    return $list->url_rk3l;
               }
          } else {
               return;
          }
     }

     public function get_izin_by_auth_m($auth_izin)
     {
          $query = $this->db->get_where('vw_izin_perusahaan', ['auth_izin_perusahaan' => $auth_izin]);
          if (!empty($query->result())) {
               foreach ($query->result() as $list) {
                    return $list->url_izin_perusahaan;
               }
          } else {
               return;
          }
     }

     public function get_p_by_auth($auth_m_per)
     {
          $query = $this->db->get_where('vw_m_per', ['auth_m_perusahaan' => $auth_m_per]);
          if (!empty($query->result())) {
               foreach ($query->result() as $list) {
                    return $list->auth_parent;
               }
          } else {
               return 0;
          }
     }

     public function get_idp_by_auth($auth_m_per)
     {
          $query = $this->db->get_where('vw_m_per', ['auth_m_perusahaan' => $auth_m_per]);
          if (!empty($query->result())) {
               foreach ($query->result() as $list) {
                    return $list->id_perusahaan;
               }
          } else {
               return;
          }
     }

     public function get_per_by_id($id_perusahaan)
     {
          $query = $this->db->get_where('tb_perusahaan', ['id_perusahaan' => $id_perusahaan]);
          if (!empty($query->result())) {
               foreach ($query->result() as $list) {
                    return $list->kode_perusahaan;
               }
          } else {
               return;
          }
     }

     function getPerusahaan($postData)
     {
          $response = array();

          if (isset($postData['search'])) {
               $this->db->select('*');
               $this->db->like("nama_perusahaan", $postData['search']);
               $this->db->or_like("kode_perusahaan", $postData['search']);
               $records = $this->db->get('vw_perusahaan')->result();
               foreach ($records as $row) {
                    $response[] = array("value" => $row->auth_perusahaan, "kode" => $row->kode_perusahaan, "nama" => $row->nama_perusahaan, "label" => $row->kode_perusahaan . " / " . $row->nama_perusahaan);
               }
          }
          return $response;
     }
}