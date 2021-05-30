<?php
//search=&sort=nama&order=asc&offset=0&limit=10
if($_GET){
    error_reporting(error_reporting() & ~E_NOTICE);
    $search=isset($_GET['search']) ? $_GET['search'] : '';
    $offset=isset($_GET['offset']) ? $_GET['offset'] : 0;
    $limit=isset($_GET['limit']) ? $_GET['limit'] : 10;
    $sort=isset($_GET['sort']) ? $_GET['sort'] : 'nama';
    $order=isset($_GET['order']) ? $_GET['order'] : 'asc';
    include 'config/connect.php';
    //$id=$_GET['id'];
    $tot=mysqli_query($connect, "select * from data");
    $total_h=mysqli_num_rows($tot);
    $get=mysqli_query($connect,"Select * from data where nama like '%$search%' order by '$order' limit $limit offset $offset");
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
            $nom++;
            $p[]=array(
                "no"    =>$nom,
                "nama"  => $data['nama'],
                "hp"   => $data['hp'],
                "pendidikan"  => $data['pendidikan'],
                "alamat"    => $data['alamat'],
                "keahlian"      =>$data['keahlian'],
                "pengalaman"  =>$data['pengalaman'],
                "id"  =>$data['id'],
                "poto"  => $data['poto']
                );
        }
        $jo['total']=$hitung;
        $jo['rows']=$p;
        echo json_encode($jo); 
    }else{
        $p[]=array(
            "no"    =>$nom,
            "nama"  => $data['nama'],
            "hp"   => "",
            "pendidikan"  => $data['pendidikan'],
            "alamat"    => $data['alamat'],
            "keahlian"      =>$data['keahlian'],
            "pengalaman"  =>$data['pengalaman'],
            "id"  =>$data['id'],
            "poto"  => $data['poto']
            );
        $jo['total']=$hitung;
        $jo['rows']=$p;
        echo json_encode($jo); 
    }
}
?>