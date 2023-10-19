<?php

    include_once $_SERVER['DOCUMENT_ROOT'].'/proaula_webespecial/lib/config.php';

    class Informe extends ActiveRecord\Model {
        public static $belongs_to = array (
            array('Profesor', 'Acudido', 'Acudiente')
        );
    }  

?>