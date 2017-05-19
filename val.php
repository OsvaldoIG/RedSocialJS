<?php	
	if(isset($_POST['usua'])&&isset($_POST["cont"]))
	{
		//echo $_POST["cont"]."</br>";
		$usuario=$_POST["usua"];
		$contra=$_POST["cont"];
		$con=mysqli_connect("localhost","root","","final");
		$query="SELECT * FROM usuario WHERE nombre_usuario='$usuario';";
		$res=mysqli_query($con,$query);
		$fila=mysqli_fetch_assoc($res);
		//echo $fila['password'];
		if($fila==NULL){
		echo "TU USUARIO NO ESTÁ REGISTRADO";}
		else{
			if($contra==$fila['password'])
			{
				$pues="tru";
				echo $pues;
			}
			else
				echo "USUARIO y/o CONTRASEÑA INVALIDOS";
			}
	}
	else
		echo "INGRESE USUARIO Y CONTRASEÑA";
?>