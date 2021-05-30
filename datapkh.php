<!DOCTYPE html>
<html lang="en">
<head>
  <title>Data</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://unpkg.com/bootstrap-table@1.16.0/dist/bootstrap-table.min.css">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">
  <script src="assets/js/jquery.js"></script>
  <script src="assets/bootstrap/js/bootstrap.min.js"></script>
  <script async defer
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDylZJDltwvNgoguyBxMIXo3YoFhdXLPoI&callback=initMap"></script>
  <!--<script src="assets/js/map.js"></script>-->
  <!-- Latest compiled and minified JavaScript -->
<script src="https://unpkg.com/bootstrap-table@1.16.0/dist/bootstrap-table.min.js"></script>
<style>
.modal {
  text-align: center;
}

@media screen and (min-width: 768px) { 
  .modal:before {
    display: inline-block;
    vertical-align: middle;
    content: " ";
    height: 100%;
  }
}

.modal-dialog {
  display: inline-block;
  text-align: left;
  vertical-align: middle;
}
</style>
</head>
<body>
<?php 
session_start();?>
<nav class="navbar navbar-expand-lg navbar-dark bg-success">
  <a class="navbar-brand" href="datapkh.php">Cluster Data PKH</a>
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
      <li class="nav-item dropdown active">
        <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#"><span class="sr-only">(current)</span>Data</a>
        <div class="dropdown-menu">
        <a class="dropdown-item" href="datawarga.php">Warga</a>
        <a class="dropdown-item" href="datapkh.php">PKH</a>
        <a class="dropdown-item" href="data.php">Kerja</a>
        </div>
      </li>
      <?php
        error_reporting(error_reporting() & ~E_NOTICE);
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
            $remove=isset($_POST['remove']) ? $_POST['remove'] : '';
             if($_SESSION['role']=="admin"){
              if($remove){
                include 'config/connect.php';
                $idremovee=$_POST['idremove'];
                $hapus=mysqli_query($connect, "DELETE from datapkh where id='$idremovee'");
                if($hapus){
                  $error="Hapus data berhasil.";
                  $status=1;
              }else{
                  $error="Terjadi kesalahan saat menghapus data, silahkan coba lagi.".mysqli_error($connect);;
              }
              }
            }
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
    <div class="card">
        <div class="card-header">
            Cluster Data PKH
        </div>
        <div class="card-body">
            <div class="col-12">
                <table
                    id="table"
                    data-toolbar="#toolbar"
                    data-search="true"
                    data-show-refresh="true"
                    data-show-toggle="true"
                    data-show-fullscreen="true"
                    data-detail-view="true"
                    data-show-export="true"
                    data-click-to-select="true"
                    data-detail-formatter="detailFormatter"
                    data-minimum-count-columns="2"
                    data-show-pagination-switch="false"
                    data-pagination="true"
                    data-id-field="id"
                    data-page-list="[10, 25, 50, 100, all]"
                    data-show-footer="true"
                    data-side-pagination="server"
                    data-url="get_datapkh.php"
                    data-response-handler="">
                </table>

            </div>
        </div>
    </div>
</div>
<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-body">
        <p class="h3 text-center">Hapus Data</p>
        <p class="text-center">Yakin makan menghapus data?</p>
      </div>
      <div class="modal-footer">
        <form method="post" action="datapkh.php"><input type="hidden" name="idremove" id="idremove" value="">
        <input type="submit" name="remove" class="btn btn-danger" value="Yakin"></form>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tidak</button>
      </div>
    </div>
  </div>
</div>
<script>
<?php if($_POST){
            echo "$('.alert').addClass('show');";
        };?>
