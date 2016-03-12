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
    'account' => url('/^account\/?$/', 'Account'),
    'account_password' => url('/^account\/password\/?$/', 'AccountPassword'),

    'dashboard' => url('/^dashboard\/?$/', 'Dashboard'),

    # house management
    'house_create' => url('/^h\/create\/?$/', 'HouseCreate'),
    'house_join' => url('/^h\/join\/?$/', 'HouseJoin'),
    'house_delete' => url('/^h\/(?<id>\d+)\/delete\/?$/', 'HouseDelete'),
    'house_settings' => url('/^h\/(?<id>\d+)\/settings\/?$/', 'HouseSettings'),
    'house_notifications' => url('/^h\/(?<id>\d+)\/notifications\/?$/', 'HouseNotifications'),

    'house_view' => url('/^h\/(?<id>\d+)\/?$/', 'BillsSummary'), #'HouseView'),
    'house_members' => url('/^h\/(?<id>\d+)\/members\/?$/', 'HouseMembers'),
    'house_members_add' => url('/^h\/(?<id>\d+)\/members\/add\/?$/', 'HouseMembersAdd'),
    'house_members_remove' => url('/^h\/(?<id>\d+)\/members\/(?<userid>\d+)\/remove\/?$/', 'HouseMembersRemove'),

    'bill_create' => url('/^h\/(?<id>\d+)\/bills\/create\/?$/', 'BillCreate'),
    'bills_summary' => url('/^h\/(?<id>\d+)\/bills\/?$/', 'BillsSummary'),
    'bills_index' => url('/^h\/(?<id>\d+)\/bills\/all?$/', 'BillsIndex'),
    'bills_pending' => url('/^h\/(?<id>\d+)\/bills\/pending\/?$/', 'BillsPending'),
    'bills_paid' => url('/^h\/(?<id>\d+)\/bills\/paid\/?$/', 'BillsPaid'),

    'bill_view' => url('/^h\/(?<id>\d+)\/bills\/(?<billid>\d+)\/?$/', 'BillView'),

    # json api
    'json_house_members_add' => url('/^json\/h\/(?<id>\d+)\/members\/add\/?$/', 'HouseMembersAdd'),
    'json_house_members_remove' => url('/^json\/h\/(?<id>\d+)\/members\/remove\/?$/', 'HouseMembersRemove'),
    'json_house_settings_gen_token' => url('/^h\/(?<id>\d+)\/settings\/gentoken\/?$/', 'HouseSettingsGenToken'),
);

?>
