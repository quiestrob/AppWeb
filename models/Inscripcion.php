<?php

    include_once $_SERVER['DOCUMENT_ROOT'].'/proaulav2/lib/config.php';

    class Inscripcion extends ActiveRecord\Model {
        public static $belongs_to = array (
            array('Acudido', 'Estado', 'Fundador')
        );
        public static $table_name = 'Inscripciones';
    }

?>