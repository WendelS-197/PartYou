function cidad(id){
            

            var op1 = document.createElement("option");
            var estado = document.getElementById(id);
            
                while(document.getElementById("cidade").firstChild){
                    document.getElementById("cidade").removeChild(document.getElementById("cidade").firstChild);
                }

                document.getElementById("cidade").appendChild(op1);
                op1.innerHTML="Selecione uma Cidade";

            if(estado.value == "PE"){
                op1 = document.createElement("option");
                document.getElementById("cidade").appendChild(op1);
                op1.innerHTML="Recife";
                op1.value="Recife";
                op1 = document.createElement("option");
                document.getElementById("cidade").appendChild(op1);
                op1.innerHTML="Olinda";
                op1.value="Olinda";
                op1= document.createElement("option");
                document.getElementById("cidade").appendChild(op1);
                op1.innerHTML="Paulista";
                op1.value="Paulista";
            }
            if(estado.value == "PB"){
                op1= document.createElement("option");
                document.getElementById("cidade").appendChild(op1);
                op1.innerHTML="João Pessoa";
                op1= document.createElement("option");
                document.getElementById("cidade").appendChild(op1);
                op1.innerHTML="Campina Grande";
                op1= document.createElement("option");
                document.getElementById("cidade").appendChild(op1);
                op1.innerHTML="Duas Estradas";

            }
            if(estado.value == "AL"){
                op1= document.createElement("option");
                document.getElementById("cidade").appendChild(op1);
                op1.innerHTML="Maceió";
                op1= document.createElement("option");
                document.getElementById("cidade").appendChild(op1);
                op1.innerHTML="Riacho doce";
                op1= document.createElement("option");
                document.getElementById("cidade").appendChild(op1);
                op1.innerHTML="Lagoa da princesa";

            }

        }
