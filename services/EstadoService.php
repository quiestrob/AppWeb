<?php

    include_once $_SERVER['DOCUMENT_ROOT'].'/proaulav2/persistences/EstadoCrud.php';
    include_once $_SERVER['DOCUMENT_ROOT'].'/proaulav2/persistences/InscripcionCrud.php';

    class EstadoService {
        public static function acceptStatus($idInscription, $idStatus, $identification) {
            try {
                $status = EstadoCrud::findStatus($idStatus);

                if ($status == null){
                    return null;
                } else {
                    $status->estado = "Aceptada";
                    $status->descripcion = "Su inscripción ha sido aceptada. Ya puede ingresar a la plataforma.";
                    EstadoCrud::saveStatus($status);

                    try {
                        $inscription = InscripcionCrud::findInscription($idInscription);

                        if ($inscription == null) {
                            return null;
                        } else {
                            $inscription->identificacion_fundador = $identification;
                            InscripcionCrud::saveInscription($inscription);
                        }
                    } catch(Exception $error) {
                        return null;
                    }
                }
            } catch(Exception $error) {
                return null;
            }
        }

        public static function declineStatus($idInscription, $idStatus, $identification) {
            try {
                $status = EstadoCrud::findStatus($idStatus);

                if ($status == null){
                    return null;
                } else {
                    $status->estado = "Rechazada";
                    $status->descripcion = "Su inscripción ha sido rechazada. Pongase en contacto con nosotros para más información.";
                    EstadoCrud::saveStatus($status);

                    try {
                        $inscription = InscripcionCrud::findInscription($idInscription);

                        if ($inscription == null) {
                            return null;
                        } else {
                            $inscription->identificacion_fundador = $identification;
                            InscripcionCrud::saveInscription($inscription);
                        }
                    } catch(Exception $error) {
                        return null;
                    }
                }
            } catch(Exception $error){
                return null;
            }
        }
    }

?>