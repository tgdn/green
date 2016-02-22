<?php

class Http500 extends ErrorPage {

    public function __construct($ex = null, $message = "Server Error") {
        parent::__construct($ex, $message);
    }

    protected function update_instance() {
        $this->code = "HTTP/1.0 500 Server Error";
        $this->title = "Server Error";
    }

}

?>
