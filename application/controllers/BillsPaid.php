<?php

class BillsPaid extends BillsIndex {

    protected function before_action() {
        Utils::login_required();

        $this->title = 'View paid bills';
        $this->context['nav'] = 'bills';
        $this->context['subnav'] = 'paid';
    }

    protected function get_bills() {
        global $user, $page_request;

        /* get bills */
        $this->context['bills'] = BillModel::get_bills_for_house_status($this->house['id'], true);
    }

}

?>
