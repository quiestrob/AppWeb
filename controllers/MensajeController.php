<?php

    include_once $_SERVER['DOCUMENT_ROOT'].'/proaulav2/models/Mensaje.php';
    include_once $_SERVER['DOCUMENT_ROOT'].'/proaulav2/services/MensajeService.php';

    class MensajeController {  
        public static function executeAction() {
            $action = $_REQUEST['action'];
            
            switch ($action) {
                case 'Enviar':
                    MensajeController::sendMessage();
                    break;
                case 'Listar':
                    MensajeController::listUserMessages();
                    break;
                default:
                    header("Location: ../root/pages/error.php");
                    exit;
            }
        }

        public static function sendMessage() {
            try {
                $idTransmitter = $_GET['transmitter'];
                $idReceiver = $_GET['receiver'];
                $content = $_GET['message'];
                
                $message = new Mensaje();
                $message->identificacion_emisor = $idTransmitter;
                $message->identificacion_receptor = $idReceiver;
                $message->mensaje = $content;

                MensajeService::sendMessage($message);
                MensajeController::listUserMessages();
            } catch(Exception $error){
                echo "Error: " + $error->getMessage();
            }
        }

        public static function listUserMessages() {
            try {
                $idTransmitter = $_GET['transmitter'];
                $idReceiver = $_GET['receiver'];

                $messages = MensajeService::listUserMessages($idTransmitter, $idReceiver);
                $reverseMessages = MensajeService::listUserMessages($idReceiver, $idTransmitter);

                if ($messages == null && $reverseMessages == null) {
                    echo "<span style='font-family: Poppins; display: flex; justify-content: center; align-items: center; padding: 50% 0' >No hay mensajes</span>";
                } else {
                    if ($messages == null) {
                        $combinedData = array_merge($reverseMessages);
                    } else if ($reverseMessages == null) {
                        $combinedData = array_merge($messages);
                    } else {
                        $combinedData = array_merge($messages, $reverseMessages);
                    }

                    usort($combinedData, function ($a, $b) {
                        return $a->id - $b->id;
                    });

                    foreach ($combinedData as $combined) { 
                        echo "
                            <tr style='position: relative'>                              
                                <td>   
                                <span>$combined->nombre:</span>"
                                . $combined->mensaje .
                                "</td>
                            </tr>
                        ";
                    } 
                      
                } 

            } catch(Exception $error){
                echo "Error: " + $error->getMessage();
            }
        }
    }

    MensajeController::executeAction();

?>