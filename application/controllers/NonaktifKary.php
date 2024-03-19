<?php
defined('BASEPATH') or exit('No direct script access allowed');

class NonaktifKary extends My_Controller
{
     public function __construct()
     {
          parent::__construct();
          $this->is_logout();
     }

     public function index()
     {
          if ($this->session->has_userdata('id_m_perusahaan_hcdata')) {
               $idmper = $this->session->userdata('id_m_perusahaan_hcdata');
               if ($idmper != "") {
                    $data['permst'] = $this->str->getMaster($idmper, "");
                    $data['perstr'] = $this->str->getMenu($idmper, "");
               } else {
                    $data['permst'] = "";
                    $data['perstr'] = "";
               }
          } else {
               $idmper = "";
               $data['permst'] = "";
               $data['perstr'] = "";
          }

          $id_perusahaan = $this->session->userdata("id_m_perusahaan_hcdata");
          $data['nama_per'] = $this->prs->get_per_by_id($id_perusahaan);
          $data['nama'] = $this->session->userdata("nama_hcdata");
          $data['email'] = $this->session->userdata("email_hcdata");
          $data['menu'] = $this->session->userdata("id_menu_hcdata");
          $data['get_menu'] = $this->dsmod->get_menu();
          $this->load->view('dashboard/template/header', $data);
          $this->load->view('dashboard/nonaktif_karyawan/nonaktif_kary');
          $this->load->view('dashboard/template/footer', $data);
          $this->load->view('dashboard/code/nonaktif_kary');
     }

     public function new()
     {
          if ($this->session->has_userdata('id_m_perusahaan_hcdata')) {
               $idmper = $this->session->userdata('id_m_perusahaan_hcdata');
               if ($idmper != "") {
                    $data['permst'] = $this->str->getMaster($idmper, "");
                    $data['perstr'] = $this->str->getMenu($idmper, "");
               } else {
                    $data['permst'] = "";
                    $data['perstr'] = "";
               }
          } else {
               $idmper = "";
               $data['permst'] = "";
               $data['perstr'] = "";
          }

          $id_perusahaan = $this->session->userdata("id_m_perusahaan_hcdata");
          $data['nama_per'] = $this->prs->get_per_by_id($id_perusahaan);
          $data['nama'] = $this->session->userdata("nama_hcdata");
          $data['email'] = $this->session->userdata("email_hcdata");
          $data['menu'] = $this->session->userdata("id_menu_hcdata");
          $data['get_menu'] = $this->dsmod->get_menu();
          $this->load->view('dashboard/template/header', $data);
          $this->load->view('dashboard/nonaktif_karyawan/nonaktif_kary_add');
          $this->load->view('dashboard/template/footer', $data);
          $this->load->view('dashboard/code/nonaktif_kary');
     }

     public function ajax_list()
     {
          $auth = htmlspecialchars($this->input->get("authtoken"));
          $this->cek_auth($auth);

          $auth_m_per = $this->input->get("auth_m_per");
          $list = $this->nakary->get_datatables($auth_m_per);
          $data = array();
          $no = $_POST['start'];
          foreach ($list as $nakary) {
               $no++;
               $row = array();
               $row['no'] = $no;
               $row['auth_kary_nonaktif'] = $nakary->auth_kary_nonaktif;
               $row['no_ktp'] = $nakary->no_ktp;
               $row['no_nik'] = $nakary->no_nik;
               $row['nama_lengkap'] = $nakary->nama_lengkap;
               $row['depart'] = $nakary->depart;
               $row['alasan_nonaktif'] = $nakary->alasan_nonaktif;
               $row['tgl_nonaktif'] = date('d-M-Y', strtotime($nakary->tgl_nonaktif));
               $row['ket_nonaktif'] = $nakary->ket_nonaktif;
               $row['kode_perusahaan'] = $nakary->kode_perusahaan;
               $row['tgl_buat'] = date('d-M-Y', strtotime($nakary->tgl_buat));
               $row['tgl_edit'] = date('d-M-Y', strtotime($nakary->tgl_edit));
               $row['proses'] = '<button id="' . $nakary->auth_kary_nonaktif . '" class="btn btn-primary btn-sm font-weight-bold dtlnonaktif" title="Detail" value=""> <i class="fas fa-asterisk"></i> </button> 
                    <button id="' . $nakary->auth_kary_nonaktif . '" class="btn btn-warning btn-sm font-weight-bold edtnonaktif" title="Edit" value=""> <i class="fas fa-edit"></i> </button> 
                    <button id="' . $nakary->auth_kary_nonaktif . '" class="btn btn-danger btn-sm font-weight-bold hpsnonaktif" title="Hapus" value="No. KTP : ' . $nakary->no_ktp . ', Nama : ' . $nakary->nama_lengkap . '"> <i class="fas fa-trash-alt"></i> </button>';
               $data[] = $row;
          }

          $output = array(
               "draw" => $_POST['draw'],
               "recordsTotal" => $this->nakary->count_all(),
               "recordsFiltered" => $this->nakary->count_filtered($auth_m_per),
               "data" => $data,
          );
          //output to json format
          echo json_encode($output);
     }

