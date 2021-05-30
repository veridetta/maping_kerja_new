
<html lang="en">
<head>
  <title>K-Means PKH</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">
  <script src="assets/js/jquery.js"></script>
  <script src="assets/bootstrap/js/bootstrap.min.js"></script>
  <script
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDylZJDltwvNgoguyBxMIXo3YoFhdXLPoI&callback=initMap" async defer></script>
  <!--<script src="assets/js/map.js"></script>-->
  <style>
  #map{
        width: 100%;
        height: 300px;
    }
  </style>
</head>
<body>
<?php
error_reporting(E_ERROR | E_WARNING | E_PARSE);
include 'config/connect.php';
$dat_jum_c1=mysqli_query($connect, "select * from datakmeanspkh where cluster='C1'");
$dat_jum_c2=mysqli_query($connect, "select * from datakmeanspkh where cluster='C2'");
$dat_jum_c3=mysqli_query($connect, "select * from datakmeanspkh where cluster='C3'");
$jum_1=mysqli_num_rows($dat_jum_c1);
$jum_2=mysqli_num_rows($dat_jum_c2);
$jum_3=mysqli_num_rows($dat_jum_c3);
function rupiah($angka){
	
	$hasil_rupiah = "Rp " . number_format($angka,2,',','.');
	return $hasil_rupiah;
 
}
$nomm=1;
$filter=isset($_GET['filter']) ? $_GET['filter'] : '';
if($filter){
  /*if($filter>7){
    $filter=8;
  }else{
    
  }
  */
  $dat=mysqli_query($connect, "select * from datakmeanspkh where cluster='$filter'");
  echo mysqli_error($connect);
}else{
  $filter='';
  $dat=mysqli_query($connect, "select * from datakmeanspkh");
}
?>
<nav class="navbar navbar-expand-lg navbar-dark bg-success">
  <a class="navbar-brand" href="kmeanspkh.php">K-MEANS PKH</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo02" aria-controls="navbarTogglerDemo02" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarTogglerDemo02">
    <ul class="navbar-nav ml-auto mt-2 mt-lg-0">
    <li class="nav-item dropdown active">
        <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#">K-Means<span class="sr-only">(current)</span></a>
        <div class="dropdown-menu">
        <a class="dropdown-item" href="kmeanspkh.php">Peta</a>
        <a class="dropdown-item" href="datakmeanspkh.php">Data</a>
        </div>
      </li>
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#">Cluster</a>
        <div class="dropdown-menu">
        <a class="dropdown-item" href="warga.php">Warga</a>
        <a class="dropdown-item" href="pkh.php">PKH</a>
        <a class="dropdown-item" href="index.php">Kerja</a>
        </div>
      </li>
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#">Data</a>
        <div class="dropdown-menu">
        <a class="dropdown-item" href="datawarga.php">Warga</a>
        <a class="dropdown-item" href="datapkh.php">PKH</a>
        <a class="dropdown-item" href="data.php">Kerja</a>
        </div>
      </li>
      <?php
        session_start();
        if($_SESSION){
            ?>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#">Input Data</a>
            <div class="dropdown-menu">
            <a class="dropdown-item" href="inputwarga.php">Warga</a>
            <a class="dropdown-item" href="inputpkh.php">PKH</a>
            <a class="dropdown-item" href="dashboard.php">Kerja</a>
            <a class="dropdown-item" href="inputkmeanspkh.php">K-Means</a>
            </div>
        </li>
          <li class="nav-item">
            <a class="nav-link" href="logout.php">Logout</a>
          </li>
            <?php
        }else{
          ?>
          <li class="nav-item">
            <a class="nav-link" href="login.php">Login</a>
          </li>
          <?php
        }
      ?>
    </ul>
  </div>
</nav>

