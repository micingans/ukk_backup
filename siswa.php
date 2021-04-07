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
    <title>DATA SISWA</title>
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
    margin-top: -1150px;
}
.databes table{
    border:none;
}

.databes .hapus{
    background-color: red;
    color:white;
    padding: 3px;
    border-radius: 3px 3px 3px 3px;
}
.databes .detail{
    background-color: green;
    color:white;
    padding: 3px;
    border-radius: 3px 3px 3px 3px;
}

.databes .edit{
    background-color: blue;
    color:white;
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
          <li><a href="home.php">BACK</a></li>
          <li><a href="tambah_siswa.php">TAMBAH INPUT</a></li>
          <li><a href="search_siswa.php">SEARCH</a></li>
       </ul>
    </div>
</div> 
<br> 
<div class="container">
    <center><h1>Data Siswa</h1></center>
</div>
<div class="databes">
<center>
<?php
    $sql = "SELECT * FROM siswa JOIN kelas ON siswa.id_kelas = kelas.id_kelas";
    $tampil = mysqli_query($conn, $sql); 
    $strTbl = "";
    $strTbl .= "<table border='3' cellpadding='3' bgcolor='#D3D3D3'>";
    $strTbl .= "<tr>";
    $strTbl .= "<th>No</th>";
    $strTbl .= "<th>NISN</th>";
    $strTbl .= "<th>NIS</th>";
    $strTbl .= "<th>Nama</th>";
    $strTbl .= "<th>Kelas</th>";
    $strTbl .= "<th>Alamat</th>";
    $strTbl .= "<th>No. Telp</th>";
    $strTbl .= "<th>ID SPP</th>";
    $strTbl .= "<th>Edit Data</th>";
    $strTbl .= "<th>Detail</th>";
    $strTbl .= "<th>Hapus</th>";
    $strTbl .= "</tr>";
    $nisn     = 1;

    if(mysqli_num_rows($tampil) > 0){

         while($data = mysqli_fetch_assoc($tampil))  {

            $strTbl .= "<tr>";
            $strTbl .= "<td>". $nisn. "</td>";
            $strTbl .= "<td>". $data['nisn']."</td>";
            $strTbl .= "<td>". $data['nis']."</td>";
            $strTbl .= "<td>". $data['nama']."</td>";
            $strTbl .= "<td>". $data['nama_kelas']. " | ". $data['kompetensi_keahlian']. "</td>";
            $strTbl .= "<td>". $data['alamat']."</td>";
            $strTbl .= "<td>". $data['no_telp']."</td>";
            $strTbl .= "<td>". $data['id_spp']."</td>";
            $strTbl .= "<td><a href='edit_siswa.php?id=".$data['nisn']."' class='edit'> Edit Data </a></td>";     
            $strTbl .= "<td><a href='detail_siswa.php?id=".$data['nisn']."' class='detail'> Lihat Detail </a></td>";       
            $strTbl .= "<td><a href='javascript:hapusData(".$data['nisn'].")' class='hapus'>Hapus Data </a></td>";
            $strTbl .= "</tr>";
            $nisn++;
         }
     }

         else{
            $strTbl .="<tr><td colspan='4'>Maaf Data Kosong, Silahkan Tambahkan Terlebih Dahulu</td></tr>";
         }
         $strTbl .="</table>";
         
         print($strTbl);

         ?>
    <script language="javascript" type="text/javascript">

        function hapusData(nisn){

            if(confirm("Apakah Anda yakin akan menghapus data ini?")){

                window.location.href='hapus_siswa.php?id=' + nisn;
            }
        }
    </script>
</center>
</div>
</body>
</html>