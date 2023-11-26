<?php

    include_once $_SERVER['DOCUMENT_ROOT'].'/proaulav2/services/InformeService.php';

    class InformeController {  
        public static function executeAction() {
            $action = $_REQUEST['action'];
            
            switch ($action) {
                case 'Guardar':
                    InformeController::saveReport();
                    break;
            }
        }

        public static function listReport($identification) {
            try {
                $report = InformeService::listReport($identification);

                if ($report == null){
                    $_SESSION['report.all'] = null;
                } else {
                    $report = serialize($report);
                    $_SESSION['report.all'] = $report;
                } 

            } catch(Exception $error){
                $_SESSION['report.all'] = null;
            }
        }

        public static function listReportAttendant($identification) {
            try {
                $report = InformeService::listReportAttendant($identification);

                if ($report == null){
                    $_SESSION['report.all'] = null;
                } else {
                    $report = serialize($report);
                    $_SESSION['report.all'] = $report;
                } 

            } catch(Exception $error){
                $_SESSION['report.all'] = null;
            }
        }

        public static function saveReport() {
            try {
                $description = $_GET['description'];
                $idAttended = $_GET['idAttended'];
                $idUser = $_GET['idUser'];

                $report = new Informe();
                $report->descripcion = $description;
                $report->identificacion_acudido = $idAttended;
                $report->identificacion_usuario = $idUser;

                InformeService::saveReport($report);
                $report = InformeService::listReportAttendant($idUser);

                echo '
                    ' . ($report == null ? '<span>No hay informes</span>' : '');

                if ($report != null) {
                    foreach ($report as $r) {
                        $fecha = date('d/m/Y', strtotime($r->fecha_informe));
                        echo '
                            <div class="card-report">
                                <span>' . $fecha . '</span>
                                <span>' . $r->nombre . '</span>
                                <span>' . $r->descripcion . '</span>
                            </div>';
                    }
                }

            } catch(Exception $error){
                echo "Error: " . $error->getMessage();
            }
        }
    }

    InformeController::executeAction();

?>