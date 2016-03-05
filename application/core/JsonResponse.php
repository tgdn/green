<?php

class JsonResponse extends Page {

    public function __construct($params = array()) {
        $this->template_less = true;
    }

    protected load_template() {
        // TODO: response should be json
        header('Response: text/json');
        echo json_encode(context);
    }

}

?>
