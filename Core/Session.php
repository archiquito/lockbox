<?php

namespace Core;

class Session
{
    public function get($key, $default = null)
    {
        return isset($_SESSION[$key]) ? $_SESSION[$key] : $default;
    }

    public function set($key, $value)
    {
        return $_SESSION[$key] = $value;
    }

    public function destroy($key)
    {
        unset($_SESSION[$key]);
    }
}
