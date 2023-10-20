<?php

    include_once $_SERVER['DOCUMENT_ROOT'].'/proaulav2/lib/config.php';

    class Profesor extends ActiveRecord\Model {
        public static $table_name = 'Profesores';
        public static $primary_key = 'Identificacion';
        public static $has_many = array (
            array('Actividad', 'Informe')
        );
    }

?>