<!DOCTYPE HTML>
<html>
<head>
<style type="text/css" src="../style/style.css"></style>
</head>
<body>	
	@yield('content')
	<script type="text/javascript" src="{{ asset('../js/jquery-2.1.0.js') }}"></script>
	@yield('jquery')
</body>
</html>