<?php

if (!function_exists('checkMenuItemActive')) {
    function checkMenuItemActive(string $url, string $class = 'active'): string
    {
        return Request::url() === $url ? $class : '';
    }
}
