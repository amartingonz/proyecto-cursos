<?php

namespace Utils;
require_once 'validaciones.php';
/*
    HE CREADO ESTA CLASE CON METODOS PARA VALIDAR LOS DISTINTOS FORMULARIOS.
*/
class Utils{
 


    public function validar_registro($array):?array{
            
        $errores = array();
    
            if(!validar_texto($array['nombre'])){
                $errores['nombre'] = "Debes introducir un nombre valido";
            }else{
                $errores['nombre'] = "";
            }
    
            if(!validar_texto($array['apellidos'])){
                $errores['apellidos'] = "Debes introducir unos apellidos validos";
            }else{
                $errores['apellidos'] = "";
            }
            $email = filter_var($array['email'],FILTER_SANITIZE_EMAIL);
            if(!is_valid_email($email)){
                $errores['email'] = "Debes introducir un email valido";
            }else{
                $errores['email'] = "";
            }

            if(strlen($array['password']) < 6){
                $errores['password'] = "Contiene menos de 6 caracteres";
            }else{
                $errores['password'] = "";
            }

            if(strlen($array['password']) > 16){
                $errores['password'] = "La clave no puede tener más de 16 caracteres";
            }else{
                $errores['password'] = "";
            }

            if (!preg_match('`[0-9]`',$array['password'])){
                $errores['password'] =  "La clave debe tener al menos un caracter numérico";
            }else{
                $errores['password'] = "";
            }

            if (!preg_match('`[A-Z]`',$array['password'])){
                $errores['password'] =  "La clave debe tener al menos una letra mayúscula";
            }else{
                $errores['password'] = "";
            }
    
            return $errores;
    }
   
    public function sinErroresRegistro($errores){
        return(($errores['nombre'] == "")&&($errores['apellidos'] == "")&&($errores['email'] == "")&&($errores['password'] == ""));

    }

    public function validar_login($array):?array{
            
        $errores = array();
            $email = filter_var($array['email'],FILTER_SANITIZE_EMAIL);
            if(!is_valid_email($email)){
                $errores['email'] = "Debes introducir un email valido";
            }else{
                $errores['email'] = "";
            }

            if(strlen($array['password']) < 6){
                $errores['password'] = "Contiene menos de 6 caracteres";
            }else{
                $errores['password'] = "";
            }

            if(strlen($array['password']) > 16){
                $errores['password'] = "La clave no puede tener más de 16 caracteres";
            }else{
                $errores['password'] = "";
            }

            return $errores;
    }
   
    public function sinErroresLogin($errores){
        return(($errores['email'] == "")&&($errores['password'] == ""));

    }

    public function validar_crearProductos($array):?array{
            
        $errores = array();
            if(!validarRequerido($array['nombre'])){
                $errores['nombre'] = "No puede estar vacio";
            }else{
                $errores['nombre'] = "";
            }

            if(!validarRequerido($array['descripcion'])){
                $errores['descripcion'] = "No puede estar vacio";
            }else{
                $errores['descripcion'] = "";
            }

            return $errores;
    }
   
    public function sinErrorescrearProductos($errores){
        return(($errores['nombre'] == "")&&($errores['descripcion'] == ""));

    }

    public function validar_borrarProducto($data):?array{
            
        $errores = array();
            if(!validarRequerido($data)){
                $errores['id'] = "No puede estar vacio";
            }else{
                $errores['id'] = "";
            }
            return $errores;
    }
   
    public function sinErroresBorrarProducto($errores){
        return(($errores['id'] == ""));
    }

    public function validar_crearCategoria($data):?array{
            
        $errores = array();
            if(!validarRequerido($data)){
                $errores['nombre'] = "No puede estar vacio";
            }else{
                $errores['nombre'] = "";
            }
            return $errores;
    }
   
    public function sinErrorescrearCategoria($errores){
        return(($errores['nombre'] == ""));
    }

    public function validar_crearPedido($array):?array{
            
        $errores = array();
            if(!validarRequerido($array['provincia'])){
                $errores['provincia'] = "No puede estar vacio";
            }else{
                $errores['provincia'] = "";
            }
            if(!validar_texto($array['provincia'])){
                $errores['provincia'] = "No puedes meter numeros";
            }else{
                $errores['provincia'] = "";
            }

            if(!validarRequerido($array['localidad'])){
                $errores['localidad'] = "No puede estar vacio";
            }else{
                $errores['localidad'] = "";
            }
            if(!validar_texto($array['localidad'])){
                $errores['localidad'] = "No puedes meter numeros";
            }else{
                $errores['localidad'] = "";
            }

            if(!validarRequerido($array['direccion'])){
                $errores['direccion'] = "No puede estar vacio";
            }else{
                $errores['direccion'] = "";
            }
            return $errores;
    }
   
    public function sinErrorescrearPedido($errores){
        return(($errores['provincia'] == "")&&($errores['localidad'] == "")&&($errores['direccion'] == ""));

    }
}