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
