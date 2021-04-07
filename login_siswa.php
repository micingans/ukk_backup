<?php

session_start();
error_reporting(0);
require_once("koneksi.php");
if(isset($_SESSION['nisn'])){
    header("location: index_siswa.php");
}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Log In</title>
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

form{
    margin-top: -950px;
    font-size: 25px;
}


#colspan{
    margin-top: -15px;
    background-color: grey;
}

.username{
    border:none;
    font-size: 25px;
    font-style: bold;
}

.password{
    border:none;
    font-size: 25px;
    font-style: bold;
}

.tombol_login{
    background-color: #32CD32;
    color: white;
    font-size: 15px;
    width: 20%;
    border: none;
    border-radius: 3px;
    padding: 10px 20px;
}

.tombol_reset{
    background-color: red;
    color: white;
    font-size: 15px;
    width: 20%;
    border: none;
    border-radius: 3px;
    padding: 10px 20px;
}


	</style>
</head>
<body>
	<div class="container">
	<h1 id="judul">Selamat Datang di Pembayaran SPP SMK Namira</h1>
	<div class="header">
		<div class="header-list">
			<ul>
				<li><a href="index.php">Home</a></li>
				<li><a href="login.php">Login</a></li>
				<li><a href="login_siswa.php">Login Siswa</a></li>
			</ul>
		</div>
	</div>
<?php 
if(isset($_POST['login'])){
    $nisn = mysqli_escape_string($conn, $_POST['nisn']);
    $cari = mysqli_query($conn, "SELECT * FROM siswa WHERE nisn='$nisn'");
    $result = mysqli_fetch_assoc($cari);
        if(mysqli_num_rows($cari) == 0){
            echo "<script>alert('NISN Tersebut Belom Terdaftar')</script>";

        }else{

            $_SESSION['nisn'] = $_POST['nisn'];
            header("location: index_siswa.php");
        }
}
?>
</div>
<center>
    <form method="POST">
        <h1>.::Log In::.</h1>
        <table border='1' cellspacing='0' cellpadding='5' >
            <tr>
                <td><b>NISN</b></td>
                <td><input type="text" name="nisn"  placeholder="Masukan Password anda" class="password"></td>
            </tr>
            <td colspan="2" align="right">
                <input type="submit" name="login" value="LOGIN" class="tombol_login">
            </td>
        </table>
        </form>
    </center>
</body>
</html>