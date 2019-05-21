<?php
$link=mysqli_connect("localhost","root","","cinematube");
$peliculasDisponibles = mysqli_query($link,"SELECT * FROM pelicula WHERE VISIBILIDAD_PELICULA=1")
$peliculaArray = array()
    while($row = mysqli_fetch_assoc($result)){
        $data[] = $row
    }
    echo json_encode($data);
?>
