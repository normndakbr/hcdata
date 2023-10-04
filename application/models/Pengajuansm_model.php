<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Pengajuansm_model extends CI_Model
{

     var $table = 'vw_pengajuan_sm';
     var $column_order = array(null,  'kode_pengajuan_sm', 'tgl_pengajuan_sm', 'jenis_izin_tambang', 'ket_pengajuan_sm', 'stat_pengajuan_sm', 'tgl_buat', 'kode_perusahaan', 'nama_m_perusahaan', 'nama_user', null); //set column field database for datatable orderable
     var $column_search = array('kode_pengajuan_sm', 'tgl_pengajuan_sm', 'jenis_izin_tambang', 'ket_pengajuan_sm', 'stat_pengajuan_sm', 'tgl_buat', 'kode_perusahaan', 'nama_m_perusahaan', 'nama_user',); //set column field database for datatable searchable just firstname , lastname , address are searchable
     var $order = array('tgl_pengajuan_sm' => 'desc'); // default order 

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
          $this->db->where('id_pengajuan_sm', $id);
          $query = $this->db->get();

          return $query->row();
     }

     public function get_sim($auth_personal)
     {
          $tglnow = date('Y-m-d');
          $this->db->from('vw_sim_karyawan');
          $this->db->where('auth_personal', $auth_personal);
          $this->db->where('tgl_exp_sim >=', $tglnow);
          $query = $this->db->get();

          return $query->result();
     }

     public function count_all_pengajuan_sm()
     {
          return $this->db->count_all_results('vw_pengajuan_sm');
     }

     public function count_all_user()
     {
          return $this->db->count_all_results('vw_user');
     }

     public function input_pengajuan_sm($data)
     {
          $this->db->insert('tb_pengajuan_sm', $data);
          if ($this->db->affected_rows() > 0) {
               return true;
          } else {
               return false;
          }
     }

     public function input_kary_pengajuan_sm($data)
     {
          $this->db->insert('tb_pengajuan_sm_detail', $data);
          if ($this->db->affected_rows() > 0) {
               return true;
          } else {
               return false;
          }
     }

     public function cek_kode($kode_pengajuan_sm)
     {
          $query = $this->db->get_where('tb_pengajuan_sm', ['kode_pengajuan_sm' => $kode_pengajuan_sm]);
          if (!empty($query->result())) {
               return true;
          } else {
               return false;
          }
     }

     public function cek_jml($auth_pengajuan_sm)
     {
          return $this->db->get_where('vw_pengajuan_sm_detail', ['auth_pengajuan_sm' => $auth_pengajuan_sm])->num_rows();
     }

     public function cek_kary($id_kary, $id_pengajuan_sm)
     {
          $this->db->from('tb_pengajuan_sm_detail');
          $this->db->where('id_karyawan', $id_kary);
          $this->db->where('id_pengajuan_sm', $id_pengajuan_sm);
          $this->db->limit(1);
          $query = $this->db->get()->row();
          if (!empty($query)) {
               return true;
          } else {
               return false;
          }
     }

     public function cek_kary_approval($id_kary)
     {
          $this->db->from('tb_pengajuan_sm_detail');
          $this->db->where('id_karyawan', $id_kary);
          $this->db->where('stat_pengajuan_sm_detail', 'F');
          $this->db->limit(1);
          $query = $this->db->get()->row();
          if (!empty($query)) {
               return true;
          } else {
               return false;
          }
     }

     public function get_kode_jenis($id_jenis_izin)
     {
          $query = $this->db->get_where('tb_jenis_izin_tambang', ['id_jenis_izin_tambang' => $id_jenis_izin]);
          if (!empty($query->result())) {
               foreach ($query->result() as $lst) {
                    $kode_jenis_izin = $lst->kode_jenis_izin_tambang;
               }

               return $kode_jenis_izin;
          } else {
               return;
          }
     }

     public function get_authsm($kode)
     {
          $query = $this->db->get_where('vw_pengajuan_sm', ['kode_pengajuan_sm' => $kode]);
          if (!empty($query->result())) {
               foreach ($query->result() as $lst) {
                    $auth_pengajuan_sm = $lst->auth_pengajuan_sm;
               }

               return $auth_pengajuan_sm;
          } else {
               return 0;
          }
     }

     public function get_id_pengajuan($auth_pengajuan_sm)
     {
          $query = $this->db->get_where('vw_pengajuan_sm', ['auth_pengajuan_sm' => $auth_pengajuan_sm]);
          if (!empty($query->result())) {
               foreach ($query->result() as $lst) {
                    $id_pengajuan_sm = $lst->id_pengajuan_sm;
               }

               return $id_pengajuan_sm;
          } else {
               return 0;
          }
     }

     public function hapus_pengajuansm($auth_pengajuan_sm)
     {
          $cek_id = $this->db->get_where('vw_pengajuan_sm', ['auth_pengajuan_sm' => $auth_pengajuan_sm]);
          if (!empty($cek_id->result())) {
               foreach ($cek_id->result() as $list) {
                    $id_pengajuan_sm = $list->id_pengajuan_sm;
                    $stat_pengajuan_sm = $list->stat_pengajuan_sm;
               }

               if ($stat_pengajuan_sm == "F") {
                    $this->db->delete('tb_pengajuan_sm', ['id_pengajuan_sm' => $id_pengajuan_sm]);
                    if ($this->db->affected_rows() > 0) {
                         $this->db->delete('tb_pengajuan_sm_detail', ['id_pengajuan_sm' => $id_pengajuan_sm]);
                         return 200;
                    } else {
                         return 201;
                    }
               } else {
                    return 203;
               }
          } else {
               return 202;
          }
     }

     public function get_pengajuan_sm_id($auth_pengajuan_sm)
     {
          $query = $this->db->get_where('vw_pengajuan_sm', ['auth_pengajuan_sm' => $auth_pengajuan_sm]);
          return $query->result();
     }

     public function edit_pengajuan_sm($kode_pengajuan_sm, $tgl_pengajuan_sm, $ket_pengajuan_sm, $status)
     {
          $id_pengajuan_sm = $this->session->userdata('id_pengajuan_sm');

          $query = $this->db->query("SELECT * FROM tb_pengajuan_sm WHERE kode_pengajuan_sm='" . $kode_pengajuan_sm . "' AND id_pengajuan_sm <> " . $id_pengajuan_sm);
          if (!empty($query->result())) {
               return 204;
          }

          $this->db->set('kode_pengajuan_sm', $kode_pengajuan_sm);
          $this->db->set('tgl_pengajuan_sm', $tgl_pengajuan_sm);
          $this->db->set('ket_pengajuan_sm', $ket_pengajuan_sm);
          $this->db->set('stat_pengajuan_sm', $status);
          $this->db->set('tgl_edit', date('Y-m-d H:i:s'));
          $this->db->where('id_pengajuan_sm', $id_pengajuan_sm);
          $this->db->update('tb_pengajuan_sm');
          if ($this->db->affected_rows() > 0) {
               return 200;
          } else {
               return 201;
          }
     }

     public function get_all()
     {
          return $this->db->get('vw_pengajuan_sm')->result();
     }

     public function get_by_authpsm($authpengajuansm)
     {
          $query = $this->db->get_where('vw_pengajuan_sm', ['auth_pengajuan_sm' => $authpengajuansm]);
          return $query->result();
     }

     public function get_by_idper($id_per)
     {
          $query = $this->db->get_where('vw_pengajuan_sm', ['id_perusahaan' => $id_per]);
          return $query->result();
     }
}
