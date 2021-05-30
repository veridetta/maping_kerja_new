<?php
    include '../config/connect.php';
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
    $da=mysqli_query($connect, "select * from datakmeanspkh");
    ?>
    <table class="table table-bordered table-hovered table-stripped">
        <thead>
            <tr>
                <td>No</td>
                <td>Nama</td>
                <td>Pendapatan</td>
                <td>Skala</td>
                <td>Tanggungan</td>
                <td>Skala</td>
                <td>C1</td>
                <td>C2</td>
                <td>C3</td>
                <td>Klaster</td>
            </tr>
        </thead>
        <tbody>
        <?php
        $no=1;
        while($data=mysqli_fetch_array($da)){
            $pendap=pendapatan($data['pendapatan']);
            $tangg=tanggungan($data['tanggungan']);
            $c1=pencari($pendap,$tangg,1);
            $c2=pencari($pendap,$tangg,2);
            $c3=pencari($pendap,$tangg,3);
            $cluster=cluster($c1,$c2,$c3);
            echo "<tr> <td>".$no."</td>";
            echo " <td>".$data['nama']."</td>";
            echo " <td>".$data['pendapatan']."</td>";
            echo " <td>".$pendap."</td>";
            echo " <td>".$data['tanggungan']."</td>";
            echo " <td>".$tangg."</td>";
            echo " <td>".str_replace(',000','',number_format($c1,3,',',' '))."</td>";
            echo " <td>".str_replace(',000','',number_format($c2,3,',',' '))."</td>";
            echo " <td>".str_replace(',000','',number_format($c3,3,',',' '))."</td>";
            echo " <td>".$cluster."</td>";
            $no++;
        }
        ?>
    </table>
    <?php
?>