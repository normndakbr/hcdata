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
          $data['nama'] = $this->session->userdata("nama");
          $data['email'] = $this->session->userdata("email");
          $data['menu'] = $this->session->userdata("id_menu");
          $this->load->view('dashboard/template/header', $data);
          $this->load->view('dashboard/level/level');
          $this->load->view('dashboard/modal/mdlform');
          $this->load->view('dashboard/template/footer', $data);
          $this->load->view('dashboard/code/level');
     }

     public function new()
     {
          $data['nama'] = $this->session->userdata("nama");
          $data['email'] = $this->session->userdata("email");
          $data['menu'] = $this->session->userdata("id_menu");
          $this->load->view('dashboard/template/header', $data);
          $this->load->view('dashboard/level/level_add');
          $this->load->view('dashboard/modal/mdlform');
          $this->load->view('dashboard/template/footer', $data);
          $this->load->view('dashboard/code/level');
     }

     public function ajax_list()
     {
          $list = $this->lvl->get_datatables();
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
               "recordsFiltered" => $this->lvl->count_filtered(),
               "data" => $data,
          );
          //output to json format
          echo json_encode($output);
     }

     public function input_level()
     {

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
               $ket_level = htmlspecialchars($this->input->post("ket"));
               $id_perusahaan = $this->prs->get_by_auth($auth_perusahaan);

               if ($id_perusahaan == 0) {
                    echo json_encode(array("statusCode" => 201, "pesan" => "Perusahaan tidak terdaftar"));
                    return;
               }

               $cekkode = $this->lvl->cek_kode($id_perusahaan, $kd_level);
               if ($cekkode) {
                    echo json_encode(array("statusCode" => 201, "pesan" => "Kode sudah digunakan"));
                    return;
               }

               $ceklevel = $this->lvl->cek_level($id_perusahaan, $level);
               if ($ceklevel) {
                    echo json_encode(array("statusCode" => 201, "pesan" => "Level sudah digunakan"));
                    return;
               }

               $data = [
                    'kd_level' => $kd_level,
                    'level' => $level,
                    'ket_level' => $ket_level,
                    'stat_level' => 'T',
                    'tgl_buat' => date('Y-m-d H:i:s'),
                    'tgl_edit' => date('Y-m-d H:i:s'),
                    'id_user' => $this->session->userdata('id_user'),
                    'id_perusahaan' => $id_perusahaan
               ];

               $level = $this->lvl->input_level($data);
               if ($level) {
                    echo json_encode(array("statusCode" => 200, "pesan" => "level berhasil disimpan"));
               } else {
                    echo json_encode(array("statusCode" => 201, "pesan" => "level gagal disimpan"));
               }
          }
     }

     public function hapus_level()
     {
          $auth_level = htmlspecialchars(trim($this->input->post('authlevel')));
          $query = $this->lvl->hapus_level($auth_level);
          if ($query == 200) {
               echo json_encode(array("statusCode" => 200, "pesan" => "level berhasil dihapus"));
               return;
          } else if ($query == 201) {
               echo json_encode(array("statusCode" => 201, "pesan" => "level gagal dihapus"));
               return;
          } else {
               echo json_encode(array("statusCode" => 202, "pesan" => "level tidak ditemukan"));
               return;
          }
     }

     public function detail_level()
     {
          $auth_level = htmlspecialchars(trim($this->input->post("authlevel")));
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

                    $this->session->set_userdata('id_level', $list->id_level);
                    $this->session->set_userdata('id_perusahaan', $list->id_perusahaan);
               }
               echo json_encode($data);
          } else {
               echo json_encode(array('statusCode' => 201, "pesan" => "level tidak ditemukan"));
          }
     }

     public function edit_level()
     {
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
               if ($this->session->userdata('id_perusahaan') == "") {
                    echo json_encode(array("statusCode" => 201, "pesan" => "Perusahaan tidak terdaftar"));
                    return;
               }

               if ($this->session->userdata('id_level') == "") {
                    echo json_encode(array("statusCode" => 201, "pesan" => "level tidak ditemukan"));
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
                    echo json_encode(array("statusCode" => 200, "pesan" => "level berhasil diupdate"));
               } else if ($level == 201) {
                    echo json_encode(array("statusCode" => 201, "pesan" => "level gagal diupdate"));
               } else if ($level == 203) {
                    echo json_encode(array("statusCode" => 203, "pesan" => "Kode sudah digunakan"));
               } else if ($level == 204) {
                    echo json_encode(array("statusCode" => 205, "pesan" => "level sudah digunakan"));
               }
          }
     }

     public function get_all()
     {
          $query = $this->lvl->get_all();
          $output = "<option value=''>-- Pilih level --</option>";
          if (!empty($query)) {
               foreach ($query as $list) {
                    $output = $output . "<option value='" . $list->auth_level . "'>" . $list->level . "</option>";
               }
               echo json_encode(array("statusCode" => 200, "lvl" => $output));
          } else {
               $output = "<option value=''>-- level Tidak Ditemukan --</option>";
               echo json_encode(array("statusCode" => 201, "lvl" => $output));
          }
     }

     public function get_by_authper()
     {
          $auth_per = $this->input->post('auth_per');

          $query = $this->lvl->get_by_authper($auth_per);
          $output = "<option value=''>-- Pilih Level --</option>";
          if (!empty($query)) {
               foreach ($query as $list) {
                    $output = $output . "<option value='" . $list->auth_level . "'>" . $list->level . "</option>";
               }
               echo json_encode(array("statusCode" => 200, "lvl" => $output));
          } else {
               $output = "<option value=''>-- Level Tidak Ditemukan --</option>";
               echo json_encode(array("statusCode" => 201, "lvl" => $output));
          }
     }

     public function get_by_idper()
     {
          if ($this->session->userdata('id_perusahaan_level') != "") {
               $id_per = $this->session->userdata('id_perusahaan_level');
               $output = "<option value=''>-- Pilih Level --</option>";
               $query = $this->lvl->get_by_idper($id_per);
               foreach ($query as $list) {
                    $output = $output . " <option value='" . $list->auth_level . "'>" . $list->level . "</option>";
               }

               echo json_encode(array("statusCode" => 200, "level" => $output, "pesan" => "Sukses"));
          } else {
               $output = "<option value=''>-- levelemen tidak ditemukan --</option>";
               echo json_encode(array("statusCode" => 200, "level" => $output, "pesan", "Level gagal ditampilkan"));
          }
     }
}
