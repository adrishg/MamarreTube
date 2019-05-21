<?php

	$nombre_peli=$_POST['nombre_peli'];
	$portada_peli=$_POST['portada_peli'];
	$anio_peli=$_POST['anio_peli'];
	$director_peli=$_POST['director_peli'];
	$descripcion_peli=$_POST['descripcion_peli'];
	$link=mysqli_connect("localhost","root","","cinematube");
	if(!$link){
		echo 'RIP aiuda';
	}
		$tildes = $link->query("SET NAMES 'utf8'");
		$SQL='INSERT INTO pelicula 
		(ID_PELICULA, NOMBRE_PELICULA, PORTADA_PELICULA, ANIO_PELICULA, DIRECTOR_PELICULA, DESCRIPCÏON_PELICULA, VISIBILIDAD_PELICULA) values (NULL,"'.$nombre_peli.'","'.$portada_peli.'","'.$anio_peli.'","'.$director_peli.'","'.$descripcion_peli.'",1);';
		mysqli_query($link,$SQL);
		mysqli_close($link);
		echo ''.$SQL.'';
		//header('location:../main.php');
?>
