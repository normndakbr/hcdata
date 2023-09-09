<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Unit extends My_Controller
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
          $this->load->view('dashboard/unit/unit');
          $this->load->view('dashboard/modal/mdlform');
          $this->load->view('dashboard/template/footer', $data);
          $this->load->view('dashboard/code/unit');
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
          $this->load->view('dashboard/unit/unit_add');
          $this->load->view('dashboard/modal/mdlform');
          $this->load->view('dashboard/template/footer', $data);
          $this->load->view('dashboard/code/unit');
     }

     public function ajax_list()
     {
          $auth = htmlspecialchars($this->input->get("authtoken", true));
          $cekauth = $this->cek_auth($auth);

          if ($cekauth == 501) {
               echo json_encode(array('statusCode' => 201, "kode_pesan" => "Gagal", "pesan" => "Autentikasi tidak valid, refresh data", "tipe_pesan" => "error"));
          } else {
               $list = $this->unt->get_datatables();
               $data = array();
               $no = $_POST['start'];
               foreach ($list as $unt) {
                    $no++;
                    $row = array();
                    $row['no'] = $no;
                    $row['auth_unit'] = $unt->auth_unit;
                    $row['kode_unit'] = $unt->kode_unit;
                    $row['unit'] = $unt->unit;
                    $row['ket_unit'] = $unt->ket_unit;

                    if ($unt->stat_unit == "T") {
                         $row['stat_unit'] = "<span class='btn btn-success btn-sm '> AKTIF </span>";
                    } else {
                         $row['stat_unit'] = "<div class='btn btn-danger btn-sm'> NONAKTIF </div>";
                    }

                    $row['tgl_buat'] = date('d-M-Y', strtotime($unt->tgl_buat));
                    $row['tgl_edit'] = date('d-M-Y', strtotime($unt->tgl_edit));
                    $row['proses'] = '<button id="' . $unt->auth_unit . '" class="btn btn-primary btn-sm font-weight-bold dtlunit" title="Detail" value="' . $unt->unit . '"> <i class="fas fa-asterisk"></i> </button> 
                    <button id="' . $unt->auth_unit . '" class="btn btn-warning btn-sm font-weight-bold edttunit" title="Edit" value="' . $unt->unit . '"> <i class="fas fa-edit"></i> </button> 
                    <button id="' . $unt->auth_unit . '" class="btn btn-danger btn-sm font-weight-bold hpsunit" title="Hapus" value="' . $unt->unit . '"> <i class="fas fa-trash-alt"></i> </button>';
                    $data[] = $row;
               }

               $output = array(
                    "draw" => $_POST['draw'],
                    "recordsTotal" => $this->unt->count_all(),
                    "recordsFiltered" => $this->unt->count_filtered(),
                    "data" => $data,
               );
               //output to json format
               echo json_encode($output);
          }
     }

     public function input_unit()
     {
          $auth = htmlspecialchars($this->input->post("token", true));
          $cekauth = $this->cek_auth($auth);

          if ($cekauth == 501) {
               echo json_encode(array('statusCode' => 201, "kode_pesan" => "Gagal", "pesan" => "Autentikasi tidak valid, refresh data", "tipe_pesan" => "error"));
          } else {
               $this->form_validation->set_rules("kode_unit", "kode_unit", "required|trim|max_length[10]", [
                    'required' => 'Kode unit wajib diisi',
                    'max_length' => 'Kode unit maksimal 10 karakter'
               ]);
               $this->form_validation->set_rules("unit", "unit", "required|trim|max_length[100]", [
                    'required' => 'unit wajib diisi',
                    'max_length' => 'unit maksimal 100 karakter'
               ]);
               $this->form_validation->set_rules("ket", "ket", "trim|max_length[1000],[
               'max_length' => 'Keterangan maksimal 1000 karakter'
          ]");

               if ($this->form_validation->run() == false) {
                    $error = [
                         'statusCode' => 202,
                         'kode_unit' => form_error("kode_unit"),
                         'unit' => form_error("unit"),
                         'ket' => form_error("ket")
                    ];

                    echo json_encode($error);
                    return;
               } else {
                    $kode_unit = strtoupper(htmlspecialchars($this->input->post("kode_unit", true)));
                    $unit = strtoupper(htmlspecialchars($this->input->post("unit", true)));
                    $ket_unit = htmlspecialchars($this->input->post("ket"));

                    $cekkodeunit = $this->unt->cek_kode_unit($kode_unit);
                    if ($cekkodeunit) {
                         echo json_encode(array("statusCode" => 201, "kode_pesan" => "Gagal", "pesan" => "Kode unit sudah digunakan", "tipe_pesan" => "error"));
                         return;
                    }

                    $cekunit = $this->unt->cek_unit($unit);
                    if ($cekunit) {
                         echo json_encode(array("statusCode" => 201, "kode_pesan" => "Gagal", "pesan" => "Unit sudah digunakan", "tipe_pesan" => "error"));
                         return;
                    }

                    $data = [
                         'kode_unit' => $kode_unit,
                         'unit' => $unit,
                         'ket_unit' => $ket_unit,
                         'stat_unit' => 'T',
                         'tgl_buat' => date('Y-m-d H:i:s'),
                         'tgl_edit' => date('Y-m-d H:i:s'),
                         'id_user' => $this->session->userdata('id_user_hcdata')
                    ];

                    $unit = $this->unt->input_unit($data);
                    if ($unit) {
                         echo json_encode(array("statusCode" => 200, "kode_pesan" => "Berhasil", "pesan" => "Unit berhasil disimpan", "tipe_pesan" => "success"));
                    } else {
                         echo json_encode(array("statusCode" => 201, "kode_pesan" => "Gagal", "pesan" => "Unit gagal disimpan", "tipe_pesan" => "error"));
                    }
               }
          }
     }

     public function hapus_unit()
     {
          $auth = htmlspecialchars($this->input->post("token", true));
          $cekauth = $this->cek_auth($auth);

          if ($cekauth == 501) {
               echo json_encode(array('statusCode' => 201, "kode_pesan" => "Gagal", "pesan" => "Autentikasi tidak valid, refresh data", "tipe_pesan" => "error"));
          } else {
               $auth_unit = htmlspecialchars(trim($this->input->post('auth_unit')));
               $query = $this->unt->hapus_unit($auth_unit);
               if ($query == 200) {
                    echo json_encode(array("statusCode" => 200, "kode_pesan" => "Berhasil", "pesan" => "Unit berhasil dihapus", "tipe_pesan" => "success"));
                    return;
               } else if ($query == 201) {
                    echo json_encode(array("statusCode" => 201, "kode_pesan" => "Gagal", "pesan" => "Unit gagal dihapus", "tipe_pesan" => "error"));
                    return;
               } else {
                    echo json_encode(array("statusCode" => 202, "kode_pesan" => "Gagal", "pesan" => "Unit tidak ditemukan", "tipe_pesan" => "error"));
                    return;
               }
          }
     }

     public function detail_unit()
     {
          $auth = htmlspecialchars($this->input->post("token", true));
          $cekauth = $this->cek_auth($auth);

          if ($cekauth == 501) {
               echo json_encode(array('statusCode' => 201, "kode_pesan" => "Gagal", "pesan" => "Autentikasi tidak valid, refresh data", "tipe_pesan" => "error"));
          } else {
               $auth_unit = htmlspecialchars(trim($this->input->post("auth_unit")));
               $query = $this->unt->get_unit_id($auth_unit);
               if (!empty($query)) {
                    foreach ($query as $list) {
                         if ($list->stat_unit == "T") {
                              $status = "AKTIF";
                         } else {
                              $status = "NONAKTIF";
                         }

                         $data = [
                              'statusCode' => 200,
                              'kode_unit' => $list->kode_unit,
                              'unit' => $list->unit,
                              'ket' => $list->ket_unit,
                              'status' => $status,
                              'tgl_buat' => date('d-M-Y H:i:s', strtotime($list->tgl_buat)),
                              'pembuat' => $list->nama_user
                         ];

                         $this->session->set_userdata('id_unit_hcdata', $list->id_unit);
                    }
                    echo json_encode($data);
               } else {
                    echo json_encode(array('statusCode' => 201, "kode_pesan" => "Gagal", "pesan" => "Unit tidak ditemukan", "tipe_pesan" => "error"));
               }
          }
     }

     public function edit_unit()
     {
          $auth = htmlspecialchars($this->input->post("token", true));
          $cekauth = $this->cek_auth($auth);

          if ($cekauth == 501) {
               echo json_encode(array('statusCode' => 201, "kode_pesan" => "Gagal", "pesan" => "Autentikasi tidak valid, refresh data", "tipe_pesan" => "error"));
          } else {

               $this->form_validation->set_rules("kode_unit", "kode_unit", "required|trim|max_length[10]", [
                    'required' => 'Kode unit wajib diisi',
                    'max_length' => 'Unit maksimal 10 karakter'
               ]);
               $this->form_validation->set_rules("unit", "unit", "required|trim|max_length[100]", [
                    'required' => 'Unit wajib diisi',
                    'max_length' => 'Unit maksimal 100 karakter'
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
                         'kode_unit' => form_error("kode_unit"),
                         'unit' => form_error("unit"),
                         'status' => form_error("status"),
                         'ket' => form_error('ket')
                    ];

                    echo json_encode($error);
                    die;
               } else {
                    if ($this->session->userdata('id_unit_hcdata') == "") {
                         echo json_encode(array("statusCode" => 201, "kode_pesan" => "Gagal", "pesan" => "Unit tidak ditemukan", "tipe_pesan" => "error"));
                         return;
                    }

                    $kode_unit = strtoupper(htmlspecialchars($this->input->post("kode_unit", true)));
                    $unit = strtoupper(htmlspecialchars($this->input->post("unit", true)));
                    $ket_unit = htmlspecialchars($this->input->post("ket", true));
                    if (htmlspecialchars($this->input->post("status", true)) == "AKTIF") {
                         $status = "T";
                    } else {
                         $status = "F";
                    }

                    $unit = $this->unt->edit_unit($kode_unit, $unit, $ket_unit, $status);
                    if ($unit == 200) {
                         echo json_encode(array("statusCode" => 200, "kode_pesan" => "Berhasil", "pesan" => "Unit berhasil diupdate", "tipe_pesan" => "success"));
                    } else if ($unit == 201) {
                         echo json_encode(array("statusCode" => 201, "kode_pesan" => "Gagal", "pesan" => "Unit gagal diupdate", "tipe_pesan" => "error"));
                    } else if ($unit == 204) {
                         echo json_encode(array("statusCode" => 205, "kode_pesan" => "Gagal", "pesan" => "Unit sudah digunakan", "tipe_pesan" => "error"));
                    }
               }
          }
     }

     public function get_all()
     {
          $query = $this->unt->get_all();
          $output = "<option value=''>-- Pilih unit --</option>";
          if (!empty($query)) {
               foreach ($query as $list) {
                    $output = $output . "<option value='" . $list->auth_unit . "'>" . $list->unit . "</option>";
               }
               echo json_encode(array("statusCode" => 200, "kode_pesan" => "Berhasil", "unt" => $output));
          } else {
               $output = "<option value=''>-- Unit tidak Ditemukan --</option>";
               echo json_encode(array("statusCode" => 201, "kode_pesan" => "Gagal", "unt" => $output));
          }
     }

     public function get_by_authper()
     {
          $auth_per = $this->input->post('auth_per');

          $query = $this->unt->get_by_authper($auth_per);
          $output = "<option value=''>-- Pilih unit --</option>";
          if (!empty($query)) {
               foreach ($query as $list) {
                    $output = $output . "<option value='" . $list->auth_unit . "'>" . $list->unit . "</option>";
               }
               echo json_encode(array("statusCode" => 200, "kode_pesan" => "Berhasil", "unt" => $output));
          } else {
               $output = "<option value=''>-- Unit tidak Ditemukan --</option>";
               echo json_encode(array("statusCode" => 201, "kode_pesan" => "Gagal", "unt" => $output));
          }
     }

     public function get_by_idper()
     {
          if ($this->session->userdata('id_perusahaan_unit') != "") {
               $id_per = $this->session->userdata('id_perusahaan_unit');
               $output = "<option value=''>-- Pilih unit --</option>";
               $query = $this->unt->get_by_idper($id_per);
               foreach ($query as $list) {
                    $output = $output . " <option value='" . $list->auth_unit . "'>" . $list->unit . "</option>";
               }

               echo json_encode(array("statusCode" => 200, "kode_pesan" => "Berhasil", "unit" => $output, "pesan" => "Sukses", "tipe_pesan" => "success"));
          } else {
               $output = "<option value=''>-- unitemen tidak ditemukan --</option>";
               echo json_encode(array("statusCode" => 201, "kode_pesan" => "Gagal", "unit" => $output, "pesan", "Unit gagal ditampilkan", "tipe_pesan" => "error"));
          }
     }
}
