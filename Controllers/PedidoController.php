<?php

namespace Controllers;
use Lib\Pages;
use Models\Pedidos;
use Services\PedidoService;
use Utils\Utils;

class PedidoController{
    private PedidoService $service;
    private Pages $pages;
    private Utils $utils;

    public function __construct(){
        $this -> pages = new Pages();
        $this -> service = new PedidoService();
        $this -> utils = new Utils();
    }


    public function comprobarPedido(){
        // Funcion para comprobar que el usuario ha iniciado sesion.
        if(isset($_SESSION['usuario']) || isset($_SESSION['admin'])){
            if(count($_SESSION['carrito']) == 0){
                $this -> pages -> render('layout/mensaje',["mensaje" => "Debes tener productos para poder realizar el pedido"]);
            }else{
                $this -> pages -> render('pedidos/crear_pedido');
            }
        }else{
            $this -> pages -> render('layout/mensaje',["mensaje" => "Debes iniciar sesión para poder procesar tu pedido."]);
        }
    }

    public function enviar_email($email,$precio_total,$n_pedido){
        // Funcion que lleva al render de enviar email pasandole los parametros para rellenarlos con los datos que se piden
        $this -> pages -> render('principal/enviar_email',["email" => $email,"precio_total" => $precio_total, "n_pedido" => $n_pedido]);
    }

    public function consultar_pedidos(){
        // Funcion que llama al servicio para consutar los pedidos de cada usuario pasandole la sesion del usuario actual, y con el render muestra la vista con los pedidos
        $pedidos = $this -> service -> consultar_pedidos($_SESSION['id']);
        $this -> pages -> render('pedidos/mis_pedidos',['pedidos' => $pedidos]);
    }


    public function crear_pedido(){
        // Funcion que crea el pedido, y la linea de pedido, además se envia el email si se ha introducido correctamente todo.
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $datos = $_POST['data'];
            $errores = $this -> utils -> validar_crearPedido($datos);
            if($this -> utils -> sinErrorescrearPedido($errores)){
                $this -> service -> crear_pedido($datos);
                $id = $this -> service -> ultimoPedidoInsertado();
                $ultima_id = $id['MAX(id)'];
                if(!$this->service->crear_lineaPedido($ultima_id,$_SESSION['carrito'])){
                    $this -> pages -> render('layout/mensaje',["mensaje" => "Pedido realizado con éxito."]);
                    $id = $this -> service -> ultimoPedidoInsertado();
                    $ultima_id = $id['MAX(id)'];
                    $email = $_SESSION['email'];
                    $precio_total = $_SESSION['total'];
                    header("Location:".base_url);
                    $this -> enviar_email($email,$precio_total,$ultima_id);
                    $this -> pages -> render('layout/mensaje',["mensaje" => "Pedido realizado con éxito"]);
                    $_SESSION['carrito'] = [];
                }else{
                    $this -> pages -> render('layout/mensaje',["mensaje" => "No se ha podido realizar el pedido."]);
                }}else{
                $_SESSION['errores'] = $errores;
                $this -> pages -> render('pedidos/crear_pedido');
        }
}

}}
















?>