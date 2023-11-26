<?php

    include_once $_SERVER['DOCUMENT_ROOT'].'/proaulav2/models/Actividad.php';
    include_once $_SERVER['DOCUMENT_ROOT'].'/proaulav2/services/ActividadService.php';

    class ActividadController {  
        public static function executeAction() {
            $action = $_REQUEST['action'];
            
            switch ($action) {
                case 'Guardar':
                    ActividadController::saveActivity();
                    break;
                case 'Editar':
                    ActividadController::editActivity();
                    break;
                case 'Eliminar':
                    ActividadController::deleteActivity();
                    break;
            }
        }

        public static function listAllActivities() {
            try {
                $activities = ActividadService::listAllActivities();

                if ($activities == null) {
                    $_SESSION['actividad.all'] = null;
                } else {
                    $activities = serialize($activities);
                    $_SESSION['actividad.all'] = $activities; 
                }
            } catch(Exception $error){
                echo "Error: " + $error->getMessage();
            }
        }

        public static function listActivities($identification) {
            try {
                $activities = ActividadService::listActivities($identification);

                if ($activities == null) {
                    $_SESSION['actividad.all'] = null;
                } else {
                    $activities = serialize($activities);
                    $_SESSION['actividad.all'] = $activities; 
                }
            } catch(Exception $error){
                echo "Error: " + $error->getMessage();
            }
        }

        public static function listActivitiesAttendant($identification) {
            try {
                $activities = ActividadService::listActivitiesAttendant($identification);

                if ($activities == null) {
                    $_SESSION['actividad.all'] = null;
                } else {
                    $activities = serialize($activities);
                    $_SESSION['actividad.all'] = $activities; 
                }
            } catch(Exception $error){
                echo "Error: " + $error->getMessage();
            }
        }

        public static function listActivitiesProffesor($identification) {
            try {
                $activities = ActividadService::listActivitiesProffesor($identification);

                if ($activities == null) {
                    $_SESSION['actividad.all'] = null;
                } else {
                    $activities = serialize($activities);
                    $_SESSION['actividad.all'] = $activities; 
                }
            } catch(Exception $error){
                echo "Error: " + $error->getMessage();
            }
        }

        public static function saveActivity() {
            try {
                $title = $_GET['title'];
                $description = $_GET['description'];
                $archive = $_GET['archive']; 
                $group = $_GET['group'];
                $identification = $_GET['identification'];
                
                $activity = new Actividad();
                $activity->titulo = $title;
                $activity->descripcion = $title;
                $activity->archivo = $archive;
                $activity->id_grupo = $group;
                $activity->identificacion_usuario = $identification;

                ActividadService::saveActivity($activity);

                //Listar
                $actividad = ActividadService::listActivitiesProffesor($identification);

                echo '<table>
                        <tr>
                            <th>Titulo</th>
                            <th>Descripcion</th>
                            <th>Archivo</th>
                            <th>Fecha</th>
                            <th>Grupo</th>
                            <th>Accion</th>
                        </tr>';

                    foreach ($actividad as $a) {
                        $fecha = date('d/m/Y', strtotime($a->fecha_asignacion));

                        $base64 = base64_encode($a->archivo);
                        $ruta = 'data:application/pdf;base64,' . $base64;

                        echo '<tr>
                                <td>' . $a->titulo . '</td>
                                <td>' . $a->descripcion . '</td>
                                <td><a href="' . $ruta . '" download="' . $a->titulo . '.pdf">' . $a->titulo . '.pdf</a></td>
                                <td>' . $fecha . '</td>
                                <td>' . $a->aula . '</td>
                                <td>
                                    <div class="button-edit" onclick="openEditActivity(' . $a->id . ', \'' . $a->titulo . '\', \'' . $a->descripcion . '\')">
                                        <i class="fi fi-sr-select"></i>
                                    </div>
                                    <div class="button-delete" onclick="openDeleteActivity(' . $a->id . ', ' . $identification . ')">
                                        <i class="fi fi-sr-trash"></i>
                                    </div>
                                </td>
                            </tr>';
                    }

                echo '</table>';

            } catch(Exception $error){
                echo "Error: " . $error->getMessage();
            }
        }

        public static function editActivity() {
            try {
                $id = $_GET['id'];
                $description = $_GET['description'];
                $archive = $_GET['archive'];
                $identification = $_GET['identification'];

                $activity = ActividadService::findActivity($id);

                if ($activity) {
                    $activity->descripcion = $description;
                    $activity->archivo = $archive;

                    ActividadService::editActivity($activity);
                    $actividad = ActividadService::listActivitiesProffesor($identification);

                    echo '<table>
                            <tr>
                                <th>Titulo</th>
                                <th>Descripcion</th>
                                <th>Archivo</th>
                                <th>Fecha</th>
                                <th>Grupo</th>
                                <th>Accion</th>
                            </tr>';

                        foreach ($actividad as $a) {
                            $fecha = date('d/m/Y', strtotime($a->fecha_asignacion));

                            $base64 = base64_encode($a->archivo);
                            $ruta = 'data:application/pdf;base64,' . $base64;

                            echo '<tr>
                                    <td>' . $a->titulo . '</td>
                                    <td>' . $a->descripcion . '</td>
                                    <td><a href="' . $ruta . '" download="' . $a->titulo . '.pdf">' . $a->titulo . '.pdf</a></td>
                                    <td>' . $fecha . '</td>
                                    <td>' . $a->aula . '</td>
                                    <td>
                                        <div class="button-edit" onclick="openEditActivity(' . $a->id . ', \'' . $a->titulo . '\', \'' . $a->descripcion . '\')">
                                            <i class="fi fi-sr-select"></i>
                                        </div>
                                        <div class="button-delete" onclick="openDeleteActivity(' . $a->id . ', ' . $identification . ')">
                                            <i class="fi fi-sr-trash"></i>
                                        </div>
                                    </td>
                                </tr>';
                        }

                    echo '</table>';
                } 

            } catch (Exception $error) {
                echo "Error: " . $error->getMessage();
            }
        }

        public static function deleteActivity() {
            try {
                $id = $_GET['id'];
                $identification = $_GET['identification'];
                
                ActividadService::deleteActivity($id);
                $actividad = ActividadService::listActivitiesProffesor($identification);

                echo '<table>
                        <tr>
                            <th>Titulo</th>
                            <th>Descripcion</th>
                            <th>Archivo</th>
                            <th>Fecha</th>
                            <th>Grupo</th>
                            <th>Accion</th>
                        </tr>';

                    foreach ($actividad as $a) {
                        $fecha = date('d/m/Y', strtotime($a->fecha_asignacion));

                        $base64 = base64_encode($a->archivo);
                        $ruta = 'data:application/pdf;base64,' . $base64;

                        echo '<tr>
                                <td>' . $a->titulo . '</td>
                                <td>' . $a->descripcion . '</td>
                                <td><a href="' . $ruta . '" download="' . $a->titulo . '.pdf">' . $a->titulo . '.pdf</a></td>
                                <td>' . $fecha . '</td>
                                <td>' . $a->aula . '</td>
                                <td>
                                    <div class="button-edit" onclick="openEditActivity(' . $a->id . ', \'' . $a->titulo . '\', \'' . $a->descripcion . '\')">
                                        <i class="fi fi-sr-select"></i>
                                    </div>
                                    <div class="button-delete" onclick="openDeleteActivity(' . $a->id . ', ' . $identification . ')">
                                        <i class="fi fi-sr-trash"></i>
                                    </div>
                                </td>
                            </tr>';
                    }

                echo '</table>';
            } catch (Exception $error) {
                echo "Error: " . $error->getMessage();
            }
        }
    }

    ActividadController::executeAction();

?>