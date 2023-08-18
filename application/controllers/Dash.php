<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Dash extends My_Controller
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

          $data['nama'] = $this->session->userdata("nama_hcdata");
          $data['email'] = $this->session->userdata("email_hcdata");
          $data['menu'] = $this->session->userdata("id_menu_hcdata");
          $id_perusahaan = $this->session->userdata("id_perusahaan_hcdata");
          $data['nama_per'] = $this->prs->get_per_by_id($id_perusahaan);
          $data['get_menu'] = $this->dsmod->get_menu();
          $this->load->view('dashboard/template/header', $data);
          $this->load->view('dashboard/beranda', $data);
          $this->load->view('dashboard/template/footer', $data);
     }

     public function tambahkaryawan()
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

          $data['nama'] = $this->session->userdata("nama_hcdata");
          $data['email'] = $this->session->userdata("email_hcdata");
          $data['menu'] = $this->session->userdata("id_menu_hcdata");
          $id_perusahaan = $this->session->userdata("id_perusahaan_hcdata");
          $data['nama_per'] = $this->prs->get_per_by_id($id_perusahaan);
          $data['get_menu'] = $this->dsmod->get_menu();
          $this->load->view('dashboard/template/header', $data);
          $this->load->view('dashboard/karyawan/karyawan_add', $data);
          $this->load->view('dashboard/modal/mdlform');
          $this->load->view('dashboard/template/footer', $data);
          $this->load->view('dashboard/code/karyawan');
     }

     public function Oauth()
     {
          $auth = htmlspecialchars($this->input->post("token", true));
          $cekauth = $this->cek_auth($auth);

          if ($cekauth == 501) {
               echo json_encode(array('statusCode' => 201, "pesan" => "Autentikasi tidak valid, refresh data"));
          } else {
               echo json_encode(array('statusCode' => 200, "pesan" => "Autentikasi valid"));
          }
     }

     public function form_modal()
     {
          $this->load->view("dashboard/mdlform");
     }

     public function logout()
     {
          $this->session->sess_destroy();
          header("location: http://localhost:8080/hcdata");
     }

     public function data_grafik()
     {
          $query = $this->dsmod->data_grafik_1();
          if (!empty($query)) {
               foreach ($query as $jml) {
                    $nilai1 = $jml->bulan_now;
               }

               $data1 = [
                    "x" => "April 2023",
                    "y" => $nilai1
               ];
          }

          $query = $this->dsmod->data_grafik_2();
          if (!empty($query)) {
               foreach ($query as $jml) {
                    $nilai2 = $jml->bulan_now;
               }

               $data2 = [
                    "x" => "Maret 2023",
                    "y" => $nilai2
               ];
          }

          $query = $this->dsmod->data_grafik_3();
          if (!empty($query)) {
               foreach ($query as $jml) {
                    $nilai3 = $jml->bulan_now;
               }

               $data3 = [
                    "x" => "Februari 2023",
                    "y" => $nilai3
               ];
          }
          $data = [$data1, $data2, $data3];
          echo json_encode($data);
     }

     public function gt_data()
     {
          $query = $this->dsmod->get_data_grafik();

          echo $query;
     }
}
