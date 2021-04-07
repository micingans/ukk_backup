<?php 
    
    require('koneksi.php');

    if(isset($_GET['id'])) {

    	$id = $_GET['id'];
    	$sql = "DELETE from kelas WHERE id_kelas='".$id."'";
    	$query = mysqli_query($conn,$sql);
    	    if(mysqli_affected_rows($conn)) {
    	    	header("location:kelas.php");
    	    }
    	    else{
    	    	echo "<script> alert('Gagal Menghapus:( ') </script>";
    	    }
    }
?>  