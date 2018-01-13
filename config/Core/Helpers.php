<?php
/*
|==================================================================
| Find Folder from directory.
|==================================================================
|
* */
if (!function_exists('getDir')) {
    function getDir($path, $folderName)
    {
        $_directories = glob($path . "*");
        $dirs = [];

        foreach ($_directories as $dir) {

            $modules = str_replace($path, '', $dir);
            $dir = $path . $modules . '/' . $folderName;

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

if (!function_exists('flash')) {

    function flash($key, $message, $sticky = false, $redirect = null)
    {
        $flash = new \Core\FlashMessage();

        switch ($key) {

            case 'success':
                $flash->success("<i class='fa fa-check-square-o'></i> " . $message, $redirect, $sticky);
                break;

            case 'error':
                $flash->error("<i class='fa fa-warning'></i> " . $message, $redirect, $sticky);
                break;

            case 'warning':
                $flash->warning("<i class='fa fa-warning'></i> " . $message, $redirect, $sticky);
                break;

            case 'info':
                $flash->info("<i class='fa fa-info-circle'></i> " . $message, $redirect, $sticky);
                break;

            default :
                break;
        }
    }

}
