<?php

    include_once $_SERVER['DOCUMENT_ROOT'].'/proaulav2/models/Fundador.php';
    include_once $_SERVER['DOCUMENT_ROOT'].'/proaulav2/services/FundadorService.php';

    class FundadorController {
        public static function editFounder() {
            try {
                $identification = $_GET['identification'];
                $name = $_GET['name'];
                $pass = $_GET['pass'];
                $mail = $_GET['mail'];
                
                $founder = FundadorService::findFounder($identification);
                
                if ($founder) {
                    $founder->nombre = $name;
                    $founder->contraseña = $pass;
                    $founder->correo = $mail;
                    FundadorService::editFounder($founder);

                    echo "
                        <div class='container-information'>
                            <div class='image-profile'> ";
                                    $foto = base64_encode($founder->foto) ;
                    echo "      <img src='data:image/jpeg;base64," . $foto . "'>
                            </div>
                            <div class='information'>
                                <div class='title-information'>
                                    <h2>" . $founder->nombre . "</h2>
                                    <span>Administrador</span>
                                </div>
                                <div class='span-information'>
                                    <i class='fi fi-ss-user'></i>
                                    <span>" . $founder->identificacion . "</span>
                                </div>
                                <div class='span-information'>
                                    <i class='fi fi-sr-envelope'></i>
                                    <span>" . $founder->correo . "</span>
                                </div>
                                <div class='span-information'>
                                    <i class='fi fi-sr-key'></i>
                                    <span>" . str_repeat('*', strlen($founder->contraseña)) . "</span>
                                </div>
                                <div class='span-information'>
                                    <span>Editar</span>
                                </div>
                            </div>
                        </div>
                    ";
                }
                
            } catch (Exception $error) {
                echo "Error: " . $error->getMessage();
            }
        }
    } 

    FundadorController::editFounder();

?>