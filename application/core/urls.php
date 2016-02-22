<?php

function url($rgx, $controller) {
    return array(
        'pattern' => $rgx,
        'controller' => $controller
    );
}

return array(
    'home' => url('/^$/', 'Home'),
    'register' => url('/^register\/?$/', 'Register'),
    'logout' => url('/^logout\/?$/', 'Logout'),
    'dashboard' => url('/^dashboard\/?$/', 'Dashboard'),

    url('/^zdz\/ffe\/(?<pk>\d+)\/?$/', 'HomeHouse')
);

?>
