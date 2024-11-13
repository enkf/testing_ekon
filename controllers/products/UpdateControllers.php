
<?php
include '../../config/koneksi.php';
    $id_prods = $_POST['id_prods'];
    $names = $_POST['names'];
    $satuans = $_POST['satuans'];
    $jumlahs = $_POST['jumlahs'];
    $statused = $_POST['statused'];

    $SqlUPDATE = "UPDATE products SET nama_products='$names', satuan='$satuans',jumlah='$jumlahs', status_products='$statused' WHERE id_products='$id_prods'";

   
if (mysqli_query($koneksi, $SqlUPDATE)) {
    echo "<div class='spinner-border' role='status'>
          <span class='sr-only'>Data Berhasil Diupdate.!!!</span></div>";
  } else {
    echo "ERROR: Could not able to execute $SqlUPDATE. " . mysqli_error($koneksi);
  }
  

    echo '<meta http-equiv="Refresh" content="2; URL=../../v_product">';
  
?>
