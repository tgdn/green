<?php

class FormPage extends Page {
    /*
        This class adds CSRF protection to forms by
        generating a CSRF token on get and validating it on post.
        To use it, subclass this class in your controller
        and <?php echo $this->context['csrf_token_input'] ?>
        in the form
    */

    private function get_csrf_token($force_refresh = false) {
        $token = Csrf::get_token($force_refresh);

        $this->context['csrf_token'] = $token;
        $this->context['csrf_token_input'] = '<input type="hidden" name="csrf_token" value="' . $token . '">';
        /* set a cookie that expires in two hours */
        setcookie('csrf_token', $token, time()+60*60*2);
    }

    protected function handle_get() {
        $this->get_csrf_token(true); /* get token and put it in context */
        parent::handle_get();
    }

    protected function handle_post() {
        $this->get_csrf_token();

        $posted_csrf_token = isset($_POST['csrf_token']) ? $_POST['csrf_token'] : null;

        if (!Csrf::validate($posted_csrf_token)) {
            if (DEBUG)
                throw new Http403Exception("CSRF Token invalid");
            else
                header("Refresh:0"); /* refresh page, no need to display error */
        }

        $this->get_csrf_token(true);

        parent::handle_post();
    }

}

?>
