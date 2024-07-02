let userController = {
  data: {
    id: 0,
    apellido: "mercado",
    nombres: "joel",
    cuenta: "JM2004",
    clave: "joel1234",
    correo: "joel@gmail.com.ar",
    perfilId:1,
    horaEntrada: "10:01:32",
    horaSalida: "10:08:32",
    resetear:0,
    estado: "1",
  },
  save: () => {
    if (confirm("¿Seguro que lo quieres guardar?")) {
      let form = document.forms["formUsuario"];


      if((form.apellidoUsuario.value).length>45){
        alert("Supero el limite de caracteres con su apellido")
      } else{userController.data.apellido = form.apellidoUsuario.value;}

      if((form.nombreUsuario.value).length>45){
        alert("Supero el limite de caracteres con su nombre")
      } else{userController.data.nombres = form.nombreUsuario.value;}

      if((form.cuentaUsuario.value).length>45){
        alert("Supero el limite de caracteres con su cuenta")
      } else{userController.data.cuenta = form.cuentaUsuario.value;}

    if((form.claveUsuario.value).length>6 && (form.claveUsuario.value).length<45){
      userController.data.clave = form.claveUsuario.value;

    } else{ alert("Su clave es demasiado corta o muy largo (7 a 44 caracteres)")}


    // userController.data.perfilId= form.tipoCliente.value
    // clienteController.data.provinciaId= form.provinciaCliente.value
    userController.data.horaEntrada = form.horaEntrada.value;
    userController.data.horaSalida = form.horaSalida.value;
    
    if((form.emailUsuario.value).length>255){
      alert("El correo es muy largo")
    }else {userController.data.correo = form.emailUsuario.value;}
    
    userController.data.perfilId=form.perfilId.value;
    userController.data.perfilId=parseInt(userController.data.perfilId)


      userService.save(userController.data)
      .then((data)=>{
        console.log("Guardando Datos");
        // Aquí puedes manejar la respuesta
        if (data.error !== "") {
          alert("Error al guardar el user: " + data.error);
        } else {
          alert("user guardado con éxito");
          
        }

      }).catch((error)=>{
        console.error("Error en la Petición ", error);
        alert("Ocurrió un error al guardar el user");
      })
    }
  },

  delete: () => {
    if (confirm("¿Seguro que lo quieres elimnar?")) {
      userController.data.id = document.getElementById(
        "filaModificarUsuario"
      ).dataset.id;

      userService.delete(userController.data).then((data)=>{
        alert(data.mensaje)
      }).catch((error) => {
        // Maneja cualquier error que ocurra durante el cambio de contraseña
        console.error('Error al eliminar el Usuario:', error);
        alert('Hubo un problema al eliminar el Usuario. Por favor, inténtelo de nuevo más tarde.');
      });
      

    }
  },

  update: () => {
    if (confirm("¿Seguro que lo quieres actualizar?")) {
      let form = document.forms["formActualizarUsuario"];
      userController.data.id = document.getElementById("filaModificarUsuario").dataset.id;
      userController.data.id = parseInt(userController.data.id);
      
      userController.data.apellido = form.apellidoUsuarioMod.value;
      userController.data.nombres = form.nombreUsuarioMod.value;
      userController.data.cuenta = form.cuentaUsuarioMod.value;
      userController.data.horaEntrada = form.horaEntradaMod.value;
      userController.data.horaSalida = form.horaSalidaMod.value;
      userController.data.correo = form.emailUsuarioMod.value;

      if((form.apellidoUsuarioMod.value).length>45){
        alert("Supero el limite de caracteres con su apellido")
      } else{userController.data.apellido = form.apellidoUsuarioMod.value;}

      if((form.nombreUsuarioMod.value).length>45){
        alert("Supero el limite de caracteres con su nombre")
      } else{userController.data.nombres = form.nombreUsuarioMod.value;}

      if((form.cuentaUsuarioMod.value).length>45){
        alert("Supero el limite de caracteres con su cuenta")
      } else{userController.data.cuenta = form.cuentaUsuarioMod.value;}


      userController.data.horaEntrada = form.horaEntradaMod.value;
      userController.data.horaSalida = form.horaSalidaMod.value;
      
      if((form.emailUsuarioMod.value).length>255){
        alert("El correo es muy largo")
      }else {userController.data.correo = form.emailUsuarioMod.value;}

      userController.data.perfilId=form.perfilIdMod.value;
      userController.data.perfilId=parseInt(userController.data.perfilId)

      userService.update(userController.data)
      .then((data)=>{
        console.log("Actualizando Datos");
        // Aquí puedes manejar la respuesta
        if (data.error !== "") {
          alert("Error al actualizar el user: " + data.error);
        } else {
          alert("user actualizado con éxito");
          
        }

      }).catch((error)=>{
        console.error("Error en la Petición ", error);
        alert("Ocurrió un error al actualizar el perfil");
      })

    }
  },

  list: () => {
    console.log("Listando Usuarios...");

    userService
      .list()
      .then((data) => {
        console.log("Usuarios listados:", data);
        let tabla = document.getElementById("tbodyUsuario");
        let txt = "";

        // Array para almacenar todas las promesas de carga de perfiles
        let perfilPromises = data.result.map((element) => {
          // Crea una promesa para cargar el perfil
          return perfilService.load(element.perfilId)
            .then((perfilData) => {
              return perfilData.result.nombre;
            })
            .catch((error) => {
              console.error("Error al cargar perfil:", error);
              return "Perfil no encontrado"; // O algún valor por defecto
            });
        });

        // Espera a que todas las promesas de perfiles se resuelvan
        Promise.all(perfilPromises)
          .then((perfiles) => {
            data.result.forEach((element, index) => {
              txt += "<tr>";
              txt += "<th>" + element.id + "</th>";
              txt += "<td>" + element.apellido + "</td>";
              txt += "<td>" + element.nombres + "</td>";
              txt += "<td>" + element.cuenta + "</td>";
              txt += "<td>" + element.correo + "</td>";
              txt += "<td>" + perfiles[index] + "</td>";

              if (element.estado === 1) {
                txt += "<td> <i class='fas fa-circle text-success'></i> </td>";
              } else {
                txt += "<td> <i class='fas fa-circle text-danger'></i> </td>";
              }

              txt += "<td>" + element.horaEntrada + "</td>";
              txt += "<td>" + element.horaSalida + "</td>";
              txt += "<td>" + element.fechaAlta + "</td>";
              txt += '<td><a href="http://localhost/lp_practica_php/public/usuario/edit/' + element.id + '" class="btn btn-sm btn-warning"><i class="fas fa-edit"></i></a></td>';
              txt += "</tr>";
            });

            tabla.innerHTML = txt; // Reemplaza el contenido HTML de la tabla con las filas generadas
          })
          .catch((error) => {
            console.error("Error al obtener nombres de perfiles:", error);
          });

      })
      .catch((error) => {
        console.error("Error al listar Usuarios:", error);
      });
},


  load: () => {
    console.log("Cargando Usuario...");

    const id = document.getElementById("buscarUsuario").value; // Obtener el ID del usuario desde el input

    userService
      .load(id)
      .then((data) => {
        console.log("Usuario cargado:", data);

        if (data.error === "") {
          let tabla = document.getElementById("tbodyUsuario");
          let txt = "";

          const perfilPromise = perfilService.load(data.result.perfilId)
            .then((perfilData) => {
              return perfilData.result.nombre;
            })
            .catch((error) => {
              console.error("Error al cargar perfil:", error);
              return "Perfil no encontrado"; // O algún valor por defecto
            });

          Promise.all([perfilPromise])
            .then(([perfilNombre]) => {
              txt += "<tr>";
              txt += "<th>" + data.result.id + "</th>";
              txt += "<td>" + data.result.apellido + "</td>";
              txt += "<td>" + data.result.nombres + "</td>";
              txt += "<td>" + data.result.cuenta + "</td>";
              txt += "<td>" + data.result.correo + "</td>";
              txt += "<td>" + perfilNombre + "</td>";

              if (data.result.estado === 1) {
                txt += "<td> <i class='fas fa-circle text-success'></i> </td>";
              } else {
                txt += "<td> <i class='fas fa-circle text-danger'></i> </td>";
              }

              txt += "<td>" + data.result.horaEntrada + "</td>";
              txt += "<td>" + data.result.horaSalida + "</td>";
              txt += "<td>" + data.result.fechaAlta + "</td>";
              txt += '<td><a href="http://localhost/lp_practica_php/public/usuario/edit/' + data.result.id + '" class="btn btn-sm btn-warning"><i class="fas fa-edit"></i></a></td>';
              txt += "</tr>";

              tabla.innerHTML = txt; // Reemplaza el contenido HTML de la tabla con la fila generada
            })
            .catch((error) => {
              console.error("Error al obtener nombre del perfil:", error);
            });
        } else {
          alert("Usuario no encontrado");
        }
      })
      .catch((error) => {
        console.error("Error al cargar usuario:", error);
      });
  },


  enable: () => {
    if (confirm("¿Seguro que quieres habilitar el Usuario?")) {
      userController.data.id = document.getElementById(
        "filaModificarUsuario"
      ).dataset.id;
      userController.data.id = parseInt(userController.data.id);
      userController.data.estado = 1;

      userService.enable(userController.data).then((data)=>{
        alert(data.mensaje);
        setTimeout(() => {
          location.reload();
        }, 300);
      }).
      
      catch((error) => {
        // Maneja cualquier error que ocurra durante el cambio de contraseña
        console.error('Error al cambiar al activar la cuenta:', error);
        alert(error);
      });
  }
},

  disable: () => {
    if (confirm("¿Seguro que quieres deshabilitar el Usuario?")) {
      userController.data.id = document.getElementById(
        "filaModificarUsuario"
      ).dataset.id;
      userController.data.id = parseInt(userController.data.id);
      userController.data.estado = 0;

      userService.disable(userController.data).then((data)=>{
        alert(data.mensaje);
        setTimeout(() => {
          location.reload();
        }, 300);
      }).
      
      catch((error) => {
        // Maneja cualquier error que ocurra durante el cambio de contraseña
        console.error('Error al cambiar al desactivar la cuenta:', error);
        alert(error);
      });
    
    }
  },

  reset: () => {
    if (confirm("¿Seguro que quieres resetear el Usuario?")) {
      userController.data.id = document.getElementById(
        "filaModificarUsuario"
      ).dataset.id;
      userController.data.id = parseInt(userController.data.id);
      userController.data.resetear = 1;

      userService.reset(userController.data).then((data)=>{
        alert(data.mensaje);
        setTimeout(() => {
          location.reload();
        }, 300);
      }).
      
      catch((error) => {
        // Maneja cualquier error que ocurra durante el cambio de contraseña
        console.error('Error al resetear la cuenta:', error);
        alert(error);
      });
    }
  },

  changePassword:()=>{

    if (confirm("¿Seguro que quieres cambiar la contraseña del Usuario?")) {
      userController.data.id = document.getElementById("filaVerUser").dataset.id;
      userController.data.id = parseInt(userController.data.id);
      
      $clave=document.getElementById("claveModificar").value;
      
      if($clave.length<6) {
        alert("La nueva contraseña es muy corta")
      }else{

      userController.data.clave = $clave  

      userService.changePassword(userController.data)
      .then((data)=>{
        alert(data.mensaje)
      })
      .catch((error) => {
        // Maneja cualquier error que ocurra durante el cambio de contraseña
        console.error('Error al cambiar la contraseña:', error);
        alert('Hubo un problema al cambiar la contraseña. Por favor, inténtelo de nuevo más tarde.');
      });

    }

      // .then((data)=>{




      // }

      // );


    //   setTimeout(() => {
    //     location.reload();
    //   }, 300);
     }

  }
}

