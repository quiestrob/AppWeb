<?php

    include_once $_SERVER['DOCUMENT_ROOT'].'/proaula_webespecial/lib/config.php';

    class Profesor extends ActiveRecord\Model {
        public static $primary_key = 'Identificacion';
        public static $has_many = array (
            array('Actividades', 'Informes')
        );
        public static $table_name = 'Profesores';
    }

?>