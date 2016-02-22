<?php

class ErrorPage extends Page {

    protected $code = null;
    protected $title = null;

    protected $ex = null;
    protected $message = null;

    public function __construct($ex = null, $message = null) {
        $this->ex = $ex;
        $this->message = $message;

        $this->update_instance();

        parent::__construct();
    }

    protected function before_action() {
        if ($this->code)
            header($this->code);
    }

    protected function update_instance() {}

}

?>
