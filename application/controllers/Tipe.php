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
          $id_perusahaan = $this->session->userdata("id_perusahaan");
          $data['nama_per'] = $this->prs->get_per_by_id($id_perusahaan);
          $data['nama'] = $this->session->userdata("nama");
          $data['email'] = $this->session->userdata("email");
          $data['menu'] = $this->session->userdata("id_menu");
          $this->load->view('dashboard/template/header', $data);
          $this->load->view('dashboard/tipe/tipe');
          $this->load->view('dashboard/template/footer', $data);
          $this->load->view('dashboard/code/tipe');
     }

     public function new()
     {
          $id_perusahaan = $this->session->userdata("id_perusahaan");
          $data['nama_per'] = $this->prs->get_per_by_id($id_perusahaan);
          $data['nama'] = $this->session->userdata("nama");
          $data['email'] = $this->session->userdata("email");
          $data['menu'] = $this->session->userdata("id_menu");
          $this->load->view('dashboard/template/header', $data);
          $this->load->view('dashboard/tipe/tipe_add');
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
               $row['tipe'] = $tpe->tipe;
               $row['ket_tipe'] = $tpe->ket_tipe;

               if ($tpe->stat_tipe == "T") {
                    $row['stat_tipe'] = "<span class='btn btn-success btn-sm '> AKTIF </span>";
               } else {
                    $row['stat_tipe'] = "<div class='btn btn-danger btn-sm'> NONAKTIF </div>";
               }

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
                    'tipe' => form_error("tipe"),
                    'ket' => form_error("ket")
               ];

               echo json_encode($error);
               return;
          } else {
               $tipe = htmlspecialchars($this->input->post("tipe", true));
               $ket_tipe = htmlspecialchars($this->input->post("ket", true));

               $cektipe = $this->tpe->cek_tipe($tipe);
               if ($cektipe) {
                    echo json_encode(array("statusCode" => 201, "pesan" => "Golongan sudah digunakan"));
                    return;
               }

               $data = [
                    'tipe' => $tipe,
                    'ket_tipe' => $ket_tipe,
                    'stat_tipe' => 'T',
                    'tgl_buat' => date('Y-m-d H:i:s'),
                    'tgl_edit' => date('Y-m-d H:i:s'),
                    'id_user' => $this->session->userdata('id_user')
               ];

               $tipe = $this->tpe->input_tipe($data);
               if ($tipe) {
                    echo json_encode(array("statusCode" => 200, "pesan" => "Golongan berhasil disimpan"));
               } else {
                    echo json_encode(array("statusCode" => 201, "pesan" => "Golongan gagal disimpan"));
               }
          }
     }

     public function hapus_tipe()
     {
          $auth_tipe = htmlspecialchars(trim($this->input->post('authtipe')));
          $query = $this->tpe->hapus_tipe($auth_tipe);
          if ($query == 200) {
               echo json_encode(array("statusCode" => 200, "pesan" => "Golongan berhasil dihapus"));
               return;
          } else if ($query == 201) {
               echo json_encode(array("statusCode" => 201, "pesan" => "Golongan gagal dihapus"));
               return;
          } else {
               echo json_encode(array("statusCode" => 202, "pesan" => "Golongan tidak ditemukan"));
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
                         'tipe' => $list->tipe,
                         'ket' => $list->ket_tipe,
                         'status' => $status,
                         'tgl_buat' => date('d-M-Y H:i:s', strtotime($list->tgl_buat)),
                         'pembuat' => $list->nama_user
                    ];

                    $this->session->set_userdata('id_tipe', $list->id_tipe);
               }
               echo json_encode($data);
          } else {
               echo json_encode(array('statusCode' => 201, "pesan" => "Golongan tidak ditemukan"));
          }
     }

     public function edit_tipe()
     {
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
                    'tipe' => form_error("tipe"),
                    'status' => form_error("status")
               ];

               echo json_encode($error);
               die;
          } else {

               if ($this->session->userdata('id_tipe') == "") {
                    echo json_encode(array("statusCode" => 201, "pesan" => "Golongan tidak ditemukan"));
                    return;
               }

               $tipe = htmlspecialchars($this->input->post("tipe", true));
               $ket_tipe = htmlspecialchars($this->input->post("ket", true));
               if (htmlspecialchars($this->input->post("status", true)) == "AKTIF") {
                    $status = "T";
               } else {
                    $status = "F";
               }

               $tipe = $this->tpe->edit_tipe($tipe, $ket_tipe, $status);
               if ($tipe == 200) {
                    echo json_encode(array("statusCode" => 200, "pesan" => "Golongan berhasil diupdate"));
               } else if ($tipe == 201) {
                    echo json_encode(array("statusCode" => 201, "pesan" => "Golongan gagal diupdate"));
               } else if ($tipe == 204) {
                    echo json_encode(array("statusCode" => 205, "pesan" => "Golongan sudah digunakan"));
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
               $output = "<option value=''>-- GOLONGAN TIDAK ADA --</option>";
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
               $output = "<option value=''>-- GOLONGAN TIDAK ADA --</option>";
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
               $output = "<option value=''>-- GOLONGAN TIDAK ADA --</option>";
               echo json_encode(array("statusCode" => 200, "tipe" => $output, "pesan", "Golongan gagal ditampilkan"));
          }
     }

     public function get_auth_tipe_by_id()
     {
          $id_tipe = $this->input->post('id_tipe');
          $query = $this->tpe->get_auth_tipe($id_tipe);
          if ($query === 0) {
               return 0;
          } else {
               return $query;
          }
     }
}
