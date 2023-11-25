<?php

    include_once $_SERVER['DOCUMENT_ROOT'].'/proaulav2/services/AcudidoService.php';

    class AcudidoController {  
        public static function executeAction() {
            $action = $_REQUEST['action'];
            
            switch ($action) {
                case 'Editar':
                    AcudidoController::editAttended();
                    break;
            }
        }

        public static function listStudentStatus() {
            try {
                $estudiantes = AcudidoService::listStudentStatus();

                if ($estudiantes == null){
                    $_SESSION['estudiante.all'] = null;
                } else {
                  $estudiantes = serialize($estudiantes);
                  $_SESSION['estudiante.all'] = $estudiantes;
                }

            } catch(Exception $error){
                $_SESSION['estudiante.all'] = null;
            }
        }

        public static function editAttended() {
            try {
                $identification = $_GET['identification'];
                $name = $_GET['name'];
                $gender = $_GET['gender'];
                $date = $_GET['date'];

                $attended = AcudidoService::findAttended($identification);

                if ($attended) {
                    $attended->nombre = $name;
                    $attended->genero = $gender;
                    
                    AcudidoService::editAttended($attended);

                    echo '<div class="container-information">
                        <div class="image-profile">
                            <img src="data:image/jpeg;base64,' . base64_encode($attended->foto) . '">
                        </div>
                        <div class="information">
                            <div class="title-information">
                                <h2>' . $attended->nombre . '</h2>
                                <span>Estudiante</span>
                            </div>
                            <div class="span-information">
                                <i class="fi fi-ss-user"></i>
                                <span>' . $attended->identificacion . '</span>
                            </div>
                            <div class="span-information">
                                <i class="fi fi-rr-venus-mars"></i>
                                <span>' . $attended->genero . '</span>
                            </div>
                            <div class="span-information">
                                <i class="fi fi-ss-cake-birthday"></i>';
                    $fecha = date('d/m/Y', strtotime($attended->fecha_nacimiento));
                    echo '<span>' . $fecha . '</span>
                            </div>
                            <div class="span-information">
                                <i class="fi fi-sr-balloons"></i>
                                <span>' . $attended->edad . '</span>
                            </div>
                            <div class="span-information">
                                <i class="fi fi-br-wheelchair"></i>
                                <span>' . $attended->discapacidad . '</span>
                            </div>
                            <div class="span-information">
                                <i class="fi fi-sr-key"></i>
                                <span>' . str_repeat('*', strlen($attended->contraseña)) . '</span>
                            </div>
                            <div class="span-information">
                                <span>Editar</span>
                            </div>
                        </div>
                    </div>';

                }

            } catch (Exception $error) {
                echo "Error: " . $error->getMessage();
            }
        }
    }

    AcudidoController::executeAction();

?>