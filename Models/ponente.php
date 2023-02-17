<?php
    namespace Models;

    use Exception;
    use PDO;
    use PDOException;
    use Lib\BaseDatos;


    class Ponente{
            private string $id;
            private string $nombre;
            private string $apellidos;
            private string $imagen;
            private string $tags;
            private string $redes;

            private BaseDatos $conexion;

            public function __construct(string $id,string $nombre,string $apellidos,string $imagen,string $tags,string $redes)
            {
                $this -> conexion = new BaseDatos();
                $this -> id = $id;
                $this -> nombre = $nombre;
                $this -> apellidos = $apellidos;
                $this -> imagen = $imagen;
                $this -> tags = $tags;
                $this -> redes = $redes;

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
             * Get the value of imagen
             */ 
            public function getImagen()
            {
                        return $this->imagen;
            }

            /**
             * Set the value of imagen
             *
             * @return  self
             */ 
            public function setImagen($imagen)
            {
                        $this->imagen = $imagen;

                        return $this;
            }

            /**
             * Get the value of tags
             */ 
            public function getTags()
            {
                        return $this->tags;
            }

            /**
             * Set the value of tags
             *
             * @return  self
             */ 
            public function setTags($tags)
            {
                        $this->tags = $tags;

                        return $this;
            }

            /**
             * Get the value of redes
             */ 
            public function getRedes()
            {
                        return $this->redes;
            }

            /**
             * Set the value of redes
             *
             * @return  self
             */ 
            public function setRedes($redes)
            {
                        $this->redes = $redes;

                        return $this;
            }

            public function findAll(){
                $statement = "SELECT * FROM ponentes;";

                try{
                    $statement = $this -> conexion -> consulta($statement);
                    return $statement -> fetchAll(\PDO::FETCH_ASSOC);
                }catch(\PDOException $e){
                    exit($e -> getMessage());
                }
            }

            public function findOne($id){
                $statement = "SELECT * FROM ponentes WHERE id=$id;";

                try{
                    $statement = $this -> conexion -> consulta($statement);
                    return $statement -> fetchAll(\PDO::FETCH_ASSOC);
                }catch(\PDOException $e){
                    exit($e -> getMessage());
                }
            }

            public function delPonente($id): ?array{
                try{
                    $this-> conexion -> consulta("DELETE FROM ponentes WHERE id=$id");
                    return $this-> conexion -> extraer_todos();
                }catch(PDOException $e){
                    exit($e->getMessage());
                }
            }

            public function savePonente(): ?bool {
                $ins = $this-> conexion -> prepara("INSERT INTO ponentes (nombre, apellidos) VALUES(:nombre, :apellidos)");
    
                $ins->bindParam(':nombre', $nombre, PDO::PARAM_STR);
                $ins->bindParam(':apellidos', $apellidos, PDO::PARAM_STR);
    
                $nombre = $this->getNombre();
                $apellidos = $this->getApellidos();
    
                try{
                    $ins->execute();
                    $result = true;
                }catch(PDOException $err){
                    $result = false;
                }
    
                return $result;
            }

            public function updatePonente(): ?bool {
                $ins = $this-> conexion ->prepara("UPDATE ponentes SET nombre = :nombre, apellidos = :apellidos WHERE id = :id");
    
    
                $id = $this->id;
                $nombre = $this->nombre;
                $apellidos = $this->apellidos;
    
    
                $ins->bindParam(':id', $id, PDO::PARAM_INT);
                $ins->bindParam(':nombre', $nombre, PDO::PARAM_STR);
                $ins->bindParam(':apellidos', $apellidos, PDO::PARAM_STR);
    
                
                try{
                    $ins->execute();
                    $result = true;
                }catch(PDOException $err){
                    $result = false;
                }
    
                return $result;
            }
        }