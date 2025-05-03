<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8">
	<title>✨CodeCraft💡用热爱🔥编写未来🌅</title>

</head>

<style>
.post {
    background-color: white;
    margin: 20px auto;
    padding:10px;
    width:640px;
    border-radius: 5px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.175);
}
.post h3 {
    margin: 0;
}
.post span {
    display: block;
    color:#b1b1b1;
    font-size:14px;
    margin-top:6px;
}
.post a {
	display: block;
	color:black;
	text-decoration: none;
}
/* 链接颜色修改 */
.post a:hover {
	color:blue;
}
</style>
<body>
<?php include 'db.php'; ?>
<?php
// 每页显示的帖子数量
$posts_per_page =6;

// 获取当前页码，如果没有设置则默认为1
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;

// 计算偏移量
$offset = ($page - 1) * $posts_per_page;

// 修改SQL查询，添加ORDER BY time DESC实现倒序排列，并添加LIMIT和OFFSET进行分页
$sql = "SELECT id, author, time, title, content, resume, viewrate FROM posts ORDER BY time DESC LIMIT $offset, $posts_per_page";
$result = $conn->query($sql);

// 获取总帖子数量
$total_sql = "SELECT COUNT(*) as total FROM posts";
$total_result = $conn->query($total_sql);
$total_rows = $total_result->fetch_assoc()['total'];

// 计算总页数
$total_pages = ceil($total_rows / $posts_per_page);

if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $resume = $row['resume'];
        echo '<div class="post">';
        echo ' <h3><a href="view_posts.php?id='.$row['id'].'" target="_blank">'. htmlspecialchars($row['title']) . '</a></h3>';
        echo '<small style="color:gray;"><b>' . htmlspecialchars($row['author']) . '</b>  |  <i>' . htmlspecialchars($row['time']) . '</i></small><br>';
        if($resume == '_SYS_AUTO_POST_RESUME_'){
            echo '<small style="color:yellow;background-color:lightgray">摘要：</small><q><span>' . htmlspecialchars(mb_substr($row['content'],0,50,'UTF-8')) . '</span>...</q>';
        } else {
            echo '<small style="color:yellow;background-color:lightgray">摘要：</small><q><span>' . htmlspecialchars($row['resume']) . '</span>...</q>';
        }
        echo"<b style='color:lightblue;float:right;font-size:16px;margin-bottom:5px;'><i>".htmlspecialchars($row['viewrate'])."人👁浏览</i></b>";
        echo '</div>';
    }
} else {
    echo "No posts found.";
}

// 生成分页按钮
echo '<div style="text-align:center;">';

// 上一页按钮
if ($page > 1) {
    echo ($page == 1 ? '' : '&nbsp;&nbsp;<button onclick="window.location.href=\'?page=1#\'" style="background-color:#00cf00;color:white;">首页</button>');
    echo '&nbsp;&nbsp;<button onclick="window.location.href=\'?page='.($page-1).'#\'">上一页</button>';

}

// 当前页及附近页码按钮
if($page>2){echo '&nbsp;&nbsp;<span style="color:white">...</span>';}
for ($i = max(1, $page -1); $i <= min($total_pages, $page +1); $i++) {
    echo '&nbsp;&nbsp;<button onclick="window.location.href=\'?page='.$i.'#\'"' . ($i == $page ? ' style="background-color:blue;color:white;"' : '') . '>'.$i.'</button>';
}
if($page<$total_pages-1){echo '&nbsp;&nbsp;<span style="color:white">...</span>';}
// 下一页按钮
if ($page < $total_pages) {
    echo '&nbsp;&nbsp;<button onclick="window.location.href=\'?page='.($page+1).'#\'"' . ($page == $total_pages ? ' style="background-color:gray;color:white;cursor:not-allowed;"' : '') . '>下一页</button>';
    echo '&nbsp;&nbsp;<button onclick="window.location.href=\'?page='.$total_pages.'#\'" style="background-color:#00cf00;color:white;">尾页</button>';
}

echo '</div>';

$conn->close();
?>
</body>
</html>