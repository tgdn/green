<?php

class BillsSummary extends HouseView {

    protected function before_action() {
        Utils::login_required();

        $this->title = 'Bills summary';
        $this->context['nav'] = 'bills';
        $this->context['subnav'] = 'summary';
    }

    protected function get() {
        $this->get_house();

        $summary = array(
            'total_p_month' => BillModel::get_for_month_for_house($this->house['id'], null),
            'total_unpaid' => BillModel::count_for_house_status($this->house['id'], false),
            'total_count' => BillModel::count_for_house($this->house['id']),
            'total_volume' => BillModel::total_sum_for_house($this->house['id'])
        );
        $this->context['summary'] = $summary;
    }
}

?>
