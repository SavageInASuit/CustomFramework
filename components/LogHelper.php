<?php
use Monolog\Logger;
use Monolog\Handler\StreamHandler;

class LogHelper {
    public static function log($sText, $sPrepend = ''){
        // $sDateTime = '[' . date("Y-m-d H:i:s") . ']';
        // // Write the logtext to the log file defined in the constants file
        // $myfile = file_put_contents(CONST_LOGFILE, $sDateTime . ' ' . $sPrepend . ' - ' . $sText . PHP_EOL , FILE_APPEND | LOCK_EX);

        // create a log channel
        $log = new Logger('name');
        $log->pushHandler(new StreamHandler(CONST_LOGFILE, Logger::WARNING));
    
        // add records to the log
        $log->addInfo($sPrepend . ' - ' . $sText);
    }
}