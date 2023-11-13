<?php

    include_once $_SERVER['DOCUMENT_ROOT'].'/proaulav2/models/Mensaje.php';
    include_once $_SERVER['DOCUMENT_ROOT'].'/proaulav2/persistences/MensajeCrud.php';

    class MensajeService {
        public static function sendMessage($message) {
            try {
                MensajeCrud::saveMessage($message);
            } catch (Exception $error) {
                return 'Ocurrio un error: ' . $error->getMessage();
            }
        }

        public static function listUserMessages($idTransmitter, $idReceiver) {
            try {
                $message = Mensaje::find('all', array(
                    'joins' => array(
                        'INNER JOIN Usuarios ON Usuarios.Identificacion = Mensajes.Identificacion_emisor'
                    ),
                    'select' => 'Usuarios.*, Mensajes.*',
                    'conditions' => "Mensajes.Identificacion_emisor = '$idTransmitter' AND Mensajes.Identificacion_receptor = '$idReceiver'"
                ));

                if ($message == null) {
                    return null;
                } else {
                    return $message;
                }
            } catch (Exception $error) {
                return 'Ocurrio un error: ' . $error->getMessage();
            }
        }
    }

?>