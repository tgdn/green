<?php

define('ROOT', dirname(__DIR__) . DIRECTORY_SEPARATOR);
define('APP', ROOT . 'application' . DIRECTORY_SEPARATOR);
define('VIEWS', APP . 'views' . DIRECTORY_SEPARATOR);

// get config for app
$config = require_once APP . 'config.php';

// create session
session_name($config['SESSION_NAME']);
if (session_status() == PHP_SESSION_NONE)
    session_start();

/* autoload classes */
spl_autoload_register(function ($classname) {
    global $config;

    foreach ($config['CLASS_LOADER_DIRS'] as $dir) {
        /* loop through each dir until the class is found */
        $class_file = APP . $dir . DIRECTORY_SEPARATOR . $classname . '.php';
        if (file_exists($class_file)) {
            require_once($class_file);
            return;
        }
    }
    throw new Exception('Could not load &nbsp;<samp>' . $classname . '</samp>&nbsp; class.');
});

$database = new Database();
$urls = require APP. 'core' . DIRECTORY_SEPARATOR . 'urls.php';

require_once APP . 'core' . DIRECTORY_SEPARATOR . 'nocsrf.php';
require_once APP . 'core' . DIRECTORY_SEPARATOR . 'utils.php';

$user = null;
$page = null;

$page_request = array(
    'controller' => null,
    'action' => null,
    'params' => array()
);

function match_url($path) {
    global $urls;

    foreach ($urls as $url) {

        preg_match($url['pattern'], $path, $matches);

        if (count($matches) >= 1) {
            /* unset matching url */
            unset($matches[0]);

            /* return the controller as well
            as remaining possible parameters */
            return array(
                'controller' => $url['controller'],
                'params' => $matches
            );
        }
    }
    return null;
}

function load_page($page_controller_class) {
    global $page;

    // try to load controller
    try {
        $page = new $page_controller_class();
    } catch (Http403Exception $e) {
        // manually thrown 403 exception
        $err = $e->getMessage() ? $e->getMessage() : "You don't have access to this page.";
        $page = new Http403($err);
    } catch (Exception $e) {
        // throw 500 if exception is thrown.
        // makes it easier for error handling
        $page = new Http500($e->getMessage());
    }
}

/* split url here */
if (isset($_GET['url'])) {

    $url = trim($_GET['url'], '/');
    $url = filter_var($url, FILTER_SANITIZE_URL);
    //$url = explode('/', $url);

    $matched_url = match_url($url);

    if (is_null($matched_url)) {
        // throw 404 if no url matched
        $page = new Http404();
    } else {
        $page_controller_class = $matched_url['controller'];
        $page_params = $matched_url['params'];

        // load page
        load_page($page_controller_class);
    }

} else {
    load_page("Home");
}


?>
