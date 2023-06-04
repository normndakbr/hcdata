<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Bank extends My_Controller
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
          $this->load->view('dashboard/bank/bank');
          $this->load->view('dashboard/modal/mdlform');
          $this->load->view('dashboard/template/footer', $data);
          $this->load->view('dashboard/code/bank');
     }

     public function new()
     {
          $data['nama'] = $this->session->userdata("nama");
          $data['email'] = $this->session->userdata("email");
          $data['menu'] = $this->session->userdata("id_menu");
          $this->load->view('dashboard/template/header', $data);
          $this->load->view('dashboard/bank/bank_add');
          $this->load->view('dashboard/modal/mdlform');
          $this->load->view('dashboard/template/footer', $data);
          $this->load->view('dashboard/code/bank');
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
               $row['auth_bank'] = $bnk->auth_bank;
               $row['bank'] = $bnk->bank;
               $row['ket_bank'] = $bnk->ket_bank;

               if ($bnk->stat_bank == "T") {
                    $row['stat_bank'] = "<span class='btn btn-success btn-sm '> AKTIF </span>";
               } else {
                    $row['stat_bank'] = "<div class='btn btn-danger btn-sm'> NONAKTIF </div>";
               }

               $row['tgl_buat'] = date('d-M-Y', strtotime($bnk->tgl_buat));
               $row['tgl_edit'] = date('d-M-Y', strtotime($bnk->tgl_edit));
               $row['proses'] = '<button id="' . $bnk->auth_bank . '" class="btn btn-primary btn-sm font-weight-bold dtlbank" title="Detail" value="' . $bnk->bank . '"> <i class="fas fa-asterisk"></i> </button> 
                    <button id="' . $bnk->auth_bank . '" class="btn btn-warning btn-sm font-weight-bold edttbank" title="Edit" value="' . $bnk->bank . '"> <i class="fas fa-edit"></i> </button> 
                    <button id="' . $bnk->auth_bank . '" class="btn btn-danger btn-sm font-weight-bold hpsbank" title="Hapus" value="' . $bnk->bank . '"> <i class="fas fa-trash-alt"></i> </button>';
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

     public function input_bank()
     {
          $this->form_validation->set_rules("bank", "bank", "required|trim|max_length[100]", [
               'required' => 'bank wajib diisi',
               'max_length' => 'bank maksimal 100 karakter'
          ]);
          $this->form_validation->set_rules("ket", "ket", "trim|max_length[1000],[
               'max_length' => 'Keterangan maksimal 1000 karakter'
          ]");

          if ($this->form_validation->run() == false) {
               $error = [
                    'statusCode' => 202,
                    'bank' => form_error("bank"),
                    'ket' => form_error("ket")
               ];

               echo json_encode($error);
               return;
          } else {
               $bank = htmlspecialchars($this->input->post("bank", true));
               $ket_bank = htmlspecialchars($this->input->post("ket"));

               $cekbank = $this->bnk->cek_bank($bank);
               if ($cekbank) {
                    echo json_encode(array("statusCode" => 201, "pesan" => "Bank sudah digunakan"));
                    return;
               }

               $data = [
                    'bank' => $bank,
                    'ket_bank' => $ket_bank,
                    'stat_bank' => 'T',
                    'tgl_buat' => date('Y-m-d H:i:s'),
                    'tgl_edit' => date('Y-m-d H:i:s'),
                    'id_user' => $this->session->userdata('id_user')
               ];

               $bank = $this->bnk->input_bank($data);
               if ($bank) {
                    echo json_encode(array("statusCode" => 200, "pesan" => "Bank berhasil disimpan"));
               } else {
                    echo json_encode(array("statusCode" => 201, "pesan" => "Bank gagal disimpan"));
               }
          }
     }

     public function hapus_bank()
     {
          $auth_bank = htmlspecialchars(trim($this->input->post('auth_bank')));
          $query = $this->bnk->hapus_bank($auth_bank);
          if ($query == 200) {
               echo json_encode(array("statusCode" => 200, "pesan" => "Bank berhasil dihapus"));
               return;
          } else if ($query == 201) {
               echo json_encode(array("statusCode" => 201, "pesan" => "Bank gagal dihapus"));
               return;
          } else {
               echo json_encode(array("statusCode" => 202, "pesan" => "Bank tidak ditemukan"));
               return;
          }
     }

     public function detail_bank()
     {
          $auth_bank = htmlspecialchars(trim($this->input->post("auth_bank")));
          $query = $this->bnk->get_bank_id($auth_bank);
          if (!empty($query)) {
               foreach ($query as $list) {
                    if ($list->stat_bank == "T") {
                         $status = "AKTIF";
                    } else {
                         $status = "NONAKTIF";
                    }

                    $data = [
                         'statusCode' => 200,
                         'bank' => $list->bank,
                         'ket' => $list->ket_bank,
                         'status' => $status,
                         'tgl_buat' => date('d-M-Y H:i:s', strtotime($list->tgl_buat)),
                         'pembuat' => $list->nama_user
                    ];

                    $this->session->set_userdata('id_bank', $list->id_bank);
               }
               echo json_encode($data);
          } else {
               echo json_encode(array('statusCode' => 201, "pesan" => "Bank tidak ditemukan"));
          }
     }

     public function edit_bank()
     {
          $this->form_validation->set_rules("bank", "bank", "required|trim|max_length[100]", [
               'required' => 'Bank wajib diisi',
               'max_length' => 'Bank maksimal 100 karakter'
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
                    'bank' => form_error("bank"),
                    'status' => form_error("status"),
                    'ket' => form_error('ket')
               ];

               echo json_encode($error);
               die;
          } else {
               if ($this->session->userdata('id_bank') == "") {
                    echo json_encode(array("statusCode" => 201, "pesan" => "Bank tidak ditemukan"));
                    return;
               }

               $bank = htmlspecialchars($this->input->post("bank", true));
               $ket_bank = htmlspecialchars($this->input->post("ket", true));
               if (htmlspecialchars($this->input->post("status", true)) == "AKTIF") {
                    $status = "T";
               } else {
                    $status = "F";
               }

               $bank = $this->bnk->edit_bank($bank, $ket_bank, $status);
               if ($bank == 200) {
                    echo json_encode(array("statusCode" => 200, "pesan" => "Bank berhasil diupdate"));
               } else if ($bank == 201) {
                    echo json_encode(array("statusCode" => 201, "pesan" => "Bank gagal diupdate"));
               } else if ($bank == 204) {
                    echo json_encode(array("statusCode" => 205, "pesan" => "Bank sudah digunakan"));
               }
          }
     }

     public function get_all()
     {
          $query = $this->bnk->get_all();
          $output = "<option value=''>-- Pilih bank --</option>";
          if (!empty($query)) {
               foreach ($query as $list) {
                    $output = $output . "<option value='" . $list->auth_bank . "'>" . $list->bank . "</option>";
               }
               echo json_encode(array("statusCode" => 200, "bnk" => $output));
          } else {
               $output = "<option value=''>-- Bank tidak Ditemukan --</option>";
               echo json_encode(array("statusCode" => 201, "bnk" => $output));
          }
     }

     public function get_by_authper()
     {
          $auth_per = $this->input->post('auth_per');

          $query = $this->bnk->get_by_authper($auth_per);
          $output = "<option value=''>-- Pilih bank --</option>";
          if (!empty($query)) {
               foreach ($query as $list) {
                    $output = $output . "<option value='" . $list->auth_bank . "'>" . $list->bank . "</option>";
               }
               echo json_encode(array("statusCode" => 200, "bnk" => $output));
          } else {
               $output = "<option value=''>-- Bank tidak Ditemukan --</option>";
               echo json_encode(array("statusCode" => 201, "bnk" => $output));
          }
     }

     public function get_by_idper()
     {
          if ($this->session->userdata('id_perusahaan_bank') != "") {
               $id_per = $this->session->userdata('id_perusahaan_bank');
               $output = "<option value=''>-- Pilih bank --</option>";
               $query = $this->bnk->get_by_idper($id_per);
               foreach ($query as $list) {
                    $output = $output . " <option value='" . $list->auth_bank . "'>" . $list->bank . "</option>";
               }

               echo json_encode(array("statusCode" => 200, "bank" => $output, "pesan" => "Sukses"));
          } else {
               $output = "<option value=''>-- bankemen tidak ditemukan --</option>";
               echo json_encode(array("statusCode" => 200, "bank" => $output, "pesan", "Bank gagal ditampilkan"));
          }
     }
}
