<?php

    include_once $_SERVER['DOCUMENT_ROOT'].'/proaulav2/models/Donacion.php';
    include_once $_SERVER['DOCUMENT_ROOT'].'/proaulav2/services/DonacionService.php';

    class DonacionController {  
        public static function executeAction() {
            $action = $_REQUEST['action'];
            
            switch ($action) {
                case 'Guardar':
                    DonacionController::saveDonation();
                    break;
                case 'Conteo':
                    DonacionController::countDonation();
                    break;
            }
        }

        public static function saveDonation() {
            try {
                $monto = $_GET['monto'];
                $identification = $_GET['identification'];
                $type = $_GET['type'];
                
                $donation = new Donacion();
                $donation->monto = $monto;

                if ($type == 'Profesor' || $type == 'Acudiente') {
                    $donation->identificacion_usuario = $identification;
                } else {
                    $donation->identificacion_fundador = $identification;
                }

                DonacionService::saveDonation($donation);
                DonacionController::listCount($identification);
            } catch(Exception $error){
                echo "Error: " + $error->getMessage();
            }
        }

        public static function countDonation($identification) {
            try {
                $donation = DonacionService::countDonation($identification);

                if ($donation == null){
                    $_SESSION['donacion.all'] = null;
                } else {
                    $donation = serialize($donation);
                    $_SESSION['donacion.all'] = $donation;
                } 

            } catch(Exception $error){
                $_SESSION['donacion.all'] = $donation;
            }
        }

        public static function listCount($identification) {
            try {
                $donation = DonacionService::countDonation($identification);

                echo "
                    <div class='total-donation'>
                        <span>Total donaciones</span>
                        <span>";
                            foreach ($donation as $d) {
                                echo $d->conteo;
                            }
                echo "</span>
                    </div>
                    <div class='mount-donation'>
                        <span>Monto total donado</span>
                        <span>";
                            foreach ($donation as $d) {
                                echo $d->total . " USD";
                            }  
                echo "  </span>
                    </div> 
                ";
            } catch (Exception $error) {
                echo $error->getMessage();
            }
        }
    }

    DonacionController::executeAction();

?>