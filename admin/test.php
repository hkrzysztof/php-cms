<?php
/**
 * Created by PhpStorm.
 * User: Hid
 * Date: 2018-03-15
 * Time: 13:21
 */

include_once 'includes/init.php';

$password = '123';
global $database;


//$username = $database->escape_string($username);
//$password = $database->escape_string($password);
//$first_name = $database->escape_string($first_name);
//$last_name = $database->escape_string($last_name);
//$rights = 'subscriber';
//$created_at = date('d-m-y H:i:s');


$sql = "INSERT INTO users (username, password, first_name, last_name, rights, filename, created_at, last_modified) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
$conn = $database->connection;
$stmt = $conn->prepare($sql);
$stmt->bind_param("ssssssss", $username, $password, $first_name, $last_name, $rights, $filename, $created_at, $last_modified);
$username = 'hidulindor';
$password = '123';
$first_name = 'tester';
$last_name = 'as';
$rights = 'nie';
$filename = 'czemu';
$created_at = '09-03-18 ';
$last_modified = '09-03-19 ';

$stmt->execute();
$stmt->close();
//$last_id = $database->the_insert_id();
