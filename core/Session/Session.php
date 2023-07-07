<?php

namespace Core\Session;


abstract class Session
{


    public static function start(): void
    {
        if (session_status() !== PHP_SESSION_ACTIVE) {
            \session_start();
        }

    }


    public static function get($key) : ?string
    {
        if (isset($_SESSION[$key])) {
            return $_SESSION[$key];
        }

        return null;

    }


    public static function set($key, $value): void
    {
        $_SESSION[$key] = $value;

    }


    public static function delete($key): void
    {
        unset($_SESSION[$key]);

    }


    public static function destroy(): void
    {
        if (session_status() === PHP_SESSION_ACTIVE) {
            \session_destroy();
        }

    }


}