document.addEventListener("DOMContentLoaded", () => {
  let btnUsuarioAlta = document.getElementById("btnUsuarioAlta");
  let btnEliminarUsuarios = document.getElementById("btnEliminarUsuarios");
  let btnUsuarioListar = document.getElementById("btnUsuarioListar");
  let modificarUsuario = document.getElementById("modificarUsuario");
  let btnUsuarioLoad = document.getElementById("btnUsuarioLoad");

  let resetearUsuario =document.getElementById("resetearUsuario")
  let habilitarUsuario = document.getElementById("habilitarUsuario");
  let deshabilitarUsuario = document.getElementById("deshabilitarUsuario");

  let cambiarPass=document.getElementById("cambiarPass");

  if (btnUsuarioAlta != null) {
    userController.list();

    btnUsuarioAlta.addEventListener("click",function(){
      userController.save()
      userController.list()
    })
    // btnUsuarioAlta.onclick = userController.save;
    btnUsuarioListar.onclick = userController.list;
    btnUsuarioLoad.onclick = userController.load;
  } else if(resetearUsuario!=null) {
    resetearUsuario.onclick= userController.reset
    habilitarUsuario.onclick = userController.enable;
    deshabilitarUsuario.onclick = userController.disable;
    modificarUsuario.onclick = userController.update;
    btnEliminarUsuarios.onclick = userController.delete;
    // btnUsuarioListar.onclick=userController.list;
  }

  else{
    if(cambiarPass!=null)
    cambiarPass.onclick=userController.changePassword;

  }
});
