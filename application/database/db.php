<?php

session_start();
require 'connection.php';

//PURPOSE: FOR DEBUGGING ;)
function dump($value) // to be deleted soon

{
    echo "<pre>", print_r($value, true), "</pre>";
    die();
}
// SELECT FUNCTIONS

function execQuery($sql, $data)
{
    global $conn;
    $stmt = $conn->prepare($sql);
    $values = array_values($data);
    $types = str_repeat('s', count($values));
    $stmt->bind_param($types, ...$values);
    $stmt->execute();
    return $stmt;
}
function selectAll($table, $conditions = [])
{
    global $conn;
    $sql = "SELECT * FROM $table";
    if (empty($conditions)) {
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        $records = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
        return $records;
    } else {
        //this will return records that match the passed conditions
        $i = 0;
        foreach ($conditions as $key => $value) {
            if ($i === 0) {
                $sql = $sql . " WHERE $key=?";
            } else {
                $sql = $sql . " AND $key=?";
            }
            $i++;
        }
        $stmt = execQuery($sql, $conditions);
        $records = $stmt->get_result()->fetch_all(MYSQLI_ASSOC); //return all values
        return $records;
    }
}

function selectOne($table, $conditions)
{
    global $conn;
    $sql = "SELECT * FROM $table";
    //$sql ="SELECT * FROM users WHERE id=0 AND username=Mark Lester AND ADMIN=1 AND"
    $i = 0;
    foreach ($conditions as $key => $value) {
        if ($i === 0) {
            $sql = $sql . " WHERE $key=?";
        } else {
            $sql = $sql . " AND $key=?";
        }
        $i++;
    }
    $sql = $sql . " LIMIT 1"; // this helps when you have a thousands or millions of records
    $stmt = execQuery($sql, $conditions);
    $records = $stmt->get_result()->fetch_assoc(); //associative array that return each value
    return $records;
}

//CREATE FUNCTION
function create($table, $data)
{
    global $conn;
    // $sql = "INSERT INTO users SET username=?, admin=?, email=?, password=?";
    $sql = "INSERT INTO $table SET ";
    $i = 0;
    foreach ($data as $key => $value) {
        if ($i === 0) {
            $sql = $sql . " $key=?";
        } else {
            $sql = $sql . ", $key=?";
        }
        $i++;
    }
    $stmt = execQuery($sql, $data);
    $id = $stmt->insert_id;
    return $id;
}

//UPDATE FUNCTION
function update($table, $id, $data)
{
    global $conn;
    //$sql ="UPDATE users SET username=?, admin=?, email=?, password=? WHERE id=?"
    $sql = "UPDATE $table SET";

    $i = 0;
    foreach ($data as $key => $value) {
        if ($i === 0) {
            $sql = $sql . " $key=?";
        } else {
            $sql = $sql . ", $key=?";
        }
        $i++;
    }
    $sql = $sql . " WHERE id=?";
    $data['id'] = $id;
    $stmt = execQuery($sql, $data);
    return $stmt->affected_rows;
}

//DELETE FUNCTION
function delete($table, $id)
{
    global $conn;
    $sql = "DELETE FROM $table WHERE id=?";
    $stmt = execQuery($sql, ['id' => $id]);
    return $stmt->affected_rows;
}

function resetAll($table)
{
    global $conn;
    $sql = "TRUNCATE $table";
    $stmt = $conn->prepare($sql);
    $res = $stmt->execute();

    if ($res) {
        $status = 1;
    } else {
        $status = 0;
    }

    return $status;
}

// filter events
function filterEvents($from_date, $to_date)
{
    global $conn;
    // query for joining 2 tables which is users and event

    $sql = "SELECT e.*,
            u.username,
            c.name
            FROM events AS e
            JOIN users AS u
            ON e.user_id=u.id
            JOIN categories AS c ON e.category_id=c.id
            WHERE e.created_at BETWEEN '$from_date' AND '$to_date'";

    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $records = $stmt->get_result()->fetch_all(MYSQLI_ASSOC); //return all values
    return $records;
}