     public function cek_data()
     {

          $auth = htmlspecialchars($this->input->post("token"));
          $this->cek_auth($auth);

          $this->form_validation->set_rules("auth_m_per", "auth_m_per", "required|trim", [
               'required' => 'Perusahaan wajib dipilih'
          ]);
          $this->form_validation->set_rules("auth_kary", "auth_kary", "required|trim", [
               'required' => 'Karyawan wajib dipilih'
          ]);
          $this->form_validation->set_rules("auth_alasan", "auth_alasan", "required|trim|max_length[100]", [
               'required' => 'Alasan nonaktif wajib diisi',
          ]);
          $this->form_validation->set_rules("tglnonaktif", "tglnonaktif", "required|trim|max_length[100]", [
               'required' => 'Tanggal nonaktif wajib diisi',
          ]);
          $this->form_validation->set_rules("ket_alasan", "ket_alasan", "required|trim|max_length[1000]", [
               'required' => 'Keterangan wajib diisi',
               'max_length' => 'Keterangan maksimal 1000 karakter'
          ]);

          if ($this->form_validation->run() == false) {
               $error = [
                    'statusCode' => 202,
                    'prs' => form_error("auth_m_per"),
                    'kary' => form_error("auth_kary"),
                    'tglnonaktif' => form_error("tglnonaktif"),
                    'alasan' => form_error("auth_alasan"),
                    'ket' => form_error("ket_alasan"),
               ];

               echo json_encode($error);
               return;
          } else {
               echo json_encode(["statusCode" => 200, "pesan" => "Sukses"]);
               return;
          }
     }

