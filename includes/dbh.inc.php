<?php

$servername = 'localhost';
$username = 'root';
$password = '';
$dbname = 'farzad';

// connect to db 
$conn = mysqli_connect($servername, $username, $password, $dbname);
if (!$conn) {
    echo 'CONNECTION ERROR' . mysqli_connect_error();
}
