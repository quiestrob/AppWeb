<?php

    include_once $_SERVER['DOCUMENT_ROOT'].'/proaulav2/models/Informe.php';
    include_once $_SERVER['DOCUMENT_ROOT'].'/proaulav2/persistences/InformeCrud.php';

    class InformeService {  
        public static function listReport($identification) {
            try {
                $reports = Informe::find('all', array(
                    'joins' => array(
                        'INNER JOIN Acudidos ON Acudidos.Identificacion = Informes.identificacion_acudido'
                    ),
                    'select' => 'Informes.*, Acudidos.*',
                    'conditions' => "Informes.Identificacion_usuario = '$identification' OR Informes.Identificacion_acudido = '$identification'"
                ));

                if ($reports == null) {
                    return null;
                } else {
                    return $reports;
                }

            } catch(Exception $error){
                return null;
            }
        }

        public static function listReportAttendant($identification) {
            try {
                $reports = Informe::find('all', array(
                    'joins' => array(
                        'INNER JOIN Acudidos ON Acudidos.Identificacion = Informes.identificacion_acudido',
                        'INNER JOIN Usuarios ON Usuarios.Identificacion = Acudidos.identificacion_usuario'
                    ),
                    'select' => 'Informes.*, Acudidos.*',
                    'conditions' => "Acudidos.Identificacion_usuario = '$identification' AND Usuarios.tipo_usuario='Acudiente'"
                ));

                if ($reports == null) {
                    return null;
                } else {
                    return $reports;
                }

            } catch(Exception $error){
                return null;
            }
        }

        public static function saveReport($report) {
            try {
                InformeCrud::saveReport($report);
            } catch(Exception $error){
                return "Error: " . $error->getMessage();
            }
        }
    }

?>