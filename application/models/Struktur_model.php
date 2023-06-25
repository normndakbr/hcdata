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

     public function get_all_lokasi_pjo()
     {
          return $this->db->get('tb_lokasi_pjo')->result();
     }

     public function get_lokasi_pjo_byid($id_lokasi)
     {
          $query = $this->db->get_where('tb_lokasi_pjo', ['id_lokasi_pjo' => $id_lokasi])->result();
          if (!empty($query)) {
               foreach ($query as $list) {
                    $lokasi_pjo = $list->lokasi_pjo;
               }

               return $lokasi_pjo;
          } else {
               return;
          }
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
               return;
          }
     }

     public function get_by_m_authparent($idparent)
     {
          $query = $this->db->get_where('vw_m_perusahaan', ['auth_parent' => $idparent]);
          if (!empty($query->result())) {
               foreach ($query->result() as $list) {
                    $id_m_perusahaan = $list->id_m_perusahaan;
               }
               return $id_m_perusahaan;
          } else {
               return;
          }
     }

     public function get_by_m_authper($auth_m_per)
     {
          $query = $this->db->get_where('vw_m_perusahaan', ['auth_m_perusahaan' => $auth_m_per]);
          if (!empty($query->result())) {
               foreach ($query->result() as $list) {
                    $id_m_perusahaan = $list->id_m_perusahaan;
               }
               return $id_m_perusahaan;
          } else {
               return;
          }
     }

     public function get_dt_m_authper($auth_m_per)
     {
          return $this->db->get_where('vw_m_perusahaan', ['auth_m_perusahaan' => $auth_m_per])->result();
     }

     public function get_by_auth_izin($auth_iujp)
     {
          $query = $this->db->get_where('vw_izin_perusahaan', ['auth_izin_perusahaan' => $auth_iujp]);
          if (!empty($query->result())) {
               foreach ($query->result() as $list) {
                    $id_izin_perusahaan = $list->id_izin_perusahaan;
               }
               return $id_izin_perusahaan;
          } else {
               return 0;
          }
     }

     public function get_by_url_izin($auth_iujp)
     {
          $query = $this->db->get_where('vw_izin_perusahaan', ['auth_izin_perusahaan' => $auth_iujp]);
          if (!empty($query->result())) {
               foreach ($query->result() as $list) {
                    $url_izin_perusahaan = $list->url_izin_perusahaan;
               }
               return $url_izin_perusahaan;
          } else {
               return;
          }
     }


     public function get_by_auth_sio($auth_sio)
     {
          $query = $this->db->get_where('vw_sio_perusahaan', ['auth_sio_perusahaan' => $auth_sio]);
          if (!empty($query->result())) {
               foreach ($query->result() as $list) {
                    $id_sio_perusahaan = $list->id_sio_perusahaan;
               }
               return $id_sio_perusahaan;
          } else {
               return 0;
          }
     }

     public function get_by_url_sio($auth_sio)
     {
          $query = $this->db->get_where('vw_sio_perusahaan', ['auth_sio_perusahaan' => $auth_sio]);
          if (!empty($query->result())) {
               foreach ($query->result() as $list) {
                    $url_sio = $list->url_sio;
               }
               return $url_sio;
          } else {
               return;
          }
     }


     public function get_by_auth_kontrak($auth_kontrak)
     {
          $query = $this->db->get_where('vw_kontrak_perusahaan', ['auth_kontrak_perusahaan' => $auth_kontrak]);
          if (!empty($query->result())) {
               foreach ($query->result() as $list) {
                    $id_kontrak_perusahaan = $list->id_kontrak_perusahaan;
               }
               return $id_kontrak_perusahaan;
          } else {
               return 0;
          }
     }

     public function get_by_url_kontrak($auth_kontrak)
     {
          $query = $this->db->get_where('vw_kontrak_perusahaan', ['auth_kontrak_perusahaan' => $auth_kontrak]);
          if (!empty($query->result())) {
               foreach ($query->result() as $list) {
                    $url_kontrak = $list->url_doc_kontrak_perusahaan;
               }
               return $url_kontrak;
          } else {
               return;
          }
     }

     public function cek_str_per($id_parent, $id_per)
     {
          $query = $this->db->query("SELECT * FROM vw_m_perusahaan WHERE id_parent = " . $id_parent .
               " AND id_perusahaan = " . $id_per);
          return $query->result();
     }

     public function input_pjo($data)
     {
          $this->db->insert('tb_pjo_perusahaan', $data);
          if ($this->db->affected_rows() > 0) {
               return true;
          } else {
               return false;
          }
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

     public function input_sio($dtsio)
     {
          $this->db->insert('tb_sio_perusahaan', $dtsio);
          if ($this->db->affected_rows() > 0) {
               return true;
          } else {
               return false;
          }
     }

     public function input_kontrak($dtkontrak)
     {
          $this->db->insert('tb_kontrak_perusahaan', $dtkontrak);
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

     public function update_rk3l($id_m_per, $dtrk3l)
     {
          $this->db->where('id_m_perusahaan', $id_m_per);
          $this->db->update('tb_m_perusahaan', $dtrk3l);
          if ($this->db->affected_rows() > 0) {
               return 200;
          } else {
               return 201;
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

     public function update_iujp($id_iujp, $dtiujp)
     {
          $this->db->where('id_izin_perusahaan', $id_iujp);
          $this->db->update('tb_izin_perusahaan', $dtiujp);
          if ($this->db->affected_rows() > 0) {
               return 200;
          } else {
               return 201;
          }
     }

     public function update_sio($id_sio, $dtsio)
     {
          $this->db->where('id_sio_perusahaan', $id_sio);
          $this->db->update('tb_sio_perusahaan', $dtsio);
          if ($this->db->affected_rows() > 0) {
               return 200;
          } else {
               return 201;
          }
     }

     public function update_kontrak($id_kontrak, $dtkontrak)
     {
          $this->db->where('id_kontrak_perusahaan', $id_kontrak);
          $this->db->update('tb_kontrak_perusahaan', $dtkontrak);
          if ($this->db->affected_rows() > 0) {
               return 200;
          } else {
               return 201;
          }
     }

     public function update_pjo($id_pjo, $dtpjo)
     {
          $this->db->where('id_pjo_perusahaan', $id_pjo);
          $this->db->update('tb_pjo_perusahaan', $dtpjo);
          if ($this->db->affected_rows() > 0) {
               return 200;
          } else {
               return 201;
          }
     }

     public function jml_pjo($auth_m_per)
     {
          $this->db->where('auth_m_perusahaan', $auth_m_per);
          $this->db->from('vw_pjo_perusahaan');
          return $this->db->count_all_results();
     }

     public function hapus_pjo($id_pjo)
     {
          $this->db->where('id_pjo_perusahaan', $id_pjo);
          $this->db->delete('tb_pjo_perusahaan', ['id_pjo_perusahaan' => $id_pjo]);
          if ($this->db->affected_rows() > 0) {
               return 200;
          } else {
               return 201;
          }
     }

     public function hapus_str_per($id_m_per)
     {
          $kary = $this->db->get_where('vw_karyawan', ['id_m_perusahaan' => $id_m_per])->result();
          if (!empty($kary)) {
               return 202;
          } else {
               $this->db->where('id_m_perusahaan', $id_m_per);
               $this->db->delete('tb_m_perusahaan', ['id_m_perusahaan' => $id_m_per]);
               if ($this->db->affected_rows() > 0) {
                    return 200;
               } else {
                    return 201;
               }
          }
     }

     public function get_by_auth_pjo($auth_pjo)
     {
          $query = $this->db->get_where('vw_pjo_perusahaan', ['auth_pjo_perusahaan' => $auth_pjo]);
          if (!empty($query->result())) {
               foreach ($query->result() as $list) {
                    $id_pjo_perusahaan = $list->id_pjo_perusahaan;
               }
               return $id_pjo_perusahaan;
          } else {
               return 0;
          }
     }

     public function get_by_url_pjo($auth_pjo)
     {
          $query = $this->db->get_where('vw_pjo_perusahaan', ['auth_pjo_perusahaan' => $auth_pjo]);
          if (!empty($query->result())) {
               foreach ($query->result() as $list) {
                    $url_pjo_perusahaan = $list->url_pjo_perusahaan;
               }
               return $url_pjo_perusahaan;
          } else {
               return;
          }
     }

     public function get_by_dt_pjo($auth_pjo)
     {
          return $this->db->get_where('vw_pjo_perusahaan', ['auth_pjo_perusahaan' => $auth_pjo])->result();
     }

     public function last_row_authpjo()
     {
          $this->db->select("*");
          $this->db->from("vw_pjo_perusahaan");
          $this->db->limit(1);
          $this->db->order_by('id_pjo_perusahaan', "DESC");
          $query = $this->db->get()->result();

          if (!empty($query)) {
               foreach ($query as $list) {
                    $auth_pjo_perusahaan = $list->auth_pjo_perusahaan;
               }

               return $auth_pjo_perusahaan;
          } else {
               return 0;
          }
     }

     public function tabel_pjo($id_m_per)
     {
          if ($id_m_per !== "") {
               $query = $this->db->get_where('vw_pjo_perusahaan', ['id_m_perusahaan' => $id_m_per]);
               return $query->result();
          } else {
               return 0;
          }
     }

     public function get_id_per($auth_m_per)
     {
          $query = $this->db->get_where('vw_m_perusahaan', ['auth_m_perusahaan' => $auth_m_per])->result();
          if (!empty($query)) {
               foreach ($query as $list) {
                    $id_m_perusahaan = $list->id_m_perusahaan;
               }

               return $id_m_perusahaan;
          } else {
               return 0;
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
          $this->db->from("vw_m_perusahaan");
          $this->db->limit(1);
          $this->db->order_by('id_m_perusahaan', "DESC");
          $query = $this->db->get()->result();

          if (!empty($query)) {
               foreach ($query as $list) {
                    $auth_m_perusahaan = $list->auth_m_perusahaan;
               }

               return $auth_m_perusahaan;
          } else {
               return 0;
          }
     }

     public function last_row_idiujp()
     {
          $this->db->select("*");
          $this->db->from("vw_izin_perusahaan");
          $this->db->limit(1);
          $this->db->order_by('id_izin_perusahaan', "DESC");
          $query = $this->db->get()->result();

          if (!empty($query)) {
               foreach ($query as $list) {
                    $auth_izin_perusahaan = $list->auth_izin_perusahaan;
               }

               return $auth_izin_perusahaan;
          } else {
               return 0;
          }
     }

     public function last_row_idsio()
     {
          $this->db->select("*");
          $this->db->from("vw_sio_perusahaan");
          $this->db->limit(1);
          $this->db->order_by('id_sio_perusahaan', "DESC");
          $query = $this->db->get()->result();

          if (!empty($query)) {
               foreach ($query as $list) {
                    $auth_sio = $list->auth_sio_perusahaan;
               }

               return $auth_sio;
          } else {
               return 0;
          }
     }

     public function last_row_idkontrak()
     {
          $this->db->select("*");
          $this->db->from("vw_kontrak_perusahaan");
          $this->db->limit(1);
          $this->db->order_by('id_kontrak_perusahaan', "DESC");
          $query = $this->db->get()->result();

          if (!empty($query)) {
               foreach ($query as $list) {
                    $auth_kontrak = $list->auth_kontrak_perusahaan;
               }

               return $auth_kontrak;
          } else {
               return 0;
          }
     }

     function getMaster($parent, $hasil)
     {

          if ($parent !== 0) {
               $n = $this->db->query("SELECT * from vw_m_perusahaan where id_m_perusahaan=" . $parent);
               foreach ($n->result() as $h) {
                    if ($h->id_parent == 0) {
                         $nm_per = "";
                    } else {
                         $nm_per = " | " . $h->kode_perusahaan;
                    }
               }
          } else {
               $nm_per = "";
          }

          $w = $this->db->query("SELECT * from vw_m_perusahaan where id_m_perusahaan=" . $parent);

          foreach ($w->result() as $h) {
               $hasil .= "<option value='" . $h->auth_m_perusahaan . "'>" . $h->nama_m_perusahaan . $nm_per . "</option>";
          }

          return $hasil;
     }

     function getMenu($parent, $hasil)
     {

          static $space;

          $w = $this->db->query("SELECT * from vw_m_perusahaan where id_parent='" . $parent . "'");
          if (($w->num_rows()) > 0) {
               $space .= "&roarr;";
          }

          foreach ($w->result() as $h) {

               if ($h->id_parent == 0) {
                    $hasil .= "<option value='" . $h->auth_m_perusahaan . "'>" . $h->nama_m_perusahaan . "</option>";
               } else {
                    $n = $this->db->query("SELECT * from vw_m_perusahaan where id_m_perusahaan=" . $h->id_parent);
                    if (!empty($n->result())) {
                         foreach ($n->result() as $n) {
                              $nm_per = " | " . $n->kode_perusahaan;
                         }
                    } else {
                         $nm_per = "";
                    }

                    $hasil .= "<option value='" . $h->auth_m_perusahaan . "'>" . $space . " " . $h->nama_m_perusahaan .  $nm_per . "</option>";
               }

               $hasil = $this->getMenu($h->id_m_perusahaan, $hasil);
          }
          if (($w->num_rows()) > 0) {
               $space = substr($space, 0, strlen($space) - 7);
          }

          return $hasil;
     }

     public function get_detail_m_per($auth_m_per)
     {
          return $this->db->get_where('vw_m_perusahaan', ['auth_m_perusahaan' => $auth_m_per])->result();
     }

     public function get_nama_per_utama($auth_m_per)
     {
          $query = $this->db->get_where('vw_m_perusahaan', ['auth_m_perusahaan' => $auth_m_per])->result();
          if (!empty($query)) {
               foreach ($query as $list) {
                    $id_parent = $list->id_parent;
               }

               $query = $this->db->get_where('vw_m_perusahaan', ['id_m_perusahaan' => $id_parent])->result();
               if (!empty($query)) {
                    foreach ($query as $list) {
                         $nama_perusahaan = $list->nama_perusahaan;
                         $kode_perusahaan = $list->kode_perusahaan;
                    }

                    return  $nama_perusahaan . " | " . $kode_perusahaan;
               } else {
                    return;
               }
          } else {
               return;
          }
     }
}
