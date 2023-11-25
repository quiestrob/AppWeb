<?php

    include_once $_SERVER['DOCUMENT_ROOT'].'/proaulav2/services/EstadoService.php';
    include_once $_SERVER['DOCUMENT_ROOT'].'/proaulav2/services/InscripcionService.php';

    class EstadoController {  
        public static function executeAction() {
            $action = @$_GET['action'];

            switch ($action) {
                case 'Aceptar':
                    EstadoController::acceptStatus();
                    break;
                case 'Rechazar':
                    EstadoController::declineStatus();
                    break;
                default:
                    header("Location: ../root/pages/error.php");
                    exit;
            }
        }

        public static function acceptStatus() {
            $idStatus = @$_GET['estado'];
            $identification = @$_GET['fundador'];
            $idInscription = @$_GET['id'];

            try {
                EstadoService::acceptStatus($idInscription, $idStatus, $identification);
                EstadoController::updateTable();
            } catch(Exception $error){
               echo $error->getMessage();
            }
        }

        public static function declineStatus() {
            $idStatus = @$_GET['estado'];
            $identification = @$_GET['fundador'];
            $idInscription = @$_GET['id'];

            try {
                EstadoService::declineStatus($idInscription, $idStatus, $identification);
                EstadoController::updateTable($identification);
            } catch(Exception $error){
               echo $error->getMessage();
            }
        }

        public static function updateTable($identification) {
            try {
                $inscripcion = InscripcionService::listInscription();           

                echo "
                    <table>
                        <tr>
                            <th>Foto</th>
                            <th>Nombre</th>
                            <th>Fecha</th>
                            <th>Discapacidad</th>
                            <th>Estado</th>
                            <th>Accion</th>
                        </tr>";

                foreach ($inscripcion as $i) {
                    $fecha = date('d/m/Y', strtotime($i->fecha_inscripcion)); 
                    $foto = base64_encode($i->foto);                
                    
                    echo "
                        <tr>
                            <td>
                                <img src='data:image/jpeg;base64,". $foto ."'>
                            </td>
                            <td>" . $i->nombre . "</td>
                            <td>" . $fecha . "</td>
                            <td>" . $i->discapacidad . "</td>
                            <td>" . $i->estado . "</td>
                            <td>";

                    if ($i->estado == 'Aceptada' || $i->estado == 'Rechazada') {
                        echo "
                            <span>No disponible</span>    
                        ";
                    } else {
                        echo "
                            <div class='button-accept' onclick='accept(" . $i->estado_id . ", " . $identification . ", " . $i->id . ")'>
                                <i class='fi fi-sr-checkbox'></i>
                            </div>
                            <div class='button-decline' onclick='decline(" . $i->estado_id . ", " . $identification . ", " . $i->id . ")'>
                                <i class='fi fi-sr-trash'></i>
                            </div>";
                    }

                    echo "</td>
                        </tr>";
                }

                echo "</table>";

            } catch (Exception $error) {
                echo $error->getMessage();
            }
        }
    }

    EstadoController::executeAction();

?>