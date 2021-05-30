<!DOCTYPE html>
<html lang="en">
<head>
  <title>Login</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://unpkg.com/bootstrap-table@1.16.0/dist/bootstrap-table.min.css">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">
  <script src="assets/js/jquery.js"></script>
  <script src="assets/bootstrap/js/bootstrap.min.js"></script>
  <script src="assets/js/map.js"></script>
  <!-- Latest compiled and minified JavaScript -->
<script src="https://unpkg.com/bootstrap-table@1.16.0/dist/bootstrap-table.min.js"></script>
</head>
<body>
<?php
error_reporting(error_reporting() & ~E_NOTICE);
    session_start();
    if($_SESSION){
        header('location:data.php');
    }
    if($_POST){
        include 'config/connect.php';
        $username=$_POST['email'];
        $password=$_POST['password'];
        $cek=mysqli_query($connect,"select * from users where email='$username' and password='$password'");
        if(mysqli_num_rows($cek)>0){
          while($data=mysqli_fetch_array($cek)){
            if($data['status']>0){
              $dat=mysqli_fetch_assoc($cek);
              session_start();
              $_SESSION['status']="login";
              $_SESSION['id']=$data['id'];
              $_SESSION['role']=$data['role'];
              $_SESSION['nama']=$data['nama'];
              $error="Login berhasil, kamu akan dialihkan";
              header( "refresh:3; url=inputkmeanspkh.php" ); 
            }else{
              $error="Akun kamu masih dalam peninjauan oleh admin";
            }
          }
            ?>
            <?php
        }else{
            $error="Silahkan periksa kembali data login anda.";
        }
    }?>
<nav class="navbar navbar-expand-lg navbar-dark bg-success">
  <a class="navbar-brand" href="login.php">Cluster Data Warga Kelurahan Argasunya</a>
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
      <li class="nav-item active">
        <a class="nav-link" href="login.php"><span class="sr-only">(current)</span>Login</a>
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
  <div class="col-12 row justify-content-center " style="min-height:10vh">
    <div class="col-xl-5 col-md-8 col-lg-5 col-xs-11 col-11 my-auto">
      <div class="card">
        <div class="card-header">
          Login
        </div>
        <div class="card-body">
          <form method="post" id="form_login" action="login.php">
            <div class="col-12">
              <div class="form-group">
                <div class="input-group">
                  <div class="input-group-prepend">
                    <span class="input-group-text"><i class="fa fa-envelope"></i></span>
                  </div>
                  <input placeholder="Email" type="text" id="email" name="email" class="form-control">
                </div>
              </div>
              <div class="form-group">
                <div class="input-group">
                  <div class="input-group-prepend">
                    <span class="input-group-text"><i class="fa fa-key"></i></span>
                  </div>
                  <input  placeholder="Password" type="password" id="password" name ="password" class="form-control">
                </div>
              </div>
              <div class="form-group">
                <div class="input-group">
                  <input  type="submit" name="login_sumbit" value="Login" id="login_btn" class="btn btn-success form-control">
                </div>
              </div>
            </div>
          </form>
        </div>
        <div class="card-footer">
            <div class="col-12 text-center">
              <small>Belum punya akun?</small>
              <small><a href="daftar.php">Daftar sekarang</a></small>
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
})
</script>