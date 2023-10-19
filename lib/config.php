<?php
require_once 'php-activerecord/ActiveRecord.php';

 ActiveRecord\Config::initialize(function($cfg)
 {
     $cfg->set_model_directory($_SERVER["DOCUMENT_ROOT"]."/proaulav2/models");
     $cfg->set_connections(array(
         'development' => 'mysql://user_administrador:0710@localhost/db_platform'));
 });
