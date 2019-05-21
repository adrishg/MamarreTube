    var ajax = new XMLHttpRequest();
	var method = "GET";
	var url = "pelicula.php"
	var asynchronous = true;
	ajax.open(method,url,asynchronous);
	ajax.send()
	ajax.onreadystatechange = function(){
		if(this.readyState == 4 && this.status == 200){
			var data = JSON.parse(this.responseText);
			console.log(data);

			var html = "";

			for(var a = 0; a<data.length;a++){
				$(#pelicula).parent().append('<div class="column"><div class="col s3"><div class="card" style="width: 18rem;"><img class="card-img-top" src="IMG/Unknown.png" alt="Card image cap"><div class="card-body"><h5 class="card-title">Divisiones</h5><p class="card-text">Las ramas por la cuál se encuentra divididad la facultad</p><a href="#" class="btn btn-danger" id="Boton2">Ver más</a></div></div></div></div>');
			}
		}
	}
