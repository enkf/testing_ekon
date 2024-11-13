<?php
include './header/header.php';
include './sidebar/sidebar.php';
?>
<?php 
 include './config/koneksi.php';
 $date = date("m/Y");
 $char = "INV-";
 $total;
 $querys = "SELECT max(id_orders) as maxKode FROM orders";
 $cons = $koneksi->prepare($querys);
                $cons->execute();
                $res = $cons->get_result();
                while ($data = $res->fetch_assoc()) {
                $idMax = $data['maxKode'];
                $kodeBarang = $idMax;
                $kodeBarang = str_replace($char, '', $kodeBarang);
                $noUrut = (int) $kodeBarang;
                $noUrut++;
                $noUrut= sprintf('%04s', $noUrut);
                $newID = $char . $noUrut;
                }
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
                        <h1 class="modal-title fs-5" id="staticBackdropLabel"><font color="#fff">Data Order</font></h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="form group-row">
                            <label align="start" for="inputPassword" class="col-sm-2 col-form-label">No Invoice</label>
                            <input type="text" name="noinvs" id="noinvs" class="form-control" value="<?= $newID ?>" required>
                            <label align="start" for="inputPassword" class="col-sm-2 col-form-label">Nama</label>
                            <select name="names" id="names" class="form-control">
                                <option>--Pilih Product--</option>
                            <?php 
                                 $SQL_Prods = "SELECT * FROM products";
                                 $consProd = $koneksi->prepare($SQL_Prods);
                                 $consProd->execute();
                                 $resProd = $consProd->get_result();
                                 while ($rowProd = $resProd->fetch_assoc()) {
                                ?>
                               
                                <option value="<?= $rowProd['id_products'] ?>"><?= $rowProd['nama_products'] ?></option>
                                
                                <?php 
                                 }
                                 ?>
                            </select>
                            <label align="start" for="inputPassword" class="col-sm-2 col-form-label">Satuan</label>
                            <select name="satuans" id="satuans" class="form-control">
                              
                            </select>
                            <label align="start" for="inputPassword" class="col-sm-2 col-form-label">Jumlah</label>
                            <input type="number" name="jumlahs" id="jumlahs" class="form-control" placeholder="" required>
                            <label align="start" for="inputPassword" class="col-sm-2 col-form-label">Customer</label>
                            <select name="customers" id="customers" class="form-control" required>
                             <option>--Pilih Customer--</option>
                                <?php 
                                 $SQL_Customer = "SELECT * FROM customers";
                                 $consCus = $koneksi->prepare($SQL_Customer);
                                 $consCus->execute();
                                 $resCus = $consCus->get_result();
                                 while ($rowCus = $resCus->fetch_assoc()) {
                                ?>
                               
                                <option value="<?= $rowCus['id_cust'] ?>"><?= $rowCus['nama_cust'] ?></option>
                                
                                <?php 
                                 }
                                 ?>
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
                    <th style="text-align:center">Invoice</th>
                    <th>Nama</th>
                    <th style="text-align:center">Satuan</th>
                    <th style="text-align:right">Quantity</th>
                    <th style="text-align:left">Customer</th>
                    <th style="text-align:center">Status</th>
                    <th style="text-align:center">Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                include './config/koneksi.php';
                $no = 1;
                $SQL = "SELECT * FROM orders a 
                            LEFT JOIN products b ON b.id_products = a.id_product
                            LEFT JOIN customers c ON c.id_cust = a.id_cust";
                $cons = $koneksi->prepare($SQL);
                $cons->execute();
                $res = $cons->get_result();
                while ($row = $res->fetch_assoc()) {
                    $id = $row['id_orders'];
                    $status = $row['status_orders'];
                    $waiting = "Waiting";
                    $success = "Approved";
                    $reject = "Reject";
                    $urlUpdate = "./controllers/orders/UpdateControllers.php";
                    $urlUpdateqty ="./controllers/orders/UpdateQTYControllers.php";
                    $urlReject ="./controllers/orders/RejectControllers.php?idorders=".$id;

                ?>
                    <tr>
                        <td style="text-align:center"><?= $no++ ?></td>
                        <td style="text-align:center"><?= $row['no_invoice'] ?></td>
                        <td><?= $row['nama_products'] ?></td>
                        <td style="text-align:center"><?= $row['satuan'] ?></td>
                        <td style="text-align:right"><?= $row['qty'] ?></td>
                        <td style="text-align:left"><?= $row['nama_cust'] ?></td>
                        <td style="text-align:center"> 
                            <?php if ($status == '1') {
                                    echo '<span class="badge text-bg-warning"><font color="#fff">'.$waiting.'</font></span>';
                                } elseif($status =='2') {
                                    echo '<span class="badge text-bg-success"><font color="#fff">'.$success.'</font></span>';
                                }else{
                                    echo '<span class="badge text-bg-danger"><font color="#fff">'.$reject.'</font></span>';
                                }
                                ?>
                        </td>
                        <td style="text-align:center"><button type="button" class="btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#exampleModal<?php echo $row['id_orders'] ?>">
                                <font color="#fff">Approve</font>
                            </button>
                            <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#exampleModalEdit<?php echo $row['id_orders'] ?>">
                                <font color="#fff">Edit</font>
                            </button>
                            <a type="button" class="btn btn-danger btn-sm" href="<?= $urlReject ?>">
                                <font color="#fff">Reject</font>
                            </a>
                        
                        </td>

                    </tr>

                    <div class="modal fade" id="exampleModal<?php echo $row['id_orders']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="exampleModalLabel">Status</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <form action="<?= $urlUpdate ?>" method="post" enctype="multipart/form-data">
                                    <div class="modal-body">
                                        <div class="form group-row">
                                        <input hidden type="text" name="id_orders" id="id_orders" class="form-control" value="<?= $row['id_orders']; ?>">
                                            <input hidden type="text" name="id_prods" id="id_prods" class="form-control" value="<?= $row['id_products']; ?>">
                                            <input hidden type="text" name="jumlahs" id="jumlahs" class="form-control" value="<?= $row['qty']; ?>">
                                            <label align="start" for="inputPassword" class="col-sm-2 col-form-label">Status</label>
                                            <select name="status" id="status" class="form-control">
                                                <?php
                                                 if ($status == '1') {
                                                   echo '<option value="'.$row['status_orders'].'">Waiting</option>';
                                                } elseif($status =='2') {
                                                    echo '<option value="'.$row['status_orders'].'">Approved</option>';
                                                }else{
                                                    echo '<option value="'.$row['status_orders'].'">Reject</option>';
                                                }
                                                ?>
                                                
                                                <option value="1">Waiting</option>
                                                <option value="2">Approved</option>
                                                <option value="0">Reject</option>
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
                        </div>
                        <div class="modal fade" id="exampleModalEdit<?php echo $row['id_orders']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="exampleModalLabel">Edit Jumlah</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <form action="<?= $urlUpdateqty ?>" method="post" enctype="multipart/form-data">
                                    <div class="modal-body">
                                        <div class="form group-row">
                                        <label align="start" for="inputPassword" class="col-sm-2 col-form-label">Jumlah</label>
                                        <input type="text" name="qtys" id="qtys" class="form-control" value="<?= $row['qty']; ?>">
                                        <input hidden type="text" name="id_orders" id="id_orders" class="form-control" value="<?= $row['id_orders']; ?>">
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
if (!empty($_POST['noinvs'])) {
    $noinvs = $_POST['noinvs'];
    $names = $_POST['names'];
    $satuans = $_POST['satuans'];
    $jumlahs = $_POST['jumlahs'];
    $customers = $_POST['customers'];
    $dateInput = date('Y-m-d H:i:s');

    $SqlInsert = "INSERT INTO orders(no_invoice,id_cust,id_product,satuan,qty,status_orders,date_input) VALUES('$noinvs','$customers','$names','$satuans','$jumlahs','1','$dateInput')";
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
        echo 'window.location="v_order.php"</script>';
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
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

<script type="text/javascript">
	$('#names').change(function() { 
		var names = $(this).val(); 
		$.ajax({
			type: 'POST', 
			url: 'ajax_product.php', 
			data: 'id_products=' + names, 
			success: function(response) { 
				$('#satuans').html(response); 
			}
		});
	});
 
</script>
<?php
include './footer/footer.php';
?>