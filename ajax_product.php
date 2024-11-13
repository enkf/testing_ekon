<?php 
include("./config/koneksi.php");
$names = $_POST['id_products'];
$tampil=mysqli_query($koneksi,"SELECT * FROM products WHERE id_products='$names'");
$jml=mysqli_num_rows($tampil);
 
if($jml > 0){    
    while($r=mysqli_fetch_array($tampil)){
        ?>
        <option value="<?php echo $r['satuan'] ?>"><?php echo $r['satuan'] ?></option>
        <?php        
    }
}else{
    echo "<option selected>- Data Product Tidak Ada, Pilih Yang Lain -</option>";
}
 
?>