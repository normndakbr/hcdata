<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Lokasikerja extends My_Controller
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
          $this->load->view('dashboard/lokker/lokker');
          $this->load->view('dashboard/template/footer', $data);
          $this->load->view('dashboard/code/lokker');
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
          $this->load->view('dashboard/lokker/lokker_add');
          $this->load->view('dashboard/template/footer', $data);
          $this->load->view('dashboard/code/lokker');
     }

     public function ajax_list()
     {
          $auth = htmlspecialchars($this->input->get("authtoken", true));
          $cekauth = $this->cek_auth($auth);

          if ($cekauth == 501) {
               echo json_encode(array('statusCode' => 201, "kode_pesan" => "Gagal", "pesan" => "Autentikasi tidak valid, refresh data", "tipe_pesan" => "error"));
          } else {

               $list = $this->lkr->get_datatables();
               $data = array();
               $no = $_POST['start'];
               foreach ($list as $lkr) {
                    $no++;
                    $row = array();
                    $row['no'] = $no;
                    $row['auth_lokker'] = $lkr->auth_lokker;
                    $row['kd_lokker'] = $lkr->kd_lokker;
                    $row['lokker'] = $lkr->lokker;
                    $row['ket_lokker'] = $lkr->ket_lokker;

                    if ($lkr->stat_lokker == "T") {
                         $row['stat_lokker'] = "<span class='btn btn-success btn-sm '> AKTIF </span>";
                    } else {
                         $row['stat_lokker'] = "<div class='btn btn-danger btn-sm'> NONAKTIF </div>";
                    }

                    $row['tgl_buat'] = date('d-M-Y', strtotime($lkr->tgl_buat));
                    $row['tgl_edit'] = date('d-M-Y', strtotime($lkr->tgl_edit));
                    $row['proses'] = '<button id="' . $lkr->auth_lokker . '" class="btn btn-primary btn-sm font-weight-bold dtllokker" title="Detail" value="' . $lkr->lokker . '"> <i class="fas fa-asterisk"></i> </button> 
                    <button id="' . $lkr->auth_lokker . '" class="btn btn-warning btn-sm font-weight-bold edttlokker" title="Edit" value="' . $lkr->lokker . '"> <i class="fas fa-edit"></i> </button> 
                    <button id="' . $lkr->auth_lokker . '" class="btn btn-danger btn-sm font-weight-bold hpslokker" title="Hapus" value="' . $lkr->lokker . '"> <i class="fas fa-trash-alt"></i> </button>';
                    $data[] = $row;
               }

               $output = array(
                    "draw" => $_POST['draw'],
                    "recordsTotal" => $this->lkr->count_all(),
                    "recordsFiltered" => $this->lkr->count_filtered(),
                    "data" => $data,
               );
               //output to json format
               echo json_encode($output);
          }
     }

     public function input_lokker()
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
               $this->form_validation->set_rules("lokker", "lokker", "required|trim|max_length[100]", [
                    'required' => 'Lokasi kerja wajib diisi',
                    'max_length' => 'Lokasi kerja maksimal 100 karakter'
               ]);
               $this->form_validation->set_rules("ket", "ket", "trim|max_length[1000],[
               'max_length' => 'Keterangan maksimal 1000 karakter'
          ]");

               if ($this->form_validation->run() == false) {
                    $error = [
                         'statusCode' => 202,
                         'kode' => form_error("kode"),
                         'lokker' => form_error("lokker"),
                         'ket' => form_error("ket")
                    ];

                    echo json_encode($error);
                    return;
               } else {
                    $kd_lokker = strtoupper(htmlspecialchars($this->input->post("kode", true)));
                    $lokker = strtoupper(htmlspecialchars($this->input->post("lokker", true)));
                    $ket_lokker = htmlspecialchars($this->input->post("ket"));

                    $cekkode = $this->lkr->cek_kode($kd_lokker);
                    if ($cekkode) {
                         echo json_encode(array("statusCode" => 201, "kode_pesan" => "Gagal", "pesan" => "Kode sudah digunakan", "tipe_pesan" => "error"));
                         return;
                    }

                    $ceklokker = $this->lkr->cek_lokker($lokker);
                    if ($ceklokker) {
                         echo json_encode(array("statusCode" => 201, "kode_pesan" => "Gagal", "pesan" => "Lokasi kerja sudah digunakan", "tipe_pesan" => "error"));
                         return;
                    }

                    $data = [
                         'kd_lokker' => $kd_lokker,
                         'lokker' => $lokker,
                         'ket_lokker' => $ket_lokker,
                         'stat_lokker' => 'T',
                         'tgl_buat' => date('Y-m-d H:i:s'),
                         'tgl_edit' => date('Y-m-d H:i:s'),
                         'id_user' => $this->session->userdata('id_user_hcdata')
                    ];

                    $lokker = $this->lkr->input_lokker($data);
                    if ($lokker) {
                         echo json_encode(array("statusCode" => 200, "kode_pesan" => "Berhasil", "pesan" => "Lokasi kerja berhasil disimpan", "tipe_pesan" => "success"));
                    } else {
                         echo json_encode(array("statusCode" => 201, "kode_pesan" => "Gagal", "pesan" => "Lokasi kerja gagal disimpan", "tipe_pesan" => "error"));
                    }
               }
          }
     }

     public function hapus_lokker()
     {
          $auth = htmlspecialchars($this->input->post("token", true));
          $cekauth = $this->cek_auth($auth);

          if ($cekauth == 501) {
               echo json_encode(array('statusCode' => 201, "kode_pesan" => "Gagal", "pesan" => "Autentikasi tidak valid, refresh data", "tipe_pesan" => "error"));
          } else {

               $auth_lokker = htmlspecialchars(trim($this->input->post('auth_lokker')));
               $query = $this->lkr->hapus_lokker($auth_lokker);
               if ($query == 200) {
                    echo json_encode(array("statusCode" => 200, "kode_pesan" => "Berhasil", "pesan" => "Lokasi kerja berhasil dihapus", "tipe_pesan" => "success"));
                    return;
               } else if ($query == 201) {
                    echo json_encode(array("statusCode" => 201, "kode_pesan" => "Gagal", "pesan" => "Lokasi kerja gagal dihapus", "tipe_pesan" => "error"));
                    return;
               } else {
                    echo json_encode(array("statusCode" => 202, "kode_pesan" => "Gagal", "pesan" => "Lokasi kerja tidak ditemukan", "tipe_pesan" => "error"));
                    return;
               }
          }
     }

     public function detail_lokker()
     {
          $auth = htmlspecialchars($this->input->post("token", true));
          $cekauth = $this->cek_auth($auth);

          if ($cekauth == 501) {
               echo json_encode(array('statusCode' => 201, "kode_pesan" => "Gagal", "pesan" => "Autentikasi tidak valid, refresh data", "tipe_pesan" => "error"));
          } else {
               $auth_lokker = htmlspecialchars(trim($this->input->post("auth_lokker")));
               $query = $this->lkr->get_lokker_id($auth_lokker);
               if (!empty($query)) {
                    foreach ($query as $list) {
                         if ($list->stat_lokker == "T") {
                              $status = "AKTIF";
                         } else {
                              $status = "NONAKTIF";
                         }

                         $data = [
                              'statusCode' => 200,
                              'kode' => $list->kd_lokker,
                              'lokker' => $list->lokker,
                              'ket' => $list->ket_lokker,
                              'status' => $status,
                              'tgl_buat' => date('d-M-Y H:i:s', strtotime($list->tgl_buat)),
                              'pembuat' => $list->nama_user
                         ];

                         $this->session->set_userdata('id_lokker_hcdata', $list->id_lokker);
                    }
                    echo json_encode($data);
               } else {
                    echo json_encode(array('statusCode' => 201, "kode_pesan" => "Gagal", "pesan" => "Lokasi kerja tidak ditemukan", "tipe_pesan" => "error"));
               }
          }
     }

     public function edit_lokker()
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
               $this->form_validation->set_rules("lokker", "lokker", "required|trim|max_length[100]", [
                    'required' => 'Lokasi kerja wajib diisi',
                    'max_length' => 'Lokasi kerja maksimal 100 karakter'
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
                         'lokker' => form_error("lokker"),
                         'status' => form_error("status"),
                         'ket' => form_error("ket")
                    ];

                    echo json_encode($error);
                    die;
               } else {
                    if ($this->session->userdata('id_lokker_hcdata') == "") {
                         echo json_encode(array("statusCode" => 201, "kode_pesan" => "Gagal", "pesan" => "Lokasi kerja tidak ditemukan", "tipe_pesan" => "error"));
                         return;
                    }

                    $kd_lokker = strtoupper(htmlspecialchars($this->input->post("kode", true)));
                    $lokker = strtoupper(htmlspecialchars($this->input->post("lokker", true)));
                    $ket_lokker = htmlspecialchars($this->input->post("ket", true));
                    if (htmlspecialchars($this->input->post("status", true)) == "AKTIF") {
                         $status = "T";
                    } else {
                         $status = "F";
                    }

                    $lokker = $this->lkr->edit_lokker($kd_lokker, $lokker, $ket_lokker, $status);
                    if ($lokker == 200) {
                         echo json_encode(array("statusCode" => 200, "kode_pesan" => "Berhasil", "pesan" => "Lokasi kerja berhasil diupdate", "tipe_pesan" => "success"));
                    } else if ($lokker == 201) {
                         echo json_encode(array("statusCode" => 201, "kode_pesan" => "Gagal", "pesan" => "Lokasi kerja gagal diupdate", "tipe_pesan" => "error"));
                    } else if ($lokker == 203) {
                         echo json_encode(array("statusCode" => 203, "kode_pesan" => "Gagal", "pesan" => "Kode sudah digunakan", "tipe_pesan" => "error"));
                    } else if ($lokker == 204) {
                         echo json_encode(array("statusCode" => 205, "kode_pesan" => "Gagal", "pesan" => "Lokasi kerja sudah digunakan", "tipe_pesan" => "error"));
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
               $query = $this->lkr->get_all();
               $output = "<option value=''>-- WAJIB DIPILIH --</option>";
               if (!empty($query)) {
                    foreach ($query as $list) {
                         $output = $output . "<option value='" . $list->auth_lokker . "'>" . $list->lokker . "</option>";
                    }
                    echo json_encode(array("statusCode" => 200, "kode_pesan" => "Berhasil", "lkr" => $output, "tipe_pesan" => "success"));
               } else {
                    $output = "<option value=''>-- Lokasi kerja tidak Ditemukan --</option>";
                    echo json_encode(array("statusCode" => 201, "kode_pesan" => "Gagal", "lkr" => $output, "tipe_pesan" => "error"));
               }
          }
     }

     public function get_auth_lokker_by_id()
     {
          $id_lokker = $this->input->post('id_lokker');
          $query = $this->lkr->get_auth_lokker($id_lokker);
          if ($query === 0) {
               return 0;
          } else {
               return $query;
          }
     }
}
