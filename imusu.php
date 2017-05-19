<?php
echo "<!DOCTYPE html>
		<html>
			<head>
			<meta charset='utf-8'>
			<title>COYORED</title>
			<script src='https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js'></script>
			 <script>
				$(document).ready(function(){
					$('#botpu').click(function(){
						var text=$('#publi').val();
						 $.post('imusu.php',{text:text}, function(datos){ 
						 $('#publicacion').html('hola'.text);
					});
					});
					$('#botco').click(function(){
						var textc=$('#come').val();
						 $.post('imusu.php',{textc:textc}, function(datos){ 
						 $('#comentario').html(textc);
					});
					});
					});
			</script> 
			
			</head>
			<body>
 </body>
		</html>";
	//$usuario="mcmanus";
	$usuario="elpelucas";
	//$usuario="elminimau";	
	//$usuario="lucaloco";
	//$usuario=$_POST["usu"];
		$con=mysqli_connect("localhost","root","","final");
		$query="SELECT * FROM usuario;";
		$res=mysqli_query($con,$query);
		$fila=mysqli_fetch_assoc($res);
		$id=0;
		$us2=array("0"=>"0");
		$car=array("qué"=>"que");
		while($fila)
		{
			if($fila["nombre_usuario"]==$usuario)
			{
				 $id=$fila["id_usuario"];
				$usi=array ($fila["id_usuario"]=>$fila["nombre_usuario"]);
				$us2=array_merge($us2,$usi); 
				$fila=mysqli_fetch_assoc($res);	
			}
			else
			{			
			echo $fila["nombre_usuario"]."</br>";
			$us=array ($fila["id_usuario"]=>$fila["nombre_usuario"]);
			$us2=array_merge($us2,$us); 
			$fila=mysqli_fetch_assoc($res);
			}
		}	
	function publi($us2,$car)
	{
		$con=mysqli_connect("localhost","root","","final");
		$query="SELECT * FROM publicacion;";
		$res=mysqli_query($con,$query);
		$filap=mysqli_fetch_assoc($res);
		while($filap)
		{	
			$pubus=$filap["id_usuario"];
			$pubus=str_replace(array_keys($us2),array_values($us2),$pubus);
			echo "<div style='border:solid;'>".$pubus."---";
			echo $filap["tiempo_publicacion"]."</br> </div>";
			$carpu=$filap["texto_publicacion"];
			$carpu=utf8_decode($carpu);
			$carpu=str_replace(array_keys($car),array_values($car),$carpu);
			echo "<div style='background-color:gold;'>".$carpu."</br></br></div>";
			$queryc="SELECT * FROM comentario;";
			$resc=mysqli_query($con,$queryc);
			$filac=mysqli_fetch_assoc($resc);
			while($filac)
			{
				if($filap["id_publicacion"]==$filac['id_publicacion'])
				{
					$pubus=$filac["id_usuario"];
					$pubus=str_replace(array_keys($us2),array_values($us2),$pubus);
					echo "<div style='background-color:gray;'>".$pubus."(".$filac['tiempo_comentario'].")<br/></div>";
					$carpu=$filac["texto_comentario"];
					$carpu=utf8_decode($carpu);
					$carpu=str_replace(array_keys($car),array_values($car),$carpu);
					echo "<div style='background-color:gray;'>".$carpu."<br/></div>";
				$filac=mysqli_fetch_assoc($resc);
				}	
				else
					$filac=mysqli_fetch_assoc($resc);
			}
			echo "<br/>";
		$filap=mysqli_fetch_assoc($res);
		echo "COMENTAR<input type='text' name='come' id='come' placeholder='Ah mira'>
		<input type='submit' value='Comentar' id='botco'>
		<div id='comentario'></div>";
		}
		
	}
echo "Subir Publicacón <input type='text' name='publi' id='publi' placeholder='De que me sirve la vida?'>
		<input type='submit' value='Publicar' id='botpu'>";
echo 		"<div id='publicacion'></div>";
	publi($us2,$car);
?>