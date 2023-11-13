<?php

    include_once $_SERVER['DOCUMENT_ROOT'].'/proaulav2/models/Acudido.php';
    include_once 'IAcudidoCrud.php';

    class AcudidoCrud implements IAcudidoCrud {
        public static function findAttended($identification) {
            try {
                $attended = Acudido::find(array('identificacion' => $identification));

                if ($attended == null) {
                    throw new Exception('No existe el acudido.');
                }
                
                return $attended;
            } catch(Exception $error) {
                return "Ocurrio un error: " . $error->getMessage();
            }
        }

        public static function saveAttended($attended) {
            try {
                $attended->save();
            } catch(Exception $error) {
                return "Ocurrio un error: " . $error->getMessage();
            }
        }

        public static function editAttended($attended) {
            try {
                $attended->save();
            } catch(Exception $error) {
                return "Ocurrio un error: " . $error->getMessage();
            }
        }

        public static function deleteAttended($identification) {
            try {
                $attended = Acudido::find(array('identificacion' => $identification)) -> delete();
            } catch(Exception $error) {
                return "Ocurrio un error: " . $error->getMessage();
            }
        }

        public static function listAttended() {
            try {
                $attended = Acudido::all();

                if ($attended == null) {
                    throw new Exception('No hay acudidos.');
                }
                
                return $attended;
            } catch(Exception $error) {
                return "Ocurrio un error: " . $error->getMessage();
            }
        }
    }

?>