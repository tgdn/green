<?php

class NotificationModel {

    public static function get($id) {
        global $database;

        $sql = 'select * from notifications where id = :id';
        $st = $database->prepare($sql);
        $st->bindValue(':id', $id, SQLITE3_INTEGER);
        $st->execute();

        return $st->fetchArray(SQLITE3_ASSOC);
    }

    public static function get_for_user($userid, $limit = 1000) {
        global $database;

        $sql = 'select * from notifications
        where user_id = :userid
        order by created_at DESC
        limit :limit';
        $st = $database->prepare($sql);
        $st->bindValue(':userid', $userid, SQLITE3_INTEGER);
        $st->bindValue(':limit', $limit, SQLITE3_INTEGER);

        return $st->execute();
    }

    public static function get_all_for_user_house($userid, $houseid, $limit = 1000) {
        global $database;

        $sql = 'select * from notifications
        where user_id = :userid and house_id = :houseid
        order by created_at DESC
        limit :limit';
        $st = $database->prepare($sql);
        $st->bindValue(':userid', $userid, SQLITE3_INTEGER);
        $st->bindValue(':houseid', $houseid, SQLITE3_INTEGER);
        $st->bindValue(':limit', $limit, SQLITE3_INTEGER);

        return $st->execute();
    }

    public static function get_for_user_house($userid, $houseid, $pending = true, $limit = 1000) {
        global $database;

        $sql = 'select * from notifications
        where user_id = :userid and house_id = :houseid
        and pending = :pending
        order by created_at DESC
        limit :limit';
        $st = $database->prepare($sql);
        $st->bindValue(':userid', $userid, SQLITE3_INTEGER);
        $st->bindValue(':houseid', $houseid, SQLITE3_INTEGER);
        $st->bindValue(':limit', $limit, SQLITE3_INTEGER);
        $st->bindValue(':pending', $pending ? 1 : 0, SQLITE3_INTEGER);

        return $st->execute();
    }

    public static function belongs_to_user($id, $userid) {
        global $database;

        $sql = 'select id from notifications
        where id = :id and user_id = :userid';
        $st = $database->prepare($sql);
        $st->bindValue(':id', $id, SQLITE3_INTEGER);
        $st->bindValue(':userid', $userid, SQLITE3_INTEGER);

        $r = $st->execute()->fetchArray(SQLITE3_ASSOC);
        return ($r && gettype($r) == 'array') ? true : false;
    }

    public static function count_notifications_for_user_house($userid, $houseid, $pending = true) {
        global $database;

        $sql = 'select count(distinct notifications.id) as count
        from notifications
        where user_id = :userid and house_id = :houseid
        and pending = :pending';

        $st = $database->prepare($sql);
        $st->bindValue(':userid', $userid, SQLITE3_INTEGER);
        $st->bindValue(':houseid', $houseid, SQLITE3_INTEGER);
        $st->bindValue(':pending', $pending ? 1 : 0, SQLITE3_INTEGER);

        $r = $st->execute()->fetchArray(SQLITE3_ASSOC);

        if (isset($r['count'])){
            return $r['count'];
        }
        return 0;
    }

    public static function mark_read($id) {
        global $database;

        $sql = 'update notifications
        set pending = 0
        where id = :id';
        $st = $database->prepare($sql);
        $st->bindValue(':id', $id, SQLITE3_INTEGER);

        return $st->execute();
    }

    public static function create($userid, $houseid, $name, $message, $source_table, $source_id) {
        global $database;

        $sql = 'insert into notifications
        (user_id, house_id, name, message, source_table, source_id)
        values (:userid, :houseid, :name, :message, :source_table, :source_id)';

        $st = $database->prepare($sql);
        $st->bindValue(':userid', $userid, SQLITE3_INTEGER);
        $st->bindValue(':houseid', $houseid, SQLITE3_INTEGER);
        $st->bindValue(':name', $name, SQLITE3_TEXT);
        $st->bindValue(':message', $message, SQLITE3_TEXT);
        $st->bindValue(':source_table', $source_table, SQLITE3_TEXT);
        $st->bindValue(':source_id', $source_id, SQLITE3_INTEGER);
        $st->execute();

        return $database->get_db()->lastInsertRowID();
    }

}

?>
