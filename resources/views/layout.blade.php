<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Document</title>
	<link rel="stylesheet" type="text/css" href="css/app.css">
	<link rel="stylesheet" type="text/css" href="css/all.css">
</head>
<body>
	<header>
		@include('grizmin.header')
	</header>

	<div class="container">
		@yield('content')
	</div>

</body>
</html>
