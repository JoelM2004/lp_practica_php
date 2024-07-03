<?php

namespace app\core\model\dto;

use app\core\model\base\InterfaceDTO;

final class ClienteDTO implements InterfaceDTO
{

    private $id, $apellido, $nombre, $dni, $cuit, $tipo, $provinciaId;
    private $localidad, $telefono, $correo;

    public function __construct($data = [])
    {


        $this->setId($data["id"] ?? 0);
        $this->setApellido($data["apellido"] ?? "");
        $this->setNombre($data["nombre"] ?? "");
        $this->setDNI($data["dni"] ?? "");
        $this->setCuit($data["cuit"] ?? "");

        $this->setTipo($data["tipo"] ?? "");
        $this->setProvinciaId($data["provinciaId"] ?? 0);
        $this->setLocalidad($data["localidad"] ?? "");
        $this->setTelefono($data["telefono"] ?? "");
        $this->setCorreo($data["correo"] ?? "");
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

    public function getNombre(): string
    {
        return $this->nombre;
    }

    public function getDNI(): string
    {
        return $this->dni;
    }

    public function getCuit(): string
    {
        return $this->cuit;
    }

    public function getTipo(): string
    {
        return $this->tipo;
    }

    public function getProvinciaId(): int
    {
        return $this->provinciaId;
    }

    public function getLocalidad(): string
    {
        return $this->localidad; //que sea de uno solo
    }

    public function getTelefono(): string
    {
        return $this->telefono; // QUE TENGA LOS 2 DIGITOS DE HORA, : Y 2 DIGITOS ALIDA
    }

    public function getCorreo(): string
    {
        return $this->correo;
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

    public function setNombre($nombres): void
    {
        $this->nombre = is_string($nombres) && (strlen(trim($nombres)) <= 45) ? trim($nombres) : "";
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

    public function setDNI($cuenta): void
    {
        $this->dni = is_string($cuenta) && (preg_match('/^[0-9]{5,8}$/', $cuenta)) 
            ? $cuenta
            : "";
    }

    public function setCUIT($cuenta): void
    {
        $this->cuit = is_string($cuenta) && (preg_match('/^[0-9]{8,11}$/', $cuenta))
            ? $cuenta
            : "";
    }

    public function setTelefono($cuenta): void
{
    // Verifica que $cuenta sea una cadena, contenga solo dígitos y tenga una longitud de hasta 45 caracteres
    if (is_string($cuenta) && preg_match('/^[0-9]{1,45}$/', $cuenta)) {
        $this->telefono = $cuenta;
    } else {
        $this->telefono = "";
    }
}


    public function setTipo($tipo):void{

        $this->tipo= is_string($tipo) && ($tipo==="Empresa"||$tipo==="Persona")?$tipo:"";

    }

    public function setProvinciaId($provincia):void{

        $this->provinciaId = (is_integer($provincia) && $provincia > 0) ? $provincia : 0;
    }


    public function setLocalidad($nombres): void
    {
        $this->localidad = is_string($nombres) && (strlen(trim($nombres)) <= 45) ? trim($nombres) : "";
    }


    
    //Metodos Publicos//
    //dentro del mismo sistema, con objetos o con arrays

    public function toArray(): array
    {

        return [
            "id" => $this->getId(),
            "apellido" => $this->getApellido(),
            "nombre" => $this->getNombre(),
            "dni" => $this->getDNI(),
            "cuit" => $this->getCuit(),
            "tipo" => $this->getTipo(),
            "provinciaId" => $this->getProvinciaId(),
            "localidad" => $this->getLocalidad(),
            "telefono" => $this->getTelefono(),
            "correo" => $this->getCorreo()
        ];
    }
};
