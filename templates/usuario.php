<!DOCTYPEhtml>
<html>
	<head>
		<meta charset="utf-8"/>
		<meta http-equiv="X-UA-Compatible" content="IE=edge"/>
		<meta name="viewpiort" content="width=device-width, initial-scale=1"/>
		
		<title>CinemaTube</title>
		
		<link href="css/bootstrap.min.css" rel="stylesheet"/>
		<link rel="shortcut icon" href="img/clapperboard.png" type="image/png"/>
		<link href="css/stylemain.css"  rel="stylesheet" type="text/css">
	</head>
	<body data-spy="scroll" data-target="#navegacion">
			<?php
			SESSION_START();
			if(isset($_POST['correo']) && isset($_POST['contra']))
			{
				$enlace = mysqli_connect("localhost","root","","cinematube");
				htmlspecialchars($_POST['correo']);
				htmlspecialchars($_POST['contra']);
				mysqli_real_escape_string($enlace,$_POST['correo']);
				mysqli_real_escape_string($enlace,$_POST['contra']);
			if(!$enlace)
			{
				echo "No se pudo conectar".mysqli_connect_error();
			}
			else
			{	//proceso de codificación de la contraseña
				$contra = $_POST['contra'];
				$ch = str_split($contra);
				$contrasena = "";
				$carac=0;
				foreach($ch as $p)
				{
					$nu=ord($p);
					$carac += $nu;
				}
				$contrasena = $contrasena.$carac;
				for($x=0;$x<strlen($contra);$x++)
				{
					$wi = (ord($ch[$x])>>1)-4;
					$contrasena=$contrasena.chr($wi);
				}
				
				$cad = array();
				$arreglo = array();
				$cont = strlen($contra);
				for($i=0;$i<$cont;$i++)
				{
					$car = substr($contra,$i,1);
					array_push($cad,$car);
				}
				$mul = ceil($cont/5);
				$contadorpal = 0;
				for($x=0;$x<$mul;$x++)
				{
					$eje=array();
					for($y=0;$y<5;$y++)
					{
						if($contadorpal<$cont)
							array_push($eje,$cad[$y]);
						else
							array_push($eje,'');
						$contadorpal++;
					}
					array_push($arreglo,$eje);
					for($g = 0;$g<5;$g++)
						if($cad!='\0')
							array_shift($cad);
				}
				$grr = array();
				for($y=0;$y<5;$y++)
					for($x=0;$x<$mul;$x++)
						array_push($grr,$arreglo[$x][$y]);
				$grr = implode("",$grr);
				$h = 'Texto: '.$contra.'<br/>playfair("'.$grr.'",5)';
				$cant = ceil(strlen($grr)/2);
				$contrasena=$contrasena.substr($grr,0,$cant);
				
				$tildes = $enlace -> query("SET NAMES 'utf8'");
						
				$confi='SELECT USUARIO_CONTRASENIA FROM USUARIOS WHERE USUARIO_NOMBRE="'.$_POST['nom-usuario'].'"';
				
				$res = mysqli_query($enlace, $confi);
				$arre = array();
				if(!empty($res))
				{
					while($row = mysqli_fetch_assoc($res))
					{
						foreach($row as $re)
						{
							$arre[]=$re;
						}
					}
					if(!empty($arre))
						$arre = substr($arre[0],5);
					else
						$arre='273464&?¡¿%';
					// Checa si la contraseña que enviaste es la misma que esta en la base de datos
					
					if($contrasena == $arre)
					{
						echo "Todo bien";
						$corr = $_POST['correo'];
						echo $corr;
						$consulta =  'SELECT * FROM usuarios WHERE USUARIO_CORREO="'.$correo.'"';
						$res = mysqli_query($enlace, $consulta);
						//$ra = mysqli_fetch_array($enlace,);
						$arr = array();
						while($row = mysqli_fetch_assoc($res))
						{
							foreach($row as $re)
							{
								$arr[]=$re;
							}
						}
					}
				}
				mysqli_close($enlace);
			}
			if(!empty($arr))
			{
				$_SESSION['tipo'] = $arr[0];
				$_SESSION['correo'] = $arr[1];
				$_SESSION['nombre'] = $arr[2];;
				$_SESSION['paterno'] = $arr[3];;
				$_SESSION['materno'] = $arr[4];
				$_SESSION['fecha'] = $arr[5];
			}
			}
			if(isset($_SESSION['tipo']) && isset($_SESSION['correo']) && isset($_SESSION['nombre']))
			{
				$enlace=mysqli_connect("localhost","root","","cinematube");
				if(!$enlace)
					echo 'hubo un error';
				else
				{
					$fecha=date('Y/m/d');
					$nuevafecha='UPDATE usuarios SET FECHA_CONECT="'.$fecha.'" WHERE USUARIO_NOMBRE="'.$_SESSION['usuario'].'"';
					mysqli_query($enlace,$nuevafecha);
				}
				mysqli_close($enlace);
				echo '<div class="container">
			<header>
				<nav class="navbar navbar-expand-lg navbar-light bg-light">
				  <a class="navbar-brand" href="#">CinemaTube</a>
				  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
				    <span class="navbar-toggler-icon"></span>
				  </button>
				  <div class="collapse navbar-collapse" id="navbarSupportedContent">';
						// Aquí usaremos los ifs de php para desplehar navbar con contenido distinto según el tipo de usuario
						if($_SESSION['tipo']=='1') 
						{
							echo '
							    <ul class="navbar-nav mr-auto">
							       <li class="nav-item active">
							        <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
							      </li>
							      <li class="nav-item dropdown">
							        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
							          Administración de cuenta
							        </a>
							        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
							          <a class="dropdown-item" href="#"> Suscripción </a>
							          <a class="dropdown-item" href="#"> Premium</a>
							          <div class="dropdown-divider"></div>
							          <a class="dropdown-item" href="#"> Salir </a>
							        </div>
							      </li>
							      <li class="nav-item">
							        <a class="nav-link disabled" href="#">Disabled</a>
							      </li> 
							    </ul>';
						}
						else
						{
							if($_SESSION['tipo']=='2')
							{
								echo '
								    <ul class="navbar-nav mr-auto">
								       <!--<li class="nav-item active">
								        <a class="nav-link" href="#"> Inicio <span class="sr-only">(current)</span></a>
								      </li>
								      <li class="nav-item">
								        <a class="nav-link" href="#"> Ver usuarios </a>
								      </li>
								      <li class="nav-item">
								        <a class="nav-link" href="#"> Salir </a>
								      </li>-->
								    </ul>';
							}
							}
						}
									echo ' <span class="btn-group">
										<button type="button" class="btn btn-primary navbar-btn dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><span class="glyphicon glyphicon-cog" aria-hidden="true"></span> <span class="caret"></span>
										</button>
										<ul class="dropdown-menu">
											<li><a href="./camb_dis.php">Diseño de página</a></li>
											<li><a href="./camb_imag.php">Información personal</a></li>
											<li role="separator" class="divider"></li>
											<li><a href="./main.php"><span class="glyphicon glyphicon-off" aria-hidden="true"></span> Cerrar Sesión</a></li>
										</ul>
									</span>
								</div>
							</div>	
						</div>
					</nav>
				</header>
				<div class="main" id="conten-main">
				<!-- Aquí va el contenido que venga del usuario-->
				
						<div class="row">
							<div class="col-lg-3 col-md-3 col-sm-3 col-xs-3" id="izquierda" height="300px">';
								// Notificación de partidas empezadas
								
								$connect = mysqli_connect("localhost","root","","prueba");
								$name = $_SESSION['usuario'];
								$buscar = "select * partidas where jugador_2 = $name";
								$search = mysqli_query($connect,$buscar);
								if($search != false)
								{
									$cadena = mysqli_fetch_array($search);
									print_r($cadena);
								}
								else
								{
									echo "Sin notificaciones por el momento";
								}
								mysqli_close($connect);
									
							echo '</div>';
							
				}
				else
				{
					echo '<div class="row">
								<div class="jumbotron col-lg-7 col-lg-offset-1">
									<h1>Inicie sesión correctamente.</h1>
								</div>
						</div>';
				}
			?>
		</div>
		<div class="row">
			<div class="col-lg-12 navbar-fixed-bottom">
				<footer class="text-center" id="part-bottom">
					Hecho en México. Todos los derechos reservados.
				</footer>
			</div>
		</div>
		
		
		
		
		<script src="../Documents/jquery.js"></script>
		<script src="../Documents/bootstrap/js/bootstrap.min.js"></script>
		<script type="text/javascript" src="main.js"></script>
	</body>
</html>