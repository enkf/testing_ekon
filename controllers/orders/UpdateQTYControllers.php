
<?php
include '../../config/koneksi.php';
$id_orders = $_POST['id_orders'];
$qtys = $_POST['qtys'];


$SqlUPDATE = "UPDATE orders SET qty='$qtys'WHERE id_orders='$id_orders'";


if (mysqli_query($koneksi, $SqlUPDATE)) {
    echo "<div class='spinner-border' role='status'>
          <span class='sr-only'>Jumlah Berhasil Diupdate</span></div>";
} else {
    echo "ERROR: Could not able to execute $SqlUPDATE. " . mysqli_error($koneksi);
}


echo '<meta http-equiv="Refresh" content="2; URL=../../v_order">';

?>
