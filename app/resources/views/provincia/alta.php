
<div class="container-fluid row">




<form class="col-4" id="provinciaForm">


<div class="input-group mb-3">
      <button class="btn btn-primary" type="button" id="btnprovinciaLoad">Buscar</button>
      <input id="buscarprovincia" type="text" class="form-control" placeholder="Escriba el ID de la Provincia" aria-label="Example text with button addon" aria-describedby="button-addon1">
    </div>

<div class="mb-3">
      <button id="btnprovinciaListar" type="button" class="btn btn-primary mt-3">Listar todos los provincias</button>
    </div>


  <div class="mb-3">
    <label for="nombreprovincia" class="form-label">Nombre del provincia</label>
    <input type="text" class="form-control" id="nombreprovincia">
  </div>


  <button type="button" id="btnprovinciaAlta" class="btn btn-primary">Cargar provincia</button>
  
</form>

  <div class="col-8 p-4">
    <table class="table table-dark" >
      <thead >
        <tr>
          <th scope="col">id</th>
          <th scope="col">Nombre</th>
        <th></th>
        </tr>
      </thead>
      <tbody id="tbodyprovinciaes">
      
      </tbody>
    </table>
  </div>
</div>