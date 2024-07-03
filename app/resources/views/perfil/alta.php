
<div class="container-fluid row">

<form class="col-4" id="perfilForm">

<div class="mb-3">
      <label for="buscarPerfil" class="form-label">Buscar Perfil</label>
      <input type="number" class="form-control" id="buscarPerfil">
      <button  id="btnPerfilLoad" type="button" class="btn btn-primary mt-3">Buscar</button>
      <button id="btnPerfilListar" type="button" class="btn btn-primary mt-3">Listar todos los perfiles</button>
    </div>


  <div class="mb-3">
    <label for="nombrePerfil" class="form-label">Nombre del Perfil</label>
    <input type="text" class="form-control" id="nombrePerfil">
  </div>


  <button type="button" id="btnPerfilAlta" class="btn btn-primary">Cargar Perfil</button>
  
</form>

  <div class="col-8 p-4">
    <table class="table table-light" >
      <thead >
      <tr>
          <th colspan="11">
            Listado de Perfiles
          </th>
        </tr>
        <tr>
          <th scope="col">id</th>
          <th scope="col">Nombre</th>
        <th></th>
        </tr>
      </thead>
      <tbody id="tbodyPerfiles">
      
      </tbody>
    </table>
  </div>
</div>