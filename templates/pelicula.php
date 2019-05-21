<?php
$peliculasDisponibles = mysqli_query($link,"SELECT * FROM pelicula WHERE VISIBILIDAD_PELICULA=AQUIQUEES EL QUEDEBE IR?")
$peliculaArray = array()
    while($row = mysqli_fetch_assoc($result)){
        $data[] = $row
    }
    echo json_encode($data);
?>