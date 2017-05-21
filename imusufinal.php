<?php
SESSION_START();
echo "<!DOCTYPE html>
		<html>
			<head>imusufinal
			<meta charset='utf-8'>
			<title>COYORED</title>
			<link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/materialize/0.98.2/css/materialize.min.css'>
		    <link href='https://fonts.googleapis.com/icon?family=Material+Icons' rel='stylesheet'>
		    <script src='https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js'></script>
			<script src='https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js'></script>
			</head>
			<body>
			    <header>
		            <div style='opacity: 0.95;'class='navbar-fixed'>
                        <nav class='blue darken-4'>
                            <div class='nav-wrapper'>
                                <svg height='180' width='180'  viewBox='0 0 400 400'>
                                    <defs>
                                        <linearGradient id='grad3' x1='0' y1='0%' x2='100%' y2='0%'>
                                            <stop offset='0%' style='stop-color:rgb(255,255,255);stop-opacity:1' />
                                            <stop offset='100%' style='stop-color:rgb(255,255,255);stop-opacity:1' />
                                        </linearGradient>
                                    </defs>
                                    <ellipse cx='200' cy='70' rx='85' ry='55' fill='url(#grad3)' />
                                    <text fill='#0d47a1' font-size='30' font-family='Aharoni' x='127' y='80'>
                                    COYORED</text>
                                </svg>
								<ul id='nav-mobile' class='right hide-on-small-only'>
                                    <li><a href='#inicio'>Inicio</a></li>
                                </ul>
                            </div>
                        </nav>
                    </div>
		        </header>
			    <main>
	                <div class='container'>
			            <div class='row'>	
						    <div class='col s10 m10 l10 xl10'>
							<a name='inicio'></a>
		</html>";

		$usuario=$_SESSION['usuario'];
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
				<div id=publicacion><div class='public'></div></div>
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
			echo "<div>
				<div style='background-color:gold;'>".$carpu."</br></br></div>
				</div>";
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
				<a class='waves-effect waves-light btn-large white blue-text text-darken-4'><i class='material-icons left blue-text text-darken-4'>thumb_up</i>me gusta</a>
            			<a class='waves-effect waves-light red btn-large white red-text text-darken-4'><i class='material-icons left red-text text-darken-4'>thumb_down</i>me disgusta</a>
				
				COMENTAR<input type='text' name='come' id='come".$filap["id_publicacion"]."' placeholder='Ah mira'>
				<input type='submit' value='Comentar' id='botco".$filap["id_publicacion"]."' class='dormir btn waves-effect waves-light blue darken-4'><br/><br/>";
				if($pubmas<$filap["id_publicacion"])
					$pubmas=$filap["id_publicacion"];
				$filap=mysqli_fetch_assoc($resp);
				$x=1;
				 
		}
		 
		echo "<script>
				var amame=9;
				$('#botpu').click(function(){
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
							
								$.post('imusufinal.php',{text:text}, function(){
									/*var t=('<div>');
									t.attr('value','crear <elemento');
									$('.public').append(t).prepend('".$usp."'+'    '+hoy+'<br/>');*/
									
								$('#publicacion').append('".$usp."'+'   '+hoy+'<br/>');
								$('#publicacion').append(text+'<br/>');
								
								var o=$('<input>');
								o.attr('type','text');
								var y='come'+amame;
								o.attr('id',y);
								o.attr('placeholder','comentar');
								o.attr('name','come');
								$('#publicacion').append(o);
								
								var t=$('<input>');
								t.attr('type','submit');
								var j='botco'+amame;
								t.attr('id',j);
								t.attr('value','comentar');
								t.attr('class','dormir');
								$('#publicacion').append(t);
								
								var b=$('<div>');
								var m='comentario'+amame;
								b.attr('id',m);
								b.attr('style','background-color:gray;');
								$('#publicacion').append(b);
								
								});
								amame=amame+1;
							
				});";
				echo "$('.dormir').mouseup(function()
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
						
						var con=$(this).attr('id');
						var cont=con.substr(con.length-1);
						var textc=$('#come'+cont).val();
						if(textc==='')
							{
								window.alert('CAMPO VACIO');
							}
						else
						{	$.post('imusufinal.php',{textc:textc}, function(){
							$('#comentario'+cont).append('".$usp."'+'('+hoy+')'+'<br/>');
							$('#comentario'+cont).append(textc+'<br/>');
							});
						}	
					});
						 
					
			</script>";
	
?>
