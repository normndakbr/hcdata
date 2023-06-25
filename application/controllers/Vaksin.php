<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Vaksin extends My_Controller
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
          $this->load->view('dashboard/vaksin/vaksin');
          $this->load->view('dashboard/modal/mdlform');
          $this->load->view('dashboard/template/footer', $data);
          $this->load->view('dashboard/code/vaksin');
     }

     public function new()
     {
          $id_perusahaan = $this->session->userdata("id_perusahaan");
          $data['nama_per'] = $this->prs->get_per_by_id($id_perusahaan);
          $data['nama'] = $this->session->userdata("nama");
          $data['email'] = $this->session->userdata("email");
          $data['menu'] = $this->session->userdata("id_menu");
          $this->load->view('dashboard/template/header', $data);
          $this->load->view('dashboard/vaksin/vaksin_add');
          $this->load->view('dashboard/modal/mdlform');
          $this->load->view('dashboard/template/footer', $data);
          $this->load->view('dashboard/code/vaksin');
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
               $row['auth_vaksin'] = $tpe->auth_vaksin;
               $row['kd_vaksin'] = $tpe->kd_vaksin;
               $row['vaksin'] = $tpe->vaksin;
               $row['ket_vaksin'] = $tpe->ket_vaksin;

               if ($tpe->stat_vaksin == "T") {
                    $row['stat_vaksin'] = "<span class='btn btn-success btn-sm '> AKTIF </span>";
               } else {
                    $row['stat_vaksin'] = "<div class='btn btn-danger btn-sm'> NONAKTIF </div>";
               }

               $row['kode_perusahaan'] = $tpe->kode_perusahaan;
               $row['tgl_buat'] = date('d-M-Y', strtotime($tpe->tgl_buat));
               $row['tgl_edit'] = date('d-M-Y', strtotime($tpe->tgl_edit));
               $row['proses'] = '<button id="' . $tpe->auth_vaksin . '" class="btn btn-primary btn-sm font-weight-bold dtlvaksin" title="Detail" value="' . $tpe->vaksin . '"> <i class="fas fa-asterisk"></i> </button> 
                    <button id="' . $tpe->auth_vaksin . '" class="btn btn-warning btn-sm font-weight-bold edttvaksin" title="Edit" value="' . $tpe->vaksin . '"> <i class="fas fa-edit"></i> </button> 
                    <button id="' . $tpe->auth_vaksin . '" class="btn btn-danger btn-sm font-weight-bold hpsvaksin" title="Hapus" value="' . $tpe->vaksin . '"> <i class="fas fa-trash-alt"></i> </button>';
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

     public function input_vaksin()
     {

          $this->form_validation->set_rules("prs", "prs", "required|trim", [
               'required' => 'Perusahaan wajib dipilih'
          ]);
          $this->form_validation->set_rules("kode", "kode", "required|trim|max_length[8]", [
               'required' => 'Kode wajib diisi',
               'max_length' => 'Kode maksimal 8 karakter'
          ]);
          $this->form_validation->set_rules("vaksin", "vaksin", "required|trim|max_length[100]", [
               'required' => 'vaksin wajib diisi',
               'max_length' => 'vaksin maksimal 100 karakter'
          ]);
          $this->form_validation->set_rules("ket", "ket", "trim|max_length[1000],[
               'max_length' => 'Keterangan maksimal 1000 karakter'
          ]");

          if ($this->form_validation->run() == false) {
               $error = [
                    'statusCode' => 202,
                    'prs' => form_error("prs"),
                    'kode' => form_error("kode"),
                    'vaksin' => form_error("vaksin"),
                    'ket' => form_error("ket")
               ];

               echo json_encode($error);
               return;
          } else {
               $auth_perusahaan = htmlspecialchars($this->input->post("prs", true));
               $kd_vaksin = htmlspecialchars($this->input->post("kode", true));
               $vaksin = htmlspecialchars($this->input->post("vaksin", true));
               $ket_vaksin = htmlspecialchars($this->input->post("ket", true));
               $id_perusahaan = $this->prs->get_by_auth($auth_perusahaan);

               if ($id_perusahaan == 0) {
                    echo json_encode(array("statusCode" => 201, "pesan" => "Perusahaan tidak terdaftar"));
                    return;
               }

               $cekkode = $this->tpe->cek_kode($kd_vaksin);
               if ($cekkode) {
                    echo json_encode(array("statusCode" => 201, "pesan" => "Kode sudah digunakan"));
                    return;
               }

               $cekvaksin = $this->tpe->cek_vaksin($vaksin);
               if ($cekvaksin) {
                    echo json_encode(array("statusCode" => 201, "pesan" => "vaksin sudah digunakan"));
                    return;
               }

               $data = [
                    'kd_vaksin' => $kd_vaksin,
                    'vaksin' => $vaksin,
                    'ket_vaksin' => $ket_vaksin,
                    'stat_vaksin' => 'T',
                    'tgl_buat' => date('Y-m-d H:i:s'),
                    'tgl_edit' => date('Y-m-d H:i:s'),
                    'id_user' => $this->session->userdata('id_user'),
                    'id_perusahaan' => $id_perusahaan
               ];

               $vaksin = $this->tpe->input_vaksin($data);
               if ($vaksin) {
                    echo json_encode(array("statusCode" => 200, "pesan" => "vaksin berhasil disimpan"));
               } else {
                    echo json_encode(array("statusCode" => 201, "pesan" => "vaksin gagal disimpan"));
               }
          }
     }

     public function hapus_vaksin()
     {
          $auth_vaksin = htmlspecialchars(trim($this->input->post('authvaksin')));
          $query = $this->tpe->hapus_vaksin($auth_vaksin);
          if ($query == 200) {
               echo json_encode(array("statusCode" => 200, "pesan" => "vaksin berhasil dihapus"));
               return;
          } else if ($query == 201) {
               echo json_encode(array("statusCode" => 201, "pesan" => "vaksin gagal dihapus"));
               return;
          } else {
               echo json_encode(array("statusCode" => 202, "pesan" => "vaksin tidak ditemukan"));
               return;
          }
     }

     public function detail_vaksin()
     {
          $auth_vaksin = htmlspecialchars(trim($this->input->post("authvaksin")));
          $query = $this->tpe->get_vaksin_id($auth_vaksin);
          if (!empty($query)) {
               foreach ($query as $list) {
                    if ($list->stat_vaksin == "T") {
                         $status = "AKTIF";
                    } else {
                         $status = "NONAKTIF";
                    }

                    $data = [
                         'statusCode' => 200,
                         'nama_perusahaan' => $list->nama_perusahaan,
                         'kode' => $list->kd_vaksin,
                         'vaksin' => $list->vaksin,
                         'ket' => $list->ket_vaksin,
                         'status' => $status,
                         'tgl_buat' => date('d-M-Y H:i:s', strtotime($list->tgl_buat)),
                         'pembuat' => $list->nama_user
                    ];

                    $this->session->set_userdata('id_vaksin', $list->id_vaksin);
                    $this->session->set_userdata('id_perusahaan', $list->id_perusahaan);
               }
               echo json_encode($data);
          } else {
               echo json_encode(array('statusCode' => 201, "pesan" => "vaksin tidak ditemukan"));
          }
     }

     public function edit_vaksin()
     {
          $this->form_validation->set_rules("kode", "kode", "required|trim|max_length[8]", [
               'required' => 'Kode wajib diisi',
               'max_length' => 'Kode maksimal 8 karakter'
          ]);
          $this->form_validation->set_rules("vaksin", "vaksin", "required|trim|max_length[100]", [
               'required' => 'vaksin wajib diisi',
               'max_length' => 'vaksin maksimal 100 karakter'
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
                    'vaksin' => form_error("vaksin"),
                    'status' => form_error("status")
               ];

               echo json_encode($error);
               die;
          } else {
               if ($this->session->userdata('id_perusahaan') == "") {
                    echo json_encode(array("statusCode" => 201, "pesan" => "Perusahaan tidak terdaftar"));
                    return;
               }

               if ($this->session->userdata('id_vaksin') == "") {
                    echo json_encode(array("statusCode" => 201, "pesan" => "vaksin tidak ditemukan"));
                    return;
               }

               $kd_vaksin = htmlspecialchars($this->input->post("kode", true));
               $vaksin = htmlspecialchars($this->input->post("vaksin", true));
               $ket_vaksin = htmlspecialchars($this->input->post("ket", true));
               if (htmlspecialchars($this->input->post("status", true)) == "AKTIF") {
                    $status = "T";
               } else {
                    $status = "F";
               }

               $vaksin = $this->tpe->edit_vaksin($kd_vaksin, $vaksin, $ket_vaksin, $status);
               if ($vaksin == 200) {
                    echo json_encode(array("statusCode" => 200, "pesan" => "vaksin berhasil diupdate"));
               } else if ($vaksin == 201) {
                    echo json_encode(array("statusCode" => 201, "pesan" => "vaksin gagal diupdate"));
               } else if ($vaksin == 203) {
                    echo json_encode(array("statusCode" => 203, "pesan" => "Kode sudah digunakan"));
               } else if ($vaksin == 204) {
                    echo json_encode(array("statusCode" => 205, "pesan" => "vaksin sudah digunakan"));
               }
          }
     }

     public function get_vaksin_jenis_all()
     {
          $query = $this->vks->get_vaksin_jenis_all();
          $output = "<option value=''>-- Pilih Jenis Vaksin --</option> ";
          $output = $output . "<option value='0'>Wajib Dipilih</option> ";
          if (!empty($query)) {
               foreach ($query as $list) {
                    $output = $output . "<option value='" . $list->id_vaksin_jenis . "'>" . $list->vaksin_jenis . "</option>";
               }
               echo json_encode(array("statusCode" => 200, "jvks" => $output));
          } else {
               $output = "<option value=''>-- Jenis vaksin tidak Ditemukan --</option>";
               echo json_encode(array("statusCode" => 201, "jvks" => $output));
          }
     }

     public function get_vaksin_nama_all()
     {
          $query = $this->vks->get_vaksin_nama_all();
          $output = "<option value=''>-- Pilih Nama Vaksin --</option> ";
          $output = $output . "<option value='0'>Wajib Dipilih</option> ";
          if (!empty($query)) {
               foreach ($query as $list) {
                    $output = $output . "<option value='" . $list->id_vaksin_nama . "'>" . $list->vaksin_nama . "</option>";
               }
               echo json_encode(array("statusCode" => 200, "nvks" => $output));
          } else {
               $output = "<option value=''>-- Nama vaksin tidak Ditemukan --</option>";
               echo json_encode(array("statusCode" => 201, "nvks" => $output));
          }
     }

     public function get_by_authper()
     {
          $auth_per = $this->input->post('auth_per');

          $query = $this->tpe->get_by_authper($auth_per);
          $output = "<option value=''>-- Pilih vaksin --</option>";
          if (!empty($query)) {
               foreach ($query as $list) {
                    $output = $output . "<option value='" . $list->auth_vaksin . "'>" . $list->vaksin . "</option>";
               }
               echo json_encode(array("statusCode" => 200, "tpe" => $output));
          } else {
               $output = "<option value=''>-- vaksin tidak Ditemukan --</option>";
               echo json_encode(array("statusCode" => 201, "tpe" => $output));
          }
     }

     public function get_by_idper()
     {
          if ($this->session->userdata('id_perusahaan_vaksin') != "") {
               $id_per = $this->session->userdata('id_perusahaan_vaksin');
               $output = "<option value=''>-- Pilih vaksin --</option>";
               $query = $this->tpe->get_by_idper($id_per);
               foreach ($query as $list) {
                    $output = $output . " <option value='" . $list->auth_vaksin . "'>" . $list->vaksin . "</option>";
               }

               echo json_encode(array("statusCode" => 200, "vaksin" => $output, "pesan" => "Sukses"));
          } else {
               $output = "<option value=''>-- vaksinemen tidak ditemukan --</option>";
               echo json_encode(array("statusCode" => 200, "vaksin" => $output, "pesan", "vaksin gagal ditampilkan"));
          }
     }
}
