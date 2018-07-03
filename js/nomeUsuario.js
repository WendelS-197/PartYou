function mascUsuario(id){
 var campo = document.getElementById(id);

 if(campo.value.length == 0){

 	campo.value = "@" + campo.value;
 }
}

function sEspaco(id){
 var campo = document.getElementById(id);

 var caractere = campo.value.split(" ");
campo.value = caractere.join("");

}

