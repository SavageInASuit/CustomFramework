<?php

class Logger {
    public static function log($sText, $sPrepend = ''){
        // TODO: Automatically prepend the current date and time
        $sDateTime = '[' . date("Y-m-d H:i:s") . ']';
        // Write the logtext to the log file defined in the constants file
        $myfile = file_put_contents(CONST_LOGFILE, $sDateTime . ' ' . $sPrepend . ' - ' . $sText . PHP_EOL , FILE_APPEND | LOCK_EX);
    }
}