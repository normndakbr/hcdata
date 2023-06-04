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

          $newdata = array(
               'idkaryawan',
               'idpersonal',
               'idalamat',
               'idizin',
               'unit_izin',
               'unit_izin_text',
               'idmcu'
          );

          $this->session->unset_userdata($newdata);
          $jml_karyawan = $this->dsmod->count_all_karyawan();
          $jml_user = $this->dsmod->count_all_user();
          $data['nama'] = $this->session->userdata("nama");
          $data['email'] = $this->session->userdata("email");
          $data['menu'] = $this->session->userdata("id_menu");
          $data['jml_karyawan'] = $jml_karyawan;
          $data['jml_user'] = $jml_user;
          $this->load->view('dashboard/template/header', $data);
          $this->load->view('dashboard/karyawan/karyawan_add', $data);
          $this->load->view('dashboard/modal/mdlform');
          $this->load->view('dashboard/template/footer', $data);
          $this->load->view('dashboard/code/karyawan');
     }

     public function form_modal()
     {
          $this->load->view("dashboard/mdlform");
     }

     public function logout()
     {
          $this->session->unset_userdata('id_user');
          $this->session->unset_userdata('nama');
          $this->session->unset_userdata('email');
          $this->session->unset_userdata('auth_user');
          $this->session->unset_userdata('id_menu');
          redirect("login");
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
