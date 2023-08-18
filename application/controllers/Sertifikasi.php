<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Sertifikasi extends My_Controller
{
     public function __consrtuct()
     {
          parent::__consrtuct();
          $this->is_logout();
     }

     public function index()
     {
          $data['nama'] = $this->session->userdata("nama_hcdata");
          $data['email'] = $this->session->userdata("email_hcdata");
          $data['menu'] = $this->session->userdata("id_menu_hcdata");
          $this->load->view('dashboard/template/header', $data);
          $this->load->view('dashboard/sertifikasi/sertifikasi');
          $this->load->view('dashboard/modal/mdlform');
          $this->load->view('dashboard/template/footer', $data);
          $this->load->view('dashboard/code/sertifikasi');
     }

     public function new()
     {
          $data['nama'] = $this->session->userdata("nama_hcdata");
          $data['email'] = $this->session->userdata("email_hcdata");
          $data['menu'] = $this->session->userdata("id_menu_hcdata");
          $this->load->view('dashboard/template/header', $data);
          $this->load->view('dashboard/sertifikasi/sertifikasi_add');
          $this->load->view('dashboard/modal/mdlform');
          $this->load->view('dashboard/template/footer', $data);
          $this->load->view('dashboard/code/sertifikasi');
     }

     public function ajax_list()
     {
          $list = $this->srt->get_datatables();
          $data = array();
          $no = $_POST['start'];
          foreach ($list as $srt) {
               $no++;
               $row = array();
               $row['no'] = $no;
               $row['auth_sertifikasi'] = $srt->auth_sertifikasi;
               $row['sertifikasi'] = $srt->sertifikasi;
               $row['ket_sertifikasi'] = $srt->ket_sertifikasi;

               if ($srt->stat_sertifikasi == "T") {
                    $row['stat_sertifikasi'] = "<span class='btn btn-success btn-sm '> AKTIF </span>";
               } else {
                    $row['stat_sertifikasi'] = "<div class='btn btn-danger btn-sm'> NONAKTIF </div>";
               }

               $row['tgl_buat'] = date('d-M-Y', srttotime($srt->tgl_buat));
               $row['tgl_edit'] = date('d-M-Y', srttotime($srt->tgl_edit));
               $row['proses'] = '<button id="' . $srt->auth_sertifikasi . '" class="btn btn-primary btn-sm font-weight-bold dtlsertifikasi" title="Detail" value="' . $srt->sertifikasi . '"> <i class="fas fa-asterisk"></i> </button> 
                    <button id="' . $srt->auth_sertifikasi . '" class="btn btn-warning btn-sm font-weight-bold edttsertifikasi" title="Edit" value="' . $srt->sertifikasi . '"> <i class="fas fa-edit"></i> </button> 
                    <button id="' . $srt->auth_sertifikasi . '" class="btn btn-danger btn-sm font-weight-bold hpssertifikasi" title="Hapus" value="' . $srt->sertifikasi . '"> <i class="fas fa-trash-alt"></i> </button>';
               $data[] = $row;
          }

          $output = array(
               "draw" => $_POST['draw'],
               "recordsTotal" => $this->srt->count_all(),
               "recordsFiltered" => $this->srt->count_filtered(),
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
               $ket_sertifikasi = htmlspecialchars($this->input->post("ket", true));

               $ceksertifikasi = $this->srt->cek_sertifikasi($sertifikasi);
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
                    'id_user' => $this->session->userdata('id_user_hcdata')
               ];

               $sertifikasi = $this->srt->input_sertifikasi($data);
               if ($sertifikasi) {
                    echo json_encode(array("statusCode" => 200, "pesan" => "sertifikasi berhasil disimpan"));
               } else {
                    echo json_encode(array("statusCode" => 201, "pesan" => "sertifikasi gagal disimpan"));
               }
          }
     }

     public function hapus_sertifikasi()
     {
          $auth = htmlspecialchars($this->input->post("token", true));
          $this->cek_auth($auth);

          $auth_sertifikasi = htmlspecialchars(trim($this->input->post('auth_Sertifikat', true)));
          $query = $this->srt->hps_sert($auth_sertifikasi);

          if ($query == 200) {
               echo json_encode(array("statusCode" => 200, "pesan" => "Sertifikasi berhasil dihapus"));
               return;
          } else if ($query == 201) {
               echo json_encode(array("statusCode" => 201, "pesan" => "Sertifikasi gagal dihapus"));
               return;
          } else {
               echo json_encode(array("statusCode" => 202, "pesan" => "Sertifikasi tidak ditemukan"));
               return;
          }
     }

     public function detail_sertifikasi()
     {
          $auth = htmlspecialchars($this->input->post("token", true));
          $this->cek_auth($auth);

          $auth_sertifikasi = htmlspecialchars(trim($this->input->post("auth_sertifikasi", true)));
          $query = $this->srt->get_sertifikasi_id($auth_sertifikasi);
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
                         'tgl_buat' => date('d-M-Y H:i:s', srttotime($list->tgl_buat)),
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

     public function get_sertifikasi()
     {
          $auth_sertifikat = htmlspecialchars(trim($this->input->post("auth_sertifikat", true)));
          $query = $this->srt->get_sertifikasi_id($auth_sertifikat);
          if (!empty($query)) {
               foreach ($query as $list) {
                    $auth_sertifkat = $list->auth_sertifikat;
                    $jenis_sertifikasi = $list->jenis_sertifikasi;
                    $id_jenis_sertifikasi = $list->id_jenis_sertifikasi;
                    $no_sertifikasi = $list->no_sertifikasi;
                    $lembaga = $list->lembaga;
                    $tgl_sertifikasi = $list->tgl_sertifikasi;
                    $tgl_berakhir_sertifikasi = $list->tgl_berakhir_sertifikasi;
               };

               echo json_encode(array(
                    'statusCode' => 200,
                    "auth_sertifikat" => $auth_sertifkat,
                    "id_jenis_sertifikasi" => $id_jenis_sertifikasi,
                    "jenis_sertifikasi" => $jenis_sertifikasi,
                    "no_sertifikasi" => $no_sertifikasi,
                    "lembaga" => $lembaga,
                    "tgl_sertifikasi" => $tgl_sertifikasi,
                    "tgl_sertifikasi_show" => date('d-M-Y', strtotime($tgl_sertifikasi)),
                    "tgl_berakhir_sertifikasi" => $tgl_berakhir_sertifikasi,
                    "tgl_berakhir_sertifikasi_show" => date('d-M-Y', strtotime($tgl_berakhir_sertifikasi))
               ));
          } else {
               echo json_encode(array('statusCode' => 201, "pesan" => "Sertifikasi tidak ditemukan"));
          }
     }

     public function upload_ulang_ser()
     {
          $auth_ser =  htmlspecialchars($this->input->post("auth_ser", true));
          $auth_person =  htmlspecialchars($this->input->post("auth_person", true));

          if ($auth_person == "") {
               echo json_encode(array("statusCode" => 201, "pesan" => "Data personal tidak ditemukan"));
               die;
          }

          $id_personal = $this->kry->get_id_personal($auth_person);
          $foldername = md5($id_personal);

          $data_ser = $this->srt->get_sertifikasi_id($auth_ser);

          if (!empty($data_ser)) {
               foreach ($data_ser as $list) {
                    $id_ser  = $list->id_sertifikasi;
                    $nama_file  = $list->file_sertifikasi;
               }

               if ($nama_file == "") {
                    $now = date('YmdHis');
                    $nama_file = $now . "-SRT.pdf";
               }
          } else {
               echo json_encode(array("statusCode" => 201, "pesan" => "Data Sertifikasi tidak ditemukan"));
               die;
          }

          // echo json_encode([$data_ser, "siap"]);
          // return;

          if (is_dir('./berkas/karyawan/' . $foldername) == false) {
               mkdir('./berkas/karyawan/' . $foldername, 0775, TRUE);
          } else {
               $config['upload_path'] = './berkas/karyawan/' . $foldername;
               $config['allowed_types'] = 'pdf';
               $config['max_size'] = 1000;
               $config['file_name'] = $nama_file;
               $config['overwrite'] = TRUE;


               $this->load->library('upload', $config);

               if (!$this->upload->do_upload('filesertifikat')) {
                    $err = $this->upload->display_errors();

                    if ($err == "<p>The file you are attempting to upload is larger than the permitted size.</p>") {
                         $error = "<p>Ukuran file maksimal 100 kb.</p>";
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
                    echo json_encode(array("statusCode" => 200, "pesan" => "File sertifikat berhasil di-upload"));
               }
          }
     }

     public function update_sertifikasi()
     {
          $auth = htmlspecialchars($this->input->post("token", true));
          $this->cek_auth($auth);

          $this->form_validation->set_rules("jenis_ser", "jenis_ser", "required|trim", [
               'required' => 'Jenis sertifikasi wajib diisi',
               'max_length' => 'Jenis sertifikasi maksimal 100 karakter'
          ]);
          $this->form_validation->set_rules("no_ser", "no_ser", "required|trim|max_length[100]", [
               'required' => 'No. Sertifikasi wajib diisi',
               'max_length' => 'No. Sertifikasi maksimal 50 karakter'
          ]);
          $this->form_validation->set_rules("lembaga", "lembaga", "required|trim|max_length[100]", [
               'required' => 'Lembaga wajib diisi',
               'max_length' => 'Lembaga maksimal 100 karakter'
          ]);
          $this->form_validation->set_rules("tgl_ser", "tgl_ser", "required|trim", [
               'required' => 'Tanggal sertifikasi wajib diisi'
          ]);
          $this->form_validation->set_rules("tgl_akhir", "tgl_akhir", "required|trim", [
               'required' => 'Tanggal akhir sertifikasi wajib diisi'
          ]);

          if ($this->form_validation->run() == false) {
               $error = [
                    "statusCode" => 202,
                    "jenis_ser" => form_error("jenis_ser"),
                    "no_ser" => form_error("no_ser"),
                    "lembaga" => form_error("lembaga"),
                    "tgl_ser" => form_error("tgl_ser"),
                    "tgl_akhir" => form_error("tgl_akhir")
               ];

               echo json_encode($error);
               die;
          } else {

               $auth_ser = htmlspecialchars($this->input->post("auth_ser", true));
               $jenis_ser = htmlspecialchars($this->input->post("jenis_ser", true));
               $no_ser = htmlspecialchars($this->input->post("no_ser", true));
               $lembaga = htmlspecialchars($this->input->post("lembaga", true));
               $tgl_ser = htmlspecialchars($this->input->post("tgl_ser", true));
               $tgl_akhir = htmlspecialchars($this->input->post("tgl_akhir", true));
               $id_ser = $this->srt->get_by_idser($auth_ser);
               $dtser = [
                    'id_jenis_sertifikasi' => $jenis_ser,
                    'no_sertifikasi' => $no_ser,
                    'lembaga' => $lembaga,
                    'tgl_sertifikasi' => $tgl_ser,
                    'tgl_berakhir_sertifikasi' => $tgl_akhir
               ];

               $sertifikasi = $this->srt->update_sertifikasi($id_ser,  $dtser);
               echo json_encode(array(
                    "statusCode" => 200,
                    "pesan" => "Sertifikat berhasil diupdate"
               ));
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

          $auth = htmlspecialchars($this->input->post("token", true));
          $this->cek_auth($auth);

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

          $query = $this->srt->get_by_authper($auth_per);
          $output = "<option value=''>-- Pilih sertifikasi --</option>";
          if (!empty($query)) {
               foreach ($query as $list) {
                    $output = $output . "<option value='" . $list->auth_sertifikasi . "'>" . $list->sertifikasi . "</option>";
               }
               echo json_encode(array("statusCode" => 200, "srt" => $output));
          } else {
               $output = "<option value=''>-- sertifikasi tidak Ditemukan --</option>";
               echo json_encode(array("statusCode" => 201, "srt" => $output));
          }
     }

     public function get_by_idper()
     {
          if ($this->session->userdata('id_perusahaan_sertifikasi') != "") {
               $id_per = $this->session->userdata('id_perusahaan_sertifikasi');
               $output = "<option value=''>-- Pilih sertifikasi --</option>";
               $query = $this->srt->get_by_idper($id_per);
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
