<?php

mysql_connect("localhost", "root", "");
mysql_select_db("invo");

function on_session_start($save_path, $session_name) {
//    error_log($session_name . " " . session_id());
}

function on_session_end() {
    // Nothing needs to be done in this function
    // since we used persistent connection.
}

function on_session_read($key) {
//    error_log($key);
    mysql_query("DELETE FROM sessions WHERE session_expiration <= now()");

    $stmt = "SELECT session_data FROM sessions ";
    $stmt .= "WHERE session_id ='$key' ";
    $stmt .= "AND session_expiration > date_add(now(), interval 0 hour)";
    $sth  = mysql_query($stmt) or die(mysql_error());

    //echo $stmt;

    if ($sth) {
        $row = mysql_fetch_array($sth);
        return($row['session_data']);
    } else {
        return $sth;
    }
}

function on_session_write($key, $val) {
//    error_log(@"$key = $value");

    $val         = addslashes($val);
    $insert_stmt = "REPLACE INTO sessions VALUES ('$key', '$val', date_add(now(), interval 1 hour))";
    //echo $insert_stmt;

    return mysql_query($insert_stmt) or die(mysql_error());
}

function on_session_destroy($key) {
    mysql_query("DELETE FROM sessions WHERE session_id = '$key'");
}

function on_session_gc($max_lifetime) {
    mysql_query("DELETE FROM sessions WHERE session_expiration < now()");
}

// Set the save handlers
session_set_save_handler("on_session_start", "on_session_end", "on_session_read", "on_session_write", "on_session_destroy", "on_session_gc");

session_start();
