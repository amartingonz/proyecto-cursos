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
                $sql = $this->prepara("INSERT INTO usuarios (id_usuario,nombre,apellidos,email,password,rol,confirmado,token,token_esp) VALUES (id_usuario,:nombre,:apellidos,:email,:password,'admin',0,NULL,NULL)");
                $password = password_hash($data['password'],PASSWORD_BCRYPT,['cost' => 4]);
                $sql->bindParam(':nombre',$data['nombre']);
                $sql->bindParam(':apellidos',$data['apellidos']);
                $sql->bindParam(':email',$data['email']);
                $sql->bindParam(':password',$password);
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
                $sql->bindParam(':email',$data['email']);
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

        public function login(string $email){
                // PARA COMPROBAR QUE EXISTE EL USUARIO
                $sql = ("SELECT * FROM usuarios WHERE email = :email");
                $consult = $this -> prepara($sql);
                $consult -> bindParam(':email',$email);
                try{
                    $consult-> execute();
                    $datos = $consult -> fetchAll();
                    if(count($datos) != 0){
                        $datos_encontrados = array($datos[0]['id'],$datos[0]['nombre'],$datos[0]['apellidos'],$datos[0]['email'],$datos[0]['password'],$datos[0]['rol'],$datos[0]['token'],$datos[0]['token_esp']);
                        return $datos_encontrados;
                    }else{
                        return [];
                    }
                }catch(PDOException $err){
                    echo "Error".$err -> getMessage();
                }
            }


        public function max_id($email){
                //Funcion para sacar el ultimo pedido insertado
                    $sql = $this -> prepara("SELECT id FROM usuarios WHERE email = :email");
                    $sql->bindParam(':email',$email);
                    try{
                        $sql->execute() ;
                        $datos = $sql -> fetchColumn();
                        return $datos;
                    }catch(PDOException $e){
                        return false;
                    }
            }

        public function guardarToken($id,$token,$token_esp){
                $sql = $this -> prepara("UPDATE usuarios SET token = :token, token_esp=:token_esp WHERE id = :id");
                $sql->bindParam(':id',$id);
                $sql->bindParam(':token',$token);
                $sql->bindParam(':token_esp',$token_esp);
                try{
                    $sql->execute();
                    return true;
                }catch(PDOException $e){
                    return false;
                }
        }

        public function confirmarEmail($token){
                $cons = $this->prepara("UPDATE usuarios SET confirmado = 1 WHERE id = (SELECT id FROM usuarios WHERE token = :token)");
                $cons->bindParam(':token', $token);
                try{
                    $cons->execute();
                    if($cons && $cons->rowCount() == 1){
                        return true;
                    }
                }catch(PDOException $e){
                    return False;
                }
            }


        public function borrar_token($token){
                $cons = $this->prepara("UPDATE usuarios SET token = '' WHERE id = (SELECT id FROM usuarios WHERE token = :token)");
                $cons->bindParam(':token', $token);
                try{
                    $cons->execute();

                    if($cons && $cons->rowCount() == 1){
                        return true;
                    }
                }catch(PDOException $e){
                    return False;
                }
            }


        public function tokenExp($token){
            // Función para obtener la expiracion del token
                    $sql = $this -> prepara("SELECT token_esp FROM usuarios WHERE token = :token");
                    $sql->bindParam(':token',$token);
                    try{
                        $sql->execute() ;
                        $datos = $sql -> fetchColumn();
                        return $datos;
                    }catch(PDOException $e){
                        return false;
                    }
        }

        public function comprobarConfirmado($id){
            // Funcion para comprobar si el usuario ha confirmado su email.
            $sql = $this -> prepara("SELECT confirmado FROM usuarios WHERE id = :id");
            $sql->bindParam(':id',$id);
            try{
                $sql->execute() ;
                $datos = $sql -> fetchColumn();
                return $datos;
            }catch(PDOException $e){
                return false;
            }
        }
}