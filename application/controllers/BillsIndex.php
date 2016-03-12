<?php

class BillsIndex extends HouseView {

    protected function before_action() {
        Utils::login_required();

        $this->title = 'View bills';
        $this->context['nav'] = 'bills';
        $this->context['subnav'] = 'all';
    }

    protected function get() {
        $this->get_house();
        $this->get_bills();
    }

    protected function get_bills() {
        global $user, $page_request;

        /* get bills */
        $this->context['bills'] = BillModel::get_bills_for_house($this->house['id']);
    }

}

?>
