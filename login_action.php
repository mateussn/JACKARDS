<?php
    session_start();
    include_once("connect.php");

    // To prevent MySQL injection.
    $username = stripcslashes($username);
    $password = stripcslashes($password);

    $username = $connection->real_escape_string($_POST["username"]);
    $password = $connection->real_escape_string($_POST["password"]);

    $statement = $connection->prepare("select id from `user` where username " .
                                      "= ? and password = ?");
    $statement->bind_param("ss", $username, $password);
    $statement->execute();
    $statement->store_result();

    if ($statement->num_rows === 1) {
        $statement->bind_result($_SESSION["id"]);

        $statement->fetch();
        $statement->close();
        header("Location: home.php");
    }
    else {
        $_SESSION["login_message"] = "Failed to login.";
        $statement->close();
        header("Location: login.php?logged_in=false");
    }
?>
