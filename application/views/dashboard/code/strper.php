<?php

session_start();
if (isset($_SESSION['id_m_perusahaan'])) {
     $id_perusahaan = $_SESSION['id_m_perusahaan'];
     echo "<Option value=''><b>-- PILIH PERUSAHAAN --</b></Option>";

     function getPerusahaan($idparent)
     {
          $servername = "localhost";
          $username = "root";
          $password = "";
          $dbname = "db_kary";
          $conn = mysqli_connect($servername, $username, $password, $dbname);

          if (!$conn) {
               header("'Location: " . base_url() . "'");
          }

          static $space;

          $sql = "SELECT * from vw_m_perusahaan where id_parent=" . $idparent . " and id_perusahaan=" . $idper;
          $result = mysqli_query($conn, $sql);

          $id = 0;
          if (mysqli_num_rows($result) > 0) {
               $space .= "&roarr;";
               while ($row = mysqli_fetch_assoc($result)) {

                    $id_m_perusahaan = $row["id_m_perusahaan"];
                    $nama_perusahaan = $row["nama_perusahaan"];
                    echo "<Option value='" . $id_m_perusahaan . "'><b>" . $space . " " . $nama_perusahaan . "</b></Option>";
                    getPerusahaan($id_m_perusahaan);
               }

               $space = substr($space, 0, strlen($space) - 7);
          }

          mysqli_close($conn);
     }

     getPerusahaan($id_perusahaan);
} else {
     $id_perusahaan = 0;
     echo "<Option value=''><b>-- PERUSAHAAN TIDAK DITEMUKAN --</b></Option>";
}
