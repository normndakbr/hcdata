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
          $id_perusahaan = $this->session->userdata("id_perusahaan_hcdata");
          $data['nama_per'] = $this->prs->get_per_by_id($id_perusahaan);
          $data['nama'] = $this->session->userdata("nama_hcdata");
          $data['email'] = $this->session->userdata("email_hcdata");
          $data['menu'] = $this->session->userdata("id_menu_hcdata");
          $data['get_menu'] = $this->dsmod->get_menu();
          $this->load->view('dashboard/template/header', $data);
          $this->load->view('dashboard/sim/sim');
          $this->load->view('dashboard/modal/mdlform');
          $this->load->view('dashboard/template/footer', $data);
          $this->load->view('dashboard/code/sim');
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
                    'id_user' => $this->session->userdata('id_user_hcdata')
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

                    $this->session->set_userdata('id_sim_hcdt', $list->id_sim);
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
               if ($this->session->userdata('id_sim_hcdt') == "") {
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
               echo json_encode(array("statusCode" => 200, "sim" => $output, "pesan" => "Sim gagal ditampilkan"));
          }
     }

     public function get_auth_sim_by_id()
     {
          $id_sim = $this->input->post('id_sim');
          $query = $this->smm->get_auth_sim($id_sim);
          if ($query === 0) {
               echo json_encode(array("statusCode" => 404, "status" => "Not Found", "pesan" => "id sim tidak ditemukan"));
          } else {
               return $query;
          }
     }

     public function get_id_sim_by_auth()
     {
          $auth_sim = $this->input->post('auth_sim');
          $query = $this->smm->get_id_sim_by_auth($auth_sim);

          if ($query === 0) {
               echo json_encode(array("statusCode" => 404, "status" => "Not Found", "pesan" => "auth sim tidak ditemukan"));
          } else {
               return $query;
          }
     }

     public function upload_ulang_sim()
     {
          $auth_sim =  htmlspecialchars($this->input->post("auth_sim", true));
          $auth_person =  htmlspecialchars($this->input->post("auth_person", true));

          if ($auth_person == "") {
               echo json_encode(array("statusCode" => 201, "pesan" => "Data personal tidak ditemukan"));
               die;
          }

          $id_personal = $this->kry->get_id_personal($auth_person);
          $foldername = md5($id_personal);

          $data_sim = $this->srt->get_sim_kary($auth_sim);

          if (!empty($data_sim)) {
               foreach ($data_sim as $list) {
                    $id_sim_kary  = $list->id_sim_kary;
                    $nama_file  = $list->url_file;
               }

               if ($nama_file == "") {
                    $now = date('YmdHis');
                    $nama_file = $now . "-SIM.pdf";
               }
          } else {
               echo json_encode(array("statusCode" => 201, "pesan" => "Data SIM karyawan tidak ditemukan"));
               die;
          }

          if (is_dir('./berkas/karyawan/' . $foldername) == false) {
               mkdir('./berkas/karyawan/' . $foldername, 0775, TRUE);
          } else {
               $config['upload_path'] = './berkas/karyawan/' . $foldername;
               $config['allowed_types'] = 'pdf';
               $config['max_size'] = 1000;
               $config['file_name'] = $nama_file;
               $config['overwrite'] = TRUE;


               $this->load->library('upload', $config);

               if (!$this->upload->do_upload('filesimkary')) {
                    $err = $this->upload->display_errors();

                    if ($err == "<p>The file you are attempting to upload is larger than the permitted size.</p>") {
                         $error = "<p>Ukuran file maksimal 1000 kb.</p>";
                    } else if ($err == "<p>The filetype you are attempting to upload is not allowed.</p>") {
                         $error = "<p>Format file nya dalam bentuk pdf</p>";
                    } else {
                         $error = $err;
                    }

                    echo json_encode(array("statusCode" => 201, "pesan" => $error));
                    die;
               } else {

                    $dt_ser = array(
                         'file_sertifikasi' => $nama_file
                    );

                    $this->srt->update_sertifikasi($id_ser, $dt_ser);
                    echo json_encode(array("statusCode" => 200, "pesan" => "File SIM berhasil di-perbarui"));
               }
          }
     }
}
