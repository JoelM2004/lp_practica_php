let perfilService = {
  save: (data) => {
    return fetch("perfil/save", {
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
        if (data.error != "") {
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
  },


  delete: (data) => {
    fetch("perfil/delete", {
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
        if ((data.error = "")) {
          console.log("Error Interno");
        } else {
          console.info("todo bien");
        }
      })
      .catch((error) => {
        console.error("Error en la Petición ", error);
      });
  },

  load: (id) => {
    return fetch(`perfil/load/${id}`, {
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

  update: (data) => {
    return fetch("perfil/update", {
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
        if (data.error != "") {
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
  },
  
  list: () => {
    return fetch("perfil/list", {
      method: "GET",
      headers: {
        "Content-Type": "application/json",
        Accept: "application/json",
      },
    })
      .then((response) => {
        if (!response.ok) {
          throw new Error(`HTTP error! Status: ${response.status}`);
        }
        return response.json();
      })
      .then((data) => {
        return data; // Devuelve los datos obtenidos
      })
      .catch((error) => {
        console.error("Error en la petición de listado de perfiles:", error);
        throw error;
      });
  },
};
