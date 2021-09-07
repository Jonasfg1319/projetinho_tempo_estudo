var vz = 0
var contar 
var minutos = 0
var segundos = 0
var hora = 0
var controla_negrito = false
var mostra = false
var cronometro_iniciado = false
var editor_notas = false

function finalizar(){
	if(vz == 0){
			let inp = document.createElement("input")
			inp.type = "text"
			inp.placeholder = "Faça uma anotação"
		    inp.className = "form-control"
		    inp.name = "anotacao"
            
            let inp2 = document.createElement("input")
		    inp2.type = "submit"
		    inp2.className = "form-control btn btn-warning p-2"
            
            let inp3 = document.createElement("input")
		    inp3.hidden = "true"
		    inp3.name = "horas"
		    inp3.value = document.getElementById("contador").innerText

		    
            document.getElementById("formulario").appendChild(inp)
			document.getElementById("formulario").appendChild(inp2)
		    document.getElementById("formulario").appendChild(inp3)
		    
		    //alert(document.getElementById("contador").innerText)
		    
		  }
	vz = 1
}

function iniciar_cronometro(){
	if (vz == 0 && cronometro_iniciado == false) {
    cronometro_iniciado = true
	contar = setInterval(function(){
		printsegundos = segundos<10?"0"+segundos:segundos
    	printminutos = minutos<10?"0"+minutos:minutos
    	printhora = hora<10?"0"+hora:hora
    	segundos += 1
    	document.getElementById('contador').innerHTML = printhora+": "+printminutos+": "+printsegundos
    	document.getElementsByTagName("title").innerHTML = printhora+": "+printminutos+": "+printsegundos
    	if(segundos>59){
    		segundos = 0
    		minutos += 1
    		if(minutos > 59){
    			minutos = 0
    			hora += 1
    	}
      }
	},1000)


}


}



function pegar_nota(user,reg){
    
    event.preventDefault();
    $.ajax({
        data: XMLHttpRequest.responseText,
        url: `/nota?reg=${reg}&us=${user}`,
        type: "GET",
        dataType: "html",
        success: function(data){
            //alert(data);   // retorna toda a página     
            var xxx = $(data).filter("#nota");
            var x2 = $(data).filter("#titulo");
            document.getElementById("documento").innerHTML = xxx.html()
            document.getElementById("titulo").value = x2.html()
                 
        },
        error: function(){
            alert("Problema ao carregar a solicitação via Ajax.");
        }
    });



 }

function negrito(){
    if(controla_negrito == false){
	document.getElementById("documento").style.fontWeight = "bold"
    controla_negrito = true
   }else{
   	document.getElementById("documento").style.fontWeight = ""
   	 controla_negrito = false
   }
} 

function manipula_nota(){
    if(mostra == false){
      document.getElementById("lista_notas").hidden = false
      mostra = true   
    }else{
    	document.getElementById("lista_notas").hidden = true
    	mostra = false 
    }
}

function pause(){
	clearInterval(contar)
    cronometro_iniciado = false
}


function zerartudo(){
	
	
}



function renderiza_editor_de_notas(){
    //code
    if(editor_notas == false){
        
        titulo = document.createElement("input")
        titulo.name = "titulo"
        titulo.className = "form-control"

        label_titulo = document.createElement('label')
        label_titulo.innerHTML = "Titulo"

        label_conteudo = document.createElement('label')
        label_conteudo.innerHTML = "Conteudo"

        conteudo = document.createElement('textarea')
        conteudo.name = "conteudo"
        conteudo.className = "conteudo-notas form-control p-1"
        notas_div = document.getElementById('notas')
      
        
        notas_div.appendChild(label_titulo)
        notas_div.appendChild(titulo)
        notas_div.appendChild(label_conteudo)
        notas_div.appendChild(conteudo)

        editor_notas = true
   }
}


function salvar_nota(){
    event.preventDefault()

    let dados = $("formulario_nota").serialize()
     
     $.ajax({
        url: "/cadastra_nota",
        type: "post",
        data: dados,
        dataType: "text",
        success: () => {
          alert("Foi")
         
        },
        error : () => {
          alert("Erro")
        }
     
  })

}