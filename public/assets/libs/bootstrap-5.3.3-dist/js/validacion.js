// Example starter JavaScript for disabling form submissions if there are invalid fields

  function toggleInputs(){
    var tipo = document.getElementById("tipoCliente").value;
    var cuitInput = document.getElementById("cuitCliente");
    var dniInput = document.getElementById("dniCliente");
    if (tipo === "Empresa") {
        cuitInput.disabled = false;
        dniInput.disabled = true;
        dniInput.value=""
    } else {
        cuitInput.disabled = true;
        dniInput.disabled = false;
        cuitInput.value="";
      }
}

function toggleInputsMOD(){
  var tipo = document.getElementById("tipoClienteMOD").value;
  var cuitInput = document.getElementById("cuitClienteMOD");
  var dniInput = document.getElementById("dniClienteMOD");
  
  if (tipo === "Empresa") {
      cuitInput.disabled = false;
      dniInput.disabled = true;
      dniInput.value=""
  } else {
      cuitInput.disabled = true;
      dniInput.disabled = false;
      cuitInput.value="";
    }
}


document.addEventListener("DOMContentLoaded",()=>{

  let tipo= document.getElementById("tipoCliente")
  let tipoMOD= document.getElementById("tipoClienteMOD")


  if(tipo!=null){

    tipo.onchange=toggleInputs;
    toggleInputs
  }else if(tipoMOD!=null){

    tipoMOD.onchange=toggleInputsMOD
    toggleInputsMOD

  }


}
)