<?php

    include_once $_SERVER['DOCUMENT_ROOT'].'/proaulav2/lib/config.php';

    class Usuario extends ActiveRecord\Model {
        public static $has_many = array (
            array('Acudido', 'Actividad', 'Informe', 'Donacion')
        );
    }

?>