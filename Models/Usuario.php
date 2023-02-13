<?php
    namespace Models;

    use Exception;
    use PDO;
    use PDOException;
    use Lib\BaseDatos;



class Usuario{
    
            private string $id;
            private string $nombre;
            private string $apellidos;
            private string $email;
            private string $password;
            private string $rol;
            private string $confirmado;
            private string $token;
            private string $token_esp;

            private BaseDatos $conexion;

            public function __construct(string $id,string $nombre,string $apellidos,string $email,string $password,string $rol,string $confirmado,string $token,string $token_esp)
            {
                $this -> conexion = new BaseDatos();
                $this -> id = $id;
                $this -> nombre = $nombre;
                $this -> apellidos = $apellidos;
                $this -> email = $email;
                $this -> password = $password;
                $this -> rol = $rol;
                $this -> confirmado = $confirmado;
                $this -> token = $token;
                $this -> token_esp = $token_esp;

            }

    public static function fromArray(array $data):Ponente{
        return new Ponente(
            $data['id'],
            $data['nombre'],
            $data['apellidos'],
            $data['email'],
            $data['password'],
            $data['rol'],
            $data['confirmado'],
            $data['token'],
            $data['token_esp'],
        );
    }


        /**
         * Get the value of token_esp
         */ 
        public function getToken_esp()
        {
                return $this->token_esp;
        }

        /**
         * Set the value of token_esp
         *
         * @return  self
         */ 
        public function setToken_esp($token_esp)
        {
                $this->token_esp = $token_esp;

                return $this;
        }

        /**
         * Get the value of token
         */ 
        public function getToken()
        {
                return $this->token;
        }

        /**
         * Set the value of token
         *
         * @return  self
         */ 
        public function setToken($token)
        {
                $this->token = $token;

                return $this;
        }

        /**
         * Get the value of confirmado
         */ 
        public function getConfirmado()
        {
                return $this->confirmado;
        }

        /**
         * Set the value of confirmado
         *
         * @return  self
         */ 
        public function setConfirmado($confirmado)
        {
                $this->confirmado = $confirmado;

                return $this;
        }

        /**
         * Get the value of rol
         */ 
        public function getRol()
        {
                return $this->rol;
        }

        /**
         * Set the value of rol
         *
         * @return  self
         */ 
        public function setRol($rol)
        {
                $this->rol = $rol;

                return $this;
        }

        /**
         * Get the value of password
         */ 
        public function getPassword()
        {
                return $this->password;
        }

        /**
         * Set the value of password
         *
         * @return  self
         */ 
        public function setPassword($password)
        {
                $this->password = $password;

                return $this;
        }

        /**
         * Get the value of email
         */ 
        public function getEmail()
        {
                return $this->email;
        }

        /**
         * Set the value of email
         *
         * @return  self
         */ 
        public function setEmail($email)
        {
                $this->email = $email;

                return $this;
        }

        /**
         * Get the value of apellidos
         */ 
        public function getApellidos()
        {
                return $this->apellidos;
        }

        /**
         * Set the value of apellidos
         *
         * @return  self
         */ 
        public function setApellidos($apellidos)
        {
                $this->apellidos = $apellidos;

                return $this;
        }

        /**
         * Get the value of nombre
         */ 
        public function getNombre()
        {
                return $this->nombre;
        }

        /**
         * Set the value of nombre
         *
         * @return  self
         */ 
        public function setNombre($nombre)
        {
                $this->nombre = $nombre;

                return $this;
        }

        /**
         * Get the value of id
         */ 
        public function getId()
        {
                return $this->id;
        }

        /**
         * Set the value of id
         *
         * @return  self
         */ 
        public function setId($id)
        {
                $this->id = $id;

                return $this;
        }

       
        public function register(array $data){
            $statement = "INSERT INTO usuarios(nombre,apellidos,email,password,rol,confirmado,token,token_esp) values(:nombre,:apellidos,:email,:password,:rol,:confirmado,:token,:token_esp);";
            $consult = $this -> conexion -> prepara($statement);
            $consult -> bindParam(':nombre',$data['nombre'],PDO::PARAM_STR);
            $consult -> bindParam('apellidos',$data['apellidos'],PDO::PARAM_STR);
            $consult -> bindParam(':email',$data['email'],PDO::PARAM_STR);
            $consult -> bindParam(':password',$data['password'],PDO::PARAM_STR);
            $consult -> bindParam(':rol',$data['rol'],PDO::PARAM_STR);
            $consult -> bindParam(':confirmado',$data['confirmado'],PDO::PARAM_STR);

            try{
                $statement = $this -> conexion -> consulta($statement);
                return $statement -> fetchAll(\PDO::FETCH_ASSOC);
                }catch(\PDOException $e){
                    exit($e -> getMessage());
                }
        }

   
}