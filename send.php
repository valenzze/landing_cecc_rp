<?php

	if(!empty($_REQUEST['nombre']) && !empty($_REQUEST['email']) && !empty($_REQUEST['telefono'])){


			$to = "jorge.valencia@hostland.com.mx";
			$subject = "Contacto Relaciones Públicas";

			$message = "
			<html>
			<head>
			<title>CECC</title>
			</head>
			<body>
			<p>Contacto desde página web</p>
			<table>
			<tr>
				<th style='text-align: left;'>Nombre</th>
				<td>".$_REQUEST['nombre']."</td>
			</tr>
			<tr>
				<th style='text-align: left;'>Email</th>
				<td>".$_REQUEST['email']."</td>
			</tr>
			<tr>
				<th style='text-align: left;'>Teléfono</th>
				<td>".$_REQUEST['telefono']."</td>
			</tr>
			<tr>
				<th style='text-align: left;'>Escuela de procedencia</th>
				<td>".$_REQUEST['escuela']."</td>
			</tr>
			</table>
			</body>
			</html>
			";

			// Always set content-type when sending HTML email
			$headers = "MIME-Version: 1.0" . "\r\n";
			$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

			// More headers
			$headers .= 'From: CECC Landing <webmaster@ceccportal.com.mx>' . "\r\n";
			//$headers .= 'Cc: myboss@example.com' . "\r\n";

			$manda = mail($to,$subject,$message,$headers);

			if($manda){
				include_once("db.php");
				$location 		= "relaciones_publicas";
				$nombre 		= utf8_encode($_REQUEST['nombre']);
				$email 			= utf8_encode($_REQUEST['email']);
				$telefono 		= utf8_encode($_REQUEST['telefono']);
				$escuela 		= utf8_encode($_REQUEST['escuela']);
				$fecha_ok		= date("Y-m-d H:i:s");
				mysqli_query($link, "INSERT INTO leads (location, nombre, email, telefono, escuela, fecha) values ('$location', '$nombre', '$email', '$telefono', '$escuela', '$fecha_ok')");
			}
			print($manda);

	}
	else{
			print("PHP Error #45344");
	}

?>