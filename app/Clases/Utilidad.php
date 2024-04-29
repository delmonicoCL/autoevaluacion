<?php
namespace App\Clases;

class Utilidad
{
    //atributos
    //constructor
    //metodos
    public static function errorMessage($e)
    {
        if (!empty($e->errorInfo[1])) {
            switch ($e->errorInfo[1]) {
                case 1062:
                    $mensaje = "ERROR: Nombre User Replicado. Usuario No Creado";
                    break;
                case 1451:
                    $mensaje = "No Borrado. Registro con elementos relacionados.";
                    break;
                default:
                    $mensaje = $e->errorInfo[1] . " - " . $e->errorInfo[2];
                    break;
            }
        } else {
            switch ($e->getCode()) {
                case 1044:
                    $mensaje = "Usuario y/o contraseña incorrecto(s).";
                    break;
                case 1049:
                    $mensaje = "Base de datos desconocida.";
                    break;
                case 2002:
                    $mensaje = "No se encuentra el servidor.";
                    break;
                default:
                    $mensaje = $e->getCode() . " - " . $e->getMessage();
                    break;
            }
        }
        return $mensaje;
    }
    //getters y setters
}
