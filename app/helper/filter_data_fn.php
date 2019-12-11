<?php

if (!function_exists('sanitize')) {
    function sanitize($data) {
        switch($data) {
            case is_array($data):
                $data = filter_var_array($data, FILTER_SANITIZE_STRING);
                $data = array_map('htmlspecialchars', $data);
            break;
            case is_int($data):
                $data = filter_var($data, FILTER_SANITIZE_NUMBER_INT);
                $data = htmlspecialchars($data);
            break;
            default:
                $data = filter_var($data, FILTER_SANITIZE_STRING);
                $data = htmlspecialchars($data);
        }
        return $data;
    }
}