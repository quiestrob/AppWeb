<?php

    include_once $_SERVER['DOCUMENT_ROOT'].'/proaulav2/lib/config.php';

    class Mensaje extends ActiveRecord\Model {
        public static $has_many = array (
            array('Profesor', 'Acudiente')
        );
    }

?>