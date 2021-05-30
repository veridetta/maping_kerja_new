<!DOCTYPE html>
<?php
$btn_acc=isset($_POST['btn_acc']) ? $_POST['btn_acc'] : '';
$btn_sumbit=isset($_POST['daftar_submit']) ? $_POST['daftar_submit'] : '';
$iid=isset($_GET['id']) ? $_GET['id'] : '';
?>
<html lang="en">
<head>
  <title><?php error_reporting(error_reporting() & ~E_NOTICE); if($iid!=""){echo "Edit Data";}else{echo "Input Data";};?></title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta charset="utf-8">
  <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://unpkg.com/bootstrap-table@1.16.0/dist/bootstrap-table.min.css">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">
  <script src="assets/js/jquery.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
  <script src="assets/bootstrap/js/bootstrap.min.js"></script>
  <script src="//maps.googleapis.com/maps/api/js?v=3.exp&sensor=false&key=AIzaSyDeg8D1qBumu2W7AmBk742R3OaeYyUvOww" type="text/javascript"></script>
  <!-- Latest compiled and minified JavaScript -->
<script src="https://unpkg.com/bootstrap-table@1.16.0/dist/bootstrap-table.min.js"></script>
<style>
    .btn-file {
        position: relative;
        overflow: hidden;
    }
    .btn-file input[type=file] {
        position: absolute;
        top: 0;
        right: 0;
        min-width: 100%;
        min-height: 100%;
        font-size: 100px;
        text-align: right;
        filter: alpha(opacity=0);
        opacity: 0;
        outline: none;
        background: white;
        cursor: inherit;
        display: block;
    }

    #img-upload{
        width: 80%;
    }

    #map_canvas{
        width: 100%;
        height: 300px;
    }

    #current{
        padding-top: 25px;
    }
</style>
</head>
<body>
<?php
error_reporting(error_reporting() & ~E_NOTICE);
    session_start();
    include 'config/connect.php';
    if($_SESSION){
    }else{
        header('location:login.php');
    }
    $error="default message";
    if($btn_acc){
        $id_pa=mysqli_escape_string($connect,$_POST['id_partner_acc']);
        $inss=mysqli_query($connect, "update users set status='1' where id='$id_pa'");
        if($inss){
            $error="Partner Berhasil di acc";
        }else{
            $error="Terjadi kesalahan ". mysqli_error($connect);
        }
    }
    if($btn_sumbit){
        if($_POST['idx']=="kosong"){
            $target_dir = "upload/";
            date_default_timezone_set('Asia/Jakarta');
            $tanggal=date('d-m-Y-H-i-s');
            $tgl=date('d-m-Y H:i:s');
            $nama_file=$tanggal.basename($_FILES["poto"]["name"]);
            $target_file = $target_dir . $nama_file;
            $nama_tmp_poto= $_FILES['poto']['tmp_name'];
            $nama_poto=$_FILES['poto']['name'];
            $ukuran_poto=$_FILES['poto']['size'];
            $errorz=$_FILES['poto']['error'];
            $nama=mysqli_escape_string($connect, $_POST['nama']);
            $hp=mysqli_escape_string($connect, $_POST['hp']);
            $alamat=mysqli_escape_string($connect, $_POST['alamat']);
            $keahlian=mysqli_escape_string($connect, $_POST['keahlian']);
            $pengalaman=mysqli_escape_string($connect, $_POST['pengalaman']);
            $pendidikan=mysqli_escape_string($connect, $_POST['pendidikan']);
            $ktp=mysqli_escape_string($connect, $_POST['ktp']);
            $poto=$nama_file;
            $pekerjaan=mysqli_escape_string($connect, $_POST['pekerjaan']);
            $status=mysqli_escape_string($connect, $_POST['status']);
            $partner=$_SESSION['id'];
            $lat=mysqli_escape_string($connect, $_POST['lat']);
            $lng=mysqli_escape_string($connect, $_POST['lng']);
        
            if($errorz>0){
                $error="Terjadi kesalahan awal saat upload photo, silahkan coba lagi atau ganti dengan yang lain";
            }else{
                if($ukuran_poto>500000){
                    $error="Ukuran photo lebih dari 500kb";
                }else{
                    if (is_dir($target_dir) && is_writable($target_dir)) {
                        if (move_uploaded_file($nama_tmp_poto, $target_file)) {
                            $insert=mysqli_query($connect, "insert into data(nama, hp, alamat, keahlian, pengalaman, pendidikan, ktp, poto, status, pekerjaan, partner, tanggal, lat, lng) VALUES ('$nama','$hp','$alamat','$keahlian','$pengalaman','$pendidikan','$ktp','$poto','$status','$pekerjaan','$partner','$tanggal','$lat','$lng')");
                            if($insert){
                                $error="Input data berhasil.";
                                $status=1;
                            }else{
                                $error="Terjadi kesalahan saat menginput data, silahkan coba lagi.".mysqli_error($connect);;
                            }
                        } else {
                            $error="Terjadi kesalahan saat upload photo, silahkan coba lagi atau ganti dengan yang lain";
                        }
                    } else {
                        $error='Upload directory is not writable, or does not exist.';
                        header( "refresh:3; url=login.php" ); 
                    } 
                }
            }

        }else{
            if($_POST['idx']!=""){
                //echo $_POST['idx'];
            $nama=mysqli_escape_string($connect, $_POST['nama']);
            $hp=mysqli_escape_string($connect, $_POST['hp']);
            $alamat=mysqli_escape_string($connect, $_POST['alamat']);
            $keahlian=mysqli_escape_string($connect, $_POST['keahlian']);
            $pengalaman=mysqli_escape_string($connect, $_POST['pengalaman']);
            $pendidikan=mysqli_escape_string($connect, $_POST['pendidikan']);
            $ubah=mysqli_query($connect, "Update data set nama='$nama', hp='$hp', alamat='$alamat',keahlian='$keahlian',pengalaman='$pengalaman',pendidikan='$pendidikan' where id='$_POST[idx]'");
            if($ubah){
                $error="Edit data berhasil.";
                $status=1;
            }else{
                $error="Terjadi kesalahan saat mengedit data, silahkan coba lagi.".mysqli_error($connect);;
            }   
            }
        }
    }
