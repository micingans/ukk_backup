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
	<title>Pencarian</title>
</head>
<body>
<h1 id="judul">Selamat Datang Di Aplikasi pembayaran SPP SMK Namira</h1>
<div class="header">
	<div class="header-list">
	   <ul>
		  <li><a href="home.php">BACK</a></li>
		  <li><a href="kelas.php">DATA KELAS</a></li>
	   </ul>
    </div>
</div>	
<div class="container">
<center>
<h1>Search Data</h1>
<form method="POST">
<input type="text" name="nt" placeholder="Cari">
<input type="submit" name="submit" value="Search" class="search">
</form>

<br>
<div class="databes">
<table border="1" cellspacing="0" cellpadding="5" bgcolor='#D3D3D3'>

	<tr>
		<td>ID Kelas</td>
		<td>Nama kelas</td>
		<td>Kompentensi keahlian</td>	
	</tr>
	    <?php
	        if(!ISSET($_POST['submit'])){

	        	$sql = "SELECT * FROM kelas";
	        	$query = mysqli_query($conn, $sql);
	        	while ($row = mysqli_fetch_array($query)) {
	            ?>
	            <tr>
	            	<td><?php echo $row['id_kelas']; ?> </td>
	            	<td><?php echo $row['nama_kelas']; ?> </td>
	            	<td><?php echo $row['kompetensi_keahlian']; ?> </td>
	            </tr>
	            <?php
	        	}
	        }
	        ?>
	          <?php if(ISSET($_POST['submit'])){

	          	$cari = $_POST['nt'];
	          	$query2 = "SELECT * FROM kelas WHERE id_kelas LIKE '$_POST[nt]%' OR nama_kelas LIKE '$_POST[nt]%' OR kompetensi_keahlian LIKE '$_POST[nt]%'";

	          	$sql = mysqli_query($conn, $query2);
	          	while($kolomke = mysqli_fetch_row($sql)){
	            ?>

	          		<tr>
	          			<td><?php echo $kolomke['0']; ?></td>
	          			<td><?php echo $kolomke['1']; ?></td>
	          			<td><?php echo $kolomke['2']; ?></td>
	          		</tr>

	          	<?php
 	          	}

	          }
	        ?>
	    </div>
</table>
</center>
</div>
</body>
</html>
