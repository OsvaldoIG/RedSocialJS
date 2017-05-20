<?php
echo "<!DOCTYPE html>
		<html>
			<head>
			<meta charset='utf-8'>
			<title>COYORED</title>
			<script src='https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js'></script>
			</head>
			<body>
			</body>
		</html>";
	//$usuario="mcmanus";
	//$usuario="elpelucas";
	//$usuario="elminimau";	
	$usuario="lucaloco";
	//$usuario=$_POST["usu"];
		$con=mysqli_connect("localhost","root","","final");
		$query="SELECT * FROM usuario;";
		$res=mysqli_query($con,$query);
		$fila=mysqli_fetch_assoc($res);
		$id=0;
		$us2=array("0"=>"0");
		while($fila)
		{
			if($fila["nombre_usuario"]==$usuario)
			{
				$usp=$fila["nombre_usuario"];
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
		echo "Subir Publicacón <input type='text' name='publi' id='publi' placeholder='De que me sirve la vida?'>
				<input type='submit' value='Publicar' id='botpu'>
				<div id=infousu></div>
				<div id=publicacion></div>
				";
		$queryp="SELECT * FROM publicacion;";
		$resp=mysqli_query($con,$queryp);
		$filap=mysqli_fetch_assoc($resp);
		$pubmas=0;
		while($filap)
		{	
			$pubus=$filap["id_usuario"];
			$pubus=str_replace(array_keys($us2),array_values($us2),$pubus);
			echo "<div style='border:solid;'>".$pubus."---";
			echo $filap["tiempo_publicacion"]."</br> </div>";
			$carpu=$filap["texto_publicacion"];
			$carpu=utf8_decode($carpu);
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
					echo "<div style='background-color:gray;'>".$carpu."<br/></div>";
					$filac=mysqli_fetch_assoc($resc);
				}	
				else
					$filac=mysqli_fetch_assoc($resc);
			}
			
				echo "<div id='infousuco".$filap["id_publicacion"]."' style='background-color:gray;'></div>
				<div id='comentario".$filap["id_publicacion"]."' style='background-color:gray;'></div>
				COMENTAR<input type='text' name='come' id='come".$filap["id_publicacion"]."' placeholder='Ah mira'>
				<input type='submit' value='Comentar' id='botco".$filap["id_publicacion"]."'><br/><br/>";
				if($pubmas<$filap["id_publicacion"])
					$pubmas=$filap["id_publicacion"];
				$filap=mysqli_fetch_assoc($resp);
				$x=1;
				 
		}
		 
		echo "<script>
				$(document).ready(function(){
					
					$('#botpu').click(function()
					{
						
						var hoy = new Date();
						var dd = hoy.getDate();
						var mm = hoy.getMonth()+1;
						var yyyy = hoy.getFullYear();
						var hh=hoy.getHours();
						var min=hoy.getMinutes();
						var ss=hoy.getSeconds();
						if(dd<10) {
							dd='0'+dd
						}
						if(mm<10) {
							mm='0'+mm
						} 
						if(ss<10) {
							ss='0'+ss
						} 
						var hoy = mm+'-'+dd+'-'+yyyy+' '+hh+':'+min+':'+ss;
						
						var text=$('#publi').val();
							if(text==='')
							{
								window.alert('CAMPO VACIO');
							}
							else
							{
								$.post('imusu.php',{text:text}, function(){
								$('#publicacion').prepend(text+'<br/>');
								$('#publicacion').prepend('".$usp."'+'---'+hoy+'<br/>');
								});
							}	
					});";
					echo"$('#botco".$x."').mouseup(function()
					{
						var hoy = new Date();
						var dd = hoy.getDate();
						var mm = hoy.getMonth()+1;
						var yyyy = hoy.getFullYear();
						var hh=hoy.getHours();
						var min=hoy.getMinutes();
						var ss=hoy.getSeconds();
						if(dd<10) {
							dd='0'+dd
						} 
						if(mm<10) {
							mm='0'+mm
						} 
						if(ss<10) {
							ss='0'+ss
						} 
						hoy = mm+'-'+dd+'-'+yyyy+' '+hh+':'+min+':'+ss;
						var textc=$('#come".$x."').val();
						if(textc==='')
							{
								window.alert('CAMPO VACIO');
							}
						else
						{	$.post('imusu.php',{textc:textc}, function(){
							$('#comentario".$x."').append('".$usp."'+'('+hoy+')'+'<br/>');
							$('#comentario".$x."').append(textc+'<br/>');
							});
						}	
					});
						 
					});
			</script>";
					
?>