     public function input_NonaktifKary()
     {

          $auth = htmlspecialchars($this->input->post("token"));
          $this->cek_auth($auth);

          $auth_m_per = htmlspecialchars($this->input->post("auth_m_per", true));
          $auth_kary = htmlspecialchars($this->input->post("auth_kary", true));
          $tglnonaktif = htmlspecialchars($this->input->post("tglnonaktif", true));
          $auth_alasan = htmlspecialchars($this->input->post("auth_alasan", true));
          $ket_alasan = htmlspecialchars($this->input->post("ket_alasan", true));
          $file_nonaktif = htmlspecialchars($this->input->post("file_nonaktif", true));
          $id_m_perusahaan = $this->str->get_id_per($auth_m_per);
          $id_personal = $this->kry->get_id_personal_by_kary($auth_kary);
          $id_kary = $this->kry->get_id_karyawan($auth_kary);
          $id_alasan = $this->nakary->get_id_alasan($auth_alasan);
          $alasan = $this->nakary->get_alasan($auth_alasan);
          if (!empty($alasan)) {
               foreach ($alasan as $lstalasan) {
                    $stat_upload = $lstalasan->stat_upload_berkas;
                    if ($stat_upload = "") {
                         $stat_upload = "T";
                    }
               }
          } else {
               $stat_upload = "T";
          }

          $foldername = md5($id_personal);
          $now = date('YmdHis');
          $nama_file = $now . "-NONAKTIF.pdf";

          if ($id_m_perusahaan == 0) {
               echo json_encode(array("statusCode" => 201, "pesan" => "Perusahaan tidak terdaftar"));
               return;
          }

          $cekkary = $this->kry->get_by_auth($auth_kary);
          if (empty($cekkary)) {
               echo json_encode(array("statusCode" => 201, "pesan" => "Data karyawan tidak ditemukan"));
               return;
          }

          $ceknonaktif = $this->nakary->cek_nonaktif($auth_kary);
          if (!empty($ceknonaktif)) {
               echo json_encode(array("statusCode" => 201, "pesan" => "Data gagal disimpan, karyawan telah dinonaktifkan, periksa data"));
               return;
          }

          if ($stat_upload == "T") {
               if (is_dir('./berkas/karyawan/' . $foldername) == false) {
                    mkdir('./berkas/karyawan/' . $foldername, 0775, TRUE);
               }

               if (is_dir('./berkas/karyawan/' . $foldername)) {
                    $config['upload_path'] = './berkas/karyawan/' . $foldername;
                    $config['allowed_types'] = 'pdf';
                    $config['max_size'] = 200;
                    $config['file_name'] = $nama_file;

                    $this->load->library('upload', $config);
                    if (!$this->upload->do_upload('fl_nonaktif')) {
                         $err = $this->upload->display_errors();

                         if ($err == "<p>The file you are attempting to upload is larger than the permitted size.</p>") {
                              $error = "<p>Ukuran file maksimal 200 kb.</p>";
                         } else if ($err == "<p>The filetype you are attempting to upload is not allowed.</p>") {
                              $error = "<p>Format file nya dalam bentuk pdf</p>";
                         } else {
                              $error = $err;
                         }

                         $err_nonaktif = [
                              'statusCode' => 202,
                              'prs' => '',
                              'kary' => '',
                              'tglnonaktif' => '',
                              'alasan' => '',
                              'ket' => '',
                              'fileup' => $error,
                         ];

                         echo json_encode($err_nonaktif);
                         die;
                    } else {
                         $dt_nonaktif = array(
                              'id_kary' => $id_kary,
                              'tgl_nonaktif' => $tglnonaktif,
                              'id_alasan_nonaktif' => $id_alasan,
                              'ket_nonaktif' => $ket_alasan,
                              'url_berkas_nonaktif' => $nama_file,
                              'tgl_buat' => date('Y-m-d H:i:s'),
                              'tgl_edit' => date('Y-m-d H:i:s'),
                              'id_user' => $this->session->userdata('id_user_hcdata')
                         );

                         $ins_nonaktif = $this->nakary->input_NonaktifKary($dt_nonaktif);
                         if ($ins_nonaktif) {
                              echo json_encode(array("statusCode" => 200, "pesan" => "Data nonaktif karyawan berhasil disimpan"));
                              return;
                         } else {
                              echo json_encode(array("statusCode" => 201, "pesan" => "Data nonaktif karyawan gagal disimpan"));
                         }
                    }
               } else {
                    echo json_encode(array("statusCode" => 201, "pesan" => "Folder penyimpanan tidak ditemukan"));
               }
          } else {
               $dt_nonaktif = array(
                    'id_kary' => $id_kary,
                    'tgl_nonaktif' => $tglnonaktif,
                    'id_alasan_nonaktif' => $id_alasan,
                    'ket_nonaktif' => $ket_alasan,
                    'url_berkas_nonaktif' => $nama_file,
                    'tgl_buat' => date('Y-m-d H:i:s'),
                    'tgl_edit' => date('Y-m-d H:i:s'),
                    'id_user' => $this->session->userdata('id_user_hcdata')
               );

               $ins_nonaktif = $this->nakary->input_NonaktifKary($dt_nonaktif);
               if ($ins_nonaktif) {
                    echo json_encode(array("statusCode" => 200, "pesan" => "Data nonaktif karyawan berhasil disimpan"));
                    return;
               } else {
                    echo json_encode(array("statusCode" => 201, "pesan" => "Data nonaktif karyawan gagal disimpan"));
               }
          }
     }

     public function hapus_NonaktifKary()
     {
          $auth = htmlspecialchars($this->input->post("token"));
          $this->cek_auth($auth);

          $authNonaktifKary = htmlspecialchars(trim($this->input->post('authNonaktifKary')));
          $query = $this->nakary->hapus_NonaktifKary($authNonaktifKary);
          if ($query == 200) {
               echo json_encode(array("statusCode" => 200, "pesan" => "Data nonaktif karyawan berhasil dihapus"));
               return;
          } else if ($query == 201) {
               echo json_encode(array("statusCode" => 201, "pesan" => "Data nonaktif karyawan gagal dihapus"));
               return;
          } else {
               echo json_encode(array("statusCode" => 202, "pesan" => "Data nonaktif karyawan tidak ditemukan"));
               return;
          }
     }

