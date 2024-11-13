<?php
include '../../config/koneksi.php';
    $idCust = $_GET['idCust'];
    $SqlUPDATE = "DELETE FROM customers WHERE id_cust='$idCust'";
   
if (mysqli_query($koneksi, $SqlUPDATE)) {
    echo "<div class='spinner-border' role='status'>
          <span class='sr-only'>Data Berhasil Didelete.!!!</span></div>";
  } else {
    echo "ERROR: Could not able to execute $SqlUPDATE. " . mysqli_error($koneksi);
  }
  
  
    echo '<meta http-equiv="Refresh" content="2; URL=../../v_customer">';
  
?>
