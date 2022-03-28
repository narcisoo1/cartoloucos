$(document).ready(function(){
	/* handling form validation */
	$("#login-form").validate({
		rules: {
			password: {
				required: false,
			},
			username: {
				required: false,
				email: false
			},
		},
		messages: {
			password:{
			  required: "Por favor insira sua senha"
			 },
			username: "Por favor insira seu usuário",
		},
		submitHandler: submitForm	
	});	

	//Validação botão login

	//desativa botão login
	document.getElementById("login-submit").disabled = true;

	//cria um event listener que escuta mudanças no input
	document.getElementById("username").addEventListener("input", function(event){

	//busca conteúdo do input
		var conteudo = document.getElementById("username").value;
		//valida conteudo do input 
		if (conteudo !== null && conteudo !== '') {
			if(document.getElementById("password").value !== null && document.getElementById("password").value !== ''){
				//habilita o botão
				document.getElementById("login-submit").disabled = false;
			}else{
				document.getElementById("login-submit").disabled = true;
			}
		
		} else {
		//desabilita o botão se o conteúdo do input ficar em branco
		document.getElementById("login-submit").disabled = true;
		}
	});
	//cria um event listener que escuta mudanças no input
	document.getElementById("password").addEventListener("input", function(event){

		//busca conteúdo do input
			var conteudo = document.getElementById("password").value;
			//valida conteudo do input 
			if (conteudo !== null && conteudo !== '') {
				if(document.getElementById("username").value !== null && document.getElementById("username").value !== ''){
					//habilita o botão
					document.getElementById("login-submit").disabled = false;
				}else{
					document.getElementById("login-submit").disabled = true;
				}
			
			} else {
			//desabilita o botão se o conteúdo do input ficar em branco
			document.getElementById("login-submit").disabled = true;
			}
		});
	

	/* Handling login functionality */
	function submitForm() {		
		var data = $("#login-form").serialize();
		$.ajax({				
			type : 'POST',
			url  : 'response.php?action=login',
			data : data,
			beforeSend: function(){	
				$("#error").fadeOut();
				$("#login_button").html('<span class="glyphicon glyphicon-transfer"></span> &nbsp; sending ...');
			},
			success : function(response){			
				if($.trim(response) === "1"){
					console.log('dddd');									
					$("#login-submit").html('Signing In ...');
					setTimeout(' window.location.href = "index.php"; ',2000);
				} else {									
					$("#error").fadeIn(1000, function(){						
						$("#error").html(response).show();
					});
				}
			}
		});
		return false;
	}

	/* Handling login functionality */
	function logout() {
		console.log('fdfdf');
		$.ajax({				
			type : 'POST',
			url  : 'response.php?action=logout',
			data : data,
			success : function(response){
				window.location.href = "/index.php";
			}
		});
		return false;
	}   
});