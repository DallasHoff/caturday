<?php
function logAction($action, $info) {

    if (!isset($action)) throw new Exception('No action name to log was supplied.');

    global $authUsername;
    global $phpUserIp;
    global $phpUserPort;
    global $phpReqUri;
    global $phpReqMethod;

    $id = dbGenId();
    $socket = "$phpUserIp:$phpUserPort";
    $infoStr = null;

    if (isset($info)) {
        if (!is_array($info)) throw new Exception('Information for logging must be supplied as an array.');

        $infoItems = array();
        $infoStr = "";
        foreach ($info as $key => $value) {
            array_push($infoItems, "$key=$value");
        }
        
        $infoStr = implode(';', $infoItems);
    }

    dbQuery("INSERT INTO `action_log` (`id`, `user`, `socket`, `action`, `uri`, `method`, `datetime`, `date`, `info`) VALUES (?, ?, ?, ?, ?, ?, NOW(), DATE(NOW()), ?)", array(
        $id,
        $authUsername,
        $socket,
        $action,
        $phpReqUri,
        $phpReqMethod,
        $infoStr
    ));

}