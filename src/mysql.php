<?php

namespace ES\Utils;

/**
 * Class MySql
 * This class provides simaple operations on mysql database
 */
class MySql {
    protected $dbConnection;

    public function __construct($dbServer, $dbUser, $dbPassword, $dbName, $driver = 'mysql') {
        try {
            $this->dbConnection = new PDO($driver . ':host='.$dbServer.';dbname=' . $dbName, $dbUser, $dbPassword);
            return $this;
        } catch (PDOException $e){
            return false;
        }
    }

    public function query($querySring, $params = []) {
        $sth = $connec->prepare($querySring, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
        $sth->execute($params);
        $c = $sth->fetchAll();

        print_r($c);
    }
    
}