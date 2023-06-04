<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Tipe extends My_Controller
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
          $this->load->view('dashboard/tipe/tipe');
          $this->load->view('dashboard/modal/mdlform');
          $this->load->view('dashboard/template/footer', $data);
          $this->load->view('dashboard/code/tipe');
     }

     public function new()
     {
          $data['nama'] = $this->session->userdata("nama");
          $data['email'] = $this->session->userdata("email");
          $data['menu'] = $this->session->userdata("id_menu");
          $this->load->view('dashboard/template/header', $data);
          $this->load->view('dashboard/tipe/tipe_add');
          $this->load->view('dashboard/modal/mdlform');
          $this->load->view('dashboard/template/footer', $data);
          $this->load->view('dashboard/code/tipe');
     }

     public function ajax_list()
     {
          $list = $this->tpe->get_datatables();
          $data = array();
          $no = $_POST['start'];
          foreach ($list as $tpe) {
               $no++;
               $row = array();
               $row['no'] = $no;
               $row['auth_tipe'] = $tpe->auth_tipe;
               $row['kd_tipe'] = $tpe->kd_tipe;
               $row['tipe'] = $tpe->tipe;
               $row['ket_tipe'] = $tpe->ket_tipe;

               if ($tpe->stat_tipe == "T") {
                    $row['stat_tipe'] = "<span class='btn btn-success btn-sm '> AKTIF </span>";
               } else {
                    $row['stat_tipe'] = "<div class='btn btn-danger btn-sm'> NONAKTIF </div>";
               }

               $row['kode_perusahaan'] = $tpe->kode_perusahaan;
               $row['tgl_buat'] = date('d-M-Y', strtotime($tpe->tgl_buat));
               $row['tgl_edit'] = date('d-M-Y', strtotime($tpe->tgl_edit));
               $row['proses'] = '<button id="' . $tpe->auth_tipe . '" class="btn btn-primary btn-sm font-weight-bold dtltipe" title="Detail" value="' . $tpe->tipe . '"> <i class="fas fa-asterisk"></i> </button> 
                    <button id="' . $tpe->auth_tipe . '" class="btn btn-warning btn-sm font-weight-bold edtttipe" title="Edit" value="' . $tpe->tipe . '"> <i class="fas fa-edit"></i> </button> 
                    <button id="' . $tpe->auth_tipe . '" class="btn btn-danger btn-sm font-weight-bold hpstipe" title="Hapus" value="' . $tpe->tipe . '"> <i class="fas fa-trash-alt"></i> </button>';
               $data[] = $row;
          }

          $output = array(
               "draw" => $_POST['draw'],
               "recordsTotal" => $this->tpe->count_all(),
               "recordsFiltered" => $this->tpe->count_filtered(),
               "data" => $data,
          );
          //output to json format
          echo json_encode($output);
     }

     public function input_tipe()
     {

          $this->form_validation->set_rules("prs", "prs", "required|trim", [
               'required' => 'Perusahaan wajib dipilih'
          ]);
          $this->form_validation->set_rules("kode", "kode", "required|trim|max_length[8]", [
               'required' => 'Kode wajib diisi',
               'max_length' => 'Kode maksimal 8 karakter'
          ]);
          $this->form_validation->set_rules("tipe", "tipe", "required|trim|max_length[100]", [
               'required' => 'Tipe wajib diisi',
               'max_length' => 'Tipe maksimal 100 karakter'
          ]);
          $this->form_validation->set_rules("ket", "ket", "trim|max_length[1000],[
               'max_length' => 'Keterangan maksimal 1000 karakter'
          ]");

          if ($this->form_validation->run() == false) {
               $error = [
                    'statusCode' => 202,
                    'prs' => form_error("prs"),
                    'kode' => form_error("kode"),
                    'tipe' => form_error("tipe"),
                    'ket' => form_error("ket")
               ];

               echo json_encode($error);
               return;
          } else {
               $auth_perusahaan = htmlspecialchars($this->input->post("prs", true));
               $kd_tipe = htmlspecialchars($this->input->post("kode", true));
               $tipe = htmlspecialchars($this->input->post("tipe", true));
               $ket_tipe = htmlspecialchars($this->input->post("ket", true));
               $id_perusahaan = $this->prs->get_by_auth($auth_perusahaan);

               if ($id_perusahaan == 0) {
                    echo json_encode(array("statusCode" => 201, "pesan" => "Perusahaan tidak terdaftar"));
                    return;
               }

               $cekkode = $this->tpe->cek_kode($id_perusahaan, $kd_tipe);
               if ($cekkode) {
                    echo json_encode(array("statusCode" => 201, "pesan" => "Kode sudah digunakan"));
                    return;
               }

               $cektipe = $this->tpe->cek_tipe($id_perusahaan, $tipe);
               if ($cektipe) {
                    echo json_encode(array("statusCode" => 201, "pesan" => "Tipe sudah digunakan"));
                    return;
               }

               $data = [
                    'kd_tipe' => $kd_tipe,
                    'tipe' => $tipe,
                    'ket_tipe' => $ket_tipe,
                    'stat_tipe' => 'T',
                    'tgl_buat' => date('Y-m-d H:i:s'),
                    'tgl_edit' => date('Y-m-d H:i:s'),
                    'id_user' => $this->session->userdata('id_user'),
                    'id_perusahaan' => $id_perusahaan
               ];

               $tipe = $this->tpe->input_tipe($data);
               if ($tipe) {
                    echo json_encode(array("statusCode" => 200, "pesan" => "Tipe berhasil disimpan"));
               } else {
                    echo json_encode(array("statusCode" => 201, "pesan" => "Tipe gagal disimpan"));
               }
          }
     }

     public function hapus_tipe()
     {
          $auth_tipe = htmlspecialchars(trim($this->input->post('authtipe')));
          $query = $this->tpe->hapus_tipe($auth_tipe);
          if ($query == 200) {
               echo json_encode(array("statusCode" => 200, "pesan" => "Tipe berhasil dihapus"));
               return;
          } else if ($query == 201) {
               echo json_encode(array("statusCode" => 201, "pesan" => "Tipe gagal dihapus"));
               return;
          } else {
               echo json_encode(array("statusCode" => 202, "pesan" => "Tipe tidak ditemukan"));
               return;
          }
     }

     public function detail_tipe()
     {
          $auth_tipe = htmlspecialchars(trim($this->input->post("authtipe")));
          $query = $this->tpe->get_tipe_id($auth_tipe);
          if (!empty($query)) {
               foreach ($query as $list) {
                    if ($list->stat_tipe == "T") {
                         $status = "AKTIF";
                    } else {
                         $status = "NONAKTIF";
                    }

                    $data = [
                         'statusCode' => 200,
                         'nama_perusahaan' => $list->nama_perusahaan,
                         'kode' => $list->kd_tipe,
                         'tipe' => $list->tipe,
                         'ket' => $list->ket_tipe,
                         'status' => $status,
                         'tgl_buat' => date('d-M-Y H:i:s', strtotime($list->tgl_buat)),
                         'pembuat' => $list->nama_user
                    ];

                    $this->session->set_userdata('id_tipe', $list->id_tipe);
                    $this->session->set_userdata('id_perusahaan', $list->id_perusahaan);
               }
               echo json_encode($data);
          } else {
               echo json_encode(array('statusCode' => 201, "pesan" => "Tipe tidak ditemukan"));
          }
     }

     public function edit_tipe()
     {
          $this->form_validation->set_rules("kode", "kode", "required|trim|max_length[8]", [
               'required' => 'Kode wajib diisi',
               'max_length' => 'Kode maksimal 8 karakter'
          ]);
          $this->form_validation->set_rules("tipe", "tipe", "required|trim|max_length[100]", [
               'required' => 'Tipe wajib diisi',
               'max_length' => 'Tipe maksimal 100 karakter'
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
                    'tipe' => form_error("tipe"),
                    'status' => form_error("status")
               ];

               echo json_encode($error);
               die;
          } else {
               if ($this->session->userdata('id_perusahaan') == "") {
                    echo json_encode(array("statusCode" => 201, "pesan" => "Perusahaan tidak terdaftar"));
                    return;
               }

               if ($this->session->userdata('id_tipe') == "") {
                    echo json_encode(array("statusCode" => 201, "pesan" => "Tipe tidak ditemukan"));
                    return;
               }

               $kd_tipe = htmlspecialchars($this->input->post("kode", true));
               $tipe = htmlspecialchars($this->input->post("tipe", true));
               $ket_tipe = htmlspecialchars($this->input->post("ket", true));
               if (htmlspecialchars($this->input->post("status", true)) == "AKTIF") {
                    $status = "T";
               } else {
                    $status = "F";
               }

               $tipe = $this->tpe->edit_tipe($kd_tipe, $tipe, $ket_tipe, $status);
               if ($tipe == 200) {
                    echo json_encode(array("statusCode" => 200, "pesan" => "Tipe berhasil diupdate"));
               } else if ($tipe == 201) {
                    echo json_encode(array("statusCode" => 201, "pesan" => "Tipe gagal diupdate"));
               } else if ($tipe == 203) {
                    echo json_encode(array("statusCode" => 203, "pesan" => "Kode sudah digunakan"));
               } else if ($tipe == 204) {
                    echo json_encode(array("statusCode" => 205, "pesan" => "Tipe sudah digunakan"));
               }
          }
     }

     public function get_all()
     {
          $query = $this->tpe->get_all();
          $output = "<option value=''>-- Pilih tipe --</option>";
          if (!empty($query)) {
               foreach ($query as $list) {
                    $output = $output . "<option value='" . $list->auth_tipe . "'>" . $list->tipe . "</option>";
               }
               echo json_encode(array("statusCode" => 200, "tpe" => $output));
          } else {
               $output = "<option value=''>-- Tipe tidak Ditemukan --</option>";
               echo json_encode(array("statusCode" => 201, "tpe" => $output));
          }
     }

     public function get_by_authper()
     {
          $auth_per = $this->input->post('auth_per');

          $query = $this->tpe->get_by_authper($auth_per);
          $output = "<option value=''>-- Pilih tipe --</option>";
          if (!empty($query)) {
               foreach ($query as $list) {
                    $output = $output . "<option value='" . $list->auth_tipe . "'>" . $list->tipe . "</option>";
               }
               echo json_encode(array("statusCode" => 200, "tpe" => $output));
          } else {
               $output = "<option value=''>-- Tipe tidak Ditemukan --</option>";
               echo json_encode(array("statusCode" => 201, "tpe" => $output));
          }
     }

     public function get_by_idper()
     {
          if ($this->session->userdata('id_perusahaan_tipe') != "") {
               $id_per = $this->session->userdata('id_perusahaan_tipe');
               $output = "<option value=''>-- Pilih tipe --</option>";
               $query = $this->tpe->get_by_idper($id_per);
               foreach ($query as $list) {
                    $output = $output . " <option value='" . $list->auth_tipe . "'>" . $list->tipe . "</option>";
               }

               echo json_encode(array("statusCode" => 200, "tipe" => $output, "pesan" => "Sukses"));
          } else {
               $output = "<option value=''>-- tipeemen tidak ditemukan --</option>";
               echo json_encode(array("statusCode" => 200, "tipe" => $output, "pesan", "Tipe gagal ditampilkan"));
          }
     }
}
