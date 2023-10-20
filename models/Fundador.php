<?php

    include_once $_SERVER['DOCUMENT_ROOT'].'/proaulav2/lib/config.php';

    class Fundador extends ActiveRecord\Model {
        public static $primary_key = "Identificacion";
        public static $table_name = "Fundadores";
        public static $has_many = array (
            array('Inscripcion')
        );
    }

?>