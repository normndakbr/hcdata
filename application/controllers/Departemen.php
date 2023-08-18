<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Departemen extends My_Controller
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
          $this->load->view('dashboard/departemen/depart');
          $this->load->view('dashboard/template/footer', $data);
          $this->load->view('dashboard/code/departemen');
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
          $this->load->view('dashboard/departemen/depart_add');
          $this->load->view('dashboard/template/footer', $data);
          $this->load->view('dashboard/code/departemen');
     }

     public function ajax_list()
     {
          $auth = htmlspecialchars($this->input->get("authtoken", true));
          $cekauth = $this->cek_auth($auth);

          if ($cekauth == 501) {
               $output = array(
                    "draw" => '',
                    "recordsTotal" => 0,
                    "recordsFiltered" => 0,
                    "data" => '',
                    "pesan" => "Autentikasi tidak valid, refresh data"

               );

               echo json_encode($output);
          } else {

               $auth_per = htmlspecialchars($this->input->get("auth_per"));
               $list = $this->dprt->get_datatables($auth_per);

               $data = array();
               $no = $_POST['start'];
               foreach ($list as $dprt) {
                    $no++;
                    $row = array();
                    $row['no'] = $no;
                    $row['auth_depart'] = $dprt->auth_depart;
                    $row['kd_depart'] = $dprt->kd_depart;
                    $row['depart'] = $dprt->depart;
                    $row['ket_depart'] = $dprt->ket_depart;

                    if ($dprt->stat_depart == "T") {
                         $row['stat_depart'] = "<span class='btn btn-success btn-sm '> AKTIF </span>";
                    } else {
                         $row['stat_depart'] = "<div class='btn btn-danger btn-sm'> NONAKTIF </div>";
                    }

                    $row['kode_perusahaan'] = $dprt->kode_perusahaan;
                    $row['tgl_buat'] = date('d-M-Y', strtotime($dprt->tgl_buat));
                    $row['tgl_edit'] = date('d-M-Y', strtotime($dprt->tgl_edit));
                    $row['proses'] = '<button id="' . $dprt->auth_depart . '" class="btn btn-primary btn-sm font-weight-bold dtldepart" title="Detail" value="' . $dprt->depart . '"> <i class="fas fa-asterisk"></i> </button> 
                    <button id="' . $dprt->auth_depart . '" class="btn btn-warning btn-sm font-weight-bold edttdepart" title="Edit" value="' . $dprt->depart . '"> <i class="fas fa-edit"></i> </button> 
                    <button id="' . $dprt->auth_depart . '" class="btn btn-danger btn-sm font-weight-bold hpsdepart" title="Hapus" value="' . $dprt->depart . '"> <i class="fas fa-trash-alt"></i> </button>';
                    $data[] = $row;
               }

               $output = array(
                    "draw" => $_POST['draw'],
                    "recordsTotal" => $this->dprt->count_all(),
                    "recordsFiltered" => $this->dprt->count_filtered($auth_per),
                    "data" => $data,

               );

               echo json_encode($output);
          }
     }

     public function tabel_depart($auth_perusahaan)
     {
          $data['depart'] = $this->dprt->tabel_depart($auth_perusahaan);
          $this->load->view('dashboard/departemen/depart_tabel', $data);
     }

     public function input_depart()
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
               $this->form_validation->set_rules("depart", "depart", "required|trim|max_length[100]", [
                    'required' => 'Departemen wajib diisi',
                    'max_length' => 'Departemen maksimal 100 karakter'
               ]);
               $this->form_validation->set_rules("ket", "ket", "trim|max_length[1000]", [
                    'max_length' => 'Keterangan maksimal 1000 karakter'
               ]);

               if ($this->form_validation->run() == false) {
                    $error = [
                         'statusCode' => 202,
                         'prs' => form_error("prs"),
                         'kode' => form_error("kode"),
                         'depart' => form_error("depart")
                    ];

                    echo json_encode($error);
                    return;
               } else {
                    $token = strip_tags(trim($this->input->post('token', true)));
                    $valid_token = $this->session->csrf_token;
                    $email = $this->session->email_hcdata;
                    $auth_perusahaan = htmlspecialchars($this->input->post("prs", true));
                    $kd_depart = strip_tags($this->input->post("kode", true));
                    $depart = strip_tags($this->input->post("depart", true));
                    $ket_depart = strip_tags($this->input->post("ket"));
                    $id_perusahaan = $this->prs->get_by_auth($auth_perusahaan);

                    $token = strip_tags(trim($this->input->post('token', true)));
                    $valid_token = $this->session->csrf_token;
                    $email = $this->session->email_hcdata;
                    if ($token !== $valid_token) {
                         $data_err = [
                              'email_error' => $email,
                              'ip_error' => $_SERVER['REMOTE_ADDR'],
                              'ip_akses' => $_SERVER['REMOTE_ADDR'],
                              'msg_error' => 'Token tidak valid : ' . $token . " - valid token : " . $valid_token,
                              'tgl_buat' => date('Y-m-d H:i:s'),
                         ];

                         $err = $this->lgn->get_err_log($data_err);

                         redirect(base_url('errauth'));
                         die;
                    }

                    if ($id_perusahaan == 0) {
                         echo json_encode(array("statusCode" => 201, "kode_pesan" => "Gagal", "pesan" => "Perusahaan tidak terdaftar", "tipe_pesan" => "error"));
                         return;
                    }

                    $cekkode = $this->dprt->cek_kode($id_perusahaan, $kd_depart);
                    if ($cekkode) {
                         echo json_encode(array("statusCode" => 201, "kode_pesan" => "Gagal", "pesan" => "Kode sudah digunakan", "tipe_pesan" => "error"));
                         return;
                    }

                    $cekdepart = $this->dprt->cek_depart($id_perusahaan, $depart);
                    if ($cekdepart) {
                         echo json_encode(array("statusCode" => 201, "kode_pesan" => "Gagal", "pesan" => "Departemen sudah digunakan", "tipe_pesan" => "error"));
                         return;
                    }

                    $data = [
                         'kd_depart' => $kd_depart,
                         'depart' => $depart,
                         'ket_depart' => $ket_depart,
                         'stat_depart' => 'T',
                         'tgl_buat' => date('Y-m-d H:i:s'),
                         'tgl_edit' => date('Y-m-d H:i:s'),
                         'id_user' => $this->session->userdata('id_user_hcdata'),
                         'id_perusahaan' => $id_perusahaan
                    ];

                    $depart = $this->dprt->input_depart($data);
                    if ($depart) {
                         echo json_encode(array("statusCode" => 200, "kode_pesan" => "Berhasil", "pesan" => "Departemen berhasil disimpan", "tipe_pesan" => "success"));
                    } else {
                         echo json_encode(array("statusCode" => 201, "kode_pesan" => "Gagal", "pesan" => "Departemen gagal disimpan", "tipe_pesan" => "error"));
                    }
               }
          }
     }

     public function hapus_depart()
     {

          $auth = htmlspecialchars($this->input->post("token", true));
          $cekauth = $this->cek_auth($auth);

          if ($cekauth == 501) {
               echo json_encode(array('statusCode' => 201, "kode_pesan" => "Gagal", "pesan" => "Autentikasi tidak valid, refresh data", "tipe_pesan" => "error"));
          } else {
               $auth_depart = htmlspecialchars(trim($this->input->post('authdepart')));
               $query = $this->dprt->hapus_depart($auth_depart);
               if ($query == 200) {
                    echo json_encode(array("statusCode" => 200, "kode_pesan" => "Berhasil", "pesan" => "Departemen berhasil dihapus", "tipe_pesan" => "success"));
                    return;
               } else if ($query == 201) {
                    echo json_encode(array("statusCode" => 201, "kode_pesan" => "Gagal", "pesan" => "Departemen gagal dihapus", "tipe_pesan" => "error"));
                    return;
               } else {
                    echo json_encode(array("statusCode" => 202, "kode_pesan" => "Gagal", "pesan" => "Departemen tidak ditemukan", "tipe_pesan" => "error"));
                    return;
               }
          }
     }

     public function detail_depart()
     {
          $auth = htmlspecialchars($this->input->post("token", true));
          $cekauth = $this->cek_auth($auth);

          if ($cekauth == 501) {
               echo json_encode(array('statusCode' => 201, "kode_pesan" => "Gagal", "pesan" => "Autentikasi tidak valid, refresh data", "tipe_pesan" => "error"));
          } else {
               $auth_depart = htmlspecialchars(trim($this->input->post("authdepart", true)));
               $query = $this->dprt->get_depart_id($auth_depart);
               if (!empty($query)) {
                    foreach ($query as $list) {
                         if ($list->stat_depart == "T") {
                              $status = "AKTIF";
                         } else {
                              $status = "NONAKTIF";
                         }

                         $data = [
                              'statusCode' => 200,
                              'nama_perusahaan' => $list->nama_perusahaan,
                              'kode' => $list->kd_depart,
                              'depart' => $list->depart,
                              'ket' => $list->ket_depart,
                              'status' => $status,
                              'tgl_buat' => date('d-M-Y H:i:s', strtotime($list->tgl_buat)),
                              'pembuat' => $list->nama_user
                         ];

                         $this->session->set_userdata('id_depart_hcdata', $list->id_depart);
                         $this->session->set_userdata('id_perusahaan_depart', $list->id_perusahaan);
                    }

                    echo json_encode($data);
               } else {
                    echo json_encode(array('statusCode' => 201, "kode_pesan" => "Gagal", "pesan" => "Departemen tidak ditemukan", "tipe_pesan" => "error"));
               }
          }
     }

     public function edit_depart()
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
               $this->form_validation->set_rules("depart", "depart", "required|trim|max_length[100]", [
                    'required' => 'Departemen wajib diisi',
                    'max_length' => 'Departemen maksimal 100 karakter'
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
                         'depart' => form_error("depart"),
                         'status' => form_error("status")
                    ];

                    echo json_encode($error);
                    die;
               } else {
                    if ($this->session->userdata('id_perusahaan_depart') == "") {
                         echo json_encode(array("statusCode" => 201, "kode_pesan" => "Gagal", "pesan" => "Perusahaan tidak terdaftar", "tipe_pesan" => "error"));
                         return;
                    }

                    if ($this->session->userdata('id_depart_hcdata') == "") {
                         echo json_encode(array("statusCode" => 201, "kode_pesan" => "Gagal", "pesan" => "Departemen tidak ditemukan", "tipe_pesan" => "error"));
                         return;
                    }

                    $kd_depart = strip_tags($this->input->post("kode", true));
                    $depart = strip_tags($this->input->post("depart", true));
                    $ket_depart = strip_tags($this->input->post("ket", true));

                    if (strip_tags($this->input->post("status", true)) == "AKTIF") {
                         $status = "T";
                    } else {
                         $status = "F";
                    }

                    $depart = $this->dprt->edit_depart($kd_depart, $depart, $ket_depart, $status);

                    if ($depart == 200) {
                         echo json_encode(array("statusCode" => 200, "kode_pesan" => "Berhasil", "pesan" => "Departemen berhasil diupdate", "tipe_pesan" => "success"));
                    } else if ($depart == 201) {
                         echo json_encode(array("statusCode" => 201, "kode_pesan" => "Gagal", "pesan" => "Departemen gagal diupdate", "tipe_pesan" => "error"));
                    } else if ($depart == 203) {
                         echo json_encode(array("statusCode" => 203, "kode_pesan" => "Gagal", "pesan" => "Kode sudah digunakan", "tipe_pesan" => "error"));
                    } else if ($depart == 204) {
                         echo json_encode(array("statusCode" => 205, "kode_pesan" => "Gagal", "pesan" => "Departemen sudah digunakan", "tipe_pesan" => "error"));
                    }
               }
          }
     }

     public function get_all()
     {
          $query = $this->dprt->get_all();
          $output = "<option value=''>-- WAJIB DIPILIH --</option>";
          if (!empty($query)) {
               foreach ($query as $list) {
                    $output = $output . "<option value='" . $list->auth_depart . "'>" . $list->depart . "</option>";
               }
               echo json_encode(array("statusCode" => 200, "dprt" => $output));
          } else {
               $output = "<option value=''>-- DEPARTEMEN TIDAK DITEMUKAN --</option>";
               echo json_encode(array("statusCode" => 201, "dprt" => $output));
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
               $query = $this->dprt->get_by_authper($auth_per);
               $output = "<option value=''>-- PILIH DEPARTEMEN --</option>";
               if (!empty($query)) {
                    foreach ($query as $list) {
                         $output = $output . "<option value='" . $list->auth_depart . "'>" . $list->depart . "</option>";
                    }
                    echo json_encode(array("statusCode" => 200, "dprt" => $output));
               } else {
                    $output = "<option value=''>-- DEPARTEMEN TIDAK DITEMUKAN --</option>";
                    echo json_encode(array("statusCode" => 201, "dprt" => $output));
               }
          }
     }

     public function get_by_auth_m_per()
     {
          $auth = htmlspecialchars($this->input->post("token", true));
          $this->cek_auth($auth);

          $auth_m_per = htmlspecialchars($this->input->post('auth_m_per', true));
          $query = $this->dprt->get_by_auth_m_per($auth_m_per);
          $output = "<option value=''>-- PILIH DEPARTEMEN --</option>";
          if (!empty($query)) {
               foreach ($query as $list) {
                    $output = $output . "<option value='" . $list->auth_depart . "'>" . $list->depart . "</option>";
               }
               echo json_encode(array("statusCode" => 200, "dprt" => $output));
          } else {
               $output = "<option value=''>-- DEPARTEMEN TIDAK DITEMUKAN --</option>";
               echo json_encode(array("statusCode" => 201, "dprt" => $output));
          }
     }

     public function get_auth_depart_by_id()
     {
          $id_depart = $this->input->post('id_depart');
          $query = $this->dprt->get_auth_depart($id_depart);
          if ($query === 0) {
               return 0;
          } else {
               return $query;
          }
     }
}
