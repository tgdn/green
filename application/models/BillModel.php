<?php

class BillModel {

    public static function get($id) {
        global $database;

        $sql = 'select * from bills where id = :id';
        $st = $database->prepare($sql);
        $st->bindValue(':id', $id, SQLITE3_INTEGER);
        $st->execute();

        return $st->fetchArray(SQLITE3_ASSOC);
    }

    public static function get_user_bill_for_id($id, $uid) {
        global $database;

        $sql = 'select * from user_bills
        where bill_id = :bill_id and user_id = :uid';
        $st = $database->prepare($sql);
        $st->bindValue(':bill_id', $id, SQLITE3_INTEGER);
        $st->bindValue(':uid', $uid, SQLITE3_INTEGER);

        return $st->execute()->fetchArray(SQLITE3_ASSOC);
    }

    public static function get_user_bills_for_id($id) {
        global $database;

        $sql = 'select * from user_bills where bill_id = :bill_id';
        $st = $database->prepare($sql);
        $st->bindValue(':bill_id', $id, SQLITE3_INTEGER);

        return $st->execute();
    }

    public static function get_userbills_for_bill($id) {
        global $database;

        $sql = 'select user_bills.paid as paid, user_bills.cost as cost,
        user_bills.user_id as user_id, users.full_name as full_name
        from user_bills
        inner join bills
            on bills.id = user_bills.bill_id
        inner join users
            on users.id = user_bills.user_id
        where bills.id = :id';
        $st = $database->prepare($sql);
        $st->bindValue(':id', $id, SQLITE3_INTEGER);
        return $st->execute();
    }

    public static function get_for_house($id, $house_id) {
        global $database;

        $sql = 'select * from bills
        where id = :id and house_id = house_id';

        $st = $database->prepare($sql);
        $st->bindValue(':id', $id, SQLITE3_INTEGER);
        $st->bindValue(':house_id', $house_id, SQLITE3_INTEGER);

        return $st->execute();
    }

    public static function get_bills_for_house($house_id) {
        global $database;

        $sql = 'select * from bills where house_id = :house_id';
        $st = $database->prepare($sql);
        $st->bindValue(':house_id', $house_id, SQLITE3_INTEGER);

        return $st->execute();
    }

    public static function get_bills_for_house_status($house_id, $paid = 0) {
        global $database;

        $sql = 'select * from bills
        where house_id = :house_id
        and paid = :paid';
        $st = $database->prepare($sql);
        $st->bindValue(':house_id', $house_id, SQLITE3_INTEGER);
        $st->bindValue(':paid', $paid ? 1 : 0, SQLITE3_INTEGER);

        return $st->execute();
    }

    public static function count_for_house($house_id) {
        global $database;

        $sql = 'select count(distinct bills.id) as count
        from bills where house_id = :house_id';
        $st = $database->prepare($sql);
        $st->bindValue(':house_id', $house_id, SQLITE3_INTEGER);

        $r = $st->execute()->fetchArray(SQLITE3_ASSOC);

        if (isset($r['count'])){
            return $r['count'];
        }
        return 0;
    }

    public static function count_for_house_status($house_id, $paid = 0) {
        global $database;

        $sql = 'select count(distinct bills.id) as count
        from bills
        where house_id = :house_id
        and paid = :paid';
        $st = $database->prepare($sql);
        $st->bindValue(':house_id', $house_id, SQLITE3_INTEGER);
        $st->bindValue(':paid', $paid ? 1 : 0, SQLITE3_INTEGER);

        $r = $st->execute()->fetchArray(SQLITE3_ASSOC);

        if (isset($r['count'])){
            return $r['count'];
        }
        return 0;
    }

    public static function total_sum_for_house($house_id) {
        global $database;

        $sql = 'select sum(bills.cost) as cost
        from bills where house_id = :house_id';
        $st = $database->prepare($sql);
        $st->bindValue(':house_id', $house_id, SQLITE3_INTEGER);

        $r = $st->execute()->fetchArray(SQLITE3_ASSOC);

        if (isset($r['cost'])){
            return $r['cost'];
        }
        return 0;
    }

    public static function get_for_month_for_house($house_id, $date) {
        // TODO
        return 0;
    }

    public static function get_monthly_sum($house_id, $from, $to) {// $month_number, $year) {
        global $database;

        $sql = 'select sum(cost) as sum
        from bills
        where created_at between :to and :from
        and house_id = :house_id';

        $st = $database->prepare($sql);
        $st->bindValue(':from', $from->format("Y-m-d H:i:s"), SQLITE3_TEXT);
        $st->bindValue(':to', $to->format("Y-m-d H:i:s"), SQLITE3_TEXT);
        $st->bindValue(':house_id', $house_id, SQLITE3_INTEGER);

        $r = $st->execute()->fetchArray(SQLITE3_ASSOC);

        if (isset($r['sum'])){
            return $r['sum'];
        }
        return 0;

    }

