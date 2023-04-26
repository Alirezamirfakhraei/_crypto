<?php

namespace System\Database\DBConnection;
use PDO;

class DBConnection
{
    private static $dbConnectionInstanse = null;


    private function __construct()
    {

    }

    public static function getDBConnectionInstance()
    {
        if (self::$dbConnectionInstanse == null){
            $DBConnectionInstanse = new DBConnection();
            self::$dbConnectionInstanse = $DBConnectionInstanse->dbConnection();

        }
        return self::$dbConnectionInstanse;
    }

    private function dbConnection()
    {
        $option = array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION , PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC);
        try {
            return new PDO("mysql:host=".DBHOST.";dbname=".DBNAME,DBUSERNAME , DBPASSWORD , $option);
        }catch (\PDOException $exception){
            echo "error in connect to database".$exception->getMessage();
            return false;
        }
    }

    public function newInsertID()
    {
        return self::getDBConnectionInstance()->lastInsertId();
    }
}