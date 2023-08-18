<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Klasifikasi extends My_Controller
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
          $this->load->view('dashboard/klasifikasi/klasifikasi');
          $this->load->view('dashboard/modal/mdlform');
          $this->load->view('dashboard/template/footer', $data);
          $this->load->view('dashboard/code/klasifikasi');
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
          $this->load->view('dashboard/klasifikasi/klasifikasi_add');
          $this->load->view('dashboard/modal/mdlform');
          $this->load->view('dashboard/template/footer', $data);
          $this->load->view('dashboard/code/klasifikasi');
     }

     public function ajax_list()
     {
          $list = $this->kls->get_datatables();
          $data = array();
          $no = $_POST['start'];
          foreach ($list as $kls) {
               $no++;
               $row = array();
               $row['no'] = $no;
               $row['auth_klasifikasi'] = $kls->auth_klasifikasi;
               $row['klasifikasi'] = $kls->klasifikasi;
               $row['ket_klasifikasi'] = $kls->ket_klasifikasi;

               if ($kls->stat_klasifikasi == "T") {
                    $row['stat_klasifikasi'] = "<span class='btn btn-success btn-sm '> AKTIF </span>";
               } else {
                    $row['stat_klasifikasi'] = "<div class='btn btn-danger btn-sm'> NONAKTIF </div>";
               }

               $row['tgl_buat'] = date('d-M-Y', strtotime($kls->tgl_buat));
               $row['tgl_edit'] = date('d-M-Y', strtotime($kls->tgl_edit));
               $row['proses'] = '<button id="' . $kls->auth_klasifikasi . '" class="btn btn-primary btn-sm font-weight-bold dtlklasifikasi" title="Detail" value="' . $kls->klasifikasi . '"> <i class="fas fa-asterisk"></i> </button> 
                    <button id="' . $kls->auth_klasifikasi . '" class="btn btn-warning btn-sm font-weight-bold edttklasifikasi" title="Edit" value="' . $kls->klasifikasi . '"> <i class="fas fa-edit"></i> </button> 
                    <button id="' . $kls->auth_klasifikasi . '" class="btn btn-danger btn-sm font-weight-bold hpsklasifikasi" title="Hapus" value="' . $kls->klasifikasi . '"> <i class="fas fa-trash-alt"></i> </button>';
               $data[] = $row;
          }

          $output = array(
               "draw" => $_POST['draw'],
               "recordsTotal" => $this->kls->count_all(),
               "recordsFiltered" => $this->kls->count_filtered(),
               "data" => $data,
          );
          //output to json format
          echo json_encode($output);
     }

     public function input_klasifikasi()
     {
          $this->form_validation->set_rules("klasifikasi", "klasifikasi", "required|trim|max_length[100]", [
               'required' => 'klasifikasi wajib diisi',
               'max_length' => 'klasifikasi maksimal 100 karakter'
          ]);
          $this->form_validation->set_rules("ket", "ket", "trim|max_length[1000],[
               'max_length' => 'Keterangan maksimal 1000 karakter'
          ]");

          if ($this->form_validation->run() == false) {
               $error = [
                    'statusCode' => 202,
                    'klasifikasi' => form_error("klasifikasi"),
                    'ket' => form_error("ket")
               ];

               echo json_encode($error);
               return;
          } else {
               $klasifikasi = htmlspecialchars($this->input->post("klasifikasi", true));
               $ket_klasifikasi = htmlspecialchars($this->input->post("ket"));

               $cekklasifikasi = $this->kls->cek_klasifikasi($klasifikasi);
               if ($cekklasifikasi) {
                    echo json_encode(array("statusCode" => 201, "pesan" => "klasifikasi sudah digunakan"));
                    return;
               }

               $data = [
                    'klasifikasi' => $klasifikasi,
                    'ket_klasifikasi' => $ket_klasifikasi,
                    'stat_klasifikasi' => 'T',
                    'tgl_buat' => date('Y-m-d H:i:s'),
                    'tgl_edit' => date('Y-m-d H:i:s'),
                    'id_user' => $this->session->userdata('id_user_hcdata')
               ];

               $klasifikasi = $this->kls->input_klasifikasi($data);
               if ($klasifikasi) {
                    echo json_encode(array("statusCode" => 200, "pesan" => "klasifikasi berhasil disimpan"));
               } else {
                    echo json_encode(array("statusCode" => 201, "pesan" => "klasifikasi gagal disimpan"));
               }
          }
     }

     public function hapus_klasifikasi()
     {
          $auth_klasifikasi = htmlspecialchars(trim($this->input->post('auth_klasifikasi')));
          $query = $this->kls->hapus_klasifikasi($auth_klasifikasi);
          if ($query == 200) {
               echo json_encode(array("statusCode" => 200, "pesan" => "klasifikasi berhasil dihapus"));
               return;
          } else if ($query == 201) {
               echo json_encode(array("statusCode" => 201, "pesan" => "klasifikasi gagal dihapus"));
               return;
          } else {
               echo json_encode(array("statusCode" => 202, "pesan" => "klasifikasi tidak ditemukan"));
               return;
          }
     }

     public function detail_klasifikasi()
     {
          $auth_klasifikasi = htmlspecialchars(trim($this->input->post("auth_klasifikasi")));
          $query = $this->kls->get_klasifikasi_id($auth_klasifikasi);
          if (!empty($query)) {
               foreach ($query as $list) {
                    if ($list->stat_klasifikasi == "T") {
                         $status = "AKTIF";
                    } else {
                         $status = "NONAKTIF";
                    }

                    $data = [
                         'statusCode' => 200,
                         'klasifikasi' => $list->klasifikasi,
                         'ket' => $list->ket_klasifikasi,
                         'status' => $status,
                         'tgl_buat' => date('d-M-Y H:i:s', strtotime($list->tgl_buat)),
                         'pembuat' => $list->nama_user
                    ];

                    $this->session->set_userdata('id_klasifikasi_hcdata', $list->id_klasifikasi);
               }
               echo json_encode($data);
          } else {
               echo json_encode(array('statusCode' => 201, "pesan" => "klasifikasi tidak ditemukan"));
          }
     }

     public function edit_klasifikasi()
     {
          $this->form_validation->set_rules("klasifikasi", "klasifikasi", "required|trim|max_length[100]", [
               'required' => 'klasifikasi wajib diisi',
               'max_length' => 'klasifikasi maksimal 100 karakter'
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
                    'klasifikasi' => form_error("klasifikasi"),
                    'status' => form_error("status"),
                    'ket' => form_error('ket')
               ];

               echo json_encode($error);
               die;
          } else {
               if ($this->session->userdata('id_klasifikasi_hcdata') == "") {
                    echo json_encode(array("statusCode" => 201, "pesan" => "klasifikasi tidak ditemukan"));
                    return;
               }

               $klasifikasi = htmlspecialchars($this->input->post("klasifikasi", true));
               $ket_klasifikasi = htmlspecialchars($this->input->post("ket", true));
               if (htmlspecialchars($this->input->post("status", true)) == "AKTIF") {
                    $status = "T";
               } else {
                    $status = "F";
               }

               $klasifikasi = $this->kls->edit_klasifikasi($klasifikasi, $ket_klasifikasi, $status);
               if ($klasifikasi == 200) {
                    echo json_encode(array("statusCode" => 200, "pesan" => "klasifikasi berhasil diupdate"));
               } else if ($klasifikasi == 201) {
                    echo json_encode(array("statusCode" => 201, "pesan" => "klasifikasi gagal diupdate"));
               } else if ($klasifikasi == 204) {
                    echo json_encode(array("statusCode" => 205, "pesan" => "klasifikasi sudah digunakan"));
               }
          }
     }

     public function get_all()
     {
          $auth = htmlspecialchars($this->input->post("token", true));
          $this->cek_auth($auth);

          $query = $this->kls->get_all();
          $output = "<option value=''>-- WAJIB DIPILIH --</option>";
          if (!empty($query)) {
               foreach ($query as $list) {
                    $output = $output . "<option value='" . $list->id_klasifikasi . "'>" . $list->klasifikasi . "</option>";
               }
               echo json_encode(array("statusCode" => 200, "kls" => $output));
          } else {
               $output = "<option value=''>-- klasifikasi tidak Ditemukan --</option>";
               echo json_encode(array("statusCode" => 201, "kls" => $output));
          }
     }

     public function get_by_authper()
     {
          $auth_per = htmlspecialchars($this->input->post('auth_per', true));

          $query = $this->kls->get_by_authper($auth_per);
          $output = "<option value=''>-- Pilih klasifikasi --</option>";
          if (!empty($query)) {
               foreach ($query as $list) {
                    $output = $output . "<option value='" . $list->auth_klasifikasi . "'>" . $list->klasifikasi . "</option>";
               }
               echo json_encode(array("statusCode" => 200, "kls" => $output));
          } else {
               $output = "<option value=''>-- klasifikasi tidak Ditemukan --</option>";
               echo json_encode(array("statusCode" => 201, "kls" => $output));
          }
     }

     public function get_by_idper()
     {
          if ($this->session->userdata('id_perusahaan_klasifikasi') != "") {
               $id_per = $this->session->userdata('id_perusahaan_klasifikasi');
               $output = "<option value=''>-- Pilih klasifikasi --</option>";
               $query = $this->kls->get_by_idper($id_per);
               foreach ($query as $list) {
                    $output = $output . " <option value='" . $list->auth_klasifikasi . "'>" . $list->klasifikasi . "</option>";
               }

               echo json_encode(array("statusCode" => 200, "klasifikasi" => $output, "pesan" => "Sukses"));
          } else {
               $output = "<option value=''>-- klasifikasiemen tidak ditemukan --</option>";
               echo json_encode(array("statusCode" => 200, "klasifikasi" => $output, "pesan", "klasifikasi gagal ditampilkan"));
          }
     }
}
