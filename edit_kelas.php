
<?php
    require('koneksi.php');

        if(isset($_GET['id'])) {
            $id = $_GET['id'];
        }
        else{
            header('Location:login.php');
        }

        $sql = "SELECT * FROM kelas WHERE id_kelas='$id'";
        $kelas = mysqli_query($conn,$sql);

        if(mysqli_num_rows($kelas)> 0){

            $data = mysqli_fetch_assoc($kelas);
        }

        if(isset($_POST['submit'])){

            $id_kelas = $_POST['id_kelas'];
            $nama_kelas = $_POST['nama_kelas'];
            $kompetensi_keahlian = $_POST['kompetensi_keahlian'];
            $sql = "UPDATE kelas SET 
                    id_kelas='$id_kelas',
                    nama_kelas = '$nama_kelas',
                    kompetensi_keahlian = '$kompetensi_keahlian'
                    WHERE id_kelas='$id_kelas'";
        

        if(mysqli_query($conn,$sql)) {
            echo "<script> alert('Data berhasil diubah ') </script>";
        }
        
        else{
            echo "Maaf ubah data tidak berhasil,coba lagi";
        }
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
    border-radius: 10px;
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
    <title>Edit Data</title>
</head>
<body>
<h1 id="judul">Selamat Datang Di Aplikasi pembayaran SPP SMK Namira</h1>
<div class="header">
    <div class="header-list">
       <ul>
          <li><a href="kelas.php">BACK</a></li>
          <li><a href="tambah_kelas.php">TAMBAH INPUT</a></li>
       </ul>
    </div>
</div>  
<div class="container">
    <center>
    <h1>Update Data</h1>

    <form method="POST">

        <table>
            <tr>
                <td>ID Kelas</td>
                <td>:</td>
                <td><input type="text" name="id_kelas" value="<?php echo $data['id_kelas']; ?>"></td>
            </tr>

            <tr>
                <td>Nama Kelas</td>
                <td>:</td>
                <td><input type="text" name="nama_kelas" value="<?php echo $data['nama_kelas']; ?>"></td>
            </tr>

            <tr>
                <td>Kompetensi keahlian</td>
                <td>:</td>
                <td><input type="text" name="kompetensi_keahlian" value="<?php echo $data['kompetensi_keahlian']; ?>"></td>
            </tr>

            <tr>
                <td colspan="3" align="center">
                    <input type="submit" name="submit" value="Edit Data" class="kirim">
                    <input type="reset" name="reset" value="Ulang Data" class="reset">
                </td>
            </tr>
        </table>
    </form>
</center>
</div>
</body>
</html>