<?php 
session_start();
require_once("koneksi.php");

if(!isset($_SESSION['username'])){
    header("location: login.php");
}else{
    $username = $_SESSION['username'];
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Form Siswa</title>
    <style type="text/css">
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

.pencarian{
    margin-top: -225px;
    margin-right: 25px;  
}
.container{
    width: 1250px;
    height: 1200px;
    margin-top: 5px;    
}
.databes{
    margin-top: -950px;
}

.databes p{
   font-size: 25px; 
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
    background-color: red;
    color:white;
    padding: 3px;
    border-radius: 3px 3px 3px 3px;
}

.databes .belum{
    padding: 3px;
    border-radius: 3px 3px 3px 3px;
}
.search{
    background-color: grey;
    color: white;
    font-size: 15px;
    width: 5%;
    border: none;
    border-radius: 3px;
    padding: 2px;
}
</style>
</head>
<body>
<h1 id="judul">Selamat Datang Di Aplikasi pembayaran SPP</h1>
<div class="header">
    <div class="header-list">
       <ul>
          <li><a href="logout.php">Log Out</a></li>
          <li><a href="index.php">Admin</a></li>
          <li><a href="form_petugas.php">Petugas</a></li>
          <li><a href="form_siswa.php">Siswa</a></li>
       </ul>
    </div>
</div>

<div class="container">
<table border="1" cellpadding="5" cellspacing="0" width="1250px" height="250px">
 <tr>
    <td colspan="2" align="center">
        <img src="images/admin.png" height="110px" width="135px">
        <br>
        <br>
        <p>>>Selamat Datang,<b> <?= $username; ?></b><<</p> 
    </td>
 </tr>
</table>
 <div class="pencarian">
    <h2 align="right">History Pembayaran Siswa :</h2>
    <form align="right" method="POST" autocomplete="off">
        Cari Siswa <input type="text" name="nisn" placeholder="Cari berdasarkan NISN" autofocus>
        <input type="submit" name="cari" value="Search" class="search">
    </form>
</div>
</div>

<?php
if(isset($_POST['cari'])){
    $nisn = $_POST['nisn'];
    $biodataSiswa = mysqli_query($conn, "SELECT * FROM siswa 
                    JOIN kelas ON siswa.id_kelas = kelas.id_kelas 
                    WHERE nisn = '$nisn'");

    $historyPembayaran = mysqli_query($conn, "SELECT * FROM pembayaran
                         JOIN petugas ON pembayaran.id_petugas = petugas.id_petugas
                         JOIN spp ON pembayaran.id_spp = spp.id_spp
                         WHERE nisn = '$nisn'
                         ORDER BY tgl_bayar");
    $siswaa = mysqli_fetch_assoc($biodataSiswa);
?>
<br>
    <div class="databes">
        <br>
        <hr/>
        <br>
        <center><p>Biodata Siswa</p></center>
        <br>
        <table cellpadding="5">
            <tr>
                <td>NISN</td>
                <td>:</td>
                <td><b><?= $siswaa['nisn']; ?></b></td>
            </tr>
            <tr>
                <td>NIS</td>
                <td>:</td>
                <td><b><?= $siswaa['nis']; ?></b></td>
            </tr>
            <tr>
                <td>Nama</td>
                <td>:</td>
                <td><b><?= $siswaa['nama']; ?></b></td>
            </tr>
            <tr>
                <td>Kelas</td>
                <td>:</td>
                <td><b><?= $siswaa['nama_kelas'] . " | " . $siswaa['kompetensi_keahlian']; ?></b></td>
            </tr>
            <tr>
                <td>Alamat</td>
                <td>:</td>
                <td><b><?= $siswaa['alamat']; ?></b></td>
            </tr>
            <tr>
                <td>No. Telp</td>
                <td>:</td>
                <td><b><?= $siswaa['no_telp']; ?></b></td>
            </tr>
            <tr>
                <td>ID SPP</td>
                <td>:</td>
                <td><b><?= $siswaa['id_spp']; ?></b></td>
            </tr>
        </table>
        <br>
        <hr/>
        <br>
        <br>
        <center><h2>History Pembayaran</h2></center>
        <br>
        <table border='3' cellspacing='0' cellpadding='5' bgcolor='#D3D3D3'>
            <br>
            <tr>
                <td><b>No. </b></td>
                <td><b>Tanggal Pembayaran</b></td>
                <td><b>Pembayaran Melalui</b></td>
                <td><b>Tahun SPP | Nominal yang harus dibayar</b></td>
                <td><b>Jumlah yang sudah dibayar</b></td>
                <td><b>Status</b></td>
                <td><b>Aksi</b></td>
            </tr>
<?php 
$no=1;
while($base = mysqli_fetch_assoc($historyPembayaran)){ ?>
            <tr>
                <td><?= $no; ?></td>
                <td><?= $base['tgl_bayar'] . " " . $base['bulan_dibayar'] . " " .
                        $base['tahun_dibayar']; ?></td>
                <td><?= $base['nama_petugas']; ?></td>
                <td><?= $base['tahun'] . " | Rp. " . $base['nominal']; ?></td>
                <td><?= "Rp. " . $base['jumlah_bayar']; ?></td>
<?php
if($base['jumlah_bayar'] == $base['nominal']){ ?>
                <td><font style="color: white; font-weight: bold;" class="lunas">Lunas</font></td>
                <td>-</td>
<?php }else{ ?> <td><font style="color: black; font-weight: bold;" class="belum">Belum Lunas</font></td>
                <td><a href="transaksi.php?lunas&id=<?= $base['id_pembayaran']; ?>" class="bayar">
                Bayar Lunas</a></td>
<?php } ?>
            </tr>
<?php $no++; }?>
        </table>
<?php } ?>
</div>
</body>
</html>
