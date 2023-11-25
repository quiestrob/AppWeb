<?php

    include_once $_SERVER['DOCUMENT_ROOT'].'/proaulav2/models/Usuario.php';
    include_once $_SERVER['DOCUMENT_ROOT'].'/proaulav2/services/UsuarioService.php';

    class UsuarioController {
        public static function executeAction() {
            $action = $_REQUEST['action'];
            
            switch ($action) {
                case 'Editar':
                    UsuarioController::editUser();
                    break;
            }
        }

        public static function findUser($identification) {
            try {
                $user = UsuarioService::findUser($identification);

                if ($user == null){
                    $_SESSION['usuario.all'] = null;
                } else {
                    $user = serialize($user);
                    $_SESSION['usuario.all'] = $user;
                }

            } catch(Exception $error){
                $_SESSION['usuario.all'] = null;
            }
        }

        public static function listAttendant() {
            try {
                $user = UsuarioService::listUserAttendant();

                if ($user == null){
                    $_SESSION['usuario_attendant.all'] = null;
                } else {
                    $user = serialize($user);
                    $_SESSION['usuario_attendant.all'] = $user;
                }

            } catch(Exception $error){
                $_SESSION['usuario_attendant.all'] = null;
            }
        }

        public static function listUserProffesor() {
            try {
                $user = UsuarioService::listUserProffesor();

                if ($user == null){
                    $_SESSION['usuario_profesor.all'] = null;
                } else {
                    $user = serialize($user);
                    $_SESSION['usuario_profesor.all'] = $user;
                }

            } catch(Exception $error){
                $_SESSION['usuario_profesor.all'] = null;
            }
        }

        public static function listProffesorGroup($identification) {
            try {
                $user = UsuarioService::listProffesorGroup($identification);

                if ($user == null){
                    $_SESSION['profesor_grupo.all'] = null;
                } else {
                    $user = serialize($user);
                    $_SESSION['profesor_grupo.all'] = $user;
                }

            } catch(Exception $error){
                $_SESSION['profesor_grupo.all'] = null;
            }
        }

        public static function listProffesorGroupAttendant($identification) {
            try {
                $user = UsuarioService::listProffesorGroupAttendant($identification);

                if ($user == null){
                    $_SESSION['profesor_grupoA.all'] = null;
                } else {
                    $user = serialize($user);
                    $_SESSION['profesor_grupoA.all'] = $user;
                }

            } catch(Exception $error){
                $_SESSION['profesor_grupoA.all'] = null;
            }
        }

        public static function editUser() {
            try {
                $identification = $_GET['identification'];
                $name = $_GET['name'];
                $phone = $_GET['phone'];
                $mail = $_GET['mail'];
                $pass = $_GET['pass'];
                $address = $_GET['address'];

                $user = Usuario::find($identification);

                if ($user) {
                    $user->nombre = $name;
                    $user->telefono = $phone;
                    $user->correo = $mail;
                    $user->contraseña = $pass;
                    $user->direccion = $address;

                    UsuarioService::editUser($user);

                    echo '<div class="container-information">
                        <div class="image-profile">';
                    $foto = base64_encode($user->foto);
                    echo '<img src="data:image/jpeg;base64,' . $foto . '">
                        </div>
                        <div class="information">
                            <div class="title-information">
                                <h2>' . $user->nombre . '</h2>
                                <span>' . $user->tipo_usuario . '</span>
                            </div>
                            <div class="span-information">
                                <i class="fi fi-ss-user"></i>
                                <span>' . $user->identificacion . '</span>
                            </div>
                            <div class="span-information">
                                <i class="fi fi-sr-phone-flip"></i>
                                <span>' . $user->telefono . '</span>
                            </div>
                            <div class="span-information">
                                <i class="fi fi-sr-envelope"></i>
                                <span>' . $user->correo . '</span>
                            </div>
                            <div class="span-information">
                                <i class="fi fi-sr-key"></i>
                                <span>' . str_repeat('*', strlen($user->contraseña)) . '</span>
                            </div>
                            <div class="span-information">
                                <i class="fi fi-sr-house-chimney-blank"></i>
                                <span>' . $user->direccion . '</span>
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

    UsuarioController::executeAction();

?>