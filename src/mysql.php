<?php

namespace ES\Utils;

/**
 * Class MySql
 * This class provides simaple operations on mysql database
 */
class MySql {
    protected $dbConnection;

    public function __construct($dbServer, $dbUser, $dbPassword, $dbName) {
        $$this->dbConnection=  mysqli_connect($dbServer, $dbUser, $dbPassword, $dbName);
    }

    public function __destruct() {
        mysqli_close($this->dbConnection);
    }

    public function query($sqlQuerySring) {
        $result = mysqli_query($this->dbConnection, $sqlQuerySring);
        $rows = mysqli_fetch_assoc($result);
        mysqli_free_result($result);
    }
    
}