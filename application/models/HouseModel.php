<?php

class HouseModel {

    public static function get_house($id) {
        global $database;

        $sql = 'select * from houses where id = :id';

        $st = $database->prepare($sql);
        $st->bindValue(':id', $id, SQLITE3_INTEGER);
        $st = $st->execute();

        return $st->fetchArray(SQLITE3_ASSOC);
    }

    public static function get_house_for_user($uid, $house_id) {
        global $database;

        /* specifically queries a house of a specific user */

        $sql = 'select
        houses.id, houses.name, houses.created_at, houses.modified_at
        from houses
        inner join households
            on houses.id = households.house_id
        where
        households.user_id = :uid
        and households.house_id = :house_id';

        $st = $database->prepare($sql);
        $st->bindValue(':uid', $uid, SQLITE3_INTEGER);
        $st->bindValue(':house_id', $house_id, SQLITE3_INTEGER);

        return $st->execute();
    }

    public static function get_houses_for_user($uid, $limit = 1000) {
        global $database;

        $sql = 'select
        houses.id, houses.name, houses.created_at, houses.modified_at
        from houses
        inner join households
            on houses.id = households.house_id
        where households.user_id = :uid
        limit :limit';

        $st = $database->prepare($sql);
        $st->bindValue(':uid', $uid, SQLITE3_INTEGER);
        $st->bindValue(':limit', $limit, SQLITE3_INTEGER);

        return $st->execute();
    }

    public static function count_houses_for_user($uid) {
        global $database;

        $sql = 'select count(distinct houses.id) as count
        from houses
        inner join households
            on houses.id = households.house_id
        where households.user_id = :uid';

        $st = $database->prepare($sql);
        $st->bindValue(':uid', $uid, SQLITE3_INTEGER);

        $r = $st->execute()->fetchArray(SQLITE3_ASSOC);

        if (isset($r['count'])){
            return $r['count'];
        }
        return 0;
    }

    public static function get_users_for_house($id, $limit = 1000) {
        global $database;

        $sql = 'select
        users.id, users.full_name, users.email,
        users.created_at, users.last_login
        from users
        inner join households
            on users.id = households.user_id
        where households.house_id = :house_id
        limit :limit';

        $st = $database->prepare($sql);
        $st->bindValue(':house_id', $id, SQLITE3_INTEGER);
        $st->bindValue(':limit', $limit, SQLITE3_INTEGER);

        return $st->execute();
    }

    public static function create($name) {
        global $database;

        $sql = 'insert into houses (name) values (:name)';

        $st = $database->prepare($sql);
        $st->bindValue(':name', $name, SQLITE3_TEXT);
        $st->execute();

        // get newly created house id
        $house_id = $database->get_db()->lastInsertRowID();

        // return house id for further manipulation
        return $house_id;
    }

    public static function update($house_id, $name) {
        global $database;

        $sql = 'update houses
        set name = :name
        where id = :house_id';
        $st = $database->prepare($sql);
        $st->bindValue(':name', $name, SQLITE3_TEXT);
        $st->bindValue(':house_id', $house_id, SQLITE3_INTEGER);

        return $st->execute();
    }

    public static function delete($house_id) {
        global $database;

        # delete bills
        $sql = 'delete from bills where house_id = :house_id';
        $st = $database->prepare($sql);
        $st->bindValue(':house_id', $house_id, SQLITE3_INTEGER);
        $st->execute();

        # delete households
        $sql = 'delete from households where house_id = :house_id';
        $st = $database->prepare($sql);
        $st->bindValue(':house_id', $house_id, SQLITE3_INTEGER);
        $st->execute();

        # delete house
        $sql = 'delete from houses where id = :house_id';
        $st = $database->prepare($sql);
        $st->bindValue(':house_id', $house_id, SQLITE3_INTEGER);

        return $st->execute();
    }

    public static function add_user_to_household($uid, $house_id) {
        global $database;

        $sql = 'insert into households
        (user_id, house_id) values (:uid, :house_id)';

        $st = $database->prepare($sql);
        $st->bindValue(':uid', $uid, SQLITE3_INTEGER);
        $st->bindValue(':house_id', $house_id, SQLITE3_INTEGER);
        $st->execute();

        return true;
    }

    public static function remove_user_from_household($uid, $house_id) {
        global $database;

        $sql = 'delete from households
        where user_id = :uid and house_id = :house_id';

        $st = $database->prepare($sql);
        $st->bindValue(':user_id', $uid, SQLITE3_INTEGER);
        $st->bindValue(':house_id', $house_id, SQLITE3_INTEGER);

        return $st->execute();
    }

}

?>
