<?php
    
    // Crear un array y si se mete un error luego no pasar los datos a un array. Si no detecta errores  meter los datos en un array.
    function validarRequerido(string $texto){
            return !(trim($texto) == '');
        }
    
    function validar_texto(string $texto){
        $patron_texto = "/^[a-zA-ZáéíóúÁÉÍÓÚäëïüöÄËÏÖÜàèìùòÀÈÙÌÒ\s]+$/";
        return preg_match($patron_texto,$texto);
    }
    function limpiarTexto(string $texto){
        return preg_replace('/[a-zA-Z]/','',$texto);
    }
    function validarInt($numero,$minimo){
        return(filter_var($numero,FILTER_VALIDATE_INT)) && ($numero > $minimo);
    }

    function validarExtras($array){
        return count($array);
    }

    function validarImagen($imagen){
        return $imagen;
    }
    function is_valid_email($str)
    {
    return (false !== filter_var($str, FILTER_VALIDATE_EMAIL));
    }

    function validarCampos($direccion,$precio,$tamano,$extra,$observaciones,$imagen){
        $errores = array();

        if(!validarRequerido($direccion)){
            $errores['direccion'] = "Debes introducir una direccion valida";
        }else{
            $errores['direccion'] = "";
        }

        if(!validarInt($precio,0)){
            $errores['precio'] = "Debes introducir un precio valido mayor que 0";
        }else{
            $errores['precio'] = "";
        }

        if(!validarInt($tamano,0)){
            $errores['tamano'] = "Debes introducir un tamaño valido mayor que 0";
        }else{
            $errores['tamano'] = "";
        }

        //Extras
        if(!validarExtras($extra)){
            $errores['extras'] = "Debes introducir al menos un extra";
        }else{
            $errores['extras'] = '';
        }

        if(!validarRequerido($observaciones)){
            $errores['observaciones'] = "Debes introducir una observación valida";
        }else{
            $errores['observaciones'] = "";
        }

        if(validarImagen($imagen)){
            $errores['foto'] = "Debes introducir una imagen";
        }else{
            $errores['foto'] = "";
        }
        return $errores;
    }
    function sinErrores($errores){
        return(($errores['direccion'] == "")&&($errores['precio'] == "") && ($errores['tamano'] == "") && ($errores['extras'] == "") && ($errores['observaciones'] == "") && ($errores['imgaen'] == ""));

    }

?>