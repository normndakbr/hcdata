<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Daerah extends My_Controller
{
     public function __construct()
     {
          parent::__construct();
          $this->is_logout();
     }

     public function index()
     {
     }

     public function get_prov()
     {
          $auth = htmlspecialchars($this->input->get("authtoken", true));
          $cekauth = $this->cek_auth($auth);

          if ($cekauth == 501) {
               echo json_encode(array('statusCode' => 201, "kode_pesan" => "Gagal", "pesan" => "Autentikasi tidak valid, refresh data", "tipe_pesan" => "error"));
          } else {

               $query = $this->drh->get_prov();
               $output = "<option value=''> -- PILIH PROVINSI -- </option>";
               if (!empty($query)) {
                    foreach ($query as $list) {
                         $output = $output . "<option value='" . $list->id . "'>" . $list->name . "</option>";
                    }

                    $data = [
                         "statusCode" => 200,
                         "prov" => $output
                    ];

                    echo json_encode($data);
               } else {
                    $output = "<option value=''> -- PROVINSI TIDAK ADA -- </option>";

                    $data = [
                         "statusCode" => 201,
                         "prov" => $output
                    ];

                    echo json_encode($data);
               }
          }
     }

     public function get_kab()
     {
          $auth = htmlspecialchars($this->input->get("authtoken", true));
          $cekauth = $this->cek_auth($auth);

          if ($cekauth == 501) {
               echo json_encode(array('statusCode' => 201, "kode_pesan" => "Gagal", "pesan" => "Autentikasi tidak valid, refresh data", "tipe_pesan" => "error"));
          } else {

               $id_prov = htmlspecialchars(trim($this->input->post('id_prov', true)));
               $query = $this->drh->get_kab($id_prov);
               $output = "<option value=''> -- PILIH KABUPATEN/KOTA -- </option>";
               if (!empty($query)) {
                    foreach ($query as $list) {
                         $output = $output . "<option value='" . $list->id . "'>" . $list->name . "</option>";
                    }
                    $data = [
                         "statusCode" => 200,
                         "kab" => $output
                    ];
                    echo json_encode($data);
               } else {
                    $output = "<option value=''> -- KABUPATEN/KOTA TIDAK ADA -- </option>";

                    $data = [
                         "statusCode" => 201,
                         "kab" => $output
                    ];
                    echo json_encode($data);
               }
          }
     }

     public function get_kec()
     {
          $auth = htmlspecialchars($this->input->get("authtoken", true));
          $cekauth = $this->cek_auth($auth);

          if ($cekauth == 501) {
               echo json_encode(array('statusCode' => 201, "kode_pesan" => "Gagal", "pesan" => "Autentikasi tidak valid, refresh data", "tipe_pesan" => "error"));
          } else {

               $id_kab = htmlspecialchars(trim($this->input->post('id_kab', true)));
               $query = $this->drh->get_kec($id_kab);
               $output = "<option value=''> -- PILIH KECAMATAN -- </option>";
               if (!empty($query)) {
                    foreach ($query as $list) {
                         $output = $output . "<option value='" . $list->id . "'>" . $list->name . "</option>";
                    }
                    $data = [
                         "statusCode" => 200,
                         "kec" => $output
                    ];
                    echo json_encode($data);
               } else {
                    $output = "<option value=''>-- KECAMATAN TIDAK ADA --</option>";
                    $data = [
                         "statusCode" => 201,
                         "kec" => $output
                    ];
                    echo json_encode($data);
               }
          }
     }

     public function get_kel()
     {
          $auth = htmlspecialchars($this->input->get("authtoken", true));
          $cekauth = $this->cek_auth($auth);

          if ($cekauth == 501) {
               echo json_encode(array('statusCode' => 201, "kode_pesan" => "Gagal", "pesan" => "Autentikasi tidak valid, refresh data", "tipe_pesan" => "error"));
          } else {

               $id_kec = htmlspecialchars(trim($this->input->post('id_kec', true)));
               $query = $this->drh->get_kel($id_kec);
               $output = "<option value=''> -- PILIH KELURAHAN -- </option>";
               if (!empty($query)) {
                    foreach ($query as $list) {
                         $output = $output . "<option value='" . $list->id . "'>" . $list->name . "</option>";
                    }
                    $data = [
                         "statusCode" => 200,
                         "kel" => $output
                    ];
                    echo json_encode($data);
               } else {
                    $output = "<option value=''>-- KELURAHAN TIDAK ADA --</option>";

                    $data = [
                         "statusCode" => 201,
                         "kel" => $output
                    ];
                    echo json_encode($data);
               }
          }
     }
}
