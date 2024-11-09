<?php
header("Access-Control-Allow-Origin: *");
//session_start();

$message = '';

if ((!isset($_POST['id']) || empty($_POST['id']))
    || ((!isset($_POST['password']) || empty($_POST['password'])))) {
    $message = 'Please fill in all require information';
}

if (!empty($message)) {
    header("Location: ../index.php?message=$message");
}

require_once "../Model/User.php";
require_once "../Model/MYSQLConnection.php";
require_once "../Model/UserDataModel.php";

try {
    $connection = new MYSQLConnection();
    $userDataModel = new UserDataModel($connection);

    if (!$userDataModel->exist($_POST['id'])) {
        $message = "user does not exist";
        if (!empty($message)) {
            header("Location: ../index.php?message=$message");
        }
    }
    $user = $userDataModel->getUser($_POST['id']);
    if ($user->getPassword() === $_POST['password']) {
        session_id($user->getFirstName() . "-" . $user->getLastName() . "-" . $user->getAge());
        session_start();
        $_SESSION['user'] = $user;

        header("Location: ./getUsersController.php");
    } else {
        $message = "Password Does not match";
        if (!empty($message)) {
            header("Location: ../index.php?message=$message");
        }
    }

}catch (PDOException $exception) {
    $message = " Database Error !";
} finally {
    if (!empty($message)) {
        header("Location: ../index.php?message=$message");
    }
}