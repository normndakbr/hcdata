<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Karyizin_model extends CI_Model
{
     var $table = 'vw_pengajuan_sm_detail';
     var $column_order = array(null,  'auth_pengajuan_sm', 'kode_pengajuan_sm', 'tgl_pengajuan_sm', 'jenis_izin_tambang', 'proses_izin_tambang', 'ket_pengajuan_sm_detail', 'stat_pengajuan_sm_detail', 'no_nik', 'nama_lengkap', 'depart', 'posisi', 'doh', 'kode_perusahaan', 'nama_perusahaan', 'tgl_buat', 'nama_user', null); //set column field database for datatable orderable
     var $column_search = array('auth_pengajuan_sm', 'kode_pengajuan_sm', 'tgl_pengajuan_sm', 'jenis_izin_tambang', 'proses_izin_tambang', 'ket_pengajuan_sm_detail', 'stat_pengajuan_sm_detail', 'no_nik', 'nama_lengkap', 'depart', 'posisi', 'doh', 'kode_perusahaan', 'nama_perusahaan', 'tgl_buat', 'nama_user',); //set column field database for datatable searchable just firstname , lastname , address are searchable
     var $order = array('tgl_pengajuan_sm' => 'desc'); // default order 

     public function __construct()
     {
          parent::__construct();
          $this->load->database();
     }

     private function _get_datatables_query($authizinmst)
     {
          $this->db->where('auth_pengajuan_sm', $authizinmst);
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

     function get_datatables($authizinmst)
     {
          $this->_get_datatables_query($authizinmst);
          if ($_POST['length'] != -1)
               $this->db->limit($_POST['length'], $_POST['start']);
          $query = $this->db->get();
          return $query->result();
     }

     function count_filtered($authizinmst)
     {
          $this->_get_datatables_query($authizinmst);
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
          $this->db->where('id_pengajuan_sm', $id);
          $query = $this->db->get();

          return $query->row();
     }
}
