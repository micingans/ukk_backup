<?php

session_start();
require_once("koneksi.php");
if(isset($_SESSION['username'])){
    header("location: home.php");
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
    $username = mysqli_escape_string($conn, $_POST['username']);
    $password = mysqli_escape_string($conn, $_POST['password']);
    $result = mysqli_query($conn,"SELECT * FROM petugas WHERE username='$username' and password='$password'");
    $cek = mysqli_num_rows($result);
    
        if($username == "" && $password == ""){
            echo "<script>alert('Username & Password Tidak Boleh Kosong!')</script>";
        }
        elseif($cek > 0 ){
        
            $data = mysqli_fetch_assoc($result);
            
            $_SESSION['username'] = $username;
            $_SESSION['password'] = $password;
            header("location:home.php");
        }
        else{
            echo "<script>alert('Username & Password Salah!')</script>";
        }
    }
?>
</div>
<center>
    <form method="POST">
        <h1>.::Log In::.</h1>
        <table border='1' cellspacing='0' cellpadding='5' >
            <tr>
                <td><b>USERNAME</b></td>
                <td><input type="text" name="username" placeholder="Masukan username anda" class="username"></td>
            </tr>
            <br>
            <tr>
                <td><b>PASSWORD</b></td>
                <td><input type="password" name="password"  placeholder="Masukan Password anda" class="password"></td>
            </tr>
            <td colspan="2" align="right">
                <input type="submit" name="login" value="LOGIN" class="tombol_login">
                <input type="reset" name="reset" value="RESET" class="tombol_reset">
            </td>
        </table>
        </form>
    </center>
</body>
</html>