function filterEventsPagination($from_date, $to_date, $items, $offset)
{
    global $conn;
    // query for joining 2 tables which is users and event

    $sql = "SELECT e.*,
            u.username,
            c.name
            FROM events AS e
            JOIN users AS u
            ON e.user_id=u.id
            JOIN categories AS c ON e.category_id=c.id
            WHERE e.created_at BETWEEN '$from_date' AND '$to_date' ORDER BY e.created_at DESC LIMIT $items OFFSET $offset";

    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $records = $stmt->get_result()->fetch_all(MYSQLI_ASSOC); //return all values
    return $records;
}

function filterEventsByCourse($id, $from_date, $to_date)
{
    global $conn;
    // query for joining 2 tables which is users and event

    $sql = "SELECT e.*,
            u.username,
            c.name
            FROM events AS e
            JOIN users AS u
            ON e.user_id=u.id
            JOIN categories AS c ON e.category_id=c.id
            WHERE e.category_id='$id' AND e.created_at BETWEEN '$from_date' AND '$to_date'";

    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $records = $stmt->get_result()->fetch_all(MYSQLI_ASSOC); //return all values
    return $records;
}

function filterEventsByCoursePagination($id, $from_date, $to_date, $items, $offset)
{
    global $conn;
    // query for joining 2 tables which is users and event

    $sql = "SELECT e.*,
            u.username,
            c.name
            FROM events AS e
            JOIN users AS u
            ON e.user_id=u.id
            JOIN categories AS c ON e.category_id=c.id
            WHERE e.category_id='$id' AND e.created_at BETWEEN '$from_date' AND '$to_date' ORDER BY e.created_at DESC LIMIT $items OFFSET $offset";

    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $records = $stmt->get_result()->fetch_all(MYSQLI_ASSOC); //return all values
    return $records;
}

//FETCH RELEASED EVNTS

//next evnt

function nextEventId($date)
{
    $date =
    $sql = "SELECT MIN(id) AS eventid FROM events WHERE released=? AND CAST(eventday AS DATE) > CAST('$date' AS DATE) AND CAST(eventday AS DATE) != CAST('$date' AS DATE) LIMIT 1";
    $stmt = execQuery($sql, ['released' => 1]);
    $records = $stmt->get_result()->fetch_assoc(); //return all values
    return $records;
}

function getReleasedUpcomingEvents($date)
{
    global $conn;
    // query for joining 2 tables which is users and events
    $sql = "SELECT e.*, u.username FROM events AS e JOIN users AS u ON e.user_id=u.id WHERE e.released=? AND CAST(e.eventday AS DATE) > CAST('$date' AS DATE) AND CAST(e.eventday AS DATE) != CAST('$date' AS DATE)  ORDER BY e.eventday DESC";
    $stmt = execQuery($sql, ['released' => 1]);
    $records = $stmt->get_result()->fetch_all(MYSQLI_ASSOC); //return all values
    return $records;
}
function getReleasedTodayEvents($date)
{
    global $conn;
    // query for joining 2 tables which is users and events
    $sql = "SELECT e.*, u.username FROM events AS e JOIN users AS u ON e.user_id=u.id WHERE e.released=? AND CAST(e.eventday AS DATE) = CAST('$date' AS DATE) ORDER BY e.eventday DESC";
    $stmt = execQuery($sql, ['released' => 1]);
    $records = $stmt->get_result()->fetch_all(MYSQLI_ASSOC); //return all values
    return $records;
}

function getReleasedEvents()
{
    global $conn;
    // query for joining 2 tables which is users and events
    $sql = "SELECT e.*, u.username FROM events AS e JOIN users AS u ON e.user_id=u.id WHERE e.released=? ORDER BY e.eventday DESC";
    $stmt = execQuery($sql, ['released' => 1]);
    $records = $stmt->get_result()->fetch_all(MYSQLI_ASSOC); //return all values
    return $records;
}

function getReleasedEventsPagination($items, $offset)
{
    global $conn;

    // query for joining 2 tables which is users and events
    $sql = "SELECT e.*, u.username FROM events AS e JOIN users AS u ON e.user_id=u.id WHERE e.released=? ORDER BY e.eventday DESC LIMIT $items OFFSET $offset";
    $stmt = execQuery($sql, ['released' => 1]);
    $records = $stmt->get_result()->fetch_all(MYSQLI_ASSOC); //return all values
    return $records;
}

