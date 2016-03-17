<?php

class BillsSummaryData extends HouseView {

    protected function update_instance() {
        $this->json_response = true;
        $this->template_less = true;
        $this->accepts_json = true;
    }

    protected function before_action() {
        Utils::login_required();
    }

    protected function get() {
        $this->get_house();

        $this->get_per_month_volume();

        unset($this->context['house']); // no need to have this
        unset($this->context['user_bills_count']);
        unset($this->context['notifications_count']);
    }

    private function make_row($data) {
        return array(
            "c" => $data
        );
    }

    protected function get_per_month_volume() {
        $date = (new DateTime())->setTime(0,0,0);
        $date->add(new DateInterval("P1M"));
        $date->setDate($date->format("Y"), $date->format("n"), 1);
        $interval = new DateInterval("P1M");

        $rows = array();

        foreach (range(1, 7) as $month_offset) {

            $old_date = new DateTime($date->format(DateTime::ISO8601));
            $date->sub($interval);

            $vol_sum = BillModel::get_monthly_sum($this->house['id'], $old_date, $date);


            array_push($rows, $this->make_row(array(
                array(
                    "v" => $date->format("F"),
                    "f" => null
                ),
                array(
                    "v" => number_format($vol_sum / 100, 2, '.', ''),
                    "f" => null
                )
            )));
        }

        $rows = array_reverse($rows);

        $this->context['monthly_volume'] = array(
            "cols" => array(
                array("id" => "", "label" => "", "pattern" => "", "type" => "string"),
                array("id" => "", "label" => "", "pattern" => "", "type" => "number"),
            ),
            "rows" => $rows
        );
    }
}

?>
