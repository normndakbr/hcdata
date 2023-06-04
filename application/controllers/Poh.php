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
          $data['nama'] = $this->session->userdata("nama");
          $data['email'] = $this->session->userdata("email");
          $data['menu'] = $this->session->userdata("id_menu");
          $this->load->view('dashboard/template/header', $data);
          $this->load->view('dashboard/poh/poh');
          $this->load->view('dashboard/modal/mdlform');
          $this->load->view('dashboard/template/footer', $data);
          $this->load->view('dashboard/code/poh');
     }

     public function new()
     {
          $data['nama'] = $this->session->userdata("nama");
          $data['email'] = $this->session->userdata("email");
          $data['menu'] = $this->session->userdata("id_menu");
          $this->load->view('dashboard/template/header', $data);
          $this->load->view('dashboard/poh/poh_add');
          $this->load->view('dashboard/modal/mdlform');
          $this->load->view('dashboard/template/footer', $data);
          $this->load->view('dashboard/code/poh');
     }

     public function ajax_list()
     {
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

     public function input_poh()
     {
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
               $ket_poh = htmlspecialchars($this->input->post("ket"));

               $cekkode = $this->pho->cek_kode($kd_poh);
               if ($cekkode) {
                    echo json_encode(array("statusCode" => 201, "pesan" => "Kode sudah digunakan"));
                    return;
               }

               $cekpoh = $this->pho->cek_poh($poh);
               if ($cekpoh) {
                    echo json_encode(array("statusCode" => 201, "pesan" => "Point of hire sudah digunakan"));
                    return;
               }

               $data = [
                    'kd_poh' => $kd_poh,
                    'poh' => $poh,
                    'ket_poh' => $ket_poh,
                    'stat_poh' => 'T',
                    'tgl_buat' => date('Y-m-d H:i:s'),
                    'tgl_edit' => date('Y-m-d H:i:s'),
                    'id_user' => $this->session->userdata('id_user')
               ];

               $poh = $this->pho->input_poh($data);
               if ($poh) {
                    echo json_encode(array("statusCode" => 200, "pesan" => "Point of hire berhasil disimpan"));
               } else {
                    echo json_encode(array("statusCode" => 201, "pesan" => "Point of hire gagal disimpan"));
               }
          }
     }

     public function hapus_poh()
     {
          $auth_poh = htmlspecialchars(trim($this->input->post('auth_poh')));
          $query = $this->pho->hapus_poh($auth_poh);
          if ($query == 200) {
               echo json_encode(array("statusCode" => 200, "pesan" => "Point of hire berhasil dihapus"));
               return;
          } else if ($query == 201) {
               echo json_encode(array("statusCode" => 201, "pesan" => "Point of hire gagal dihapus"));
               return;
          } else {
               echo json_encode(array("statusCode" => 202, "pesan" => "Point of hire tidak ditemukan"));
               return;
          }
     }

     public function detail_poh()
     {
          $auth_poh = htmlspecialchars(trim($this->input->post("auth_poh")));
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

                    $this->session->set_userdata('id_poh', $list->id_poh);
               }
               echo json_encode($data);
          } else {
               echo json_encode(array('statusCode' => 201, "pesan" => "Point of hire tidak ditemukan"));
          }
     }

     public function edit_poh()
     {
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
               if ($this->session->userdata('id_poh') == "") {
                    echo json_encode(array("statusCode" => 201, "pesan" => "Point of hire tidak ditemukan"));
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
                    echo json_encode(array("statusCode" => 200, "pesan" => "Point of hire berhasil diupdate"));
               } else if ($poh == 201) {
                    echo json_encode(array("statusCode" => 201, "pesan" => "Point of hire gagal diupdate"));
               } else if ($poh == 203) {
                    echo json_encode(array("statusCode" => 203, "pesan" => "Kode sudah digunakan"));
               } else if ($poh == 204) {
                    echo json_encode(array("statusCode" => 205, "pesan" => "Point of hire sudah digunakan"));
               }
          }
     }

     public function get_all()
     {
          $query = $this->pho->get_all();
          $output = "<option value=''>-- WAJIB DIPILIH --</option>";
          if (!empty($query)) {
               foreach ($query as $list) {
                    $output = $output . "<option value='" . $list->auth_poh . "'>" . $list->poh . "</option>";
               }
               echo json_encode(array("statusCode" => 200, "pho" => $output));
          } else {
               $output = "<option value=''>-- Lokasi POH tidak ditemukan --</option>";
               echo json_encode(array("statusCode" => 201, "pho" => $output));
          }
     }

     public function get_by_authper()
     {
          $auth_per = $this->input->post('auth_per');

          $query = $this->pho->get_by_authper($auth_per);
          $output = "<option value=''>-- Pilih poh --</option>";
          if (!empty($query)) {
               foreach ($query as $list) {
                    $output = $output . "<option value='" . $list->auth_poh . "'>" . $list->poh . "</option>";
               }
               echo json_encode(array("statusCode" => 200, "pho" => $output));
          } else {
               $output = "<option value=''>-- poh tidak Ditemukan --</option>";
               echo json_encode(array("statusCode" => 201, "pho" => $output));
          }
     }

     public function get_by_idper()
     {
          if ($this->session->userdata('id_perusahaan_poh') != "") {
               $id_per = $this->session->userdata('id_perusahaan_poh');
               $output = "<option value=''>-- Pilih poh --</option>";
               $query = $this->pho->get_by_idper($id_per);
               foreach ($query as $list) {
                    $output = $output . " <option value='" . $list->auth_poh . "'>" . $list->poh . "</option>";
               }

               echo json_encode(array("statusCode" => 200, "poh" => $output, "pesan" => "Sukses"));
          } else {
               $output = "<option value=''>-- pohemen tidak ditemukan --</option>";
               echo json_encode(array("statusCode" => 200, "poh" => $output, "pesan", "poh gagal ditampilkan"));
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
               echo json_encode(array("statusCode" => 200, "pho" => $output));
          } else {
               $output = "<option value=''>-- Data lokasi POH tidak ada --</option>";
               echo json_encode(array("statusCode" => 201, "pho" => $output));
          }
     }
}
