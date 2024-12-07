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
        try{
            $this->_dbHandle = new PDO('sqlite:../bcs.sqlite');
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