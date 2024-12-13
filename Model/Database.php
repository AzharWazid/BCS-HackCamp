<?php

/*
 *
 * Provides connection to database
 *
 * STOP
 *
 * THESE ARE THE ANCIENT SCRIPTURES I DO NOT KNOW HOW IT WORKS
 * DONT TOUCH
 * WILL BREAK EVERYTHING.
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

        //this is for server DONT TOUCH!!!!!!!!!
;       //$user = "hc24-02";
        //$password = "6o9vLXDDtHb62v2";
        //$dbname = "hc24_02";

        $port = "5432";

        try{
            //DONT TOUCH!!!!!!!
            //$this->_dbHandle = new PDO('pgsql:sslmode=require;host='.$host.';port='.$port.';dbname='.$dbname, $user, $password);

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