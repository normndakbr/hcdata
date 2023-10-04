<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Karyizin extends My_Controller
{
     public function __construct()
     {
          parent::__construct();
          $this->is_logout();
     }

     public function ajax_list()
     {
          $authizinmst = htmlspecialchars($this->input->get('authizinmst'));
          $list = $this->kryizn->get_datatables($authizinmst);
          $data = array();
          $no = $_POST['start'];
          foreach ($list as $kryiz) {
               $no++;
               $row = array();
               $row['no'] = $no;
               $row['auth_karyawan'] = $kryiz->auth_karyawan;
               $row['auth_pengajuan_sm_detail'] = $kryiz->auth_pengajuan_sm_detail;
               $row['auth_pengajuan_sm'] = $kryiz->auth_pengajuan_sm;
               $row['kode_pengajuan_sm'] = $kryiz->kode_pengajuan_sm;
               $row['nik'] = $kryiz->no_nik;
               $row['nama_lengkap'] = $kryiz->nama_lengkap;
               $row['depart'] = $kryiz->depart;
               $row['posisi'] = $kryiz->posisi;
               $row['doh'] = $kryiz->doh;
               $row['dohshow'] = date('d-M-Y', strtotime($kryiz->doh));
               $row['tgl_pengajuan_sm_show'] = date('d-M-Y', strtotime($kryiz->tgl_pengajuan_sm));
               $row['tgl_pengajuan_sm'] = $kryiz->tgl_pengajuan_sm;
               $row['jenis_izin_tambang'] = $kryiz->jenis_izin_tambang;
               $row['auth_personal'] = $kryiz->auth_personal;
               $datasim = $this->psm->get_sim($kryiz->auth_personal);
               if (!empty($datasim)) {
                    foreach ($datasim as $lstsim) {
                         $row['jenis_sim'] = $lstsim->sim;
                         $row['tgl_exp_sim'] = $lstsim->tgl_exp_sim;
                         $row['tgl_exp_sim_show'] = date('d-M-Y', strtotime($lstsim->tgl_exp_sim));
                         $row['tgl_sio'] = '';
                    }
               } else {
                    $row['jenis_sim'] = '';
                    $row['tgl_exp_sim'] = '';
                    $row['tgl_exp_sim_show'] = '';
                    $row['tgl_sio'] = '';
               }
               $row['proses_izin_tambang'] = $kryiz->proses_izin_tambang;
               $row['ket_pengajuan_sm_detail'] = $kryiz->ket_pengajuan_sm_detail;
               $row['kode_perusahaan'] = $kryiz->kode_perusahaan;
               $row['nama_m_perusahaan'] = $kryiz->nama_m_perusahaan;
               if ($kryiz->stat_pengajuan_sm_detail == "T") {
                    $row['stat_pengajuan_sm'] = "<span class='btn btn-success btn-sm '> APPROVED </span>";
               } else {
                    $row['stat_pengajuan_sm'] = "<div class='btn btn-danger btn-sm'> PENDING </div>";
               }
               $row['tgl_buat'] = date('d-M-Y', strtotime($kryiz->tgl_buat));
               $row['tgl_edit'] = date('d-M-Y', strtotime($kryiz->tgl_edit));
               $row['proses'] = '<button id="' . $kryiz->auth_pengajuan_sm_detail . '" class="btn btn-primary btn-sm font-weight-bold izndetail" title="Detail"> <i class="fas fa-asterisk"></i> </button> 
                    <button id="' . $kryiz->auth_pengajuan_sm_detail . '" class="btn btn-warning btn-sm font-weight-bold edttizndetail" title="Edit"> <i class="fas fa-edit"></i> </button> 
                    <button id="' . $kryiz->auth_pengajuan_sm_detail . '" class="btn btn-danger btn-sm font-weight-bold hpsizndetail" title="Hapus"> <i class="fas fa-trash-alt"></i> </button>';
               $data[] = $row;
          }

          $output = array(
               "draw" => $_POST['draw'],
               "recordsTotal" => $this->kryizn->count_all(),
               "recordsFiltered" => $this->kryizn->count_filtered($authizinmst),
               "data" => $data,
          );
          //output to json format
          echo json_encode($output);
     }
}
