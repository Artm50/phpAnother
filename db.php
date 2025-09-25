<?php

date_default_timezone_set("Asia/Yakutsk");

require 'vendor/autoload.php';

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__ );
$dotenv->load();

function logError($e) {
    error_log("[" . date("Y-m-d H:i:s", time()) . "]\n" . $e->getTraceAsString() . "\n" . $e->getMessage() . "\n\n", 3, "./error.log");
}

class DB {
    public $conn;

    function openCon() {
        try {
            $password = $_ENV['PASSWORD'];
        } catch ( Error $e ) {
            logError($e);
        }

        try {
            $this->conn = new mysqli("localhost", "root", "$password", "php_practic");
        } catch (Error $e) {
            logError($e);
        }
    }

    function closeCon() {
        $this->conn->close();
    }

    function getCon() {
        return $this->conn;
    }

    function addUser($conn, $username, $password) {
        $pass = md5($password);
        $sql = "insert into users (name, password)
        values ('$username', '$pass');";
        try {
            mysqli_query( $conn, $sql );
        } catch (mysqli_sql_exception $e) {
            logError($e);
        } finally {
            $conn->close();
        }
    }

    function getUser($conn, $username, $password) {
        unset($result);
        $pass = md5($password);
        $sql = "select * from users where name = '$username' and password = '$pass'";
        try {
            $result = mysqli_query( $conn, $sql);
        } catch (Error $e) {
            logError($e);
        } finally {
            $conn->close();
        }

        try {
            if ($result->num_rows > 0) {
                return true;
            } else {
                return false;
            }
        } catch (Error $e) {
            logError($e);
        }
    }
}