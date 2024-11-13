<?php
    $host   = 'localhost'; // atur host
    $user   = 'root'; // atur user database
    $pass   = '';   // atur pass database
    $dbname = 'testing'; // atur nama database

    
    $koneksi = mysqli_connect($host, $user, $pass, $dbname);


    if(mysqli_connect_errno()){
        echo 'Gagal melakukan koneksi ke Database : '.mysqli_connect_error();
    }else{
        echo '';
    }