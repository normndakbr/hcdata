<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Karyawan_model extends CI_Model
{
    var $table = 'vw_kry';
    var $column_order = array(null, 'no_nik', 'nama_lengkap', 'depart', 'posisi', 'kode_perusahaan', 'nama_perusahaan', 'tgl_buat', null); //set column field database for datatable orderable
    var $column_search = array('no_nik', 'nama_lengkap', 'depart', 'posisi', 'kode_perusahaan', 'nama_perusahaan', 'tgl_buat',); //set column field database for datatable searchable just firstname , lastname , address are searchable
    var $order = array('depart' => 'asc'); // default order 

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    private function _get_datatables_query($auth_m_per, $ck)
    {
        $id_m_perusahaan = $this->prs->get_m_by_auth($auth_m_per, $ck);
        if (empty($id_m_perusahaan)) {
            $id_m_perusahaan = 0;
        }

        $this->db->where('id_m_perusahaan', $id_m_perusahaan);
        if ($ck == 0) {
            $this->db->where('tgl_nonaktif', null);
        }
        $this->db->from($this->table);
        $this->db->order_by('id_m_perusahaan', 'ASC');

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

    function get_datatables($auth_m_per, $ck)
    {
        if ($_POST['length'] != -1) {
            $this->_get_datatables_query($auth_m_per, $ck);
            $this->db->limit($_POST['length'], $_POST['start']);
        }
        $query = $this->db->get();
        return $query->result();
    }

    function count_filtered($auth_m_per, $ck)
    {
        $this->_get_datatables_query($auth_m_per, $ck);
        $query = $this->db->get();
        return $query->num_rows();
    }

    public function count_all()
    {
        $this->db->from($this->table);
        return $this->db->count_all_results();
    }

    public function get_alamat_by_id($id)
    {
        $this->db->from('vw_alamat_karyawan');
        $this->db->where('id_kary', $id);
        $this->db->where('stat_alamat_ktp', 'T');
        $query = $this->db->get();

        return $query->row();
    }

    public function get_alamat_by_id_person($id_personal)
    {
        $this->db->from('vw_alamat_karyawan');
        $this->db->where('id_personal', $id_personal);
        $this->db->where('stat_alamat_ktp', 'T');
        $query = $this->db->get();

        return $query->result();
    }

    public function get_by_id($id)
    {
        $this->db->from($this->table);
        $this->db->where('id_kary', $id);
        $query = $this->db->get();

        return $query->row();
    }

    public function get_by_auth($auth_karyawan)
    {
        $this->db->from('vw_karyawan');
        $this->db->where('auth_karyawan', $auth_karyawan);
        $query = $this->db->get();

        return $query->row();
    }

    public function get_kary_by_auth_m_per($auth_m_per)
    {
        $this->db->select('no_nik, no_ktp, nama_lengkap, depart, auth_m_perusahaan, auth_karyawan, auth_m_perusahaan',);
        $this->db->from('vw_karyawan');
        $this->db->where('auth_m_perusahaan', $auth_m_per);
        $query = $this->db->get();
        return $query->result();
    }

    public function get_alamat_by_auth($auth_karyawan)
    {
        $this->db->from('vw_alamat_karyawan');
        $this->db->where('auth_karyawan', $auth_karyawan);
        $query = $this->db->get()->result();

        if (!empty($query)) {
            foreach ($query as $list) {
                if ($list->rt_ktp != "") {
                    $rt = ", RT. " . $list->rt_ktp;
                } else {
                    $rt = "";
                }

                if ($list->rw_ktp != "") {
                    $rw = ", RW. " . $list->rw_ktp;
                } else {
                    $rw = "";
                }

                $alamat = $list->alamat_ktp . $rt . $rw . " KEL. " . $list->kel . ", KEC. " . $list->kec . ", " . $list->kab . " - " . $list->prov;
            }

            return $alamat;
        } else {
            return;
        }
    }

    public function get_edit_alamat_by_auth($auth_karyawan)
    {
        $this->db->from('vw_alamat_karyawan');
        $this->db->where('auth_karyawan', $auth_karyawan);
        $query = $this->db->get();
        return $query->row();
    }

    public function get_izin_by_auth($auth_karyawan)
    {
        $this->db->from('vw_izin_tambang');
        $this->db->where('auth_karyawan', $auth_karyawan);
        $query = $this->db->get();

        return $query->row();
    }

    public function get_sim_by_auth($auth_personal)
    {

        $this->db->from('vw_sim_karyawan');
        $this->db->where('auth_personal', $auth_personal);
        $query = $this->db->get();

        return $query->row();
    }

    public function get_izin_unit_by_auth($auth_karyawan)
    {
        $this->db->from('vw_izin_unit');
        $this->db->where('auth_karyawan', $auth_karyawan);
        $query = $this->db->get();

        return $query->result();
    }

    public function get_sertifikasi_by_auth($auth_karyawan)
    {
        $query = $this->db->get_where('vw_karyawan', ['auth_karyawan' => $auth_karyawan])->result();
        if (!empty($query)) {
            foreach ($query as $list) {
                $id_personal = $list->id_personal;
            }
        } else {
            $id_personal = "";
        }

        $this->db->from('vw_sertifikasi');
        $this->db->where('id_personal', $id_personal);
        $query = $this->db->get();
        return $query->result();
    }

    public function get_mcu_by_auth($auth_karyawan)
    {
        $query = $this->db->get_where('vw_karyawan', ['auth_karyawan' => $auth_karyawan])->result();
        if (!empty($query)) {
            foreach ($query as $list) {
                $id_personal = $list->id_personal;
            }
        } else {
            $id_personal = "";
        }

        $this->db->from('vw_mcu');
        $this->db->where('id_personal', $id_personal);
        $this->db->order_by('tgl_mcu', 'DESC');
        $query = $this->db->get();

        if (!empty($query->result())) {
            return $query->result();
        } else {
            return;
        }
    }

    public function get_resident()
    {
        return $this->db->get('tb_stat_tinggal')->result();
    }

    public function get_mcu_by_authmcu($auth_mcu)
    {
        $query = $this->db->get_where('vw_mcu', ['auth_mcu' => $auth_mcu])->result();
        return $query;
    }

    public function get_mcu_by_authmcu_one($auth_mcu)
    {
        $query = $this->db->get_where('vw_mcu', ['auth_mcu' => $auth_mcu])->row();
        return $query;
    }

    public function get_vaksin_by_auth($auth_karyawan)
    {
        $query = $this->db->get_where('vw_karyawan', ['auth_karyawan' => $auth_karyawan])->result();
        if (!empty($query)) {
            foreach ($query as $list) {
                $id_personal = $list->id_personal;
            }
        } else {
            $id_personal = "";
        }
        $this->db->from('tb_vaksin_kary');
        $this->db->where('id_personal', $id_personal);
        $query = $this->db->get()->result();

        if (!empty($query)) {
            $this->db->from('vw_vaksin_kary');
            $this->db->where('id_personal', $id_personal);
            $this->db->order_by('tgl_vaksin', 'ASC');
            $query = $this->db->get();

            return $query->result();
        } else {
            return;
        }
    }

    public function get_kontrak_by_auth($auth_karyawan)
    {
        $this->db->from('vw_kontrak_karyawan');
        $this->db->where('auth_karyawan', $auth_karyawan);
        $this->db->order_by('tgl_akhir', 'DESC');
        $this->db->limit(1);
        return $this->db->get()->row();
    }

    public function get_id_vaksin_by_auth($auth_vaksin)
    {
        $query = $this->db->get_where('vw_vaksin', ['auth_vaksin' => $auth_vaksin])->result();
        return $query;
    }

    public function get_id_kontrak_by_auth($auth_kontrak_kary)
    {
        $query = $this->db->get_where('vw_kontrak_karyawan', ['auth_kontrak_kary' => $auth_kontrak_kary])->result();
        return $query;
    }

    public function count_all_karyawan()
    {
        return $this->db->count_all_results('vw_karyawan');
    }

    public function count_all_user()
    {
        return $this->db->count_all_results('vw_user');
    }

    // input baru data personal karyawan
    public function input_dtPersonal($data)
    {
        $this->db->insert('tb_personal', $data);
        if ($this->db->affected_rows() > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function input_dtKaryawan($data)
    {
        $this->db->insert('tb_karyawan', $data);
        if ($this->db->affected_rows() > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function hapus_karyawan($auth_kary)
    {

        $dtkary = $this->get_by_auth($auth_kary);

        if (!empty($dtkary)) {
            $idkaryawan = $dtkary->id_kary;
            $idpersonal = $dtkary->id_personal;
            $foldername = md5($idpersonal);

            if (!empty($idkaryawan)) {
                $this->db->delete('tb_karyawan', ['id_kary' => $idkaryawan]);

                $this->db->from('tb_izin_tambang');
                $this->db->where('id_kary', $idkaryawan);
                $query = $this->db->get()->result();
                if (!empty($query)) {
                    foreach ($query as $lst) {
                        $this->db->delete('tb_izin_tambang_unit', ['id_izin_tambang' => $lst->id_izin_tambang]);
                    }
                }

                $this->db->delete('tb_kontrak_karyawan', ['id_kary' => $idkaryawan]);
                $this->db->delete('tb_izin_tambang', ['id_kary' => $idkaryawan]);
            }


            if (!empty($idpersonal)) {
                $this->db->delete('tb_alamat_ktp', ['id_personal' => $idpersonal]);
                $this->db->delete('tb_vaksin_kary', ['id_personal' => $idpersonal]);

                //=-========== mcu ==================
                $this->db->from('tb_mcu');
                $this->db->where('id_personal', $idpersonal);
                $query = $this->db->get()->result();
                if (!empty($query)) {
                    foreach ($query as $lst) {
                        $nama_file = $lst->url_file;
                        if (is_file("assets/berkas/karyawan/" . $foldername . "/" . $nama_file)) {
                            unlink("assets/berkas/karyawan/" . $foldername . "/" . $nama_file);
                        }
                    }

                    $this->db->delete('tb_mcu', ['id_personal' => $idpersonal]);
                }

                ///=-========== simpol ==================
                $this->db->from('tb_sim_karyawan');
                $this->db->where('id_personal', $idpersonal);
                $query = $this->db->get()->result();
                if (!empty($query)) {
                    foreach ($query as $lst) {
                        $nama_file = $lst->url_file;
                        if (is_file("assets/berkas/karyawan/" . $foldername . "/" . $nama_file)) {
                            unlink("assets/berkas/karyawan/" . $foldername . "/" . $nama_file);
                        }
                    }

                    $this->db->delete('tb_sim_karyawan', ['id_personal' => $idpersonal]);
                }

                ///=-========== sertifikasi ==================
                $this->db->from('tb_sertifikasi_kary');
                $this->db->where('id_personal', $idpersonal);
                $query = $this->db->get()->result();
                if (!empty($query)) {
                    foreach ($query as $lst) {
                        $nama_file = $lst->file_sertifikasi;
                        if (is_file("assets/berkas/karyawan/" . $foldername . "/" . $nama_file)) {
                            unlink("assets/berkas/karyawan/" . $foldername . "/" . $nama_file);
                        }
                    }

                    $this->db->delete('tb_sertifikasi_kary', ['id_personal' => $idpersonal]);
                }

                ///=-========== personal ==================
                $this->db->from('tb_personal');
                $this->db->where('id_personal', $idpersonal);
                $query = $this->db->get()->result();
                if (!empty($query)) {
                    foreach ($query as $lst) {
                        $nama_file = $lst->url_pendukung;
                        if (is_file("assets/berkas/karyawan/" . $foldername . "/" . $nama_file)) {
                            unlink("assets/berkas/karyawan/" . $foldername . "/" . $nama_file);
                        }
                    }

                    $this->db->delete('tb_personal', ['id_personal' => $idpersonal]);
                }

                if ($this->db->affected_rows() > 0) {
                    return 200;
                } else {
                    return 201;
                }
            }
        } else {
            return 202;
        }
    }

    function getKaryawan($postData)
    {
        $response = array();
        $auth_m_per = $postData['auth_m_per'];
        // $id_per = $this->prs->get_idp_by_auth($auth_m_per);
        if (isset($postData['search'])) {
            $records = $this->db->query("SELECT auth_karyawan, auth_m_perusahaan, no_ktp, no_nik, nama_lengkap, depart FROM vw_karyawan WHERE auth_m_perusahaan = '" . $auth_m_per .
                "' AND tgl_nonaktif is null AND (no_ktp LIKE '%" . $postData['search'] .
                "%' OR no_nik like '%" . $postData['search'] .
                "%' OR nama_lengkap like '%" . $postData['search'] . "%') ORDER BY nama_lengkap ASC")->result();
            foreach ($records as $row) {
                $response[] = array(
                    "value" => $row->auth_karyawan,
                    "ktp" => $row->no_ktp,
                    "nik" => $row->no_nik,
                    "nama" => $row->nama_lengkap,
                    "depart" => $row->depart,
                    "label" => $row->no_ktp . " | " . $row->nama_lengkap . " | " . $row->no_nik . " | " . $row->depart
                );
            }
        }
        return $response;
    }

    public function input_dtKontrak($data)
    {
        $this->db->insert('tb_kontrak_karyawan', $data);
        if ($this->db->affected_rows() > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function input_dtAlamat($data)
    {
        $this->db->insert('tb_alamat_ktp', $data);
        if ($this->db->affected_rows() > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function input_dtEC($data)
    {
        $this->db->insert('tb_ec', $data);
        if ($this->db->affected_rows() > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function input_dtPekerjaan($data)
    {
        $this->db->insert('tb_pekerjaan', $data);
        if ($this->db->affected_rows() > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function input_dtMCU($data)
    {
        $this->db->insert('tb_mcu', $data);
        if ($this->db->affected_rows() > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function get_stat_kerja($stat_kerja)
    {
        $query = $this->db->get_where('tb_stat_perjanjian', ['id_stat_perjanjian' => $stat_kerja]);
        return $query->result();
    }

    public function get_all_tipe()
    {
        return $this->db->get('tb_tipe')->result();
    }

    public function get_all_jenis_mcu()
    {
        return $this->db->get('tb_mcu_jenis')->result();
    }

    public function last_row_personal()
    {
        $this->db->select("*");
        $this->db->from("vw_personal");
        $this->db->limit(1);
        $this->db->order_by('tgl_buat', "DESC");
        $query = $this->db->get()->result();

        if (!empty($query)) {
            foreach ($query as $list) {
                $auth_personal = $list->auth_personal;
            }

            return $auth_personal;
        } else {
            return 0;
        }
    }

    public function last_row_kontrak($id_kary)
    {
        $this->db->select("*");
        $this->db->from("vw_kontrak_karyawan");
        $this->db->where("id_kary", $id_kary);
        $this->db->limit(1);
        $this->db->order_by('id_kontrak_kary', "DESC");
        $query = $this->db->get()->row();

        if (!empty($query)) {
            return $query->auth_kontrak_kary;
        } else {
            return 0;
        }
    }

    public function last_row_id_personal()
    {
        $this->db->select("*");
        $this->db->from("vw_personal");
        $this->db->limit(1);
        $this->db->order_by('id_personal', "DESC");
        $query = $this->db->get()->result();

        if (!empty($query)) {
            foreach ($query as $list) {
                $id_personal = $list->id_personal;
            }

            return $id_personal;
        } else {
            return 0;
        }
    }

    public function last_row_alamat($auth_person)
    {
        $query = $this->db->get_where('vw_alamat_karyawan', ['auth_personal' => $auth_person])->result();

        if (!empty($query)) {
            foreach ($query as $list) {
                $auth_alamat = $list->auth_alamat;
            }

            return $auth_alamat;
        } else {
            return 0;
        }
    }

    public function last_row_ec()
    {
        $this->db->select("*");
        $this->db->from("tb_ec");
        $this->db->limit(1);
        $this->db->order_by('id_ec', "DESC");
        $query = $this->db->get()->result();

        if (!empty($query)) {
            foreach ($query as $list) {
                $id_ec = $list->id_ec;
            }

            return $id_ec;
        } else {
            return 0;
        }
    }

    public function last_row_idkary()
    {
        $this->db->select("*");
        $this->db->from("vw_karyawan");
        $this->db->limit(1);
        $this->db->order_by('id_kary', "DESC");
        $query = $this->db->get()->result();

        if (!empty($query)) {
            foreach ($query as $list) {
                $id_karyawan = $list->id_kary;
            }

            return $id_karyawan;
        } else {
            return;
        }
    }

    public function last_row_authkary($auth_person)
    {
        $this->db->select('auth_karyawan, tgl_buat, auth_personal');
        $this->db->from('vw_karyawan');
        $this->db->where('auth_personal', $auth_person);
        $this->db->order_by('tgl_buat', 'DESC');
        $this->db->limit(1);
        $query = $this->db->get()->row();

        if (!empty($query)) {
            return $query->auth_karyawan;
        } else {
            return;
        }
    }

    public function get_id_personal($auth_person)
    {
        $query = $this->db->get_where('vw_personal', ['auth_personal' => $auth_person])->result();

        if (!empty($query)) {
            foreach ($query as $list) {
                $id_personal = $list->id_personal;
            }

            return $id_personal;
        } else {
            return;
        }
    }

    public function get_id_personal_by_kary($auth_kary)
    {
        $query = $this->db->get_where('vw_kry', ['auth_karyawan' => $auth_kary])->result();

        if (!empty($query)) {
            foreach ($query as $list) {
                $id_personal = $list->id_personal;
            }

            return $id_personal;
        } else {
            return;
        }
    }

    public function get_personal_by_auth($auth_person)
    {
        $query = $this->db->get_where('vw_personal', ['auth_personal' => $auth_person])->result();
        return $query;
    }

    public function get_id_izin($auth_izin)
    {
        $query = $this->db->get_where('vw_izin_tambang', ['auth_izin_tambang' => $auth_izin])->result();

        if (!empty($query)) {
            foreach ($query as $list) {
                $id_izin = $list->id_izin_tambang;
            }

            return $id_izin;
        } else {
            return;
        }
    }

    public function get_id_alamat($auth_person)
    {
        $query = $this->db->get_where('vw_alamat_karyawan', ['auth_personal' => $auth_person])->result();

        if (!empty($query)) {
            foreach ($query as $list) {
                $id_alamat_ktp = $list->id_alamat_ktp;
            }

            return $id_alamat_ktp;
        } else {
            return;
        }
    }

    public function get_id_karyawan($auth_kary)
    {
        $query = $this->db->get_where('vw_karyawan', ['auth_karyawan' => $auth_kary])->result();

        if (!empty($query)) {
            foreach ($query as $list) {
                $id_karyawan = $list->id_kary;
            }

            return $id_karyawan;
        } else {
            return;
        }
    }


    public function get_id_mcu($auth_person)
    {
        $query = $this->db->get_where('vw_mcu', ['auth_personal' => $auth_person])->result();

        if (!empty($query)) {
            foreach ($query as $list) {
                $id_mcu = $list->id_mcu;
            }

            return $id_mcu;
        } else {
            return;
        }
    }

    public function get_dt_mcu($auth_mcu)
    {
        return $this->db->get_where('vw_mcu', ['auth_mcu' => $auth_mcu])->result();
    }

    public function hapus_mcu($auth_mcu)
    {

        $cek_id = $this->db->get_where('vw_mcu', ['auth_mcu' => $auth_mcu])->result();
        if (!empty($cek_id)) {
            foreach ($cek_id as $list) {
                $id_mcu = $list->id_mcu;
            }

            $this->db->delete('tb_mcu', ['id_mcu' => $id_mcu]);
            if ($this->db->affected_rows() > 0) {
                return 200;
            } else {
                return 201;
            }
        } else {
            return 202;
        }
    }

    public function update_filependukung($auth_person, $dtpersonal)
    {

        $cek_id = $this->db->get_where('vw_personal', ['auth_personal' => $auth_person])->result();
        if (!empty($cek_id)) {
            foreach ($cek_id as $list) {
                $id_personal = $list->id_personal;
            }


            $this->db->where('id_personal', $id_personal);
            $this->db->update('tb_personal', $dtpersonal);
            return 200;
        } else {
            return 202;
        }
    }

    public function hapus_vaksin($auth_vaksin)
    {

        $cek_id = $this->db->get_where('vw_vaksin_kary', ['auth_vaksin' => $auth_vaksin])->result();
        if (!empty($cek_id)) {
            foreach ($cek_id as $list) {
                $id_vaksin = $list->id_vaksin;
            }

            $this->db->delete('tb_vaksin_kary', ['id_vaksin' => $id_vaksin]);
            if ($this->db->affected_rows() > 0) {
                return 200;
            } else {
                return 201;
            }
        } else {
            return 202;
        }
    }

    public function last_row_authmcu()
    {
        $this->db->select("*");
        $this->db->from("vw_mcu");
        $this->db->limit(1);
        $this->db->order_by('id_mcu', "DESC");
        $query = $this->db->get()->result();

        if (!empty($query)) {
            foreach ($query as $list) {
                $auth_mcu = $list->auth_mcu;
            }

            return $auth_mcu;
        } else {
            return;
        }
    }

    public function last_row_sertifikat()
    {
        $this->db->select("*");
        $this->db->from("tb_sertifikasi_kary");
        $this->db->limit(1);
        $this->db->order_by('id_sertifikasi', "DESC");
        $query = $this->db->get()->result();

        if (!empty($query)) {
            foreach ($query as $list) {
                $id_sertifikasi = $list->id_sertifikasi;
            }

            return $id_sertifikasi;
        } else {
            return;
        }
    }

    public function update_mcu($id_mcu, $hasilmcu)
    {
        $this->db->where('id_mcu', $id_mcu);
        $this->db->update('tb_mcu', $hasilmcu);
        if ($this->db->affected_rows() > 0) {
            return 200;
        } else {
            return 201;
        }
    }

    public function update_sim($id_sim_kary, $dtsimper)
    {
        $this->db->where('id_sim_kary', $id_sim_kary);
        $this->db->update('tb_sim_karyawan', $dtsimper);
    }

    public function update_simper($id_izin, $dtizin)
    {
        $this->db->where('id_izin_tambang', $id_izin);
        $this->db->update('tb_izin_tambang', $dtizin);
    }

    public function update_dtPersonal($idpersonal, $dt_personal)
    {
        $query1 = $this->db->where('id_personal', $idpersonal);
        $query2 = $this->db->update('tb_personal', $dt_personal);

        if ($query1 && $query2) {
            return true;
        } else {
            return false;
        }
    }

    public function update_dtAlamat($id_alamat, $data_al)
    {
        $query1 = $this->db->where('id_alamat_ktp', $id_alamat);
        $query2 = $this->db->update('tb_alamat_ktp', $data_al);

        if ($query1 && $query2) {
            return true;
        } else {
            return false;
        }
    }

    public function update_dtkary($idkaryawan, $data_kry)
    {
        $this->db->where('id_kary', $idkaryawan);
        $this->db->update('tb_karyawan', $data_kry);
    }

    public function update_dtkontrak($id_kontrak, $data_kontrak)
    {
        $this->db->where('id_kontrak_kary', $id_kontrak);
        $this->db->update('tb_kontrak_karyawan', $data_kontrak);
    }

    public function get_pendidikan()
    {
        return $this->db->get('tb_pendidikan')->result();
    }

    public function get_agama()
    {
        return $this->db->get('tb_agama')->result();
    }

    public function get_stat_nikah()
    {
        return $this->db->get('tb_stat_nikah')->result();
    }

    public function get_sim()
    {
        return $this->db->get('tb_sim')->result();
    }

    public function cek_personal($auth_person)
    {
        $query = $this->db->get_where('vw_personal', ['auth_personal' => $auth_person])->result();
        if (!empty($query)) {
            return true;
        } else {
            return false;
        }
    }

    public function cek_mcu($auth_mcu)
    {
        $query = $this->db->get_where('vw_mcu', ['auth_mcu' => $auth_mcu])->result();
        if (!empty($query)) {
            return true;
        } else {
            return false;
        }
    }

    public function cek_noKTP($noktp)
    {
        $query = $this->db->get_where('tb_personal', ['no_ktp' => $noktp])->result();
        if (!empty($query)) {
            return true;
        } else {
            return false;
        }
    }

    public function cek_nik($no_nik, $id_per)
    {
        $cekdata = array(
            'no_nik' => $no_nik,
            'id_perusahaan' => $id_per
        );

        $query = $this->db->get_where('vw_karyawan', $cekdata)->result();
        if (!empty($query)) {
            return true;
        } else {
            return false;
        }
    }

    public function cek_noKK($nokk)
    {
        $query = $this->db->get_where('tb_personal', ['no_kk' => $nokk])->result();
        if (!empty($query)) {
            return true;
        } else {
            return false;
        }
    }

    public function cek_no_simper($no_reg)
    {
        $query = $this->db->get_where('tb_izin_tambang', ['no_reg' => $no_reg])->result();
        if (!empty($query)) {
            return true;
        } else {
            return false;
        }
    }

    public function verifikasi_ktp($noktp)
    {
        $query = $this->db->get_where('tb_personal', ['no_ktp' => $noktp])->row();
        if (!empty($query)) {
            $id_personal = $query->id_personal;

            $this->db->from('vw_karyawan');
            $this->db->where('id_personal', $id_personal);
            $this->db->order_by('doh', 'DESC');
            $this->db->limit(1);
            $query = $this->db->get()->row();

            if (!empty($query)) {
                return $query;
            } else {
                return;
            }
        } else {
            return;
        }
    }

    public function get_personal_by_ktp($noktp)
    {
        $query = $this->db->get_where('vw_personal', ['no_ktp' => $noktp], 1)->row();
        if (!empty($query)) {
            return $query;
        } else {
            return;
        }
    }

    public function get_karyawan_by_ktp($noktp)
    {
        $this->db->from('vw_karyawan');
        $this->db->where('no_ktp', $noktp);
        $this->db->order_by('doh', 'DESC');
        $this->db->limit(1);
        $query = $this->db->get()->row();
        if (!empty($query)) {
            return $query;
        } else {
            return;
        }
    }

    function get_stat_janji($stat_kerja)
    {
        $query  = $this->db->get_where('tb_stat_perjanjian', ['id_stat_perjanjian' => $stat_kerja])->result();
        if (!empty($query)) {
            foreach ($query as $list) {
                $stat_waktu = $list->stat_waktu;
            }

            return $stat_waktu;
        } else {
            return 0;
        }
    }

    public function hapus_depart($auth_depart)
    {
        $cek_id = $this->db->get_where('vw_depart', ['auth_depart' => $auth_depart])->result();
        if (!empty($cek_id)) {
            foreach ($cek_id as $list) {
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

        $id_perusahaan = $this->session->userdata('id_perusahaan_hcdata');
        $id_depart = $this->session->userdata('id_depart_hcdata');

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
        return $this->db->get('vw_karyawan')->result();
    }

    public function get_by_idper($id_per)
    {
        $query = $this->db->get_where('vw_karyawan', ['id_perusahaan' => $id_per]);
        return $query->result();
    }

    public function get_by_authper($auth_per)
    {
        $query = $this->db->get_where('vw_karyawan', ['auth_perusahaan' => $auth_per]);
        return $query->result();
    }

    public function cek_update_noKK($nokk)
    {
        $query = $this->db->get_where('tb_personal', ['no_kk' => $nokk]);
        // print_r($query->result());
        if ($query->num_rows() > 1) {
            return true;
        } else {
            return false;
        }
    }

    public function cek_update_noKTP($noktp)
    {
        $query = $this->db->get_where('tb_personal', ['no_ktp' => $noktp]);
        // print_r($query->result());
        // print_r(count($query->result()));
        // print_r($query->num_rows());
        if ($query->num_rows() > 1) {
            return true;
        } else {
            return false;
        }
    }
}
