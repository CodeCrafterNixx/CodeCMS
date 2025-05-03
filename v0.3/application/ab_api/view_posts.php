<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <script src="https://cdn.jsdelivr.net/npm/marked/marked.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/dompurify/3.0.5/purify.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/highlight.js/11.7.0/styles/atom-one-dark.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/highlight.js/11.7.0/highlight.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/highlight.js/11.7.0/languages/php.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/highlight.js/11.7.0/languages/java.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/highlight.js/11.7.0/languages/cpp.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/highlight.js/11.7.0/languages/python.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/highlight.js/11.7.0/languages/html.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/highlight.js/11.7.0/languages/css.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/highlight.js/11.7.0/languages/xml.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.3/css/lightbox.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.3/js/lightbox.min.js"></script>

<script>
// 初始化配置
lightbox.option({
    'resizeDuration': 200,
    'wrapAround': true,
    'disableScrolling': true
});
</script>
    <meta charset="UTF-8">
    <title>帖子详情-✨CodeCraft💡用热爱🔥编写未来🌅</title>
    <style>
        body {
            background: linear-gradient(to top, #E5E5BE, #003973);
        }
        .post {
            background-color: white;
            margin-left:5%;margin-top:9pt;
            padding-top:5px;padding-left:20px;
            width: 860px;
            border-radius: 5px;
            box-shadow: 15px 10px 10px rgba(0, 0, 0, 0.175);
        }
        /* Markdown内容样式 */
        #post-content {
            font-family: 'Menlo', 'Consolas', 'Monaco', monospace;
            white-space: pre-wrap;font-size:14px;
            overflow-wrap: break-word;
        }
        /* 代码块样式 */
        pre {
            background: #282c34;
            padding: 1em;
            border-radius: 5px;
            overflow-x: auto;
        }
        code {
            font-family: 'Fira Code', 'Menlo', monospace;
            font-size: 0.9em;
        }
        /* 导航条样式 */
        .topnav {
            overflow: hidden;
            background-color: #333;
            top:0;
            padding:5px;
            position:sticky;
            position:-webkit-sticky;
        }
        .topnav a {
            float: left;
            display: block;
            color: #f2f2f2;
            text-align: center;
            padding: 14px 16px;
            text-decoration: none;
        }
        .topnav a:hover {
            background-color: #ddd;
            color: black;
        }
#post-content {
    white-space: pre-wrap;       /* 保留空白字符 */
    font-family: 'Fira Code', monospace; /* 等宽字体 */
}

#post-content pre {
    background: #f8f8f8;
    padding:5px;
    overflow-x: auto;
}

#post-content code {
    color: #d63384;
    font-family: inherit;
}
#post-content table {
    width: 100% !important;
    display: block;
    overflow-x: auto;
    white-space: nowrap;
}
    </style>
</head>
<body>
    <div class="topnav">
        <a href="/v0.3/viewer.html" target="_blank">论坛bbs</a>
        <a href="/v0.3/editor.html" target="_blank">创作edit</a>
        <a href="/v0.3/index.html" target="_self">主页</a>
        <a href="/v0.3/sign-in-up.html" style="float:right" target="_self">登陆</a>
    </div>
    <?php
    include 'db.php';
    $tid = intval($_GET['id']);
    $sql = "SELECT id, author, time, title, content, resume, viewrate FROM posts WHERE id=? ORDER BY time DESC";
    $stmt = $conn->prepare($sql);
    
    if ($stmt) {
        $stmt->bind_param("i", $tid);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo '<div class="post">';
                echo '<h3>' . htmlspecialchars($row['title']) . '</h3>';
                echo '<small><b>' . htmlspecialchars($row['author']) . '</b>  |  <i>' . htmlspecialchars($row['time']) . '</i></small>';
                echo "<b style='color:lightblue;font-size:16px;margin-left:35px;'><i>".$row['viewrate']."人👁浏览</i></b><br/>";
                
                // 修改1：使用div容器并保留原始内容
                echo '<div id="post-content">' . htmlspecialchars($row['content']) . '</div>';
                echo '</div>';
            }
        }
        $stmt->close();
        $conn->close();
    }
    ?>
<script>
document.addEventListener('DOMContentLoaded', function() {
    // 获取原始内容
    const postContent = document.getElementById('post-content');
    
    // 解码HTML实体（关键步骤）
    const decodedContent = new DOMParser().parseFromString(
        postContent.innerHTML, 
        'text/html'
    ).documentElement.textContent;

    // 配置Marked.js
    marked.setOptions({
        breaks: true,
        gfm: true,
        highlight: function(code, lang) {
            const validLang = hljs.getLanguage(lang) ? lang : 'plaintext';
            return hljs.highlight(code, { language: validLang }).value;
        }
    });

    // 解析并消毒
    const parsedHtml = DOMPurify.sanitize(marked.parse(decodedContent));

    // 更新内容
    postContent.innerHTML = parsedHtml;

    // 高亮代码块
    hljs.highlightAll();
});
document.addEventListener('DOMContentLoaded', function() {
    document.querySelectorAll('#post-content img').forEach(img => {
        // 限制最大宽度为父容器的90%
        img.style.maxWidth = '90%';
        
        // 如果图片高度超过视口高度，等比缩放
        if (img.naturalHeight > window.innerHeight * 0.7) {
            img.style.maxHeight = '70vh';
            img.style.width = 'auto';
        }
        
        // 添加点击放大功能（可选）
        img.style.cursor = 'zoom-in';
        img.addEventListener('click', function() {
            this.style.maxWidth = this.style.maxWidth === '90%' ? '100%' : '90%';
        });
    });
});
</script>
</body>
</html>