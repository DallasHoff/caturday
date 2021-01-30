<?php
    foreach ($GLOBALS['appComponentScripts'] as $k => $scriptPath) {
        require_once $scriptPath;
    }
?>