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
    <title>Entry Transaksi</title>
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
.databes{
    margin-top: 15px;
}
.databes table{
    border:none;

}

.databes .lunas{
    background-color: green;
    color:white;
    padding: 3px;
    border-radius: 3px 3px 3px 3px;
}

.databes .bayar{
    color:red;
    font-style: bold;
}

.databes .belum{
    padding: 3px;
    border-radius: 3px 3px 3px 3px;
}

.databes .hapus{
    background-color: red;
    color:white;
    padding: 3px;
    border-radius: 3px 3px 3px 3px;
}
</style>
</head>
<body>
<h1 id="judul">Selamat Datang Di Aplikasi pembayaran SPP SMK Namira</h1>
<div class="header">
    <div class="header-list">
       <ul>
          <li><a href="home.php">BACK</a></li>
          <li><a href="tambah_transaksi.php">TAMBAH TRANSAKSI</a></li>
          <li><a href="history.php">HISTORY</a></li>
       </ul>
    </div>
</div>
<div class="databes">
    <center>
        <h1>Transaksi</h1><br>
    <table border='3' cellspacing='0' cellpadding='5' bgcolor='#D3D3D3'>
        <tr>
            <td><b>No. </b></td>
            <td><b>Nama Petugas</b></td>
            <td><b>Nama Siswa</b></td>
            <td><b>Tgl/Bulan/Tahun dibayar</b></td>
            <td><b>Tahun / Nominal harus dibayar</b></td>
            <td><b>Jumlah yang dibayar</b></td>
            <td><b>Status</b></td>
            <td><b>Aksi</b></td>
            <td><b>Hapus</b></td>
        </tr>
<?php
$data = mysqli_query($conn, "SELECT * FROM pembayaran");
$sql = mysqli_query($conn, "SELECT * FROM pembayaran
JOIN petugas ON pembayaran.id_petugas = petugas.id_petugas 
JOIN siswa ON pembayaran.nisn = siswa.nisn
JOIN spp ON pembayaran.id_spp = spp.id_spp
ORDER BY tgl_bayar");
$no = 1;
while($data = mysqli_fetch_assoc($sql)){ ?>
        <tr>
            <td><?= $no ?></td>
            <td><?= $data['nama_petugas']; ?></td>
            <td><?= $data['nama']; ?></td>
            <td><?= $data['tgl_bayar'] . "/" . $data['bulan_dibayar'] . "/" . $data['tahun_dibayar']; ?></td>
            <td><?= $data['tahun'] . " | Rp. " . $data['nominal']; ?></td>
            <td><?= $data['jumlah_bayar']; ?></td>
            <td>
<?php

if($data['jumlah_bayar'] == $data['nominal']){ ?>
                <font style="color: white; font-weight:bold;" class="lunas">Lunas</font>
<?php }else{ ?>
    <font style="color: black; font-weight:bold;"class="belum">Belum Lunas</font> <?php } ?> </td>
            <td>
<?php
if($data['jumlah_bayar'] == $data['nominal']){ echo "-";
}else{ ?>
    <a href="?lunas&id=<?= $data['id_pembayaran']; ?>" class="bayar">Bayar Lunas</a>
<?php } ?> <td><a href="hapus_transaksi.php?id=<?php echo $data['id_pembayaran']; ?>" class="hapus">Hapus</a></td> </td>

        </tr>
<?php $no++; } ?>

    </table>
</div>
</center>
</body>
</html>
<?php
if(isset($_GET['lunas'])){
    $id = $_GET['id'];
    $ambilData = mysqli_query($conn, "SELECT * FROM pembayaran JOIN spp ON pembayaran.id_spp=spp.id_spp 
                                    WHERE id_pembayaran = '$id'");
    $row = mysqli_fetch_assoc($ambilData);
    $sisa = $row['nominal'] - $row['jumlah_bayar'];
    $hasil = $row['jumlah_bayar'] + $sisa;
    $update = mysqli_query($conn, "UPDATE pembayaran SET jumlah_bayar='$hasil' WHERE id_pembayaran='$id'");
    if($update){
        header("location: transaksi.php");
    }
}
?>