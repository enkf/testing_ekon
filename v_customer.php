<?php
include './header/header.php';
include './sidebar/sidebar.php';
?>
<div class="continer">

    <div class="card-body">
        &nbsp;&nbsp;
        <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
            + Tambah
        </button>

        <!-- Modal -->
        <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog">
                <form action="" method="post" enctype="multipart/form-data" class="modal-content">
                    <div class="modal-header bg-dark">
                        <h1 class="modal-title fs-5" id="staticBackdropLabel"><font color="#fff">Data Customer</font></h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="form group-row">
                            <label align="start" for="inputPassword" class="col-sm-2 col-form-label">Nama</label>
                            <input type="text" name="names" id="names" class="form-control" placeholder="Massukan Nama" required>
                            <label align="start" for="inputPassword" class="col-sm-2 col-form-label">Telp</label>
                            <input type="number" name="telps" id="telps" class="form-control" placeholder="Massukan No. Telp" required>
                            <label align="start" for="inputPassword" class="col-sm-2 col-form-label">Alamat</label>
                            <textarea type="text" name="alamats" id="alamats" class="form-control" placeholder="Masukkan Alamat" required></textarea>
                            <label align="start" for="inputPassword" class="col-sm-2 col-form-label">Status</label>
                            <select name="statused" id="statused" class="form-control" required>
                                <option>--Pilih Status--</option>
                                <option value="1">Aktif</option>
                                <option value="0">Tidak Aktif</option>
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger btn-sm" data-bs-dismiss="modal">Close</button>
                        <button type="submit" name="simpan" class="btn btn-success btn-sm">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="table-responsive">
        <table id="data" class="table table-striped table-bordered">
            <thead>
                <tr>
                    <th style="text-align:center">No</th>
                    <th>Nama</th>
                    <th style="text-align:center">Telp</th>
                    <th>Alamat</th>
                    <th style="text-align:center">Status</th>
                    <th style="text-align:center">Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                include './config/koneksi.php';
                $no = 1;
                $SQL = "SELECT * FROM customers";
                $cons = $koneksi->prepare($SQL);
                $cons->execute();
                $res = $cons->get_result();
                while ($row = $res->fetch_assoc()) {
                    $id = $row['id_cust'];
                    $status = $row['status'];
                    $aktif = "Aktif";
                    $tidakaktif = "Tidak Aktif";
                    $urlDelete = "./controllers/customers/DeleteControllers.php?idCust=" . $id;
                    $urlUpdate = "./controllers/customers/UpdateControllers.php";

                ?>
                    <tr>
                        <td style="text-align:center"><?= $no++ ?></td>
                        <td><?= $row['nama_cust'] ?></td>
                        <td style="text-align:center"><?= $row['no_telp'] ?></td>
                        <td><?= $row['alamat_cust'] ?></td>
                        <td style="text-align:center"> <?php if ($status == '1') {
                                    echo $aktif;
                                } else {
                                    echo $tidakaktif;
                                }
                                ?>
                        </td>
                        <td style="text-align:center"><button type="button" class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#exampleModal<?php echo $row['id_cust'] ?>">
                                <font color="#fff">Edit</font>
                            </button>
                            <a type="button" href="<?= $urlDelete ?>" class="btn btn-danger btn-sm">
                                Hapus</a>
                        </td>

                    </tr>

                    <div class="modal fade" id="exampleModal<?php echo $row['id_cust']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="exampleModalLabel">Edit User</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <form action="<?= $urlUpdate ?>" method="post" enctype="multipart/form-data">
                                    <div class="modal-body">
                                        <div class="form group-row">
                                            <label align="start" for="inputPassword" class="col-sm-2 col-form-label">Nama</label>
                                            <input hidden type="text" name="id_cust" id="id_cust" class="form-control" value="<?= $row['id_cust']; ?>">
                                            <input type="text" name="names" id="names" class="form-control" value="<?= $row['nama_cust']; ?>">
                                            <label align="start" for="inputPassword" class="col-sm-2 col-form-label">Telp</label>
                                            <input type="text" name="telps" id="telps" class="form-control" value="<?= $row['no_telp']; ?>">
                                            <label align="start" for="inputPassword" class="col-sm-2 col-form-label">Alamat</label>
                                            <textarea type="text" name="alamats" id="alamats" class="form-control" value="<?= $row['alamat_cust']; ?>"><?= $row['alamat_cust']; ?></textarea>
                                            <label align="start" for="inputPassword" class="col-sm-2 col-form-label">Status</label>
                                            <select name="statused" id="statused" class="form-control">
                                                <?php
                                                $status = "Aktif";
                                                $statusnot = "Tidak Aktif";

                                                ?>
                                                <option value="<?= $row['status']; ?>">
                                                    <?php
                                                    if ($row['status'] == '1') {
                                                        echo $status;
                                                    } else {
                                                        echo $statusnot;
                                                    }
                                                    ?></option>
                                                <option value="1">Aktif</option>
                                                <option value="0">Tidak Aktif</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                        <button type="submit" name="update" class="btn btn-primary">Update</button>
                                    </div>
                                </form>
                            </div>
                        </div>

                    <?php
                }
                    ?>
            </tbody>
        </table>
    </div>
</div>
</div>
<?php
include './config/koneksi.php';
if (!empty($_POST['names'])) {
    $names = $_POST['names'];
    $telps = $_POST['telps'];
    $alamats = $_POST['alamats'];
    $statused = $_POST['statused'];
    $dateInput = date('Y-m-d H:i:s');

    $SqlInsert = "INSERT INTO customers(nama_cust,no_telp,alamat_cust,status,date_input) VALUES('$names','$telps','$alamats','$statused','$dateInput')";

    if (mysqli_query($koneksi, $SqlInsert)) {
        echo "<script type='text/javascript'>";
        echo "swal({
        title: 'Your Message Was Sent Successfully',
        type: 'success',

        confirmButtonColor: '#DD6B55',
        confirmButtonText: 'Close',
        }).then(() => {
          if (result.value) {
            // handle Confirm button click
          } else {
            // result.dismiss can be 'cancel', 'overlay', 'esc' or 'timer'
          }
        });";
        echo 'window.location="v_customer.php"</script>';
    } else {
        echo "<script>
              Swal.fire({
                title: 'Error!',
                text: 'Data gagal disimpan.',
                icon: 'error',
                confirmButtonText: 'Coba lagi'
              });
            </script>";
    }
}
?>

<?php
include './footer/footer.php';
?>