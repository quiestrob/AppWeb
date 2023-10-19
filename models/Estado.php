<?php

    include_once $_SERVER['DOCUMENT_ROOT'].'/proaula_webespecial/lib/config.php';

    class Estado extends ActiveRecord\Model {
        public static $has_one = array (
            array('Inscripcion')
        );
    }

?>