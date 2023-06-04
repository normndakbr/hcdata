<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Karyawan_model extends CI_Model
{
    var $table = 'vw_karyawan';
    var $column_order = array(null, 'nama_lengkap', 'depart', 'section', 'posisi', 'tgl_buat', null); //set column field database for datatable orderable
    var $column_search = array('nama_lengkap', 'depart', 'section', 'posisi', 'tgl_buat',); //set column field database for datatable searchable just firstname , lastname , address are searchable
    var $order = array('nama_lengkap' => 'asc'); // default order 

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
        if ($_POST['length'] != -1) {
            $this->_get_datatables_query();
            $this->db->limit($_POST['length'], $_POST['start']);
        }
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

    public function get_alamat_by_id($id)
    {
        $this->db->from('vw_alamat_karyawan');
        $this->db->where('id_kary', $id);
        $query = $this->db->get();

        return $query->row();
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
        $this->db->from($this->table);
        $this->db->where('auth_karyawan', $auth_karyawan);
        $query = $this->db->get();

        return $query->row();
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
        $this->db->from("tb_personal");
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

    public function last_row_alamat()
    {
        $this->db->select("*");
        $this->db->from("tb_alamat_ktp");
        $this->db->limit(1);
        $this->db->order_by('id_alamat_ktp', "DESC");
        $query = $this->db->get()->result();

        if (!empty($query)) {
            foreach ($query as $list) {
                $id_alamat_ktp = $list->id_alamat_ktp;
            }

            return $id_alamat_ktp;
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
        $this->db->from("tb_karyawan");
        $this->db->limit(1);
        $this->db->order_by('id_kary', "DESC");
        $query = $this->db->get()->result();

        if (!empty($query)) {
            foreach ($query as $list) {
                $id_kary = $list->id_kary;
            }

            return $id_kary;
        } else {
            return 0;
        }
    }

    public function last_row_idizin()
    {
        $this->db->select("*");
        $this->db->from("tb_izin_tambang");
        $this->db->limit(1);
        $this->db->order_by('id_izin_tambang', "DESC");
        $query = $this->db->get()->result();

        if (!empty($query)) {
            foreach ($query as $list) {
                $id_izin = $list->id_izin_tambang;
            }

            return $id_izin;
        } else {
            return 0;
        }
    }

    public function last_row_idmcu()
    {
        $this->db->select("*");
        $this->db->from("tb_mcu");
        $this->db->limit(1);
        $this->db->order_by('id_mcu', "DESC");
        $query = $this->db->get()->result();

        if (!empty($query)) {
            foreach ($query as $list) {
                $id_mcu = $list->id_mcu;
            }

            return $id_mcu;
        } else {
            return 0;
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
            return 0;
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

    public function update_dtPersonal($idpersonal, $dt_personal)
    {
        $this->db->where('id_personal', $idpersonal);
        $this->db->update('tb_personal', $dt_personal);
    }

    public function update_dtAlamat($id_alamat, $data_al)
    {
        $this->db->where('id_alamat_ktp', $id_alamat);
        $this->db->update('tb_alamat_ktp', $data_al);
    }

    public function update_dtkary($idkaryawan, $data_kry)
    {
        $this->db->where('id_kary', $idkaryawan);
        $this->db->update('tb_karyawan', $data_kry);
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

    public function cek_noKTP($noktp)
    {
        $query = $this->db->get_where('tb_personal', ['no_ktp' => $noktp]);
        if (!empty($query->result())) {
            return true;
        } else {
            return false;
        }
    }

    public function cek_nik($no_nik, $id_m_per)
    {
        $cekdata = array(
            'no_nik' => $no_nik,
            'id_m_perusahaan' => $id_m_per
        );

        $query = $this->db->get_where('vw_karyawan', $cekdata);
        if (!empty($query->result())) {
            return true;
        } else {
            return false;
        }
    }

    public function cek_noKK($nokk)
    {
        $query = $this->db->get_where('tb_personal', ['no_kk' => $nokk]);
        if (!empty($query->result())) {
            return true;
        } else {
            return false;
        }
    }

    function get_stat_janji($stat_kerja)
    {
        $query  = $this->db->get_where('tb_stat_perjanjian', ['id_stat_perjanjian' => $stat_kerja]);
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
}
