/* Esto es que  el que registra sepa que ambas contraseñas coinciden */
	$("#sena").focus(function() {
		$("#sena").mouseout(function() {
			var contra=$("#contra").val();
			var sena=$("#sena").val();
			if (contra == sena)
			{
				$(this).parent().children(':nth-child(2)').remove();
				// $(this).parent().append('<div class="alert alert-success" role="alert"><strong>Bien</strong> Tus contraseñas coinciden</div>');
			}
			else
			{
				$(this).parent().children(':nth-child(2)').remove();
				$(this).parent().append('<p>WEYYYYY</p>'+contra);
				$(this).parent().append('<p>WEYYYYY</p>'+sena);
				// $(this).parent().append('<div class="alert alert-danger"'+contra+sena+' role="alert"><strong>Error</strong> Tus contraseñas no coinciden</div>');
			}				
		});
	});
	

	/*Desde este punto lo que hace es que valida mediante expresiones regulares, la información que el
	usuario introduce en los formularios*/
	
	$("#nomu").keypress(function(){
		var nom = new RegExp("^[a-zA-Z]{3,20}");
		var unom = $("#nomu").val();
		var comp = unom.search(nom);
		if(comp != false)
		{
			$("#f1").click(function(event){
				event.preventDefault();
			});
		}
	});
	$("#con").keypress(function(){
		var nom = new RegExp("^[a-zA-Z0-9_\.\-\@]{8,15}");
		var unom = $("#con").val();
		var comp = unom.search(nom);
		if(comp != false)
		{
			$("#f1").click(function(event){
				event.preventDefault();
			});
		}
	});
	$("#nombre").keypress(function(){
		var nom = new RegExp("^[a-zA-Z ñáéíóú]{3,30}");
		var unom = $("#nombre").val();
		var comp = unom.search(nom);
		if(comp == false)
			console.log("Bien");
		else
		{
			$("#f1").click(function(event){
				event.preventDefault();
			});
		}
	});
	$("#numero").keypress(function(){
		var nom = new RegExp("^[0-9]{9}");
		var unom = $("#numero").val();
		var comp = unom.search(nom);
		if(comp == false)
			console.log("Bien");
		else
		{
			$("#f1").click(function(event){
				event.preventDefault();
			});
		}
	});
	$("#grupo").keypress(function(){
		var nom = new RegExp("^[0-9]{3}");
		var unom = $("#grupo").val();
		var comp = unom.search(nom);
		if(comp == false)
			console.log("Bien");
		else
		{
			$("#f1").click(function(event){
				event.preventDefault();
			});
		}
	});
	$("#contra").keypress(function(){
		var nom = new RegExp("^[a-zA-Z0-9_\.\-\@]{8,17}");
		var unom = $("#contra").val();
		var comp = unom.search(nom);
		if(comp == false)
		{
			$("#f1").click(function(event){
				event.preventDefault();
			});
		}
	});


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
				$(this).parent().append('<div class="column"><div class="col s3"><div class="card" style="width: 18rem;"><img class="card-img-top" src="IMG/Unknown.png" alt="Card image cap"><div class="card-body"><h5 class="card-title">Divisiones</h5><p class="card-text">Las ramas por la cuál se encuentra divididad la facultad</p><a href="#" class="btn btn-danger" id="Boton2">Ver más</a></div></div></div></div>');
			}
		}
	}    
    
    
    




	$("#sena").keypress(function(){
		var nom = new RegExp("^[a-zA-Z0-9_\.\-\@]{8,17}");
		var unom = $("#sena").val();
		var comp = unom.search(nom);
		if(comp != false)
		{
			$("#f1").click(function(event){
				event.preventDefault();
			});
		}
	});
	
	//Aqui termina la parte de validación
