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
		
		<title>CinemaTube</title>
		
		<link href="css/bootstrap.min.css" rel="stylesheet"/>
		<link rel="shortcut icon" href="img/clapperboard.png" type="image/png"/>
		<link href="css/stylemain.css"  rel="stylesheet" type="text/css">
	</head>
	<body data-spy="scroll" data-target="#navegacion">
	<!-- Navbar -->
		<div class="container">
			<header>
				<nav class="navbar navbar-expand-lg navbar-light bg-light">
				  <a class="navbar-brand" href="#">CinemaTube</a>
				  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
				    <span class="navbar-toggler-icon"></span>
				  </button>

				  <div class="collapse navbar-collapse" id="navbarSupportedContent">
				    <ul class="navbar-nav mr-auto">
				      <!-- <li class="nav-item active">
				        <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
				      </li>
				      <li class="nav-item">
				        <a class="nav-link" href="#">Link</a>
				      </li>
				      <li class="nav-item dropdown">
				        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
				          Dropdown
				        </a>
				        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
				          <a class="dropdown-item" href="#">Action</a>
				          <a class="dropdown-item" href="#">Another action</a>
				          <div class="dropdown-divider"></div>
				          <a class="dropdown-item" href="#">Something else here</a>
				        </div>
				      </li>
				      <li class="nav-item">
				        <a class="nav-link disabled" href="#">Disabled</a>
				      </li> -->
				    </ul>
				    <form class="my-2 my-lg-0">
				       <button type="button" class="btn btn-dark navbar-btn" data-toggle="modal" data-target="#iniciar"> Iniciar Sesión </button>
					<button type="button" class="btn btn-dark navbar-btn" data-toggle="modal" data-target="#registrar"> Registrarse </button>
				    </form>
				  </div>
				</nav>
			</header>
<!-- Carousel de página de inicio -->
	<div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
	  <div class="carousel-inner">
	    <div class="carousel-item active">
	      <img class="d-block w-100" src="img/carousel_mcu.jpg" alt="First slide">
	    </div>
	    <div class="carousel-item">
	      <img class="d-block w-100" src="img/carousel_budapesthotel.jpg" alt="Second slide">
	    </div>
	    <div class="carousel-item">
	      <img class="d-block w-100" src="img/carousel_starwarsiv.jpg" alt="Third slide">
	    </div>
	  </div>
	  <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
	    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
	    <span class="sr-only">Previous</span>
	  </a>
	  <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
	    <span class="carousel-control-next-icon" aria-hidden="true"></span>
	    <span class="sr-only">Next</span>
	  </a>
	</div>
	<!-- FOOTER -->
		<footer class="page-footer font-small black">

		  <!-- Copyright -->
		  <div class="footer-copyright text-center py-3">© 2019 Proteco:
					<a style="color:black; text-decoration:underline;" data-toggle="modal" data-target="#creditos">Créditos<a>			
		  </div>
		  <!-- Copyright -->

		</footer>
	<!-- /FOOTER -->


	<!-- Modal de inicar sesión -->
		<div class="modal fade" id="iniciar" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
			<div class="modal-dialog" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<h3 class="modal-title" id="myModalLabel">Iniciar Sesión</h3>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					</div>
					<div class="modal-body">
						<div class="row">
							<div class="col-lg-12 col-xs-12">
								<form class="form-horizontal" method="POST" action="templates/usuario.php">
									<div class="form-group">
										<label for="nomu" class="col-lg-3 control-label">Correo: </label>
										<div class="col-lg-9">
											<input type="text" class="form-control" id="correo" placeholder="Correo" name="correo-usuario" required pattern="^[a-zA-Z0-9_\.\-\@]{8,30}"/>
										</div>
									</div>
									<div class="form-group">
										<label for="con" class="col-lg-3 control-label">Contraseña: </label>
										<div class="col-lg-9">
											<input type="password" class="form-control" id="contra" placeholder="Contraseña" name="contra" required pattern="^[a-zA-Z0-9_\.\-\@]{8,17}"/>
										</div>
									</div>
									<button class="btn btn-lg btn-block btn-dark" id="entrar" type="submit">Entrar</button>
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
		<!-- Modal para registro-->
		<div class="modal fade" id="registrar" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
			<div class="modal-dialog" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<h3 class="modal-title" id="myModalLabel">Registrarse</h3>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					</div>
					<div class="modal-body">
						<div class="row">
							<div class="col-lg-12 col-xs-12">
								<form class="form-horizontal" method="POST" action="templates/registro_n1.php" >
									<div class="form-group">
										<label for="nomu" class="control-label">Correo: </label>
										<div class="col-lg-9">
											<input type="text" class="form-control" id="correo" placeholder="Correo" name="correo-usuario" required pattern="^[a-zA-Z0-9_\.\-\@]{8,30}"/>
										</div>
									</div>
									<div class="form-group">
										<label for="nom" class="control-label">Nombre:</label>
										<div class="col-lg-9">
											<input type="text" class="form-control" id="nombre" placeholder="Nombre"  required pattern="^[A-ZÑÁÉÍÓÚ][a-zñáéíóú]{1,10} ([A-ZÑÁÉÍÓÚ][a-zñáéíóú]{1,10} ){1,3}[A-ZÑÁÉÍÓÚ][a-záéíóúñ]{2,10}$" maxlength="60" name="nombre"/>
										</div>
									</div>
									<div class="form-group">
										<label for="nom" class="control-label">Apellido paterno:</label>
										<div class="col-lg-9">
											<input type="text" class="form-control" id="paterno" placeholder="Apellido paterno"  required pattern="^[A-ZÑÁÉÍÓÚ][a-zñáéíóú]{1,10} ([A-ZÑÁÉÍÓÚ][a-zñáéíóú]{1,10} ){1,3}[A-ZÑÁÉÍÓÚ][a-záéíóúñ]{2,10}$" maxlength="60" name="paterno"/>
										</div>
									</div>
									<div class="form-group">
										<label for="nom" class="control-label">Apellido materno: </label>
										<div class="col-lg-9">
											<input type="text" class="form-control" id="materno" placeholder="Apellido materno"  required pattern="^[A-ZÑÁÉÍÓÚ][a-zñáéíóú]{1,10} ([A-ZÑÁÉÍÓÚ][a-zñáéíóú]{1,10} ){1,3}[A-ZÑÁÉÍÓÚ][a-záéíóúñ]{2,10}$" maxlength="60" name="materno"/>
										</div>
									</div>
									<div class="form-group">
										<label for="con" class="control-label">Contraseña: </label>
										<div class="col-lg-9">
											<input type="password" class="form-control" id="contra" placeholder="Contraseña"  required pattern="^[a-zA-Z0-9_\.\-\@]{8,17}$" maxlength="17" name="contra"/>
										</div>
									</div>
									<div class="form-group">
										<label for="cond" class="control-label">Repetir contraseña: </label>
										<div class="col-lg-9">
											<input type="password" class="form-control" id="sena" placeholder="Contraseña"  required pattern="^[a-zA-Z0-9_\.\-\@]{8,17}" maxlength="17" name="sena"/>
										</div>
									</div>
									<button class="btn btn-lg btn-block btn-dark" id="registrarse" type="submit">Registrarse</button>
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
		<script src="js/jquery-3.3.1.min.js"></script>
		<script src="js/bootstrap.min.js"></script>
		<script type="js/bootstrap.bundle.js"></script>
		<script type="text/javascript" src="js/main.js">
		</script>
	</body>
</html>