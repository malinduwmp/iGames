<?php
class Database {
    private static $connection;

    public static function setUpConnection() {
        if (!isset(Database::$connection)) {
            $servername = "localhost";
            $username = "root";
            $password = "SMsuperX@262";
            $dbname = "iGames";
            $port = 3306;
            $socket = '/tmp/mysql.sock'; // Replace with actual path if needed

            Database::$connection = new mysqli($servername, $username, $password, $dbname, $port, $socket);

            if (Database::$connection->connect_error) {
                die("Connection failed: " . Database::$connection->connect_error);
            }
        }
    }

    public static function iud($q) {
        Database::setUpConnection();
        Database::$connection->query($q);
    }

    public static function search($q) {
        Database::setUpConnection();
        $resultset = Database::$connection->query($q);
        return $resultset;
    }

    public static function getLastInsertId() {
        Database::setUpConnection();
        return Database::$connection->insert_id;
    }

    public static function getConnection() {
        Database::setUpConnection();
        return Database::$connection;
    }
}

// Initialize the database connection
Database::setUpConnection();

?>
