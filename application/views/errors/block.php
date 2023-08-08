<!DOCTYPE html>
<html lang="en">

<head>
     <meta charset="utf-8">
     <meta http-equiv="X-UA-Compatible" content="IE=edge">
     <meta name="viewport" content="width=device-width, initial-scale=1">

     <title>ARC - Block</title>

     <!-- Google font -->
     <link href="https://fonts.googleapis.com/css?family=Montserrat:500" rel="stylesheet">
     <link href="https://fonts.googleapis.com/css?family=Titillium+Web:700,900" rel="stylesheet">

     <!-- Custom stlylesheet -->
     <link type="text/css" rel="stylesheet" href="<?= base_url(); ?>assets/css/style11.css" />

</head>

<body>

     <div id="notfound">
          <div class="notfound">
               <div class="notfound-404">
                    <h1>401</h1>
               </div>
               <h2>uups! Akses tidak diperbolehkan</h2>
               <p>Mohon Maaf, ip address anda telah diblokir semetara waktu, silahkan coba login kembali pada pukul : </p>
               <p style="font-size:50px;margin-top:-10px"><strong><?= date('H:i:s', strtotime($waktu)); ?></strong></p>
          </div>
     </div>

</body>

</html>