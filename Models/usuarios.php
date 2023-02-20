<?php
    namespace Models;
    
    // CREAR LA CLASE USUARIOS

    class Usuarios{
        public function __construct(
            private int $id,
            private string $nombre,
            private string $apellidos,
            private string $email,
            private string $password,
            private string $rol,
        )
        {}
            /**
             * Get the value of id
             */ 
            public function getId():int
            {
                        return $this->id;
            }

            /**
             * Set the value of id
             *
             * @return  self
             */ 
            public function setId(int $id)
            {
                        $this->id = $id;

                        return $this;
            }

            /**
             * Get the value of nombre
             */ 
            public function getNombre():string
            {
                        return $this->nombre;
            }

            /**
             * Set the value of nombre
             *
             * @return  self
             */ 
            public function setNombre(string $nombre)
            {
                        $this->nombre = $nombre;

                        return $this;
            }

            /**
             * Get the value of email
             */ 
            public function getEmail():string
            {
                        return $this->email;
            }

            /**
             * Set the value of email
             *
             * @return  self
             */ 
            public function setEmail(string $email)
            {
                        $this->email = $email;

                        return $this;
            }

            /**
             * Get the value of password
             */ 
            public function getPassword():string
            {
                        return $this->password;
            }

            /**
             * Set the value of password
             *
             * @return  self
             */ 
            public function setPassword(string $password)
            {
                        $this->password = $password;

                        return $this;
            }

        

            /**
             * Get the value of rol
             */ 
            public function getRol():string
            {
                        return $this->rol;
            }

            /**
             * Set the value of rol
             *
             * @return  self
             */ 
            public function setRol(string $rol)
            {
                        $this->rol = $rol;

                        return $this;
            }
            public static function fromArray(array $data):Usuarios{
                return new Usuarios(
                    $data['id'] ?? '',
                    $data['nombre'] ?? '',
                    $data['apellidos'] ?? '',
                    $data['email'] ?? '',
                    $data['password'] ?? '',
                    $data['fecha'] ?? '',
                    $data['rol'] ?? '',
                );
            }
    }