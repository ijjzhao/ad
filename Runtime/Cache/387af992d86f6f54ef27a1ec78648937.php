<?php if (!defined('THINK_PATH')) exit();?><html>
	<head>
		<title>测试又拍云</title>
	</head>
	<body>
		<form action="<?php echo U('material/upload');?>" method="POST" enctype="multipart/form-data">
			<h3>选择图片:</h3>
			<input type="file" name="file"/>
			<p><input type="submit" value="上 传"/></p>
		</form>
	</body>
</html>