function getEvents()
{
    global $conn;
    // query for joining 3 tables which is users and events
    $sql = "SELECT e.*, u.username, c.name FROM events AS e JOIN users AS u ON e.user_id=u.id JOIN categories AS c ON e.category_id=c.id ORDER BY e.eventday DESC";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $records = $stmt->get_result()->fetch_all(MYSQLI_ASSOC); //return all values
    return $records;
}

function getEventsPagination($items, $offset)
{
    global $conn;
    // query for joining 3 tables which is users and events
    $sql = "SELECT e.*, u.username, c.name FROM events AS e JOIN users AS u ON e.user_id=u.id JOIN categories AS c ON e.category_id=c.id ORDER BY e.created_at DESC LIMIT $items OFFSET $offset";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $records = $stmt->get_result()->fetch_all(MYSQLI_ASSOC); //return all values
    return $records;
}

// get events by parameter
function getEventsByAdmin($id)
{
    global $conn;
    // query for joining 2 tables which is users and events
    $sql = "SELECT e.*, u.username, c.name FROM events AS e JOIN users AS u ON e.user_id=u.id JOIN categories AS c ON e.category_id=c.id WHERE e.category_id='$id' ORDER BY e.eventday DESC";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $records = $stmt->get_result()->fetch_all(MYSQLI_ASSOC); //return all values
    return $records;
}

function getEventsByAdminPagination($id, $items, $offset)
{
    global $conn;
    // query for joining 2 tables which is users and events
    $sql = "SELECT e.*, u.username, c.name FROM events AS e JOIN users AS u ON e.user_id=u.id JOIN categories AS c ON e.category_id=c.id WHERE e.category_id='$id' ORDER BY e.created_at DESC LIMIT $items OFFSET $offset";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $records = $stmt->get_result()->fetch_all(MYSQLI_ASSOC); //return all values
    return $records;
}

// for download
function getEventsForDl()
{
    global $conn;
    // query for joining 3 tables which is users and events
    $sql = "SELECT e.title,e.created_at, u.username, c.name FROM events AS e JOIN users AS u ON e.user_id=u.id JOIN categories AS c ON e.category_id=c.id ORDER BY e.eventday DESC";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $records = $stmt->get_result()->fetch_all(MYSQLI_ASSOC); //return all values
    return $records;
}

function getEventsByAdminForDl($id)
{
    global $conn;
    // query for joining 2 tables which is users and events
    $sql = "SELECT e.title,e.created_at, u.username, c.name FROM events AS e JOIN users AS u ON e.user_id=u.id JOIN categories AS c ON e.category_id=c.id WHERE e.category_id='$id' ORDER BY e.eventday DESC";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $records = $stmt->get_result()->fetch_all(MYSQLI_ASSOC); //return all values
    return $records;
}

function getEventsByCatId($c_id)
{
    global $conn;
    // query for joining 2 tables which is users and events
    $sql = "SELECT e.*, u.username FROM events AS e JOIN users AS u ON e.user_id=u.id WHERE e.released=? AND e.category_id=? ORDER BY e.eventday DESC";
    $stmt = execQuery($sql, ['released' => 1, 'category_id' => $c_id]);
    $records = $stmt->get_result()->fetch_all(MYSQLI_ASSOC); //return all values
    return $records;
}

function getEventsByCatIdPagination($c_id, $items, $offset)
{
    global $conn;
    // query for joining 2 tables which is users and events
    $sql = "SELECT e.*, u.username FROM events AS e JOIN users AS u ON e.user_id=u.id WHERE e.released=? AND e.category_id=? ORDER BY e.eventday DESC LIMIT $items OFFSET $offset";
    $stmt = execQuery($sql, ['released' => 1, 'category_id' => $c_id]);
    $records = $stmt->get_result()->fetch_all(MYSQLI_ASSOC); //return all values
    return $records;
}

function searchEvent($keyword)
{
    global $conn;
    // query for joining 2 tables which is users and events
    $searchMatch = '%' . $keyword . '%';

    $sql = "SELECT e.*,
            u.username
            FROM events AS e
            JOIN users AS u
            ON e.user_id=u.id
            WHERE e.title LIKE ? AND e.released='1' OR e.description LIKE ?
            AND e.released='1' ORDER BY e.eventday DESC";

    $stmt = execQuery($sql, ['title' => $searchMatch, 'description' => $searchMatch]);
    $records = $stmt->get_result()->fetch_all(MYSQLI_ASSOC); //return all values
    return $records;
}