function initMap() {};
  var $table = $('#table')
  var $remove = $('#remove')
  var selections = []

  function getIdSelections() {
    return $.map($table.bootstrapTable('getSelections'), function (row) {
      return row.id
    })
  }

  function responseHandler(res) {
    $.each(res.rows, function (i, row) {
      row.state = $.inArray(row.id, selections) !== -1
    })
    return res
  }

  function detailFormatter(index, row) {
    var html = []
    $table.bootstrapTable('getData')
    $.each(row, function (key, value) {
      html.push('<p><b>' + key + ':</b> ' + value + '</p>')
    })
    return html.join('')
  }

  function operateFormatter(value, row, index) {
    return [
      '<a class="edit btn btn-primary" href="javascript:void(0)" title="Edit" style="margin-bottom:12px;">',
      '<i class="fa fa-edit"></i>',
      '</a>  ',
      '<a class="remove btn btn-danger" href="javascript:void(0)" title="Remove" style="margin-bottom:12px;">',
      '<i class="fa fa-trash"></i>',
      '</a>'
    ].join('')
  }

  window.operateEvents = {
    'click .edit': function (e, value, row, index) {
      //alert('You click like action, row: ' + JSON.stringify(row))
      function replacer(string) {
        var data = string;
        var convertedData = JSON.parse(data);
        return convertedData.id;
      }
      var jsson = JSON.stringify(row, ['id']);
      location.href = "inputpkh.php?id="+replacer(jsson);
      //alert(replacer(jsson));
    },
    'click .remove': function (e, value, row, index) {
      //$table.bootstrapTable('remove', {
        //field: 'id',
        //values: [row.id]
      //})
      function replacer(string) {
        var data = string;
        var convertedData = JSON.parse(data);
        return convertedData.id;
      }
      var jsson = JSON.stringify(row, ['id']);
      remove(replacer(jsson));
    }
  }
  function remove(id){
    $("#myModal").modal('show');
    var idnya=id;
    $("#idremove").val(id);
  }
  function editData(id){
    var url = "inputpkh.php?id="+id;
    windows.open(url);
  }

  function totalTextFormatter(data) {
    return 'Total'
  }

  function totalNameFormatter(data) {
    return data.length
  }

  function totalPriceFormatter(data) {
    var field = this.field
    return '$' + data.map(function (row) {
      return +row[field].substring(1)
    }).reduce(function (sum, i) {
      return sum + i
    }, 0)
  }

  function initTable() {
    $table.bootstrapTable('destroy').bootstrapTable({
      height: 550,
      columns: [
        [{
          title: 'No',
          field: 'no',
          align: 'center',
          valign: 'middle',
          footerFormatter: totalTextFormatter
        },{
          field: 'nama',
          title: 'Nama',
          footerFormatter: totalNameFormatter,
          sortable: true,
          align: 'center'
        }, {
          field: 'id',
          title: 'id',
          visible : false
        }, {
          field: 'hp',
          title: 'No HP',
          align: 'center'
        },{
          field: 'alamat',
          title: 'Alamat',
          align: 'center'
        },{
          field: 'ttl',
          title: 'Tempat, tanggal lahir',
          align: 'center'
          
        },{
          field: 'kriteriaWarga',
          title: 'Kriteria Warga',
          align: 'center',
          sortable: true
        
        },{
          field: 'poto',
          title: 'Foto',
          align: 'center'
          
        }<?php if($_SESSION['role']=="admin"){
            ?>
            , {
          field: 'operate',
          title: 'Operasi',
          align: 'center',
          clickToSelect: false,
          events: window.operateEvents,
          formatter: operateFormatter
        }
            <?php
        }else{

        }?>]
      ]
    })
    $table.on('check.bs.table uncheck.bs.table ' +
      'check-all.bs.table uncheck-all.bs.table',
    function () {
      $remove.prop('disabled', !$table.bootstrapTable('getSelections').length)

      // save your data, here just save the current page
      selections = getIdSelections()
      // push or splice the selections if you want to save all data selections
    })
    $table.on('all.bs.table', function (e, name, args) {
      console.log(name, args)
    })
    $remove.click(function () {
      var ids = getIdSelections()
      $table.bootstrapTable('remove', {
        field: 'id',
        values: ids
      })
      $remove.prop('disabled', true)
    })
  }

  $(function() {
    initTable()
    $('#locale').change(initTable)
    $table.bootstrapTable('hideColumn', 'poto')
    $table.bootstrapTable('hideColumn', 'pengalaman')
  })
</script>
