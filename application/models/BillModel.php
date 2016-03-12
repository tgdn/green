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

    public static function get_user_bills_for_id($id) {
        global $database;

        $sql = 'select * from user_bills where bill_id = :bill_id';
        $st = $database->prepare($sql);
        $st->bindValue(':bill_id', $id, SQLITE3_INTEGER);

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

    public static function update($id, $name, $cost) {
        global $database;

        $sql = 'update bills
        set name = :name, cost = $cost
        where id = :id';
        $st = $database->prepare($sql);
        $st->bindValue(':name', $name, SQLITE3_TEXT);
        $st->bindValue(':cost', $cost, SQLITE3_INTEGER);
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