function searchEventPagination($keyword, $items, $offset)
{
    global $conn;
    // query for joining 2 tables which is users and events
    $searchMatch = '%' . $keyword . '%';

    $sql = "SELECT e.*,
            u.username
            FROM events AS e
            JOIN users AS u
            ON e.user_id=u.id
            WHERE e.title LIKE ? AND e.released='1' OR e.description LIKE ? AND e.released='1' ORDER BY e.eventday DESC LIMIT $items OFFSET $offset";

    $stmt = execQuery($sql, ['title' => $searchMatch, 'description' => $searchMatch]);
    $records = $stmt->get_result()->fetch_all(MYSQLI_ASSOC); //return all values
    return $records;
}

function searchEventAdmin($keyword)
{
    global $conn;
    // query for joining 2 tables which is users and events
    $searchMatch = '%' . $keyword . '%';

    $sql = "SELECT e.*,
            u.username,
            c.name
            FROM events AS e
            JOIN users AS u
            ON e.user_id=u.id
            JOIN categories AS c ON e.category_id=c.id
            WHERE e.title LIKE ? OR u.username LIKE ? ORDER BY e.eventday DESC";

    $stmt = execQuery($sql, ['title' => $searchMatch, 'username' => $searchMatch]);
    $records = $stmt->get_result()->fetch_all(MYSQLI_ASSOC); //return all values
    return $records;
}

function searchEventAdminPagination($keyword, $items, $offset)
{
    global $conn;
    // query for joining 2 tables which is users and events
    $searchMatch = '%' . $keyword . '%';

    $sql = "SELECT e.*,
            u.username,
            c.name
            FROM events AS e
            JOIN users AS u
            ON e.user_id=u.id
            JOIN categories AS c ON e.category_id=c.id
            WHERE e.title LIKE ? OR u.username LIKE ? ORDER BY e.created_at DESC LIMIT $items OFFSET $offset";

    $stmt = execQuery($sql, ['title' => $searchMatch, 'username' => $searchMatch]);
    $records = $stmt->get_result()->fetch_all(MYSQLI_ASSOC); //return all values
    return $records;
}

function searchEventByAdmin($keyword, $id)
{
    global $conn;
    // query for joining 3 tables which is users and events
    $searchMatch = '%' . $keyword . '%';

    $sql = "SELECT e.*,
            u.username,
            c.name
            FROM events AS e
            JOIN users AS u
            ON e.user_id=u.id
            JOIN categories AS c ON e.category_id=c.id
            WHERE e.title LIKE ? AND e.category_id ='$id' OR u.username LIKE ? AND e.category_id ='$id' ORDER BY e.eventday DESC";

    $stmt = execQuery($sql, ['title' => $searchMatch, 'username' => $searchMatch]);
    $records = $stmt->get_result()->fetch_all(MYSQLI_ASSOC); //return all values
    return $records;
}

function searchEventByAdminPagination($keyword, $id, $items, $offset)
{
    global $conn;
    // query for joining 3 tables which is users and events
    $searchMatch = '%' . $keyword . '%';

    $sql = "SELECT e.*,
            u.username,
            c.name
            FROM events AS e
            JOIN users AS u
            ON e.user_id=u.id
            JOIN categories AS c ON e.category_id=c.id
            WHERE e.title LIKE ? AND e.category_id ='$id' OR u.username LIKE ? AND e.category_id ='$id' ORDER BY e.created_at DESC LIMIT $items OFFSET $offset";

    $stmt = execQuery($sql, ['title' => $searchMatch, 'username' => $searchMatch]);
    $records = $stmt->get_result()->fetch_all(MYSQLI_ASSOC); //return all values
    return $records;
}

function people($id)
{
    global $conn;
    $sql = "SELECT p.*,u.username,e.title FROM people as p JOIN users as u ON p.name=u.id JOIN events AS e ON p.event_id=e.id WHERE p.cat_id='$id' ORDER BY joined_at DESC";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $people = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
    return $people;
}

function getComments($status)
{
    global $conn;
    $sql = "SELECT c.*,u.username FROM comment as c JOIN users as u ON c.uid=u.id WHERE c.status='$status'";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $comments = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
    return $comments;
}