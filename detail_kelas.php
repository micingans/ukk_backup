<?php
  require('koneksi.php');
            if(isset($_GET['id'])){
            $id = (int)$_GET['id'];
         }
         else{
            header('location:index.php');
         }
?>

<!DOCTYPE html>
<html>
<head>
   <title>Detail Data</title>
   <style>
   *{margin:0px auto;}
   body{
      font-family: arial;
      background-color: white;
      height: 1625px;
   }

      a{
         text-decoration: none;
         color: white;
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
.detail{
   margin-top: 20px;
}
.detail table{
   font-size: 25px;
   border:5px solid black;
   padding: 20px;
   border-radius: 10px 10px 10px 10px;
   margin-top: 10PX;
}
</style>
</head>
<body>
<h1 id="judul">Selamat Datang Di Aplikasi pembayaran SPP</h1>
<div class="header">
   <div class="header-list">
      <ul>
        <li><a href="kelas.php">BACK</a></li>
      </ul>
    </div>
</div>   
<div class="container">
<div class="detail">
   <center>
      <h1>Detail Data</h1>
<?php
    $sql = "SELECT * FROM kelas WHERE id_kelas ='$id'";
    $detail = mysqli_query($conn,$sql);    
    $strTbl = "";
    $strTbl = "<table border='8' cellspacing='0' cellpadding='5' bgcolor='#E6E6FA'>";
         if (mysqli_num_rows($detail) > 0 ) {

            $data = mysqli_fetch_assoc($detail);

            $strTbl .="<tr>";
            $strTbl .="<td>ID Kelas</td>";
            $strTbl .="<td>:</td>";
            $strTbl .="<td>".$data['id_kelas']."</td>";
            $strTbl .="</tr>";

            $strTbl .="<tr>";
            $strTbl .="<td>Nama kelas</td>";
            $strTbl .="<td>:</td>";
            $strTbl .="<td>".$data['nama_kelas']."</td>";
            $strTbl .="</tr>";

            $strTbl .="<tr>";
            $strTbl .="<td>Kompetensi keahlian</td>";
            $strTbl .="<td>:</td>";
            $strTbl .="<td>".htmlspecialchars($data['kompetensi_keahlian'])."</td>";
            $strTbl .="</tr>";
         }
         else{
            $strTbl .="<tr><td colspan='2'>Maaf Data Kosong, Silahkan Tambahkan Terlebih Dahulu</td></tr>";
         }
         $strTbl .="</table>";

         print($strTbl);
?>
</center>
</div>
</body>
</html>