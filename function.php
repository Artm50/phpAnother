<link rel="stylesheet" href="css/style.css">
<?php

require_once("db.php");

session_start();


$db = new DB();

function checkIsset($value) {
    if (isset($value)) {
        return $value;
    } else {
        echo "Не корректные данные" . PHP_EOL;
    }
}

function checkSession() {
    global $db;
    try {
        $db->openCon();
        if($db->getUser($db->getCon(), $_SESSION["login"], $_SESSION["password"])) {
            header("Location: /php/main.php");
            exit();
        }
    } catch (Error $e) {
        logError($e);
    }
}

echo ('http://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']) . "\n";
echo ($_SERVER["HTTP_REFERER"]) . "\n";
echo ($_SESSION["password"]) . "\n";
echo ($_SESSION["login"]) . "\n";

if (('http://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']) == "http://localhost/php/" && ($_SERVER["HTTP_REFERER"]) == "http://localhost/php/main.php") {
    $db->openCon();
    if($db->getUser($db->getCon(), $_SESSION["login"], $_SESSION["password"])) {
        header("Location: /php/main.php");
        exit();
    }
}


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if ($_POST["submit"] == "reg") {
        $flag = true;
        // $_POST[""] принимает name из input
        $login = checkIsset($_POST["login"]);
        $password = checkIsset($_POST["password"]);

        $db->openCon();
        if($db->getUser($db->getCon(), $login, $password)) {
            $_SESSION["login"] = $login;
            $_SESSION["password"] = $password;
            header("Location: /php/main.php");
            exit();
        } else {
            $flag = false;
        }   
    }
    elseif ($_POST["submit"] == "logout") {
        session_unset();
        header("Location: /php");
        exit();
    }
}