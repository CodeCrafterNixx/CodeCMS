<?php
$servername = "你的MySQL主机地址";
$username = "你的MySQL用户名";
$password = "你的MySQL密码";
$dbname = "你的MySQL数据库名";

// 创建连接
$conn = new mysqli($servername, $username, $password, $dbname);

// 检查连接
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
