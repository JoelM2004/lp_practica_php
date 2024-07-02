    <div class="form-login">
      <div class="text-center">
        <h1>👋</h1>
        <h2>Bienvenido a la Aplicación</h2>
        <p class="text-muted">Ingrese sus datos a continuación...</p>
      </div>
      <form id="formAuth" class="mt-5" action="#">
        <div class="mb-4 col-lg-4 mx-auto">
          <label for="cuentaAuth" class="form-label fw-semibold"
            >Cuenta:</label
          >
          <input
            type="email"
            class="form-control"
            id="cuentaAuth"
            aria-describedby="emailHelp"
            placeholder="Ingrese su Cuenta..."
          />
          
        </div>

        <div class="mb-4 col-lg-4 mx-auto">
          <label for="password" class="form-label fw-semibold">Contraseña:</label>
          <input
            type="password"
            class="form-control"
            id="password"
            placeholder="Ingrese Su contraseña..."
          />
        </div>
        
        <div class="d-grid col-lg-4 mx-auto">
          <button id="btnLogin" type="button" class="btn btn-primary btn-lg">Iniciar Sesión</button>
        </div>
      </form>
    </div>
