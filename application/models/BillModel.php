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

    public static function get_bills_for_house($house_id) {
        global $database;

        $sql = 'select * from bills where house_id = :house_id';
        $st = $database->prepare($sql);
        $st->bindValue(':house_id', $house_id, SQLITE3_INTEGER);

        return $st->execute();
    }

    public static function get_for_month_for_house($house_id, $date) {
        
    }

    public static function create($name, $cost, $house_id) {
        global $database;

        $sql = 'insert into bills
        (name, cost, house_id)
        values (:name, :cost, :house_id)';
        $st = $database->prepare($sql);
        $st->bindValue(':name', $name, SQLITE3_TEXT);
        $st->bindValue(':cost', $cost, SQLITE3_INTEGER);
        $st->bindValue(':house_id', $house_id, SQLITE3_INTEGER);

        return $st->execute();
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

}

?>
