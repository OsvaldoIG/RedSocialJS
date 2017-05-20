<?php
echo "<!DOCTYPE html>
		<html>
			<head>
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
							<a name='inicio'></a>";
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
			echo"<div class='card grey lighten-5'>
                    <div class='card-content blue-text text-darken-4'>";
			echo "<span class='card-title'>".$pubus.": ";
			echo $filap["tiempo_publicacion"]."</span>";
			$carpu=$filap["texto_publicacion"];
			$carpu=utf8_decode($carpu);
			$carpu=str_replace(array_keys($car),array_values($car),$carpu);
			echo "<p>".$carpu."</p>
			        </div>";
			$queryc="SELECT * FROM comentario;";
			$resc=mysqli_query($con,$queryc);
			$filac=mysqli_fetch_assoc($resc);
			echo'<div class="card-action">';
			while($filac)
			{
				if($filap["id_publicacion"]==$filac['id_publicacion'])
				{
					$pubus=$filac["id_usuario"];
					$pubus=str_replace(array_keys($us2),array_values($us2),$pubus);
					echo "<div class='grey lighten-4 blue-text text-darken-3'>".$pubus."(".$filac['tiempo_comentario'].")<br/></div>";
					$carpu=$filac["texto_comentario"];
					$carpu=utf8_decode($carpu);
					$carpu=str_replace(array_keys($car),array_values($car),$carpu);
					echo "<div class='grey lighten-4 blue-text text-darken-3'>".$carpu."<br/>";

			echo        "
					</div><br/>";
					$filac=mysqli_fetch_assoc($resc);
				}	
				else
					$filac=mysqli_fetch_assoc($resc);
			}
			$filap=mysqli_fetch_assoc($res);
			echo "<a class='waves-effect waves-light btn-large white blue-text text-darken-4'><i class='material-icons left blue-text text-darken-4'>thumb_up</i>me gusta</a>
            <a class='waves-effect waves-light red btn-large white red-text text-darken-4'><i class='material-icons left red-text text-darken-4'>thumb_down</i>me disgusta</a>
			<div id='infousuco' class='grey lighten-4 blue-text text-darken-3'></div>
			<div id='comentario' class='grey lighten-4 blue-text text-darken-3'></div>
            <input type='text' name='come' id='come' placeholder='Comentario'>
			<button class='btn waves-effect waves-light blue darken-4' type='submit' value='Comentar' id='botco'>Comentar
                <i class='material-icons right'>chat</i>
            </button>
			</div>
			</div>
            ";
		}
		
	}
		echo "<br/><br/>
		    <input type='text' name='publi' id='publi' placeholder='De que me sirve la vida?'>
				<button class='btn waves-effect waves-light blue darken-4' type='submit' value='Publicar' id='botpu'>Publicar
                    <i class='material-icons right'>launch</i>
                </button>
				<br/>
			    ";
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
						hoy = mm+'-'+dd+'-'+yyyy+' '+hh+':'+min+':'+ss;
						var text=$('#publi').val();
							if(text==='')
							{
								window.alert('CAMPO VACIO');
							}
							else
							{
								$.post('imusu.php',{text:text}, function(){
								$('#publicacion').html(text);
								$('#infousu').html('".$usp."'+'---'+hoy);
								});
							}	
					});
					$('#botco').click(function()
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
						hoy = mm+'-'+dd+'-'+yyyy+' '+hh+':'+min+':'+ss;
						var textc=$('#come').val();
						if(textc==='')
							{
								window.alert('CAMPO VACIO');
							}
						else
						{
							$.post('imusu.php',{textc:textc}, function(){
							$('#comentario').html(textc);
							$('#infousuco').html('".$usp."'+'('+hoy+')');
							});
						}	
					});
						 
					});";
			
echo "</script>
    <div class='card grey lighten-5'>
        <div class='card-content blue-text text-darken-4'>
		    <span class='card-title' id='infousu'></span>
	            <p id='publicacion'></p>
		</div>
		<div class='card-action'>
		<p>No puedes Comentar :(</p>
		</div>
	</div>";
	publi($us2,$car);
echo "</div>
	        </div>
	    </main>
</body>
		</html>";
?>
