<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Izin_tambang_model extends CI_Model
{

    public function input_izin_tambang($data)
    {
        $this->db->insert('tb_izin_tambang', $data);
        if ($this->db->affected_rows() > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function input_sim_polisi($data)
    {
        $this->db->insert('tb_sim_karyawan', $data);
        if ($this->db->affected_rows() > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function cek_izin_tambang($izin_tambang)
    {
        $query = $this->db->get_where('tb_izin_tambang', ['izin_tambang' => $izin_tambang]);
        if (!empty($query->result())) {
            return true;
        } else {
            return false;
        }
    }

    public function last_row_izin($auth_kary)
    {
        $this->db->where(['auth_karyawan' => $auth_kary]);
        $this->db->from('vw_izin_tambang');
        $this->db->order_by('id_izin_tambang', 'DESC');
        $this->db->limit(1);
        $query = $this->db->get()->result();
        return $query;
    }

    public function last_row_izin_sm($id_personal)
    {
        $this->db->where(['id_personal' => $id_personal]);
        $this->db->from('vw_izin_tambang');
        $this->db->order_by('id_izin_tambang', 'DESC');
        $this->db->limit(1);
        $query = $this->db->get()->result();
        return $query;
    }

    public function last_row_sim($id_personal)
    {
        $this->db->where(['id_personal' => $id_personal]);
        $this->db->from('tb_sim_karyawan');
        $this->db->order_by('id_sim_kary', 'DESC');
        $this->db->limit(1);
        $query = $this->db->get()->result();

        if (!empty($query)) {
            foreach ($query as $lstizin) {
                $id_sim_kary = $lstizin->id_sim_kary;
            }
            return $id_sim_kary;
        } else {
            return;
        }
    }

    public function last_row_simpol($auth_personal)
    {
        $this->db->where(['auth_personal' => $auth_personal]);
        $this->db->from('vw_sim_karyawan');
        $this->db->order_by('id_sim_kary', 'DESC');
        $this->db->limit(1);
        $query = $this->db->get()->row();

        if (!empty($query)) {
            return $query->auth_sim_kary;
        } else {
            return;
        }
    }

    public function cek_jenisizin($auth_izin)
    {
        $query = $this->db->get_where('vw_izin_tambang', ['auth_izin_tambang' => $auth_izin])->result();
        if (!empty($query)) {
            return $query;
        } else {
            return;
        }
    }

    public function cek_unit($auth_izin)
    {
        $query = $this->db->get_where('vw_izin_unit', ['auth_izin_tambang' => $auth_izin])->result();
        if (!empty($query)) {
            foreach ($query as $list) {
                $id_izin_tambang = $list->id_izin_tambang;
            }

            $query = $this->db->get_where('tb_izin_tambang_unit', ['id_izin_tambang' => $id_izin_tambang])->result();
            if (!empty($query)) {
                return 200;
            } else {
                return 201;
            }
        } else {
            return 201;
        }
    }

    public function input_unit($data)
    {
        $this->db->insert('tb_izin_tambang_unit', $data);
        if ($this->db->affected_rows() > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function update_izin($id_izin, $dtizin)
    {
        $this->db->where('id_izin_tambang', $id_izin);
        $this->db->update('tb_izin_tambang', $dtizin);
        return;
    }

    public function hapus_izin_tambang($auth_izin_tambang)
    {
        $cek_id = $this->db->get_where('vw_izin_tambang', ['auth_izin_tambang' => $auth_izin_tambang]);
        if (!empty($cek_id->result())) {
            foreach ($cek_id->result() as $list) {
                $id_izin_tambang = $list->id_izin_tambang;
            }

            $this->db->delete('tb_izin_tambang', ['id_izin_tambang' => $id_izin_tambang]);
            if ($this->db->affected_rows() > 0) {
                return 200;
            } else {
                return 201;
            }
        } else {
            return 202;
        }
    }

    public function get_jenis_unit($jenis_unit)
    {
        $query = $this->db->get_where('tb_unit', ['id_unit' => $jenis_unit])->result();

        if (!empty($query)) {
            foreach ($query as $list) {
                $unit = $list->unit;
            }

            return $unit;
        } else {
            return '';
        }
    }
    public function get_izin_unit($izin_unit)
    {
        $query = $this->db->get_where('tb_tipe_akses_unit', ['id_tipe_akses_unit' => $izin_unit])->result();

        if (!empty($query)) {
            foreach ($query as $list) {
                $tipe_akses_unit = $list->tipe_akses_unit;
            }

            return $tipe_akses_unit;
        } else {
            return '';
        }
    }

    public function tabel_unit_izin($auth_izin)
    {
        return $this->db->get_where('vw_izin_unit', ['auth_izin_tambang' => $auth_izin])->result();
    }

    public function get_izin_tambang_id($auth_izin_tambang)
    {
        $query = $this->db->get_where('vw_izin_tambang', ['auth_izin_tambang' => $auth_izin_tambang]);
        return $query->result();
    }

    public function cek_unit_izin($auth_izin, $jenis_unit)
    {
        $this->db->where('auth_izin_tambang', $auth_izin);
        $this->db->where('id_unit', $jenis_unit);
        $this->db->from('vw_izin_unit');
        return $this->db->get()->result();
    }

    public function get_id_izin_tambang($auth_izin_tambang)
    {
        $query = $this->db->get_where('vw_izin_tambang', ['auth_izin_tambang' => $auth_izin_tambang]);
        if (!empty($query->result())) {
            foreach ($query->result() as $list) {
                $id_izin = $list->id_izin_tambang;
            }

            return $id_izin;
        } else {
            return;
        }
    }

    public function get_id_simpol($auth_simpol)
    {
        $query = $this->db->get_where('vw_sim_karyawan', ['auth_sim_kary' => $auth_simpol]);
        if (!empty($query->result())) {
            foreach ($query->result() as $list) {
                $id_sim_kary = $list->id_sim_kary;
            }

            return $id_sim_kary;
        } else {
            return;
        }
    }

    public function edit_izin_tambang($izin_tambang, $ket_izin_tambang, $status)
    {
        $id_izin_tambang = $this->session->userdata('id_izin_tambang');

        $query = $this->db->query("SELECT * FROM tb_izin_tambang WHERE izin_tambang='" . $izin_tambang . "' AND id_izin_tambang <> " . $id_izin_tambang);
        if (!empty($query->result())) {
            return 204;
        }

        $this->db->set('izin_tambang', $izin_tambang);
        $this->db->set('ket_izin_tambang', $ket_izin_tambang);
        $this->db->set('stat_izin_tambang', $status);
        $this->db->set('tgl_edit', date('Y-m-d H:i:s'));
        $this->db->where('id_izin_tambang', $id_izin_tambang);
        $this->db->update('tb_izin_tambang');
        if ($this->db->affected_rows() > 0) {
            return 200;
        } else {
            return 201;
        }
    }

    public function hapus_unit($id_unit)
    {
        $this->db->delete('tb_izin_tambang_unit', ['id_izin_tambang_unit' => $id_unit]);
        if ($this->db->affected_rows() > 0) {
            return 200;
        } else {
            return 201;
        }
    }

    public function hapus_unit_all($auth_izin)
    {
        $query = $this->db->get_where('vw_izin_tambang', ['auth_izin_tambang' => $auth_izin])->result();

        if (!empty($query)) {
            foreach ($query as $list) {
                $id_izin = $list->id_izin_tambang;
                $id_personal = $list->id_personal;
                $id_sim_kary = $list->id_sim_kary;
                $url_izin_tambang = $list->url_izin_tambang;
            }

            $foldername = md5($id_personal);

            if (is_file('./berkas/karyawan/' . $foldername . '/' . $url_izin_tambang)) {
                unlink('./berkas/karyawan/' . $foldername . '/' . $url_izin_tambang);
            }

            $dtsim = $this->db->get_where('tb_sim_karyawan', ['id_sim_kary' => $id_sim_kary])->result();
            if (!empty($dtsim)) {
                foreach ($dtsim as $list) {
                    $url_file = $list->url_file;
                }

                if (is_file('./berkas/karyawan/' . $foldername . '/' . $url_file)) {
                    unlink('./berkas/karyawan/' . $foldername . '/' . $url_file);
                }
            }

            $dtizin = [
                'url_izin_tambang' => '',
            ];

            $this->db->delete('tb_izin_tambang', ['id_izin_tambang' => $id_izin]);
            $this->db->delete('tb_sim_karyawan', ['id_sim_kary' => $id_sim_kary]);
            $this->db->delete('tb_izin_tambang_unit', ['id_izin_tambang' => $id_izin]);
            if ($this->db->affected_rows() > 0) {
                return 200;
            } else {
                return 201;
            }
        } else {
            return 201;
        }
    }

    public function hapus_izin_all($auth_izin)
    {
        $query = $this->db->get_where('vw_izin_tambang', ['auth_izin_tambang' => $auth_izin])->result();

        if (!empty($query)) {
            foreach ($query as $list) {
                $id_izin = $list->id_izin_tambang;
                $id_personal = $list->id_personal;
                $url_izin_tambang = $list->url_izin_tambang;
            }

            $foldername = md5($id_personal);
            if (is_file('./berkas/karyawan/' . $foldername . '/' . $url_izin_tambang)) {
                unlink('./berkas/karyawan/' . $foldername . '/' . $url_izin_tambang);
            }

            $this->db->delete('tb_izin_tambang', ['id_izin_tambang' => $id_izin]);
            if ($this->db->affected_rows() > 0) {
                return 200;
            } else {
                return 201;
            }
        } else {
            return 201;
        }
    }

    public function get_all_unit()
    {
        return $this->db->get('tb_unit')->result();
    }

    public function get_all_akses()
    {
        return $this->db->get('tb_tipe_akses_unit')->result();
    }

    public function get_unit($id_unit)
    {
        $query = $this->db->get_where('tb_unit', ['id_unit' => $id_unit]);
        if (!empty($query->result())) {
            foreach ($query->result() as $list) {
                $unit = $list->unit;
            }

            return $unit;
        } else {
            return 0;
        }
    }

    public function get_akses($id_akses)
    {
        $query = $this->db->get_where('tb_tipe_akses_unit', ['id_tipe_akses_unit' => $id_akses]);
        if (!empty($query->result())) {
            foreach ($query->result() as $list) {
                $akses = $list->tipe_akses_unit;
            }

            return $akses;
        } else {
            return 0;
        }
    }

    public function get_by_authper($auth_per)
    {
        $query = $this->db->get_where('vw_izin_tambang', ['auth_perusahaan' => $auth_per]);
        return $query->result();
    }

    public function get_by_idper($id_per)
    {
        $query = $this->db->get_where('vw_izin_tambang', ['id_perusahaan' => $id_per]);
        return $query->result();
    }
}