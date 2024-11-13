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
                        <h1 class="modal-title fs-5" id="staticBackdropLabel"><font color="#fff">Data Produk</font></h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="form group-row">
                            <label align="start" for="inputPassword" class="col-sm-2 col-form-label">Nama</label>
                            <input type="text" name="names" id="names" class="form-control" placeholder="Massukan Nama" required>
                            <label align="start" for="inputPassword" class="col-sm-2 col-form-label">Satuan</label>
                            <select name="satuans" id="satuans" class="form-control">
                                <option>--Pilih Satuan</option>
                                <option value="Pcs">Pcs</option>
                                <option value="Kg">Kg</option>
                                <option value="Gram">Gram</option>
                            </select>
                            <label align="start" for="inputPassword" class="col-sm-2 col-form-label">Jumlah</label>
                            <input type="number" name="jumlahs" id="jumlahs" class="form-control" placeholder="" required>
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
                    <th style="text-align:center">Satuan</th>
                    <th style="text-align:right">Jumlah</th>
                    <th style="text-align:center">Status</th>
                    <th style="text-align:center">Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                include './config/koneksi.php';
                $no = 1;
                $SQL = "SELECT * FROM products";
                $cons = $koneksi->prepare($SQL);
                $cons->execute();
                $res = $cons->get_result();
                while ($row = $res->fetch_assoc()) {
                    $id = $row['id_products'];
                    $status = $row['status_products'];
                    $aktif = "Aktif";
                    $tidakaktif = "Tidak Aktif";
                    $urlDelete = "./controllers/products/DeleteControllers.php?idProds=" . $id;
                    $urlUpdate = "./controllers/products/UpdateControllers.php";

                ?>
                    <tr>
                        <td style="text-align:center"><?= $no++ ?></td>
                        <td><?= $row['nama_products'] ?></td>
                        <td style="text-align:center"><?= $row['satuan'] ?></td>
                        <td style="text-align:right"><?= $row['jumlah'] ?></td>
                        <td style="text-align:center"> <?php if ($status == '1') {
                                    echo $aktif;
                                } else {
                                    echo $tidakaktif;
                                }
                                ?>
                        </td>
                        <td style="text-align:center"><button type="button" class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#exampleModal<?php echo $row['id_products'] ?>">
                                <font color="#fff">Edit</font>
                            </button>
                            <a type="button" href="<?= $urlDelete ?>" class="btn btn-danger btn-sm">
                                Hapus</a>
                        </td>

                    </tr>

                    <div class="modal fade" id="exampleModal<?php echo $row['id_products']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                                            <input hidden type="text" name="id_prods" id="id_prods" class="form-control" value="<?= $row['id_products']; ?>">
                                            <input type="text" name="names" id="names" class="form-control" value="<?= $row['nama_products']; ?>">
                                            <label align="start" for="inputPassword" class="col-sm-2 col-form-label">Satuan</label>
                                            <select name="satuans" id="satuans" class="form-control">
                                                <option value="<?= $row['satuan']; ?>"><?= $row['satuan'] ?></option>
                                                <option value="Pcs">Pcs</option>
                                                <option value="Kg">Kg</option>
                                                <option value="Gram">Gram</option>
                                            </select>
                                            <label align="start" for="inputPassword" class="col-sm-2 col-form-label">Jumlah</label>
                                           <input type="number" name="jumlahs" id="jumlahs" value="<?= $row['jumlah'] ?>" class="form-control">
                                            <label align="start" for="inputPassword" class="col-sm-2 col-form-label">Status</label>
                                            <select name="statused" id="statused" class="form-control">
                                                <?php
                                                $status = "Aktif";
                                                $statusnot = "Tidak Aktif";

                                                ?>
                                                <option value="<?= $row['status_products']; ?>">
                                                    <?php
                                                    if ($row['status_products'] == '1') {
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
                                        <button type="button" class="btn btn-danger btn-sm" data-bs-dismiss="modal">Close</button>
                                        <button type="submit" name="update" class="btn btn-primary btn-sm">Update</button>
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
    $satuans = $_POST['satuans'];
    $jumlahs = $_POST['jumlahs'];
    $statused = $_POST['statused'];
    $dateInput = date('Y-m-d H:i:s');

    $SqlInsert = "INSERT INTO products(nama_products,satuan,jumlah,status_products,date_input) VALUES('$names','$satuans','$jumlahs','$statused','$dateInput')";

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
        echo 'window.location="v_product.php"</script>';
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