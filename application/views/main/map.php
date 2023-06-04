<!DOCTYPE html>
<html>

<head>
     <meta charset="UTF-8">
     <title>Map <?= $nama_label; ?></title>
     <meta name="viewport" content="width=device-width, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0">
     <base target="_blank">
     <link rel="stylesheet" type="text/css" href="<?= base_url(); ?>assets/data/Qgis2threejs.css">
     <style type="text/css">
          #popup,
          #header,
          #layerpanel {
               left: 36px;
          }
     </style>
     <script src="<?= base_url(); ?>assets/data/threejs/three.min.js"></script>
     <script src="<?= base_url(); ?>assets/data/threejs/OrbitControls.js"></script>
     <script src="<?= base_url(); ?>assets/data/threejs/ViewHelper.js"></script>
     <script src="<?= base_url(); ?>assets/data/Qgis2threejs.js"></script>
     <script src="<?= base_url(); ?>assets/data/meshline/THREE.MeshLine.js"></script>
</head>

<body>
     <div id="view">
          <div id="northarrow"></div>
          <div id="navigation"></div>
     </div>

     <!-- popup -->
     <div id="popup">
          <div id="closebtn">&times;</div>
          <div id="popupbar"></div>
          <div id="popupbody">
               <div id="popupcontent"></div>

               <!-- query result -->
               <div id="queryresult">
                    <table id="qr_coords_table">
                         <caption>Clicked coordinates <div id="zoomtopoint" class="action-zoom zoombtn"></div>
                         </caption>
                         <tr>
                              <td id="qr_coords"></td>
                         </tr>
                    </table>

                    <table id="qr_layername_table">
                         <caption>Layer <div id="zoomtolayer" class="action-zoom zoombtn"></div>
                         </caption>
                         <tr>
                              <td id="qr_layername"></td>
                         </tr>
                    </table>

                    <table id="qr_attrs_table">
                         <caption>Attributes</caption>
                    </table>

                    <!-- camera actions and measure tool -->
                    <div id="orbitbtn" class="action-btn action-orbit">Orbit</div>
                    <div id="measurebtn" class="action-btn">Measure distance</div>
               </div>

               <!-- page info -->
               <div id="pageinfo">
                    <h1>Current View URL</h1>
                    <div><input id="urlbox" type="text"></div>

                    <h1>Usage</h1>
                    <table id="usage">
                         <tr>
                              <td colspan="2" class="star">Mouse</td>
                         </tr>
                         <tr>
                              <td>Left button + Move</td>
                              <td>Orbit</td>
                         </tr>
                         <tr>
                              <td>Mouse Wheel</td>
                              <td>Zoom</td>
                         </tr>
                         <tr>
                              <td>Right button + Move</td>
                              <td>Pan</td>
                         </tr>

                         <tr>
                              <td colspan="2" class="star">Keys</td>
                         </tr>
                         <tr>
                              <td>Arrow keys</td>
                              <td>Move Horizontally</td>
                         </tr>
                         <tr>
                              <td>Shift + Arrow keys</td>
                              <td>Orbit</td>
                         </tr>
                         <tr>
                              <td>Ctrl + Arrow keys</td>
                              <td>Rotate</td>
                         </tr>
                         <tr>
                              <td>Shift + Ctrl + Up / Down</td>
                              <td>Zoom In / Out</td>
                         </tr>
                         <tr>
                              <td>L</td>
                              <td>Toggle Label Visibility</td>
                         </tr>
                         <tr>
                              <td>R</td>
                              <td>Start / Stop Orbit Animation</td>
                         </tr>
                         <tr>
                              <td>W</td>
                              <td>Wireframe Mode</td>
                         </tr>
                         <tr>
                              <td>Shift + R</td>
                              <td>Reset Camera Position</td>
                         </tr>
                         <tr>
                              <td>Shift + S</td>
                              <td>Save Image</td>
                         </tr>
                    </table>

                    <h1>About</h1>
                    <div id="about"><img src="<?= base_url(); ?>assets/data/Qgis2threejs.png">
                         This page was made with <a href="https://www.qgis.org/">QGIS</a> and <a href="https://github.com/minorua/Qgis2threejs">Qgis2threejs</a> plugin (version 2.7.1).
                         <div>Powered by <a href="https://threejs.org/">three.js</a>
                              <span id="lib_proj4js"> and <a href="https://trac.osgeo.org/proj4js/">Proj4js</a></span>.
                         </div>
                    </div>
               </div>
          </div>
     </div>

     <!-- progress bar -->
     <div id="progress">
          <div id="progressbar"></div>
     </div>

     <!-- menu -->
     <div id="toolbtns">
          <div id="layerbtn"></div>
          <div id="animbtn" class="hidden"></div>
          <div id="infobtn"></div>
     </div>

     <!-- header and footer -->
     <div id="header"><?= $nama_label; ?></div>
     <div id="footer"></div>

     <!-- layer panel -->
     <div id="layerpanel">
          <div id="layerlist"></div>
     </div>

     <!-- animation -->
     <div id="narrativebox" class="ef1">
          <div id="narbody">

          </div>
          <div id="nextbtn"></div>
     </div>

     <script>
          Q3D.Config.allVisible = true;
          Q3D.Config.localMode = true;
          Q3D.Config.northArrow.enabled = true;
          Q3D.Config.northArrow.color = 0x080808;

          var container = document.getElementById("view"),
               app = Q3D.application,
               gui = Q3D.gui;

          app.init(container); // initialize viewer

          // load the scene
          app.loadSceneFile("<?= base_url() . 'assets/data/data/' . $nama_folder . '/' . $nama_file; ?>", function(scene) {
               // scene file has been loaded
               app.start();
          }, function(scene) {
               // all relevant files have been loaded

          });
     </script>
</body>

</html>