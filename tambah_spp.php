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
    <title>DATA INPUT</title>
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
.kirim{
    background-color: #32CD32;
    color: white;
    font-size: 15px;
    width: 50%;
    border: none;
    border-radius: 3px;
    padding: 10px 20px;
    text-align: center;
}

.reset{
    background-color: red;
    color: white;
    font-size: 15px;
    width: 48%;
    border: none;
    border-radius: 3px;
    padding: 10px 10px;
}

</style>
</head>
<body>
<?php
    if (isset($_POST['submit'])) {
        $id_spp = $_POST['id_spp'];
        $tahun = $_POST['tahun'];
        $nominal = $_POST['nominal'];
        $sql = "INSERT INTO spp(id_spp,tahun,nominal) 
        VALUES('$id_spp','$tahun','$nominal')";

            if (mysqli_query($conn,$sql)) {

                header('Location:spp.php');

            } else {
                echo "<script>alert('GAGAL:(')</script>";
            }


    }
?>

<center>
<h1 id="judul">Selamat Datang Di Aplikasi pembayaran SPP</h1>
<div class="header">
    <div class="header-list">
       <ul>
          <li><a href="home.php">BACK</a></li>
          <li><a href="spp.php">DATA SPP</a></li>
       </ul>
    </div>
</div>  
<div class="container">
<h1>Input SPP</h1>
<form method="POST">
    <table>
        <tr>
            <td>ID SPP</td>
            <td>:</td>
            <td><input type="text" name="id_spp"></td>
        </tr>

        <tr>
            <td>Tahun</td>
            <td>:</td>
            <td><input type="text" name="tahun"></td>
        </tr>

        <tr>
            <td>Nominal</td>
            <td>:</td>
            <td><input type="text" name="nominal"></td>
        </tr>

        <tr>
            <td colspan="4" align="center">
                <input type="submit" name="submit" value="Simpan Data" class="kirim">
                <input type="reset" name="reset" value="Ulang Data" class="reset">
            </td>
        </tr>
</table>
</form>
</center>
</body>
</html>