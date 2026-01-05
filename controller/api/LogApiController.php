<?php
include_once 'model/dao/LogDAO.php';

class LogApiController {

    public function getLogs() {
        $logs = LogDAO::getLogs();
        $logsArray = [];
        foreach ($logs as $log) {
            array_push($logsArray, $log->toArray());
        }
        echo json_encode($logsArray); 
    }
}
