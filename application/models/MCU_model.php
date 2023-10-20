<?php
defined('BASEPATH') or exit('No direct script access allowed');

class MCU_model extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
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
}
