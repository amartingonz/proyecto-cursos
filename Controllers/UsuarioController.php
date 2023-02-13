<?php
    namespace Controllers;
    use Models\Usuario;
    use Lib\ResponseHttp;
    use Lib\Pages;

    class UsuarioController{

        private Pages $pages;
        private Usuario $usuario;
        
        public function __construct()
        {
            ResponseHttp::setHeaders();
            $this -> usuario = new Usuario("","","","","","","","","");
            $this -> pages = new Pages();
        }




    }



















?>