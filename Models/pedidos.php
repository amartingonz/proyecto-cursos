<?php

namespace Models;

// CREAR LA CLASE USUARIOS

class Pedidos{

    function __construct(
        private int $id,
        private string $usuario_id,
        private string $provincia,
        private string $localidad,
        private string $direccion,
        private string $coste,
        private string $estado,
        private string $fecha,
        private string $hora,
    )
    {}

        public static function fromArray(array $data):Pedidos{
                return new Pedidos(
                    $data['id'] ?? '',
                    $data['usuario_id'] ?? '',
                    $data['provincia'] ?? '',
                    $data['localidad'] ?? '',
                    $data['direccion'] ?? '',
                    $data['coste'] ?? '',
                    $data['estado'] ?? '',
                    $data['fecha'] ?? '',
                    $data['hora'] ?? '',
                );
            }
    }


?>