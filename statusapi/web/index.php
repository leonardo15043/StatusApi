<!DOCTYPE html>
<html> 
<head> 

	<meta content="text/html; charset=UTF-8" http-equiv="content-type">
	<link rel="stylesheet" href="../src/assets/css/kendo.common.min.css" />
	<link rel="stylesheet" href="../src/assets/css/kendo.default.min.css" />
	<link rel="stylesheet" href="../src/assets/css/kendo.default.mobile.min.css" />
	<link rel="stylesheet" href="../src/assets/css/kendo.material.min.css" />
	<link rel=stylesheet href="../src/assets/css/style.css">
	<link href="https://fonts.googleapis.com/css?family=Bahiana|News+Cycle|Roboto+Condensed" rel="stylesheet">
	
	<script type='text/javascript' src='//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js?ver=1.10.2'></script>
	<script src="../src/assets/js/kendo.all.min.js"></script>
	<script src="../src/assets/js/scripts.js"></script>

</head>
<body> 

<div class="contenedor">

	<section class="header">
		<span class="k-i-gear bttool"></span>
	</section>
	
	<section class="conten_editor">

		<form action="" id="form-mensaje"  >
			<h1>Enviar mensaje</h1>
			
			<textarea name="message" id="message"></textarea>

			<div class="btn_list">
				<div class="message-alert"></div>
				<i class="k-i-list-unordered bt_lidata" ></i>
				<div class="btn-save" onclick="new_message()">Guardar</div>
				<div id="count-chars">120</div>
			</div>
			
		</form>

	</section>

	<section class="list_data">
           <div id="grid"></div>
	</section>
	
	<div class="cont_tool">
		<div class="btn_her">
			<div class="b_h cache k-i-toolbar-float" onclick="clear_logs();"></div>
			
		</div>
	</div>
	
</div>

</body> 
</html>
