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
          $query = $this->drh->get_prov();
          $output = "<option value=''> -- PILIH PROVINSI -- </option>";
          $output = $output .  " <option value='00'> -- WAJIB DIPILIH -- </option> ";
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
               $output = "<option value=''> -- PROVINSI TIDAK DITEMUKAN -- </option>";
               $output = $output .  " <option value='00'> -- WAJIB DIPILIH -- </option> ";
               $data = [
                    "statusCode" => 201,
                    "prov" => $output
               ];

               echo json_encode($data);
          }
     }

     public function get_kab()
     {
          $id_prov = htmlspecialchars(trim($this->input->post('id_prov')));
          $query = $this->drh->get_kab($id_prov);
          $output = "<option value=''> -- PILIH KABUPATEN/KOTA -- </option>";
          $output = $output .  " <option value='0000'> -- WAJIB DIPILIH -- </option> ";
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
               $output = "<option value=''> -- KABUPATEN/KOTA TIDAK DITEMUKAN -- </option>";
               $output = $output .  " <option value='0000'> -- WAJIB DIPILIH -- </option> ";
               $data = [
                    "statusCode" => 201,
                    "kab" => $output
               ];
               echo json_encode($data);
          }
     }

     public function get_kec()
     {
          $id_kab = htmlspecialchars(trim($this->input->post('id_kab')));
          $query = $this->drh->get_kec($id_kab);
          $output = "<option value=''> -- PILIH KECAMATAN -- </option>";
          $output = $output .  " <option value='000000'> -- WAJIB DIPILIH -- </option> ";
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
               $output = "<option value=''>-- KECAMATAN TIDAK DITEMUKAN --</option>";
               $output = $output .  " <option value='00000000'> -- WAJIB DIPILIH -- </option> ";
               $data = [
                    "statusCode" => 201,
                    "kec" => $output
               ];
               echo json_encode($data);
          }
     }

     public function get_kel()
     {
          $id_kec = htmlspecialchars(trim($this->input->post('id_kec')));
          $query = $this->drh->get_kel($id_kec);
          $output = "<option value=''> -- PILIH KELURAHAN -- </option>";
          $output = $output .  " <option value='00000000'> -- WAJIB DIPILIH -- </option> ";
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
               $output = "<option value=''>-- KELURAHAN TIDAK DITEMUKAN --</option>";
               $output = $output .  " <option value='00000000'> -- WAJIB DIPILIH -- </option> ";
               $data = [
                    "statusCode" => 201,
                    "kel" => $output
               ];
               echo json_encode($data);
          }
     }
}