     public function detail_posisi()
     {
          $auth_posisi = htmlspecialchars(trim($this->input->post("authposisi")));
          $query = $this->nakary->get_posisi_id($auth_posisi);
          if (!empty($query)) {
               foreach ($query as $list) {
                    if ($list->stat_posisi == "T") {
                         $status = "AKTIF";
                    } else {
                         $status = "NONAKTIF";
                    }

                    if ($list->depart == null) {
                         $auth_depart = '';
                    } else {
                         $auth_depart = $list->auth_depart;
                    }
                    $data = [
                         'statusCode' => 200,
                         'nama_perusahaan' => $list->nama_perusahaan,
                         'posisi' => $list->posisi,
                         'depart' =>  $list->depart,
                         'auth_depart' => $auth_depart,
                         'ket' => $list->ket_posisi,
                         'status' => $status,
                         'tgl_buat' => date('d-M-Y H:i:s', strtotime($list->tgl_buat)),
                         'pembuat' => $list->nama_user
                    ];

                    $this->session->set_userdata('id_depart_hcdt', $list->id_depart);
                    $this->session->set_userdata('id_posisi_hcdt', $list->id_posisi);
                    $this->session->set_userdata('id_perusahaan_posisi_hcdt', $list->id_perusahaan);
               }
               echo json_encode($data);
          } else {
               echo json_encode(array('statusCode' => 201, "pesan" => "posisi tidak ditemukan"));
          }
     }

     public function edit_posisi()
     {
          $this->form_validation->set_rules("posisi", "posisi", "required|trim|max_length[100]", [
               'required' => 'posisi wajib diisi',
               'max_length' => 'posisi maksimal 100 karakter'
          ]);
          $this->form_validation->set_rules("depart", "depart", "required|trim", [
               'required' => 'Departemen wajib dipilih'
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
                    'depart' => form_error("depart"),
                    'posisi' => form_error("posisi"),
                    'status' => form_error("status"),
                    'ket' => form_error("ket")
               ];

               echo json_encode($error);
               die;
          } else {
               if ($this->session->userdata('id_perusahaan_posisi_hcdt') == "") {
                    echo json_encode(array("statusCode" => 201, "pesan" => "Perusahaan tidak terdaftar"));
                    return;
               }

               if ($this->session->userdata('id_posisi_hcdt') == "") {
                    echo json_encode(array("statusCode" => 201, "pesan" => "Posisi tidak ditemukan"));
                    return;
               }

               if ($this->session->userdata('id_depart_hcdt') == "") {
                    echo json_encode(array("statusCode" => 201, "pesan" => "Departemen tidak ditemukan"));
                    return;
               }

               $posisi = htmlspecialchars($this->input->post("posisi", true));
               $depart = htmlspecialchars($this->input->post("depart", true));
               $ket_posisi = htmlspecialchars($this->input->post("ket", true));
               if (htmlspecialchars($this->input->post("status", true)) == "AKTIF") {
                    $status = "T";
               } else {
                    $status = "F";
               }
               $posisi = $this->nakary->edit_posisi($posisi, $depart, $ket_posisi, $status);
               if ($posisi == 200) {
                    $this->session->unset_userdata('id_posisi');
                    $this->session->unset_userdata('id_depart');
                    echo json_encode(array("statusCode" => 200, "pesan" => "Posisi berhasil diupdate"));
               } else if ($posisi == 201) {
                    echo json_encode(array("statusCode" => 201, "pesan" => "Posisi gagal diupdate"));
               } else if ($posisi == 204) {
                    echo json_encode(array("statusCode" => 205, "pesan" => "Posisi sudah digunakan"));
               }
          }
     }

     public function gel_all_alasan()
     {
          $query = $this->nakary->get_all_alasan();

          if (!empty($query)) {
               $output = "<option value=''>-- PILIH ALASAN NONAKTIF --</option>";
               foreach ($query as $list) {
                    $output = $output . " <option value='" . $list->auth_alasan_nonaktif . "'>" . $list->alasan_nonaktif . "</option>";
               }
          } else {
               $output = " <option value=''>TIDAK ADA DATA</option>";
          }

          echo json_encode(array("statusCode" => 200, "alasan" => $output, "pesan" => "Sukses"));
     }

     public function get_by_authdepart()
     {
          $auth_depart = $this->input->post('auth_depart');

          $query = $this->nakary->get_by_authdepart($auth_depart);
          $output = "<option value=''>-- WAJIB DIPILIH --</option>";
          if (!empty($query)) {
               foreach ($query as $list) {
                    $output = $output . "<option value='" . $list->auth_posisi . "'>" . $list->posisi . "</option>";
               }
               echo json_encode(array("statusCode" => 200, "posisi" => $output));
          } else {
               $output = "<option value=''>-- POSISI TIDAK DITEMUKAN --</option>";
               echo json_encode(array("statusCode" => 201, "posisi" => $output));
          }
     }

     public function get_auth_posisi_by_id()
     {
          $id_posisi = $this->input->post('id_posisi');
          $query = $this->nakary->get_auth_posisi($id_posisi);
          if ($query === 0) {
               return 0;
          } else {
               return $query;
          }
     }
}