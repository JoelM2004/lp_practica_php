let provinciaController={
    data:{
        id:3,
        nombre:""
    },
    save: () => {
      if (confirm("¿Quieres crear la provincia?")) {
        let provinciaForm = document.forms["provinciaForm"];
        provinciaController.data.nombre = provinciaForm.nombreprovincia.value;
  
        provinciaService.save(provinciaController.data)
          .then((data) => {
            console.log("Guardando Datos");
            // Aquí puedes manejar la respuesta
            if (data.error !== "") {
              alert("Error al guardar la provincia: " + data.error);
            } else {
              alert("Provincia guardada con éxito");
              // Opcional: actualizar la lista o redirigir
              provinciaController.list();
            }
          })
          .catch((error) => {
            console.error("Error en la Petición ", error);
            alert("Ocurrió un error al guardar la provincia");
          });
      }
    },
    delete: () => {
        if (confirm("Quiere eliminar el provincia?")) {
          provinciaController.data.id = document.getElementById("filaModificarProvincia").dataset.id;
          provinciaService.delete(provinciaController.data);
          console.log("Datos Borrados");
        }
      },
    
      update: () => {
        if (confirm("Quieres modificar el provincia?")) {
          provinciaController.data.id = document.getElementById("filaModificarProvincia").dataset.id;
          provinciaController.data.id=parseInt(provinciaController.data.id);
          provinciaController.data.nombre = document.getElementById("nombreProvModificar").value;
          
          provinciaService.update(provinciaController.data)
          .then((data)=>{
            console.log("Actualizando Datos");
            // Aquí puedes manejar la respuesta
            if (data.error !== "") {
              alert("Error al actualizar el provincia: " + data.error);
            } else {
              alert("Provincia actualizado con éxito");
              
            }
  
          }).catch((error)=>{
            console.error("Error en la Petición ", error);
            alert("Ocurrió un error al actualizar el provincia");
          })
      
      }
      },
    
      load: () => {
        const id = document.getElementById("buscarprovincia").value; // Suponiendo que tienes un input con este ID
        provinciaService
          .load(id)
          .then((data) => {
            console.log("provincia listado:", data);
    
            // provinciaController.data.id=data.data.id;
            // provinciaController.data.nombre=data.data.nombre;
    
            if (data.error=== "") {
              let tabla = document.getElementById("tbodyprovinciaes");
              let txt = "";
    
              txt += "<tr>";
              txt += "<th>" + data.result.id + "</th>";
              txt += "<td>" + data.result.nombre + "</td>"; //
              txt +=
                '<td><a href="http://localhost/lp_practica_php/public/provincia/edit/' +
                data.result.id +
                '" class="btn btn-small btn-warning"><i class="fa-solid fa-pen-to-square"></i></a></td>';
              txt += "</tr>";
    
              tabla.innerHTML = txt; // Reemplaza el contenido HTML de la tabla con las filas generadas
            } else {
              alert("provincia no encontrado");
            }
          })
          .catch((error) => {
            console.error("Error al listar provincias:", error);
          });
      },
    
      list: () => {
        console.log("Listando provincias...");
    
        provinciaService
          .list()
          .then((data) => {
            console.log("provinciaes listados:", data);
            // Aquí podrías hacer algo con los datos, como actualizar una lista en la interfaz
            let tabla = document.getElementById("tbodyprovinciaes");
            let txt = "";
    
            data.result.forEach((element) => {
              txt += "<tr>";
              txt += "<th>" + element.id + "</th>";
              txt += "<td>" + element.nombre + "</td>"; //
              txt +=
                '<td><a href="http://localhost/lp_practica_php/public/provincia/edit/' +
                element.id +
                '" class="btn btn-small btn-warning"><i class="fa-solid fa-pen-to-square"></i></a></td>';
              txt += "</tr>";
            });
    
            tabla.innerHTML = txt; // Reemplaza el contenido HTML de la tabla con las filas generadas
          })
          .catch((error) => {
            console.error("Error al listar provinciaes:", error);
          });
      },
    };
    
    document.addEventListener("DOMContentLoaded", () => {
      let btnProvinciaAlta = document.getElementById("btnprovinciaAlta");
      let btnProvinciaBuscar = document.getElementById("btnprovinciaLoad");
      let btnEliminarprovinciaes = document.getElementById("btnEliminarProvincia");
      let btnmodificarprovincia = document.getElementById("btnModificarProvincia");
      let btnprovinciaLoad = document.getElementById("btnprovinciaListar");
    
      if (btnProvinciaAlta != null) {
        provinciaController.list()

        btnProvinciaAlta.addEventListener("click",function(){
          provinciaController.save();
          provinciaController.list()
      })
        btnProvinciaBuscar.onclick = provinciaController.load;
        btnprovinciaLoad.onclick = provinciaController.list;
      } else if(btnmodificarprovincia!=null) {

        btnmodificarprovincia.onclick = provinciaController.update;
        btnEliminarprovinciaes.onclick = provinciaController.delete;
        // btnUsuarioListar.onclick=userController.list;
      
      }
    });