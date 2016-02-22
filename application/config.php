<?php

define('DEBUG', 1);

if (DEBUG) {
    error_reporting(E_ALL);
    ini_set('display_errors', 1);
}

define('PROJECT_DIR', realpath( '' . dirname(__FILE__) . '/../../' ));
define('BASE_DIR', substr(PROJECT_DIR, strlen($_SERVER["DOCUMENT_ROOT"])));

define('URL_PUBLIC_FOLDER', 'public');
define('URL_PROTOCOL', 'http://');
define('URL_DOMAIN', $_SERVER['HTTP_HOST']);
define('URL_SUB_FOLDER', str_replace(URL_PUBLIC_FOLDER, '', dirname($_SERVER['SCRIPT_NAME'])));
define('URL', URL_PROTOCOL . URL_DOMAIN . URL_SUB_FOLDER);

return array(

    'SESSION_NAME' => 'green_sess',
    'DEFAULT_TITLE' => 'Green',

    'DB_FILE' => ROOT . 'db' . DIRECTORY_SEPARATOR . 'green.db',
    'DB_CHARSET' => 'utf8',

    'LOGIN_REDIRECT_URL' => URL . 'dashboard',
    'LOGIN_URL' => URL,
    'REGISTER_URL' => URL . 'register',

    'CLASS_LOADER_DIRS' => array(
        'core',
        'controllers',
        'models'

        /* add class locations here */
    )
)

?>
