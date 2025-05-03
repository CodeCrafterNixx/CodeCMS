<?php
include 'db.php';//引用数据库连接代码

if ($_SERVER["REQUEST_METHOD"] == "POST") {//若收到H5页面表单
    $title =htmlspecialchars($_POST['title']);//获取标题字符串
    $author =htmlspecialchars($_POST['author']);//获取作者字符串
$resume=htmlspecialchars($_POST['resume']);//获取摘要字符串并格式化

if($resume=='' || $resume=='_SYS_AUTO_POST_RESUME_'){
    $resume='_SYS_AUTO_POST_RESUME_';
}

    $content = $_POST['content'];
    $time = date('Y-m-d H:i:s'); // 获取当前时间

    $stmt = $conn->prepare("INSERT INTO posts (author, time, title, content, resume) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("sssss", $author, $time, $title, $content, $resume);
    
    if ($stmt->execute()) {
        header("Location:/v0.2/viewer.php"); // 重定向到帖子页
    } else {
        echo "Error: " . $stmt->error;
    }
    
    $stmt->close();
    $conn->close();
} else {
    echo "Invalid request";
}
?>