<?php
namespace Core;

class Flash
{
    public function make($key, $value)
    {
        $_SESSION[$key] = $value;
        return;
    }
    public function get($key)
    {
        if (!isset($_SESSION[$key])) {
            return false;
        }
        $value =  $_SESSION[$key];
        unset($_SESSION[$key]);
        return $value;
    }
    public function getSession($key)
    {
        if (!isset($_SESSION[$key])) {
            return false;
        }
        $value =  $_SESSION[$key];
        return $value;
    }
}
