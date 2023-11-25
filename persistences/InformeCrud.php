<?php

    include_once $_SERVER['DOCUMENT_ROOT'].'/proaulav2/models/Informe.php';
    include_once 'IInformeCrud.php';

    class InformeCrud implements IInformeCrud {
        public static function findReport($id) {
            try {
                $report = Informe::find(array('id' => $id));

                if ($report == null) {
                    throw new Exception('No existe el informe.');
                }
                
                return $report;
            } catch(Exception $error) {
                return "Ocurrio un error: " . $error->getMessage();
            }
        }

        public static function saveReport($report) {
            try {
                $report->save();
            } catch(Exception $error) {
                return "Ocurrio un error: " . $error->getMessage();
            }
        }

        public static function editReport($report) {
            try {
                $report->save();
            } catch(Exception $error) {
                return "Ocurrio un error: " . $error->getMessage();
            }
        }

        public static function deleteReport($id) {
            try {
                $report = Informe::find(array('id' => $id)) -> delete();
            } catch(Exception $error) {
                return "Ocurrio un error: " . $error->getMessage();
            }
        }

        public static function listReport() {
            try {
                $report = Informe::all();

                if ($report == null) {
                    throw new Exception('No hay informes.');
                }
                
                return $report;
            } catch(Exception $error) {
                return "Ocurrio un error: " . $error->getMessage();
            }
        }
    }

?>