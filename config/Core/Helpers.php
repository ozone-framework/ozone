<?php
/*
|==================================================================
| Find Folder from directory.
|==================================================================
|
* */
if (!function_exists('getDir')) {
    function getDir($path,$folderName)
    {
        $_directories = glob($path . "*");
        $dirs = [];

        foreach ($_directories as $dir) {

            $modules = str_replace($path, '', $dir);
            $dir = $path . $modules . '/'.$folderName;

            if (is_dir($dir)) {
                $dirs[] = $dir;
            }
        }

        return $dirs;
    }
}


/*
|==================================================================
| Dump and Die Function
|==================================================================
|
* */
if (!function_exists('dd')) {
    function dd()
    {
        $args = func_get_args();
        call_user_func_array('dump', $args);
        die();
    }
}
if (!function_exists('d')) {
    function d()
    {
        $args = func_get_args();
        call_user_func_array('dump', $args);
    }
}
