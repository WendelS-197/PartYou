function sConfirm(){


var verificar = document.getElementsByClassName("conf-passwd");

if (verificar[0].value !== verificar[1].value){

	alert("As senhas digiadas não são compatíveis");

	verificar[0].value= "";
	verificar[1].value= "";
}
}