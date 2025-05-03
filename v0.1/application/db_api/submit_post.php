<?php
// include 'db.php';

/*if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $title = $_POST['title'];
    $author = $_POST['author'];
    $content = $_POST['content'];
    $time = date('Y-m-d H:i:s'); // 获取当前时间

    $stmt = $conn->prepare("INSERT INTO posts (author, time, title, content) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssss", $author, $time, $title, $content);
    
    if ($stmt->execute()) {
        header("Location:/viewer.php"); // 重定向到帖子页
    } else {
        echo "Error: " . $stmt->error;
    }
    
    $stmt->close();
    $conn->close();
} else {
    echo "Invalid request";
}*/
echo "<br><br><br><br><br><h1>该页面已关闭，具体效果请至<a href='/' target='_self'>官网</a>侧边栏下载。</h1>";
?>