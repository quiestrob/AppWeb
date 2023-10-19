<?php

    include_once $_SERVER['DOCUMENT_ROOT'].'/proaula_webespecial/lib/config.php';

    class Grupo extends ActiveRecord\Model {
        public static $has_many = array (
            array('Actividades')
        );
    }

?>