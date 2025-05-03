<?php
session_start();
require 'db.php';
include('YummyCookie.php');

$action = isset($_POST['action']) ? $_POST['action'] : '';
$username = isset($_POST['username']) ? $_POST['username'] : '';
$password = isset($_POST['password']) ? $_POST['password'] : '';
$response = '无效用户名或密码';

if ($action === 'login') {
    $stmt = $conn->prepare("SELECT * FROM users WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();
    $user = $result->fetch_assoc();
    if ($user && $password==$user['password']) {
//     echo'!';
        $id = $user['id'];
        $stmt = $conn->prepare("UPDATE users SET sign_in_datetime = NOW() WHERE id = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $response = 'success';
     
        $stmt = $conn->prepare("SELECT sign_in_datetime FROM users WHERE id = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        $rcv = $result->fetch_assoc();
        $snindttm = $rcv['sign_in_datetime'];
        $TODO = new YUMMY();
        $TODO->buy_cookie($username, $id, $snindttm);
    }
$stmt->close();
$conn->close();
} elseif ($action === 'register') {
    $stmt = $conn->prepare('SELECT * FROM users WHERE username = ?');
    $stmt->bind_param("s", $username); // 确保这里绑定了参数
    $stmt->execute();
    $result = $stmt->get_result();
    if ($result->num_rows == 0) { // 检查查询结果集中的行数
        $stmt = $conn->prepare("INSERT INTO users (username, password, sign_up_datetime, sign_in_datetime) VALUES (?, ?, NOW(), NOW())");
        $stmt->bind_param("ss", $username, $password);
        if ($stmt->execute()) {
            $response = 'success';
         
            $stmt = $conn->prepare("SELECT sign_in_datetime,id FROM users WHERE username = ?");
            $stmt->bind_param("s", $username);
            $stmt->execute();
            $result = $stmt->get_result();
            $rcv = $result->fetch_assoc();
            $snindttm = $rcv['sign_in_datetime'];
            $id=$rcv['id'];
            //            echo $snindttm;
            $TODO = new YUMMY();
            // 注意：这里 $id 变量未定义，你需要从数据库中获取新插入用户的 ID 或者在插入时返回它
            $TODO->buy_cookie($username, $id, $snindttm); // 暂时注释掉或修正
        }
    } else {
        $response = '用户名已存在！';

    }
$stmt->close();
$conn->close();
}

echo $response;
?>