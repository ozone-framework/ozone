<?php
$modulePath = '../app/Modules/';
$_directories = glob($modulePath . "*");
$routeDirs = [];

foreach ($_directories as $dir) {

    $modules = str_replace($modulePath, '', $dir);
    $module = 'app/Modules/' . $modules.'/Routes';

    $routeDirs[] = $module;
}
//print_r($routeDirs);
foreach ($routeDirs as $route){
    $routePath = '../'.$route.'/routes.php';
    if(file_exists($routePath)){
        include $routePath;
    }
}