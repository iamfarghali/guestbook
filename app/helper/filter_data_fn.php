<?php

if (!function_exists('sanitize')) {
    function sanitize($data) {
        switch($data) {
            case is_array($data):
                $data = filter_var_array($data, FILTER_SANITIZE_STRING);
                break;
            case is_int($data):
                $data = filter_var($data, FILTER_SANITIZE_NUMBER_INT);
                break;
            default:
                $data = filter_var($data, FILTER_SANITIZE_STRING);
        }
        return $data;
    }
}