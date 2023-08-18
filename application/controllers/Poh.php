<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Poh extends My_Controller
{
     public function __construct()
     {
          parent::__construct();
          $this->is_logout();
     }

     public function index()
     {
          $id_perusahaan = $this->session->userdata("id_perusahaan_hcdata");
          $data['nama_per'] = $this->prs->get_per_by_id($id_perusahaan);
          $data['nama'] = $this->session->userdata("nama_hcdata");
          $data['email'] = $this->session->userdata("email_hcdata");
          $data['menu'] = $this->session->userdata("id_menu_hcdata");
          $data['get_menu'] = $this->dsmod->get_menu();
          $this->load->view('dashboard/template/header', $data);
          $this->load->view('dashboard/poh/poh');
          $this->load->view('dashboard/template/footer', $data);
          $this->load->view('dashboard/code/poh');
     }

     public function new()
     {
          $id_perusahaan = $this->session->userdata("id_perusahaan_hcdata");
          $data['nama_per'] = $this->prs->get_per_by_id($id_perusahaan);
          $data['nama'] = $this->session->userdata("nama_hcdata");
          $data['email'] = $this->session->userdata("email_hcdata");
          $data['menu'] = $this->session->userdata("id_menu_hcdata");
          $data['get_menu'] = $this->dsmod->get_menu();
          $this->load->view('dashboard/template/header', $data);
          $this->load->view('dashboard/poh/poh_add');
          $this->load->view('dashboard/template/footer', $data);
          $this->load->view('dashboard/code/poh');
     }

     public function ajax_list()
     {

          $auth = htmlspecialchars($this->input->get("authtoken", true));
          $cekauth = $this->cek_auth($auth);

          if ($cekauth == 501) {
               echo json_encode(array('statusCode' => 201, "kode_pesan" => "Gagal", "pesan" => "Autentikasi tidak valid, refresh data", "tipe_pesan" => "error"));
          } else {

               $list = $this->pho->get_datatables();
               $data = array();
               $no = $_POST['start'];
               foreach ($list as $pho) {
                    $no++;
                    $row = array();
                    $row['no'] = $no;
                    $row['auth_poh'] = $pho->auth_poh;
                    $row['kd_poh'] = $pho->kd_poh;
                    $row['poh'] = $pho->poh;
                    $row['ket_poh'] = $pho->ket_poh;

                    if ($pho->stat_poh == "T") {
                         $row['stat_poh'] = "<span class='btn btn-success btn-sm '> AKTIF </span>";
                    } else {
                         $row['stat_poh'] = "<div class='btn btn-danger btn-sm'> NONAKTIF </div>";
                    }

                    $row['tgl_buat'] = date('d-M-Y', strtotime($pho->tgl_buat));
                    $row['tgl_edit'] = date('d-M-Y', strtotime($pho->tgl_edit));
                    $row['proses'] = '<button id="' . $pho->auth_poh . '" class="btn btn-primary btn-sm font-weight-bold dtlpoh" title="Detail" value="' . $pho->poh . '"> <i class="fas fa-asterisk"></i> </button> 
                    <button id="' . $pho->auth_poh . '" class="btn btn-warning btn-sm font-weight-bold edttpoh" title="Edit" value="' . $pho->poh . '"> <i class="fas fa-edit"></i> </button> 
                    <button id="' . $pho->auth_poh . '" class="btn btn-danger btn-sm font-weight-bold hpspoh" title="Hapus" value="' . $pho->poh . '"> <i class="fas fa-trash-alt"></i> </button>';
                    $data[] = $row;
               }

               $output = array(
                    "draw" => $_POST['draw'],
                    "recordsTotal" => $this->pho->count_all(),
                    "recordsFiltered" => $this->pho->count_filtered(),
                    "data" => $data,
               );
               //output to json format
               echo json_encode($output);
          }
     }

     public function input_poh()
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
               $this->form_validation->set_rules("poh", "poh", "required|trim|max_length[100]", [
                    'required' => 'Point of hire wajib diisi',
                    'max_length' => 'Point of hire maksimal 100 karakter'
               ]);
               $this->form_validation->set_rules("ket", "ket", "trim|max_length[1000],[
               'max_length' => 'Keterangan maksimal 1000 karakter'
          ]");

               if ($this->form_validation->run() == false) {
                    $error = [
                         'statusCode' => 202,
                         'kode' => form_error("kode"),
                         'poh' => form_error("poh"),
                         'ket' => form_error("ket")
                    ];

                    echo json_encode($error);
                    return;
               } else {
                    $kd_poh = htmlspecialchars($this->input->post("kode", true));
                    $poh = htmlspecialchars($this->input->post("poh", true));
                    $ket_poh = htmlspecialchars($this->input->post("ket", true));

                    $cekkode = $this->pho->cek_kode($kd_poh);
                    if ($cekkode) {
                         echo json_encode(array("statusCode" => 201, "kode_pesan" => "Gagal", "pesan" => "Kode sudah digunakan", "tipe_pesan" => "error"));
                         return;
                    }

                    $cekpoh = $this->pho->cek_poh($poh);
                    if ($cekpoh) {
                         echo json_encode(array("statusCode" => 201, "kode_pesan" => "Gagal", "pesan" => "Point of hire sudah digunakan", "tipe_pesan" => "error"));
                         return;
                    }

                    $data = [
                         'kd_poh' => $kd_poh,
                         'poh' => $poh,
                         'ket_poh' => $ket_poh,
                         'stat_poh' => 'T',
                         'tgl_buat' => date('Y-m-d H:i:s'),
                         'tgl_edit' => date('Y-m-d H:i:s'),
                         'id_user' => $this->session->userdata('id_user_hcdata')
                    ];

                    $poh = $this->pho->input_poh($data);
                    if ($poh) {
                         echo json_encode(array("statusCode" => 200, "kode_pesan" => "Berhasil", "pesan" => "Point of hire berhasil disimpan", "tipe_pesan" => "success"));
                    } else {
                         echo json_encode(array("statusCode" => 201, "kode_pesan" => "Gagal", "pesan" => "Point of hire gagal disimpan", "tipe_pesan" => "error"));
                    }
               }
          }
     }

     public function hapus_poh()
     {

          $auth = htmlspecialchars($this->input->post("token", true));
          $cekauth = $this->cek_auth($auth);

          if ($cekauth == 501) {
               echo json_encode(array('statusCode' => 201, "kode_pesan" => "Gagal", "pesan" => "Autentikasi tidak valid, refresh data", "tipe_pesan" => "error"));
          } else {
               $auth_poh = htmlspecialchars(trim($this->input->post('auth_poh', true)));
               $query = $this->pho->hapus_poh($auth_poh);
               if ($query == 200) {
                    echo json_encode(array("statusCode" => 200, "kode_pesan" => "Berhasil", "pesan" => "Point of hire berhasil dihapus", "tipe_pesan" => "success"));
                    return;
               } else if ($query == 201) {
                    echo json_encode(array("statusCode" => 201, "kode_pesan" => "Gagal", "pesan" => "Point of hire gagal dihapus", "tipe_pesan" => "error"));
                    return;
               } else {
                    echo json_encode(array("statusCode" => 202, "kode_pesan" => "Gagal", "pesan" => "Point of hire tidak ditemukan", "tipe_pesan" => "error"));
                    return;
               }
          }
     }

     public function detail_poh()
     {

          $auth = htmlspecialchars($this->input->post("token", true));
          $cekauth = $this->cek_auth($auth);

          if ($cekauth == 501) {
               echo json_encode(array('statusCode' => 201, "kode_pesan" => "Gagal", "pesan" => "Autentikasi tidak valid, refresh data", "tipe_pesan" => "error"));
          } else {

               $auth_poh = htmlspecialchars(trim($this->input->post("auth_poh", true)));
               $query = $this->pho->get_poh_id($auth_poh);
               if (!empty($query)) {
                    foreach ($query as $list) {
                         if ($list->stat_poh == "T") {
                              $status = "AKTIF";
                         } else {
                              $status = "NONAKTIF";
                         }

                         $data = [
                              'statusCode' => 200,
                              'kode' => $list->kd_poh,
                              'poh' => $list->poh,
                              'ket' => $list->ket_poh,
                              'status' => $status,
                              'tgl_buat' => date('d-M-Y H:i:s', strtotime($list->tgl_buat)),
                              'pembuat' => $list->nama_user
                         ];

                         $this->session->set_userdata('id_poh_hcdata', $list->id_poh);
                    }
                    echo json_encode($data);
               } else {
                    echo json_encode(array('statusCode' => 201, "kode_pesan" => "Gagal", "pesan" => "Point of hire tidak ditemukan", "tipe_pesan" => "error"));
               }
          }
     }

     public function edit_poh()
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
               $this->form_validation->set_rules("poh", "poh", "required|trim|max_length[100]", [
                    'required' => 'Point of hire wajib diisi',
                    'max_length' => 'Point of hire maksimal 100 karakter'
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
                         'poh' => form_error("poh"),
                         'status' => form_error("status")
                    ];

                    echo json_encode($error);
                    die;
               } else {
                    if ($this->session->userdata('id_poh_hcdata') == "") {
                         echo json_encode(array("statusCode" => 201, "kode_pesan" => "Gagal", "pesan" => "Point of hire tidak ditemukan", "tipe_pesan" => "error"));
                         return;
                    }

                    $kd_poh = htmlspecialchars($this->input->post("kode", true));
                    $poh = htmlspecialchars($this->input->post("poh", true));
                    $ket_poh = htmlspecialchars($this->input->post("ket", true));
                    if (htmlspecialchars($this->input->post("status", true)) == "AKTIF") {
                         $status = "T";
                    } else {
                         $status = "F";
                    }

                    $poh = $this->pho->edit_poh($kd_poh, $poh, $ket_poh, $status);
                    if ($poh == 200) {
                         echo json_encode(array("statusCode" => 200, "kode_pesan" => "Berhasil", "pesan" => "Point of hire berhasil diupdate", "tipe_pesan" => "success"));
                    } else if ($poh == 201) {
                         echo json_encode(array("statusCode" => 201, "kode_pesan" => "Gagal", "pesan" => "Point of hire gagal diupdate", "tipe_pesan" => "error"));
                    } else if ($poh == 203) {
                         echo json_encode(array("statusCode" => 203, "kode_pesan" => "Gagal", "pesan" => "Kode sudah digunakan", "tipe_pesan" => "error"));
                    } else if ($poh == 204) {
                         echo json_encode(array("statusCode" => 205, "kode_pesan" => "Gagal", "pesan" => "Point of hire sudah digunakan", "tipe_pesan" => "error"));
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

               $query = $this->pho->get_all();
               $output = "<option value=''>-- WAJIB DIPILIH --</option>";
               if (!empty($query)) {
                    foreach ($query as $list) {
                         $output = $output . "<option value='" . $list->auth_poh . "'>" . $list->poh . "</option>";
                    }
                    echo json_encode(array("statusCode" => 200, "kode_pesan" => "Berhasil", "pho" => $output, "tipe_pesan" => "success"));
               } else {
                    $output = "<option value=''>-- Lokasi POH tidak ditemukan --</option>";
                    echo json_encode(array("statusCode" => 201, "kode_pesan" => "Gagal", "pho" => $output, "tipe_pesan" => "error"));
               }
          }
     }

     public function get_by_authper()
     {
          $auth_per = htmlspecialchars($this->input->post('auth_per', true));

          $query = $this->pho->get_by_authper($auth_per);
          $output = "<option value=''>-- Pilih POH --</option>";
          if (!empty($query)) {
               foreach ($query as $list) {
                    $output = $output . "<option value='" . $list->auth_poh . "'>" . $list->poh . "</option>";
               }
               echo json_encode(array("statusCode" => 200, "kode_pesan" => "Berhasil", "pho" => $output, "tipe_pesan" => "success"));
          } else {
               $output = "<option value=''>-- poh tidak Ditemukan --</option>";
               echo json_encode(array("statusCode" => 201, "kode_pesan" => "Gagal", "pho" => $output, "tipe_pesan" => "error"));
          }
     }

     public function get_by_idper()
     {
          if ($this->session->userdata('id_perusahaan_poh') != "") {
               $id_per = $this->session->userdata('id_perusahaan_poh');
               $output = "<option value=''>-- Pilih POH --</option>";
               $query = $this->pho->get_by_idper($id_per);
               foreach ($query as $list) {
                    $output = $output . " <option value='" . $list->auth_poh . "'>" . $list->poh . "</option>";
               }

               echo json_encode(array("statusCode" => 200, "kode_pesan" => "Berhasil", "poh" => $output, "pesan" => "Sukses", "tipe_pesan" => "success"));
          } else {
               $output = "<option value=''>-- pohemen tidak ditemukan --</option>";
               echo json_encode(array("statusCode" => 200, "kode_pesan" => "Gagal", "poh" => $output, "pesan", "poh gagal ditampilkan", "tipe_pesan" => "error"));
          }
     }

     public function get_by_authpoh()
     {
          $auth_poh = $this->input->post('auth_poh');

          $query = $this->pho->get_poh_id($auth_poh);
          $output = "<option value=''>-- Pilih Lokasi POH --</option>";
          if (!empty($query)) {
               foreach ($query as $list) {
                    $output = $output . "<option value='" . $list->auth_poh . "'>" . $list->poh . "</option>";
               }
               echo json_encode(array("statusCode" => 200, "kode_pesan" => "Berhasil", "pho" => $output, "tipe_pesan" => "success"));
          } else {
               $output = "<option value=''>-- Data lokasi POH tidak ada --</option>";
               echo json_encode(array("statusCode" => 201, "kode_pesan" => "Gagal", "pho" => $output, "tipe_pesan" => "error"));
          }
     }

     public function get_auth_poh_by_id()
     {
          $id_poh = $this->input->post('id_poh');
          $query = $this->pho->get_auth_poh($id_poh);
          if ($query === 0) {
               return 0;
          } else {
               return $query;
          }
     }
}
