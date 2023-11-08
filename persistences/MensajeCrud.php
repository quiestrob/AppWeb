<?php

    include_once $_SERVER['DOCUMENT_ROOT'].'/proaulav2/models/Mensaje.php';
    include_once 'IMensajeCrud.php';

    class MensajeCrud implements IMensajeCrud {
        public static function findMessage($id) {
            try {
                $message = Mensaje::find(array('id' => $id));

                if ($message == null) {
                    throw new Exception('No existe el mensaje.');
                }
                
                return $message;
            } catch(Exception $error) {
                return "Ocurrio un error: " . $error->getMessage();
            }
        }

        public static function saveMessage($message) {
            try {
                $message->save();
            } catch(Exception $error) {
                return "Ocurrio un error: " . $error->getMessage();
            }
        }

        public static function editMessage($message) {
            try {
                $message->save();
            } catch(Exception $error) {
                return "Ocurrio un error: " . $error->getMessage();
            }
        }

        public static function deleteMessage($id) {
            try {
                $message = Mensaje::find(array('id' => $id)) -> delete();
            } catch(Exception $error) {
                return "Ocurrio un error: " . $error->getMessage();
            }
        }

        public static function listMessage() {
            try {
                $message = Mensaje::all();

                if ($message == null) {
                    throw new Exception('No hay mensajes.');
                }
                
                return $message;
            } catch(Exception $error) {
                return "Ocurrio un error: " . $error->getMessage();
            }
        }
    }

?>