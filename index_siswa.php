<?php
session_start();
require_once("koneksi.php");
if(!isset($_SESSION['nisn'])){
    header("location: login_siswa.php");
}else{
    $nisn = $_SESSION['nisn'];
}
$siswa = mysqli_query($conn, "SELECT * FROM siswa 
JOIN kelas ON siswa.id_kelas=kelas.id_kelas 
WHERE nisn='$nisn'");
$hasil = mysqli_fetch_assoc($siswa);
$pembayaran = mysqli_query($conn, "SELECT * FROM pembayaran 
JOIN petugas ON pembayaran.id_petugas = petugas.id_petugas 
JOIN spp ON pembayaran.id_spp = spp.id_spp
WHERE nisn='$nisn'
ORDER BY tgl_bayar");
?>
<!DOCTYPE html>
<html>
<head>
    <meta>
    <title>Siswa</title>
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

.container{
    width: 1250px;
    height: 1200px;
    margin-top: 5px;    
}
.databes p{
   font-size: 25px; 
}

.databes{
    margin-top: -1050px;
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

.databes .belum{
    padding: 3px;
    border-radius: 3px 3px 3px 3px;
}
  </style>
</head>
<body>
<h1 id="judul">Selamat Datang Di Aplikasi pembayaran SPP</h1>
<div class="header">
    <div class="header-list">
       <ul>
          <li><a href="logout.php">Log Out</a></li>
          <li><a href="#">SISWA</a></li>
       </ul>
    </div>
</div>
<div class="container">
        <img src="images/admin.png" height="110px" width="115px">
        <br>
        <p>>>Selamat Datang, <b><?= $hasil['nama']; ?></b><<</p>
</div>

<div class="databes">
    <hr/>
    <br>
    <center><p>Biodata Kamu</p></center>
    <br>
    <table cellpadding="5" id="biodata">
        <tr>
            <td>NISN</td>
            <td>:</td>
            <td><b><?= $hasil['nisn']; ?></b></td>
        </tr>
        <tr>
            <td>NIS</td>
            <td>:</td>
            <td><b><?= $hasil['nis']; ?></b></td>
        </tr>
        <tr>
            <td>Nama</td>
            <td>:</td>
            <td><b><?= $hasil['nama']; ?></b></td>
        </tr>
        <tr>
            <td>Kelas</td>
            <td>:</td>
            <td><b><?= $hasil['nama_kelas'] . " | " . $hasil['kompetensi_keahlian']; ?></b></td>
        </tr>
        <tr>
            <td>Alamat</td>
            <td>:</td>
            <td><b><?= $hasil['alamat']; ?></b></td>
        </tr>
        <tr>
            <td>No. Telp</td>
            <td>:</td>
            <td><b><?= $hasil['no_telp']; ?></b></td>
        </tr>
        <tr>
            <td>ID SPP</td>
            <td>:</td>
            <td><b><?= $hasil['id_spp']; ?></b></td>
        </tr>
    </table>
    <br>
            <hr/>
            <br>
            <br>
    <center><h2>History Pembayaran</h2></center>
    <br>
        <table border='3' cellspacing='0' cellpadding='5' bgcolor='#D3D3D3'>
        <tr>
            <td><b>No. </b></td>
            <td><b>Dibayarkan kepada</b></td>
            <td><b>Tgl. Pembayaran</b></td>
            <td><b>Tahun | Nominal yang harus dibayar</b></td>
            <td><b>Jumlah yang dibayarkan</b></td>
            <td><b>Status</b></td>
        </tr>
<?php
$no = 1;
while($data = mysqli_fetch_assoc($pembayaran)){ ?>
        <tr>
            <td><?= $no; ?></td>
            <td><?= $data['nama_petugas']; ?></td>
            <td><?= $data['tgl_bayar'] . "/" . $data['bulan_dibayar'] . "/" . $data['tahun_dibayar']; ?></td>
            <td><?= $data['tahun'] . " | Rp. " . $data['nominal']; ?></td>
            <td><?= $data['jumlah_bayar']; ?></td>
            <td>
<?php
if($data['jumlah_bayar'] == $data['nominal']){ ?>
                <font style="color: white; font-weight:bold;" class="lunas">Lunas</font>
<?php }else{ ?>
    <font style="color: black; font-weight:bold;"class="belum">Belum Lunas</font> <?php } ?> </td>
        </tr>
    <?php $no++; } ?>
    </table>
</div>
</body>
</html>