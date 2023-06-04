<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Sertifikasi extends My_Controller
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
          $this->load->view('dashboard/sertifikasi/sertifikasi');
          $this->load->view('dashboard/modal/mdlform');
          $this->load->view('dashboard/template/footer', $data);
          $this->load->view('dashboard/code/sertifikasi');
     }

     public function new()
     {
          $data['nama'] = $this->session->userdata("nama");
          $data['email'] = $this->session->userdata("email");
          $data['menu'] = $this->session->userdata("id_menu");
          $this->load->view('dashboard/template/header', $data);
          $this->load->view('dashboard/sertifikasi/sertifikasi_add');
          $this->load->view('dashboard/modal/mdlform');
          $this->load->view('dashboard/template/footer', $data);
          $this->load->view('dashboard/code/sertifikasi');
     }

     public function ajax_list()
     {
          $list = $this->bnk->get_datatables();
          $data = array();
          $no = $_POST['start'];
          foreach ($list as $bnk) {
               $no++;
               $row = array();
               $row['no'] = $no;
               $row['auth_sertifikasi'] = $bnk->auth_sertifikasi;
               $row['sertifikasi'] = $bnk->sertifikasi;
               $row['ket_sertifikasi'] = $bnk->ket_sertifikasi;

               if ($bnk->stat_sertifikasi == "T") {
                    $row['stat_sertifikasi'] = "<span class='btn btn-success btn-sm '> AKTIF </span>";
               } else {
                    $row['stat_sertifikasi'] = "<div class='btn btn-danger btn-sm'> NONAKTIF </div>";
               }

               $row['tgl_buat'] = date('d-M-Y', strtotime($bnk->tgl_buat));
               $row['tgl_edit'] = date('d-M-Y', strtotime($bnk->tgl_edit));
               $row['proses'] = '<button id="' . $bnk->auth_sertifikasi . '" class="btn btn-primary btn-sm font-weight-bold dtlsertifikasi" title="Detail" value="' . $bnk->sertifikasi . '"> <i class="fas fa-asterisk"></i> </button> 
                    <button id="' . $bnk->auth_sertifikasi . '" class="btn btn-warning btn-sm font-weight-bold edttsertifikasi" title="Edit" value="' . $bnk->sertifikasi . '"> <i class="fas fa-edit"></i> </button> 
                    <button id="' . $bnk->auth_sertifikasi . '" class="btn btn-danger btn-sm font-weight-bold hpssertifikasi" title="Hapus" value="' . $bnk->sertifikasi . '"> <i class="fas fa-trash-alt"></i> </button>';
               $data[] = $row;
          }

          $output = array(
               "draw" => $_POST['draw'],
               "recordsTotal" => $this->bnk->count_all(),
               "recordsFiltered" => $this->bnk->count_filtered(),
               "data" => $data,
          );
          //output to json format
          echo json_encode($output);
     }

     public function input_sertifikasi()
     {
          $this->form_validation->set_rules("sertifikasi", "sertifikasi", "required|trim|max_length[100]", [
               'required' => 'sertifikasi wajib diisi',
               'max_length' => 'sertifikasi maksimal 100 karakter'
          ]);
          $this->form_validation->set_rules("ket", "ket", "trim|max_length[1000],[
               'max_length' => 'Keterangan maksimal 1000 karakter'
          ]");

          if ($this->form_validation->run() == false) {
               $error = [
                    'statusCode' => 202,
                    'sertifikasi' => form_error("sertifikasi"),
                    'ket' => form_error("ket")
               ];

               echo json_encode($error);
               return;
          } else {
               $sertifikasi = htmlspecialchars($this->input->post("sertifikasi", true));
               $ket_sertifikasi = htmlspecialchars($this->input->post("ket"));

               $ceksertifikasi = $this->bnk->cek_sertifikasi($sertifikasi);
               if ($ceksertifikasi) {
                    echo json_encode(array("statusCode" => 201, "pesan" => "sertifikasi sudah digunakan"));
                    return;
               }

               $data = [
                    'sertifikasi' => $sertifikasi,
                    'ket_sertifikasi' => $ket_sertifikasi,
                    'stat_sertifikasi' => 'T',
                    'tgl_buat' => date('Y-m-d H:i:s'),
                    'tgl_edit' => date('Y-m-d H:i:s'),
                    'id_user' => $this->session->userdata('id_user')
               ];

               $sertifikasi = $this->bnk->input_sertifikasi($data);
               if ($sertifikasi) {
                    echo json_encode(array("statusCode" => 200, "pesan" => "sertifikasi berhasil disimpan"));
               } else {
                    echo json_encode(array("statusCode" => 201, "pesan" => "sertifikasi gagal disimpan"));
               }
          }
     }

     public function hapus_sertifikasi()
     {
          $auth_sertifikasi = htmlspecialchars(trim($this->input->post('auth_sertifikasi')));
          $query = $this->bnk->hapus_sertifikasi($auth_sertifikasi);
          if ($query == 200) {
               echo json_encode(array("statusCode" => 200, "pesan" => "sertifikasi berhasil dihapus"));
               return;
          } else if ($query == 201) {
               echo json_encode(array("statusCode" => 201, "pesan" => "sertifikasi gagal dihapus"));
               return;
          } else {
               echo json_encode(array("statusCode" => 202, "pesan" => "sertifikasi tidak ditemukan"));
               return;
          }
     }

     public function detail_sertifikasi()
     {
          $auth_sertifikasi = htmlspecialchars(trim($this->input->post("auth_sertifikasi")));
          $query = $this->bnk->get_sertifikasi_id($auth_sertifikasi);
          if (!empty($query)) {
               foreach ($query as $list) {
                    if ($list->stat_sertifikasi == "T") {
                         $status = "AKTIF";
                    } else {
                         $status = "NONAKTIF";
                    }

                    $data = [
                         'statusCode' => 200,
                         'sertifikasi' => $list->sertifikasi,
                         'ket' => $list->ket_sertifikasi,
                         'status' => $status,
                         'tgl_buat' => date('d-M-Y H:i:s', strtotime($list->tgl_buat)),
                         'pembuat' => $list->nama_user
                    ];

                    $this->session->set_userdata('id_sertifikasi', $list->id_sertifikasi);
               }
               echo json_encode($data);
          } else {
               echo json_encode(array('statusCode' => 201, "pesan" => "sertifikasi tidak ditemukan"));
          }
     }

     public function tabel_sertifikasi()
     {
          if ($this->session->has_userdata("idpersonal")) {
               $id_personal = $this->session->userdata('idpersonal');
               if ($id_personal != "") {
                    $query = $this->srt->tabel_sertifikasi($id_personal);
                    if (!empty($query)) {
                         echo json_encode(array("statusCode" => 200, "tbl" => $query, "pesan" => "Sukses"));
                    } else {
                         echo json_encode(array("statusCode" => 201, "tbl" => "", "pesan" => "Gagal"));
                    }
               } else {
                    echo json_encode(array("statusCode" => 201, "tbl" => "", "pesan" => "Gagal"));
               }
          } else {
               echo json_encode(array("statusCode" => 201, "tbl" => "", "pesan" => "Gagal"));
          }
     }

     public function edit_sertifikasi()
     {
          $this->form_validation->set_rules("sertifikasi", "sertifikasi", "required|trim|max_length[100]", [
               'required' => 'sertifikasi wajib diisi',
               'max_length' => 'sertifikasi maksimal 100 karakter'
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
                    'sertifikasi' => form_error("sertifikasi"),
                    'status' => form_error("status"),
                    'ket' => form_error('ket')
               ];

               echo json_encode($error);
               die;
          } else {
               if ($this->session->userdata('id_sertifikasi') == "") {
                    echo json_encode(array("statusCode" => 201, "pesan" => "sertifikasi tidak ditemukan"));
                    return;
               }

               $sertifikasi = htmlspecialchars($this->input->post("sertifikasi", true));
               $ket_sertifikasi = htmlspecialchars($this->input->post("ket", true));
               if (htmlspecialchars($this->input->post("status", true)) == "AKTIF") {
                    $status = "T";
               } else {
                    $status = "F";
               }

               $sertifikasi = $this->bnk->edit_sertifikasi($sertifikasi, $ket_sertifikasi, $status);
               if ($sertifikasi == 200) {
                    echo json_encode(array("statusCode" => 200, "pesan" => "sertifikasi berhasil diupdate"));
               } else if ($sertifikasi == 201) {
                    echo json_encode(array("statusCode" => 201, "pesan" => "sertifikasi gagal diupdate"));
               } else if ($sertifikasi == 204) {
                    echo json_encode(array("statusCode" => 205, "pesan" => "sertifikasi sudah digunakan"));
               }
          }
     }

     public function getdateexpmasa()
     {
          $tglsrt = htmlspecialchars($this->input->post("tglsrt", true));
          $masa = htmlspecialchars($this->input->post("masa", true));

          if ($tglsrt !== "") {
               $tglexp = date("Y-m-d", strtotime("+" . $masa . " year", strtotime($tglsrt)));

               echo json_encode(array("statusCode" => 200, "tglexp" => $tglexp, "pesan" => "Sukses proses tanggal expired"));
          } else {
               echo json_encode(array("statusCode" => 201, "tglexp" => 0, "pesan" => "Gagal proses tanggal expired"));
          }
     }

     public function getdateexpsrt()
     {
          $tglsrt = htmlspecialchars($this->input->post("tglsrt", true));
          $masa = htmlspecialchars($this->input->post("masa", true));

          if ($masa !== "") {
               $tglexp = date("Y-m-d", strtotime("+" . $masa . " year", strtotime($tglsrt)));

               echo json_encode(array("statusCode" => 200, "tglexp" => $tglexp, "pesan" => "Sukses proses tanggal expired"));
          } else {
               echo json_encode(array("statusCode" => 201, "tglexp" => 0, "pesan" => "Gagal proses tanggal expired"));
          }
     }

     public function get_jenis_sertifikasi()
     {
          $query = $this->srt->get_jenis_sertifikasi();
          $output = "<option value=''>-- WAJIB DIPILIH --</option>";
          if (!empty($query)) {
               foreach ($query as $list) {
                    $output = $output . "<option value='" . $list->id_jenis_sertifikasi . "'>" . $list->jenis_sertifikasi . "</option>";
               }
               echo json_encode(array("statusCode" => 200, "srt" => $output));
          } else {
               $output = "<option value=''>-- Jenis sertifikasi tidak Ditemukan --</option>";
               echo json_encode(array("statusCode" => 201, "srt" => $output));
          }
     }

     public function get_by_authper()
     {
          $auth_per = $this->input->post('auth_per');

          $query = $this->bnk->get_by_authper($auth_per);
          $output = "<option value=''>-- Pilih sertifikasi --</option>";
          if (!empty($query)) {
               foreach ($query as $list) {
                    $output = $output . "<option value='" . $list->auth_sertifikasi . "'>" . $list->sertifikasi . "</option>";
               }
               echo json_encode(array("statusCode" => 200, "bnk" => $output));
          } else {
               $output = "<option value=''>-- sertifikasi tidak Ditemukan --</option>";
               echo json_encode(array("statusCode" => 201, "bnk" => $output));
          }
     }

     public function get_by_idper()
     {
          if ($this->session->userdata('id_perusahaan_sertifikasi') != "") {
               $id_per = $this->session->userdata('id_perusahaan_sertifikasi');
               $output = "<option value=''>-- Pilih sertifikasi --</option>";
               $query = $this->bnk->get_by_idper($id_per);
               foreach ($query as $list) {
                    $output = $output . " <option value='" . $list->auth_sertifikasi . "'>" . $list->sertifikasi . "</option>";
               }

               echo json_encode(array("statusCode" => 200, "sertifikasi" => $output, "pesan" => "Sukses"));
          } else {
               $output = "<option value=''>-- sertifikasiemen tidak ditemukan --</option>";
               echo json_encode(array("statusCode" => 200, "sertifikasi" => $output, "pesan", "sertifikasi gagal ditampilkan"));
          }
     }
}
