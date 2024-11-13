<?php
include './header/header.php';
include './sidebar/sidebar.php';
?>

<div class="continer">

    <div class="card-body">
    <h4>Data Order</h4>
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
                    <th style="text-align:center">Tanggal</th>
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
                        <td style="text-align:center"><?= date('d M Y',strtotime($row['date_input'])) ?></td>
                      

                    </tr>

                    <?php
                }
                    ?>
            </tbody>
        </table>
    </div>
</div>
</div>

<?php
include './footer/footer.php';
?>