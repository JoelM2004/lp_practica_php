<div class="container mt-5">
        <h2 class="mb-4">Datos del Usuario</h2>
        <table class="table table-striped table-hover">
            <thead class="thead-dark">
                <tr>
                    <th>ID</th>
                    <th>Usuario</th>
                    <th>Cuenta</th>
                    <th>Correo</th>
                    <th>Perfil</th>
                    <th>Fecha Alta</th>
                </tr>
            </thead>

            <tbody>
                <?php
                use app\core\model\dao\UsuarioDAO;
                use app\libs\Connection\Connection;

                
                $id = $_SESSION["id"];
                $conn = Connection::get();
                $dao = new UsuarioDAO($conn);
                $datos = $dao->load($id);
                ?>

                <tr id="filaVerUser" data-id=<?=$id?>>
                    <td><?= $datos->getId() ?></td>
                    <td><?= $_SESSION["usuario"] ?></td>
                    <td><?= $datos->getCuenta() ?></td>
                    <td><?= $datos->getCorreo() ?></td> 
                    <td>
                        <?=
                        $_SESSION["perfil"];
                        ?>
                    </td>
                    <td><?= $datos->getFechaAlta() ?></td>
                </tr>
            </tbody>
        </table>

        

        <div class="container">

                    <form id="formContraseña">
                        <div class="mb-3">
                        <label for="claveModificar">Ingrese su Contraseña Nueva si desea cambiarla:</label>
                            <input type="password" name="claveModificar" id="claveModificar" placeholder="Contraseña nueva aquí...">
                        </div>
                    </form>

                    <button id="cambiarPass" type="button" class="btn btn-danger">Cambiar Contraseña</button>

        </div>
    </div>