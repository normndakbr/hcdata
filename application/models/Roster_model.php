<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Roster_model extends CI_Model
{

     var $table = 'vw_roster';
     var $column_order = array(null, 'kd_roster', 'roster', 'jml_hari_onsite', 'jml_hari_offsite', 'ket_roster', 'stat_roster', 'tgl_buat', null); //set column field database for datatable orderable
     var $column_search = array('kd_roster', 'roster', 'jml_hari_onsite', 'jml_hari_offsite', 'ket_roster', 'stat_roster', 'tgl_buat',); //set column field database for datatable searchable just firstname , lastname , address are searchable
     var $order = array('kode_perusaahan' => 'asc'); // default order 

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
          $this->db->where('id_roster', $id);
          $query = $this->db->get();

          return $query->row();
     }

     public function count_all_roster()
     {
          return $this->db->count_all_results('vw_roster');
     }

     public function count_all_user()
     {
          return $this->db->count_all_results('vw_user');
     }

     public function input_roster($data)
     {
          $this->db->insert('tb_roster', $data);
          if ($this->db->affected_rows() > 0) {
               return true;
          } else {
               return false;
          }
     }

     public function cek_kode($id_perusahaan, $kd_roster)
     {
          $query = $this->db->get_where('tb_roster', ['kd_roster' => $kd_roster, 'id_perusahaan' => $id_perusahaan]);
          if (!empty($query->result())) {
               return true;
          } else {
               return false;
          }
     }

     public function cek_roster($id_perusahaan, $roster)
     {
          $query = $this->db->get_where('tb_roster', ['roster' => $roster, 'id_perusahaan' => $id_perusahaan]);
          if (!empty($query->result())) {
               return true;
          } else {
               return false;
          }
     }

     public function hapus_roster($auth_roster)
     {
          $cek_id = $this->db->get_where('vw_roster', ['auth_roster' => $auth_roster]);
          if (!empty($cek_id->result())) {
               foreach ($cek_id->result() as $list) {
                    $id_roster = $list->id_roster;
               }

               $this->db->delete('tb_roster', ['id_roster' => $id_roster]);
               if ($this->db->affected_rows() > 0) {
                    return 200;
               } else {
                    return 201;
               }
          } else {
               return 202;
          }
     }

     public function get_roster_id($auth_roster)
     {
          $query = $this->db->get_where('vw_roster', ['auth_roster' => $auth_roster]);
          return $query->result();
     }

     public function edit_roster($kd_roster, $roster, $masa_onsite, $masa_offsite, $ket_roster, $status)
     {
          $id_perusahaan = $this->session->userdata('id_perusahaan_roster');
          $id_roster = $this->session->userdata('id_roster');

          $query = $this->db->query("SELECT * FROM tb_roster WHERE kd_roster='" . $kd_roster . "' AND id_perusahaan=" . $id_perusahaan . " AND id_roster <> " . $id_roster);
          if (!empty($query->result())) {
               return 203;
          }

          $query = $this->db->query("SELECT * FROM tb_roster WHERE roster='" . $roster . "' AND id_perusahaan=" . $id_perusahaan . " AND id_roster <> " . $id_roster);
          if (!empty($query->result())) {
               return 204;
          }

          $this->db->set('kd_roster', $kd_roster);
          $this->db->set('roster', $roster);
          $this->db->set('jml_hari_onsite', $masa_onsite);
          $this->db->set('jml_hari_offsite', $masa_offsite);
          $this->db->set('ket_roster', $ket_roster);
          $this->db->set('stat_roster', $status);
          $this->db->set('tgl_edit', date('Y-m-d H:i:s'));
          $this->db->where('id_roster', $id_roster);
          $this->db->update('tb_roster');
          if ($this->db->affected_rows() > 0) {
               return 200;
          } else {
               return 201;
          }
     }

     public function get_all()
     {
          return $this->db->get('vw_roster')->result();
     }

     public function get_by_authper($auth_per)
     {
          $query = $this->db->get_where('vw_roster', ['auth_perusahaan' => $auth_per]);
          return $query->result();
     }

     public function get_by_idper($id_per)
     {
          $query = $this->db->get_where('vw_roster', ['id_perusahaan' => $id_per]);
          return $query->result();
     }
}
