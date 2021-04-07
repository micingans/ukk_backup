<?php

define('Host', 'localhost');
define('Username', 'root');
define('Password', '');
define('Database', 'pembayaran_spp');

$conn = mysqli_connect(Host,Username,Password,Database);
if (mysqli_connect_errno()) {
	echo "Gagal".mysqli_connect_error();
}

?>