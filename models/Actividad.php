<?php

    include_once $_SERVER['DOCUMENT_ROOT'].'/proaulav2/lib/config.php';

    class Actividad extends ActiveRecord\Model {
        public static $table_name = 'Actividades';
        public static $belongs_to = array (
            array('Grupo'),
            array('Profesor')
        );
    }

?>