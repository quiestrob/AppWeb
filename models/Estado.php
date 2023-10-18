<?php

    include_once $_SERVER['DOCUMENT_ROOT'].'/proaulav2/lib/config.php';

    class Estado extends ActiveRecord\Model {
        public static $has_one = array (
            array('inscripcion', 'class_name' => 'Inscripcion')
        );
    }

?>