<div class="container" style="padding-top:25px; padding-bottom:25px;">
  <div>
    <h3 class="text-center" style="padding-bottom:25px;">K-MEANS PKH</h3>
    <hr>
  </div>  
  <div class="col-12 row">
    <div class="col-12">
        <a href="kmeanspkh.php?filter=C1"><span class="h4 badge <?php if($filter=="C1" && $filter!=""){echo 'badge-success';}else{ echo 'badge-primary';}?>" id="kurang_mampu">Cluster 1</span></a>
        <a href="kmeanspkh.php?filter=C2"><span class="h4 badge <?php if($filter=="C2"){echo 'badge-success';}else{ echo 'badge-primary';}?>" id="kurang_mampu">Cluster 2</span></a>
        <a href="kmeanspkh.php?filter=C3"><span class="h4 badge <?php if($filter=="C3"){echo 'badge-success';}else{ echo 'badge-primary';}?>" id="kurang_mampu">Cluster 3</span></a>
        <a href="kmeanspkh.php"><span class="h4 badge <?php if($filter==''){echo 'badge-success';}else{ echo 'badge-primary';}?>" id="semua">Semua</span></a>
      </div>
    <div class="col-9">
      <div id="map" style="width: 100%; height: 600px;"></div>  
    </div>
    <div class="col-3" style="padding:0px;">
    <div class="card">
      <div class="card-header">Statistik</div>
        <div class="card-body">
          <p class=""><i class="fas fa-user"></i>Cluster 1 : <span class="h4 badge badge-danger" id="semua"><?php echo $jum_1;?> Orang</span></p>
          <p class=""><i class="fas fa-user"></i>Cluster 2  : <span class="h4 badge badge-warning" id="semua"><?php echo $jum_2;?> Orang</span></p>
          <p class=""><i class="fas fa-user"></i>Cluster 3  : <span class="h4 badge badge-success" id="semua"><?php echo $jum_3;?> Orang</span></p>
        </div>
      </div>
    </div>
  </div>
</div>
<script type="text/javascript">

  var contentString = [];
var locations = [];
var namae = [];
<?php 
  while($data=mysqli_fetch_array($dat)){
    $nama=$data['nama'];
    $ttl=$data['ttl'];
    $lat=$data['lat'];
    $lng=$data['lng'];
    $hp=$data['hp'];
    $kriteriapkh=$data['skala_pendapatan'];
    $kriteriawarga=$data['skala_tanggungan'];
    $stt=$data['status_pkh'];
    $pendapatan=$data['pendapatan'];
    $tanggungan=$data['tanggungan'];
    $poto=$data['poto'];
    $lengkap='<div id="content"><div id="siteNotice"></div><h1 id="firstHeading" class="firstHeading">'.$nama.'</h1><div id="bodyContent"><div class="row col-12"><div class="col-3 text-center"><img src="upload/'.$poto.'" width="80px" height="100px"></div><div class="col-9"><i class="fas fa-calendar"></i><span>Tempat,Tanggal Lahir : <b>'.$ttl.'</b></span><p style="margin-bottom:0" class=""><i class="fas fa-mobile"></i><span>Kontak : <b>'.$hp.'</b></span></p><p style="margin-bottom:0" class=""><span>'.$nama.' merupakan warga yang penerima PKH dari kategori '.$kriteriapkh.' yang masuk dalam cluster '.$kriteriapkh.' karena mempunyai pendapatan Rp. '.$pendapatan.' dan mempunyai tanggungan '.$tanggungan.' orang </span></p></div></div></div>';?>
    locations.push(['<?php echo $nama;?>',<?php echo $lat;?>,<?php echo $lng;?>,<?php echo $nomm;?>]);
    //locations[0].item.push('Bondi Beach');
    //locations[1].item.push(-33.890542);
    //locations[2].item.push(151.274856);
   //locations[3].item.push(1);
   namae.push('<?php echo $nama;?>');
    contentString.push('<?php echo $lengkap;?>');
    <?php
    $nomm++;
  }
?>
 
 function initMap() {
    /*var locations = [
      ['Bondi Beach', -33.890542, 151.274856, 4],
      ['Coogee Beach', -33.923036, 151.259052, 5],
      ['Cronulla Beach', -34.028249, 151.157507, 3],
      ['Manly Beach', -33.80010128657071, 151.28747820854187, 2],
      ['Maroubra Beach', -33.950198, 151.259302, 1]
    ];*/

    var map = new google.maps.Map(document.getElementById('map'), {
        zoom: 15,
        center: new google.maps.LatLng(-6.764270, 108.539470),
        mapTypeId: google.maps.MapTypeId.ROADMAP
    });
    var infowindow = new google.maps.InfoWindow({
          content: contentString
        });

    var marker, i;

    for (i = 0; i < locations.length; i++) {  
      marker = new google.maps.Marker({
        position: new google.maps.LatLng(locations[i][1], locations[i][2]),
        map: map,
        title: namae[i]
      });

      google.maps.event.addListener(marker, 'click', (function(marker, i) {
        return function() {
          infowindow.setContent(contentString[i]);
          infowindow.open(map, marker);
        }
      })(marker, i));
    }
    map.setCenter(marker.position);
    marker.setMap(map);
 }
  </script>
</body>
</html>

