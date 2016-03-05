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
    'preferences' => url('/^preferences\/?$/', 'Preferences'),

    'dashboard' => url('/^dashboard\/?$/', 'Dashboard'),

    # house management
    'house_create' => url('/^h\/create\/?$/', 'HouseCreate'),
    'house_delete' => url('/^h\/(?<id>\d+)\/delete\/?$/', 'HouseDelete'),
    'house_settings' => url('/^h\/(?<id>\d+)\/settings\/?$/', 'HouseSettings'),

    'house_view' => url('/^h\/(?<id>\d+)\/?$/', 'HouseView'),
    'house_members' => url('/^h\/(?<id>\d+)\/members\/?$/', 'HouseMembers'),

    'bill_create' => url('/^h\/(?<id>\d+)\/bills\/create\/?$/', 'BillCreate'),
    'bill_index' => url('/^h\/(?<id>\d+)\/bills\/?$/', 'BillIndex'),
    'bill_view' => url('/^h\/(?<id>\d+)\/bills\/(?<billid>\d+)\/?$/', 'BillView'),

    # json api
    'house_members_add' => url('/^json\/h\/(?<id>\d+)\/members\/add\/?$/', 'HouseMembersAdd'),
    'house_members_remove' => url('/^json\/h\/(?<id>\d+)\/members\/remove\/?$/', 'HouseMembersRemove'),
);

?>
