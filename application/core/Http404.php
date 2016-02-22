<?php

class Http404 extends ErrorPage {

    public function __construct($ex = null, $message = "Page not found") {
        parent::__construct($ex, $message);
    }

    protected function update_instance() {
        $this->code = "HTTP/1.0 404 Not Found";
        $this->title = "Page not found";
    }

}

?>
