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
        $nisn = $_POST['nisn'];
        $nis = $_POST['nis'];
        $nama = $_POST['nama'];
        $id_kelas = $_POST['id_kelas'];
        $alamat = $_POST['alamat'];
        $no_telp = $_POST['no_telp'];
        $id_spp = $_POST['id_spp'];
        $sql = "INSERT INTO siswa(nisn,nis,nama,id_kelas,alamat,no_telp,id_spp) 
        VALUES('$nisn','$nis','$nama','$id_kelas','$alamat','$no_telp','$id_spp')";

            if (mysqli_query($conn, $sql)) {

                header('Location:siswa.php');

            } else {
                echo "<script>alert('GAGAL')</script>";
            }


    }
?>

<center>
<h1 id="judul">Selamat Datang Di Aplikasi pembayaran SPP</h1>
<div class="header">
    <div class="header-list">
       <ul>
          <li><a href="siswa.php">BACK</a></li>
          <li><a href="search_siswa.php">SEARCH</a></li>
       </ul>
    </div>
</div>  
<div class="container">
<h1>Input Siswa</h1>
<form method="POST">
    <table>
        <tr>
            <td>NISN</td>
            <td>:</td>
            <td><input type="text" name="nisn"></td>
        </tr>

        <tr>
            <td>NIS</td>
            <td>:</td>
            <td><input type="text" name="nis"></td>
        </tr>

        <tr>
            <td>Nama</td>
            <td>:</td>
            <td><input type="text" name="nama"></td>
        </tr>

        <tr>
            <td>ID Kelas</td>
            <td>:</td>
            <td><select name="id_kelas">
                        <option value="01">X - RPL</option>
                        <option value="02">X - TKJ</option>
                        <option value="03">X - TBSM</option>
                        <option value="04">X - TKR </option>
                        <option value="05">XI - RPL</option>
                        <option value="06">XI - TKJ</option>
                        <option value="07">XI - TBSM</option>
                        <option value="08">XI - TKR</option>
                        <option value="09">XII - RPL</option>
                        <option value="10">XII - TKJ</option>
                        <option value="11">XII - TBSM</option>
                        <option value="12">XII - TKR</option>
            </select></td>
        </tr>

        <tr>
            <td>Alamat</td>
            <td>:</td>
            <td><input type="text" name="alamat"></td>
        </tr>

        <tr>
            <td>No Telepon</td>
            <td>:</td>
            <td><input type="tel" name="no_telp"></td>
        </tr>

        <tr>
            <td>ID SPP</td>
            <td>:</td>
            <td><input type="text" name="id_spp"></td>
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