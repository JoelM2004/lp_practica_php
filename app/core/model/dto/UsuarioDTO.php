<?php

namespace app\core\model\dto;

use app\core\model\base\InterfaceDTO;

final class UsuarioDTO implements InterfaceDTO
{

    private $id, $apellido, $nombres, $cuenta, $clave, $correo, $perfilId;
    private $estado, $horaEntrada, $horaSalida, $fechaAlta, $resetear;

    public function __construct($data = [])
    {

        $this->setId($data["id"] ?? 0);
        $this->setApellido($data["apellido"] ?? "");
        $this->setNombres($data["nombres"] ?? "");
        $this->setCuenta($data["cuenta"] ?? "");
        $this->setClave($data["clave"] ?? "");

        $this->setCuenta($data["cuenta"] ?? "");
        $this->setCorreo($data["correo"] ?? "");
        $this->setPerfilId($data["perfilId"] ?? 0);
        $this->setEstado($data["estado"] ?? 1);

        $this->setHoraEntrada($data["horaEntrada"] ?? "");
        $this->setHoraSalida($data["horaSalida"] ?? "");

        $this->setFechaAlta($data["fechaAlta"] ?? "");
        $this->setResetear($data["resetear"] ?? 0);
    }



    //Getters//
    public function getId(): int
    {
        return $this->id;
    }

    public function getApellido(): string
    {
        return $this->apellido;
    }

    public function getNombres(): string
    {
        return $this->nombres;
    }

    public function getCuenta(): string
    {
        return $this->cuenta;
    }

    public function getClave(): string
    {
        return $this->clave;
    }

    public function getCorreo(): string
    {
        return $this->correo;
    }

    public function getPerfilId(): int
    {
        return $this->perfilId;
    }

    public function getEstado(): int
    {
        return $this->estado; //que sea de uno solo
    }

    public function getHoraEntrada(): string
    {
        return $this->horaEntrada; // QUE TENGA LOS 2 DIGITOS DE HORA, : Y 2 DIGITOS ALIDA
    }

    public function getHoraSalida(): string
    {
        return $this->horaSalida;
    }

    public function getFechaAlta(): string
    {
        return $this->fechaAlta;
    }

    public function getResetear(): int
    {
        return $this->resetear;
    }

    //Setters//
    public function setId($id): void
    {
        $this->id = (is_integer($id) && $id > 0) ? $id : 0;
    }

    public function setApellido($apellido): void
    {
        $this->apellido = is_string($apellido) && (strlen(trim($apellido)) <= 45) ? trim($apellido) : "";
    }

    public function setNombres($nombres): void
    {
        $this->nombres = is_string($nombres) && (strlen(trim($nombres)) <= 45) ? trim($nombres) : "";
    }

    public function setCorreo($correo): void
    {
        $patron = '/^([a-zA-Z0-9_\-\.]+)@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/';

        if (preg_match($patron, $correo) && (strlen(trim($correo)) <= 255)) {
            $this->correo = trim($correo);
        } else {
            $this->correo = "";
        }
    }

    public function setCuenta($cuenta): void
    {
        $this->cuenta = is_string($cuenta) && (preg_match('/^[a-zA-Z0-9]{6,45}$/', $cuenta)) && (strlen(trim($cuenta)) <= 45)
            ? $cuenta
            : "";
    }

    public function setClave($clave): void
    {
        $this->clave = is_string($clave)&&(preg_match('/^[a-zA-Z0-9]{6,255}$/', $clave)) && (strlen(trim($clave)) <= 255) ? trim($clave) : "";
    }

    public function setPerfilId($clave): void // consultar
    {
        $this->perfilId = (is_integer($clave) && $clave > 0) ? $clave : 0;
    }

    public function setEstado($estado): void
    {
        $this->estado = ($estado === 0 || $estado === 1) ? trim($estado) : 1;
    }

    public function setHoraEntrada($hora): void
    {
        if(strlen($hora)==5){

            $hora.=":00";

        }

        $pattern = '/^(?:[01]\d|2[0-3]):[0-5]\d:[0-5]\d$/';

        if (is_string($hora) && preg_match($pattern, $hora)) {
            $this->horaEntrada = $hora;
        } else {
            $this->horaEntrada = "";
        }
    }

    public function setHoraSalida($hora): void
    {

        if(strlen($hora)==5){

            $hora.=":00";

        }

        $pattern = '/^(?:[01]\d|2[0-3]):[0-5]\d:[0-5]\d$/';

        if (is_string($hora) && preg_match($pattern, $hora)) {
            $this->horaSalida = $hora;
        } else {
            $this->horaSalida = "";
        }
    }

    public function setFechaAlta($fecha): void
    {
        // Patrón para "año-mes-día hora:minuto:segundo"
        $pattern = '/^(19|20)\d\d\-(0[1-9]|1[0-2])\-(0[1-9]|[12][0-9]|3[01]) (?:[01]\d|2[0-3]):[0-5]\d:[0-5]\d$/';

        if (is_string($fecha) && preg_match($pattern, $fecha)) {
            list($date, $time) = explode(' ', $fecha);
            list($año, $mes, $dia) = explode('-', $date);

            if (checkdate($mes, $dia, $año)) {
                $this->fechaAlta = $fecha;
            } else {
                $this->fechaAlta = "";
            }
        } else {
            $this->fechaAlta = "";
        }
    }

    public function setResetear($estado): void
    {
        $this->resetear = ($estado === 0 || $estado === 1) ? trim($estado) : 0;
    }
    //Metodos Publicos//
    //dentro del mismo sistema, con objetos o con arrays

    public function toArray(): array
    {

        return [
            "id" => $this->getId(),
            "apellido" => $this->getApellido(),
            "nombres" => $this->getNombres(),
            "cuenta" => $this->getCuenta(),
            "correo" => $this->getCorreo(),
            "clave" => $this->getClave(),
            "perfilId" => $this->getPerfilId(),
            "estado" => $this->getEstado(),
            "horaEntrada" => $this->getHoraEntrada(),
            "horaSalida" => $this->getHoraSalida(),
            "fechaAlta" => $this->getFechaAlta(),
            "resetear" => $this->getResetear()
        ];
    }
};
