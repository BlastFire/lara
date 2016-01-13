<!DOCTYPE html>
<html lang="en-US">
<head>
	<meta http-equiv="Content-Type" content="text/html;charset=utf-8">
	<title>Put title here</title>
	<link rel="stylesheet" type="text/css" href="/css/app.css">
	<link rel="stylesheet" type="text/css" href="/css/all.css">
	<link rel="stylesheet" type="text/css" href="http://fonts.googleapis.com/css?family=Wellfleet">
</head>
<body>
	<header>
		@include('wadapp.header')
	</header>

	<div id="w">
		<div class="container">
			@yield('content')
		</div>
	</div>

@yield('javascript')
</body>
</html>
