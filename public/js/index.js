var vz = 0
var contar 
var minutos = 0
var segundos = 0
var hora = 0
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
	if (vz == 0) {
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

function pause(){
	clearInterval(contar)
}


function zerartudo(){
	
	
}