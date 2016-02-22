<?php

class Http403 extends ErrorPage {

    public function __construct($ex = null, $message = "Forbidden") {
        parent::__construct($ex, $message);
    }

    protected function update_instance() {
        $this->code = "HTTP/1.0 403 Forbidden";
        $this->title = "Forbidden";
    }

}

?>
