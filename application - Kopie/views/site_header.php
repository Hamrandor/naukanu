<?php echo doctype("html5")?>
<html>
	<head>
		<style>
		body, html{margin:0;padding:0;}
		body{
			background-color:#EEE
		}
		h1,h2,h3,h4,p,a,li,ul{
			font-family:arial, sans-serif;
			color: black;
			text-decoration: none;
		}
		
		#nav{
			margin:50px auto 0 auto;
			width: 100%;
			background-color:#888;
			heigth: 12px;
			padding: 20px;
		}
		
		#nav ul{
			list-style: none;
			float: left;
			margin: 0 50px;
		}
		
		#nav ul li{
			display: inline;
		}
		
		#nav a:hover{
			color:green;
		}
		
		#content{
			width: 100%;
			min-height: 100%;
			margin: 0 auto;
			padding: 20px;
		}
		
		#footer{
			width: 100%;
			height: auto;
			margin: 0 auto;
			padding: 20px;
		}
		
		#footer p{
			color: #777;
		}
		</style>
		
	</head>