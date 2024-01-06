<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Poh_model extends CI_Model
{

     var $table = 'vw_poh';
     var $column_order = array(null, 'kd_poh', 'poh', 'ket_poh', 'stat_poh', 'tgl_buat', null); //set column field database for datatable orderable
     var $column_search = array('kd_poh', 'poh', 'ket_poh', 'stat_poh', 'tgl_buat',); //set column field database for datatable searchable just firstname , lastname , address are searchable
     var $order = array('kd_poh' => 'desc'); // default order 

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
          $this->db->where('id_poh', $id);
          $query = $this->db->get();

          return $query->row();
     }

     public function count_all_poh()
     {
          return $this->db->count_all_results('vw_poh');
     }

     public function count_all_user()
     {
          return $this->db->count_all_results('vw_user');
     }

     public function input_poh($data)
     {
          $this->db->insert('tb_poh', $data);
          if ($this->db->affected_rows() > 0) {
               return true;
          } else {
               return false;
          }
     }

     public function cek_kode($kd_poh)
     {
          $query = $this->db->get_where('tb_poh', ['kd_poh' => $kd_poh]);
          if (!empty($query->result())) {
               return true;
          } else {
               return false;
          }
     }

     public function cek_poh($poh)
     {
          $query = $this->db->get_where('tb_poh', ['poh' => $poh]);
          if (!empty($query->result())) {
               return true;
          } else {
               return false;
          }
     }

     public function hapus_poh($auth_poh)
     {
          $cek_id = $this->db->get_where('vw_poh', ['auth_poh' => $auth_poh]);
          if (!empty($cek_id->result())) {
               foreach ($cek_id->result() as $list) {
                    $id_poh = $list->id_poh;
                    $kd_poh = $list->kd_poh;
                    $poh = $list->poh;
               }

               $dtaudit = [
                   'id_user' => $this->session->userdata('id_user_hcdata'),
                   'jenis_proses' => 'HAPUS',
                   'data_proses' => 'POINT OF HIRE(POH)',
                   'nama_data' => $kd_poh . ' | ' . $poh,
                   'tgl_buat' => date('Y-m-d H:i:s'),
               ];

               $this->db->delete('tb_poh', ['id_poh' => $id_poh]);
               if ($this->db->affected_rows() > 0) {
                    $this->db->insert('tb_audit', $dtaudit);
                    return 200;
               } else {
                    return 201;
               }
          } else {
               return 202;
          }
     }

     public function get_poh_id($auth_poh)
     {
          $query = $this->db->get_where('vw_poh', ['auth_poh' => $auth_poh]);
          return $query->result();
     }

     public function edit_poh($kd_poh, $poh, $ket_poh, $status)
     {
          $id_poh = $this->session->userdata('id_poh_hcdata');

          $query = $this->db->query("SELECT * FROM tb_poh WHERE kd_poh='" . $kd_poh . "' AND id_poh <> " . $id_poh);
          if (!empty($query->result())) {
               return 203;
          }

          $query = $this->db->query("SELECT * FROM tb_poh WHERE poh='" . $poh . "' AND id_poh <> " . $id_poh);
          if (!empty($query->result())) {
               return 204;
          }

          $this->db->set('kd_poh', $kd_poh);
          $this->db->set('poh', $poh);
          $this->db->set('ket_poh', $ket_poh);
          $this->db->set('stat_poh', $status);
          $this->db->set('tgl_edit', date('Y-m-d H:i:s'));
          $this->db->where('id_poh', $id_poh);
          $this->db->update('tb_poh');
          return 200;
     }

     public function get_all()
     {
          return $this->db->get('vw_poh')->result();
     }

     public function get_id_poh($auth_poh)
     {
          $query = $this->db->get_where('vw_poh', ['auth_poh' => $auth_poh]);
          if (!empty($query->result())) {
               foreach ($query->result() as $list) {
                    $id_poh = $list->id_poh;
               }

               return $id_poh;
          } else {
               return 0;
          }
     }

     public function get_auth_poh($id_poh)
     {
          $auth_poh = "";
          $query = $this->db->get_where('vw_poh', ['id_poh' => $id_poh]);
          if (!empty($query->result())) {
               foreach ($query->result() as $list) {
                    $auth_poh = $list->auth_poh;
               }
               echo json_encode(array("statusCode" => 200, "pesan" => "Success", "auth_poh" => $auth_poh));
               return;
          } else {
               return 0;
          }
     }
}
