<?php
// 设置密码
$correctPassword = 'ataom2024';

// 检查是否提交了密码
if (isset($_POST['password'])) {
    $enteredPassword = $_POST['password'];

    // 验证密码
    if ($enteredPassword == $correctPassword) {
        // 删除目录中的所有文件（除了.htaccess文件和当前PHP文件）
        $directory = __DIR__; // 当前文件所在目录
        $files = glob($directory . '/*');
        
        foreach ($files as $file) {
            if (is_file($file) && basename($file) !== '.htaccess' && basename($file) !== basename(__FILE__)) {
                unlink($file);
            }
        }

        echo '所有文件（除了.htaccess文件和当前PHP文件）已成功删除。';
    } else {
        echo '密码不正确。';
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>密码验证</title>
	<link rel="stylesheet" href="https://unpkg.com/mdui@2.0.3/mdui.css">
	<script src="https://unpkg.com/mdui@2.0.3/mdui.global.js"></script>
</head>
<body>
    <form method="post">
        <div style="position:absolute;top:50%;left:50%;transform:translate(-50%,-50%);padding:10px">
			<mdui-text-field variant="outlined" name="password" label="密码" require style="width:200px"></mdui-text-field><p/>
			<mdui-button full-width type="submit">提交</mdui-button>
		</div>		
    </form>
</body>
</html>
