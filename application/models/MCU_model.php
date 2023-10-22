<?php
defined('BASEPATH') or exit('No direct script access allowed');

class MCU_model extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    public function data_jenis_hasil()
    {
        $this->db->select('*');
        $this->db->from('tb_mcu_jenis');
        $this->db->order_by('id_mcu_jenis', 'ASC');
        return $this->db->get()->result();
    }

    public function dataMCU($id_personal)
    {
        $this->db->select('*');
        $this->db->from('vw_mcu');
        $this->db->where('id_personal', $id_personal);
        $this->db->order_by('tgl_mcu', 'ASC');
        return $this->db->get()->result();
    }

    public function dataMCU_by_id($id)
    {
        $this->db->select('*');
        $this->db->from('vw_mcu');
        $this->db->where('auth_mcu', $id);
        return $this->db->get()->row();
    }

    public function dataMCU_by_id_personal($id)
    {
        $this->db->select('id_personal');
        $this->db->from('vw_mcu');
        $this->db->where('id_personal', $id);
        return $this->db->get()->result();
    }

    public function updateDataMCU($data, $id)
    {
        $this->db->where('id_mcu', $id);
        $this->db->update('tb_mcu', $data);
        if ($this->db->affected_rows() > 0) {
            return true;
        } else {
            return false;
        }
    }
}
