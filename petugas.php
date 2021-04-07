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
    <title>DATA PETUGAS</title>
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
    font-size: 60px;
    margin-top: 20px;

}

.header{
    border-radius: 10px;
    background-color:#32CD32;
    width: 1200px;
    padding:25px;
    margin-top: 15px;
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
    background-color: white;
}
.database{
    margin-top: -1150px;
}
.database table{
    border:none;
}

.database .hapus{
    background-color: red;
    color:white;
    padding: 3px;
    border-radius: 3px 3px 3px 3px;
}
.database .detail{
    background-color: green;
    color:white;
    padding: 3px;
    border-radius: 3px 3px 3px 3px;
}

.database .edit{
    background-color: blue;
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
          <li><a href="tambah_petugas.php">TAMBAH INPUT</a></li>
          <li><a href="search_petugas.php">SEARCH</a></li>
       </ul>
    </div>
</div>  
<br>
<div class="container">
    <center><h1>Data Petugas</h1></center>
</div>
<div class="database">
<center>
<?php
    $sql = "SELECT * FROM petugas";
    $tampil = mysqli_query($conn, $sql); 
    $strTbl = "";
    $strTbl .= "<table border='3' cellpadding='5' bgcolor='#D3D3D3'>";
    $strTbl .= "<tr>";
    $strTbl .= "<th>No</th>";
    $strTbl .= "<th>ID Petugas</th>";
    $strTbl .= "<th>Username</th>";
    $strTbl .= "<th>Password</th>";
    $strTbl .= "<th>Nama Petugas</th>";
    $strTbl .= "<th>Level</th>";
    $strTbl .= "<th>Edit Data</th>";
    $strTbl .= "<th>Detail</th>";
    $strTbl .= "<th>Hapus</th>";
    $strTbl .= "</tr>";
    $id_petugas     = 1;

    if(mysqli_num_rows($tampil) > 0){

         while($data = mysqli_fetch_assoc($tampil))  {

            $strTbl .= "<tr>";
            $strTbl .= "<td>". $id_petugas. "</td>";
            $strTbl .= "<td>". $data['id_petugas']."</td>";
            $strTbl .= "<td>". $data['username']."</td>";
            $strTbl .= "<td>". $data['password']."</td>";
            $strTbl .= "<td>". $data['nama_petugas']."</td>";
            $strTbl .= "<td>". $data['level']."</td>";
            $strTbl .= "<td><a href='edit_petugas.php?id=".$data['id_petugas']."' class='edit'> Edit Data </a></td>";     
            $strTbl .= "<td><a href='detail_petugas.php?id=".$data['id_petugas']."' class='detail'> Lihat Detail </a></td>";       
            $strTbl .= "<td><a href='javascript:hapusData(".$data['id_petugas'].")' class='hapus'>Hapus Data </a></td>";
            $strTbl .= "</tr>";
            $id_petugas++;
         }
     }

         else{
            $strTbl .="<tr><td colspan='4'>Maaf Data Kosong, Silahkan Tambahkan Terlebih Dahulu</td></tr>";
         }
         $strTbl .="</table>";
         
         print($strTbl);

         ?>
    <script language="javascript" type="text/javascript">

        function hapusData(id_petugas){

            if(confirm("Apakah Anda yakin akan menghapus data ini?")){

                window.location.href='hapus_petugas.php?id=' + id_petugas;
            }
        }
    </script>
</center>
</div>
</body>
</html>