<?php

if (!function_exists('redirect')) {
    function redirect($location) {
       $location = strpos($location, '.') ? str_replace('.', DS, $location) : $location;
       header('Location:'.APPURL.$location);
    }
}