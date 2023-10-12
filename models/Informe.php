<?php

    include_once $_SERVER['DOCUMENT_ROOT'].'/proaulav2/lib/config.php';

    class Informe extends ActiveRecord\Model {
        public static $belongs_to = array (
            array('Profesor'),
            array('Acudido'),
            array('Acudiente')
        );
    }

?>