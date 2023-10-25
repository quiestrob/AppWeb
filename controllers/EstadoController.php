<?php

    include_once $_SERVER['DOCUMENT_ROOT'].'/proaulav2/models/Estado.php';
    include_once $_SERVER['DOCUMENT_ROOT'].'/proaulav2/models/Inscripcion.php';
    include_once $_SERVER['DOCUMENT_ROOT'].'/proaulav2/controllers/InscripcionController.php';

    class EstadoController {  
        public static function executeAction() {
            $action = @$_GET['action'];

            switch ($action) {
                case 'Aceptar':
                    EstadoController::aceptar();
                    break;
                case 'Rechazar':
                    EstadoController::rechazar();
                    break;
                default:
                    header("Location: ../root/pages/error.php");
                    exit;
            }
        }

        public static function aceptar() {
            $id = @$_GET['estado'];
            $identificacion = @$_GET['fundador'];
            $idI = @$_GET['id'];

            try {
                $estado = Estado::find($id);

                if ($estado == null){
                    //
                } else {
                    $estado->estado = "Aceptada";
                    $estado->descripcion = "Su inscripción ha sido aceptada. Ya puede ingresar a la plataforma.";
                    $estado->save();   

                    EstadoController::actualizar();           

                    try {
                        $inscripcion = Inscripcion::find($idI);
                        $inscripcion->identificacion_fundador = $identificacion;
                        $inscripcion->save();
                    } catch (Exception $error) {
                        echo $error->getMessage();
                    }
                } 

            } catch(Exception $error){
               echo $error->getMessage();
            }
        }

        public static function rechazar() {
            $id = @$_GET['estado'];
            $identificacion = @$_GET['fundador'];
            $idI = @$_GET['id'];

            try {
                $estado = Estado::find($id);

                if ($estado == null){
                    //
                } else {
                    $estado->estado = "Rechazada";
                    $estado->descripcion = "Su inscripción ha sido rechazada. Pongase en contacto con nosotros para más información.";
                    $estado->save();

                    EstadoController::actualizar();

                    try {
                        $inscripcion = Inscripcion::find($idI);
                        $inscripcion->identificacion_fundador = $identificacion;
                        $inscripcion->save();
                    } catch (Exception $error) {
                        echo $error->getMessage();
                    }
                } 

            } catch(Exception $error){
               echo $error->getMessage();
            }
        }

        public static function actualizar() {
            try {
                InscripcionController::listar();

                $inscripcion = @$_SESSION['inscripcion.all'];
                $inscripcion = @unserialize($inscripcion);

                echo "
                    <table>
                        <tr>
                            <th>ID</th>
                            <th>Nombre</th>
                            <th>Fecha</th>
                            <th>Discapacidad</th>
                            <th>Estado</th>
                            <th>Accion</th>
                        </tr>";

                foreach ($inscripcion as $i) {
                    $fecha = date('d/m/Y', strtotime($i->fecha_inscripcion));
                    
                    echo "
                        <tr>
                            <td>" . $i->id . "</td>
                            <td>" . $i->nombre . "</td>
                            <td>" . $fecha . "</td>
                            <td>" . $i->discapacidad . "</td>
                            <td>" . $i->estado . "</td>
                            <td>";

                    if ($i->estado == 'Aceptada') {
                        echo "
                            <div class='button-accept active'>
                                <i class='fi fi-br-check'></i>
                                <span>Aceptar</span>
                            </div>
                            <div class='button-decline'>
                                <i class='fi fi-br-x'></i>
                                <span>Rechazar</span>
                            </div>";
                    } else if ($i->estado == 'Rechazada') {
                        echo "
                            <div class='button-accept'>
                                <i class='fi fi-br-check'></i>
                                <span>Aceptar</span>
                            </div>
                            <div class='button-decline active'>
                                <i class='fi fi-br-x'></i>
                                <span>Rechazar</span>
                            </div>";
                    } else {
                        echo "
                            <div class='button-accept' onclick='accept(" . $i->estado_id . ", " . $a->identificacion . ", " . $i->id . ")'>
                                <i class='fi fi-br-check'></i>
                                <span>Aceptar</span>
                            </div>
                            <div class='button-decline' onclick='decline(" . $i->estado_id . ", " . $a->identificacion . ", " . $i->id . ")'>
                                <i class='fi fi-br-x'></i>
                                <span>Rechazar</span>
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