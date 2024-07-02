let perfilController = {
  data: {
    id: 0,
    nombre: "",
  },

  save: () => {
    if (confirm("Quieres crear el perfil?")) {
      let perfilForm = document.forms["perfilForm"];
      
      
      if( (perfilForm.nombrePerfil.value).length >45 ){

        alert("Nombre demasiado largo");

      }else{
        perfilController.data.nombre = perfilForm.nombrePerfil.value;
      }
      


      perfilService.save(perfilController.data)
        .then((data) => {
          console.log("Guardando Datos");
          // Aquí puedes manejar la respuesta
          if (data.error !== "") {
            alert("Error al guardar el perfil: " + data.error);
          } else {
            alert("Perfil guardado con éxito");
            // Opcional: actualizar la lista o redirigir
            perfilController.list();
          }
        })
        .catch((error) => {
          console.error("Error en la Petición ", error);
          alert("Ocurrió un error al guardar el perfil");
        });
    }

  },

  delete: () => {
    if (confirm("Quiere eliminar el perfil?")) {
      perfilController.data.id = document.getElementById("filaModificarPerfil").dataset.id;
      perfilService.delete(perfilController.data);
      console.log("Datos Borrados");
    }
  },

  update: () => {
    if (confirm("Quieres modificar el perfil?")) {
      
      perfilController.data.id =document.getElementById("filaModificarPerfil").dataset.id;
      perfilController.data.id=parseInt(perfilController.data.id);
      perfilController.data.nombre =document.getElementById("nombrePerfil").value;

      perfilService.update(perfilController.data)
        .then((data)=>{
          console.log("Actualizando Datos");
          // Aquí puedes manejar la respuesta
          if (data.error !== "") {
            alert("Error al actualizar el perfil: " + data.error);
          } else {
            alert("Perfil actualizado con éxito");
            
          }

        }).catch((error)=>{
          console.error("Error en la Petición ", error);
          alert("Ocurrió un error al actualizar el perfil");
        })
    
    }
  },

  load: () => {
    const id = document.getElementById("buscarPerfil").value; // Suponiendo que tienes un input con este ID
    perfilService
      .load(id)
      .then((data) => {
        console.log("Perfil listado:", data);

        // perfilController.data.id=data.data.id;
        // perfilController.data.nombre=data.data.nombre;

        if (data.error==="") {
          let tabla = document.getElementById("tbodyPerfiles");
          let txt = "";

          txt += "<tr>";
          txt += "<th>" + data.result.id + "</th>";
          txt += "<td>" + data.result.nombre + "</td>"; //
          txt +=
            '<td><a href="http://localhost/lp_practica_php/public/perfil/edit/' +
            data.result.id +
            '" class="btn btn-sm btn-warning"><i class="fas fa-edit"></i></a></td>';
          txt += "</tr>";

          tabla.innerHTML = txt; // Reemplaza el contenido HTML de la tabla con las filas generadas
        } else {
          alert("Perfil no encontrado");
        }
      })
      .catch((error) => {
        console.error("Error al listar perfiles:", error);
      });
  },


  
  list: () => {
    console.log("Listando perfiles...");

    perfilService
      .list()
      .then((data) => {
        console.log("Perfiles listados:", data);
        // Aquí podrías hacer algo con los datos, como actualizar una lista en la interfaz
        let tabla = document.getElementById("tbodyPerfiles");
        let txt = "";

        data.result.forEach((element) => {
          txt += "<tr>";
          txt += "<th>" + element.id + "</th>";
          txt += "<td>" + element.nombre + "</td>"; //
          txt +=
            '<td><a href="http://localhost/lp_practica_php/public/perfil/edit/' +
            element.id +
            '" class="btn btn-sm btn-warning"><i class="fas fa-edit"></i></a></td>';
          txt += "</tr>";
        });

        tabla.innerHTML = txt; // Reemplaza el contenido HTML de la tabla con las filas generadas
      })
      .catch((error) => {
        console.error("Error al listar perfiles:", error);
      });
  },
};

document.addEventListener("DOMContentLoaded", () => {

  let btnPerfilAlta = document.getElementById("btnPerfilAlta");
  let btnPerfilBuscar = document.getElementById("btnPerfilLoad");
  let btnEliminarPerfiles = document.getElementById("btnEliminarPerfiles");
  let btnmodificarPerfil = document.getElementById("btnmodificarPerfil");
  let btnPerfilLoad = document.getElementById("btnPerfilListar");

  if (btnPerfilAlta != null) {
    perfilController.list()


    btnPerfilAlta.addEventListener("click",function(){
      perfilController.save();
      perfilController.list()
    })
    btnPerfilBuscar.onclick = perfilController.load;
    btnPerfilLoad.onclick = perfilController.list;
  } else {
    btnmodificarPerfil.onclick = perfilController.update;
    btnEliminarPerfiles.onclick = perfilController.delete;
    
  }
});
