<?php

    include_once $_SERVER['DOCUMENT_ROOT'].'/proaulav2/lib/config.php';

    class Inscripcion extends ActiveRecord\Model {
        public static $table_name = 'Inscripciones';
        public static $has_one = array (
            array('Acudido', 'Estado', 'Fundador')
        );
    }

?>