    public static function get_bills_for_user_house($uid, $house_id) {
        global $database;

        $sql = 'select
        user_bills.id as id, user_bills.cost cost, user_bills.paid as paid,
        user_bills.user_id as user_id, user_bills.bill_id as bill_id,
        user_bills.created_at as created_at, user_bills.modified_at as modified_at,
        bills.name as name, bills.cost as bill_cost, bills.paid as bill_paid,
        bills.created_by as created_by,
        users.id, users.full_name
        from user_bills
        inner join bills
            on user_bills.bill_id = bills.id
        inner join users
            on user_bills.user_id = users.id
        where user_bills.user_id = :uid
        and bills.house_id = :house_id';

        $st = $database->prepare($sql);
        $st->bindValue(':uid', $uid, SQLITE3_INTEGER);
        $st->bindValue(':house_id', $house_id, SQLITE3_INTEGER);

        return $st->execute();
    }

    public static function count_bills_for_user_house_status($uid, $house_id, $paid = false) {
        global $database;

        $sql = 'select count(distinct user_bills.id) as count
        from user_bills
        inner join bills
            on user_bills.bill_id = bills.id
        where user_bills.user_id = :uid
        and bills.house_id = :house_id
        and user_bills.paid = :paid';

        $st = $database->prepare($sql);
        $st->bindValue(':uid', $uid, SQLITE3_INTEGER);
        $st->bindValue(':house_id', $house_id, SQLITE3_INTEGER);
        $st->bindValue(':paid', $paid ? 1 : 0, SQLITE3_INTEGER);

        $r = $st->execute()->fetchArray(SQLITE3_ASSOC);

        if (isset($r['count'])){
            return $r['count'];
        }
        return 0;
    }

    public static function can_pay($bill_id, $uid) {
        global $database;

        $sql = 'select user_bills.id
        from user_bills
        inner join bills
            on bills.id = user_bills.bill_id
        where
        user_bills.paid = 0 and user_id = :uid
        and bills.id = :bill_id';

        $st = $database->prepare($sql);
        $st->bindValue(':uid', $uid, SQLITE3_INTEGER);
        $st->bindValue(':bill_id', $bill_id, SQLITE3_INTEGER);
        $r = $st->execute()->fetchArray(SQLITE3_ASSOC);

        return ($r && gettype($r) == 'array') ? true : false;
    }

    public static function update($id, $name, $cost) {
        global $database;

        $sql = 'update bills
        set name = :name, cost = :cost
        where id = :id';
        $st = $database->prepare($sql);
        $st->bindValue(':name', $name, SQLITE3_TEXT);
        $st->bindValue(':cost', $cost, SQLITE3_INTEGER);
        $st->bindValue(':id', $id, SQLITE3_INTEGER);

        return $st->execute();
    }

    public static function pay_user_bill($id) {
        global $database;

        $sql = 'update user_bills
        set paid = 1
        where id = :id';
        $st = $database->prepare($sql);
        $st->bindValue(':id', $id, SQLITE3_INTEGER);

        return $st->execute();
    }

    public static function delete($id) {
        global $database;

        $sql = 'delete from bills where id = :id';
        $st = $database->prepare($sql);
        $st->bindValue(':id', $id, SQLITE3_INTEGER);

        return $st->execute();
    }

    public static function create($ownerid, $name, $cost, $house_id, $paid = 0) {
        global $database;

        $sql = 'insert into bills (name, cost, paid, house_id, created_by)
        values (:name, :cost, :paid, :house_id, :created_by)';

        $st = $database->prepare($sql);
        $st->bindValue(':name', $name, SQLITE3_TEXT);
        $st->bindValue(':cost', $cost, SQLITE3_INTEGER);
        $st->bindValue(':paid', $paid ? 1 : 0, SQLITE3_INTEGER);
        $st->bindValue(':house_id', $house_id, SQLITE3_INTEGER);
        $st->bindValue(':created_by', $ownerid, SQLITE3_INTEGER);
        $st->execute();

        return $database->get_db()->lastInsertRowID();
    }

    public static function create_user_bill($cost, $user_id, $bill_id, $paid = 0) {
        global $database;

        $sql = 'insert into user_bills (cost, paid, user_id, bill_id)
        values (:cost, :paid, :user_id, :bill_id)';

        $st = $database->prepare($sql);
        $st->bindValue(':cost', $cost, SQLITE3_INTEGER);
        $st->bindValue(':paid', $paid ? 1 : 0, SQLITE3_INTEGER);
        $st->bindValue(':user_id', $user_id, SQLITE3_INTEGER);
        $st->bindValue(':bill_id', $bill_id, SQLITE3_INTEGER);
        $st->execute();

        return $database->get_db()->lastInsertRowID();
    }

}

?>
