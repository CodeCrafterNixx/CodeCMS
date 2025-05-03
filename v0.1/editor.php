<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Create Post</title>
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
        .form-container {
            background-color: white;
            margin: 20px auto;
            padding: 20px;
            width: 450px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        .form-container input, .form-container textarea {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
        .form-container button {
            padding: 10px 20px;
            background-color: #28a745;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
        .form-container button:hover {
            background-color: #218838;
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
    <div class="form-container">
        <form action="application/db_api/submit_post.php" method="post">
            <input type="text" name="title" placeholder="Title" required><br>
            <input type="text" name="author" placeholder="Author" required><br>
            <textarea name="content" placeholder="Content" maxlength="500" required></textarea><br>
            <button type="submit">Publish</button>
        </form>
    </div>
</body>
</html>