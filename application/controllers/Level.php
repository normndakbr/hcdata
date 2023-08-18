<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Level extends My_Controller
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
                    $data['permst'] = $this->str->getMasterPrs($idmper, "");
                    $data['perstr'] = $this->str->getMenuPrs($idmper, "");
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
          $this->load->view('dashboard/level/level');
          $this->load->view('dashboard/modal/mdlform');
          $this->load->view('dashboard/template/footer', $data);
          $this->load->view('dashboard/code/level');
     }

     public function new()
     {
          if ($this->session->has_userdata('id_m_perusahaan_hcdata')) {
               $idmper = $this->session->userdata('id_m_perusahaan_hcdata');
               if ($idmper != "") {
                    $data['permst'] = $this->str->getMasterPrs($idmper, "");
                    $data['perstr'] = $this->str->getMenuPrs($idmper, "");
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
          $this->load->view('dashboard/level/level_add');
          $this->load->view('dashboard/modal/mdlform');
          $this->load->view('dashboard/template/footer', $data);
          $this->load->view('dashboard/code/level');
     }

     public function ajax_list()
     {
          $auth = htmlspecialchars($this->input->get("authtoken", true));
          $cekauth = $this->cek_auth($auth);

          if ($cekauth == 501) {
               echo json_encode(array('statusCode' => 201, "kode_pesan" => "Gagal", "pesan" => "Autentikasi tidak valid, refresh data", "tipe_pesan" => "error"));
          } else {

               $auth_per = $this->input->get("auth_per");
               $list = $this->lvl->get_datatables($auth_per);
               $data = array();
               $no = $_POST['start'];
               foreach ($list as $lvl) {
                    $no++;
                    $row = array();
                    $row['no'] = $no;
                    $row['auth_level'] = $lvl->auth_level;
                    $row['kd_level'] = $lvl->kd_level;
                    $row['level'] = $lvl->level;
                    $row['ket_level'] = $lvl->ket_level;

                    if ($lvl->stat_level == "T") {
                         $row['stat_level'] = "<span class='btn btn-success btn-sm '> AKTIF </span>";
                    } else {
                         $row['stat_level'] = "<div class='btn btn-danger btn-sm'> NONAKTIF </div>";
                    }

                    $row['kode_perusahaan'] = $lvl->kode_perusahaan;
                    $row['tgl_buat'] = date('d-M-Y', strtotime($lvl->tgl_buat));
                    $row['tgl_edit'] = date('d-M-Y', strtotime($lvl->tgl_edit));
                    $row['proses'] = '<button id="' . $lvl->auth_level . '" class="btn btn-primary btn-sm font-weight-bold dtllevel" title="Detail" value="' . $lvl->level . '"> <i class="fas fa-asterisk"></i> </button> 
                    <button id="' . $lvl->auth_level . '" class="btn btn-warning btn-sm font-weight-bold edttlevel" title="Edit" value="' . $lvl->level . '"> <i class="fas fa-edit"></i> </button> 
                    <button id="' . $lvl->auth_level . '" class="btn btn-danger btn-sm font-weight-bold hpslevel" title="Hapus" value="' . $lvl->level . '"> <i class="fas fa-trash-alt"></i> </button>';
                    $data[] = $row;
               }

               $output = array(
                    "draw" => $_POST['draw'],
                    "recordsTotal" => $this->lvl->count_all(),
                    "recordsFiltered" => $this->lvl->count_filtered($auth_per),
                    "data" => $data,
               );
               //output to json format
               echo json_encode($output);
          }
     }

     public function input_level()
     {

          $auth = htmlspecialchars($this->input->post("token", true));
          $cekauth = $this->cek_auth($auth);

          if ($cekauth == 501) {
               echo json_encode(array('statusCode' => 201, "kode_pesan" => "Gagal", "pesan" => "Autentikasi tidak valid, refresh data", "tipe_pesan" => "error"));
          } else {

               $this->form_validation->set_rules("prs", "prs", "required|trim", [
                    'required' => 'Perusahaan wajib dipilih'
               ]);
               $this->form_validation->set_rules("kode", "kode", "required|trim|max_length[8]", [
                    'required' => 'Kode wajib diisi',
                    'max_length' => 'Kode maksimal 8 karakter'
               ]);
               $this->form_validation->set_rules("level", "level", "required|trim|max_length[100]", [
                    'required' => 'level wajib diisi',
                    'max_length' => 'level maksimal 100 karakter'
               ]);
               $this->form_validation->set_rules("ket", "ket", "trim|max_length[1000],[
               'max_length' => 'Keterangan maksimal 1000 karakter'
          ]");

               if ($this->form_validation->run() == false) {
                    $error = [
                         'statusCode' => 202,
                         'prs' => form_error("prs"),
                         'kode' => form_error("kode"),
                         'level' => form_error("level")
                    ];

                    echo json_encode($error);
                    return;
               } else {
                    $auth_perusahaan = htmlspecialchars($this->input->post("prs", true));
                    $kd_level = htmlspecialchars($this->input->post("kode", true));
                    $level = htmlspecialchars($this->input->post("level", true));
                    $ket_level = htmlspecialchars($this->input->post("ket", true));
                    $id_perusahaan = $this->prs->get_by_auth($auth_perusahaan);

                    if ($id_perusahaan == 0) {
                         echo json_encode(array("statusCode" => 201, "kode_pesan" => "Gagal", "pesan" => "Perusahaan tidak terdaftar", "tipe_pesan" => "error"));
                         return;
                    }

                    $cekkode = $this->lvl->cek_kode($id_perusahaan, $kd_level);
                    if ($cekkode) {
                         echo json_encode(array("statusCode" => 201, "kode_pesan" => "Gagal", "pesan" => "Kode sudah digunakan", "tipe_pesan" => "error"));
                         return;
                    }

                    $ceklevel = $this->lvl->cek_level($id_perusahaan, $level);
                    if ($ceklevel) {
                         echo json_encode(array("statusCode" => 201, "kode_pesan" => "Gagal", "pesan" => "Level sudah digunakan", "tipe_pesan" => "error"));
                         return;
                    }

                    $data = [
                         'kd_level' => $kd_level,
                         'level' => $level,
                         'ket_level' => $ket_level,
                         'stat_level' => 'T',
                         'tgl_buat' => date('Y-m-d H:i:s'),
                         'tgl_edit' => date('Y-m-d H:i:s'),
                         'id_user' => $this->session->userdata('id_user_hcdata'),
                         'id_perusahaan' => $id_perusahaan
                    ];

                    $level = $this->lvl->input_level($data);
                    if ($level) {
                         echo json_encode(array("statusCode" => 200, "kode_pesan" => "Berhasil", "pesan" => "Level berhasil disimpan", "tipe_pesan" => "success"));
                    } else {
                         echo json_encode(array("statusCode" => 201, "kode_pesan" => "Gagal", "pesan" => "Level gagal disimpan", "tipe_pesan" => "error"));
                    }
               }
          }
     }

     public function hapus_level()
     {

          $auth = htmlspecialchars($this->input->post("token", true));
          $cekauth = $this->cek_auth($auth);

          if ($cekauth == 501) {
               echo json_encode(array('statusCode' => 201, "kode_pesan" => "Gagal", "pesan" => "Autentikasi tidak valid, refresh data", "tipe_pesan" => "error"));
          } else {

               $auth_level = htmlspecialchars(trim($this->input->post('authlevel', true)));
               $query = $this->lvl->hapus_level($auth_level);
               if ($query == 200) {
                    echo json_encode(array("statusCode" => 200, "kode_pesan" => "Berhasil", "pesan" => "Level berhasil dihapus", "tipe_pesan" => "success"));
                    return;
               } else if ($query == 201) {
                    echo json_encode(array("statusCode" => 201, "kode_pesan" => "Gagal", "pesan" => "Level gagal dihapus", "tipe_pesan" => "error"));
                    return;
               } else {
                    echo json_encode(array("statusCode" => 202, "kode_pesan" => "Gagal", "pesan" => "Level tidak ditemukan", "tipe_pesan" => "error"));
                    return;
               }
          }
     }

     public function detail_level()
     {

          $auth = htmlspecialchars($this->input->post("token", true));
          $cekauth = $this->cek_auth($auth);

          if ($cekauth == 501) {
               echo json_encode(array('statusCode' => 201, "kode_pesan" => "Gagal", "pesan" => "Autentikasi tidak valid, refresh data", "tipe_pesan" => "error"));
          } else {

               $auth_level = htmlspecialchars(trim($this->input->post("authlevel", true)));
               $query = $this->lvl->get_level_id($auth_level);
               if (!empty($query)) {
                    foreach ($query as $list) {
                         if ($list->stat_level == "T") {
                              $status = "AKTIF";
                         } else {
                              $status = "NONAKTIF";
                         }

                         $data = [
                              'statusCode' => 200,
                              'nama_perusahaan' => $list->nama_perusahaan,
                              'kode' => $list->kd_level,
                              'level' => $list->level,
                              'ket' => $list->ket_level,
                              'status' => $status,
                              'tgl_buat' => date('d-M-Y H:i:s', strtotime($list->tgl_buat)),
                              'pembuat' => $list->nama_user
                         ];

                         $this->session->set_userdata('id_level_hcdata', $list->id_level);
                         $this->session->set_userdata('id_perusahaan_lvl', $list->id_perusahaan);
                    }
                    echo json_encode($data);
               } else {
                    echo json_encode(array('statusCode' => 201, "kode_pesan" => "Gagal", "pesan" => "Level tidak ditemukan", "tipe_pesan" => "error"));
               }
          }
     }

     public function edit_level()
     {
          $auth = htmlspecialchars($this->input->post("token", true));
          $cekauth = $this->cek_auth($auth);

          if ($cekauth == 501) {
               echo json_encode(array('statusCode' => 201, "kode_pesan" => "Gagal", "pesan" => "Autentikasi tidak valid, refresh data", "tipe_pesan" => "error"));
          } else {

               $this->form_validation->set_rules("kode", "kode", "required|trim|max_length[8]", [
                    'required' => 'Kode wajib diisi',
                    'max_length' => 'Kode maksimal 8 karakter'
               ]);
               $this->form_validation->set_rules("level", "level", "required|trim|max_length[100]", [
                    'required' => 'level wajib diisi',
                    'max_length' => 'level maksimal 100 karakter'
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
                         'kode' => form_error("kode"),
                         'level' => form_error("level"),
                         'status' => form_error("status")
                    ];

                    echo json_encode($error);
                    die;
               } else {
                    if ($this->session->userdata('id_perusahaan_lvl') == "") {
                         echo json_encode(array("statusCode" => 201, "kode_pesan" => "Gagal", "pesan" => "Perusahaan tidak terdaftar", "tipe_pesan" => "error"));
                         return;
                    }

                    if ($this->session->userdata('id_level_hcdata') == "") {
                         echo json_encode(array("statusCode" => 201, "kode_pesan" => "Gagal", "pesan" => "Level tidak ditemukan", "tipe_pesan" => "error"));
                         return;
                    }

                    $kd_level = htmlspecialchars($this->input->post("kode", true));
                    $level = htmlspecialchars($this->input->post("level", true));
                    $ket_level = htmlspecialchars($this->input->post("ket", true));
                    if (htmlspecialchars($this->input->post("status", true)) == "AKTIF") {
                         $status = "T";
                    } else {
                         $status = "F";
                    }

                    $level = $this->lvl->edit_level($kd_level, $level, $ket_level, $status);
                    if ($level == 200) {
                         $this->session->unset_userdata('id_perusahaan_lvl');
                         $this->session->unset_userdata('id_level_hcdata');
                         echo json_encode(array("statusCode" => 200, "kode_pesan" => "Berhasil", "pesan" => "Level berhasil diupdate", "tipe_pesan" => "success"));
                    } else if ($level == 201) {
                         echo json_encode(array("statusCode" => 201, "kode_pesan" => "Gagal", "pesan" => "Level gagal diupdate", "tipe_pesan" => "error"));
                    } else if ($level == 203) {
                         echo json_encode(array("statusCode" => 203, "kode_pesan" => "Gagal", "pesan" => "Kode sudah digunakan", "tipe_pesan" => "error"));
                    } else if ($level == 204) {
                         echo json_encode(array("statusCode" => 205, "kode_pesan" => "Gagal", "pesan" => "Level sudah digunakan", "tipe_pesan" => "error"));
                    }
               }
          }
     }

     public function get_all()
     {
          $auth = htmlspecialchars($this->input->post("token", true));
          $cekauth = $this->cek_auth($auth);

          if ($cekauth == 501) {
               echo json_encode(array('statusCode' => 201, "kode_pesan" => "Gagal", "pesan" => "Autentikasi tidak valid, refresh data", "tipe_pesan" => "error"));
          } else {

               $auth = htmlspecialchars($this->input->post("token", true));
               $this->cek_auth($auth);

               $auth_m_per = htmlspecialchars($this->input->post('auth_per', true));
               $query = $this->lvl->get_all($auth_m_per);
               $output = "<option value=''>-- PILIH LEVEL --</option>";
               if (!empty($query)) {
                    foreach ($query as $list) {
                         $output = $output . "<option value='" . $list->auth_level . "'>" . $list->level . "</option>";
                    }
                    echo json_encode(array("statusCode" => 200, "lvl" => $output));
               } else {
                    $output = "<option value=''>-- LEVEL TIDAK DITEMUKAN --</option>";
                    echo json_encode(array("statusCode" => 201, "lvl" => $output));
               }
          }
     }

     public function get_by_authper()
     {
          $auth = htmlspecialchars($this->input->post("token", true));
          $cekauth = $this->cek_auth($auth);

          if ($cekauth == 501) {
               echo json_encode(array('statusCode' => 201, "kode_pesan" => "Gagal", "pesan" => "Autentikasi tidak valid, refresh data", "tipe_pesan" => "error"));
          } else {

               $auth_per = $this->input->post('auth_per');

               $query = $this->lvl->get_by_authper($auth_per);
               $output = "<option value=''>-- PILIH LEVEL --</option>";
               if (!empty($query)) {
                    foreach ($query as $list) {
                         $output = $output . "<option value='" . $list->auth_level . "'>" . $list->level . "</option>";
                    }
                    echo json_encode(array("statusCode" => 200, "lvl" => $output));
               } else {
                    $output = "<option value=''>-- LEVEL TIDAK DITEMUKAN --</option>";
                    echo json_encode(array("statusCode" => 201, "lvl" => $output));
               }
          }
     }

     public function get_by_idper()
     {
          $auth = htmlspecialchars($this->input->post("token", true));
          $cekauth = $this->cek_auth($auth);

          if ($cekauth == 501) {
               echo json_encode(array('statusCode' => 201, "kode_pesan" => "Gagal", "pesan" => "Autentikasi tidak valid, refresh data", "tipe_pesan" => "error"));
          } else {
               if ($this->session->userdata('id_perusahaan_level') != "") {
                    $id_per = $this->session->userdata('id_perusahaan_level');
                    $output = "<option value=''>-- PILIH LEVEL --</option>";
                    $query = $this->lvl->get_by_idper($id_per);
                    foreach ($query as $list) {
                         $output = $output . " <option value='" . $list->auth_level . "'>" . $list->level . "</option>";
                    }

                    echo json_encode(array("statusCode" => 200, "kode_pesan" => "Berhasil", "level" => $output, "pesan" => "Sukses", "tipe_pesan" => "success"));
               } else {
                    $output = "<option value=''>-- LEVEL TIDAK DITEMUKAN LEVEL TIDAK DITEMUKAN --</option>";
                    echo json_encode(array("statusCode" => 201, "kode_pesan" => "Gagal", "level" => $output, "pesan", "Level gagal ditampilkan", "tipe_pesan" => "error"));
               }
          }
     }

     public function get_auth_level_by_id()
     {
          $auth = htmlspecialchars($this->input->post("token", true));
          $cekauth = $this->cek_auth($auth);

          if ($cekauth == 501) {
               echo json_encode(array('statusCode' => 201, "kode_pesan" => "Gagal", "pesan" => "Autentikasi tidak valid, refresh data", "tipe_pesan" => "error"));
          } else {
               $id_level = $this->input->post('id_level');
               $query = $this->lvl->get_auth_level($id_level);
               if ($query === 0) {
                    return 0;
               } else {
                    return $query;
               }
          }
     }
}
