<?php

    include_once $_SERVER['DOCUMENT_ROOT'].'/proaulav2/models/Acudido.php';
    include_once $_SERVER['DOCUMENT_ROOT'].'/proaulav2/models/Acudiente.php';

    class InscriptionController {
        public static function executeAction() {
            $action = $_REQUEST['action'];
            
            switch ($action) {
                case 'Inscribir':
                    InscriptionController::save();
                    break;
                default:
                    header("Location: ../root/pages/error.php");
                    exit;
            }
        }

        public static function save() {
            $idAttendant = @$_REQUEST['idAttendant'];
            $nameAttendant = @$_REQUEST['nameAttendant'];
            $phone = @$_REQUEST['phone'];
            $mail = @$_REQUEST['mail'];
            $address = @$_REQUEST['address'];
            $passAttendant = @$_REQUEST['passAttendant'];

            $at = new Acudiente();
            $at->identificacion = $idAttendant;
            $at->nombre = $nameAttendant;
            $at->telefono = $phone;
            $at->correo = $mail;
            $at->direccion = $address;
            $at->contraseña = $passAttendant;

            try {
                $at->save(); 
                
                $id = @$_REQUEST['idAttended'];
                $name = @$_REQUEST['nameAttended'];
                $gender = @$_REQUEST['radio-gender'];
                $date = @$_REQUEST['date'];
                $disability = @$_REQUEST['disability'];
                $pass = @$_REQUEST['passAttended'];

                $a = new Acudido();
                $a->identificacion = $id;
                $a->nombre = $name;
                $a->genero = $gender;
                $a->fecha_nacimiento = $date;
                $a->discapacidad = $disability;
                $a->contraseña = $pass;
                $a->identificacion_acudiente = $idAttendant;

                try {
                    $a->save();
                    $msj = "Inscripcion exitosa.";
    
                    header("Location: ../root/pages/inscription.php?msj=$msj");
                    exit;
                } catch (Exception $error) {
                    if (strstr($error->getMessage(), "Duplicate")) {
                        $msj = "El usuario $id ya existe.";
                    } else {
                        $msj = "Ocurrio un error.";
                    }
        
                    header("Location: ../root/pages/inscription.php?msj=$msj");
                    exit;
                }

            } catch (Exception $error) {
                if (strstr($error->getMessage(), "Duplicate")) {
                    $msj = "El usuario $id ya existe.";
                } else {
                    $msj = "Ocurrio un error.";
                }
    
                header("Location: ../root/pages/inscription.php?msj=$msj");
                exit;
            }

        }
        public static function listar(){
            try{
                $inscripcion = Inscripcion::all();

                if ($inscripcion == null){
                    $_SESSION['inscripcion.all'] = null;
                    $msj = "No hay inscripciones disponibles para listar!"
                }else{
                  $total = count($inscripcion);
                  $inscripcion = serialize($inscripcion);
                  $_SESSION['incripcion.all'] = $inscripcion;  
                }
                $msj ="TOTAL DE INSCRIPCIONES: $total";

            }
            



        }
    }

    InscriptionController::executeAction();
?>