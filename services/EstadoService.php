<?php

    include_once $_SERVER['DOCUMENT_ROOT'].'/proaulav2/persistences/EstadoCrud.php';
    include_once $_SERVER['DOCUMENT_ROOT'].'/proaulav2/persistences/InscripcionCrud.php';

    class EstadoService {
        public static function listStatus($identification) {
            try {
                $statusInscription = Estado::find('all', array(
                    'joins' => array(
                        'INNER JOIN inscripciones ON estados.ID = inscripciones.estado_id',
                        'INNER JOIN acudidos ON inscripciones.identificacion_acudido = acudidos.identificacion'
                    ),
                    'select' => 'Estados.Estado, Estados.Descripcion',
                    'conditions' => "acudidos.identificacion = '$identification'"
                ));

                if ($statusInscription == null) {
                    return null;
                } else {
                    return $statusInscription;
                }

            } catch(Exception $error) {
                return null;
            }
        }

        public static function listStatusAttendant($identification) {
            try {
                $statusInscription = Estado::find('all', array(
                    'joins' => array(
                        'INNER JOIN Inscripciones ON Estados.ID = Inscripciones.estado_id',
                        'INNER JOIN Acudidos ON Inscripciones.Identificacion_acudido = Acudidos.Identificacion',
                        'INNER JOIN Usuarios ON Usuarios.Identificacion = Acudidos.Identificacion_usuario'
                    ),
                    'select' => 'Estados.Estado, Estados.Descripcion',
                    'conditions' => "Usuarios.identificacion = '$identification' AND Usuarios.Tipo_usuario = 'Acudiente'"
                ));

                if ($statusInscription == null) {
                    return null;
                } else {
                    return $statusInscription;
                }

            } catch(Exception $error) {
                return null;
            }
        }

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

        public static function saveStatus($status) {
            try {
                EstadoCrud::saveStatus($status);
            } catch(Exception $error){
                return $error->getMessage();
            }
        }
    }

?>