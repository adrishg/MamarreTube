<!DOCTYPEhtml>
<html>
	<head>
		<meta charset="utf-8"/>
		<meta http-equiv="X-UA-Compatible" content="IE=edge"/>
		<meta name="viewpiort" content="width=device-width, initial-scale=1"/>
		
		<title>CinemaTube</title>
		


		<link href="../css/bootstrap.min.css" rel="stylesheet"/>
		<link rel="shortcut icon" href="../img/clapperboard.png" type="image/png"/>
		<!-- <link href="../css/stylemain.css"  rel="stylesheet" type="text/css"> -->
	</head>
	<body data-spy="scroll" data-target="#navegacion">
		<?php
		SESSION_START();
		
		// $correo=$_POST['correo-usuario'];
		// $contra=$_POST['contrasenia'];

		if(isset($_POST['correo-usuario']) && isset($_POST['contrasenia']))
		{
			$enlace = mysqli_connect("localhost","root","","cinematube");
				htmlspecialchars($_POST['correo-usuario']);
				htmlspecialchars($_POST['contrasenia']);
				mysqli_real_escape_string($enlace,$_POST['correo-usuario']);
				mysqli_real_escape_string($enlace,$_POST['contrasenia']);
			if(!$enlace)
			{
				echo "No se pudo conectar".mysqli_connect_error();
			}
			else
			{	//proceso de codificación de la contraseña
				$contra = $_POST['contrasenia'];
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
						
				$confi='SELECT USUARIO_CONTRASENIA FROM usuarios WHERE USUARIO_CORREO="'.$_POST['correo-usuario'].'"';
				$res = mysqli_query($enlace, $confi);
				//echo "'$res'";
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
						$correo = $_POST['correo-usuario'];
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
			if(isset($_SESSION['tipo']) && isset($_SESSION['correo']) && isset($_SESSION['nombre']))
			{
				$enlace=mysqli_connect("localhost","root","","cinematube");
				if(!$enlace)
					echo 'Hubo un error';
			}
				// mysqli_close($enlace);
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
								    echo '<button type="button" class="btn btn-dark navbar-btn" data-toggle="modal" data-target="#registrar_admins"> Registrarse administadores </button>';
								    echo '<button type="button" class="btn btn-dark navbar-btn" data-toggle="modal" data-target="#agregar_peli"> Agregar película </button>';
							}
						}
									echo ' <span class="btn-group">
										<button type="button" class="btn btn-dark navbar-btn dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><span class="glyphicon glyphicon-cog" aria-hidden="true"></span> <span class="caret"></span>
										</button>
										<ul class="dropdown-menu">
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
			}			
			?>

		<!-- FOOTER -->
		<footer class="page-footer font-small black">

		  <!-- Copyright -->
		  <div class="footer-copyright text-center py-3">© 2019 Proteco:
					<a style="color:black; text-decoration:underline;" data-toggle="modal" data-target="#creditos">Créditos<a>			
		  </div>
		  <!-- Copyright -->

		</footer>
	<!-- /FOOTER -->


		<!-- Modal para registro de administradores-->
		<div class="modal fade" id="registrar_admins" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
			<div class="modal-dialog" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<h3 class="modal-title" id="myModalLabel">Registro de administrador</h3>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					</div>
					<div class="modal-body">
						<div class="row">
							<div class="col-lg-12 col-xs-12">
								<form class="form-horizontal" method="POST" action="registro_admins.php" >
									<div class="form-group">
										<label for="nomu" class="control-label">Correo: </label>
										<div class="col-lg-9">
											<input type="text" class="form-control" id="corr" placeholder="Correo" name="correo"/>
										</div>
									</div>
									<div class="form-group">
										<label for="nom" class="control-label">Nombre:</label>
										<div class="col-lg-9">
											<input type="text" class="form-control" id="nombre" placeholder="Nombre"  required pattern="^[A-ZÑÁÉÍÓÚ][a-zñáéíóú]{1,15}" maxlength="15" name="nombre"/>
										</div>
									</div>
									<div class="form-group">
										<label for="nom" class="control-label">Apellido paterno:</label>
										<div class="col-lg-9">
											<input type="text" class="form-control" id="paterno" placeholder="Apellido paterno"  required pattern="^[A-ZÑÁÉÍÓÚ][a-zñáéíóú]{1,15}" maxlength="15" name="paterno"/>
										</div>
									</div>
									<div class="form-group">
										<label for="nom" class="control-label">Apellido materno: </label>
										<div class="col-lg-9">
											<input type="text" class="form-control" id="materno" placeholder="Apellido materno"  required pattern="^[A-ZÑÁÉÍÓÚ][a-zñáéíóú]{1,15}" maxlength="15" name="materno"/>
										</div>
									</div>
									<div class="form-group">
										<label for="con" class="control-label">Contraseña: </label>
										<div class="col-lg-9">
											<input type="password" class="form-control" id="contra" placeholder="Contraseña"  required pattern="^[a-zA-Z0-9_\.\-\@]{8,17}" maxlength="17" name="contra"/>
										</div>
									</div>
									<div class="form-group">
										<label for="cond" class="control-label">Repetir contraseña: </label>
										<div class="col-lg-9">
											<input type="password" class="form-control" id="sena" placeholder="Contraseña"  required pattern="^[a-zA-Z0-9_\.\-\@]{8,17}" maxlength="17" name="sena"/>
										</div>
									</div>
									<button class="btn btn-lg btn-block btn-dark" id="registrarse" name="submit" type="submit">Registrarse</button>
								</form>
							</div>
						</div>
					</div>
					
					<div class="modal-footer">
						<button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
					</div>
				</div>
			</div>
		</div>
		<!-- Modal para los créditos completos -->
		<div class="modal fade" id="creditos" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
			<div class="modal-dialog" role="document">
				<div class="modal-content">
					<div class="modal-header text-center">
						<h3 class="modal-title" id="myModalLabel">Equipo de Desarrollo: </h3>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					</div>
					<div class="modal-body">
						<div class="row">
							<div class="col-lg-12 col-xs-12">
								<div class="text-center">
									<br/>
									<p> Rolando Miguel Alvarez</p>
									<p>Samuel Arturo Garrido Sanchéz </p> 
									<p> Adriana Hernández González</p> 
								</div>
							</div>
						</div>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
					</div>
				</div>
			</div>
		</div>

		<!-- Modal registro peliculas -->
		<div class="modal fade" id="agregar_peli" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
			<div class="modal-dialog" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<h3 class="modal-title" id="myModalLabel">Agregar peliculas</h3>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					</div>
					<div class="modal-body">
						<div class="row">
							<div class="col-lg-12 col-xs-12">
								<form class="form-horizontal" method="POST" action="registro_pelicula.php" >
									<div class="form-group">
										<label for="nom" class="control-label">Nombre:</label>
										<div class="col-lg-9">
											<input type="text" class="form-control" id="nombre" placeholder="Nombre de la película"  required pattern="^[A-ZÑÁÉÍÓÚ][a-zñáéíóú]{1,20}" name="nombre_peli"/>
										</div>
									</div>
									<!-- Pide imagen -->
									<div class="container">
									<div class="col-md-6">
									    <div class="form-group">
									        <label>Portada película: </label>
									        <div class="input-group">
									                <span class="btn btn-default btn-file">
									                   <input type="file" name="portada_peli" id="imgInp">
									                </span>
									        </div>
									        <img id='img-upload'/>
									    </div>
									</div>
									</div>
									<!-- Fin pide imagen -->
									<div class="form-group">
										<label for="nom" class="control-label">Año de la pelicula: :</label>
										<div class="col-lg-9">
											<input type="text" class="form-control" id="anio_peli" placeholder="Año"  maxlength="25" name="anio_peli"/>
										</div>
									</div>
									<div class="form-group">
										<label for="nom" class="control-label">Nombre director:</label>
										<div class="col-lg-9">
											<input type="text" class="form-control" id="paterno" placeholder="Nombre del director"  required pattern="^[A-ZÑÁÉÍÓÚ][a-zñáéíóú]{1,25}" maxlength="25" name="director_peli"/>
										</div>
									</div>
									<div class="form-group">
									    <label for="exampleFormControlTextarea1">Descripción pelicula</label>
									    <textarea class="form-control" name="descripcion_peli" id="descripcion_peli" rows="3"></textarea>
									  </div>
									<button class="btn btn-lg btn-block btn-dark" id="registrar_lapeli" name="submit" type="submit">Agregar</button>
								</form>
							</div>
						</div>
					</div>

		<script src="../js/jquery-3.3.1.min.js"></script>
		<script src="../js/bootstrap.bundle.js"></script>
		<script src="../js/bootstrap.min.js"></script>
		<script type="text/javascript" src="../templates/main.js"></script>
	</body>
</html>