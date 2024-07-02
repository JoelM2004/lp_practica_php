<div id="carouselExampleCaptions" class="carousel slide" data-bs-ride="false">
  <div class="carousel-indicators">
    <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
    <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="1" aria-label="Slide 2"></button>
    <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="2" aria-label="Slide 3"></button>
  </div>
  <div class="carousel-inner">
    <div class="carousel-item active">
      <img src="assets/img/img1.jpg" class="d-block w-100" alt="...">
      <div class="carousel-caption d-none d-md-block">
        <h2>Usuario</h2>
        <p>
          <a href="<?=APP_FRONT."usuario/create/0" ?>">
            Ver Usuarios
          </a>
        </p>
      </div>
    </div>
    <div class="carousel-item">
      <img src="assets/img/img2.jpg" class="d-block w-100" alt="...">
      <div class="carousel-caption d-none d-md-block">
        <h2>Perfil</h2>
        <p>
          <a href="<?=APP_FRONT."perfil/create/0" ?>">
            Ver Perfiles
          </a>
        </p>
      </div>
    </div>
    <div class="carousel-item">
      <img src="assets/img/img3.jpg" class="d-block w-100" alt="...">
      <div class="carousel-caption d-none d-md-block">
        <h2>Cliente</h2>
        <p>
          <a href="<?=APP_FRONT."cliente/create/0" ?>">
            Ver Clientes
          </a>
        </p>
      </div>
    </div>
    
  </div>
  <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Previous</span>
  </button>
  <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Next</span>
  </button>
</div>


<!-- <?= var_dump($_SESSION["perfilId"])?> 
<?= var_dump($_SESSION["usuario"])?>
<?= var_dump($_SESSION["id"])?> -->