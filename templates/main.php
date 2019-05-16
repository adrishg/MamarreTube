<?php
	SESSION_START();
	SESSION_DESTROY();
?>
<!DOCTYPEhtml>
<html>
	<head>
		<meta charset="utf-8"/>
		<meta http-equiv="X-UA-Compatible" content="IE=edge"/>
		<meta name="viewpiort" content="width=device-width, initial-scale=1"/>
		
		<title>Coyote quiz</title>
		
		<link href="../Documents/bootstrap/css/bootstrap.min.css" rel="stylesheet"/>
		<link rel="shortcut icon" href="../Sources/Resources/prepa 6.jpg" type="image/png"/>
		<link href="../Style/stylemain.css"  rel="stylesheet" type="text/css">
	</head>
	<body data-spy="scroll" data-target="#navegacion">
	
		<div class="container">
			<header>
				<nav class="navbar navbar-default navbar-fixed-top" role="navegation" id="part-top">
					<div class="row">
						<div class="col-lg-5 col-lg-offset-1 col-md-7 col-md-offset-1 col-sm-7 col-sm-offset-1">
							<div class="navbar-header">
								<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navegacion">
									<span class="sr-only">Mostrar navegación</span>
									<span class="icon-bar"></span>
									<span class="icon-bar"></span>
									<span class="icon-bar"></span>
								</button>
								<a href="https://www.unam.mx/" class="navbar-brand" id="imag-unam"><img alt="Brand" src="../Sources/Resources/esc-unam.png" height="140%"/></a>
								<a href="./main.php"><p class="navbar-text" id="text">PUMA QUIZ</p></a>
							</div>	
						</div>	
						<div class="col-lg-4 col-lg-offset-2 col-md-4 col-sm-4">
							<div class="collapse navbar-collapse" id="navegacion">
									<button type="button" class="btn btn-primary navbar-btn" data-toggle="modal" data-target="#iniciar"> Iniciar Sesión </button>
									<button type="button" class="btn btn-primary navbar-btn" data-toggle="modal" data-target="#registrar"> Registrarse </button>
							</div>
						</div>	
					</div>
				</nav>
			</header>
			<div class="main" id="conten-main">
				<div class="row">
					<div class="col-lg-10 col-lg-offset-1 col-md-10 col-md-offset-1 col-sm-10 col-sm-offset-1 col-xs-10 col-xs-offset-1" id="carruselc">
							<div id="carouselimg" class="carousel slide" data-ride="carousel">
								<ol class="carousel-indicators">
									<li data-target="#carouselimg" data-slide-to="0" class="active"></li>
									<li data-target="#carouselimg" data-slide-to="1"></li>
									
								<!--<li data-target="#carousel-example-generic" data-slide-to="2"></li>-->
								
								</ol>
								<div class="carousel-inner" role="listbox" id="carrusel">
									<div class="item active" height="90px">
										<div style="text-align:center;">
											<img src="../Sources/Resources/enp2.png" height="60px" alt="fondo rojo" id="fr"/>
										</div>
									</div>
									<div class="item">
										<div style="text-align:center;">
											<img src="../Sources/Resources/unam_edi.jpg" alt="fondo amarillo" id="fa" class="img-rounded"/> 
										</div>
										<div class="carousel-caption">
											<p> </p>
										</div>
									</div>
								</div>
							</div>
							<a class="left carousel-control" href="#carouselimg" role="button" data-slide="prev">
								<span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
								<span class="sr-only">Anterior</span>
							</a>
							<a class="right carousel-control" href="#carouselimg" role="button" data-slide="next">
								<span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
								<span class="sr-only">Siguiente</span>
							</a>
					</div>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-lg-12 navbar-fixed-bottom">
				<footer class="texblack text-center" id="part-bottom">
				<div class="row">
					<div class="col-xs-6 col-xs-offset-2">
						Hecho en México. Todos los derechos reservados.
					<br/>
					<a style="color:black; text-decoration:underline;" data-toggle="modal" data-target="#creditos">Créditos<a>
					</div>
					<div class="col-xs-3">
						<script type="text/javascript" src="http://counter10.freecounter.ovh/private/countertab.js?c=be4eea864ac19ffe185b34c27b8e1bf6"> </script>
					</div>
				</div>
				</footer>
			</div>
		</div>
		<div class="modal fade" id="iniciar" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
			<div class="modal-dialog" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						<h3 class="modal-title" id="myModalLabel">Iniciar Sesión</h3>
					</div>
					<div class="modal-body">
						<div class="row">
							<div class="col-lg-12 col-xs-12">
								<form class="form-horizontal" method="POST" action="./usuario.php">
									<div class="form-group">
										<label for="nomu" class="col-lg-3 control-label">Nombre de Usuario:</label>
										<div class="col-lg-9">
											<input type="text" class="form-control" id="nomu" placeholder="Nombre de Usuario" name="nom-usuario" required pattern="^[\wÑñ]{3,20}"/>
										</div>
									</div>
									<div class="form-group">
										<label for="con" class="col-lg-3 control-label">Contraseña: </label>
										<div class="col-lg-9">
											<input type="password" class="form-control" id="con" placeholder="Contraseña" name="contra" required pattern="^[a-zA-Z0-9_\.\-\@]{8,17}"/>
										</div>
									</div>
									<button class="btn btn-lg btn-block btn-primary" id="entrar" type="submit">Entrar</button>
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
		<div class="modal fade" id="registrar" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
			<div class="modal-dialog" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						<h3 class="modal-title" id="myModalLabel">Registrarse <small>Únicamente como estudiante</small></h3>
					</div>
					<div class="modal-body">
						<div class="row">
							<div class="col-lg-12 col-xs-12">
								<form class="form-horizontal" method="POST" action="./registro_n1.php" >
									<div class="form-group">
										<label for="nom" class="col-lg-3 control-label">Nombre Completo</label>
										<div class="col-lg-9">
											<input type="text" class="form-control" id="nombre" placeholder="Nombre Completo"  required pattern="^[A-ZÑÁÉÍÓÚ][a-zñáéíóú]{1,10} ([A-ZÑÁÉÍÓÚ][a-zñáéíóú]{1,10} ){1,3}[A-ZÑÁÉÍÓÚ][a-záéíóúñ]{2,10}$" maxlength="60" name="nombre"/>
										</div>
									</div>
									<div class="form-group">
										<label for="nom" class="col-lg-3 control-label">Nombre Usuario</label>
										<div class="col-lg-9">
											<input type="text" class="form-control" id="usuario" placeholder="Nombre de Usuario"  required pattern="^[\wÑñ0-9]{3,20}$" maxlength="20" name="usuarion"/>
										</div>
									</div>
									<div class="form-group">
										<label for="num" class="col-lg-3 control-label">Número de cuenta</label>
										<div class="col-lg-9">
											<input type="text" class="form-control" id="numero" placeholder="Número de cuenta" required pattern="^[0-9]{9}$" maxlength="9" name="numero"/>
										</div>
									</div>
									<div class="form-group">
										<label for="gru" class="col-lg-3 control-label">Grupo</label>
										<div class="col-lg-9">
											<input type="text" class="form-control" id="grupo" placeholder="Grupo"  required pattern="^[0-9]{3}$" maxlength="3" name="grupo"/>
										</div>
									</div>
									<div class="form-group">
										<label for="con" class="col-lg-3 control-label">Contraseña: </label>
										<div class="col-lg-9">
											<input type="password" class="form-control" id="contra" placeholder="Contraseña"  required pattern="^[a-zA-Z0-9_\.\-\@]{8,17}$" maxlength="17" name="contra"/>
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
		<div class="modal fade" id="creditos" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
			<div class="modal-dialog" role="document">
				<div class="modal-content">
					<div class="modal-header text-center">
						<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						<h3 class="modal-title" id="myModalLabel">Equipo de Desarrollo</h3>
					</div>
					<div class="modal-body">
						<div class="row">
							<div class="col-lg-12 col-xs-12">
								<div class="text-center">
									<h4><u>Alumnos de la opcion tecnica en computacion de la prepa 6</u></h4>
									<br/>
									<p>Avalos Ramón</p> 
									<p>García Domínguez Mario Angel</p>
									<p>Martinez Martos Arturo Cesar</p> 
									<p>Hernández González Adriana</p> 
									<p>Rodriguez Cabo Gerardo Trejo</p>
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
		<script src="../Documents/jquery.js"></script>
		<script src="../Documents/bootstrap/js/bootstrap.min.js"></script>
		<script type="text/javascript" src="main.js">
		</script>
	</body>
</html>