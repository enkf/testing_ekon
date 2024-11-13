
<?php
include '../../config/koneksi.php';
$idorders = $_GET['idorders'];
$SqlUPDATE = "UPDATE orders SET status_orders='0'WHERE id_orders='$idorders'";


if (mysqli_query($koneksi, $SqlUPDATE)) {
    echo "<div class='spinner-border' role='status'>
          <span class='sr-only'>Data Berhasil DiRejec..!!!</span></div>";
} else {
    echo "ERROR: Could not able to execute $SqlUPDATE. " . mysqli_error($koneksi);
}


echo '<meta http-equiv="Refresh" content="2; URL=../../v_order">';

?>
