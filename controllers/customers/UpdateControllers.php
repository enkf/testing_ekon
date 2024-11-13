
<?php
include '../../config/koneksi.php';
    $id_cust = $_POST['id_cust'];
    $names = $_POST['names'];
    $telps = $_POST['telps'];
    $alamats = $_POST['alamats'];
    $statused = $_POST['statused'];

    $SqlUPDATE = "UPDATE customers SET nama_cust='$names', no_telp='$telps',alamat_cust='$alamats', status='$statused' WHERE id_cust='$id_cust'";

   
if (mysqli_query($koneksi, $SqlUPDATE)) {
    echo "<div class='spinner-border' role='status'>
          <span class='sr-only'>Data Berhasil Diupdate.!!!</span></div>";
  } else {
    echo "ERROR: Could not able to execute $SqlUPDATE. " . mysqli_error($koneksi);
  }
  

    echo '<meta http-equiv="Refresh" content="2; URL=../../v_customer">';
  
?>
