<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Struktur_model extends CI_Model
{

     var $table = 'vw_m_perusahaan';
     var $column_order = array(null, 'kode_perusahaan', 'nama_perusahaan', 'jenis_perusahaan', 'stat_perusahaan', null); //set column field database for datatable orderable
     var $column_search = array('kode_perusahaan', 'nama_perusahaan', 'jenis_perusahaan', 'stat_perusahaan'); //set column field database for datatable searchable just firstname , lastname , address are searchable
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
          $this->db->where('id_m_perusahaan', $id);
          $query = $this->db->get();

          return $query->row();
     }

     public function count_all_m_perusahaan()
     {
          return $this->db->count_all_results('vw_m_perusahaan');
     }

     public function count_all_user()
     {
          return $this->db->count_all_results('vw_user');
     }

     public function get_all()
     {
          return $this->db->get('vw_m_perusahaan')->result();
     }

     public function get_by_authper($auth_per)
     {
          $query = $this->db->get_where('vw_m_perusahaan', ['auth_perusahaan' => $auth_per]);
          return $query->result();
     }

     public function get_by_idjenis($idjenis)
     {
          $query = $this->db->query("SELECT DISTINCT id_perusahaan, nama_perusahaan, auth_m_perusahaan " .
               " FROM vw_m_perusahaan WHERE id_jenis_perusahaan=" . $idjenis);
          return $query->result();
     }

     public function get_by_authperusahaan($auth_per)
     {
          $query = $this->db->get_where('vw_perusahaan', ['auth_perusahaan' => $auth_per]);
          if (!empty($query->result())) {
               foreach ($query->result() as $list) {
                    $id_perusahaan = $list->id_perusahaan;
               }
               return $id_perusahaan;
          } else {
               return 0;
          }
     }

     public function get_by_m_authper($idparent)
     {
          $query = $this->db->get_where('vw_m_perusahaan', ['auth_m_perusahaan' => $idparent]);
          if (!empty($query->result())) {
               foreach ($query->result() as $list) {
                    $id_m_perusahaan = $list->id_m_perusahaan;
               }
               return $id_m_perusahaan;
          } else {
               return 0;
          }
     }

     public function cek_str_per($id_parent, $id_per)
     {
          $query = $this->db->query("SELECT * FROM vw_m_perusahaan WHERE id_parent = " . $id_parent .
               " AND id_perusahaan = " . $id_per);
          return $query->result();
     }

     public function input_struktur($dtper)
     {
          $this->db->insert('tb_m_perusahaan', $dtper);
          if ($this->db->affected_rows() > 0) {
               return true;
          } else {
               return false;
          }
     }

     public function input_iujp($dtiujp)
     {
          $this->db->insert('tb_izin_perusahaan', $dtiujp);
          if ($this->db->affected_rows() > 0) {
               return true;
          } else {
               return false;
          }
     }

     public function input_perusahaan($dataper)
     {
          $this->db->insert('tb_perusahaan', $dataper);
          if ($this->db->affected_rows() > 0) {
               return true;
          } else {
               return false;
          }
     }

     public function update_struktur($id_m_per, $dtper)
     {
          $this->db->where('id_m_perusahaan', $id_m_per);
          $this->db->update('tb_m_perusahaan', $dtper);
          if ($this->db->affected_rows() > 0) {
               return 200;
          } else {
               return 201;
          }
     }

     public function cek_kodeper($kodeper, $idparent)
     {
          $query = $this->db->query("SELECT * FROM tb_perusahaan WHERE kode_perusahaan = '" . $kodeper . "'");
          return $query->result();
     }

     public function cek_namaper($namaper, $idparent)
     {
          $query = $this->db->query("SELECT * FROM tb_perusahaan WHERE nama_perusahaan = '" . $namaper . "'");
          return $query->result();
     }

     public function last_row_per()
     {
          $this->db->select("*");
          $this->db->from("tb_perusahaan");
          $this->db->limit(1);
          $this->db->order_by('id_perusahaan', "DESC");
          $query = $this->db->get()->result();

          if (!empty($query)) {
               foreach ($query as $list) {
                    $id_perusahaan = $list->id_perusahaan;
               }

               return $id_perusahaan;
          } else {
               return 0;
          }
     }

     public function last_row_idmper()
     {
          $this->db->select("*");
          $this->db->from("tb_m_perusahaan");
          $this->db->limit(1);
          $this->db->order_by('id_m_perusahaan', "DESC");
          $query = $this->db->get()->result();

          if (!empty($query)) {
               foreach ($query as $list) {
                    $id_m_perusahaan = $list->id_m_perusahaan;
               }

               return $id_m_perusahaan;
          } else {
               return 0;
          }
     }

     public function last_row_idiujp()
     {
          $this->db->select("*");
          $this->db->from("tb_izin_perusahaan");
          $this->db->limit(1);
          $this->db->order_by('id_izin_perusahaan', "DESC");
          $query = $this->db->get()->result();

          if (!empty($query)) {
               foreach ($query as $list) {
                    $id_izin_perusahaan = $list->id_izin_perusahaan;
               }

               return $id_izin_perusahaan;
          } else {
               return 0;
          }
     }
}
