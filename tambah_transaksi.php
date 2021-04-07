<?php 
session_start();
require("koneksi.php");

if(!isset($_SESSION['username'])){
    header("location: login.php");
}else{
    $username = $_SESSION['username'];
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Tambah data transaksi</title>
            <style>
    *{margin:0px auto;}
    body{
        font-family: arial;
        background-color: white;
        height: 1625px;
    }

        a{
            text-decoration: none;
        }

li{
    list-style: none;
}

#judul{
    font-style: bold;
    text-align: center;
    font-size: 50px;
    margin-top: 20px;

}

.header{
    background-color:#32CD32;
    width: 1200px;
    padding:25px;
    margin-top: 20px;
}

.header-list li{
    float: left;
    padding: 0 10px;
    margin-top: -10px;
}

li a:hover{
    background-color: white;
    color: black;
}   

.header-list a{
    color: white;
    padding: 20px;
}

.container{
    width: 1250px;
    height: 1200px;
    margin-top: 5px;    
}  

select{
    border: solid 1px grey;
    font-size: 15px;
    border-radius: 5px 5px 5px 5px;
}
.kirim{
    background-color: #32CD32;
    color: white;
    font-size: 15px;
    width: 20%;
    border: none;
    border-radius: 3px;
    padding: 12px;
}
</style>
</head>
<body>
<?php
if(isset($_POST['simpan'])){
    $petugas = $_POST['petugas'];
    $nama = $_POST['siswa'];
    $tgl = $_POST['tgl']; $bulan = $_POST['bulan']; $tahun = $_POST['tahun'];
    $spp = $_POST['spp'];
    $jumlah = $_POST['jumlah'];
    $s = mysqli_query($conn,"INSERT INTO pembayaran VALUES
                ('$petugas', '$nama', '$tgl', '$bulan', '$tahun', '$spp', '$jumlah')");
    if($s){
    header("location: transaksi.php"); 
    }else{
        echo "<script>alert('GAGAL:(')</script>";
    }
}
?>

<h1 id="judul">Selamat Datang Di Aplikasi pembayaran SPP</h1>
<div class="header">
    <div class="header-list">
       <ul>
          <li><a href="home.php">BACK</a></li>
          <li><a href="transaksi.php">TRANSAKSI</a></li>
       </ul>
    </div>
</div>
<div class="container">
    <center>
    <br>
    <h1>Tambah data transaksi</h1>
    <br>
    <form action="" method="POST">
        <table cellpadding="5">
            <tr>
                <td>Petugas :</td>
                <td><select name="petugas">
<?php
$petugas = mysqli_query($conn, "SELECT * FROM petugas");
while($transaksi = mysqli_fetch_assoc($petugas)){ ?>
                        <option value="<?= $transaksi['id_Petugas']; ?>"><?= $transaksi['nama_petugas']; ?></option>
<?php } ?>          </select></td>
            </tr>
            <tr>
                <td>Nama siswa :</td>
                <td><select name="siswa">
<?php
$siswa = mysqli_query($conn, "SELECT * FROM siswa");
while($transaksi = mysqli_fetch_assoc($siswa)){ ?>
                        <option value="<?= $transaksi['nisn']; ?>"><?= $transaksi['nama']; ?></option>
<?php } ?>          </select></td>
            </tr>   
            <tr>
                <td>Tgl. / Bulan / Tahun bayar :</td>
                <td><select name="tgl">
                        <option value="-">Tanggal</option>
                    <?php 
                        for($i=1;$i<=31;$i++)
                            {
                                ?>
                                <option value="<?php echo"$i";?>"><?php echo"$i";?></option>
                                <?php
                            }
                    ?>
                    </select>
                    -
                    <select name="bulan" id="bulan">
                          <?
                          if ($bulan<>"")
                            {
                                if ($bulan==1){
                                    $ket="Januari";
                                }
                                elseif($bulan==2){
                                    $ket="Februari";
                                }
                                elseif($bulan==3){
                                    $ket="Maret";
                                }
                                elseif($bulan==4){
                                    $ket="April";
                                }
                                elseif($bulan==5){
                                    $ket="Mei";
                                }
                                elseif($bulan==6){
                                    $ket="Juni";
                                }
                                elseif($bulan==7){
                                    $ket="Juli";
                                }
                                elseif($bulan==8){
                                    $ket="Agustus";
                                }
                                elseif($bulan==9){
                                    $ket="September";
                                }
                                elseif($bulan==10){
                                    $ket="Oktober";
                                }
                                elseif($bulan==11){
                                    $ket="Nopember";
                                }
                                elseif($bulan==12){
                                    $ket="Desember";
                                }
                                else
                                {
                                }
                            echo "<option value='null'>Bulan</option>";
                            }
                          ?>
                          <option value="Januari">Januari</option>
                          <option value="Februari">Februari</option>
                          <option value="Maret">Maret</option>
                          <option value="April">April</option>
                          <option value="Mei">Mei</option>
                          <option value="Juni">Juni</option>
                          <option value="Juli">Juli</option>
                          <option value="Agustus">Agustus</option>
                          <option value="September">September</option>
                          <option value="Oktober">Oktober</option>
                          <option value="Nopember">Nopember</option>
                          <option value="Desember">Desember</option>
                    </select>
                    -
                    <select name="tahun">
                        <option value="-">Tahun</option>
                    <?php 
                        for($i=2016;$i<=2025;$i++)
                            {
                                ?>
                                <option value="<?php echo"$i";?>"><?php echo"$i";?></option>
                                <?php
                            }
                    ?>
                    </select></td>
            </tr>
            <tr>
                <td>SPP / Nominal yang harus dibayar</td>
                <td><select name="spp">
<?php
$spp = mysqli_query($conn, "SELECT * FROM spp");
while($transaksi = mysqli_fetch_assoc($spp)){ ?>
                        <option value="<?= $transaksi['id_spp']; ?>">
                        <?= $transaksi['tahun'] . " | " . $transaksi['nominal']; ?></option>
<?php } ?>          </select></td>
            </tr>
            <tr>
                <td>Jumlah bayar</td>
                <td><input type="text" name="jumlah" placeholder="Masukin Nominal Pembayaran"></td>
            </tr>
            <tr>
                <td colspan="2"><input type="submit" name="simpan" value="Kirim" class="kirim"></td>
            </tr>
        </table>
    </td>
</tr>
</table>
</form>
</div>
</center>
</body>
</html>