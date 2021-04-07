<?php
session_start();
session_destroy();
echo "<script> alert('Sampai Jumpa Kembali') </script>";
header("refresh:0.1,url=index.php");
?>