?>
<nav class="navbar navbar-expand-lg navbar-dark bg-success">
  <a class="navbar-brand" href="dashboard.php">Input Data Kerja</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo02" aria-controls="navbarTogglerDemo02" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarTogglerDemo02">
    <ul class="navbar-nav ml-auto mt-2 mt-lg-0">
    <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#">K-Means</a>
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
        $inama='';
        $iid='kosong';
        $inohp='';
        $ipendidikan='';
        $ikeahlian='';
        $ipengalaman='';
        $iktp="";
        $ipekerjaan="";
        if($_SESSION){
            if($_GET){
                if($iid){
                    $iid=$iid;
                    $select=mysqli_query($connect, "select * from data where id='$iid'");
                    while($ambil=mysqli_fetch_array($select)){
                        $inama=$ambil['nama'];
                        $inohp=$ambil['hp'];
                        $iktp=$ambil['ktp'];
                        $ipendidikan=$ambil['pendidikan'];
                        $ialamat=$ambil['alamat'];
                        $istatus=$ambil['status'];
                        $ipekerjaan=$ambil['pekerjaan'];
                        $ikeahlian=$ambil['keahlian'];
                        $ipengalaman=$ambil['pengalaman'];
                    }
                }
            }
            ?>
         <li class="nav-item dropdown active">
            <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#"><span class="sr-only">(current)</span>Input Data</a>
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
<div class="alert alert-warning alert-dismissible fade" role="alert">
  <strong>Info!</strong> <?php echo $error;?>
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>
<div class="container" style="padding-top:25px; padding-bottom:25px;">
    <div class="row col-12 justify-content-center">
        <div class="col-11 col-lg-11 col-xs-12 col-md-11 col-sm-11 col-xl-11">
            <?php 
            if($_SESSION['role']=="admin"){
                ?>
                <div class="card">
                    <div class="card-header">
                        Request Partner
                    </div>
                    <div class="card-body" >
                        <div class="row col-12 justify-content-center" style="min-height:200px">
                            <?php 
                             $parz=mysqli_query($connect, "select * from users where role='partner' and status='0'");
                             $hipar=mysqli_num_rows($parz);
                             if($hipar>0){
                                 while($partner_data=mysqli_fetch_array($parz)){
                                     $nama_partner=$partner_data['nama'];
                                     $hp_partner=$partner_data['hp'];
                                     $alamat_partner=$partner_data['alamat'];
                                     $id_partner_acc=$partner_data['id'];
                                 ?>
                                 <div class="col-3">
                                    <div class="card">
                                        <div class="card-header"><?php echo $nama_partner;?></div>
                                        <div class="card-body">
                                            <span class="h4 badge badge-warning" id="bekerja"><?php echo $hp_partner;?></span></a>
                                            <hr style="margin-top:0;">
                                            <p>Alamat : <?php echo $alamat_partner;?></p>
                                        </div>
                                        <div class="card-footer">
                                            <form method="post" action="dashboard.php">
                                                <input type="hidden" id="id_partner_acc" name="id_partner_acc" value="<?php echo $id_partner_acc;?>">
                                                <input type="submit" name="btn_acc" id="btn_acc" class="btn btn-block btn-warning" value="ACC">
                                            </form>
                                        </div>
                                    </div>
                                 </div>
                                 <?php
                                 }
                             }else{
                                 echo "<p class='my-auto h3 text-muted'>Tidak ada partner baru</p>";
                             }
                            ?>
                        </div>
                    </div>
                </div>
                <?php
            }
            ?>
            <p class="h3"><?php if($iid!=""){echo "Edit Data Pekerjaan";}else{echo "Input Data Kerja";};?></p>
            <hr>
            <div class="card">
                <div class="card-header">
                <?php if($iid!=""){echo "Edit Data";}else{echo "Input Data Baru";};?>
                </div>
                <div class="card-body">
                <form method="post" id="form_daftar" enctype="multipart/form-data" action="dashboard.php">
                    <div class="col-12 row justify-content-center">
                        <div class="col-lg-6 col-xl-6 col-md-6 col-xs-12 col-sm-12">
                            <div class="form-group">
                                <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fa fa-user"></i></span>
                                </div>
                                <input required placeholder="Nama Lengkap" value="<?php echo $inama;?>" type="text" id="nama" name="nama" class="form-control">
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fa fa-phone"></i></span>
                                </div>
                                <input required placeholder="No HP" value="<?php echo $inohp;?>" type="text" id="hp" name="hp" class="form-control">
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fa fa-id-card"></i></span>
                                </div>
                                <input required placeholder="No KTP" value="<?php echo $iktp;?>" type="text" id="ktp" name="ktp" class="form-control">
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fa fa-graduation-cap"></i></span>
                                </div>
                                <input required placeholder="Pendidikan Terakhir" value="<?php echo $ipendidikan;?>" type="text" id="pendidikan" name="pendidikan" class="form-control">
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fa fa-map"></i></span>
                                </div>
                                <textarea required rows="3" class="form-control" value="<?php echo $ialamat;?>" id="alamat" name="alamat" placeholder="Alamat"></textarea>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="status">Status</label>
                                <select name="status" id="status" class="col-12 form-control">
                                    <option value="1">Bekerja</option>
                                    <option value="0">Tidak Bekerja</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fa fa-briefcase"></i></span>
                                </div>
                                <input required placeholder="Pekerjaan Sekarang" value="<?php echo $ipekerjaan;?>" type="text" id="pekerjaan" name="pekerjaan" class="form-control">
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 col-xl-6 col-md-6 col-xs-12 col-sm-12">
                            
                            <div class="form-group">
                                <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fa fa-file"></i></span>
                                </div>
                                <textarea required rows="3" class="form-control" id="keahlian" name="keahlian" placeholder="Keahlian" value="<?php echo $ikeahlian;?>"></textarea>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fa fa-briefcase"></i></span>
                                </div>
                                <textarea required rows="3" class="form-control" id="pengalaman" name="pengalaman" placeholder="Pengalaman Bekerja"></textarea>
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Upload Image <small>max 500kb</small></label>
                                <div class="input-group">
                                    <span class="input-group-btn">
                                        <span class="btn btn-default btn-file">
                                            Browse… <input required type="file" id="poto" name="poto" accept='image/*'>
                                        </span>
                                    </span>
                                    <input type="text" class="form-control" readonly>
                                </div>
                            </div>
                        </div>
                        <div class="col-12">
                            <p>Pilih Alamat Peta</p>
                            <div id='map_canvas'></div>
                            <!--<div id="current">Nothing yet...</div>-->
                        </div>
                    </div>
                    <hr>
                    <div class="form-group">
                        <div class="input-group">
                            <input type="submit" name="daftar_submit" value="Masukkan Data" id="daftar_btn" class="btn btn-success form-control">
                        </div>
                    </div>
                    <input  type="hidden" name="idx" id="idx" value="<?php echo $iid;?>" id="lat">
                    <input  type="hidden" name="lat" value="" id="lat">
                    <input  type="hidden" name="lng" value="" id="lng">
                </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    <?php if($_POST){
            echo "$('.alert').addClass('show');";
        };?>
        $(document).on('change', '.btn-file :file', function() {
		var input = $(this),
			label = input.val().replace(/\\/g, '/').replace(/.*\//, '');
		input.trigger('fileselect', [label]);
		});

		$('.btn-file :file').on('fileselect', function(event, label) {
		    
		    var input = $(this).parents('.input-group').find(':text'),
		        log = label;
		    
		    if( input.length ) {
		        input.val(log);
		    } else {
		        if( log ) alert(log);
		    }
	    
		});	
    var map = new google.maps.Map(document.getElementById('map_canvas'), {
        zoom: 15,
        center: new google.maps.LatLng(-6.764270, 108.539470),
        mapTypeId: google.maps.MapTypeId.ROADMAP
    });

    var myMarker = new google.maps.Marker({
        position: new google.maps.LatLng(-6.764270, 108.539470),
        draggable: true
    });

    google.maps.event.addListener(myMarker, 'dragend', function (evt) {
        //document.getElementById('current').innerHTML = '<p>Marker dropped: Current Lat: ' + evt.latLng.lat().toFixed(3) + ' Current Lng: ' + evt.latLng.lng().toFixed(3) + '</p>';
        $("#lat").val(evt.latLng.lat().toFixed(3));
        $("#lng").val(evt.latLng.lng().toFixed(3));
    });

    google.maps.event.addListener(myMarker, 'dragstart', function (evt) {
        //document.getElementById('current').innerHTML = '<p>Currently dragging marker...</p>';
    });

    map.setCenter(myMarker.position);
    myMarker.setMap(map);
</script>
</body>