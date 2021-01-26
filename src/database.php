<?php
$db_hn = getenv('DB_HN');
$db_db = getenv('DB_DB');
$db_un = getenv('DB_UN');
$db_pw = getenv('DB_PW');

try {
    $db_conn = new PDO("mysql:host=$db_hn;dbname=$db_db", $db_un, $db_pw);
} catch (PDOException $e) {
    die('Error Connecting to Database');
}
