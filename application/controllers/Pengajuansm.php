<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Pengajuansm extends My_Controller
{
     public function __construct()
     {
          parent::__construct();
          $this->is_logout();
     }

     public function index()
     {
          if ($this->session->has_userdata('id_m_perusahaan_hcdata')) {
               $idmper = $this->session->userdata('id_m_perusahaan_hcdata');
               if ($idmper != "") {
                    $data['permst'] = $this->str->getMaster($idmper, "");
                    $data['perstr'] = $this->str->getMenu($idmper, "");
               } else {
                    $data['permst'] = "";
                    $data['perstr'] = "";
               }
          } else {
               $idmper = "";
               $data['permst'] = "";
               $data['perstr'] = "";
          }
          $id_perusahaan = $this->session->userdata("id_perusahaan_hcdata");
          $data['nama_per'] = $this->prs->get_per_by_id($id_perusahaan);
          $data['nama'] = $this->session->userdata("nama_hcdata");
          $data['email'] = $this->session->userdata("email_hcdata");
          $data['menu'] = $this->session->userdata("id_menu_hcdata");
          $data['get_menu'] = $this->dsmod->get_menu();
          $this->load->view('dashboard/template/header', $data);
          $this->load->view('dashboard/pengajuansm/pengajuansm');
          $this->load->view('dashboard/template/footer', $data);
          $this->load->view('dashboard/code/pengajuansm');
     }

     public function new()
     {
          if ($this->session->has_userdata('id_m_perusahaan_hcdata')) {
               $idmper = $this->session->userdata('id_m_perusahaan_hcdata');
               if ($idmper != "") {
                    $data['permst'] = $this->str->getMaster($idmper, "");
                    $data['perstr'] = $this->str->getMenu($idmper, "");
               } else {
                    $data['permst'] = "";
                    $data['perstr'] = "";
               }
          } else {
               $idmper = "";
               $data['permst'] = "";
               $data['perstr'] = "";
          }
          $id_perusahaan = $this->session->userdata("id_perusahaan_hcdata");
          $data['nama_per'] = $this->prs->get_per_by_id($id_perusahaan);
          $data['nama'] = $this->session->userdata("nama_hcdata");
          $data['email'] = $this->session->userdata("email_hcdata");
          $data['menu'] = $this->session->userdata("id_menu_hcdata");
          $data['get_menu'] = $this->dsmod->get_menu();
          $this->load->view('dashboard/template/header', $data);
          $this->load->view('dashboard/pengajuansm/pengajuansm_add');
          $this->load->view('dashboard/modal/mdlform');
          $this->load->view('dashboard/template/footer', $data);
          $this->load->view('dashboard/code/pengajuansm');
     }

     public function minepermit()
     {
          $this->load->view('dashboard/pengajuansm/minepermit');
     }

     public function simper()
     {
          $this->load->view('dashboard/pengajuansm/simper');
     }

     public function ajax_list()
     {
          $list = $this->psm->get_datatables();
          $data = array();
          $no = $_POST['start'];
          foreach ($list as $psm) {
               $no++;
               $row = array();
               $row['no'] = $no;
               $row['auth_pengajuan_sm'] = $psm->auth_pengajuan_sm;
               $row['kode_pengajuan_sm'] = $psm->kode_pengajuan_sm;
               $row['tgl_pengajuan_sm_show'] = date('d-M-Y', strtotime($psm->tgl_pengajuan_sm));
               $row['tgl_pengajuan_sm'] = $psm->tgl_pengajuan_sm;
               $row['jenis_izin_tambang'] = $psm->jenis_izin_tambang;
               $row['ket_pengajuan_sm'] = $psm->stat_pengajuan_sm;
               $row['kode_perusahaan'] = $psm->kode_perusahaan;
               $row['nama_m_perusahaan'] = $psm->nama_m_perusahaan;
               $row['jml_kary'] = $this->psm->cek_jml($psm->auth_pengajuan_sm);
               if ($this->psm->cek_jml($psm->auth_pengajuan_sm) == 0) {
                    $row['stat_pengajuan_sm'] = "<div class='btn btn-danger btn-sm'> ERROR </div>";
                    $stat = "ERROR";
               } else {
                    if ($psm->stat_pengajuan_sm == "T") {
                         $row['stat_pengajuan_sm'] = "<span class='btn btn-success btn-sm '> APPROVED </span>";
                         $stat = "APPROVED";
                    } else {
                         $row['stat_pengajuan_sm'] = "<div class='btn btn-warning btn-sm'> PENDING </div>";
                         $stat = "PENDING";
                    }
               }
               $row['tgl_buat'] = date('d-M-Y', strtotime($psm->tgl_buat));
               $row['tgl_edit'] = date('d-M-Y', strtotime($psm->tgl_edit));
               $row['proses'] = '<button id="' . $psm->auth_pengajuan_sm . '" dt-status="' . $stat . '" class="btn btn-primary btn-sm font-weight-bold dtldtizinkry" title="Detail" value="' . $psm->kode_pengajuan_sm . '"> <i class="fas fa-asterisk"></i> </button> 
                    <button id="' . $psm->auth_pengajuan_sm . '" class="btn btn-warning btn-sm font-weight-bold edttdtizinkry" title="Edit" value="' . $psm->kode_pengajuan_sm . '"> <i class="fas fa-edit"></i> </button> 
                    <button id="' . $psm->auth_pengajuan_sm . '" dt-jenis="' . $psm->jenis_izin_tambang . '" class="btn btn-danger btn-sm font-weight-bold hpsdtizinkry" title="Hapus" value="' . $psm->kode_pengajuan_sm . '"> <i class="fas fa-trash-alt"></i> </button>';
               $data[] = $row;
          }

          $output = array(
               "draw" => $_POST['draw'],
               "recordsTotal" => $this->psm->count_all(),
               "recordsFiltered" => $this->psm->count_filtered(),
               "data" => $data,
          );
          //output to json format
          echo json_encode($output);
     }

     public function input_pengajuansm()
     {
          $this->form_validation->set_rules("prsizinadd", "prsizinadd", "required|trim", [
               'required' => 'Perusahaan wajib dipilih',
          ]);
          $this->form_validation->set_rules("tglpengajuan", "tglpengajuan", "required|trim", [
               'required' => 'Jenis izin wajib dipilih',
          ]);
          $this->form_validation->set_rules("jenisizinadd", "jenisizinadd", "required|trim", [
               'required' => 'Jenis izin wajib dipilih',
          ]);
          $this->form_validation->set_rules("ketizinadd", "ketizinadd", "trim|max_length[2000],[
               'max_length' => 'Keterangan maksimal 2000 karakter'
          ]");

          if ($this->form_validation->run() == false) {
               $error = [
                    'statusCode' => 202,
                    'prsizinadd' => form_error("prsizinadd"),
                    'tglpengajuan' => form_error("tglpengajuan"),
                    'jenisizinadd' => form_error("jenisizinadd"),
                    'ketizinadd' => form_error("ketizinadd")
               ];

               echo json_encode($error);
               return;
          } else {
               $prs = htmlspecialchars($this->input->post("prsizinadd", true));
               $tglpengajuan = htmlspecialchars($this->input->post("tglpengajuan", true));
               $jenisizin = htmlspecialchars($this->input->post("jenisizinadd", true));
               $ket = htmlspecialchars($this->input->post("ketizinadd"));
               $idprs = $this->str->get_by_m_authper($prs);
               $kodejenis = $this->psm->get_kode_jenis($jenisizin);
               if ($kodejenis == "") {
                    $kode = date('ymdHis');
               } else {
                    $kode = date('ymdHis') . "-" . $kodejenis;
               }

               if ($jenisizin == 1) {
                    $stt_tabel = "pengajuansm/minepermit";
               } else {
                    $stt_tabel = "pengajuansm/simper";
               }

               $cekpengajuan = $this->psm->cek_kode($kode);
               if ($cekpengajuan) {
                    echo json_encode(array("statusCode" => 201, "pesan" => "Kode pengajuan sudah digunakan"));
                    return;
               } else {
                    $data = [
                         'kode_pengajuan_sm' => $kode,
                         'tgl_pengajuan_sm' => $tglpengajuan,
                         'id_jenis_izin_tambang' => $jenisizin,
                         'ket_pengajuan_sm' => $ket,
                         'stat_pengajuan_sm' => 'F',
                         'tgl_buat' => date('Y-m-d H:i:s'),
                         'tgl_edit' => date('Y-m-d H:i:s'),
                         'id_approval_sm' => 0,
                         'id_user' => $this->session->userdata('id_user_hcdata'),
                         'id_m_perusahaan' => $idprs,
                    ];

                    $pengajuansm = $this->psm->input_pengajuan_sm($data);
                    if ($pengajuansm) {
                         $authpengajuansm = $this->psm->get_authsm($kode);
                         echo json_encode(array(
                              "statusCode" => 200,
                              "pesan" => "Pengajuan SIMPER/Mine Permit berhasil disimpan",
                              "authpengajuansm" => $authpengajuansm,
                              "kode" => $kode,
                              "tabel" => $stt_tabel,
                         ));
                    } else {
                         echo json_encode(array(
                              "statusCode" => 201,
                              "pesan" => "Pengajuan SIMPER/Mine Permit gagal disimpan",
                         ));
                    }
               }
          }
     }

     public function input_karypengajuansm()
     {
          $this->form_validation->set_rules("authpengajuansm", "authpengajuansm", "required|trim", [
               'required' => 'Pengajuan utama tidak ditemukan',
          ]);
          $this->form_validation->set_rules("authkary", "authkary", "required|trim", [
               'required' => 'Karywan wajib dipilih',
          ]);
          $this->form_validation->set_rules("prosesizin", "prosesizin", "required|trim", [
               'required' => 'Proses izin wajib dipilih',
          ]);
          $this->form_validation->set_rules("ketdet", "ketdet", "trim|max_length[2000],[
               'max_length' => 'Keterangan maksimal 2000 karakter'
          ]");

          if ($this->form_validation->run() == false) {
               $error = [
                    'statusCode' => 202,
                    'authpengajuansm' => form_error("authpengajuansm"),
                    'authkary' => form_error("authkary"),
                    'prosesizin' => form_error("prosesizin"),
                    'ketdet' => form_error("ketdet")
               ];

               echo json_encode($error);
               return;
          } else {
               $authpengajuansm = htmlspecialchars($this->input->post("authpengajuansm", true));
               $nik = htmlspecialchars($this->input->post("nik", true));
               $nama = htmlspecialchars($this->input->post("nama", true));
               $authkary = htmlspecialchars($this->input->post("authkary", true));
               $prosesizin = htmlspecialchars($this->input->post("prosesizin", true));
               $ketdet = htmlspecialchars($this->input->post("ketdet"));
               $idpengajuansm = $this->psm->get_id_pengajuan($authpengajuansm);
               $idkary = $this->kry->get_id_karyawan($authkary);

               $cekkary = $this->psm->cek_kary($idkary, $idpengajuansm);
               if ($cekkary) {
                    echo json_encode(array("statusCode" => 201, "pesan" => "Data karyawan NIK :" . $nik . ", Nama : " . $nama . " sudah digunakan pada pengajuan ini"));
                    return;
               }

               $cekkaryapps = $this->psm->cek_kary_approval($idkary);
               if ($cekkaryapps) {
                    echo json_encode(array("statusCode" => 201, "pesan" => "Ada pengajuan dari karyawan NIK : " . $nik . ", Nama : " . $nama . " yang belum disetujui"));
                    return;
               }

               $data = [
                    'id_pengajuan_sm' => $idpengajuansm,
                    'id_karyawan' => $idkary,
                    'id_proses_izin_tambang' => $prosesizin,
                    'ket_pengajuan_sm_detail' => $ketdet,
                    'stat_pengajuan_sm_detail' => 'F',
                    'tgl_cetak' => '1970-01-01 00:00:00',
                    'tgl_buat' => date('Y-m-d H:i:s'),
                    'tgl_edit' => date('Y-m-d H:i:s'),
                    'id_user' => $this->session->userdata('id_user_hcdata'),
               ];

               $karypengajuansm = $this->psm->input_kary_pengajuan_sm($data);
               if ($karypengajuansm) {
                    echo json_encode(array("statusCode" => 200, "pesan" => "Data karyawan berhasil diambil"));
               } else {
                    echo json_encode(array("statusCode" => 201, "pesan" => "Data karyawan gagal diambil"));
               }
          }
     }

     public function hapus_pengajuansm()
     {
          $authpengajuansm = htmlspecialchars(trim($this->input->post('authpengajuansm')));
          $query = $this->psm->hapus_pengajuansm($authpengajuansm);
          if ($query == 200) {
               echo json_encode(array("statusCode" => 200, "pesan" => "Pengajuan berhasil dihapus"));
               return;
          } else if ($query == 201) {
               echo json_encode(array("statusCode" => 201, "pesan" => "Pengajuan gagal dihapus"));
               return;
          } else if ($query == 202) {
               echo json_encode(array("statusCode" => 202, "pesan" => "Pengajuan tidak ditemukan"));
               return;
          } else {
               echo json_encode(array("statusCode" => 203, "pesan" => "Pengajuan tidak dapat dihapus karena status telah disetujui"));
               return;
          }
     }

     public function det_pengajuan()
     {
          $authpengajuansm = htmlspecialchars($this->input->post('authpengajuansm', true));
          $query = $this->psm->get_by_authpsm($authpengajuansm);
          if (!empty($query)) {
               foreach ($query as $lst) {
                    $ketdetizin = $lst->ket_pengajuan_sm;
               }
          } else {
               $ketdetizin = "";
          }

          echo json_encode(array("statusCode" => 200, "pesan" => "Berhasil", "ketdetail" => $ketdetizin));
          return;
     }

     public function edit_bank()
     {
          $this->form_validation->set_rules("bank", "bank", "required|trim|max_length[100]", [
               'required' => 'Bank wajib diisi',
               'max_length' => 'Bank maksimal 100 karakter'
          ]);
          $this->form_validation->set_rules("ket", "ket", "trim|max_length[1000],[
               'max_length' => 'Keterangan maksimal 1000 karakter'
          ]");
          $this->form_validation->set_rules("status", "status", "required|trim", [
               'required' => 'Status wajib dipilih'
          ]);

          if ($this->form_validation->run() == false) {
               $error = [
                    'statusCode' => 202,
                    'bank' => form_error("bank"),
                    'status' => form_error("status"),
                    'ket' => form_error('ket')
               ];

               echo json_encode($error);
               die;
          } else {
               if ($this->session->userdata('id_bank') == "") {
                    echo json_encode(array("statusCode" => 201, "pesan" => "Bank tidak ditemukan"));
                    return;
               }

               $bank = htmlspecialchars($this->input->post("bank", true));
               $ket_bank = htmlspecialchars($this->input->post("ket", true));
               if (htmlspecialchars($this->input->post("status", true)) == "AKTIF") {
                    $status = "T";
               } else {
                    $status = "F";
               }

               $bank = $this->psm->edit_bank($bank, $ket_bank, $status);
               if ($bank == 200) {
                    echo json_encode(array("statusCode" => 200, "pesan" => "Bank berhasil diupdate"));
               } else if ($bank == 201) {
                    echo json_encode(array("statusCode" => 201, "pesan" => "Bank gagal diupdate"));
               } else if ($bank == 204) {
                    echo json_encode(array("statusCode" => 205, "pesan" => "Bank sudah digunakan"));
               }
          }
     }
}
