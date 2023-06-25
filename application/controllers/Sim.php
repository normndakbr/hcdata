<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Sim extends My_Controller
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
          $this->load->view('dashboard/sim/sim');
          $this->load->view('dashboard/modal/mdlform');
          $this->load->view('dashboard/template/footer', $data);
          $this->load->view('dashboard/code/sim');
     }

     public function new()
     {
          $id_perusahaan = $this->session->userdata("id_perusahaan");
          $data['nama_per'] = $this->prs->get_per_by_id($id_perusahaan);
          $data['nama'] = $this->session->userdata("nama");
          $data['email'] = $this->session->userdata("email");
          $data['menu'] = $this->session->userdata("id_menu");
          $this->load->view('dashboard/template/header', $data);
          $this->load->view('dashboard/sim/sim_add');
          $this->load->view('dashboard/modal/mdlform');
          $this->load->view('dashboard/template/footer', $data);
          $this->load->view('dashboard/code/sim');
     }

     public function ajax_list()
     {
          $list = $this->smm->get_datatables();
          $data = array();
          $no = $_POST['start'];
          foreach ($list as $smm) {
               $no++;
               $row = array();
               $row['no'] = $no;
               $row['auth_sim'] = $smm->auth_sim;
               $row['sim'] = $smm->sim;
               $row['ket_sim'] = $smm->ket_sim;

               if ($smm->stat_sim == "T") {
                    $row['stat_sim'] = "<span class='btn btn-success btn-sm '> AKTIF </span>";
               } else {
                    $row['stat_sim'] = "<div class='btn btn-danger btn-sm'> NONAKTIF </div>";
               }

               $row['tgl_buat'] = date('d-M-Y', strtotime($smm->tgl_buat));
               $row['tgl_edit'] = date('d-M-Y', strtotime($smm->tgl_edit));
               $row['proses'] = '<button id="' . $smm->auth_sim . '" class="btn btn-primary btn-sm font-weight-bold dtlsim" title="Detail" value="' . $smm->sim . '"> <i class="fas fa-asterisk"></i> </button> 
                    <button id="' . $smm->auth_sim . '" class="btn btn-warning btn-sm font-weight-bold edttsim" title="Edit" value="' . $smm->sim . '"> <i class="fas fa-edit"></i> </button> 
                    <button id="' . $smm->auth_sim . '" class="btn btn-danger btn-sm font-weight-bold hpssim" title="Hapus" value="' . $smm->sim . '"> <i class="fas fa-trash-alt"></i> </button>';
               $data[] = $row;
          }

          $output = array(
               "draw" => $_POST['draw'],
               "recordsTotal" => $this->smm->count_all(),
               "recordsFiltered" => $this->smm->count_filtered(),
               "data" => $data,
          );
          //output to json format
          echo json_encode($output);
     }

     public function input_sim()
     {
          $this->form_validation->set_rules("sim", "sim", "required|trim|max_length[100]", [
               'required' => 'sim wajib diisi',
               'max_length' => 'sim maksimal 100 karakter'
          ]);
          $this->form_validation->set_rules("ket", "ket", "trim|max_length[1000],[
               'max_length' => 'Keterangan maksimal 1000 karakter'
          ]");

          if ($this->form_validation->run() == false) {
               $error = [
                    'statusCode' => 202,
                    'sim' => form_error("sim"),
                    'ket' => form_error("ket")
               ];

               echo json_encode($error);
               return;
          } else {
               $sim = htmlspecialchars($this->input->post("sim", true));
               $ket_sim = htmlspecialchars($this->input->post("ket"));

               $ceksim = $this->smm->cek_sim($sim);
               if ($ceksim) {
                    echo json_encode(array("statusCode" => 201, "pesan" => "Sim sudah digunakan"));
                    return;
               }

               $data = [
                    'sim' => $sim,
                    'ket_sim' => $ket_sim,
                    'stat_sim' => 'T',
                    'tgl_buat' => date('Y-m-d H:i:s'),
                    'tgl_edit' => date('Y-m-d H:i:s'),
                    'id_user' => $this->session->userdata('id_user')
               ];

               $sim = $this->smm->input_sim($data);
               if ($sim) {
                    echo json_encode(array("statusCode" => 200, "pesan" => "Sim berhasil disimpan"));
               } else {
                    echo json_encode(array("statusCode" => 201, "pesan" => "Sim gagal disimpan"));
               }
          }
     }

     public function hapus_sim()
     {
          $auth_sim = htmlspecialchars(trim($this->input->post('auth_sim')));
          $query = $this->smm->hapus_sim($auth_sim);
          if ($query == 200) {
               echo json_encode(array("statusCode" => 200, "pesan" => "Sim berhasil dihapus"));
               return;
          } else if ($query == 201) {
               echo json_encode(array("statusCode" => 201, "pesan" => "Sim gagal dihapus"));
               return;
          } else {
               echo json_encode(array("statusCode" => 202, "pesan" => "Sim tidak ditemukan"));
               return;
          }
     }

     public function detail_sim()
     {
          $auth_sim = htmlspecialchars(trim($this->input->post("auth_sim")));
          $query = $this->smm->get_sim_id($auth_sim);
          if (!empty($query)) {
               foreach ($query as $list) {
                    if ($list->stat_sim == "T") {
                         $status = "AKTIF";
                    } else {
                         $status = "NONAKTIF";
                    }

                    $data = [
                         'statusCode' => 200,
                         'sim' => $list->sim,
                         'ket' => $list->ket_sim,
                         'status' => $status,
                         'tgl_buat' => date('d-M-Y H:i:s', strtotime($list->tgl_buat)),
                         'pembuat' => $list->nama_user
                    ];

                    $this->session->set_userdata('id_sim', $list->id_sim);
               }
               echo json_encode($data);
          } else {
               echo json_encode(array('statusCode' => 201, "pesan" => "Sim tidak ditemukan"));
          }
     }

     public function edit_sim()
     {
          $this->form_validation->set_rules("sim", "sim", "required|trim|max_length[100]", [
               'required' => 'Sim wajib diisi',
               'max_length' => 'Sim maksimal 100 karakter'
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
                    'sim' => form_error("sim"),
                    'status' => form_error("status"),
                    'ket' => form_error('ket')
               ];

               echo json_encode($error);
               die;
          } else {
               if ($this->session->userdata('id_sim') == "") {
                    echo json_encode(array("statusCode" => 201, "pesan" => "Sim tidak ditemukan"));
                    return;
               }

               $sim = htmlspecialchars($this->input->post("sim", true));
               $ket_sim = htmlspecialchars($this->input->post("ket", true));
               if (htmlspecialchars($this->input->post("status", true)) == "AKTIF") {
                    $status = "T";
               } else {
                    $status = "F";
               }

               $sim = $this->smm->edit_sim($sim, $ket_sim, $status);
               if ($sim == 200) {
                    echo json_encode(array("statusCode" => 200, "pesan" => "Sim berhasil diupdate"));
               } else if ($sim == 201) {
                    echo json_encode(array("statusCode" => 201, "pesan" => "Sim gagal diupdate"));
               } else if ($sim == 204) {
                    echo json_encode(array("statusCode" => 205, "pesan" => "Sim sudah digunakan"));
               }
          }
     }

     public function get_all()
     {
          $query = $this->smm->get_all();
          $output = "<option value=''>-- Pilih sim --</option>";
          if (!empty($query)) {
               foreach ($query as $list) {
                    $output = $output . "<option value='" . $list->auth_sim . "'>" . $list->sim . "</option>";
               }
               echo json_encode(array("statusCode" => 200, "smm" => $output));
          } else {
               $output = "<option value=''>-- Sim tidak Ditemukan --</option>";
               echo json_encode(array("statusCode" => 201, "smm" => $output));
          }
     }

     public function get_by_authper()
     {
          $auth_per = $this->input->post('auth_per');

          $query = $this->smm->get_by_authper($auth_per);
          $output = "<option value=''>-- Pilih sim --</option>";
          if (!empty($query)) {
               foreach ($query as $list) {
                    $output = $output . "<option value='" . $list->auth_sim . "'>" . $list->sim . "</option>";
               }
               echo json_encode(array("statusCode" => 200, "smm" => $output));
          } else {
               $output = "<option value=''>-- Sim tidak Ditemukan --</option>";
               echo json_encode(array("statusCode" => 201, "smm" => $output));
          }
     }

     public function get_by_idper()
     {
          if ($this->session->userdata('id_perusahaan_sim') != "") {
               $id_per = $this->session->userdata('id_perusahaan_sim');
               $output = "<option value=''>-- Pilih sim --</option>";
               $query = $this->smm->get_by_idper($id_per);
               foreach ($query as $list) {
                    $output = $output . " <option value='" . $list->auth_sim . "'>" . $list->sim . "</option>";
               }

               echo json_encode(array("statusCode" => 200, "sim" => $output, "pesan" => "Sukses"));
          } else {
               $output = "<option value=''>-- simemen tidak ditemukan --</option>";
               echo json_encode(array("statusCode" => 200, "sim" => $output, "pesan", "Sim gagal ditampilkan"));
          }
     }
}
