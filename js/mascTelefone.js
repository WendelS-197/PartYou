function mascTelefone(id){

var numero = document.getElementById(id);


if(numero.value.length == 2){

 	numero.value = "(" + numero.value;
 }

 if(numero.value.length == 3){
 	numero.value = numero.value + ") " ;
 }
 if(numero.value.length == 10){

 	numero.value = numero.value + "-";


 }

}