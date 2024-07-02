let clienteController = {
  data: {
    id: 0,
    apellido: "Mercado",
    nombre: "Joel",
    dni: "45383601",
    cuit: "45383612",
    tipo: "Persona",
    provinciaId: 17,
    localidad: "Caleta Olivia",
    telefono: "29747679823",
    correo: "Joelmercado@gmail.com",
  },

  save: () => {
    if (confirm("Quieres crear el cliente?")) {
      let form = document.forms["formCliente"];


      if((form.apellidoCliente.value).length>45){
        alert("Supero el limite de caracteres con su apellido")
      } else{clienteController.data.apellido = form.apellidoCliente.value;}

      if((form.nombreCliente.value).length>45){
        alert("Supero el limite de caracteres con su nombre")
      } else{clienteController.data.nombre = form.nombreCliente.value;}

      if((form.dniCliente.value).length>=9||form.dniCliente.value.length<=6 ){
        alert("Escriba un DNI válido")
      }else{clienteController.data.dni = form.dniCliente.value; }

      if((form.cuitCliente.value).length>=12||form.cuitCliente.value.length<=9 ){
        alert("Escriba un CUIT válido")
      }else{clienteController.data.cuit = form.cuitCliente.value }
      
      clienteController.data.tipo = form.tipoCliente.value;
      clienteController.data.provinciaId = parseInt(form.provinciaCliente.value);

      if((form.localidadCliente.value).length>45){
        alert("Supero el limite de caracteres con su localidad" )
      } else{clienteController.data.localidad = form.localidadCliente.value;}
      
      if(((form.telefonoCliente.value).length>45)||(form.telefonoCliente.value.length<10)){
        alert("Introduzca un telefono válido")
      } else{clienteController.data.telefono = form.telefonoCliente.value;}

      if((form.emailCliente.value).length>255){
        alert("Supero el limite de caracteres con su correo")
      }else{clienteController.data.correo = form.emailCliente.value;}


      clienteService.save(clienteController.data)
      .then((data)=>{
        console.log("Guardando Datos");
        // Aquí puedes manejar la respuesta
        if (data.error !== "") {
          alert("Error al guardar el cliente: " + data.error);
        } else {
          alert("Cliente guardado con éxito");
        }

      }).catch((error)=>{
        console.error("Error en la Petición ", error);
        alert("Ocurrió un error al guardar el cliente");
      })
  
      // setTimeout(() => {
      //   location.reload();
      // }, 300);
    }
  },
  list: () => {
    console.log("Listando Clientes...");

    clienteService
      .list()
      .then((data) => {
        console.log("Clientes listados:", data);
        // Aquí podrías hacer algo con los datos, como actualizar una lista en la interfaz
        let tabla = document.getElementById("tbodyCliente");
        let txt = "";

        let provinciaPromises = data.result.map((element) => {
          return provinciaService.load(element.provinciaId)
            .then((provinciaData) => {
              return provinciaData.result.nombre;
            })
            .catch((error) => {
              console.error("Error al cargar la provincia:", error);
              return "Provincia no encontrada";
            });
        });

        Promise.all(provinciaPromises).then((provincias) => {
          data.result.forEach((element, index) => {
            txt += "<tr>";
            txt += "<th>" + element.id + "</th>";
            txt += "<td>" + element.apellido + "</td>"; //
            txt += "<td>" + element.nombre + "</td>";
            txt += "<td>" + element.dni + "</td>"; //
            txt += "<td>" + element.cuit + "</td>";
            txt += "<td>" + element.tipo + "</td>"; //
            txt += "<td>" + provincias[index] + "</td>";
            txt += "<td>" + element.localidad + "</td>"; //
            txt += "<td>" + element.telefono + "</td>";
            txt += "<td>" + element.correo + "</td>"; //

            txt +=
              '<td><a href="http://localhost/lp_practica_php/public/cliente/edit/' +
              element.id +
              '" class="btn btn-sm btn-warning"><i class="fas fa-edit"></i></a></td>';
            txt += "</tr>";
          });

          tabla.innerHTML = txt; // Reemplaza el contenido HTML de la tabla con las filas generadas
        })
        .catch((error) => {
          console.error("Error al obtener nombres de provincias:", error);
        });
      })
      .catch((error) => {
        console.error("Error al listar Clientes:", error);
      });
  },

  load: () => {
    const id = document.getElementById("buscarCliente").value; // Suponiendo que tienes un input con este ID

    clienteService
      .load(id)
      .then((data) => {
        console.log("Cliente listado:", data);

        if (data.error === "") {
          let tabla = document.getElementById("tbodyCliente");
          let txt = "";

          // Promesa para cargar la provincia del cliente
          const provinciaPromise = provinciaService
            .load(data.result.provinciaId)
            .then((provinciaData) => {
              return provinciaData.result.nombre;
            })
            .catch((error) => {
              console.error("Error al cargar la provincia ", error);
              return "Provincia no Encontrada";
            });

          // Espera a que la promesa de provincia se resuelva antes de continuar
          Promise.all([provinciaPromise])
            .then(([provinciaNombre]) => {
              txt += "<tr>";
              txt += "<th>" + data.result.id + "</th>";
              txt += "<td>" + data.result.apellido + "</td>"; //
              txt += "<td>" + data.result.nombre + "</td>";
              txt += "<td>" + data.result.dni + "</td>"; //
              txt += "<td>" + data.result.cuit + "</td>";
              txt += "<td>" + data.result.tipo + "</td>"; //
              txt += "<td>" + provinciaNombre + "</td>";
              txt += "<td>" + data.result.localidad + "</td>"; //
              txt += "<td>" + data.result.telefono + "</td>";
              txt += "<td>" + data.result.correo + "</td>"; //

              txt +=
                '<td><a href="http://localhost/lp_practica_php/public/cliente/edit/' +
                data.result.id +
                '" class="btn btn-sm btn-warning"><i class="fas fa-edit"></i></a></td>';
              txt += "</tr>";

              tabla.innerHTML = txt; // Reemplaza el contenido HTML de la tabla con las filas generadas
            })
            .catch((error) => {
              console.error("Error al obtener nombre de provincia:", error);
            });
        } else {
          alert("Perfil no encontrado");
        }
      })
      .catch((error) => {
        console.error("Error al cargar cliente:", error);
      });
  },
  
  delete: () => {
    if (confirm("Quiere eliminar el perfil?")) {
      clienteController.data.id = document.getElementById(
        "filaModificarCliente"
      ).dataset.id;

      clienteService.delete(clienteController.data).then((data)=>{
        alert(data.mensaje)
      }).catch((error) => {
        // Maneja cualquier error que ocurra durante el cambio de contraseña
        console.error('Error al eliminar el cliente:', error);
        alert('Hubo un problema al eliminar el cliente. Por favor, inténtelo de nuevo más tarde.');
      });
    }
  },

  update: () => {
    if (confirm("Quieres modificar el cliente?")) {



      let form = document.forms["formModificarCliente"];
      clienteController.data.id = document.getElementById(
        "filaModificarCliente"
      ).dataset.id;

      clienteController.data.id = parseInt(clienteController.data.id);
       
    
      clienteController.data.apellido = form.apellidoClienteMOD.value;
      clienteController.data.nombre = form.nombreClienteMOD.value;
      clienteController.data.dni = form.dniClienteMOD.value;
      clienteController.data.cuit = form.cuitClienteMOD.value;
      clienteController.data.tipo = form.tipoClienteMOD.value;
      clienteController.data.provinciaId = parseInt(
        form.provinciaClienteMOD.value
      );
      clienteController.data.localidad = form.localidadClienteMOD.value;
      clienteController.data.telefono = form.telefonoClienteMOD.value;
      clienteController.data.correo = form.emailClienteMOD.value;

      if((form.apellidoClienteMOD.value).length>45){
        alert("Supero el limite de caracteres con su apellido")
      } else{clienteController.data.apellido = form.apellidoClienteMOD.value;}

      if((form.nombreClienteMOD.value).length>45){
        alert("Supero el limite de caracteres con su nombre")
      } else{clienteController.data.nombre = form.nombreClienteMOD.value;}

      if((form.dniClienteMOD.value).length>=9||form.dniClienteMOD.value.length<=6 ){
        alert("Escriba un DNI válido")
      }else{clienteController.data.dni = form.dniClienteMOD.value; }

      if((form.cuitClienteMOD.value).length>=12||form.cuitClienteMOD.value.length<=9 ){
        alert("Escriba un CUIT válido")
      }else{clienteController.data.cuit = form.cuitClienteMOD.value }
  
      clienteController.data.tipo = form.tipoClienteMOD.value;
      clienteController.data.provinciaId = parseInt(
            form.provinciaClienteMOD.value
      );

      if((form.localidadClienteMOD.value).length>45){
        alert("Supero el limite de caracteres con su localidad" )
      } else{clienteController.data.localidad = form.localidadClienteMOD.value;}
      
      if(((form.telefonoClienteMOD.value).length>45)||(form.telefonoClienteMOD.value.length<10)){
        alert("Introduzca un telefono válido")
      } else{clienteController.data.telefono = form.telefonoClienteMOD.value;}

      if((form.emailClienteMOD.value).length>255){
        alert("Supero el limite de caracteres con su correo")
      }else{clienteController.data.correo = form.emailClienteMOD.value;}

      clienteService.update(clienteController.data)
      .then((data)=>{
        console.log("actualizando Datos");
        // Aquí puedes manejar la respuesta
        if (data.error !== "") {
          alert("Error al actualizar el cliente: " + data.error);
        } else {
          alert("Cliente actualizado con éxito");
          
        }

      }).catch((error)=>{
        console.error("Error en la Petición ", error);
        alert("Ocurrió un error al actualizar el cliente");
      })
    }
}
}

document.addEventListener("DOMContentLoaded", () => {
  let btnClienteAlta = document.getElementById("btnGuardarCliente");
  let btnClienteBuscar = document.getElementById("btnClienteLoad");
  let btnEliminarClientes = document.getElementById("btnEliminarClientes");
  let btnmodificarCliente = document.getElementById("btnModificarCliente");
  let btnPerfilLoad = document.getElementById("btnClienteListar");

  if (btnClienteAlta != null) {
    clienteController.list();

    btnClienteAlta.addEventListener("click", function () {
      clienteController.save();
      clienteController.list();
    });

    btnClienteBuscar.onclick = clienteController.load;
    btnPerfilLoad.onclick = clienteController.list;
  } else {
    btnmodificarCliente.onclick = clienteController.update;
    btnEliminarClientes.onclick = clienteController.delete;
  }
});
