<?php
session_start();
require "../Core/functions.php";

spl_autoload_register(function ($class) {
    $class = str_replace("\\", DIRECTORY_SEPARATOR, $class);
    //var_dump(base_path("$class.php"));
    require base_path("$class.php");
});
require base_path("config/routes.php");
