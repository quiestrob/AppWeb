<?php

    include_once $_SERVER['DOCUMENT_ROOT'].'/proaula_webespecial/lib/config.php';

    class Acudiente extends ActiveRecord\Model {
        public static $primary_key = 'Identificacion';
        public static $has_many = array (
            array('Acudidos', 'Informes')
        );
    }

?>