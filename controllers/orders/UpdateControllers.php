
<?php
include '../../config/koneksi.php';
$id_orders = $_POST['id_orders'];
$id_prods = $_POST['id_prods'];
$jumlahs = $_POST['jumlahs'];
$status = $_POST['status'];


$SQL_cek_product = "SELECT * FROM products WHERE id_products='$id_prods'";
$cons = $koneksi->prepare($SQL_cek_product);
$cons->execute();
$res = $cons->get_result();
while ($row = $res->fetch_assoc()) {
    $jumlah = $row['jumlah'];
    $hasil = $jumlah - $jumlah;
}

$SQL_Stock = "UPDATE products SET jumlah='$hasil' WHERE id_products='$id_prods'";
if (mysqli_query($koneksi, $SQL_Stock)) {
    echo "-";
} else {
    echo "ERROR: Could not able to execute $SQL_Stock. " . mysqli_error($koneksi);
}

$SqlUPDATE = "UPDATE orders SET status_orders='$status'WHERE id_orders='$id_orders'";


if (mysqli_query($koneksi, $SqlUPDATE)) {
    echo "<div class='spinner-border' role='status'>
          <span class='sr-only'>Data Berhasil</span></div>";
} else {
    echo "ERROR: Could not able to execute $SqlUPDATE. " . mysqli_error($koneksi);
}


echo '<meta http-equiv="Refresh" content="2; URL=../../v_order">';

?>
