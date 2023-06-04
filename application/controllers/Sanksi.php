<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Sanksi extends My_Controller
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
          $this->load->view('dashboard/sanksi/sanksi');
          $this->load->view('dashboard/modal/mdlform');
          $this->load->view('dashboard/template/footer', $data);
          $this->load->view('dashboard/code/sanksi');
     }

     public function new()
     {
          $data['nama'] = $this->session->userdata("nama");
          $data['email'] = $this->session->userdata("email");
          $data['menu'] = $this->session->userdata("id_menu");
          $this->load->view('dashboard/template/header', $data);
          $this->load->view('dashboard/sanksi/sanksi_add');
          $this->load->view('dashboard/modal/mdlform');
          $this->load->view('dashboard/template/footer', $data);
          $this->load->view('dashboard/code/sanksi');
     }

     public function ajax_list()
     {
          $list = $this->snk->get_datatables();
          $data = array();
          $no = $_POST['start'];
          foreach ($list as $snk) {
               $no++;
               $row = array();
               $row['no'] = $no;
               $row['auth_sanksi'] = $snk->auth_sanksi;
               $row['kd_sanksi'] = $snk->kd_sanksi;
               $row['sanksi'] = $snk->sanksi;
               $row['jml_hari_berlaku'] = intval($snk->jml_hari_berlaku) . ' hari';
               $row['ket_sanksi'] = $snk->ket_sanksi;

               if ($snk->stat_sanksi == "T") {
                    $row['stat_sanksi'] = "<span class='btn btn-success btn-sm '> AKTIF </span>";
               } else {
                    $row['stat_sanksi'] = "<div class='btn btn-danger btn-sm'> NONAKTIF </div>";
               }

               $row['tgl_buat'] = date('d-M-Y', strtotime($snk->tgl_buat));
               $row['tgl_edit'] = date('d-M-Y', strtotime($snk->tgl_edit));
               $row['proses'] = '<button id="' . $snk->auth_sanksi . '" class="btn btn-primary btn-sm font-weight-bold dtlsanksi" title="Detail" value="' . $snk->sanksi . '"> <i class="fas fa-asterisk"></i> </button> 
                    <button id="' . $snk->auth_sanksi . '" class="btn btn-warning btn-sm font-weight-bold edttsanksi" title="Edit" value="' . $snk->sanksi . '"> <i class="fas fa-edit"></i> </button> 
                    <button id="' . $snk->auth_sanksi . '" class="btn btn-danger btn-sm font-weight-bold hpssanksi" title="Hapus" value="' . $snk->sanksi . '"> <i class="fas fa-trash-alt"></i> </button>';
               $data[] = $row;
          }

          $output = array(
               "draw" => $_POST['draw'],
               "recordsTotal" => $this->snk->count_all(),
               "recordsFiltered" => $this->snk->count_filtered(),
               "data" => $data,
          );
          //output to json format
          echo json_encode($output);
     }

     public function input_sanksi()
     {
          $this->form_validation->set_rules("kode", "kode", "required|trim|max_length[8]", [
               'required' => 'Kode wajib diisi',
               'max_length' => 'Kode maksimal 8 karakter'
          ]);
          $this->form_validation->set_rules("sanksi", "sanksi", "required|trim|max_length[100]", [
               'required' => 'Sanksi wajib diisi',
               'max_length' => 'sanksi maksimal 100 karakter'
          ]);
          $this->form_validation->set_rules("jml_hari", "jml_hari", "required|trim|max_length[4]", [
               'required' => 'Masa berlaku wajib diisi, isi dengan 0 jika tidak memiliki masa berlaku',
               'max_length' => 'Masa berlaku maksimal 4 karakter'
          ]);
          $this->form_validation->set_rules("ket", "ket", "trim|max_length[1000],[
               'max_length' => 'Keterangan maksimal 1000 karakter'
          ]");

          if ($this->form_validation->run() == false) {
               $error = [
                    'statusCode' => 202,
                    'kode' => form_error("kode"),
                    'sanksi' => form_error("sanksi"),
                    'jml_hari' => form_error("jml_hari"),
                    'ket' => form_error("ket")
               ];

               echo json_encode($error);
               return;
          } else {
               $kd_sanksi = htmlspecialchars($this->input->post("kode", true));
               $sanksi = htmlspecialchars($this->input->post("sanksi", true));
               $jml_hari = htmlspecialchars($this->input->post("jml_hari", true));
               $ket_sanksi = htmlspecialchars($this->input->post("ket"));

               $cekkode = $this->snk->cek_kode($kd_sanksi);
               if ($cekkode) {
                    echo json_encode(array("statusCode" => 201, "pesan" => "Kode sudah digunakan"));
                    return;
               }

               $ceksanksi = $this->snk->cek_sanksi($sanksi);
               if ($ceksanksi) {
                    echo json_encode(array("statusCode" => 201, "pesan" => "Sanksi sudah digunakan"));
                    return;
               }

               $data = [
                    'kd_sanksi' => $kd_sanksi,
                    'sanksi' => $sanksi,
                    'jml_hari_berlaku' => intval($jml_hari),
                    'ket_sanksi' => $ket_sanksi,
                    'stat_sanksi' => 'T',
                    'tgl_buat' => date('Y-m-d H:i:s'),
                    'tgl_edit' => date('Y-m-d H:i:s'),
                    'id_user' => $this->session->userdata('id_user')
               ];

               $sanksi = $this->snk->input_sanksi($data);
               if ($sanksi) {
                    echo json_encode(array("statusCode" => 200, "pesan" => "Sanksi berhasil disimpan"));
               } else {
                    echo json_encode(array("statusCode" => 201, "pesan" => "Sanksi gagal disimpan"));
               }
          }
     }

     public function hapus_sanksi()
     {
          $auth_sanksi = htmlspecialchars(trim($this->input->post('auth_sanksi')));
          $query = $this->snk->hapus_sanksi($auth_sanksi);
          if ($query == 200) {
               echo json_encode(array("statusCode" => 200, "pesan" => "Sanksi berhasil dihapus"));
               return;
          } else if ($query == 201) {
               echo json_encode(array("statusCode" => 201, "pesan" => "Sanksi gagal dihapus"));
               return;
          } else {
               echo json_encode(array("statusCode" => 202, "pesan" => "Sanksi tidak ditemukan"));
               return;
          }
     }

     public function detail_sanksi()
     {
          $auth_sanksi = htmlspecialchars(trim($this->input->post("auth_sanksi")));
          $query = $this->snk->get_sanksi_id($auth_sanksi);
          if (!empty($query)) {
               foreach ($query as $list) {
                    if ($list->stat_sanksi == "T") {
                         $status = "AKTIF";
                    } else {
                         $status = "NONAKTIF";
                    }

                    $data = [
                         'statusCode' => 200,
                         'kode' => $list->kd_sanksi,
                         'sanksi' => $list->sanksi,
                         'jml_hari_berlaku' => $list->jml_hari_berlaku,
                         'ket' => $list->ket_sanksi,
                         'status' => $status,
                         'tgl_buat' => date('d-M-Y H:i:s', strtotime($list->tgl_buat)),
                         'pembuat' => $list->nama_user
                    ];

                    $this->session->set_userdata('id_sanksi', $list->id_sanksi);
               }
               echo json_encode($data);
          } else {
               echo json_encode(array('statusCode' => 201, "pesan" => "Sanksi tidak ditemukan"));
          }
     }

     public function edit_sanksi()
     {
          $this->form_validation->set_rules("kode", "kode", "required|trim|max_length[8]", [
               'required' => 'Kode wajib diisi',
               'max_length' => 'Kode maksimal 8 karakter'
          ]);
          $this->form_validation->set_rules("sanksi", "sanksi", "required|trim|max_length[100]", [
               'required' => 'Sanksi wajib diisi',
               'max_length' => 'Sanksi maksimal 100 karakter'
          ]);
          $this->form_validation->set_rules("jml_hari", "jml_hari", "required|trim|max_length[4]", [
               'required' => 'Masa berlaku wajib diisi, isi dengan 0 jika tidak memiliki masa berlaku',
               'max_length' => 'Masa berlaku maksimal 4 karakter'
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
                    'sanksi' => form_error("sanksi"),
                    'jml_hari' => form_error("jml_hari"),
                    'status' => form_error("status"),
                    'ket' => form_error("ket")
               ];

               echo json_encode($error);
               die;
          } else {

               if ($this->session->userdata('id_sanksi') == "") {
                    echo json_encode(array("statusCode" => 201, "pesan" => "Sanksi tidak ditemukan"));
                    return;
               }

               $kd_sanksi = htmlspecialchars($this->input->post("kode", true));
               $sanksi = htmlspecialchars($this->input->post("sanksi", true));
               $jml_hari = intval(htmlspecialchars($this->input->post("jml_hari", true)));
               $ket_sanksi = htmlspecialchars($this->input->post("ket", true));
               if (htmlspecialchars($this->input->post("status", true)) == "AKTIF") {
                    $status = "T";
               } else {
                    $status = "F";
               }

               $sanksi = $this->snk->edit_sanksi($kd_sanksi, $sanksi, $jml_hari, $ket_sanksi, $status);
               if ($sanksi == 200) {
                    echo json_encode(array("statusCode" => 200, "pesan" => "Sanksi berhasil diupdate"));
               } else if ($sanksi == 201) {
                    echo json_encode(array("statusCode" => 201, "pesan" => "Sanksi gagal diupdate"));
               } else if ($sanksi == 203) {
                    echo json_encode(array("statusCode" => 203, "pesan" => "Kode sudah digunakan"));
               } else if ($sanksi == 204) {
                    echo json_encode(array("statusCode" => 205, "pesan" => "sanksi sudah digunakan"));
               }
          }
     }

     public function get_all()
     {
          $query = $this->snk->get_all();
          $output = "<option value=''>-- Pilih sanksi --</option>";
          if (!empty($query)) {
               foreach ($query as $list) {
                    $output = $output . "<option value='" . $list->auth_sanksi . "'>" . $list->sanksi . "</option>";
               }
               echo json_encode(array("statusCode" => 200, "snk" => $output));
          } else {
               $output = "<option value=''>-- Sanksi tidak Ditemukan --</option>";
               echo json_encode(array("statusCode" => 201, "snk" => $output));
          }
     }
}
