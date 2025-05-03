<?php
$servername = "localhost";
$username = "jm65zzt";
$password = "ufhk0qt";
$dbname = "jm65zzt";

// 创建连接
$conn = new mysqli($servername, $username, $password, $dbname);

// 检查连接
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>