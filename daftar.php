<!DOCTYPE html>
<html lang="en">
<head>
  <title>Daftar</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://unpkg.com/bootstrap-table@1.16.0/dist/bootstrap-table.min.css">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">
  <script src="assets/js/jquery.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
  <script src="assets/bootstrap/js/bootstrap.min.js"></script>
  <script src="assets/js/map.js"></script>
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
</style>
</head>
<body>
<?php 
    $error="default message";
    if($_POST){
        include 'config/connect.php';
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
        $email=mysqli_escape_string($connect, $_POST['email']);
        $password=mysqli_escape_string($connect, $_POST['password']);
        $nama=mysqli_escape_string($connect, $_POST['nama']);
        $hp=mysqli_escape_string($connect, $_POST['hp']);
        $alamat=mysqli_escape_string($connect, $_POST['alamat']);
        $poto=$nama_file;
        $role="partner";
        $status=0;
        if($errorz>0){
            $error="Terjadi kesalahan awal saat upload photo, silahkan coba lagi atau ganti dengan yang lain";
        }else{
            if($ukuran_poto>500000){
                $error="Ukuran photo lebih dari 500kb";
            }else{
                if (is_dir($target_dir) && is_writable($target_dir)) {
                    if (move_uploaded_file($nama_tmp_poto, $target_file)) {
                        $insert=mysqli_query($connect, "insert into users(email, password, nama, alamat, poto, role, status, tanggal,hp) VALUES('$email','$password','$nama','$alamat','$poto','$role','$status','$tgl','$hp')");
                        if($insert){
                            $error="Pendaftaran Berhasil, akan dialihkan ke menu login";
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
        ?>
        <?php
    }
?>
<nav class="navbar navbar-expand-lg navbar-dark bg-success">
  <a class="navbar-brand" href="#">Cluster Data Warga Kelurahan Argasunya</a>
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
      <li class="nav-item">
        <a class="nav-link" href="login.php">Login</a>
      </li>
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
  <div class="col-12 row justify-content-center " style="min-height:82vh">
    <div class="col-xl-5 col-md-8 col-lg-5 col-xs-11 col-11 my-auto">
      <div class="card">
        <div class="card-header">
          Daftar Baru   
        </div>
        <div class="card-body">
          <form method="post" id="form_daftar" enctype="multipart/form-data" action="daftar.php">
            <div class="col-12">
              <div class="form-group">
                <div class="input-group">
                  <div class="input-group-prepend">
                    <span class="input-group-text"><i class="fa fa-user"></i></span>
                  </div>
                  <input required placeholder="Nama Lengkap" type="text" id="nama" name="nama" class="form-control">
                </div>
              </div>
              <div class="form-group">
                <div class="input-group">
                  <div class="input-group-prepend">
                    <span class="input-group-text"><i class="fa fa-phone"></i></span>
                  </div>
                  <input required placeholder="No HP" type="text" id="hp" name="hp" class="form-control">
                </div>
              </div>
              <div class="form-group">
                <div class="input-group">
                  <div class="input-group-prepend">
                    <span class="input-group-text"><i class="fa fa-map"></i></span>
                  </div>
                  <textarea required rows="3" class="form-control" id="alamat" name="alamat" placeholder="Alamat"></textarea>
                </div>
              </div>
              <div class="form-group">
                <div class="input-group">
                  <div class="input-group-prepend">
                    <span class="input-group-text"><i class="fa fa-envelope"></i></span>
                  </div>
                  <input required placeholder="Email" type="text" id="email" name="email" class="form-control">
                </div>
              </div>
              <div class="form-group">
                <div class="input-group">
                  <div class="input-group-prepend">
                    <span class="input-group-text"><i class="fa fa-key"></i></span>
                  </div>
                  <input required  placeholder="Password" type="password" id="password" name ="password" class="form-control">
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
              <div class="form-group">
                <div class="input-group">
                  <input  type="submit" name="daftar_submit" value="Daftar" id="daftar_btn" class="btn btn-success form-control">
                </div>
              </div>
            </div>
          </form>
        </div>
        <div class="card-footer">
            <div class="col-12 text-center">
              <small>Sudah punya akun?</small>
              <small><a href="login.php">Login sekarang</a></small>
            </div>
        </div>
      </div>
    </div>
  </div>
</div>
<script>
$(document).ready( function() {
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
	});
</script>

