<?php

/* session must have started */

class Page {

    /* for now this should not change */
    private $template_name = null;

    /* set this to true if needs no template */
    protected $template_less = false;

    /* update this if json */
    protected $accepts_json = false;
    protected $json_response = false;

    protected $title = null;
    protected $context = array();

    public function __construct($params = array()) {
        // authenticate user
        $this->authenticate_user();

        /* extra params are passed to context */
        $this->context = array_merge($this->context, $params);

        /* update variables before template, get or post */
        $this->update_instance();

        /* check if expecting json response */
        if (isset($_GET['json']) && $this->accepts_json) {
            $this->template_less = true;
            $this->json_response = true;
        }

        // get view
        if (!$this->template_less) {
            $this->get_template();
        }

        // call an action before controller
        $this->before_action();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $this->handle_post();
        } else if ($_SERVER['REQUEST_METHOD'] === 'GET') {
            $this->handle_get();
        } else { /* do nothing for now */
            $this->handle_get();
        }

        // call action after controller
        $this->after_action();

        $this->construct_title();
        $this->render();
    }

    public function __get($name) {
        // we can now access properties
        return $this->$name;
    }

    protected function construct_title() {
        global $config;

        if ($this->title) {
            $this->title = $config['DEFAULT_TITLE'] . ' - ' . $this->title;
        } else {
            $this->title = $config['DEFAULT_TITLE'];
        }
    }

    /* Get template name */
    protected function get_template() {
        // define template if it hasnt yet been defined
        if (!$this->template_name)
            $this->template_name = APP . 'views' . DIRECTORY_SEPARATOR . strtolower(get_class($this)) . '.php';

        /* exception will be caught by main process */
        if (!file_exists($this->template_name)) {
            throw new Exception("Template does not exist<br><b>" . $this->template_name . '</b>', 1);
        }
    }

    protected function get_include($filename) {
        $r_path = VIEWS . 'includes' . DIRECTORY_SEPARATOR . $filename . '.php';
        /* avoid ugly errors */
        if (file_exists($r_path)) {
            require $r_path;
        } else {
            if (DEBUG) {
                echo '<b>Warning: </b> <samp>' . $filename . '</samp> could not be included';
            } else {
                /* fail silently */
                echo '<br>';
            }
        }
    }

    /* include template */
    protected function load_template() {
        global $user;

        $this->get_include('doctype');
        $this->get_include('meta');
        $this->get_include('static');

        require $this->template_name;
    }

    /* render page */
    protected function render() {
        global $user;

        if ($this->json_response) {
            header('Content-Type: application/json');
            $this->context['you'] = $user;
            echo json_encode($this->context, DEBUG ? JSON_PRETTY_PRINT : 0);
        } else {
            $this->load_template();
        }
    }

    public function authenticate_user() {
        global $user;

        if (is_null($user)) {
            $user = new User();
        }

        if (array_key_exists('uid', $_SESSION)) {
            $user = User::fromID($_SESSION['uid']);
        }
    }

    protected function handle_get() {
        // this should not be overriden
        error_log('GET - ' . $_SERVER['REQUEST_URI']);
        $this->get();
    }

    protected function handle_post() {
        // this should not be overriden
        error_log('POST - ' . $_SERVER['REQUEST_URI']);

        /* check CSRF protection */
        /*try {
            NoCSRF::check('csrf_token', $_POST, true);
            // only carry on with post if CSRF check succeeded
            $this->post();
        } catch (Exception $e) {
            header('HTTP/1.0 403 Forbidden');
            die($e->getMessage());
            $this->get();
        }*/
        $this->post();
    }

    /* these should be overriden */
    protected function update_instance() {}
    protected function get() {}
    protected function post() {
        /* by default call the get method */
        $this->get();
    }
    protected function before_action() {}
    protected function after_action() {}

}

?>
