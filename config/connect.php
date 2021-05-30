<?php
        $server		= "localhost"; //sesuaikan dengan nama server
    	$user		= "root"; //sesuaikan username
    	$password	= ""; //sesuaikan password
    	$database	= "mapping_db"; //sesuaikan target databese
    	$connect = mysqli_connect($server, $user, $password,$database) or die ("Koneksi gagal!");
    	$connect->set_charset('utf8mb4');    
    
	

?>