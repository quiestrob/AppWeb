<?php

    include_once $_SERVER['DOCUMENT_ROOT'].'/proaulav2/models/Usuario.php';
    include_once $_SERVER['DOCUMENT_ROOT'].'/proaulav2/models/Acudido.php';
    include_once $_SERVER['DOCUMENT_ROOT'].'/proaulav2/models/Estado.php';
    include_once $_SERVER['DOCUMENT_ROOT'].'/proaulav2/models/Inscripcion.php';

    include_once $_SERVER['DOCUMENT_ROOT'].'/proaulav2/services/UsuarioService.php';
    include_once $_SERVER['DOCUMENT_ROOT'].'/proaulav2/services/AcudidoService.php';
    include_once $_SERVER['DOCUMENT_ROOT'].'/proaulav2/services/EstadoService.php';
    include_once $_SERVER['DOCUMENT_ROOT'].'/proaulav2/services/InscripcionService.php';

    class InscriptionController {
        public static function executeAction() {
            $action = @$_REQUEST['action'];

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
            $fotoAttendant = file_get_contents(@$_FILES['img-attendant']['tmp_name']); 
            
            $attendant = new Usuario();
            $attendant->identificacion = $idAttendant;
            $attendant->nombre = $nameAttendant;
            $attendant->telefono = $phone;
            $attendant->correo = $mail;
            $attendant->direccion = $address;
            $attendant->contraseña = $passAttendant;
            $attendant->tipo_usuario = "Acudiente";
            $attendant->foto = $fotoAttendant;

            try {
                UsuarioService::saveUser($attendant); 
                
                $id = @$_REQUEST['idAttended'];
                $name = @$_REQUEST['nameAttended'];
                $gender = @$_REQUEST['radio-gender'];
                $date = @$_REQUEST['date'];
                $disability = @$_REQUEST['disability'];
                $pass = @$_REQUEST['passAttended'];
                $fotoAttended = file_get_contents(@$_FILES['img-attended']['tmp_name']); 

                $attended = new Acudido();
                $attended->identificacion = $id;
                $attended->nombre = $name;
                $attended->genero = $gender;
                $attended->fecha_nacimiento = $date;
                $attended->discapacidad = $disability;
                $attended->contraseña = $pass;
                $attended->identificacion_usuario = $idAttendant;
                $attended->foto = $fotoAttended;

                try {
                    AcudidoService::saveAttended($attended);

                    $estado = "Pendiente";
                    $descripcion = "Su inscripción aún esta siendo revisada. Por favor, verifique en los próximos días.";

                    $status = new Estado();
                    $status->estado = $estado;
                    $status->descripcion = $descripcion;

                    try {
                        EstadoService::saveStatus($status);

                        $fecha = date("Y/m/d");
                        $id_status = $status->id;
                        
                        $inscription = new Inscripcion();
                        $inscription->fecha_inscripcion = $fecha;
                        $inscription->estado_id = $id_status;
                        $inscription->identificacion_acudido = $id;

                        try {
                            InscripcionService::saveInscription($inscription);
                            $msj = "Inscripcion exitosa.";                          

                            header("Location: ../root/pages/inscription.php?msj=$msj");
                            exit;
                        } catch (Exception $error) {
                            if (strstr($error->getMessage(), "Duplicate")) {
                                $msj = "La inscripcion ya existe.";
                            } else {
                                $msj = "Ocurrio un error.";
                            }
                            
                            header("Location: ../root/pages/inscription.php?msj=$msj");
                            exit;
                        }

                    } catch (Exception $error) {
                        if (strstr($error->getMessage(), "Duplicate")) {
                            $msj = "El estado ya existe.";
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

    }

    InscriptionController::executeAction();
?>