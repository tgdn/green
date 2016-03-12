<?php

class HouseSettingsGenToken extends HouseView {

    protected function update_instance() {
        $this->accepts_json = true;
        $this->template_less = true;
        $this->json_response = true;
    }

    protected function before_action() {
        Utils::login_required();
    }

    protected function get() {
        $this->get_house();
        /* redirect */
        header('Location: ' . Utils::url('h/' . $this->house['id'] . '/settings'));
    }

    protected function post() {
        $this->get_house();

        if (isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) === 'xmlhttprequest') {
            /* at this point everything is correct */
            $newtoken = HouseModel::update_token($this->house['id']);

            $this->context['newtoken'] = $newtoken;
        } else {
            header('Location: ' . Utils::url('h/' . $this->house['id'] . '/settings'));
        }
    }

}

?>
