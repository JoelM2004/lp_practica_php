let authController = {
  data: {
      usuario: "joel1234",
      clave: "joel1234"
  },

 /* cuenta usuario ADMIN:
  

 contraseña 123456
  */
  login: ()=>{
      let form = document.forms["formAuth"];

      authController.data.usuario=form.cuentaAuth.value;
      authController.data.clave=form.password.value

      authService.login(authController.data)
      .then(response => {
          if(response.error === "" && response.mensaje === "OK"){
              window.location.href = "inicio/index"
          }
          else{

            alert(response.error)

          }
      })
  }


  
}

document.addEventListener("DOMContentLoaded", ()=>{
  let btnLogin = document.getElementById("btnLogin")
  btnLogin.onclick = () => {
      authController.login()
  }
})