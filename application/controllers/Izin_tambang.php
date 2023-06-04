<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Izin_tambang extends My_Controller
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
          $this->load->view('dashboard/izin_tambang/izin_tambang');
          $this->load->view('dashboard/modal/mdlform');
          $this->load->view('dashboard/template/footer', $data);
          $this->load->view('dashboard/code/izin_tambang');
     }

     public function new()
     {

          $data['nama'] = $this->session->userdata("nama");
          $data['email'] = $this->session->userdata("email");
          $data['menu'] = $this->session->userdata("id_menu");
          $this->load->view('dashboard/template/header', $data);
          $this->load->view('dashboard/izin_tambang/izin_tambang_add');
          $this->load->view('dashboard/modal/mdlform');
          $this->load->view('dashboard/template/footer', $data);
          $this->load->view('dashboard/code/izin_tambang');
     }

     public function add_unit_izin_tambang()
     {
          $this->form_validation->set_rules("jenisunit", "jenisunit", "required|trim", [
               'required' => 'Jenis unit wajib dipilih',
          ]);
          $this->form_validation->set_rules("tipeakses", "tipeakses", "required|trim", [
               'required' => 'Tipe akses wajib dipilih',
          ]);

          if ($this->form_validation->run() == false) {
               $error = [
                    'statusCode' => 202,
                    'jenisunit' => form_error("jenisunit"),
                    'tipeakses' => form_error("tipeakses"),
               ];

               echo json_encode($error);
               return;
          } else {
               $jenis_unit = htmlspecialchars($this->input->post("jenisunit", true));
               $tipe_akses = htmlspecialchars($this->input->post("tipeakses", true));

               $unit = $this->smp->get_unit($jenis_unit);
               if ($unit === 0) {
                    echo json_encode(array("statusCode" => 201, "pesan" => "Unit tidak ditemukan"));
                    return;
               }

               $akses = $this->smp->get_akses($tipe_akses);
               if ($akses === 0) {
                    echo json_encode(array("statusCode" => 201, "pesan" => "Izin akses tidak ditemukan"));
                    return;
               }

               $unit_baru = $jenis_unit . "%" . $tipe_akses;
               $unit_baru_text = $unit . "%" . $akses;

               if ($this->session->has_userdata('unit_izin')) {
                    $unit_izin = $this->session->userdata('unit_izin');
                    $unit_izin_text = $this->session->userdata('unit_izin_text');

                    if (!empty($unit_izin)) {
                         $baris = explode("|", $unit_izin);

                         foreach ($baris as $data) {
                              $item = explode("%", $data);
                              $jns_unit = $item[0];

                              if ($jenis_unit == $jns_unit) {
                                   echo json_encode(array("statusCode" => 201, "pesan" => "unit sudah ada"));
                                   return;
                              }
                         }

                         $unit_baru = $unit_izin . "|" . $unit_baru;
                         $unit_baru_text = $unit_izin_text . "|" . $unit_baru_text;
                         $this->session->set_userdata("unit_izin", $unit_baru);
                         $this->session->set_userdata("unit_izin_text", $unit_baru_text);
                    } else {
                         $this->session->set_userdata("unit_izin", $unit_baru);
                         $this->session->set_userdata("unit_izin_text", $unit_baru_text);
                    }
               } else {
                    $this->session->set_userdata("unit_izin", $unit_baru);
                    $this->session->set_userdata("unit_izin_text", $unit_baru_text);
               }

               echo json_encode(array("statusCode" => 200, "unit_izin" => $unit_baru_text, 'pesan' => 'Unit berhasil ditambahkan'));
          }
     }

     public function ajax_list()
     {
          $list = $this->smp->get_datatables();
          $data = array();
          $no = $_POST['start'];
          foreach ($list as $smp) {
               $no++;
               $row = array();
               $row['no'] = $no;
               $row['auth_izin_tambang'] = $smp->auth_izin_tambang;
               $row['jenis_izin_tambang'] = $smp->jenis_izin_tambang;
               $row['ket_izin_tambang'] = $smp->ket_izin_tambang;

               $row['tgl_buat'] = date('d-M-Y', strtotime($smp->tgl_buat));
               $row['tgl_edit'] = date('d-M-Y', strtotime($smp->tgl_edit));
               $row['proses'] = '<button id="' . $smp->auth_izin_tambang . '" class="btn btn-primary btn-sm font-weight-bold dtlizin_tambang" title="Detail"> <i class="fas fa-asterisk"></i> </button> 
                    <button id="' . $smp->auth_izin_tambang . '" class="btn btn-warning btn-sm font-weight-bold edttizin_tambang" title="Edit"> <i class="fas fa-edit"></i> </button> 
                    <button id="' . $smp->auth_izin_tambang . '" class="btn btn-danger btn-sm font-weight-bold hpsizin_tambang" title="Hapus"> <i class="fas fa-trash-alt"></i> </button>';
               $data[] = $row;
          }

          $output = array(
               "draw" => $_POST['draw'],
               "recordsTotal" => $this->smp->count_all(),
               "recordsFiltered" => $this->smp->count_filtered(),
               "data" => $data,
          );
          //output to json format
          echo json_encode($output);
     }

     public function input_izin_tambang()
     {
          $this->form_validation->set_rules("izin_tambang", "izin_tambang", "required|trim|max_length[100]", [
               'required' => 'izin_tambang wajib diisi',
               'max_length' => 'izin_tambang maksimal 100 karakter'
          ]);
          $this->form_validation->set_rules("ket", "ket", "trim|max_length[1000],[
               'max_length' => 'Keterangan maksimal 1000 karakter'
          ]");

          if ($this->form_validation->run() == false) {
               $error = [
                    'statusCode' => 202,
                    'izin_tambang' => form_error("izin_tambang"),
                    'ket' => form_error("ket")
               ];

               echo json_encode($error);
               return;
          } else {
               $izin_tambang = htmlspecialchars($this->input->post("izin_tambang", true));
               $ket_izin_tambang = htmlspecialchars($this->input->post("ket"));

               $cekizin_tambang = $this->smp->cek_izin_tambang($izin_tambang);
               if ($cekizin_tambang) {
                    echo json_encode(array("statusCode" => 201, "pesan" => "izin_tambang sudah digunakan"));
                    return;
               }

               $data = [
                    'izin_tambang' => $izin_tambang,
                    'ket_izin_tambang' => $ket_izin_tambang,
                    'stat_izin_tambang' => 'T',
                    'tgl_buat' => date('Y-m-d H:i:s'),
                    'tgl_edit' => date('Y-m-d H:i:s'),
                    'id_user' => $this->session->userdata('id_user')
               ];

               $izin_tambang = $this->smp->input_izin_tambang($data);
               if ($izin_tambang) {
                    echo json_encode(array("statusCode" => 200, "pesan" => "izin_tambang berhasil disimpan"));
               } else {
                    echo json_encode(array("statusCode" => 201, "pesan" => "izin_tambang gagal disimpan"));
               }
          }
     }

     public function hapus_izin_tambang()
     {
          $auth_izin_tambang = htmlspecialchars(trim($this->input->post('auth_izin_tambang')));
          $query = $this->smp->hapus_izin_tambang($auth_izin_tambang);
          if ($query == 200) {
               echo json_encode(array("statusCode" => 200, "pesan" => "izin_tambang berhasil dihapus"));
               return;
          } else if ($query == 201) {
               echo json_encode(array("statusCode" => 201, "pesan" => "izin_tambang gagal dihapus"));
               return;
          } else {
               echo json_encode(array("statusCode" => 202, "pesan" => "izin_tambang tidak ditemukan"));
               return;
          }
     }

     public function detail_izin_tambang()
     {
          $auth_izin_tambang = htmlspecialchars(trim($this->input->post("auth_izin_tambang")));
          $query = $this->smp->get_izin_tambang_id($auth_izin_tambang);
          if (!empty($query)) {
               foreach ($query as $list) {
                    if ($list->stat_izin_tambang == "T") {
                         $status = "AKTIF";
                    } else {
                         $status = "NONAKTIF";
                    }

                    $data = [
                         'statusCode' => 200,
                         'izin_tambang' => $list->izin_tambang,
                         'ket' => $list->ket_izin_tambang,
                         'status' => $status,
                         'tgl_buat' => date('d-M-Y H:i:s', strtotime($list->tgl_buat)),
                         'pembuat' => $list->nama_user
                    ];

                    $this->session->set_userdata('id_izin_tambang', $list->id_izin_tambang);
               }
               echo json_encode($data);
          } else {
               echo json_encode(array('statusCode' => 201, "pesan" => "izin_tambang tidak ditemukan"));
          }
     }

     public function edit_izin_tambang()
     {
          $this->form_validation->set_rules("izin_tambang", "izin_tambang", "required|trim|max_length[100]", [
               'required' => 'izin_tambang wajib diisi',
               'max_length' => 'izin_tambang maksimal 100 karakter'
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
                    'izin_tambang' => form_error("izin_tambang"),
                    'status' => form_error("status"),
                    'ket' => form_error('ket')
               ];

               echo json_encode($error);
               die;
          } else {
               if ($this->session->userdata('id_izin_tambang') == "") {
                    echo json_encode(array("statusCode" => 201, "pesan" => "izin_tambang tidak ditemukan"));
                    return;
               }

               $izin_tambang = htmlspecialchars($this->input->post("izin_tambang", true));
               $ket_izin_tambang = htmlspecialchars($this->input->post("ket", true));
               if (htmlspecialchars($this->input->post("status", true)) == "AKTIF") {
                    $status = "T";
               } else {
                    $status = "F";
               }

               $izin_tambang = $this->smp->edit_izin_tambang($izin_tambang, $ket_izin_tambang, $status);
               if ($izin_tambang == 200) {
                    echo json_encode(array("statusCode" => 200, "pesan" => "izin_tambang berhasil diupdate"));
               } else if ($izin_tambang == 201) {
                    echo json_encode(array("statusCode" => 201, "pesan" => "izin_tambang gagal diupdate"));
               } else if ($izin_tambang == 204) {
                    echo json_encode(array("statusCode" => 205, "pesan" => "izin_tambang sudah digunakan"));
               }
          }
     }

     public function get_all()
     {
          $query = $this->smp->get_all();
          $output = "<option value=''>-- Pilih izin_tambang --</option>";
          if (!empty($query)) {
               foreach ($query as $list) {
                    $output = $output . "<option value='" . $list->auth_izin_tambang . "'>" . $list->izin_tambang . "</option>";
               }
               echo json_encode(array("statusCode" => 200, "smp" => $output));
          } else {
               $output = "<option value=''>-- izin_tambang tidak Ditemukan --</option>";
               echo json_encode(array("statusCode" => 201, "smp" => $output));
          }
     }

     public function get_all_unit()
     {
          $query = $this->smp->get_all_unit();
          $output = "<option value=''>-- WAJIB DIPILIH --</option>";
          if (!empty($query)) {
               foreach ($query as $list) {
                    $output = $output . "<option value='" . $list->id_unit . "'>" . $list->unit . "</option>";
               }
               echo json_encode(array("statusCode" => 200, "unit" => $output));
          } else {
               $output = "<option value=''>-- Unit tidak Ditemukan --</option>";
               echo json_encode(array("statusCode" => 201, "unit" => $output));
          }
     }

     public function get_all_akses()
     {
          $query = $this->smp->get_all_akses();
          $output = "<option value=''>-- WAJIB DIPILIH --</option>";
          if (!empty($query)) {
               foreach ($query as $list) {
                    $output = $output . "<option value='" . $list->id_tipe_akses_unit . "'>" . $list->tipe_akses_unit . "</option>";
               }
               echo json_encode(array("statusCode" => 200, "akses" => $output));
          } else {
               $output = "<option value=''>-- tipe akses tidak Ditemukan --</option>";
               echo json_encode(array("statusCode" => 201, "akses" => $output));
          }
     }

     public function get_by_idper()
     {
          if ($this->session->userdata('id_perusahaan_izin_tambang') != "") {
               $id_per = $this->session->userdata('id_perusahaan_izin_tambang');
               $output = "<option value=''>-- Pilih izin_tambang --</option>";
               $query = $this->smp->get_by_idper($id_per);
               foreach ($query as $list) {
                    $output = $output . " <option value='" . $list->auth_izin_tambang . "'>" . $list->izin_tambang . "</option>";
               }

               echo json_encode(array("statusCode" => 200, "izin_tambang" => $output, "pesan" => "Sukses"));
          } else {
               $output = "<option value=''>-- izin_tambangemen tidak ditemukan --</option>";
               echo json_encode(array("statusCode" => 200, "izin_tambang" => $output, "pesan", "izin_tambang gagal ditampilkan"));
          }
     }
}
