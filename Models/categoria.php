<?php

namespace Models;

// CREAR LA CLASE USUARIOS

class Categoria{

    public function __construct(
        private int $id,
        private string $nombre,
    )
    {}

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
        
        public static function fromArray(array $data):Categoria{
                return new Categoria(
                    $data['id'],
                    $data['nombre'],
                );
            }
    }

?>