<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8">
	<title>✨CodeCraft💡用热爱🔥编写未来🌅</title>
	
	<style>
		* {
				box-sizing: border-box;
		}
		body {
			font-family: Arial;
			padding: 10px;
		}
				/* 头部标题 */
		.header {
			padding: 30px;
			text-align: center;background: #FEAC5E;  /* fallback for old browsers */
background: -webkit-linear-gradient(to left, #4BC0C8, #C779D0, #FEAC5E);  /* Chrome 10-25, Safari 5.1-6 */
background: linear-gradient(to left, #4BC0C8, #C779D0, #FEAC5E); /* W3C, IE 10+/ Edge, Firefox 16+, Chrome 26+, Opera 12+, Safari 7+ */

		}
		.header h1 {
			font-size: 50px;
		}
		/* 导航条 */
			.topnav {
			overflow: hidden;
			background-color: #333;
			top:0;z-index:5;
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
		/* 创建两列 */
		/* Left column */
		.leftcolumn {   
			float: left;
			width: 75%;
		}
		/* 右侧栏 */
		.rightcolumn {
			float: right;
			width:25%;
            margin-top:45px;padding-bottom:20px;
            top:64pt;padding-right:14px;margin-bottom:150px;
			background-color: #f1f1f1;
			padding-left:14px;
			
			position:sticky;
			position:-webkit-sticky;
		}
		/* 图像部分 */
		.fakeimg {
			background-color: #aaa;
			width: 100%;
			padding: 20px;
		}
		/* 文章卡片效果 */
		.card {
			background-color: white;
            padding-left:14px;
		}
.card iframe{width:90%;}
		/* 列后面清除浮动 */
		.row:after {
			content: "";
			display: table;
			clear: both;
		}
		/* 底部 */
		.footer {
			padding: 20px;
			text-align: center;
			background: #ddd;
			margin-top: 20px;
		}
		/* 响应式布局 - 屏幕尺寸小于 800px 时，两列布局改为上下布局 */
		@media screen and (max-width	: 800px) {
			.leftcolumn, .rightcolumn {   
					width: 100%;
				padding: 0;
				}
		}
		/* 响应式布局 -屏幕尺寸小于 400px 时，导航等布局改为上下布局 */
		@media screen and (max-width: 400px) {
				.topnav a {
				float: none;
				width: 100%;
				}
			}
	</style>
</head>

<body>
	<div class="header">
     <b>CODECRAFT,用一生热爱，编写未来</b><br>
     我们的官网<a href="https://codecraft.czlj.net">₪✰</a>
	<br>
		<p>重置浏览器大小查看效果。</p>
	</div>
	<div class="topnav">
		<a href="viewer.php" target="_blank">论坛bbs</a>
		<a href="editor.html" target="_blank">创作edit</a>
		<a href="index.php">主页</a>
		<a href="sign-in-up.html" style="float:right">登陆</a>
	</div>
	<div style="background: #EFEFBB;background: -webkit-linear-gradient(to right, #D4D3DD, #EFEFBB);background: linear-gradient(to right, #D4D3DD, #EFEFBB);">
		<div class="row">
			<div class="leftcolumn"><iframe src='application/db_api/BBS.php'height=1040px width=100% style='overflow:visible;margin-top:30px;' frameborder=0></iframe></div>
			<div class="rightcolumn">
				<div class="card">
					<h3>我</h3>
                    <iframe src='application/db_api/tasteCookie.php' height=120px width=100% style='overflow:visible;'frameborder=0>
                    </iframe>
				</div>
                <div class='card'>

                 <h3>§CodeCMS版本归档§</h3>
                 <span>[-]Version0内测</span><br>
                 <span style='white-space:pre-warp;'> ┕<a href='/data/backup/v0.1.zip' target='_self'>v0.1</a></span><br>
                </div>
			</div>
		</div>
	</div>
	<div class="footer">
友链
<br><a href='https://czlj.net' target='_blank'>CZLJ主论坛</a>
<br><a href='https://blog.czlj.net' target='_blank'>CZLJ博客</a>
		<h2>底部区域</h2>
	</div>
</body>

</html>