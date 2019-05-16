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
		<div class="container" id="cuer">
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
				//$row = array("mario","mariomario");
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
						$nomb = $_POST['nom-usuario'];
						echo $nomb;
						$consulta =  'SELECT * FROM usuarios WHERE USUARIO_NOMBRE="'.$nomb.'"';
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
				$_SESSION['usuario'] = $arr[1];
				$_SESSION['key'] = $arr[2];
				$_SESSION['color'] = $arr[4];
			}
			}
			if(isset($_SESSION['tipo']) && isset($_SESSION['usuario']) && isset($_SESSION['key']))
			{
				$enlace=mysqli_connect("localhost","root","","prueba");
				if(!$enlace)
					echo 'hubo un error';
				else
				{
					$lectura = 'SELECT IMAGEN FROM USUARIOS WHERE USUARIO_NOMBRE="'.$_SESSION['usuario'].'"';
					$image = mysqli_query($enlace,$lectura);
					$arr = array();
					if($image != false)
						while($row = mysqli_fetch_assoc($image))
						{
							foreach($row as $re)
							{
								$imagen[]=$re;
							}
						}
					$fecha=date('Y/m/d');
					$nuevafecha='UPDATE usuarios SET FECHA_CONECT="'.$fecha.'" WHERE USUARIO_NOMBRE="'.$_SESSION['usuario'].'"';
					mysqli_query($enlace,$nuevafecha);
				}
				mysqli_close($enlace);
				echo '<header>
					<nav class="navbar navbar-default navbar-fixed-top" role="navegation" id="part-top">
						<div class="row">
							<div class="col-lg-5 col-lg-offset-1 col-md-4 col-md-offset-1 col-sm-4 col-sm-offset-1">
								<div class="navbar-header">
									<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navegacion">
										<span class="sr-only">Mostrar navegación</span>
										<span class="icon-bar"></span>
										<span class="icon-bar"></span>
										<span class="icon-bar"></span>
									</button>
									<a href="./usuario.php" class="navbar-brand" id="imag-unam">';
									if(isset($imagen))
									{
										if($imagen[0]=='0')
										{
											echo '<img src="../Sources/Resources/sombra.jpg" alt="sombra" height="140%"/>';
										}
										else
										{
											echo '<img src="data:image/jpg;base64,'.base64_encode($imagen[0]).'" height="140%"/>';
										}
									}
									echo '</a><p id="text" class="navbar-text">'.$_SESSION['usuario'].'</p>
								</div>	
							</div>	
							<div class="col-lg-5 col-lg-offset-1 col-md-7 col-sm-7">
								<div class="collapse navbar-collapse" id="navegacion">';
									if($_SESSION['tipo']=='1') //Pone distintos navs para cada tipo de usuario
									{
										echo '<a href="juego_menu1.php" style="color:white;"><button type="button" class="btn btn-primary navbar-btn dropdow"> Jugar </button></a>';
										echo ' <a href="puntajes.php"><button type="button" class="btn btn-primary navbar-btn"> Puntajes </button></a>';
									}
									else
									{
										if($_SESSION['tipo']=='2')
										{
											echo '<button type="button" class="btn btn-primary navbar-btn" data-toggle="modal" data-target="#regis_preg"> Preguntas </button>';
											echo ' <button type="button" class="btn btn-primary navbar-btn"> Puntajes de alumnos </button>';
										}
										else
										{
											if($_SESSION['tipo']=='3')
											{
												echo '<button type="button" class="btn btn-primary navbar-btn" data-toggle="modal" data-target="#regis_prof"> Registrar Profesores </button>';
												echo ' <a href="coor_preguntas.php"<button type="button" class="btn btn-primary navbar-btn"> Preguntas </button></a>';
											}
											else
											{
												if($_SESSION['tipo']=='4')
												{
													echo '<button type="button" class="btn btn-primary navbar-btn" data-toggle="modal" data-target="#regis_coord"> Registrar coordinadores </button>';
													echo ' <a href="./admin_usuarios.php"><button type="button" class="btn btn-primary navbar-btn"> Usuarios </button></a>';
													echo ' <button type="button" class="btn btn-primary navbar-btn"> Uso mensual </button>';
												}
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
							echo '<div class="jumbotron col-lg-7 col-lg-offset-1 col-md-7 col-md-offset-1 col-sm-7 col-sm-offset-1 col-xs-7 col-xs-offset-1">
								<h1>Hola, '.$_SESSION['usuario'].'.</h1>
								<p>Bienvenido al portal de alumnos de la Escuela Nacional Preparatoria más famosa</p>
								<br/><p>*Ptsss,ptsss*<br/>
								¿Tienes dificultades al responder las preguntas?</p>
								<p>Checa los enlaces de aqui abajo :)<br/>
								<i title="SABER UNAM es una página que tiene evaluaciones, guias y examenes diagnosticos que te puede servir como apoyo para tus materias">SABER UNAM:</i> <a href="https://www.saber.unam.mx:6061/saber/faces/home/login.jsp" target="_blank">Click aqui</a><br/>
								<i title="OBJETOS UNAM ofrece guias interactivas que explican los temas visto en clase de manera agradable">OBJETOS UNAM:</i> <a href="http://objetos.unam.mx/" target="_blank">Click aqui</a><br/>
								<i title="En los colegios de cada materia, se encuentran guías de todo el curso de una materia">DGENP:</i> <a href="http://dgenp.unam.mx/" target="_blank">Click aqui</a></p>
							</div>
						</div>
				</div>';
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
		
		
		
		<div class="modal fade" id="regis_coord" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
			<div class="modal-dialog" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						<h3 class="modal-title" id="myModalLabel">Registrar Coordinadores</h3>
					</div>
					<div class="modal-body">
						<div class="row">
							<div class="col-lg-12 col-xs-12">
								<form class="form-horizontal" method="POST" action="./registro_cordinador.php" >
									<div class="form-group">
										<label for="nom" class="col-lg-3 control-label">Nombre Completo: </label>
										<div class="col-lg-9">
											<input type="text" class="form-control" id="nombre" placeholder="Nombre Completo"  required pattern="^[A-ZÑÁÉÍÓÚ][a-zñáéíóú]{1,10} ([A-ZÑÁÉÍÓÚ][a-zñáéíóú]{1,10} ){1,3}[A-ZÑÁÉÍÓÚ][a-záéíóúñ]{2,10}$" name="nombre"/>
										</div>
									</div>
									<div class="form-group">
										<label for="nom" class="col-lg-3 control-label">Nombre de Usuario: </label>
										<div class="col-lg-9">
											<input type="text" class="form-control" id="usuario" placeholder="Nombre de Usuario"  required pattern="^[a-zA-Zñáéíóú0-9]{3,15}" maxlength="15" name="usuarion"/>
										</div>
									</div>
									<div class="form-group">
										<label for="num" class="col-lg-3 control-label">Número de cuenta</label>
										<div class="col-lg-9">
											<input type="text" maxlength="9" class="form-control" id="numero" placeholder="Número de cuenta" required pattern="^[0-9]{9}" name="numero"/>
										</div>
									</div>
									<div class="form-group">
										<label for="gru" class="col-lg-3 control-label">Asignatura: </label>
										<div class="col-lg-9">
											<input type="text" class="form-control" id="grupo" placeholder="Asignatura"  required pattern="^[A-zÁÉÍÓÚÑáéíóúñ]{3,30}" name="asig"/>
										</div>
									</div>
									<div class="form-group">
										<label for="con" class="col-lg-3 control-label">Contraseña: </label>
										<div class="col-lg-9">
											<input type="password" class="form-control" id="contra" placeholder="Contraseña"  required pattern="^[a-zA-Z0-9_\.\-\@]{8,17}" maxlength="17" name="contra"/>
										</div>
									</div>
									<div class="form-group">
										<label for="cond" class="col-lg-3 control-label">Repetir Contraseña: </label>
										<div class="col-lg-9">
											<input type="password" class="form-control" id="sena" placeholder="Contraseña"  required pattern="^[a-zA-Z0-9_\.\-\@]{8,17}" maxlength="17" name="sena"/>
										</div>
									</div>
									<button class="btn btn-lg btn-block btn-primary" id="registrarse" type="submit">Registrarse</button>
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
		
		
		
		
		<div class="modal fade" id="regis_prof" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
			<div class="modal-dialog" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						<h3 class="modal-title" id="myModalLabel">Registrar profesor. </h3>
					</div>
					<div class="modal-body">
						<div class="row">
							<div class="col-lg-12 col-xs-12">
								<form class="form-horizontal" method="POST" action="registro_profesor.php" >
									<div class="form-group">
									<label for="nombre" class="col-lg-3 control-label">Nombre completo: </label>
										<div class="col-lg-9">
											<input type="text" class="form-control" id="nombre" name="nombre" placeholder="Nombre Completo"  required pattern="^^[A-ZÑÁÉÍÓÚ][a-zñáéíóú]{1,10} ([A-ZÑÁÉÍÓÚ][a-zñáéíóú]{1,10} ){1,3}[A-ZÑÁÉÍÓÚ][a-záéíóúñ]{2,10}$"/>
										</div>
									</div>
									<div class="form-group">
									<label for="usuario" class="col-lg-3 control-label">Nombre usuario: </label>
										<div class="col-lg-9">
											<input type="text" class="form-control" id="usuario" name="usuario" placeholder="Nombre de Usuario"  required pattern="^[a-zA-Z0-9_/./-/@]{3,20}"/>
										</div>
									</div>
									<div class="form-group">
										<label for="numero" class="col-lg-3 control-label">Clave de profesor(RFC):</label>
										<div class="col-lg-9">
											<input type="text" class="form-control" id="numero" name="numero" placeholder="RFC"  required pattern="^[a-zA-Z0-9]{12,13}"/>
										</div>
									</div>
									<div class="form-group">
										<label for="num" class="col-lg-3 control-label">Asignatura:</label>
										<div class="col-lg-9">
											<input type="text" class="form-control" id="asignatura" name="asignatura" placeholder="Clave de la asignatura"  required pattern="^[a-zA-Z ñáéíóú]{5,15}"/>
										</div>
									</div>
									<div class="form-group">
										<label for="num" class="col-lg-3 control-label">Preparatoria:</label>
										<div class="col-lg-9">
											<select class="form-control" name="prepa">
											<option value="1">Preparatoria 1 "Gabino Barreda"</option>
											<option value="2">Preparatoria 2 "Erasmo C.Quinto"</option>
											<option value="3">Preparatoria 3 "Justo Sierra"</option>
											<option value="4">Preparatoria 4 "Vidal Castañeda y N."</option>
											<option value="5">Preparatoria 5 "José Vasconcelos"</option>
											<option value="6">Preparatoria 6 "Antonio Caso"</option>
											<option value="7">Preparatoria 7 "Ezequiel A Chávez"</option>
											<option value="8">Preparatoria 8 "Miguel E Schulz"</option>
											<option value="9">Preparatoria 9 "Pedro de Alba"</option>
											</select>
										</div>
									</div>
									<div class="form-group">
										<label for="con" class="col-lg-3 control-label">Contraseña: </label>
										<div class="col-lg-9">
											<input type="password" class="form-control" id="contra"name="contra" placeholder="Contraseña"  required pattern="^[a-zA-Z0-9_\.\-\@]{8,15}"/>
										</div>
									</div>
									<div class="form-group">
										<label for="cond" class="col-lg-3 control-label">Repetir Contraseña: </label>
										<div class="col-lg-9">
											<input type="password" class="form-control" id="sena" name="sena" placeholder="Contraseña"  required pattern="^[a-zA-Z0-9_\.\-\@]{8,15}"/>
										</div>
									</div>
									<button class="btn btn-lg btn-block btn-primary" id="registrarse"type="submit">Registrarse</button>
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
		
		
		
		
		<div class="modal fade" id="regis_preg" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
			<div class="modal-dialog" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						<h3 class="modal-title" id="myModalLabel">Registrar preguntas. </h3>
					</div>
					<div class="modal-body">
						<div class="row">
							<div class="col-lg-12 col-xs-12">
								<form class="form-horizontal" method="POST" action="./registro_preguntas.php" >
									<div class="form-group">
									<label for="grado" class="col-lg-3 control-label">Grado: </label>
										<div class="col-lg-9">
											<select class="form-control" name="grado" id="grado">
											<option></option>
											<option value="1">Cuarto Año</option>
											<option value="2">Quinto Año</option>
											<option value="3">Sexto Año: Área I</option>
											<option value="4">Sexto Año: Área II</option>
											<option value="5">Sexto Año: Área III</option>
											<option value="6">Sexto Año: Área IV</option>+
											</select>
										</div>
									</div>
									<div class="form-group">
									<label for="nom" class="col-lg-3 control-label">Unidad: </label>
										<div class="col-lg-9">
											<select class="form-control" name="unidad">
											<option value="1">1</option>
											<option value="2">2</option>
											<option value="3">3</option>
											<option value="4">4</option>
											<option value="5">5</option>
											<option value="6">6</option>
											<option value="7">7</option>
											<option value="8">8</option>
											<option value="9">9</option>
											</select>
										</div>
									</div>
									<div class="form-group">
									<label for="nom" class="col-lg-3 control-label">Pregunta: </label>
										<div class="col-lg-9">
											<input type="text" class="form-control" id="pregunta" name="pregunta" placeholder="Pregunta"  required pattern="^[a-zA-Z0-9 ÑÁÉÍÓÚñáéíóú_\.\-\@\+\-\*\.\?\¿\={5,100}"/>
										</div>
									</div>
									<div class="form-group">
										<label for="num" class="col-lg-3 control-label">Respuesta correcta:</label>
										<div class="col-lg-9">
											<input type="text" class="form-control" id="correcta" name="correcta" placeholder="Respuesta"  required pattern="^[a-zA-Z0-9 ÑÁÉÍÓÚñáéíóú]{1,40}"/>
										</div>
									</div>
									<div class="form-group">
										<label for="num" class="col-lg-3 control-label">Respuesta:</label>
										<div class="col-lg-9">
											<input type="text" class="form-control" id="uno" name="uno" placeholder="Respuesta"  required pattern="^[a-zA-Z0-9 ÑÁÉÍÓÚñáéíóú]{1,40}"/>
										</div>
									</div>
									<div class="form-group">
										<label for="con" class="col-lg-3 control-label">Respuesta: </label>
										<div class="col-lg-9">
											<input type="text" class="form-control" id="dos"name="dos" placeholder="Respuesta"  required pattern="^[a-zA-Z0-9 ÑÁÉÍÓÚñáéíóú]{1,40}"/>
										</div>
									</div>
									<div class="form-group">
										<label for="cond" class="col-lg-3 control-label">Respuesta: </label>
										<div class="col-lg-9">
											<input type="text" class="form-control" id="tres" name="tres" placeholder="Respuesta"  required pattern="^[a-zA-Z0-9 ÑÁÉÍÓÚñáéíóú]{1,40}"/>
										</div>
									</div>
									<button class="btn btn-lg btn-block btn-primary" id="registrarse"type="submit">Enviar</button>
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
		
		
		
		
		<script src="../Documents/jquery.js"></script>
		<script src="../Documents/bootstrap/js/bootstrap.min.js"></script>
		<script type="text/javascript" src="main.js"></script>
	</body>
</html>