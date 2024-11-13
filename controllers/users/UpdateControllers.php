
<?php
include '../../config/koneksi.php';
    $idUser = $_POST['id_user'];
    $names = $_POST['names'];
    $passwords = $_POST['passwords'];
    $statused = $_POST['statused'];

    $SqlUPDATE = "UPDATE users SET nama_users='$names', password='$passwords', status='$statused' WHERE id_users='$idUser'";

   
if (mysqli_query($koneksi, $SqlUPDATE)) {
    echo "<div class='spinner-border' role='status'>
          <span class='sr-only'>Data Berhasil Diupdate.!!!</span></div>";
  } else {
    echo "ERROR: Could not able to execute $SqlUPDATE. " . mysqli_error($koneksi);
  }
  
  
    echo '<meta http-equiv="Refresh" content="2; URL=../../v_user.php">';
  
?>
