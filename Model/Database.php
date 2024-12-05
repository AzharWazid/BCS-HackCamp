<?php
class Database
{
    private $_dbHandle;

    private static $_dbInstance;

    private function __construct()
    {
        try
        {
            $this->_dbHandle = new PDO('sqlite:bcs.sqlite');
        }
        catch (PDOException $e)
        {
            echo $e->getMessage();
        }
    }

    public static function getInstance()
    {
        if(self::$_dbInstance == null){
            self::$_dbInstance = new Database();
        }
        return self::$_dbInstance;
    }

    public function getConnection()
    {
        return $this->_dbHandle;
    }

    public function __destruct()
    {
        $this->_dbHandle = null;
    }
}