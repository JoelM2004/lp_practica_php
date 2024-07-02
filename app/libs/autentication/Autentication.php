<?php

namespace app\libs\autentication;

use app\libs\connection\Connection;

final class Autentication
{
    public static function login($user, $pass): void
    {
        $conn = Connection::get();

        $sql = "SELECT CONCAT(u.nombres, ',', u.apellido) AS usuario,
        
               u.cuenta,
               u.clave,
               u.perfilId,
               p.nombre AS perfilNombre,
               u.estado,
               u.horaEntrada,
               u.horaSalida,
               u.resetear,
               u.id

        FROM usuarios u

        INNER JOIN perfiles p ON u.perfilId = p.id

        WHERE u.cuenta = :cuenta";

        $stmt = $conn->prepare($sql);

        if (!$stmt->execute(["cuenta" => $user])) {
            throw new \Exception("No se pudo <i>ejecutar</i> la consulta");
        }

        if ($stmt->rowCount() !== 1) {
            throw new \Exception("La contraseña o usuario es inválido usuario");
        }

        $cuenta = $stmt->fetch(\PDO::FETCH_ASSOC);

        // print_r($cuenta);
        if (!password_verify($pass, $cuenta['clave'])) {
            throw new \Exception("La contraseña o usuario es inválido contraseña");
        }

        if ($cuenta['estado'] !== 1) {
            throw new \Exception("Su cuenta está inactiva");
        }

        if ($cuenta['resetear'] !== 0) {
            throw new \Exception("Su cuenta caducada");
        }

        // Pasó las validaciones, la cuenta es válida
        // se crean las variables de sesión;
        $_SESSION["token"] = APP_TOKEN;
        $_SESSION["usuario"] = $cuenta['usuario'];
        $_SESSION["perfil"] = $cuenta['perfilNombre'];
        $_SESSION["id"] = $cuenta['id'];

    }





    public static function logout(): void
    {

        session_unset();
        if (ini_get("session.use_cookies")) {
            $params = session_get_cookie_params();
            setcookie(
                session_name(),
                '',
                time() - 42000,
                $params["path"],
                $params["domain"],
                $params["secure"],
                $params["httponly"]
            );
        }
        session_destroy();
    }
}
