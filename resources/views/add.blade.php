<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Document</title>
</head>
<body>
	<form action="/adddo" method="post">
		@csrf
		<input type="text" name="name">
		<input type="password" name="pwd">
		<button>添加</button>
	</form>
</body>
</html>