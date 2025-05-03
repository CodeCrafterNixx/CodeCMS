<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Posts Page</title>
    <style>
        body {
            background-color: #f0f0f0;
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
        .post {
            background-color: white;
            margin: 20px auto;
            padding: 20px;
            width: 450px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        .post h3 {
            margin: 0;
        }
        .post small {
            color: gray;
        }
        .post span {
            display: block;
            font-size: 20px;
            margin-top: 10px;
        }
    </style>
</head>
<body>
    <div class="topnav">
		<a href="/v0.1/viewer.php" target="_blank">论坛bbs</a>
		<a href="/v0.1/editor.php" target="_blank">创作edit</a>
		<a href="/v0.1/index.php">主页</a>
		<a href="#" style="float:right">登陆</a>
	</div>
<?php //include 'application/db_api/view_posts.php';?>
    <br><br><br><br><br><h1>该页面已关闭，具体效果请至<a href="/" target="_self">官网</a>侧边栏下载。</h1>
</body>
</html>