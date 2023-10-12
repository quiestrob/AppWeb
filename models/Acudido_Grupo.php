<?php

    include_once $_SERVER['DOCUMENT_ROOT'].'/proaulav2/lib/config.php';

    class Acudido_Grupo extends ActiveRecord\Model {
        public static $has_many = array (
            array('Grupos'),
            array('Acudidos')
        );
    }

?>