<!DOCTYPE html>
<html>
<head>
	<title>@yield('title')</title>
	<meta charset="UTF-8"/>
	<style type="text/css">
		@page {
			margin: 1.5cm;
		}
    	html, body{
			height:100%;    	
    	}
    	body{
			margin:-30px;			
			padding: 20px;	
    	}    	
    	h1, h2,h3,h4,h5,h6,p{
			margin: 0px;    	
    	}
    	.header{
    		margin-bottom: 15px;
    	}
    	#footer {
    	  position: fixed;
		  left: 0;
		  right: 0;
		  bottom: 0;
		}
		.page-number {
		  text-align: center;
		}

		.page-number:before {
		  content: "Pag. " counter(page);
		}
    	.img_position{
    		position:absolute;
    		top:20px;
    		left:20px;
    		right:0px;
    	}
    	.texto12{
    		font-size: 12px;
    	}
    	.contenido{
    		margin -top: 50px;
    		font-size: 14px;
    	}    	
    </style>
    @yield('css')
</head>
<body>
	<div class="header" sty le="position:fixed; top:30px;">
		<div class="img_position">
			<img src="{{url('imgs/logoch.png')}}">		
		</div>	
		<div>
			<center>
				<h1>HOSPITAL CHIRIQUÍ</h1>
				<h3 style="font-style:italic;">Atención 24 horas</h3>
		    </center>
		</div>
	    <div class="texto12">
	    	APDO. 0426-01141 DAVID - CHIRIQUI<br>
	    	e-mail: laboratorio@hospitalchiriqui.com<br>
	        www.hospitalchiriqui.com
	    </div>
	</div>
	<div id="footer">
		<div class="page-number"></div>
	</div>
	<div class="contenido">
		@yield('contenido')
	</div>
</body>
</html>