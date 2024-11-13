<?php
include '../../config/koneksi.php';
    $idUser = $_GET['idUser'];
    $SqlUPDATE = "DELETE FROM users WHERE id_users='$idUser'";
   
if (mysqli_query($koneksi, $SqlUPDATE)) {
    echo "<div class='spinner-border' role='status'>
          <span class='sr-only'>Data Berhasil Didelete.!!!</span></div>";
  } else {
    echo "ERROR: Could not able to execute $SqlUPDATE. " . mysqli_error($koneksi);
  }
  
  
    echo '<meta http-equiv="Refresh" content="2; URL=../../v_user.php">';
  
?>
