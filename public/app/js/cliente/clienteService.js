let clienteService={
    save:(data)=>{
     return fetch("cliente/save",{

            method:"POST",
            headers: {
                "Content-Type":"application/json",
                "Accept":"application/json"
            },
            body:JSON.stringify(data)

        })
        .then(response=>{

            if(!response.ok){
                throw new Error(response.status);

            }

            return response.json();

        })//aca dentro está la funcion monitor
        .then(data=>{

            if(data.error!=""){

                console.log("Error Interno")

            }
            else{

                console.info("todo bien")

            }

            return data
        })
        .catch(error=>{

          console.error("Error en la Petición ",error)
          throw error
        })

    }
    ,
    delete: (data) => {
      return fetch("cliente/delete", {
          method: "POST",
          headers: {
            "Content-Type": "application/json",
            Accept: "application/json",
          },
    
          body: JSON.stringify(data),
        })
          .then((response) => {
            if (!response.ok) {
              throw new Error(response.status);
            }
    
            return response.json();
          })
          .then((data) => {
            if ((data.error != "")) {
              console.log("Error Interno");
            } else {
              console.info("todo bien");
            }

            return data

          })
          .catch((error) => {
            console.error("Error en la Petición ", error);
            return error
          });
      },
    
      load: (id) => {
        return fetch(`cliente/load/${id}`, {
          method: "GET",
          headers: {
            "Content-Type": "application/json",
            Accept: "application/json",
          },
        })
          .then((response) => {
            if (!response.ok) {
              throw new Error(response.status);
            }
            return response.json();
          })
          .then((data) => {
            return data;
          })
          .catch((error) => {
            console.error("Error en la petición: ", error);
            throw error;
          });
      },
      
      update:(data)=>{
    
       return fetch("cliente/update", {
            method: "POST",
            headers: {
              "Content-Type": "application/json",
              "Accept": "application/json",
            },
      
            body: JSON.stringify(data),
          })
            .then((response) => {
              if (!response.ok) {
                throw new Error(response.status);
              }
      
              return response.json();
            })
            .then((data) => {
              if ((data.error != "")) {
                console.log("Error Interno");
              } else {
                console.info("todo bien");
              }

              return data
            })
            
            .catch((error) => {
              console.error("Error en la Petición ", error);
              throw error
            });
    
      }
    ,
    list: () => {
        return fetch("cliente/list", {
            method: "GET",
            headers: {
                "Content-Type": "application/json",
                Accept: "application/json",
            },
        })
        .then(response => {
            if (!response.ok) {
                throw new Error(`HTTP error! Status: ${response.status}`);
            }
            return response.json();
        })
        .then(data => {
            return data; // Devuelve los datos obtenidos
        })
        .catch(error => {
            console.error("Error en la petición de listado de perfiles:", error);
            throw error;
        });
    },


}