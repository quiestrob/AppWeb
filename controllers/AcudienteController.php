<?php

    include_once $_SERVER['DOCUMENT_ROOT'].'../models/Acudiente.php';

    class AcudienteController {
        public static function executeAction() {

            $action = @$_REQUEST['action'];

            switch ($action) {
                case 'Save':
                    AcudienteController::save();
                    break;
                default:
                    header("Location: ../root/pages/error.php");
                    exit;
            }
        }

        public static function save() {
            
        }
    }

    AcudienteController::executeAction();
?>