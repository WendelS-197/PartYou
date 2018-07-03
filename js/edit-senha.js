function sConfirmar(){


var verificar = document.getElementsByClassName("edit-senha");
alert(verificar[0].value);
if (verificar[0].value !== verificar[1].value){

	alert("As senhas digiadas não são compatíveis");

	verificar[0].value= "";
	verificar[1].value= "";
}
}