<?php

class BillView extends HouseView {

    protected $bill;

    protected function before_action() {
        Utils::login_required();

        $this->title = 'View bill';
    }

    protected function get() {
        $this->get_house();
        $this->get_bill();
    }

    protected function get_bill() {
        global $user, $page_request;

        $bill_id = $page_request['params']['billid'];
        $bill = BillModel::get_for_house($bill_id, $this->house['id'])->fetchArray(SQLITE3_ASSOC);

        if ($bill && gettype($bill) == 'array') {
            /* it exists */
            $this->bill = $bill;
        } else {
            /* throw 404 if nothing was found
            this could be because the bill is not linked to this house */
            throw new Http404Exception();
        }
    }

}

?>
