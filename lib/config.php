<?php
require_once 'php-activerecord/ActiveRecord.php';

 ActiveRecord\Config::initialize(function($cfg)
 {
     $cfg->set_model_directory($_SERVER["DOCUMENT_ROOT"]."/proaula_webespecial/models");
     $cfg->set_connections(array(
         'development' => 'mysql://admin_bd:123@localhost/bd_appwebespecial'));
 });
