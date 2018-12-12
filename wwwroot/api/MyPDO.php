<?php

class MyPDO {
    public function __construct($host, $port, $username, $password, $db) {
        $options = array();
        $options[PDO::MYSQL_ATTR_INIT_COMMAND] = "SET NAMES 'utf8'";
        $options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
        $options[PDO::ATTR_DEFAULT_FETCH_MODE] = PDO::FETCH_ASSOC;
        $options[PDO::ATTR_PERSISTENT] = true;
        try {
            $this->dbh = @new PDO("mysql:host=$host;port=$port;dbname=$db;charset=utf8", $username, $password, $options);
        } catch (PDOException $e) {
            $json = array('errno' => -1, 'message' => $e->getMessage());
            die(safe_json_encode($json));
        }
    }
    public function fetch($sql, $arr = array()) {
        $stmt = $this->dbh->prepare($sql);
        try {
            $r = $stmt->execute($arr);
        } catch (PDOException $e) {
            $json = array('errno' => -1, 'message' => $e->getMessage());
            die(safe_json_encode($json));
        }
        if ($r !== TRUE) {
            $json = array('errno' => -1, 'message' => $stmt->errorInfo());
            die(safe_json_encode($json));
        }
        return $stmt->fetch(3)[0];
    }
}
