<?php
session_start();
require("koneksi.php");
if(!isset($_SESSION['username'])){
    header("location: login.php");
}else{
    $username = $_SESSION['username'];
}
?>

<html>
    <head>
        <title>Form Petugas</title>
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
p{
	margin-bottom: 10px;
}


</style>
    </head>
<body>
<h1 id="judul">Selamat Datang Di Aplikasi pembayaran SPP SMK Namira</h1>
<div class="header">
	<div class="header-list">
	   <ul>
		  <li><a href="logout.php">Log Out</a></li>
		  <li><a href="home.php">Admin</a></li>
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

<?php
$sQL = mysqli_query($conn, "SELECT * FROM petugas WHERE username='$username'");
$result = mysqli_fetch_assoc($sQL);
    if($result['level'] == "Administrator"){ ?>
<tr align="center" height="250px">   	
    <td>
    	<a href="transaksi.php">Entry transaksi pembayaran</a>
    </td> 
    <td>
    	<a href="history.php">Lihat history pembayaran</a>
    </td>
</tr>
<tr>
    <td colspan="2" align="center" bgcolor="black"><font color="white"><b>TERIMA KASIH ATAS KUNJUNGAN ANDA</b></font></td>
</tr>
<?php
    }else{ ?>
<?php } ?>
</table>
</body>
</html>