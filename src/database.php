<?php
$db_hn = getenv('DB_HN');
$db_db = getenv('DB_DB');
$db_un = getenv('DB_UN');
$db_pw = getenv('DB_PW');

// Connection
try {
    $db = new PDO("mysql:host=$db_hn;dbname=$db_db", $db_un, $db_pw);
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $db->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
} catch (PDOException $e) {
    die('Error Connecting to Database');
}

// ID Generator
function dbGenId() {
    $numRandomDigits = 8;
    $id = time();
    for ($i = 0; $i < $numRandomDigits; $i++) {
        $id .= random_int(0, 9);
    }
    return $id;
}

// Token Generator
function dbGenToken() {
    $numRandomBytes = 32;
    $token = random_bytes($numRandomBytes);
    $token = base64_encode($token);
    return $token;
}

// Query
function dbQuery($sql, $params) {
    global $db;

    if (!isset($sql)) throw new Exception('No SQL supplied for query.');
    if (isset($params) && !is_array($params)) throw new Exception('Parameters for SQL query must be supplied as an array.');

    $statement = $db->prepare($sql);
    if ($statement === false) throw new Exception($statement->errorInfo());

    $query = $statement->execute($params);
    if ($query === false) throw new Exception($statement->errorInfo()[2]);

    return $statement->fetchAll(PDO::FETCH_ASSOC);
}
