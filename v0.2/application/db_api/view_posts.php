<style>
body{
 background: #003973;  /* fallback for old browsers */
background: -webkit-linear-gradient(to top, #E5E5BE, #003973);  /* Chrome 10-25, Safari 5.1-6 */
background: linear-gradient(to top, #E5E5BE, #003973); /* W3C, IE 10+/ Edge, Firefox 16+, Chrome 26+, Opera 12+, Safari 7+ */

 }
.post {
    background-color: white;
    margin: 20px auto;
    padding:10px;
    width: 600px;
    border-radius: 5px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.175);
}
.post h3 {
    margin-top:6px;
    margin-bottom:4px;
}
.post small {
    color: gray;
}
.post span {
    display: block;
    font-size:16px;
    margin-top: 10px;
    font-family: monospace;
}

		/* 导航条 */
			.topnav {
			overflow: hidden;
			background-color: #333;
			top:0;
			padding:5px;
			position:sticky;
			position:-webkit-sticky;
		}
		/* 导航条链接 */
		.topnav a {
			float: left;
			display: block;
			color: #f2f2f2;
			text-align: center;
			padding: 14px 16px;
			text-decoration: none;
		}
		/* 链接颜色修改 */
		.topnav a:hover {
			background-color: #ddd;
			color: black;
		}
</style>
<body><div class="topnav">
	<a href="/v0.2/viewer.php" target="_blank">论坛bbs</a>
	<a href="/v0.2/editor.html" target="_blank">创作edit</a>
	<a href="/v0.2/index.php" target="_self">主页</a>
	<a href="/v0.2/sign-in-up.html" style="float:right" target="_self">登陆</a>
</div>
<?php include 'db.php'; ?>
<?php
// 从URL获取帖子id并转换为整数
$tid = intval($_GET['id']);

// 准备SQL查询语句
$sql = "SELECT id, author, time, title, content , resume ,viewrate FROM posts WHERE id=? ORDER BY time DESC";
$stmt = $conn->prepare($sql); // 准备预处理语句
if ($stmt) {
    // 绑定参数并执行预处理语句
    $stmt->bind_param("i", $tid);
    $stmt->execute(); // 执行预处理语句
    $result = $stmt->get_result(); // 获取结果集

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo '<div class="post">';
            echo '<h3>' . htmlspecialchars($row['title']) . '</h3>';
            echo '<small><b>' . htmlspecialchars($row['author']) . '</b>  |  <i>' . htmlspecialchars($row['time']) . '</i></small>';
            echo "<b style='color:lightblue;font-size:16px;margin-left:35px;'><i>".htmlspecialchars($row['viewrate'])."人👁浏览</i></b><br/>";
            echo '<span style="white-space: pre-wrap;overflow-wrap: break-word;">' . htmlspecialchars($row['content']) . '</span>';
            echo '</div>';
        }
    } else {
        echo "No posts found.";
    }

    // 关闭预处理语句和连接
    $stmt->close();
    $conn->close();
} else {
    // 处理准备语句失败的情况
    die('Error preparing statement: ' . $conn->error);
}
?></body>