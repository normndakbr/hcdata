<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Login_model extends CI_Model
{

     public function __construct()
     {
          parent::__construct();
          $this->load->database();
          $this->load->library('form_validation');
     }

     public function get_login($email, $sandi)
     {
          $this->db->select("*");
          $this->db->from("vw_user");
          $this->db->where("email_user", $email);
          $query = $this->db->get();
          $user = $query->row();

          if (isset($user)) {
               if ($user->stat_user == "N") {
                    return json_encode(array("statusCode" => 201, "pesan" => "Email tidak aktif"));
               } else {
                    $tglnow = date("Y-m-d");
                    if ($tglnow > $user->tgl_exp) {
                         return json_encode(array("statusCode" => 201, "pesan" => "Email telah expired"));
                    } else {
                         if ($sandi == $user->sesi) {
                              return json_encode(array(
                                   "statusCode" => 200,
                                   "id_user" => $user->id_user,
                                   "email_user" => $user->email_user,
                                   "nama_user" => $user->nama_user,
                                   "auth_user" => md5($user->id_user . date('Y-m-d')),
                                   "id_menu" => $user->id_menu,
                                   "id_m_perusahaan" => $user->id_m_perusahaan,
                                   "id_perusahaan" => $user->id_perusahaan
                              ));
                         } else {
                              return json_encode(array("statusCode" => 201, "pesan" => "Sandi anda salah"));
                         }
                    }
               }
          } else {
               return json_encode(array("statusCode" => 201, "pesan" => "Email tidak terdaftar"));
          }
     }

     public function reset_sandi($temail_reset)
     {
          $this->db->select("*");
          $this->db->from("vw_user");
          $this->db->where("email_user", $temail_reset);
          $query = $this->db->get();
          $user = $query->row();

          if (isset($user)) {
               if ($user->stat_user == "N") {
                    return json_encode(array("statusCode" => 201, "pesan" => "Email tidak aktif"));
               } else {
                    $tglnow = date("Y-m-d");
                    if ($tglnow > $user->tgl_exp) {
                         return json_encode(array("statusCode" => 201, "pesan" => "Email telah expired"));
                    } else {
                         return json_encode(array("statusCode" => 200, "pesan" => "Sukses"));
                    }
               }
          } else {
               return json_encode(array("statusCode" => 201, "pesan" => "Email tidak terdaftar"));
          }
     }

     public function ganti_sandi($sandilama, $sandibaru)
     {
          $email = $this->session->userdata('email');
          $query = $this->db->get_where('vw_user', ['email_user' => $email]);
          if (!empty($query->result())) {
               foreach ($query->result() as $list) {
                    $id_user = $list->id_user;
                    if (md5($sandilama) == $list->sesi) {
                         $this->db->set('sesi', md5($sandibaru));
                         $this->db->set('tgl_edit', date('Y-m-d H:i:s'));
                         $this->db->where('id_user',  $id_user);
                         $this->db->update('tb_user');
                         if ($this->db->affected_rows() > 0) {
                              return 200;
                         } else {
                              return 202;
                         }
                    } else {
                         return 201;
                    }
               }
          } else {
               return 203;
          }
     }
}
