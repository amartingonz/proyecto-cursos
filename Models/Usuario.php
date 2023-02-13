<?php
    namespace Models;
    use Lib\BaseDatos;
    use PDO;
    use PDOException;
    class Usuario extends BaseDatos{
        private string $id;
        private string $nombre;
        private string $apellidos;
        private string $email;
        private string $password;
        private string $rol;
        private bool $confirmado;
        private string $token;
        private string $token_esp;

        public function __construct(){
            parent::__construct();
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
         * Get the value of apellidos
         */ 
        public function getApellidos():string
        {
                return $this->apellidos;
        }

        /**
         * Set the value of apellidos
         *
         * @return  self
         */ 
        public function setApellidos(string $apellidos)
        {
                $this->apellidos = $apellidos;

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

       
        public function register($data){
                $sql = $this->prepara("INSERT INTO usuarios (id,nombre,apellidos,email,password,rol,confirmado,token,token_esp) VALUES (id,:nombre,:apellidos,:email,:password,'user',0,NULL,NULL)");
                $sql->bindParam(':nombre',$data->nombre);
                $sql->bindParam(':apellidos',$data->apellidos);
                $sql->bindParam(':email',$data->email);
                $sql->bindParam(':password',$data->password);
                try{
                    $sql->execute();
                    return true;
                }catch(PDOException $e){
                    return false;
                }
        }

        public function comprobar_email($data){
                $result = false;
                $sql = $this->prepara("SELECT * FROM usuarios WHERE email = :email");
                $sql->bindParam(':email',$data->email);
                try{
                    $sql->execute();
                    if($sql && $sql->rowCount() == 1){
                        $result = true;
                    }
                }catch(PDOException $e){
                        $result = false;
                } 
                return $result;
        }
   
}