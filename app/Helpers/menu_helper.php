<?php

if (!function_exists('set_active')) {
    function set_active($route, $exactMatch = false)
    {
        $request      = service('request'); // Get the request instance
        $currentRoute = $request->getUri()->getPath(); // Get the current URI path

        $route        = 'appstarter/' . $route;
        $currentRoute = ltrim($currentRoute, '/');
        //return $currentRoute . '---' . $route;

        if ($exactMatch) {
            return ($currentRoute === $route) ? 'active' : 'inactive';
        }

        return (strpos($currentRoute, $route) === 0) ? 'active' : 'inactive';
    }
}

if (!function_exists('set_show')) {
    function set_show($route, $exactMatch = false)
    {
        $request      = service('request'); // Get the request instance
        $currentRoute = $request->getUri()->getPath(); // Get the current URI path

        $route        = 'appstarter/' . $route;
        $currentRoute = ltrim($currentRoute, '/');

        if ($exactMatch) {
            return ($currentRoute === $route) ? 'show' : '';
        }

        return (strpos($currentRoute, $route) === 0) ? 'show' : '';
    }
}
