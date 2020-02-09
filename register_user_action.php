<?php
    session_start();
    include_once("connect.php");

    $name = $_POST["name"];
    $username = $_POST["username"];
    $e_mail = $_POST["e_mail"];
    $phone = $_POST["phone"];
    $password = $_POST["password"];

    $statement = $connection->prepare(
        "insert into `user`(name, username, e_mail, phone, `password`) " .
        "value (?, ?, ?, ?, ?)");
    $statement->bind_param("sssss", $name, $username, $e_mail, $phone,
                           $password);

    if ($statement->execute() === TRUE) {
        $_SESSION["register_user_message"] = "User successfuly registered.";
        $statement->close();
        header("Location: home.php?user_registered=true");
    }
    else {
        $_SESSION["register_user_message"] = "Could not register user.";
        $statement->close();
        header("Location: register_user.php?user_registered=false");
    }
?>
