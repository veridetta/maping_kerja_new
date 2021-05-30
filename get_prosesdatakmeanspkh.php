<?php
//search=&sort=nama&order=asc&offset=0&limit=10
if($_GET){
    function rupiah($angka){
        $hasil="Rp ".number_format($angka,2,',','.');
        return $hasil;
    }
    function pendapatan($pendapatan){
        $skala=0;
        if($pendapatan<1800000){
            if($pendapatan<1200000){
                $skala=1;    
            }else{
                $skala=2;
            }
        }else{
            $skala=3;
        }
        return $skala;
    }
    function tanggungan($tanggunan){
        $skala=0;
        if($tanggunan<5){
            if($tanggunan<3){
                $skala=3;    
            }else{
                $skala=2;
            }
        }else{
            $skala=1;
        }
        return $skala;
    }
    function pencari($pendapatan,$tanggungan,$tipe){
        $sp=0;
        $st=0;
        if($tipe==1){
            $sp=1;
            $st=1;
        }else if($tipe==2){
            $sp=2;
            $st=2;
        }else if($tipe==3){
            $sp=3;
            $st=3;
        }
        $selp=$pendapatan-$sp;
        $selt=$tanggungan-$st;
        $hasil= sqrt(($selp*$selp)+($selt*$selt));
        return $hasil;
    }
    function cluster($c1,$c2,$c3){
        $arr=array($c1,$c2,$c3);
        $cluster=min($arr);
        $masuk="C1";
        if($cluster==$c1){
            $masuk="C1";
        }else if($cluster==$c2){
            $masuk="C2";
        }else if($cluster==$c3){
            $masuk="C3";
        }
        return $masuk;
    }
    error_reporting(error_reporting() & ~E_NOTICE);
    $search=isset($_GET['search']) ? $_GET['search'] : '';
    $offset=isset($_GET['offset']) ? $_GET['offset'] : 0;
    $limit=isset($_GET['limit']) ? $_GET['limit'] : 10;
    $sort=isset($_GET['sort']) ? $_GET['sort'] : 'nama';
    $order=isset($_GET['order']) ? $_GET['order'] : 'asc';
    include 'config/connect.php';
    //$id=$_GET['id'];
    $tot=mysqli_query($connect, "select * from datakmeanspkh");
    $total_h=mysqli_num_rows($tot);
    $get=mysqli_query($connect,"Select * from datakmeanspkh where nama like '%$search%' order by '$order' limit $limit offset $offset");
    $hitung=mysqli_num_rows($get);
    $jo=array(
            "judul" => "Get Menu List",
            "total" =>$hitung,
            "totalNotFiltered"=>$total_h,
            "rows"   => array()
            );
            $nom=0;
    header('Content-Type: application/json');
    if($hitung>0){
        while($data=mysqli_fetch_array($get)){
            $pendap=pendapatan($data['pendapatan']);
            $tangg=tanggungan($data['tanggungan']);
            $c1=pencari($pendap,$tangg,1);
            $c2=pencari($pendap,$tangg,2);
            $c3=pencari($pendap,$tangg,3);
            $cluster=cluster($c1,$c2,$c3);
            $dc1=str_replace(',000','',number_format($c1,3,',',' '));
            $dc2=str_replace(',000','',number_format($c2,3,',',' '));
            $dc3=str_replace(',000','',number_format($c3,3,',',' '));
            $cluster=cluster($c1,$c2,$c3);
            if($data['cluster']==""){
                $update=mysqli_query($connect,"update datakmeanspkh set skala_pendapatan='$pendap', skala_tanggungan='$tangg', cluster='$cluster' where id='$data[id]'");
            }
            $nom++;
            $p[]=array(
                "no"    =>$nom,
                "nama"  => $data['nama'],
                "pendapatan"   => rupiah($data['pendapatan']),
                "skalap"  => $pendap,
                "tanggungan"    => $data['tanggungan'],
                "skalat"  =>$tangg,
                "c1"  =>$dc1,
                "c2"  =>$dc2,
                "c3"  =>$dc3,
                "cluster"  =>$cluster
                );
        }
        $jo['total']=$hitung;
        $jo['rows']=$p;
        echo json_encode($jo); 
    }else{
        $p[]=array(
            "no"    =>$nom,
                "nama"  => $data['nama'],
                "pendapatan"   => $data['pendapatan'],
                "skalap"  => $data['skala_pendapatan'],
                "tanggungan"    => $data['tanggungan'],
                "skalat"  =>$data['skala_tanggungan'],
                "c1"  =>"",
                "c2"  =>"",
                "c3"  =>"",
                "cluster"  =>""
            );
        $jo['total']=$hitung;
        $jo['rows']=$p;
        echo json_encode($jo); 
    }
}
?>