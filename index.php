<!DOCTYPE html>
<html lang="en"  class="mdui-theme-auto">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.bootcdn.net/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="./js/basic.js"></script>
    <link rel="stylesheet" href="./mdui/mdui.css"/>
    <script src="./mdui/mdui.js"></script>
    <title>短链接生成器</title>
    <link rel="icon" href="./icon.png"/>
    <style>
        @font-face {
            font-family: 'iconfont';
            src: url('//at.alicdn.com/t/c/font_4409988_dnwpk4n5x27.woff2?t=1705142685721') format('woff2'),
                url('//at.alicdn.com/t/c/font_4409988_dnwpk4n5x27.woff?t=1705142685721') format('woff'),
                url('//at.alicdn.com/t/c/font_4409988_dnwpk4n5x27.ttf?t=1705142685721') format('truetype');
        }
        body {
            font-family: 'iconfont',Arial, sans-serif;
            margin: 20px;
            user-select: none;
        }

        form {
            max-width: 400px;
            margin: 0 auto;
        }

        input[type="url"] {
            width: 100%;
            padding: 8px;
            box-sizing: border-box;
            margin-bottom: 10px;
        }

        input[type="submit"] {
            background-color: #4CAF50;
            color: white;
            padding: 10px 15px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        input[type="submit"]:hover {
            background-color: #45a049;
        }

        a {
            text-decoration: none;
            color: #007BFF;
        }
    </style>
</head>
<body>
    <?php
    require('./config.php');
    function addHttps($url) {
        if (!preg_match("~^(?:f|ht)tps?://~i", $url)) {
            $url = "https://" . $url;
        }
        return $url;
    }

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $inputUrl = addHttps($_POST["inputUrl"]);

        $randomString = substr(md5(uniqid()), 0, 5);
        $fileName = $randomString;
        $fileContent = '<script>location.href = "'.$inputUrl.'"</script>';
        $targetFolder = __DIR__ . '/site/';
        $targetFilePath = $targetFolder . $fileName . ".html";

        if (!is_dir($targetFolder)) {
            mkdir($targetFolder, 0777, true);
        }

        file_put_contents($targetFilePath, $fileContent);

        echo "短链接生成成功：<a target='_blank' href='https://{$URL}/{$fileName}'>https://{$URL}/{$fileName}</a>";
        echo "<script>navigator.clipboard.writeText('https://{$URL}/{$fileName}')</script>";
    }
    ?>
    
    <form action="<?php echo $_SERVER["PHP_SELF"]; ?>" method="post" onsubmit="return validateForm()" novalidate>
    <div style=" position: fixed; top: 50%; left: 50%; transform:  translate(-50%,-50%);">
        <mdui-text-field autocomplete="off" variant="outlined" style="width: 250px;" label="网址" name="inputUrl" id="inputUrl"></mdui-text-field></p>
        <mdui-button full-width type="submit" style="width: 250px;">&#xe600; 生成短链接</mdui-button>
    </div> 
    </form>
    <mdui-fab id="about-btn" style="position: fixed; right: 10px; bottom: 10px; font-size: 30px; font-family: 'iconfont'; color: #000; font-weight: bold; text-shadow:  0 0 6px #aeaeae;" extended variant="surface">&#xe633;</mdui-fab>
    <mdui-snackbar class="post-complete">链接已复制</mdui-snackbar>
    <mdui-snackbar class="empty-value">网址必须是真实链接</mdui-snackbar>
    <mdui-dialog headline="关于"  close-on-esc close-on-overlay-click id="aboutus">这是一个用于生成短链接的生成器<br/>生成短链接后，程序将会自动将内容复制到剪切板<br/>Made By:@Xiaozhe Nice</mdui-/dialog>

    <script>
        document.getElementById('about-btn').onclick = ()=>{
            document.getElementById('aboutus').open = true;
        }
        document.querySelectorAll('a').forEach((e)=>{e.setAttribute('draggable','false')});

        function validateForm() {
        var inputUrl = document.getElementById('inputUrl').value.trim();

        // 正则表达式，匹配以 http 或 https 开头的合法 URL
        var urlPattern = /^(http(s)?:\/\/)?([\w-]+\.)+[\w-]+(\/[\w- .\/?%&=]*)?$/;

        if (inputUrl === "" || !urlPattern.test(inputUrl)) {
            document.querySelector('.empty-value').open = true;
            return false;
        }
        return true;
    };
    nof12();
    document.oncontextmenu = ()=>{
        return false;
    }
    </script>
</body>
</html>
