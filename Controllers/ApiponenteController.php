<?php


    namespace Controllers;
    use Models\Ponente;
    use Lib\ResponseHttp;
    use Lib\Pages;
    use Lib\Security;


    class ApiponenteController{

        private Pages $pages;
        private Ponente $ponente;


        public function __construct()
        {
            ResponseHttp::setHeaders();
            $this -> ponente = new Ponente("","","","","","");
            $this -> pages = new Pages();
        }


        public function getAll(){
            // Funcion para obtener todos los ponentes, he añadido el validar confirmado porque si el usuario ha confirmado su email no hace falta que  introduzca el token,
            // ya que el usuario ha sido confirmado. Es decir si no ha confirmado el email puede entrar pero deberá introducir su token, aunque es recomendable que primero
            // confirme su email para poder continuar.
            if(Security::validateToken() || Security::validateConfirmado()){
                $ponentes = $this -> ponente->findAll();
                $PonenteArr = [];
                if(!empty($ponentes)){
                    $PonenteArr["message"] = json_decode(ResponseHttp::statusMessage(202,'OK'));
                    $PonenteArr["Ponentes"] = [];
                    foreach($ponentes as $fila){
                        $PonenteArr["Ponentes"][] = $fila;
                    }
                }else{
                    $PonenteArr["message"] = json_decode(ResponseHttp::statusMessage(400, 'No hay ponentes'));
                    $PonenteArr["Ponentes"] = [];
                }
                if($PonenteArr==[]){
                    $response = json_encode(ResponseHttp::statusMessage(400,'No hay ponentes'));
                }else{
                    $response = json_encode($PonenteArr);
                }
                $this -> pages -> render('read',['response' => $response]);
            }else{
                $this -> pages -> render('read',['response' => 'Token no válido']);
            }
            
        }
        
        public function delPonente($id){
            // Funcion para eliminar un ponente
            $ponentes = $this->ponente->delPonente($id);
            $PonenteArr = [];

            if(!empty($ponentes)){
                $PonenteArr["message"] = json_decode(ResponseHttp::statusMessage(202, 'OK'));
                $PonenteArr["Ponentes"] = [];
                foreach($ponentes as $fila){
                    $PonenteArr["Ponentes"][] = $fila;
                }
            }else{
                $PonenteArr["message"] = json_decode(ResponseHttp::StatusMessage(400, 'No hay ponentes'));
                $PonenteArr["Ponentes"] = [];
            }

            $this->pages->render('Ponente/listar', ['response' => "Ponente Eliminado"]);
        }

        public function getPonente($id){
            // Funcion para obtener ponentes por su id.
            $ponentes = $this -> ponente -> findOne($id);
            $PonenteArr = [];
            if(!empty($ponentes)){
                $PonenteArr["message"] = json_decode(ResponseHttp::statusMessage(202,'OK'));
                $PonenteArr["Ponentes"] = [];
                foreach($ponentes as $fila){
                    $PonenteArr["Ponentes"][] = $fila;
                }
            }else{
                $PonenteArr["message"] = json_decode(ResponseHttp::statusMessage(400, 'No hay ponentes'));
                $PonenteArr["Ponentes"] = [];
            }
            if($PonenteArr==[]){
                $response = json_encode(ResponseHttp::statusMessage(400,'No hay ponentes'));
            }else{
                $response = json_encode($PonenteArr);
            }
            $this -> pages -> render('read',['response' => $response]);
        }

        public function savePonente(){
            // Funcion para guardar ponente.
            if(Security::validateToken()){
                $ponente = new Ponente("","","","","","");

                $data = json_decode(file_get_contents("php://input"));
                if(!empty($data->nombre) && !empty($data->apellidos)){

                    $ponente->setNombre($data->nombre);
                    $ponente->setApellidos($data->apellidos);

                    if($ponente->savePonente()){

                        http_response_code(201);
                        echo json_encode(
                            array("message" => "El ponente se ha guardado correctamente.")
                        );
                    } else{
                        http_response_code(503);
                        echo json_encode(
                            array("message" => "El ponente no se ha podido guardar.")
                        );
                    }
                } else{
                    http_response_code(400);
                    echo json_encode(
                        array("message" => "No se ha podido crear el Ponente. Datos incompletos.")
                    );
                }

                $this->pages->render('Ponente/listar', ['response' => "Ponente Guardado Correctamente"]);
            }else{
                $this->pages->render('read', ['response' => "Token inválido"]);
            }
        }


        public function updatePonente(){
            // Funcion para actualizar ponentes.
            $ponente = new Ponente("","","","","","");

            $data = json_decode(file_get_contents("php://input"));
            if(!empty($data->id) && !empty($data->nombre) && !empty($data->apellidos)){

                $ponente->setId($data->id);
                $ponente->setNombre($data->nombre);
                $ponente->setApellidos($data->apellidos);

                if($ponente->updatePonente()){

                    http_response_code(201);
                    echo json_encode(
                        array("message" => "El ponente se ha actualizado correctamente.")
                    );
                } else{
                    http_response_code(503);
                    echo json_encode(
                        array("message" => "El ponente no se ha podido actualizar.")
                    );
                }
            } else{
                http_response_code(400);
                echo json_encode(
                    array("message" => "No se ha podido actualizar el ponente. Datos incompletos.")
                );
            }

            $this->pages->render('Ponente/listar', ["response" => "Ponente"]);
        }

    }
    