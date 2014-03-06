<!DOCTYPE HTML>
<html>
<head>
<style type="text/css" src="../style/style.css"></style>
</head>
<body>
	<div id="content">
	@yield('content') 
	@yield('jquery')</div>
	<script type="text/javascript"
		src="{{ asset('../js/jquery-2.1.0.js') }}"></script>
</body>
</html>