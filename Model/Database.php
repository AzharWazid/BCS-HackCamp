<?php

/*
 *
 * Provides connection to database
 *
 */

class Database{
    /**
     * @var Database
     */
    protected static $_dbInstance = null;
    /**
     * @var PDO
     */
    protected $_dbHandle;
    /*
     * assigns the PDO to _dbHandle
     */
    private function __construct(){
        $host = "localhost";
        $user = "postgres";
        $password = "1234";
        $dbname = "postgres";
        $port = 5432;
        try{
            $this->_dbHandle = new PDO('pgsql:host='.$host.';port='.$port.';dbname='.$dbname, $user, $password);
        }
        catch(PDOException $e){
            echo $e->getMessage();
        }
    }

    /**
     * @return Database|null
     */
    public static function getInstance(){
        if(self::$_dbInstance == null){
            self::$_dbInstance = new self();
        }
        return self::$_dbInstance;
    }

    /**
     * @return PDO
     */
    public function getDbConnection(){
        return $this->_dbHandle;
    }

    public function __destruct(){
        $this->_dbHandle = null;
    }
}