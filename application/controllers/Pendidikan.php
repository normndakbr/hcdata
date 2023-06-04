<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Pendidikan extends My_Controller
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
          $this->load->view('dashboard/pendidikan/pendidikan');
          $this->load->view('dashboard/modal/mdlform');
          $this->load->view('dashboard/template/footer', $data);
          $this->load->view('dashboard/code/pendidikan');
     }

     public function new()
     {
          $data['nama'] = $this->session->userdata("nama");
          $data['email'] = $this->session->userdata("email");
          $data['menu'] = $this->session->userdata("id_menu");
          $this->load->view('dashboard/template/header', $data);
          $this->load->view('dashboard/pendidikan/pendidikan_add');
          $this->load->view('dashboard/modal/mdlform');
          $this->load->view('dashboard/template/footer', $data);
          $this->load->view('dashboard/code/pendidikan');
     }

     public function ajax_list()
     {
          $list = $this->pdk->get_datatables();
          $data = array();
          $no = $_POST['start'];
          foreach ($list as $pdk) {
               $no++;
               $row = array();
               $row['no'] = $no;
               $row['auth_pendidikan'] = $pdk->auth_pendidikan;
               $row['pendidikan'] = $pdk->pendidikan;
               $row['ket_pendidikan'] = $pdk->ket_pendidikan;

               if ($pdk->stat_pendidikan == "T") {
                    $row['stat_pendidikan'] = "<span class='btn btn-success btn-sm '> AKTIF </span>";
               } else {
                    $row['stat_pendidikan'] = "<div class='btn btn-danger btn-sm'> NONAKTIF </div>";
               }

               $row['tgl_buat'] = date('d-M-Y', strtotime($pdk->tgl_buat));
               $row['tgl_edit'] = date('d-M-Y', strtotime($pdk->tgl_edit));
               $row['proses'] = '<button id="' . $pdk->auth_pendidikan . '" class="btn btn-primary btn-sm font-weight-bold dtlpendidikan" title="Detail" value="' . $pdk->pendidikan . '"> <i class="fas fa-asterisk"></i> </button> 
                    <button id="' . $pdk->auth_pendidikan . '" class="btn btn-warning btn-sm font-weight-bold edttpendidikan" title="Edit" value="' . $pdk->pendidikan . '"> <i class="fas fa-edit"></i> </button> 
                    <button id="' . $pdk->auth_pendidikan . '" class="btn btn-danger btn-sm font-weight-bold hpspendidikan" title="Hapus" value="' . $pdk->pendidikan . '"> <i class="fas fa-trash-alt"></i> </button>';
               $data[] = $row;
          }

          $output = array(
               "draw" => $_POST['draw'],
               "recordsTotal" => $this->pdk->count_all(),
               "recordsFiltered" => $this->pdk->count_filtered(),
               "data" => $data,
          );
          //output to json format
          echo json_encode($output);
     }

     public function input_pendidikan()
     {
          $this->form_validation->set_rules("pendidikan", "pendidikan", "required|trim|max_length[100]", [
               'required' => 'pendidikan wajib diisi',
               'max_length' => 'pendidikan maksimal 100 karakter'
          ]);
          $this->form_validation->set_rules("ket", "ket", "trim|max_length[1000],[
               'max_length' => 'Keterangan maksimal 1000 karakter'
          ]");

          if ($this->form_validation->run() == false) {
               $error = [
                    'statusCode' => 202,
                    'pendidikan' => form_error("pendidikan"),
                    'ket' => form_error("ket")
               ];

               echo json_encode($error);
               return;
          } else {
               $pendidikan = htmlspecialchars($this->input->post("pendidikan", true));
               $ket_pendidikan = htmlspecialchars($this->input->post("ket"));

               $cekpendidikan = $this->pdk->cek_pendidikan($pendidikan);
               if ($cekpendidikan) {
                    echo json_encode(array("statusCode" => 201, "pesan" => "pendidikan sudah digunakan"));
                    return;
               }

               $data = [
                    'pendidikan' => $pendidikan,
                    'ket_pendidikan' => $ket_pendidikan,
                    'stat_pendidikan' => 'T',
                    'tgl_buat' => date('Y-m-d H:i:s'),
                    'tgl_edit' => date('Y-m-d H:i:s'),
                    'id_user' => $this->session->userdata('id_user')
               ];

               $pendidikan = $this->pdk->input_pendidikan($data);
               if ($pendidikan) {
                    echo json_encode(array("statusCode" => 200, "pesan" => "pendidikan berhasil disimpan"));
               } else {
                    echo json_encode(array("statusCode" => 201, "pesan" => "pendidikan gagal disimpan"));
               }
          }
     }

     public function hapus_pendidikan()
     {
          $auth_pendidikan = htmlspecialchars(trim($this->input->post('auth_pendidikan')));
          $query = $this->pdk->hapus_pendidikan($auth_pendidikan);
          if ($query == 200) {
               echo json_encode(array("statusCode" => 200, "pesan" => "pendidikan berhasil dihapus"));
               return;
          } else if ($query == 201) {
               echo json_encode(array("statusCode" => 201, "pesan" => "pendidikan gagal dihapus"));
               return;
          } else {
               echo json_encode(array("statusCode" => 202, "pesan" => "pendidikan tidak ditemukan"));
               return;
          }
     }

     public function detail_pendidikan()
     {
          $auth_pendidikan = htmlspecialchars(trim($this->input->post("auth_pendidikan")));
          $query = $this->pdk->get_pendidikan_id($auth_pendidikan);
          if (!empty($query)) {
               foreach ($query as $list) {
                    if ($list->stat_pendidikan == "T") {
                         $status = "AKTIF";
                    } else {
                         $status = "NONAKTIF";
                    }

                    $data = [
                         'statusCode' => 200,
                         'pendidikan' => $list->pendidikan,
                         'ket' => $list->ket_pendidikan,
                         'status' => $status,
                         'tgl_buat' => date('d-M-Y H:i:s', strtotime($list->tgl_buat)),
                         'pembuat' => $list->nama_user
                    ];

                    $this->session->set_userdata('id_pendidikan', $list->id_pendidikan);
               }
               echo json_encode($data);
          } else {
               echo json_encode(array('statusCode' => 201, "pesan" => "pendidikan tidak ditemukan"));
          }
     }

     public function edit_pendidikan()
     {
          $this->form_validation->set_rules("pendidikan", "pendidikan", "required|trim|max_length[100]", [
               'required' => 'pendidikan wajib diisi',
               'max_length' => 'pendidikan maksimal 100 karakter'
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
                    'pendidikan' => form_error("pendidikan"),
                    'status' => form_error("status"),
                    'ket' => form_error('ket')
               ];

               echo json_encode($error);
               die;
          } else {
               if ($this->session->userdata('id_pendidikan') == "") {
                    echo json_encode(array("statusCode" => 201, "pesan" => "pendidikan tidak ditemukan"));
                    return;
               }

               $pendidikan = htmlspecialchars($this->input->post("pendidikan", true));
               $ket_pendidikan = htmlspecialchars($this->input->post("ket", true));
               if (htmlspecialchars($this->input->post("status", true)) == "AKTIF") {
                    $status = "T";
               } else {
                    $status = "F";
               }

               $pendidikan = $this->pdk->edit_pendidikan($pendidikan, $ket_pendidikan, $status);
               if ($pendidikan == 200) {
                    echo json_encode(array("statusCode" => 200, "pesan" => "pendidikan berhasil diupdate"));
               } else if ($pendidikan == 201) {
                    echo json_encode(array("statusCode" => 201, "pesan" => "pendidikan gagal diupdate"));
               } else if ($pendidikan == 204) {
                    echo json_encode(array("statusCode" => 205, "pesan" => "pendidikan sudah digunakan"));
               }
          }
     }

     public function get_all()
     {
          $query = $this->pdk->get_all();
          $output = "<option value=''>-- PILIH PENDIDIKAN --</option>";
          if (!empty($query)) {
               foreach ($query as $list) {
                    $output = $output . "<option value='" . $list->id_pendidikan . "'>" . $list->pendidikan . "</option>";
               }
               echo json_encode(array("statusCode" => 200, "pdk" => $output));
          } else {
               $output = "<option value=''>-- Pendidikan tidak Ditemukan --</option>";
               echo json_encode(array("statusCode" => 201, "pdk" => $output));
          }
     }

     public function get_by_authper()
     {
          $auth_per = $this->input->post('auth_per');

          $query = $this->pdk->get_by_authper($auth_per);
          $output = "<option value=''>-- Pilih pendidikan --</option>";
          if (!empty($query)) {
               foreach ($query as $list) {
                    $output = $output . "<option value='" . $list->auth_pendidikan . "'>" . $list->pendidikan . "</option>";
               }
               echo json_encode(array("statusCode" => 200, "pdk" => $output));
          } else {
               $output = "<option value=''>-- pendidikan tidak Ditemukan --</option>";
               echo json_encode(array("statusCode" => 201, "pdk" => $output));
          }
     }

     public function get_by_idper()
     {
          if ($this->session->userdata('id_perusahaan_pendidikan') != "") {
               $id_per = $this->session->userdata('id_perusahaan_pendidikan');
               $output = "<option value=''>-- Pilih pendidikan --</option>";
               $query = $this->pdk->get_by_idper($id_per);
               foreach ($query as $list) {
                    $output = $output . " <option value='" . $list->auth_pendidikan . "'>" . $list->pendidikan . "</option>";
               }

               echo json_encode(array("statusCode" => 200, "pendidikan" => $output, "pesan" => "Sukses"));
          } else {
               $output = "<option value=''>-- pendidikanemen tidak ditemukan --</option>";
               echo json_encode(array("statusCode" => 200, "pendidikan" => $output, "pesan", "pendidikan gagal ditampilkan"));
          }
     }
}
